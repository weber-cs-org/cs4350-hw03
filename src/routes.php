<?php
/**
 * HTTP Routes defined here
 */
use Slim\Http\Request;
use Slim\Http\Response;

// Get Routes
$app->get('/', App\Actions\HomeAction::class)->setName('homepage');
$app->get('/login', App\Actions\LoginAction::class)->setName('loginpage');
$app->get('/users_test/', App\Actions\UserTestAction::class)->setName('usertestpage');

// Post Routes
$app->post('/profile', App\Actions\ProfileAction::class)->setName('profilepage');
