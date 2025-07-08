<?php

declare(strict_types=1);
namespace Alura\Mvc\Controller;

class LogoutController implements Controller
{
    public function processaRequisicao(): void
    {
        unset($_SESSION['logado']);
        header("Location: /login");
    }
}