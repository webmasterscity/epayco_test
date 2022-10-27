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

class PayConfirmSoap extends Api
{
    public $doctrine;

    public function __construct(ManagerRegistry $doctrine)
    {
        parent::__construct($doctrine, Wallets::class);
        $this->doctrine = $doctrine;
    }


    public function payConfirm(string $token, string $sessionId)
    {

        if (empty($token) || empty($sessionId)) {

            $this->error("Todos los campos son requeridos", 200);
        } else {
            try {
                $entityManager = $this->getEntityManager();

                $resSessions = $this->showByUuid($sessionId);
                if (count($resSessions) == 1) {
                    $session = $entityManager->getRepository(Sessions::class)->find($resSessions[0]['id']);

                    if ($session->getClients()->getUsers()->getToken() == $token) {

                        $transaction = new Transactions();
                        $transaction->setAmount($session->getAmount())
                            ->setClients($session->getClients())
                            ->setCreatedAt();
                        $entityManager->persist($transaction);
                        $entityManager->flush();

                        $session->setExpires();
                        $entityManager->flush();

                        return $this->success("Pago realizado exitosamente");
                    } else {
                        return $this->error("Su token es incorrecto", 106);
                    }
                } else {
                    return $this->error("Su token a expirado", 105);
                }
            } catch (Exception $e) {
                return $this->error("No podemos recargar su saldo", 103);
                throw $e;
            }
        }



        return "true";
    }
    private function showByUuid($sessionId)
    {
        $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery(
            'SELECT s.id
        FROM App\Entity\Sessions s
        WHERE s.uuid = :session_id AND s.expiresAt>:date_time_now'
        )
            ->setParameter('session_id', $sessionId)
            ->setParameter('date_time_now', date("Y-m-d H:i:s"));

        return $query->getResult();
    }
}
