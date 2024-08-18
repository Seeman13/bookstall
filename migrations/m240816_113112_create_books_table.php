<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%books}}`.
 */
class m240816_113112_create_books_table extends Migration
{
    /**
     * @return void
     */
    public function safeUp(): void
    {
        $this->createTable('{{%books}}', [
            'id'          => $this->primaryKey()->unsigned()->comment('ID'),
            'name'        => $this->char(200)->notNull()->comment('Name of book'),
            'release'     => $this->char(4)->notNull()->comment('Release date'),
            'description' => $this->text()->null()->comment('Description of book'),
            'isbn'        => $this->char(13)->null()->comment('ISBN number'),
            'image'       => $this->char(100)->null()->comment('Image of book'),
            'created_at'  => $this->timestamp()->notNull()->comment('Created at'),
            'updated_at'  => $this->timestamp()->null()->comment('Updated at')
        ]);
    }

    /**
     * @return void
     */
    public function safeDown(): void
    {
        $this->dropTable('{{%books}}');
    }
}
