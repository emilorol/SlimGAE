<?php

namespace Backend\Middlewares;

class ValidationErrors extends Middleware
{
  public function __invoke($request, $response, $next)
  {
    if (isset($_SESSION['validation_errors']))
    {
      $this->container->view->getEnvironment()->addGlobal('validation_errors', $_SESSION['validation_errors']);
      unset($_SESSION['validation_errors']);
    }

    $response = $next($request, $response);

    return $response;
  }

}
