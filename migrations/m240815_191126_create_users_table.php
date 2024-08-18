<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%users}}`.
 */
class m240815_191126_create_users_table extends Migration
{
    /**
     * @return void
     */
    public function safeUp(): void
    {
        $this->createTable('{{%users}}', [
            'id'                      => $this->primaryKey()->unsigned()->comment('ID'),
            'ip_address'              => $this->char(45)->notNull()->comment('IP Address at registration'),
            'name'                    => $this->char(20)->notNull()->comment('Login (username)'),
            'email'                   => $this->char(100)->notNull()->comment('Email address'),
            'phone'                   => $this->char(20)->null()->comment('Telephone number'),
            'first_name'              => $this->char(20)->null()->comment('First name'),
            'last_name'               => $this->char(20)->null()->comment('Last name'),
            'password'                => $this->char(255)->comment('Password'),
            'forgotten_password_code' => $this->char(255)->null()->comment('Forgotten password code'),
            'auth_key'                => $this->char(32)->null()->comment('Auth key'),
            'created_at'              => $this->timestamp()->notNull()->comment('Created at'),
            'updated_at'              => $this->timestamp()->null()->comment('Updated at'),
            'last_activity'           => $this->timestamp()->null()->comment('Last activity'),
            'deleted_at'              => $this->timestamp()->null()->comment('Deleted at'),
        ]);
    }

    /**
     * @return void
     */
    public function safeDown(): void
    {
        $this->dropTable('{{%users}}');
    }
}
