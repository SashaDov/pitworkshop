<?php

use yii\db\Migration;

/**
 * Class m180607_080142_pcounter_users
 */
class m180607_080142_pcounter_users extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('pcounter_users', [
            'user_ip' => $this->string(255)->unique()->notNull(),
            'user_time' => $this->integer(10)->notNull()->unsigned(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('pcounter_users');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180607_080142_pcounter_users cannot be reverted.\n";

        return false;
    }
    */
}
