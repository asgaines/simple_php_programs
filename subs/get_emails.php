<?php

/**
 * Prepares list of email addresses for subscription service by
 * removing addresses requesting removal from list and those which
 * have previously bounced. Rather memory intensive in favor of
 * processing intensive.
 */


class SubscriptionManager
{
	public $subscribers = [];
	public $unsubscribed = [];
	public $bounced = [];

	public function __construct()
	{
		$this->loadEmails();
		$this->filterInvalidEmails();
	}

	public function printSubscribers()
	{
		foreach ($this->subscribers as $email)
			echo $email . PHP_EOL;
	}

	private function loadEmails()
	{
		foreach (['subscribers', 'unsubscribed', 'bounced'] as $list)
			foreach (file('emails/' . $list . '.txt') as $email) {
				$email = strtolower(trim($email));
				if (filter_var($email, FILTER_VALIDATE_EMAIL))
					if (!in_array($email, $this->$list))
						$this->$list[] = $email;
			}
	}

	private function filterInvalidEmails()
	{
		$this->subscribers = array_diff($this->subscribers, $this->unsubscribed); // Remove unsubscribed
		$this->subscribers = array_diff($this->subscribers, $this->bounced); // Remove bounced
	}
}

$subscriptionManager = new SubscriptionManager();
$subscriptionManager->printSubscribers();

