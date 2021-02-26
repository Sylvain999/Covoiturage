<?php
spl_autoload_register(function ($className) {
	$repClasses='classes/';
	require $repClasses.$className.'.class.php';
	date_default_timezone_set('Europe/Paris');
}
);