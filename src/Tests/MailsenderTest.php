<?php

declare (strict_types = 1);

namespace Mail\Sender\Tests;

use Illuminate\Support\Facades\Session;
use Tests\TestCase;

class MailsenderTest extends TestCase
{
    public function mailsProvider()
    {
        $data = [
            'message_content' => 'The way to find the world’s best remote talent',
            'sender' => 'bobby@yahoo.com'
        ];

        return [
            [[], 200, 'GET'],
            [$data, 201]
        ];
    }

    /**
     * @dataProvider mailsProvider
     */
    public function testMailSenderAPI(
        array $data,
        int $statusCode,
        string $http = 'POST',
        string $path = '/mail'
    ) {
        $data['_token'] = csrf_token();

        $this->call($http, $path, $data)->assertStatus($statusCode);
    }

    protected function setUp(): void
    {
        parent::setUp();

        Session::start();

        // Refresh the database and run all database seeds...
        $this->artisan('cache:clear');
        // $this->artisan('config:cache');
        $this->artisan('migrate:refresh --seed', [
            // 'name' => 'Jane', '--fieldsFile' => 'xyz.json'
        ]);
    }

    // public static function setUpBeforeClass(): void {
    //     //
    // }

    // public static function tearDownAfterClass(): void
    // {
    // }
}
