<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%sessions}}`.
 */
class m240815_183911_create_sessions_table extends Migration
{
    /**
     * @return void
     */
    public function safeUp(): void
    {
        $this->createTable('{{%sessions}}', [
            'id'     => $this->char(40)->notNull()->comment('ID'),
            'expire' => $this->integer()->unsigned()->comment('Expire'),
            'data'   => $this->binary()->comment('Data')
        ]);

        $this->addPrimaryKey('sessions_pk', 'sessions', 'id');
        $this->addCommentOnTable('sessions', 'Sessions');
    }

    /**
     * @return void
     */
    public function safeDown(): void
    {
        $this->dropTable('{{%sessions}}');
    }
}
