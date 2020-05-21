<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "authors".
 *
 * @property int $id
 * @property string|null $name Имя
 *
 * @property Book $books
 */
class Author extends \yii\db\ActiveRecord
{
    public $booksCount;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'authors';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
        ];
    }

    /**
     * Gets query for [[Book]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBooks()
    {
        return $this->hasMany(Book::className(), ['author_id' => 'id']);
    }

    /**
     * AR все авторы с кол-вом книг
     * @return \yii\db\ActiveQuery
     */
    public static function authorsWithCountBookAR()
    {
        return Author::find()->select([
                '{{authors}}.*',
                'COUNT({{books}}.id) AS booksCount'
            ])
            ->joinWith('books')
            ->groupBy('{{authors}}.id');
    }

    /**
     * Вернуть всех авторов
     * @return array
     */
    public static function getAuthorsList(): array
    {
        $authors = Author::find()->all();
        $authors = ArrayHelper::map($authors, 'id', 'name');
        return $authors;
    }
}
