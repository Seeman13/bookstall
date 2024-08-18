<?php

namespace app\seeders;

use diecoding\seeder\TableSeeder;

use app\models\auth\{AuthAssignment, AuthItem};

/**
 * Handles the creation of seeder `AuthAssignment::tableName()`.
 */
class AuthAssignmentTableSeeder extends TableSeeder
{
     public $truncateTable = true;
    // public $locale = 'en_US';

    /**
     * @return void
     */
    public function run(): void
    {
        $authItem = AuthItem::find()->all();

        $count = 4;
        for ($i = 1; $i < $count; $i++) {
            $this->insert(AuthAssignment::tableName(), [
                'item_name'  => $this->faker->randomElement($authItem)->name,
                'user_id'    => $i,
                'created_at' => $this->faker->dateTime()->getTimestamp(),
            ]);
        }
    }
}
