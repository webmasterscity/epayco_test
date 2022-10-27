<?php

declare(strict_types=1);

namespace App\Tests\Controller\Service;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class SoapControllerTest extends WebTestCase
{
    public function testSend(): void
    {
        $soapClient = new \SoapClient('http://127.0.0.1:8000/service/test/send?wsdl', ['trace' => 1]);

        // try {
        $result = $soapClient->send('584145138790', 'Hola', 'chao');
        echo "----" . $result . "----";
        $this->assertSame('Hola el numero es "584145138790" chao', $result);
        /*} catch (\SoapFault $exception) {
            dump($soapClient->__getLastRequest());
            dump($soapClient->__getLastResponse());
        }*/
    }
}
