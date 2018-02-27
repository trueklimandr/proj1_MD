<?php

use yii\db\Migration;

/**
 * Handles the creation of table `doctors`.
 */
class m180227_123943_create_doctors_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('doctors', [
            'id' => $this->primaryKey(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('doctors');
    }
}
