<?php

declare(strict_types=1);

namespace App\Tests\Controller\Service;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class BalanceControllerTest extends WebTestCase
{
    public function testWalletBalance(): void
    {

        try {

            $soapClient = new \SoapClient('http://127.0.0.1:8000/soap/wallet/balance?wsdl');
            $result = $soapClient->balance('18671986', '4145138790');
            $data = json_decode($result);
            $this->assertSame('00', $data->cod_error);
        } catch (\SoapFault $exception) {
            dump($soapClient->__getLastRequest());
            dump($soapClient->__getLastResponse());
        }
    }
}
