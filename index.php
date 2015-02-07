<?php

require_once "vendor/autoload.php";
use \Dropbox as dbx;

$appInfo = dbx\AppInfo::loadFromJsonFile("app-info.json");
$webAuth = new dbx\WebAuthNoRedirect($appInfo, "PHP-Example/1.0");

$authorizeUrl = $webAuth->start();

echo "1. Go to: " . $authorizeUrl . "\n";
echo "2. Click \"Allow\" (you might have to log in first).\n";
echo "3. Copy the authorization code.\n";
// $authCode = \trim(\readline("Enter the authorization code here: "));

// $authCode = "rOp8tncZnJUAAAAAAAACHRa_1JsbJKYm06WRP5dMcck";

// list($accessToken, $dropboxUserId) = $webAuth->finish($authCode);
// print "Access Token: " . $accessToken . "\n";

$accessToken = "rOp8tncZnJUAAAAAAAACHn1SQDp-HdIfZAZs2JSyAcQ18_y13yMym3nWQXEj9xzE";

$dbxClient = new dbx\Client($accessToken, "PHP-Example/1.0");
$accountInfo = $dbxClient->getAccountInfo();

// print_r($accountInfo);

// echo "SEARCH RESULTS\n";

$searchResults = $dbxClient->searchFileNames("/", "Winter 2015");
// print_r($searchResults);

// list($accessToken, $dropboxUserId) = $webAuth->finish($authCode);
// print "Access Token: " . $accessToken . "\n";

// $dbxClient = new dbx\Client($accessToken, "PHP-Example/1.0");
// $accountInfo = $dbxClient->getAccountInfo();
// print_r($accountInfo);

?>

<html lang="en">
    <head> 
        <meta charset="utf-8">
        <title> Cloud Seek </title>
        <link href="//fonts.googleapis.com/css?family=Raleway:400,300,600" rel="stylesheet" type="text/css">

        <!-- Mobile Specific Metas–––––––––––––––––––––––––––––––––––––––––––––––––– -->
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <!-- CSS
        –––––––––––––––––––––––––––––––––––––––––––––––––– -->
        <link rel="stylesheet" href="css/normalize.css">
        <link rel="stylesheet" href="css/skeleton.css">

        <!-- Favicon
        –––––––––––––––––––––––––––––––––––––––––––––––––– -->
        <link rel="icon" type="image/png" href="images/favicon.png">
    </head>
    <body>
    <div class="container">
        <table class="u-full-width">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Age</th>
                    <th>Sex</th>
                    <th>Location</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Dave Gamache</td>
                    <td>26</td>
                    <td>Male</td>
                    <td>San Francisco</td>
                </tr>
                <tr>
                    <td>Dwayne Johnson</td>
                    <td>42</td>
                    <td>Male</td>
                    <td>Hayward</td>
                </tr>
            <?php
                // echo sizeof($searchResults) . "\n";
                foreach($searchResults as $file) {
                    // print_r($file);

                    $str = "<tr>";
                    $str .= "<td>" . $file['path'] . "</td>";
                    $str .= "<td>" . $file['is_dir'] . "</td>";
                    $str .= "<td>" . $file['modified'] . "</td>";
                    $str .= "<td>" . $file['size'] . "</td>";
                    $str .= "</tr>\n";
                    echo $str;
                }
                unset($file);
            ?>
            </tbody>

        </table>
    </div>
    </body>
</html>