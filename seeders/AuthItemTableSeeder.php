<?php

namespace app\seeders;

use diecoding\seeder\TableSeeder;

use app\models\auth\{AuthItem, AuthRule};

/**
 * Handles the creation of seeder `AuthItem::tableName()`.
 */
class AuthItemTableSeeder extends TableSeeder
{
     public $truncateTable = true;
    // public $locale = 'en_US';

    /**
     * @return void
     */
    public function run(): void
    {
        $authRule = AuthRule::find()->all();

        $this->insert(AuthItem::tableName(), [
            'name'        => 'admin',
            'type'        => 1,
            'description' => 'Администратор',
            'rule_name'   => $this->faker->randomElement($authRule)->name,
            'data'        => $this->faker->word,
            'created_at'  => $this->faker->dateTime()->getTimestamp(),
            'updated_at'  => $this->faker->dateTime()->getTimestamp(),
        ]);

        $this->insert(AuthItem::tableName(), [
            'name'        => 'moderator',
            'type'        => 2,
            'description' => 'Модератор',
            'rule_name'   => $this->faker->randomElement($authRule)->name,
            'data'        => $this->faker->word,
            'created_at'  => $this->faker->dateTime()->getTimestamp(),
            'updated_at'  => $this->faker->dateTime()->getTimestamp(),
        ]);

        $this->insert(AuthItem::tableName(), [
            'name'        => 'user',
            'type'        => 3,
            'description' => 'Пользователь',
            'rule_name'   => $this->faker->randomElement($authRule)->name,
            'data'        => $this->faker->word,
            'created_at'  => $this->faker->dateTime()->getTimestamp(),
            'updated_at'  => $this->faker->dateTime()->getTimestamp(),
        ]);
    }
}
