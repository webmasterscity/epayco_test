<?php

declare(strict_types=1);

namespace App\Service\Soap;

use App\Entity\Clients;
use App\Entity\Transactions;
use App\Entity\Users;
use App\Entity\Wallets;
use App\Service\Api;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use Symfony\Component\DependencyInjection\ContainerInterface;

class RechargeSoap extends Api
{
    public $doctrine;

    public function __construct(ManagerRegistry $doctrine)
    {
        parent::__construct($doctrine, Wallets::class);
        $this->doctrine = $doctrine;
    }


    public function recharge(string $document, string $phone, string $amount)
    {

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
                    $clients = $entityManager->getRepository(Clients::class)->find($res[0]['id']);

                    $transaction = new Transactions();
                    $transaction->setAmount($amount)
                    ->setClients($clients)
                    ->setCreatedAt();
                    $entityManager->persist($transaction);
                    $entityManager->flush();
                    return $this->success("Recargado correctamente");
                } else {
                    return $this->error("Sus datos son incorrectos", 104);
                }
            } catch (Exception $e) {
                return $this->error("No podemos recargar su saldo", 103);
                throw $e;
            }
        }



        return "true";
    }
}
