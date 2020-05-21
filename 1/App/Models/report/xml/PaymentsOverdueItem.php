<?php

namespace Ozycast\App\Models\report\xml;

use DOMDocument;
use DOMElement;

Class PaymentsOverdueItem
{
    const VALIDATE_SCHEMA = "App/xml/validate/overdueItem.xsd";

    private $document = null;
    private $item = null;
    private $payment_id;
    private $cred_id;
    private $overdue;

    public function __construct()
    {
        $this->document = new DOMDocument();
        $this->item = $this->document->createElement('payment');
        $this->document->appendChild($this->item);
    }

    public function setPayment_id($value): self
    {
        $this->payment_id = $value;
        $this->item->setAttribute("id", $value);
        return $this;
    }

    public function setCred_id($value): self
    {
        $this->cred_id = $value;
        $this->item->appendChild($this->document->createElement("cred_id", $value));
        return $this;
    }

    public function setOverdue($value): self
    {
        $this->overdue = $value;
        $this->item->appendChild($this->document->createElement("overdue", $value));
        return $this;
    }

    public function getItem(): DOMElement
    {
        return $this->item;
    }

    /**
     * Проверка элемента согласно схеме
     * @return bool
     */
    public function check(): bool
    {
        libxml_use_internal_errors(true);
        $result = $this->document->schemaValidate(self::VALIDATE_SCHEMA);
        return $result;
    }
}