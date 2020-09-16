<?php

declare (strict_types = 1);

namespace Mail\Sender\Tests;

use Tests\TestCase;

class MailsenderTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testBasicTest()
    {
        $response = $this->get('/mail');

        $response->assertStatus(200);
    }
}
