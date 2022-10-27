<?php
// src/Command/CreateUserCommand.php
namespace App\Command;

use App\Entity\Clients;
use App\Entity\Users;
use App\Service\Soap\ClientsSoap;
use App\Service\Soap\RechargeSoap;
use App\Service\Soap\TestSoap;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Laminas\Soap\AutoDiscover;

// the name of the command is what users type after "php bin/console"
#[AsCommand(name: 'app:test')]
class TestCommand extends Command
{
    public function __construct(ManagerRegistry $doctrine)
    {
        parent::__construct();
        $this->doctrine = $doctrine;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {



        // $c = new ClientsSoap($this->doctrine);
        //$c->register("18671986", "leonardo", "ds000082@gmail.com", "4145138790");

        $c = new RechargeSoap($this->doctrine);
        $c->recharge("18671986", "4145138790", -2000);



        return Command::SUCCESS;
    }
}
