<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;

class HomeController
{
    private $twig;

    public function __construct(Environment $twig)
    {
        $this->twig = $twig;
    }

    public function index(): Response
    {
        $content = $this->twig->render('pages/home.html.twig');
        return new Response($content);
    }
}

?>