<?php

namespace App\Service\Email;

use App\Entity\Clients;
use App\Entity\Users;
use App\Service\Soap\ClientsSoap;
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

class EmailService
{

    public static function enviarEmail($para, $subtitle, $body)
    {

        $transport = Transport::fromDsn($_ENV["MAILER_DSN"]);
        $mailer = new Mailer($transport);

        $email = (new Email())
            ->from('noreply@fudlup.cl')
            ->to($para)
            ->subject('Epayco')
            ->text($subtitle)
            ->html($body);

        $mailer->send($email);
    }
}
