<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%authors}}`.
 */
class m240816_115857_create_authors_table extends Migration
{
    /**
     * @return void
     */
    public function safeUp(): void
    {
        $this->createTable('{{%authors}}', [
            'id'         => $this->primaryKey()->unsigned()->comment('ID'),
            'first_name' => $this->char(25)->null()->comment('First name'),
            'last_name'  => $this->char(25)->null()->comment('Last name'),
            'created_at' => $this->timestamp()->notNull()->comment('Created at'),
            'updated_at' => $this->timestamp()->null()->comment('Updated at')
        ]);
    }

    /**
     * @return void
     */
    public function safeDown(): void
    {
        $this->dropTable('{{%authors}}');
    }
}
