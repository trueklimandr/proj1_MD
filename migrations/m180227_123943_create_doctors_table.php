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
        $this->createTable('doctor', [
            'id' => $this->primaryKey(),
            'firstName' => $this->string(255),
            'lastName' => $this->string(255),
            'specialization' => $this->string(255),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('doctor');
    }
}
