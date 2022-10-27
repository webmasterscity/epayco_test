<?php

declare(strict_types=1);

namespace App\Service\Soap;

use App\Entity\Clients;
use App\Entity\Users;
use App\Entity\Wallets;
use App\Service\Api;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use Symfony\Component\DependencyInjection\ContainerInterface;

class ClientsSoap extends Api
{
    public $doctrine;

    public function __construct(ManagerRegistry $doctrine)
    {
        parent::__construct($doctrine, Users::class);
        $this->doctrine = $doctrine;
    }


    public function register(string $document, string $name, string $email, string $phone)
    {
        if (empty($document) || empty($name) || empty($email) || empty($phone)) {

            $this->error("Todos los campos son requeridos", 200);
        } else {


            $entityManager = $this->getEntityManager();

            $query = $entityManager->createQuery(
                'SELECT 1
                FROM App\Entity\Users u
                WHERE u.email = :email'
            )->setParameter('email', $email);

            $resUser = $query->getResult();

            $query = $entityManager->createQuery(
                'SELECT 1
                FROM App\Entity\Clients c
                WHERE c.document = :document'
            )->setParameter('document', $document);

            $resClient = $query->getResult();

            if (count($resUser) == 0 && count($resClient) == 0) {
                $entityManager->getConnection()->beginTransaction(); // suspend auto-commit
                try {
                    $user = new Users();
                    $user->setEmail($email);
                    $user->setPassword("test");
                    $entityManager->persist($user);
                    $entityManager->flush();

                    $client = new Clients();
                    $client->setName($name);
                    $client->setDocument($document);
                    $client->setPhone($phone);
                    $client->setUsers($user);
                    $entityManager->persist($client);
                    $entityManager->flush();

                    $wallet = new Wallets();
                    $wallet->setClients($client);
                    $entityManager->persist($wallet);
                    $entityManager->flush();

                    $entityManager->getConnection()->commit();
                    echo $this->success("Registrado correctamente", 201);
                } catch (Exception $e) {
                    $entityManager->getConnection()->rollBack();
                    echo $this->error("Intente mas tarde", 101);
                    throw $e;
                }
            } else {
                echo $this->error("El cliente ya se encuentra registrado", 100);
            }
        }



        return "true";
    }
}
