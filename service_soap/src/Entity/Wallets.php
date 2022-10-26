<?php

namespace App\Entity;

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
     * @var \DateTime|null
     *
     * @ORM\Column(name="created_at", type="datetime", nullable=true, options={"default"="CURRENT_TIMESTAMP"})
     */
    private $createdAt = 'CURRENT_TIMESTAMP';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updated_at", type="datetime", nullable=false, options={"default"="CURRENT_TIMESTAMP"})
     */
    private $updatedAt = 'CURRENT_TIMESTAMP';

    /**
     * @var \Clients
     *
     * @ORM\ManyToOne(targetEntity="Clients")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="clients_id", referencedColumnName="id")
     * })
     */
    private $clients;

    /**
     * @var \Currencies
     *
     * @ORM\ManyToOne(targetEntity="Currencies")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="currencies_id", referencedColumnName="id")
     * })
     */
    private $currencies;


}
