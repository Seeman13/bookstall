<?php

namespace app\seeders;

use diecoding\seeder\TableSeeder;

use app\models\auth\{AuthItemChild, AuthItem};

/**
 * Handles the creation of seeder `AuthItemChild::tableName()`.
 */
class AuthItemChildTableSeeder extends TableSeeder
{
     public $truncateTable = true;
    // public $locale = 'en_US';

    /**
     * @return void
     */
    public function run(): void
    {
        $authItem = AuthItem::find()->all();

        $count = 2;
        for ($i = 0; $i < $count; $i++) {
            $this->insert(AuthItemChild::tableName(), [
                'parent' => $this->faker->randomElement($authItem)->name,
				'child' => $this->faker->randomElement($authItem)->name,
            ]);
        }
    }
}
