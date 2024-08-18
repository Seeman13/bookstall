<?php

namespace app\seeders;

use diecoding\seeder\TableSeeder;
use yii\base\Exception;

use app\models\User;

/**
 * Handles the creation of seeder `User::tableName()`.
 */
class UserTableSeeder extends TableSeeder
{
    public $truncateTable = true;
    // public $locale = 'en_US';

    /**
     * @return void
     */
    public function run(): void
    {
        try {
            $hash = \Yii::$app->getSecurity()->generatePasswordHash('12345678');

            $this->insert(User::tableName(), [
                'ip_address'    => '127.0.0.1',
                'name'          => 'admin',
                'email'         => 'admin@mail.su',
                'first_name'    => 'Александр',
                'last_name'     => 'Королёв',
                'password'      => $hash,
                'created_at'    => $this->faker->dateTime()->format("Y-m-d H:i:s"),
                'updated_at'    => $this->faker->dateTime()->format("Y-m-d H:i:s"),
                'last_activity' => $this->faker->dateTime()->format("Y-m-d H:i:s")
            ]);

            $this->insert(User::tableName(), [
                'ip_address'    => '127.0.0.1',
                'name'          => 'moderator',
                'email'         => 'moderator@mail.su',
                'first_name'    => 'Moderator',
                'last_name'     => 'Moderator',
                'password'      => $hash,
                'created_at'    => $this->faker->dateTime()->format("Y-m-d H:i:s"),
                'updated_at'    => $this->faker->dateTime()->format("Y-m-d H:i:s"),
                'last_activity' => $this->faker->dateTime()->format("Y-m-d H:i:s")
            ]);

            $this->insert(User::tableName(), [
                'ip_address'    => '127.0.0.1',
                'name'          => 'user 1',
                'email'         => 'user-1@mail.ru',
                'first_name'    => 'Пользователь',
                'last_name'     => 'Сайта',
                'password'      => $hash,
                'created_at'    => $this->faker->dateTime()->format("Y-m-d H:i:s"),
                'updated_at'    => $this->faker->dateTime()->format("Y-m-d H:i:s"),
                'last_activity' => $this->faker->dateTime()->format("Y-m-d H:i:s")
            ]);
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
}
