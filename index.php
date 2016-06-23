<?php

require 'vendor/autoload.php';

use Zeeshan\Inspector\Inspector;

$inspector = new Inspector('e0a5c0bfd84a458e');
$person = $inspector->getProfile("kamranahmed.se@gmail.com");