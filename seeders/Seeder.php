<?php

namespace app\seeders;

use diecoding\seeder\TableSeeder;

/**
 * Default Seeder
 */
class Seeder extends TableSeeder
{
    /**
     * Default execution
     *
     * @return void
     */
    public function run(): void
    {
        UserTableSeeder::create()->run();

        // Auth block
        AuthRuleTableSeeder::create()->run();
        AuthItemTableSeeder::create()->run();
        AuthItemChildTableSeeder::create()->run();
        AuthAssignmentTableSeeder::create()->run();

        // Books block
        BookTableSeeder::create()->run();
        AuthorTableSeeder::create()->run();
        AuthorBookTableSeeder::create()->run();
    }
}
