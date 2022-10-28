<?php
// src/Command/CreateUserCommand.php
namespace App\Command;

use App\Entity\Clients;
use App\Entity\Users;
use App\Service\Soap\BalanceSoap;
use App\Service\Soap\ClientsSoap;
use App\Service\Soap\PayConfirmSoap;
use App\Service\Soap\PaySoap;
use App\Service\Soap\RechargeSoap;
use App\Service\Soap\TestSoap;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Laminas\Soap\AutoDiscover;
use Symfony\Component\Mailer\Transport;
use Symfony\Component\Mailer\Mailer;
use Symfony\Component\Mime\Email;
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



        $c = new ClientsSoap($this->doctrine);
        echo $c->register("18671982", "leonardo", "corporacionlemez@gmail.com", "4145138793");
       
        /*  $c = new RechargeSoap($this->doctrine);
        $c->recharge("18671986", "4145138790", -2000);*/
        //$this->enviarEmail();

        /* $c = new PaySoap($this->doctrine);
        $c->pay("18671986", "4145138790", 50);*/
        // echo "------------------";
        /*
        $c = new PayConfirmSoap($this->doctrine);
        $c->payConfirm("286973", "1ed56398-c413-6d12-bf60-00090faa0001");

/*
        $c = new BalanceSoap($this->doctrine);
        $c->balance("18671986", "4145138790");*/
        return Command::SUCCESS;
    }

    private function enviarEmail()
    {

        $transport = Transport::fromDsn($_ENV["MAILER_DSN"]);
        $mailer = new Mailer($transport);

        $email = (new Email())
            ->from('noreply@fudlup.cl')
            ->to('ds000082@gmail.com')
            ->subject('Time for Symfony Mailer!')
            ->text('Sending emails is fun again!')
            ->html('<p>See Twig integration for better HTML integration!</p>');

        $mailer->send($email);
    }
}
