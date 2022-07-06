<?php

use yii\db\Migration;

/**
 * Class m220705_170333_first_migration
 */
class m220705_170333_first_migration extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('url', [
            'id' => $this->primaryKey(),
            'url' => $this->string(),
            'frequency' => $this->integer(),
            'current_time' => $this->integer(),
            'count' => $this->integer(),
            'current_count' => $this->integer(),
            'create_at' => $this->timestamp()
        ]);

        $this->createTable('check', [
            'id' => $this->primaryKey(),
            'date' => $this->timestamp(),
            'url' => $this->string(),
            'code' => $this->integer(),
            'try' => $this->integer()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('url');
        $this->dropTable('check');
    }
}
