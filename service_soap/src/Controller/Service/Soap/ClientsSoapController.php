<?php

declare(strict_types=1);

namespace App\Controller\Service\Soap;

use App\Entity\Clients;
use App\Entity\Users;
use App\Service\Soap\ClientsSoap;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ClientsSoapController extends AbstractController
{
    #[Route('/soap/client/register', 'soap_client_register')]
    public function register(ClientsSoap $clientsSoap): Response
    {

        // absolute path: /public/wsdl/
        $soapServer = new \SoapServer('wsdl/clients_b.wsdl');
        $soapServer->setObject($clientsSoap);

        $response = new Response();
        $response->headers->set('Content-Type', 'text/xml; charset=ISO-8859-1');

        ob_start();
        $soapServer->handle();
        $response->setContent(ob_get_clean());

        return $response;
    }



}
