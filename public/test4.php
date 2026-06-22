<?php
$_SERVER['REQUEST_URI'] = '/dashboard_fitness_club_tunja/public/login';
$_SERVER['SCRIPT_NAME'] = '/dashboard_fitness_club_tunja/public/test4.php';
require __DIR__.'/../vendor/autoload.php';
$app = require_once __DIR__.'/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);
$response = $kernel->handle(
    $request = Illuminate\Http\Request::capture()
);
echo "Status: " . $response->getStatusCode() . "<br>";
echo substr($response->getContent(), 0, 500);
