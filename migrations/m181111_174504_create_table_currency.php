<?php

use yii\db\Migration;

/**
 * Class m181111_174504_create_table_currency
 */
class m181111_174504_create_table_currency extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('currency', [
            'id' => $this->string(36)->notNull()->unique(),
            'vchcode' => $this->string(36),
            'vname' => $this->string(),
            'vcurs' => $this->string(36),
            'vcode' => $this->string(36),
            'vnom' => $this->string(36),
            'date_created' => $this->timestamp(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('currency');
    }
}
