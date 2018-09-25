<?php

namespace App\Actions;

use InvalidArgumentException;
use Psr\Log\LoggerInterface;
use Slim\Http\Request;
use Slim\Http\Response;
use Slim\Views\Twig;

class ProfileAction
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
        $this->log->info("Profilepage action dispatched");

        $args = $request->getParsedBody();

        if (!filter_var($args['f_username'], FILTER_VALIDATE_EMAIL)) {
            throw new InvalidArgumentException($args['f_username'] . ' is invalid');
        }

        foreach ($this->users as $user) {
            if (($args['f_username'] === $user->email) && ($args['f_password'] === '1234pass')) {
                return $this->view->render($response, 'profile.html.twig', ['name' => $user->name]);
            }
        }

        return $this->view->render($response, 'profile.html.twig', []);
    }
}