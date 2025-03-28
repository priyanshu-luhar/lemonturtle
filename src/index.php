<?php
    require_once("config.php");
    require_once("nav.php");


?>
<html>
    <body style="font-family: monospace; font-size: 150%; color: white; background-color:black;">
        <h1>URL</h1>
        <form action="index.php" method="post" enctype="multipart/form-data">
            <input type="text" name="url" id="url">
            <br>
            <br>
            <input type="submit" value="SUBMIT" name="request">
        </form>
        <h1>Response</h1>

    </body>
</html>
