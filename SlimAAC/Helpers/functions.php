<?php

function parseTFSConfig () {
	
	if (!is_file(TFS_CONFIG)) {
		return unserialize(TFS_CONFIG) || die('TFS_CONFIG is not configured right.');
	}
	
	$buff = file_get_contents(TFS_CONFIG);
	$lines = explode("\n", $buff);
	$output = [];
	
	foreach ($lines as $line) {
		if (strpos($line, '--') !== 0) {
			$output[] = $line;
		}
	}
	$ini = implode("\n", $output);
	
	return parse_ini_string($ini);
}
