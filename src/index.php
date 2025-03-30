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
    } else {
        $url = "https://geek-jokes.sameerkumar.website/api?format=json";

    }
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    $output = curl_exec($curl);
    curl_close($curl);
    
    echo "$output";
?>

    </body>
</html>

<?php
    require_once("footer.php");
?>
