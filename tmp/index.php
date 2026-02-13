<?php

$uri = "/name/{user}/{about}";
$uri = trim($uri);
$length = strlen($uri);
echo "LENGTH: $length";
$actual_uri = "/name/deadster/about";
echo "\nURL: $uri\n";
echo "Actual URL: $actual_uri\n";

$num_of_curly_start = substr_count($uri, '{');
$num_of_curly_end = substr_count($uri, '}');
echo "Number of {: " . $num_of_curly_start;
echo "\nNumber of }: " . $num_of_curly_end;


echo "\n";
// echo preg_replace('/\/home\/\{[a-z 0-9A-z]{0,60}\}\/about/', 'ho', $actual_uri);
// preg_match('/\/name\/\{[a-z 0-9A-z]{0,60}\}\/about/', $actual_uri, $output_array);
// print_r($output_array);
// echo "\n";

if ($num_of_curly_start == $num_of_curly_end && $num_of_curly_start != 0) {
	$cursor = 0;
	$newUri = '';
	for ($i = 0; $i < $num_of_curly_start; $i++) {
	// for ($i = 0; $i < 2; $i++) {
		echo "\n";
		$pos_of_start = strpos($uri, '{', $cursor);
		$startString = substr($uri, 0, $cursor + 1);
		echo "Start of Word: $pos_of_start \n";
		$pos_of_end = strpos($uri, '}', $pos_of_start);
		$endString = substr($uri, $pos_of_end + 1);
		echo "End of Word: $pos_of_end ";
		// preg_match('/\/name\/\{[a-z 0-9A-z]{0,60}\}\/about/', $actual_uri, $output_array);
		echo "\n";
		// echo "\n";
		// print_r($output_array);
		$var = substr($uri, $pos_of_start, $pos_of_end - $pos_of_start + 1);
		if ($i != 0) {
			$newUri .= $startString . $var;
		} else {
			$newUri .= $startString . $var;
		}
		echo "New URI: $newUri";
		echo "\nBefore String: $startString";
		// echo "\nExtracted: $var";
		echo "\nExtracted: $var";
		echo "\nRest String: $endString\n\n";
		$cursor += $pos_of_end - $cursor;
		if ($cursor++ == $length) {
			$cursor == $length;
		}
		echo "\nCursor Position: $cursor";
	}
} else {
	echo "Route not properly defined, Matching { not found";
}
// echo "<pre>";
// print_r($_SERVER);
// echo "</pre>";
