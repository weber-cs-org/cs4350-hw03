<?php

namespace Tests\Functional;

use Slim\Exception\MethodNotAllowedException;
use Slim\Exception\NotFoundException;

class LoginPageTest extends BaseTestCase
{
    /**
     * Test that the index route returns a rendered response containing the text 'SlimFramework' but not a greeting
     */
    public function testGetLoginPage()
    {
        try {
            $response = $this->runApp('GET', '/login');
        } catch (MethodNotAllowedException $e) {
        } catch (NotFoundException $e) {
        }

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertContains('Sign In', (string)$response->getBody());
        $this->assertContains('Username', (string)$response->getBody());
        $this->assertContains('Password', (string)$response->getBody());
        $this->assertContains('required', (string)$response->getBody());
    }

    /**
     * Test that the index route won't accept a post request
     */
    public function testPostLoginPageNotAllowed()
    {
        try {
            $response = $this->runApp('POST', '/login', ['test']);
        } catch (MethodNotAllowedException $e) {
        } catch (NotFoundException $e) {
        }

        $this->assertEquals(405, $response->getStatusCode());
        $this->assertContains('Method not allowed', (string)$response->getBody());
    }
}