<?php

namespace app\modules\api\v1\models;

/**
 * This is the model class for table "missions".
 */
class Book extends \app\models\Book
{
    /**
     * Переименование имен атрибутов
     * @return array - список полей
     */
    public function fields()
    {
        return [
            'id' => 'id',
            'title' => 'title',
            'author' => function ($model) {
                return $model->author->name;
            },
        ];
    }
}
