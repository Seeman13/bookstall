<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%subscribers}}`.
 */
class m240818_144731_create_subscribers_table extends Migration
{
    /**
     * @return void
     */
    public function safeUp(): void
    {
        $this->createTable('subscribers', [
            'id'    => $this->primaryKey()->unsigned()->comment('ID'),
            'email' => $this->char(255)->notNull()->unique()->comment('Email'),
            'date'  => $this->integer()->unsigned()->notNull()->comment('Created at')
        ]);

        $this->addCommentOnTable('subscribers', 'Subscribers at news');
    }

    /**
     * @return void
     */
    public function safeDown(): void
    {
        $this->dropTable('subscribers');
    }
}
