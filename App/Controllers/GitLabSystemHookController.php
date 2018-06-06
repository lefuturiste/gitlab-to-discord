<?php

namespace App\Controllers;

use App\Controllers\Controller;
use App\Gitlab\Events\EventRouter;
use DI\Container;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class GitLabSystemHookController extends Controller {
	public function newEvent(ServerRequestInterface $request, ResponseInterface $response, Container $container)
	{
		$routingSuccess = (new EventRouter())->newEvent($request->getParsedBody(), $container);
		if ($routingSuccess !== false){
			return $response->withJson(['success' => true]);
		}else{
			return $response->withJson(['success' => false, 'errors' => ['The event name is not know or invalid']])->withStatus(400);
		}
	}
}
