<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%author_books}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%authors}}`
 * - `{{%books}}`
 */
class m240816_120612_create_junction_table_for_author_and_books_tables extends Migration
{
    /**
     * @return void
     */
    public function safeUp(): void
    {
        $this->createTable('{{%author_books}}', [
            'author_id' => $this->integer()->unsigned()->notNull()->comment('Author ID'),
            'book_id' => $this->integer()->unsigned()->notNull()->comment('Book ID'),
            'PRIMARY KEY(author_id, book_id)',
        ]);

        // creates index for column `author_id`
        $this->createIndex(
            '{{%idx-author_books-author_id}}',
            '{{%author_books}}',
            'author_id'
        );

        // add foreign key for table `{{%authors}}`
        $this->addForeignKey(
            '{{%fk-author_books-author_id}}',
            '{{%author_books}}',
            'author_id',
            '{{%authors}}',
            'id',
            'CASCADE'
        );

        // creates index for column `book_id`
        $this->createIndex(
            '{{%idx-author_books-book_id}}',
            '{{%author_books}}',
            'book_id'
        );

        // add foreign key for table `{{%books}}`
        $this->addForeignKey(
            '{{%fk-author_books-book_id}}',
            '{{%author_books}}',
            'book_id',
            '{{%books}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * @return void
     */
    public function safeDown(): void
    {
        // drops foreign key for table `{{%authors}}`
        $this->dropForeignKey(
            '{{%fk-author_books-author_id}}',
            '{{%author_books}}'
        );

        // drops index for column `author_id`
        $this->dropIndex(
            '{{%idx-author_books-author_id}}',
            '{{%author_books}}'
        );

        // drops foreign key for table `{{%books}}`
        $this->dropForeignKey(
            '{{%fk-author_books-book_id}}',
            '{{%author_books}}'
        );

        // drops index for column `book_id`
        $this->dropIndex(
            '{{%idx-author_books-book_id}}',
            '{{%author_books}}'
        );

        $this->dropTable('{{%author_books}}');
    }
}
