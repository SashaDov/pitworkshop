<?php

use yii\db\Migration;

/**
 * Handles the creation of table `lang`.
 */
class m180607_100449_create_lang_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('lang', [
            'uuid' => $this->string(36)->notNull()->unique(),
            'entity_type' => $this->string(100),
            'en' => $this->text(),
            'ru' => $this->text(),
            'de' => $this->text(),
            'fr' => $this->text(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('lang');
    }
}
