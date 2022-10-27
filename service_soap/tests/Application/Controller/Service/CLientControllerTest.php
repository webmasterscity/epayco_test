<?php

declare(strict_types=1);

namespace App\Tests\Controller\Service;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ClientControllerTest extends WebTestCase
{
    public function testClientRegister(): void
    {

        try {

            $soapClient = new \SoapClient('http://127.0.0.1:8000/soap/client/register?wsdl');
            $result = $soapClient->register('18671986', 'Leonardo Melendez', 'ds000082@gmail.com', '584145138790');

            $this->assertSame('true', $result);
        } catch (\SoapFault $exception) {
            dump($soapClient->__getLastRequest());
            dump($soapClient->__getLastResponse());
        }
    }
}
