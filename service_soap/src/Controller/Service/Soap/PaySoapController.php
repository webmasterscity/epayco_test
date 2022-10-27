<?php

declare(strict_types=1);

namespace App\Controller\Service\Soap;

use App\Service\Soap\CoreSoap;
use App\Service\Soap\PaySoap;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PaySoapController extends AbstractController
{
    #[Route('/soap/wallet/pay', 'soap_wallet_pay')]
    public function recharge(PaySoap $paySoap): Response
    {
        return CoreSoap::exceSoap('wsdl/pay_b.wsdl', $paySoap);
    }
}
