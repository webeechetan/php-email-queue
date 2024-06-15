<?php

require 'vendor/autoload.php';
require 'config.php';

use EmailQueue\SendEmailJob;
use EmailQueue\QueueManager;

$queueManager = new QueueManager();

for ($i = 0; $i < 2000; $i++) {
    $email = [
        'recipients' => ['recipient' . $i . '@example.com'],
        'subject' => 'Subject ' . $i,
        'body' => 'Email body content ' . $i,
        'headers' => ['From: sender@example.com']
    ];
    $job = new SendEmailJob($email);
    $queueManager->addJob($job);
}
