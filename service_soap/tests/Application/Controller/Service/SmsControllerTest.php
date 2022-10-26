<?php

declare(strict_types=1);

namespace App\Tests\Controller\Service;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class SmsControllerTest extends WebTestCase
{
    public function testSend(): void
    {
        $soapClient = new \SoapClient('http://127.0.0.1:8000/service/test/send?wsdl', ['trace' => 1]);

        try {
            $result = $soapClient->__soapCall('send', ['phoneNumber' => '584145138790', 'text' => 'Hola']);

            $this->assertSame('Hola el numero es "584145138790"', $result);
        } catch (\SoapFault $exception) {
            dump($soapClient->__getLastRequest());
            dump($soapClient->__getLastResponse());
        }
    }
}
