<?php

declare(strict_types=1);

namespace App\Controller\Service\Soap;

use App\Entity\Clients;
use App\Entity\Users;
use App\Service\Soap\ClientsSoap;
use App\Service\Soap\CoreSoap;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ClientsSoapController extends AbstractController
{
    #[Route('/soap/client/register', 'soap_client_register')]
    public function register(ClientsSoap $clientsSoap): Response
    {
        return CoreSoap::exceSoap('wsdl/clients.wsdl', $clientsSoap);
    }



}
