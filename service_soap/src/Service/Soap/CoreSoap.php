<?php

namespace App\Service\Soap;

use Symfony\Component\HttpFoundation\Response;

class CoreSoap
{
    public static function exceSoap($wsdl, $obj): Response
    {
        // absolute path: /public/wsdl/
        $soapServer = new \SoapServer($wsdl);
        $soapServer->setObject($obj);

        $response = new Response();
        $response->headers->set('Content-Type', 'text/xml; charset=ISO-8859-1');

        ob_start();
        $soapServer->handle();
        $response->setContent(ob_get_clean());

        return $response;
    }
}
