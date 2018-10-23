<?php

namespace Core;

$url = substr($_SERVER['REQUEST_URI'], strlen(BASE_URI));

Router::connect($url, ['controller' => 'Controller']);
