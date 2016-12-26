<?php
class email {

	public static function send($to, $from, $subject, $body, $html_body = NULL) {
		$message = Swift_Message::newInstance()
			->setTo($to)
			->setFrom($from)
			->setSubject($subject)
		;

		if ($html_body !== NULL) {
			$message->setBody($html_body, 'text/html');
			$message->addPart($body, 'text/plain');
		} else {
			$message->setBody($body);
		}

		$transport = Swift_MailTransport::newInstance();
		return Swift_Mailer::newInstance($transport)->send($message);
	}

}
