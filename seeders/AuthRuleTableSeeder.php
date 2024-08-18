<?php

namespace app\seeders;

use diecoding\seeder\TableSeeder;

use app\models\auth\AuthRule;

/**
 * Handles the creation of seeder `AuthRule::tableName()`.
 */
class AuthRuleTableSeeder extends TableSeeder
{
    public $truncateTable = true;
    // public $locale = 'en_US';

    /**
     * @return void
     */
    public function run(): void
    {
        $this->insert(AuthRule::tableName(), [
            'name'       => 'su',
            'data'       => $this->faker->word,
            'created_at' => $this->faker->dateTime()->getTimestamp(),
            'updated_at' => $this->faker->dateTime()->getTimestamp()
        ]);

        $this->insert(AuthRule::tableName(), [
            'name'       => 'user',
            'data'       => $this->faker->word,
            'created_at' => $this->faker->dateTime()->getTimestamp(),
            'updated_at' => $this->faker->dateTime()->getTimestamp()
        ]);

        $this->insert(AuthRule::tableName(), [
            'name'       => 'guest',
            'data'       => $this->faker->word,
            'created_at' => $this->faker->dateTime()->getTimestamp(),
            'updated_at' => $this->faker->dateTime()->getTimestamp()
        ]);
    }
}
