<?php

use yii\db\Migration;

/**
 * Handles the dropping of table `timeslots`.
 */
class m180302_093902_drop_timeslots_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropTable('timeslots');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->createTable('timeslots', [
            'id' => $this->primaryKey(),
        ]);
    }
}
