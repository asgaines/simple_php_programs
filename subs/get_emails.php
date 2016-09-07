<?php

/**
 * Prepares list of email addresses for subscription service by
 * removing addresses requesting removal from list and those which
 * have previously bounced. Rather memory intensive in favor of
 * processing intensive.
 */

$subscribers = [];
$unsubscribed = [];
$bounced = [];

foreach (['subscribers', 'unsubscribed', 'bounced'] as $list)
	foreach (file('emails/' . $list . '.txt') as $email) {
		$email = strtolower(trim($email));
		if (filter_var($email, FILTER_VALIDATE_EMAIL))
			if (!in_array($email, $$list))
				$$list[] = $email;
	}

$subscribers = array_diff($subscribers, $unsubscribed); // Remove unsubscribed
$subscribers = array_diff($subscribers, $bounced); // Remove bounced

foreach ($subscribers as $s)
	echo $s . PHP_EOL;

