<?php

declare(strict_types=1);

namespace App\Controller\Service\Soap;

use App\Service\Soap\BalanceSoap;
use App\Service\Soap\CoreSoap;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BalanceSoapController extends AbstractController
{
    #[Route('/soap/wallet/balance', 'soap_wallet_balance')]
    public function balance(BalanceSoap $balanceSoap): Response
    {
        return CoreSoap::exceSoap('wsdl/balance.wsdl', $balanceSoap);
    }
}
