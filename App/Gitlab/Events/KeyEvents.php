<?php

namespace App\Gitlab\Events;

class KeyEvents extends Event
{
	public function keyCreated()
	{
		$this->embed->title('A ssh key was created!');
		$this->embed->field('Created by', $this->payload['username']);
		$this->sendDiscordWebHook();
	}

	public function keyRemoved()
	{
		$this->embed->title('A ssh key was removed!');
		$this->embed->field('Removed by', $this->payload['username']);
		$this->sendDiscordWebHook();
	}
}