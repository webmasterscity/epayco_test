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

class BalanceSoap extends Api
{
    public $doctrine;

    public function __construct(ManagerRegistry $doctrine)
    {
        parent::__construct($doctrine, Wallets::class);
        $this->doctrine = $doctrine;
    }


    public function balance(string $document, string $phone)
    {

        if (empty($document) || empty($phone)) {

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

                    $resWallet = Wallets::getBalanceWalletByClientId($res[0]['id'], $entityManager);

                    $data = [
                        "balance" => $resWallet[0]['balance']
                    ];
                    return $this->success("Su balance es", $data);
                } else {
                    return $this->error("Sus datos son incorrectos", 111);
                }
            } catch (Exception $e) {
                return $this->error("No podemos monstrar su balance", 110);
                throw $e;
            }
        }


        return "true";
    }
}
