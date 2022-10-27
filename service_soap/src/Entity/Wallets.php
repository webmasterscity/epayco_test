<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

/**
 * Wallets
 *
 * @ORM\Table(name="wallets", indexes={@ORM\Index(name="fk_wallets_currencies1_idx", columns={"currencies_id"}), @ORM\Index(name="fk_wallets_clients1_idx", columns={"clients_id"})})
 * @ORM\Entity
 */
class Wallets
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string|null
     *
     * @ORM\Column(name="balance", type="decimal", precision=10, scale=2, nullable=true, options={"default"="0.00"})
     */
    private $balance = '0.00';

    /**
     * @var \Currencies
     *
     * @ORM\ManyToOne(targetEntity="Currencies")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="currencies_id", referencedColumnName="id")
     * })
     */
    private $currencies;

    /**
     * @var \Clients
     *
     * @ORM\ManyToOne(targetEntity="Clients")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="clients_id", referencedColumnName="id")
     * })
     */
    private $clients;

    public function getId(): ?string
    {
        return $this->id;
    }

    public function getBalance(): ?string
    {
        return $this->balance;
    }

    public function setBalance(?string $balance): self
    {
        $this->balance = $balance;

        return $this;
    }

    public function getCurrencies(): ?Currencies
    {
        return $this->currencies;
    }

    public function setCurrencies(?Currencies $currencies): self
    {
        $this->currencies = $currencies;

        return $this;
    }

    public function getClients(): ?Clients
    {
        return $this->clients;
    }

    public function setClients(?Clients $clients): self
    {
        $this->clients = $clients;

        return $this;
    }
    public static function getBalanceWalletByClientId($clientId, $entityManager)
    {
        $query = $entityManager->createQuery(
            'SELECT w.balance
        FROM App\Entity\Wallets w
        WHERE w.clients = :clients_id AND w.currencies= :currencies_id'
        )->setParameter('clients_id', $clientId)
            ->setParameter('currencies_id', 1);

        return $query->getResult();
    }


}
