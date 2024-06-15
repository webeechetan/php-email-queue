<?php

require 'vendor/autoload.php';
require 'config.php';

use EmailQueue\QueueManager;

$queueManager = new QueueManager();
$queueManager->processJobs();
