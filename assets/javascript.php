<?php
$request = basename($_SERVER["REQUEST_URI"]);


$request = isset($_GET["js"]) ? strtolower(htmlspecialchars($_GET["js"])) : false;

$files = [
  "mn" => "main",
  "ac" => "activity",
  "an" => "aeon",
  "ay" => "anomaly",
  "ct" => "contact",
  "eo" => "echo",
  "ln" => "lumin",
  "pm" => "prism",
  "sc" => "synthetic",
];

if (strpos($request, "|")) {
  $codes = explode("|", $request);
} else {
  $codes = ['an', 'ct', 'ay', 'ac', 'ln', 'sc'];
}

$codes[] = "mn";
$codes = array_unique($codes);
$files = ["synthetic", "main"];
$buffer = "";
foreach ($files as $file) {
  $content = file_get_contents("js/$file.js");

  $needle = '//////////////////////////////////////////////////////////////////////////////80';
  $pos = strrpos($content, $needle) + 80;
  $block = substr($content, 0, $pos);
  $content = substr($content, $pos);
  $content = preg_replace('/(?:(?:\/\*(?:[^*]|(?:\*+[^*\/]))*\*+\/)|(?:(?<!\:|\\|\')\/\/.*))/', '', $content);
  $content = str_replace(': ', ':', $content);
  $content = str_replace(["\r\n", "\r", "\n", "\t"], '', $content);
  $buffer .= PHP_EOL . $block . PHP_EOL . PHP_EOL . $content . PHP_EOL;
}

$copyright = "//////////////////////////////////////////////////////////////////////////////80
// Psuedo compressed Javascript files
//////////////////////////////////////////////////////////////////////////////80\n";
ob_start("ob_gzhandler");
header('Cache-Control: public');
header('Expires: ' . gmdate('D, d M Y H:i:s', time() + 86400) . ' GMT');
header("Content-type: text/javascript");
echo($copyright . $buffer);
?>