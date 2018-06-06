<?php

namespace App\Gitlab\Events;

class ProjectEvents extends Event
{
	public function projectCreated()
	{
		$this->embed->title('New Project created!');
		$this->embed->url($this->container->get('gitlab')['base_url'] . $this->payload['path_with_namespace']);
		$this->embed->field('Name', $this->payload['name'] . " (" . $this->payload['path_with_namespace'] . ")");
		$this->embed->field('Created by', $this->payload['owner_name'] . " (" . $this->payload['owner_email'] . ")");
		$this->sendDiscordWebHook();
	}

	public function projectDestroyed()
	{
		$this->embed->title('A project was destroyed!');
		$this->embed->field('Name', $this->payload['name'] . " (" . $this->payload['path_with_namespace'] . ")");
		$this->embed->field('Created by', $this->payload['owner_name'] . " (" . $this->payload['owner_email'] . ")");
		$this->sendDiscordWebHook();
	}


	public function projectRenamed()
	{
		$this->embed->title('A project was renamed!');
		$this->embed->field('Old name', $this->payload['old_path_with_namespace']);
		$this->embed->field('Actual name', $this->payload['name'] . " (" . $this->payload['path_with_namespace'] . ")");
		$this->embed->field('Created by', $this->payload['owner_name'] . " (" . $this->payload['owner_email'] . ")");
		$this->sendDiscordWebHook();
	}
}