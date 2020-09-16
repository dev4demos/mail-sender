<?php

declare (strict_types = 1);

namespace Mail\Sender\Seeders;

use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Config;
use Mail\Sender\Classes\MailMessage;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create('en');

        // $items = [
        //     'Welcome test message' => 'bobby@yahoo.com',
        //     'How to invite friends' => 'emma@hotmail.com',
        //     'Investigating services' => 'winky@gmail.com'
        // ];

        $admin = Config::get('mail.from.address') ?: $faker->unique()->safeEmail;

        foreach (range(1, 10) as $content => $sender) {
            MailMessage::create($faker->text(100))
                ->setFrom($faker->unique()->safeEmail)
                ->setTo($admin, Config::get('mail.from.name'))
                ->store();
        }
    }
}
