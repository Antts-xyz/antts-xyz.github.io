<?php
// Configuration and shared variables
$themeColor = "#ffffff";
$author = "Antt1995, antt1995@antts.uk";
$abuseIPDBVerification = "jhfQynTo";
$stylePath = "/assets/style.min.css";
$faviconBaseURL = "https://antts.s3.eu-west-2.amazonaws.com/logos/favicon-32x32.png";
$embeddedStyle = "assets/embed.css";
$javascriptPath = "assets/javascript.php";

// Function to include CSS directly into the page
function includeCSS($path) {
    return file_get_contents($path);
}
?>
