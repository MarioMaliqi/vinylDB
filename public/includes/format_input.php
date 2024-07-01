<?php

function formatInput(array $names){
	$formattedInputs = [];

	foreach($names as $name) {
		$formattedInputs[] = htmlspecialchars($_POST[$name]);
	}

	return $formattedInputs;
}
