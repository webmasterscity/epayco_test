<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SoapController extends Controller
{
    private $server = "http://127.0.0.1:8000/soap/";
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function balance(Request $request)
    {
        try {

            $soapClient = new \SoapClient($this->server . 'wallet/balance?wsdl');
            $result = $soapClient->balance($request->document, $request->phone);
            print($result);
        } catch (\SoapFault $exception) {
            dump($soapClient->__getLastRequest());
            dump($soapClient->__getLastResponse());
        }
    }
    public function client(Request $request)
    {
        try {
            $soapClient = new \SoapClient($this->server . 'client/register?wsdl');
            $result = $soapClient->register($request->document, $request->name, $request->email, $request->phone);
            print($result);
        } catch (\SoapFault $exception) {
            dump($soapClient->__getLastRequest());
            dump($soapClient->__getLastResponse());
        }
    }
    public function pay(Request $request)
    {
        try {
            $soapClient = new \SoapClient($this->server . 'wallet/pay?wsdl');
            $result = $soapClient->pay($request->document, $request->phone, $request->amount);
            print($result);
        } catch (\SoapFault $exception) {
            dump($soapClient->__getLastRequest());
            dump($soapClient->__getLastResponse());
        }
    }
    public function payConfirm(Request $request)
    {
        try {
            $soapClient = new \SoapClient($this->server . 'wallet/payConfirm?wsdl');
            $result = $soapClient->payConfirm($request->token, $request->sessionId);
            print($result);
        } catch (\SoapFault $exception) {
            dump($soapClient->__getLastRequest());
            dump($soapClient->__getLastResponse());
        }
    }
    public function recharge(Request $request)
    {

        try {
            $soapClient = new \SoapClient($this->server . 'wallet/recharge?wsdl');
            $result = $soapClient->recharge($request->document, $request->phone, $request->amount);
            print($result);
        } catch (\SoapFault $exception) {
            dump($soapClient->__getLastRequest());
            dump($soapClient->__getLastResponse());
        }
    }
}
