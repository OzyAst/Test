<?php
namespace app\modules\api\v1\controllers;

use app\modules\api\v1\models\Book;
use yii\data\ActiveDataProvider;
use yii\rest\ActiveController;

class BookController extends ActiveController
{
    public $modelClass = Book::class;

    public function verbs()
    {
        $verbs = parent::verbs();
        $verbs["list"] = ['GET'];
        $verbs["by-id"] = ['GET'];
        $verbs["update"] = ['POST'];
        $verbs["delete-id"] = ['DELETE'];
        return $verbs;
    }

    public function actions()
    {
        $actions = parent::actions();

        $actions['list'] = $actions['index'];
        $actions['by-id'] = $actions['view'];
        $actions['delete-id'] = $actions['delete'];

        $actions['list']['prepareDataProvider'] = function ($action) {
            return new ActiveDataProvider([
                'query' => $this->modelClass::find()->with('author'),
            ]);
        };

        return $actions;
    }
}