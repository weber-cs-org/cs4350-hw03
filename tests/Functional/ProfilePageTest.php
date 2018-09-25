<?php

namespace Tests\Functional;

use Slim\Exception\MethodNotAllowedException;
use Slim\Exception\NotFoundException;

class ProfilePageTest extends BaseTestCase
{
    public function testGetProfilePageNotAllowed()
    {
        try {
            $response = $this->runApp('GET', '/profile');
        } catch (MethodNotAllowedException $e) {
        } catch (NotFoundException $e) {
        }

        $this->assertEquals(405, $response->getStatusCode());
        $this->assertContains('Method not allowed', (string)$response->getBody());
    }

    public function testPostLoginPageSuccess00()
    {
        try {
            $response = $this->runApp('POST', '/profile', ['f_username' => 'anne@example.com', 'f_password' => '1234pass']);
        } catch (MethodNotAllowedException $e) {
        } catch (NotFoundException $e) {
        }

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertContains('Member', (string)$response->getBody());
        $this->assertContains('Hello, Anne Anderson!', (string)$response->getBody());
    }

    public function testPostLoginPageSuccess01()
    {
        try {
            $response = $this->runApp('POST', '/profile', ['f_username' => 'ben@example.com', 'f_password' => '1234pass']);
        } catch (MethodNotAllowedException $e) {
        } catch (NotFoundException $e) {
        }

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertContains('Member', (string)$response->getBody());
        $this->assertContains('Hello, Ben Barlow!', (string)$response->getBody());
    }

    public function testPostLoginPageSuccess02()
    {
        try {
            $response = $this->runApp('POST', '/profile', ['f_username' => 'chris@example.com', 'f_password' => '1234pass']);
        } catch (MethodNotAllowedException $e) {
        } catch (NotFoundException $e) {
        }

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertContains('Member', (string)$response->getBody());
        $this->assertContains('Hello, Chris Christensen!', (string)$response->getBody());
    }

    public function testPostLoginPageFail00()
    {
        try {
            $response = $this->runApp('POST', '/profile', ['f_username' => 'bob@example.com', 'f_password' => '1234pass']);
        } catch (MethodNotAllowedException $e) {
        } catch (NotFoundException $e) {
        }

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertContains('Unauthorized, Chuck Norris has been dispatch to find you!', (string)$response->getBody());
    }

    public function testPostLoginPageFail01()
    {
        try {
            $response = $this->runApp('POST', '/profile', ['f_username' => 'ben@example.com', 'f_password' => '123pas']);
        } catch (MethodNotAllowedException $e) {
        } catch (NotFoundException $e) {
        }

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertContains('Unauthorized, Chuck Norris has been dispatch to find you!', (string)$response->getBody());
    }
}
