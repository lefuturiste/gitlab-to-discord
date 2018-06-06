<?php

namespace App\Gitlab\Events;

class MergeEvent extends Event
{
	public function mergeRequest()
	{
		$this->embed->author($this->payload['user']['name'], '', $this->payload['user']['avatar_url']);
		$this->embed->title("[{$this->payload['project']['path_with_namespace']}] New merge request");
		$this->embed->url($this->payload['project']['web_url']);
		$this->sendDiscordWebHook();
	}

}