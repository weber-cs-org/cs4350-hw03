<?php

namespace App\Actions;

use Psr\Log\LoggerInterface;
use Slim\Http\Request;
use Slim\Http\Response;
use Slim\Views\Twig;

final class UserTestAction
{
    protected $view;
    protected $log;
    protected $users;

    public function __construct(Twig $view, LoggerInterface $logger, array $users)
    {
        $this->view = $view;
        $this->log = $logger;
        $this->users = $users;
    }

    public function __invoke(Request $request, Response $response, array $args)
    {
        $this->log->info("Usertest action dispatched");

        return $this->view->render($response, 'index.html.twig', ['users' => $this->users]);
    }
}