<?php

declare(strict_types=1);

namespace App\Tests\Controller\Service;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class PayConfirmControllerTest extends WebTestCase
{
    public function testPayConfirm(): void
    {

        /*  try {*/

        $soapClient = new \SoapClient('http://127.0.0.1:8000/soap/wallet/payConfirm?wsdl');
        $result = $soapClient->payConfirm('18671986', '4145138790');

        $this->assertSame('{"success":false,"cod_error":105,"message_error":"Su token a expirado","data":[]}', $result);/*
        } catch (\SoapFault $exception) {
            dump($soapClient->__getLastRequest());
            dump($soapClient->__getLastResponse());
        }*/
    }
}
