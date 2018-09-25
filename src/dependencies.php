<?php
/**
 * DIC configuration
 */ 

$container = $app->getContainer();

// view 
$container['view'] = function ($c) {
    $settings = $c->get('settings');
    $view = new \Slim\Views\Twig($settings['view']['template_path'], $settings['view']['twig']);
    // Add extensions
    $view->addExtension(new \Slim\Views\TwigExtension($c->get('router'), $c->get('request')->getUri()));
    $view->addExtension(new \Twig_Extension_Debug());

    return $view;
};

// flash messages
$container['flash'] = function ($c) {
    return new \Slim\Flash\Messages;
};

// monolog
$container['logger'] = function ($c) {
    $settings = $c->get('settings')['logger'];
    $logger = new \Monolog\Logger($settings['name']);
    $logger->pushProcessor(new \Monolog\Processor\UidProcessor());
    $logger->pushHandler(new \Monolog\Handler\StreamHandler($settings['path'], $settings['level']));
    return $logger;
};

// data
$container['users'] = [
    new \App\Domain\User('anne@example.com', 'Anne Anderson'),
    new \App\Domain\User('ben@example.com', 'Ben Barlow'),
    new \App\Domain\User('chris@example.com', 'Chris Christensen'),
];

$container['users_test'] = [];

// classes/objects
$container[App\Actions\HomeAction::class] = function ($c) {
    return new \App\Actions\HomeAction($c->get('view'), $c->get('logger'), $c->get('users'));
};

$container[App\Actions\UserTestAction::class] = function ($c) {
    return new \App\Actions\UserTestAction($c->get('view'), $c->get('logger'), $c->get('users_test'));
};

$container[App\Actions\LoginAction::class] = function ($c) {
    return new \App\Actions\LoginAction($c->get('view'), $c->get('logger'), [""]);
};

$container[App\Actions\ProfileAction::class] = function ($c) {
    return new \App\Actions\ProfileAction($c->get('view'), $c->get('logger'), $c->get('users'));
};
