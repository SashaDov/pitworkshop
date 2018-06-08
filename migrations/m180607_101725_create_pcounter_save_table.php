<?php

use yii\db\Migration;

/**
 * Handles the creation of table `pcounter_save`.
 */
class m180607_101725_create_pcounter_save_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('pcounter_save', [
            'save_name' => $this->string(10)->unique()->notNull(),
            'save_value' => $this->integer(10)->notNull()->unsigned(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('pcounter_save');
    }
}
