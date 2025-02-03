<!DOCTYPE html>
<html lang="en">
<head>
<meta charset='utf-8'>
<title>Antts</title>

<meta http-equiv="X-UA-Compatible" content="chrome=1">
<meta name="viewport" content="width=device-width, initial-scale=1" />
<?php include("config.php"); ?>
<meta name="author" content="<?php echo $author; ?>">
<meta name="abuseipdb-verification" content="<?php echo $abuseIPDBVerification; ?>">

<!-- Theme CSS -->
<link rel="preload" as="style" href="<?php echo $stylePath; ?>">
<link rel="stylesheet" type="text/css" href="<?php echo $stylePath; ?>" media="screen">

<!-- Favicon -->
<link rel="icon" type="image/png" sizes="32x32" href="<?php echo $faviconBaseURL; ?>">
<link rel="icon" type="image/png" sizes="16x16" href="<?php echo $faviconBaseURL; ?>">
<link rel="shortcut icon" href="<?php echo $faviconBaseURL; ?>">
<meta name="theme-color" content="<?php echo $themeColor; ?>">

<!-- Style -->
<style type="text/css">
<?php echo includeCSS($embeddedStyle); ?>
</style>
<script defer type="text/javascript" src="<?php echo $javascriptPath; ?>"></script>
</head>
<body oncontextmenu="return false;">
<!-- Background -->
<canvas id="synthetic"></canvas>
<div id="logo">
<img src="https://antts.s3.eu-west-2.amazonaws.com/logos/FullLogo_Transparent(1).webp" alt="logo" class="center">
</div>
</body>
</html>
