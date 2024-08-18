<?php

namespace app\seeders;

use diecoding\seeder\TableSeeder;
use app\models\Book;

/**
 * Handles the creation of seeder `Book::tableName()`.
 */
class BookTableSeeder extends TableSeeder
{
    public $truncateTable = true;
    // public $locale = 'en_US';

    /**
     * @return void
     */
    public function run(): void
    {
        $count = 100;
        for ($i = 0; $i < $count; $i++) {
            $this->insert(Book::tableName(), [
                'name'        => $this->faker->name,
                'release'     => $this->faker->date('Y'),
                'description' => $this->faker->realText(),
                'isbn'        => $this->faker->randomNumber(),
                'image'       => null,
                'created_at'  => $this->faker->dateTime()->format("Y-m-d H:i:s"),
                'updated_at'  => $this->faker->dateTime()->format("Y-m-d H:i:s"),
            ]);
        }
    }
}
