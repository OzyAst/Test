<?php

use yii\db\Migration;

/**
 * Class m200519_132746_create_table_authors
 */
class m200519_132746_create_table_authors extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('authors', [
            'id' => $this->primaryKey(),

            'name' => $this->string(100)->notNull()
                ->comment('Имя'),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('authors');
    }
}
