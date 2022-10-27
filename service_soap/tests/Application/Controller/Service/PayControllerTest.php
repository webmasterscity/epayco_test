<?php

declare(strict_types=1);

namespace App\Tests\Controller\Service;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class PayControllerTest extends WebTestCase
{
    public function testPay(): void
    {

        try {

            $soapClient = new \SoapClient('http://127.0.0.1:8000/soap/wallet/pay?wsdl');
            $result = $soapClient->pay('18671986', '4145138790', 100);
            $data = json_decode($result);
            $this->assertSame(true, $data->success);
        } catch (\SoapFault $exception) {
            dump($soapClient->__getLastRequest());
            dump($soapClient->__getLastResponse());
        }
    }
}
