<?php

namespace app\seeders;

use diecoding\seeder\TableSeeder;
use app\models\Author;

/**
 * Handles the creation of seeder `Author::tableName()`.
 */
class AuthorTableSeeder extends TableSeeder
{
    public $truncateTable = true;
    // public $locale = 'en_US';

    /**
     * @return void
     */
    public function run(): void
    {
        $count = 20;
        for ($i = 0; $i < $count; $i++) {
            $this->insert(Author::tableName(), [
                'first_name' => $this->faker->word,
                'last_name'  => $this->faker->word,
                'created_at' => $this->faker->dateTime()->format("Y-m-d H:i:s"),
                'updated_at' => $this->faker->dateTime()->format("Y-m-d H:i:s"),
            ]);
        }
    }
}
