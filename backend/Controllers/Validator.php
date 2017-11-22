<?php

namespace Backend\Controllers;

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use \Respect\Validation\Validator as Respect;
use \Respect\Validation\Exceptions\NestedValidationException;

class Validator extends Controller
{
  protected $errors;

  public function validate($request, array $rules)
  {
    $name = '';

    foreach ($rules as $field => $rule) {
      try {
        $name = ucfirst(str_replace('_', ' ', $field));
        $rule->setName($name)->assert($request->getParam($field));
        $name = '';
      }
      catch (NestedValidationException $e) {
        $this->errors[$field] = $e->getMessages();
      }
    }

    $_SESSION['validation_errors'] = $this->errors;

    return $this;
  }

  public function failed()
  {
    return !empty($this->errors);
  }

}
