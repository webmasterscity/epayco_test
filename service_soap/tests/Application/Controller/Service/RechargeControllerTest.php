<?php

declare(strict_types=1);

namespace App\Tests\Controller\Service;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class RechargeControllerTest extends WebTestCase
{
    public function testWalletRecharge(): void
    {

        try {

            $soapClient = new \SoapClient('http://127.0.0.1:8000/soap/wallet/recharge?wsdl');
            $result = $soapClient->recharge('18671986', '4145138790', '5000');

            $this->assertSame('true', $result);
        } catch (\SoapFault $exception) {
            dump($soapClient->__getLastRequest());
            dump($soapClient->__getLastResponse());
        }
    }
}
