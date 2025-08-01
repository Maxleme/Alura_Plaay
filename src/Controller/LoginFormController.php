<?php

declare(strict_types=1);
namespace Alura\Mvc\Controller;
use Alura\Mvc\Controller\Controller;

class LoginFormController implements Controller
{
    public function processaRequisicao(): void
    {
        if(($_SESSION['logado'] ?? false) === true) {
            header('Location: /');
            return;
        }
        require_once __DIR__ ."/../../Views/login-form.php";
    }
}