<?php

declare(strict_types=1);

namespace App\Controller\Service\Soap;

use App\Service\Soap\CoreSoap;
use App\Service\Soap\PayConfirmSoap;
use App\Service\Soap\PaySoap;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PayConfirmSoapController extends AbstractController
{
    #[Route('/soap/wallet/payConfirm', 'soap_wallet_pay_confirm')]
    public function confirm(PayConfirmSoap $payConfirmSoap): Response
    {
        return CoreSoap::exceSoap('wsdl/payConfirm.wsdl', $payConfirmSoap);
    }
}
