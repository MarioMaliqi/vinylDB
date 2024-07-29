<?php

function areInputsSet(array $names, $method) {
	foreach ($names as $name) {
		switch($method) {
		case 'GET':
			if (!isset($_GET[$name])) {
				return [false, $name];
			}
			break;
		case 'POST':
			if (!isset($_POST[$name])) {
				return [false, $name];
			}
		case 'FILES':
			if (!isset($_FILES[$name])) {
				return [false, $name];
			}
			break;
		}
	}
	return [true];
}

function formatInput(array $names) {
	$formattedInputs = [];

	foreach ($names as $name) {
		$formattedInputs[$name] = htmlspecialchars($_POST[$name]);
	}

	return $formattedInputs;
}
