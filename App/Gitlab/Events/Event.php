<?php

namespace App\Gitlab\Events;
use DI\Container;
use DiscordWebhooks\Client;
use DiscordWebhooks\Embed;

class Event {
	/**
	 * @var array
	 */
	protected $payload;
	/**
	 * @var Container
	 */
	protected $container;

	protected $message = "";

	/**
	 * @var Embed
	 */
	protected $embed;

	protected $defaultEmbedColor = 14828329;

	public function __construct(array $payload, Container $container)
	{
		$this->payload = $payload;
		$this->container = $container;
		$this->webHookClient = new Client($container->get('gitlab')['discord_wh_url']);
		$this->embed = (new Embed());
		$this->embed->color($this->defaultEmbedColor);
	}

	public function sendDiscordWebHook(){
		if(isset($this->message)){
			$this->webHookClient->message($this->message)->embed($this->embed)->send();
		}
	}
}
