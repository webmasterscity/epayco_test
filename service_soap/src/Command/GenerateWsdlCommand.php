<?php
// src/Command/CreateUserCommand.php
namespace App\Command;

use App\Entity\Clients;
use App\Service\Soap\ClientsSoap;
use App\Service\Soap\RechargeSoap;
use App\Service\Soap\TestSoap;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Laminas\Soap\AutoDiscover;

// the name of the command is what users type after "php bin/console"
#[AsCommand(name: 'app:generate-wsdl')]
class GenerateWsdlCommand extends Command
{
    protected function execute(InputInterface $input, OutputInterface $output): int
    {



        $autodiscover = new AutoDiscover();
        $autodiscover
            ->setClass(RechargeSoap::class)
            ->setUri('http://127.0.0.1:8000/soap/wallet/recharge')
            ->setServiceName('wallet');

        $wsdl = $autodiscover->generate();

        // Emit the XML:
        // echo $wsdl->toXml();

        // Or dump it to a file; this is a good way to cache the WSDL
        $wsdl->dump("public/wsdl/recharge_c.wsdl");

        // Or create a DOMDocument, which you can then manipulate:
        //$dom = $wsdl->toDomDocument();

        return Command::SUCCESS;
    }
}
