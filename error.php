<?php

class ErrorHandler {
    private $statusCodes = [
        400 => ["400 Bad Request", "The request cannot be fulfilled due to bad syntax."],
        401 => ["401 Login Error", "It appears that the username/password was incorrect."],
        403 => ["403 Forbidden", "The server has refused to fulfill your request."],
        404 => ["404 Not Found", "The document requested was not found on this server."],
        405 => ["405 Method Not Allowed", "The method specified in the Request-Line is not allowed for the specified resource."],
        408 => ["408 Request Timeout", "Client browser failed to send a request in the time allowed by the server."],
        414 => ["414 URL Too Long", "The URL you entered is longer than the maximum length."],
        500 => ["500 Internal Server Error", "The request was unsuccessful due to an unexpected condition encountered by the server."],
        502 => ["502 Bad Gateway", "The server received an invalid response from the upstream server while trying to fulfill the request."],
        504 => ["504 Gateway Timeout", "The upstream server failed to send a request in the time allowed by the server."],
    ];

    public function __construct() {
        $this->status = $_SERVER["REDIRECT_STATUS"] ?? 500;
    }

    public function getErrorTitleAndMessage() {
        if (array_key_exists($this->status, $this->statusCodes)) {
            return $this->statusCodes[$this->status];
        }
        return ["Unknown Error", "An unknown error occurred."];
    }
}

class DocumentHandler {
    private $documents = [
        "/robots.txt",
        "/humans.txt",
        "/keybase.txt",
        "/security.txt",
        "/sitemap.xml"
    ];

    public function handleSpecialDocuments() {
        $file = "/" . trim(basename($_SERVER["REQUEST_URI"]));
        if (in_array($file, $this->documents) && file_exists(".$file")) {
            header($_SERVER["SERVER_PROTOCOL"] . " 200 OK");
            header("Content-Type: " . ($file === "/sitemap.xml" ? "application/xml" : "text/plain") . "; charset=utf-8");
            readfile(".$file");
            exit;
        }
    }
}

$errorHandler = new ErrorHandler();
list($errortitle, $errormsg) = $errorHandler->getErrorTitleAndMessage();

$documentHandler = new DocumentHandler();
$documentHandler->handleSpecialDocuments();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Antts - <?php echo htmlspecialchars($errortitle); ?></title>
    <meta http-equiv="X-UA-Compatible" content="chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="author" content="Antt1995, antt1995@antts.uk">
    <meta name="abuseipdb-verification" content="jhfQynTo" />
    <link rel="preload" as="style" href="/assets/style.min.css">
    <link rel="stylesheet" type="text/css" href="/assets/style.min.css" media="screen">
    <link rel="icon" type="image/png" sizes="32x32" href="https://antts.s3.eu-west-2.amazonaws.com/logos/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="https://antts.s3.eu-west-2.amazonaws.com/logos/favicon-32x32.png">
    <link rel="shortcut icon" href="https://antts.s3.eu-west-2.amazonaws.com/logos/favicon-32x32.png">
    <meta name="theme-color" content="#ffffff">
    <style type="text/css">
        <?php include("assets/embed.css"); ?>
    </style>
    <script defer type="text/javascript" src="assets/javascript.php"></script>
</head>
<body oncontextmenu="return false;">
    <canvas id="synthetic"></canvas>
    <div id="logo">
        <div class="home-card">
            <h1><?php echo htmlspecialchars($errortitle); ?></h1><br>
            <h1><?php echo htmlspecialchars($errormsg); ?></h1>
        </div>
        <img src="https://antts.s3.eu-west-2.amazonaws.com/logos/FullLogo_Transparent(1).webp" alt="logo" class="center">
    </div>
</body>
</html>
