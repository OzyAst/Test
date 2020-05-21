<?php

namespace Ozycast\App\DTO;

use Ozycast\App\Core\DTO;

Class Payments extends DTO
{
    /**
     * @var int
     */
    private $id;
    /**
     * @var int
     */
    private $cred_id;
    /**
     * @var string
     */
    private $data_set;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return Payments
     */
    public function setId(int $id): self
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return int
     */
    public function getCred_id(): int
    {
        return $this->cred_id;
    }

    /**
     * @param int $cred_id
     * @return Payments
     */
    public function setCred_id(int $cred_id): self
    {
        $this->cred_id = $cred_id;
        return $this;
    }

    /**
     * @return string
     */
    public function getData_set(): string
    {
        return $this->data_set;
    }

    /**
     * @param string $data_set
     * @return Payments
     */
    public function setData_set(string $data_set): self
    {
        $this->data_set = $data_set;
        return $this;
    }
}