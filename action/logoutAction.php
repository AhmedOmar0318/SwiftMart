<?php
include "../../private/connSwiftMart.php";
require '../vendor/autoload.php';
require_once('logger.php');

use Monolog\Logger;

session_start();

$logger = new Logger('Logout Attempt.');
$logger->pushHandler(new ActivityLogger($conn));
$logger->info('Successful. User ID: ' . $_SESSION['userId']);

session_destroy();
session_unset();
header('location: ../index.php?page=login');

