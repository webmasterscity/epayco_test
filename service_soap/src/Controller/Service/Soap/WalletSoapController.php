<?php

declare(strict_types=1);

namespace App\Controller\Service\Soap;

use App\Entity\Clients;
use App\Entity\Users;
use App\Service\Soap\ClientsSoap;
use App\Service\Soap\CoreSoap;
use App\Service\Soap\RechargeSoap;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class WalletSoapController extends AbstractController
{
    #[Route('/soap/wallet/recharge', 'soap_wallet_recharge')]
    public function recharge(RechargeSoap $rechargeSoap): Response
    {
        return CoreSoap::exceSoap('wsdl/recharge_c.wsdl', $rechargeSoap);
    }
}
