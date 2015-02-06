<?php

// Require autoloader
require_once __DIR__ . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php';

// Create the Transport
$transport = Swift_SmtpTransport::newInstance('relay.odisee.be', 25);

// Create the Mailer using your created Transport
$mailer = Swift_Mailer::newInstance($transport);

// Create a message
$message = Swift_Message::newInstance('Lorem Ipsum')
	->setFrom(array('johndoe@example.org' => 'John Doe'))
	->setTo(array(
		'blackhole@bram.us' => 'blackhole'
	))
	->setBody(strip_tags(file_get_contents('assets/content.html')))
	->addPart(file_get_contents('assets/content.html'), 'text/html');

// Send it (or at least try to)
if(!$mailer->send($message, $errors)) {
	echo 'Mailer Error: ';
	print_r($errors);
} else {
	echo 'Message sent!';
}

// EOF