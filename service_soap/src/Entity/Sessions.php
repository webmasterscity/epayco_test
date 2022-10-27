<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

/**
 * Sessions
 *
 * @ORM\Table(name="sessions", indexes={@ORM\Index(name="fk_sessions_clients1_idx", columns={"clients_id"})})
 * @ORM\Entity
 */
class Sessions
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
     * @var \DateTime|null
     *
     * @ORM\Column(name="expires_at", type="datetime", nullable=true)
     */
    private $expiresAt;

    /**
     * @var string|null
     *
     * @ORM\Column(name="uuid", type="string", length=255, nullable=true)
     */
    private $uuid;

    /**
     * @var string|null
     *
     * @ORM\Column(name="amount", type="decimal", precision=10, scale=2, nullable=true, options={"default"="0.00"})
     */
    private $amount = '0.00';

    /**
     * @var \Clients
     *
     * @ORM\ManyToOne(targetEntity="Clients")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="clients_id", referencedColumnName="id")
     * })
     */

    private $clients;

    private $status = 0;

    public function getId(): ?string
    {
        return $this->id;
    }

    public function getExpiresAt(): ?\DateTimeInterface
    {
        return $this->expiresAt;
    }



    public function getUuid(): ?string
    {
        return $this->uuid;
    }

    public function setUuid(?string $uuid): self
    {
        $this->uuid = $uuid;

        return $this;
    }

    public function getAmount(): ?string
    {
        return $this->amount;
    }

    public function setAmount(?string $amount): self
    {
        $this->amount = $amount;

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
    public function setExpiresAt(): self
    {
        $this->expiresAt = new \DateTime(date("Y-m-d H:i:s", strtotime('+1 hours')));

        return $this;
    }
    public function setExpires(): self
    {
        $this->expiresAt = new \DateTime(date("Y-m-d H:i:s"));

        return $this;
    }
    public function getStatus(): ?int
    {
        return $this->status;
    }
    public function setStatus(?int $status): self
    {
        $this->status = $status;

        return $this;
    }
}
