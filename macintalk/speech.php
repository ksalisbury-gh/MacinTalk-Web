<?php

$vName = $_GET['voice'];
$text = addslashes($_GET['text']);
$filename = md5($vName . $text . date("mdyhisA"));
$command = 'say -o ' . $filename . '.aiff -v "' . $vName . '" "' . $text . '" && lame -q0 -b320 --resample 48 "' . $filename . '.aiff" "' . $filename . '.mp3"';
shell_exec($command);
unlink($filename . '.aiff');
playFile($filename . '.mp3');
unlink($filename . '.mp3');

function playFile($file){
	header('Content-Type: audio/mp3');
	header('Content-Disposition: inline');
	header('Expires: 0');
	header('Cache-Control: must-revalidate');
	header('Pragma: public');
	header('Content-Length: ' . filesize($file));
	readfile($file);
}
?>