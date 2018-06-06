<?php

namespace App\Gitlab\Events;

class PushEvent extends Event
{
	public function pushCommit()
	{
		$this->embed->author($this->payload['user_name'], '', $this->payload['user_avatar']);
		$this->embed->title("[{$this->payload['project']['path_with_namespace']}] {$this->payload['total_commits_count']} new commit(s)");
		$this->embed->url($this->payload['project']['web_url']);
		foreach ($this->payload['commits'] as $commit) {
			$this->embed->field($commit['message'], $commit['author']['name']);
		}
		$this->sendDiscordWebHook();
	}

	public function pushTag()
	{
		//for remove the double webhook bug from gitlab : when tag pushed, gitlab send two hook, one with commit, and one without. But here we wants only one
		if ($this->payload['total_commits_count'] == 0){
			$tag = str_replace('refs/tags/', '', $this->payload['ref']);
			$this->embed->author($this->payload['user_name'], '', $this->payload['user_avatar']);
			$this->embed->title("[{$this->payload['project']['path_with_namespace']}] New tag '{$tag}' pushed");
			$this->embed->url($this->payload['project']['web_url']);
			$this->sendDiscordWebHook();
		}
	}

}
