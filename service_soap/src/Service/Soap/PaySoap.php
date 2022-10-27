<?php

declare(strict_types=1);

namespace App\Service\Soap;

use App\Entity\Clients;
use App\Entity\Sessions;
use App\Entity\Transactions;
use App\Entity\Users;
use App\Entity\Wallets;
use App\Service\Api;
use App\Service\Email\EmailService;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Ramsey\Uuid\Uuid;
use Symfony\Component\HttpFoundation\Session\Session;
class PaySoap extends Api
{
    public $doctrine;

    public function __construct(ManagerRegistry $doctrine)
    {
        parent::__construct($doctrine, Wallets::class);
        $this->doctrine = $doctrine;
    }


    public function pay(string $document, string $phone, string $amount)
    {
        $session = new Session();
        $session->start();

  

        if (empty($document) || empty($phone) || empty($amount)) {

            $this->error("Todos los campos son requeridos", 200);
        } else {
            try {
                $entityManager = $this->getEntityManager();

                $query = $entityManager->createQuery(
                    'SELECT c.id
                FROM App\Entity\Clients c
                WHERE c.document = :document
                AND c.phone= :phone'
                )
                    ->setParameter('document', $document)
                    ->setParameter('phone', $phone);

                $res = $query->getResult();
                if (count($res) == 1) {
                    $clientId = $res[0]['id'];

                    $resWallets = Wallets::getBalanceWalletByClientId($clientId, $entityManager);

                    if ($resWallets[0]['balance'] >= $amount) {


                        $client = $entityManager->getRepository(Clients::class)->find($clientId);
                        $usersId = $client->getUsers()->getId();

                        $user = $entityManager->getRepository(Users::class)->find($usersId);
                        $token = $this->generateToken();
                        $user->setToken(strval($token));
                        $entityManager->flush();


                        $sessionId = $this->generateUUID();
                        $session = new Sessions();
                        $session->setAmount($amount)
                        ->setClients($client)
                        ->setUuid(strval($sessionId))
                        ->setExpiresAt();

                        $entityManager->persist($session);
                        $entityManager->flush();

                        // EmailService::enviarEmail($user->getEmail(), "Token Epayco", "<b>" . $token . "</b>");
                        $data = [
                                "token" => $token,
                                "session_id" => $sessionId
                            ];

                        echo $this->success("Se ha enviado un token de verificación a tu correo ", $data);
                    } else {
                        echo $this->error("Disculpe, saldo insuficiente", 105);
                    }

                    

                } else {
                    echo $this->error("Sus datos son incorrectos", 104);
                }
            } catch (Exception $e) {
                echo $this->error("No podemos recargar su saldo", 103);
                throw $e;
            }
        }



        return "true";
    }
    private function generateToken()
    {
        return rand(100000, 999999);
    }
    private function generateUUID()
    {
        return Uuid::uuid6();
    }
}
