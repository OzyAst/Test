<?php

namespace Ozycast\App\Models\report\xml;

use PDO;
use DOMDocument;
use PDOStatement;
use Ozycast\App\Models\report\log\Log;

Class PaymentsOverdue
{
    const FILE_TEMPLATE = "App/xml/template/overdue.xml";
    const FILE_RESULT = "App/xml/result/overdue.xml";

    private $file = null;

    public function __construct()
    {
        $this->getTemplate();
    }

    /**
     * Создать файл
     * @param \PDOStatement $paymentsStmt
     */
    public function create(PDOStatement $paymentsStmt)
    {
        while ($payment = $paymentsStmt->fetch()) {
            $data_set = unserialize($payment->data_set);
            if ($data_set['overdue'] == 0)
                continue;

            $item = new PaymentsOverdueItem();
            $item->setPayment_id($payment->id)
                 ->setCred_id($payment->cred_id)
                 ->setOverdue($data_set['overdue']);

            if ($item->check()) {
                $this->addItem($item);
            } else {
                Log::add($payment->cred_id);
            }
        }

        $this->save();
    }

    /**
     * Добавить запись в корень
     * @param PaymentsOverdueItem $item
     */
    public function addItem(PaymentsOverdueItem $item)
    {
        $node = $this->file->importNode($item->getItem(), true);
        $this->file->firstChild->appendChild($node);
    }

    /**
     * Сохранить файл
     */
    public function save()
    {
        // Не нашел способа форматирования документа не занимая доп.памяти. Если знаете подскажите!
        //$this->file->loadXML($this->file->saveXML());
        $this->file->save(self::FILE_RESULT);
    }

    /**
     * Получить шаблон
     */
    private function getTemplate()
    {
        if ($this->file)
            return;

        $this->file = new DOMDocument();
        $this->file->load(self::FILE_TEMPLATE, true);

        $this->file->formatOutput = true;
        $this->file->preserveWhiteSpace = false;
    }
}