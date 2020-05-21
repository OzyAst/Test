<?php

use yii\db\Migration;

/**
 * Class m200519_132838_create_table_books
 */
class m200519_132838_create_table_books extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('books', [
            'id' => $this->primaryKey(),

            'title' => $this->string(100)
                ->comment('Название'),

            'author_id' => $this->integer()->notNull()
                ->comment('Автор'),
        ]);

        $this->addForeignKey(
            '{{%fk-book-author}}',
            '{{%books}}',
            'author_id',
            '{{%authors}}',
            'id',
            'CASCADE'
        );
        $this->createIndex(
            '{{%idx-book-author}}',
            '{{%books}}',
            'author_id'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('books');
    }
}
