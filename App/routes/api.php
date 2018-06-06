<?php
/*
|--------------------------------------------------------------------------
| Api routing
|--------------------------------------------------------------------------
|
| Register it all your api routes
|
*/
$app->get('/', [\App\Controllers\PagesController::class, 'getHome']);
$app->post('/event', [\App\Controllers\GitLabSystemHookController::class, 'newEvent'])->add(new \App\Middlewares\MustHaveTokenMiddleware($container->get('gitlab')['wh_token']));
