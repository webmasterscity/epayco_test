<?php

declare(strict_types=1);

namespace App\Service\Soap;

class TestSoap
{
    public function send(string $phoneNumber, string $text): string
    {
        // SMS sending process...

        return sprintf('%s el numero es "%s"', $text, $phoneNumber);
    }
}
