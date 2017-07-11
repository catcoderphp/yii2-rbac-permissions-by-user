<?php

use yii\db\Migration;

class m130524_201442_init extends Migration
{
    public function up()
    {
        $this->createTable('user', [
            'id' => $this->primaryKey(),
            'username' => $this->string()->notNull(),
            'auth_key' => $this->string(),
            'password_hash' => $this->string()->notNull(),
            'password_reset_token' => $this->string()->defaultValue(Yii::$app->security->generateRandomString()),
            'email' => $this->string()->notNull(),
            'status' => $this->smallInteger()->notNull(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer()
        ], 'ENGINE InnoDB');

        $this->insert('user', [
            'username' => 'admin',
            'auth_key' => Yii::$app->security->generateRandomString(),
            'password_hash' => Yii::$app->security->generatePasswordHash('12345'),
            'password_reset_token' => Yii::$app->security->generateRandomString(),
            'email' => 'catcoder.php@gmail.com',
            'status' => 10,
            'created_at' => time(),
            'updated_at' => time()
        ]);
    }

    public function down()
    {
        $this->dropTable('user');
    }
}
