<?php

namespace App\Middlewares;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class MustHaveTokenMiddleware
{

	private $token;
	private $header = 'X-Gitlab-Token';

	public function __construct($token)
	{
		$this->token = $token;
	}

	public function __invoke(ServerRequestInterface $request, ResponseInterface $response, $next)
	{
		if ($request->hasHeader($this->header)) {
			if ($request->getHeader($this->header)[0] == $this->token){
				return $next($request, $response);
			}else {
				return $response->withJson([
					'success' => false,
					'errors' => [
						'Invalid authorization token'
					]
				])->withStatus(401);
			}
		} else {
			return $response->withJson([
				'success' => false,
				'errors' => [
					'Must be authenticated with a authorization token'
				]
			])->withStatus(401);
		}
	}
}