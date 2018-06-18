<?php

use yii\db\Migration;

/**
 * Handles the creation of table `news`.
 */
class m180102_203159_create_goods_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->createTable('goods', [
            'id' => $this->string(36)->notNull()->unique(),
            'title' => $this->string(36),
            'alias' => $this->string(),//for image
            'category' => $this->smallInteger(),
            'chapter' => $this->smallInteger(),
            'rubric' => $this->smallInteger(),
            'description' => $this->string(36),
            'price' => $this->float(),
            'work_duration' => $this->smallInteger(),
            'date_start' => $this->timestamp(),
            'date_order' => $this->timestamp(),
            'date_end' => $this->timestamp(),
            'materials' => $this->text(),
            'tags' => $this->text(),
            'service_recomendation' => $this->string(36),
            'size' => $this->string(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropTable('goods');
    }
}
