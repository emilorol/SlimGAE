<?php

// Validation Errors
$app->add(new \Backend\Middlewares\ValidationErrors($container));

// Old Inputs
$app->add(new \Backend\Middlewares\OldInput($container));

// Campaign Tracking and Mobile detection
$app->add(new \Backend\Middlewares\CampaignTracking($container));

// CSRF
$app->add(new \Backend\Middlewares\CsrfView($container));
$app->add($container->get('csrf'));
