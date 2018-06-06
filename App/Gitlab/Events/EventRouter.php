<?php

namespace App\Gitlab\Events;

use App\Gitlab\Events\KeyEvents;
use App\Gitlab\Events\MergeEvent;
use App\Gitlab\Events\ProjectEvents;
use App\Gitlab\Events\PushEvent;
use App\Gitlab\Events\UserEvents;
use DI\Container;

class EventRouter
{
	public $routing = [
		'project_create' => [ProjectEvents::class, 'projectCreated'],
		'project_destroy' => [ProjectEvents::class, 'projectDestroyed'],
		'project_rename' => [ProjectEvents::class, 'projectRenamed'],
		'user_add_to_team' => [UserEvents::class, 'newTeamMember'],
		'user_create' => [UserEvents::class, 'userCreated'],
		'user_destroy' => [UserEvents::class, 'userRemoved'],
		'user_rename' => [UserEvents::class, 'userRenamed'],
		'key_create' => [KeyEvents::class, 'keyCreated'],
		'key_destroy' => [KeyEvents::class, 'keyRemoved'],
		'push' => [PushEvent::class, 'pushCommit'],
		'tag_push' => [PushEvent::class, 'pushTag'],
		'merge_request' => [MergeEvent::class, 'mergeRequest']
	];

	public function newEvent(array $payload, Container $container)
	{
		$eventName = isset($payload['event_name']) ? $payload['event_name'] : $payload['object_kind'];
		if (isset($this->routing[$eventName])) {
			$class = $this->routing[$eventName][0];
			$method = $this->routing[$eventName][1];
			$event = new $class($payload, $container);
			$event->$method();
		} else {
			return false;
		}
	}
}