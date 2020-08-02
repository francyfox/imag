<?php

namespace App\EventListener;

use Symfony\Component\Security\Core\Security;
use Twig\Environment;

class ControllerListener {
    /**
     * @var \Twig\Environment
     */
    private $twig;

    /**
     * @var \Symfony\Component\Security\Core\Security
     */
    private $security;

    public function __construct( Environment $twig, Security $security ) {
        $this->twig     = $twig;
        $this->security = $security;
    }

    public function onKernelController($event): void {
        $this->twig->addGlobal('_post', $_POST);
        $this->twig->addGlobal('_get', $_GET);
    }
}