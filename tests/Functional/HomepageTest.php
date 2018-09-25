<?php

namespace Tests\Functional;

include "BaseTestCase.php";

use Slim\Exception\MethodNotAllowedException;
use Slim\Exception\NotFoundException;

class HomepageTest extends BaseTestCase
{
    /**
     * Test that the index route returns a rendered response containing the text 'SlimFramework' but not a greeting
     */
    public function testGetHomepageWithoutName()
    {
        try {
            $response = $this->runApp('GET', '/');
        } catch (MethodNotAllowedException $e) {
            $this->expectExceptionMessage('Method Not Allowed');
        } catch (NotFoundException $e) {
            $this->expectExceptionMessage('Not Found');
        }

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertContains('Members', (string)$response->getBody());
        $this->assertContains('Anne', (string)$response->getBody());
        $this->assertContains('Ben', (string)$response->getBody());
        $this->assertContains('Chris', (string)$response->getBody());
        $this->assertNotContains('Hello', (string)$response->getBody());
    }

    /**
     * Test that the index route won't accept a post request
     */
    public function testPostHomepageNotAllowed()
    {
        try {
            $response = $this->runApp('POST', '/', ['test']);
        } catch (MethodNotAllowedException $e) {
            $this->expectExceptionMessage('Method Not Allowed');
        } catch (NotFoundException $e) {
            $this->expectExceptionMessage('Not Found');
        }

        $this->assertEquals(405, $response->getStatusCode());
        $this->assertContains('Method not allowed', (string)$response->getBody());
    }
}
