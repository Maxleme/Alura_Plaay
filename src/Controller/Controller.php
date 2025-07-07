<?php

declare(strict_types=1);

namespace Alura\Mvc\Controller;

interface Controller
{
    /** @var \Alura\Mvc\Controller\Controller $controller */
    public function processaRequisicao(): void;
}