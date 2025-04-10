<?php
    require_once("config.php");
    require_once("nav.php");
?>

<html>
    <body style="font-family: monospace; font-size: 150%; color: white; background-color:black;">
        <h1>API URL</h1>
        <form action="index.php" method="post" enctype="multipart/form-data">
            <table style="width:100%;" align="center">
            <tr>
            <td align="left" style="width:90%;">
            <input style="width:97%; font-size:20pt; font-family:courier;" type="text" name="url" id="url">
            </td>
            <td align="right">
            <input style="font-size:20pt; font-family:courier;"; type="submit" value="Submit" name="request">
            </td>
            </tr>
            </table>
        </form>
        <h1>Response</h1>
<?php
    if (isset($_POST['request'])) {   
        $url = $_POST['url'];
        if (isset($_SESSION['userID'])) {
            $insert = $db->prepare('insert into api (userID, url) values (:uid, :url)');
            $insert->bindValue(":uid", $_SESSION['userID'], SQLITE3_TEXT);
            $insert->bindValue(":url", $url, SQLITE3_TEXT);

            $insert->execute();
        }
    } else {
        $url = "https://v2.jokeapi.dev/joke/Programming?format=txt";

    }
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    $output = curl_exec($curl);
    //$output = mb_convert_encoding($output, "utf-16", "UTF-16BE");    
    $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
    echo 'HTTP code: ' . $httpcode .'<br>';
    curl_close($curl);

    if (isJson($output)) {
        echo 'Output type: json<br>';
        $output = json_encode(json_decode($output), JSON_PRETTY_PRINT);
    }

    echo "<pre>".$output."</pre>";

?>

    </body>
</html>
