<?php

use yii\db\Migration;

/**
 * Handles the creation of table `timeslots`.
 */
class m180228_145423_create_timeslots_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('timeslots', [
            'id' => $this->primaryKey(),
            'id_md' => $this->integer(),
            'date' => $this->date(),
            'time' => $this->time()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('timeslots');
    }
}
