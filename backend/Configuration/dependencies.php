<?php

use Backend\Views\Factory;

$container = $app->getContainer();

$container['csrf'] = function ($container) {
    return new \Slim\Csrf\Guard;
};

$container['flash'] = function ($container) {
    return new \Slim\Flash\Messages;
};

$container['view'] = function ($container) {
  $site = $container->get('settings')['site'];
  $view = Factory::getEngine();
  $view->addExtension(new \Slim\Views\TwigExtension(
    $container->router,
    $container->request->getUri()
  ));
  if (IS_DEVELOPMENT) { $view->addExtension(new Twig_Extension_Debug()); }
  $view->getEnvironment()->addGlobal('flash', $container->flash);
  $view->getEnvironment()->addGlobal('site', $site);
  return $view;
};
