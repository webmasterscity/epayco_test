<?php

declare(strict_types=1);

namespace App\Controller\Service\Soap;

use App\Service\Soap\TestSoap;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TestSoapController extends AbstractController
{
    #[Route('/service/test/send', 'test_send')]
    public function send(TestSoap $testSoap): Response
    {
        // absolute path: /public/wsdl/test_sender.wsdl
        $soapServer = new \SoapServer('wsdl/test_sender.wsdl');
        $soapServer->setObject($testSoap);

        $response = new Response();
        $response->headers->set('Content-Type', 'text/xml; charset=ISO-8859-1');

        ob_start();
        $soapServer->handle();
        $response->setContent(ob_get_clean());

        return $response;
    }
}
