<?php

declare(strict_types=1);

namespace App\Controller\Service\Soap;

use App\Service\Soap\TestSoap;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\Soap\CoreSoap;
class TestSoapController extends AbstractController
{
    #[Route('/service/test/send', 'test_send')]
    public function send(TestSoap $testSoap): Response
    {
        return CoreSoap::exceSoap('wsdl/test_senda.wsdl', $testSoap);
    }
}
