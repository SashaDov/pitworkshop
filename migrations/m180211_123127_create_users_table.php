<?php

use yii\db\Migration;

/**
 * Handles the creation of table `users`.
 */
class m180211_123127_create_users_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->createTable('users', [
            'id' => $this->primaryKey(),
            'username' => $this->string(100),
            'password' => $this->string(100),
            'auth_key' => $this->text(),
            'access_token' => $this->string(100),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropTable('users');
    }
}
