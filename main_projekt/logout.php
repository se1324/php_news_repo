<?php

require_once 'classes/AuthHandler.php';

$auth = new AuthHandler();

$auth->Logout();

header('Location: index.php');