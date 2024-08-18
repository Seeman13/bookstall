<?php

namespace app\seeders;

use diecoding\seeder\TableSeeder;

use app\models\{Author, AuthorBook, Book};

/**
 * Handles the creation of seeder `AuthorBook::tableName()`.
 */
class AuthorBookTableSeeder extends TableSeeder
{
     public $truncateTable = true;
    // public $locale = 'en_US';

    /**
     * @return void
     */
    public function run(): void
    {
        $authors = Author::find()->all();

        foreach (Book::find()->all() as $book) {
            $this->insert(AuthorBook::tableName(), [
                'author_id' => $this->faker->randomElement($authors)->id,
                'book_id' => $book->id,
            ]);
        }
    }
}
