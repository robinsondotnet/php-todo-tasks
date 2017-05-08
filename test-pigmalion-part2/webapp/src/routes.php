<?php
// Routes


$app->group('/api/v1', function () {
    $this->get('/employees', \robindotnet\Controllers\EmployeesController::class. ':getAll');
    $this->get('/employees/{id}', \robindotnet\Controllers\EmployeesController::class . ':getById');
    $this->get('/xml/employees', \robindotnet\Controllers\EmployeesController::class . ':find');
});

$app->get('/[{name}]', function ($request, $response, $args) {
    // Sample log message
    $this->logger->info("Slim-Skeleton '/' route");

    // Render index view
    return $this->renderer->render($response, 'index.phtml', $args);
});
