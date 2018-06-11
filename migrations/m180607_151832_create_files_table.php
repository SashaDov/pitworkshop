<?php

use yii\db\Migration;

/**
 * Handles the creation of table `files`.
 */
class m180607_151832_create_files_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('files', [
            'id' => $this->string(36)->notNull()->unique(),
            'document' => $this->string(250),
            'entity_id' => $this->string(36),
            'entity_type' => $this->string(100),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('files');
    }
}
