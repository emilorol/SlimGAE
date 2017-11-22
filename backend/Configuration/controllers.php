<?php

$container = $app->getContainer();

// Register controllers below
// It will be nice if you don't have to do it manually,
// but is is not that bad either, right? !-)

$container['Pages'] = function ($container) {
  return new \Backend\Controllers\Pages($container);
};

$container['Validator'] = function ($container) {
  return new \Backend\Controllers\Validator($container);
};
