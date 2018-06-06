<?php

namespace App\Gitlab\Events;

class UserEvents extends Event
{
	public function newTeamMember()
	{
		$this->embed->title('A user was added to a project!');
		$this->embed->url($this->container->get('gitlab')['base_url'] . $this->payload['project_path_with_namespace']);
		$this->embed->field('New user', $this->payload['user_name'] . " (" . $this->payload['user_email'] . ")");
		$this->embed->field('Project', $this->payload['project_name'] . " (" . $this->payload['project_path_with_namespace'] . ")");
		$this->sendDiscordWebHook();
	}

	public function userCreated()
	{
		$this->embed->title('A user was created!');
		$this->embed->field('Name', $this->payload['name']);
		$this->embed->field('Username', $this->payload['username']);
		$this->embed->field('Email', $this->payload['email']);
		$this->sendDiscordWebHook();
	}

	public function userRemoved()
	{
		$this->embed->title('A user was removed!');
		$this->embed->field('Name', $this->payload['name']);
		$this->embed->field('Username', $this->payload['username']);
		$this->embed->field('Email', $this->payload['email']);
		$this->sendDiscordWebHook();
	}

	public function userRenamed()
	{
		$this->embed->title('A user was renamed!');
		$this->embed->field('Old username', $this->payload['old_username']);
		$this->embed->field('New username', $this->payload['username']);
		$this->embed->field('Name', $this->payload['name']);
		$this->embed->field('Email', $this->payload['email']);
		$this->sendDiscordWebHook();
	}
}
