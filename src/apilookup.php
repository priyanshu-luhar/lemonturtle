<?php
    session_start();
    require_once("config.php");
    require_once("nav.php");
    
?>
<html>
    <body style="font-family: monospace; font-size: 150%; color: white; background-color:black;">
        <form action="apilookup.php" method="post" enctype="multipart/form-data">
            <table style="width:100%;" align="center">
            <tr>
            <td align="left" style="width:85%;">
            <br>
            <input style="width:97%; font-size:20pt; font-family:courier;" type="text" name="Keyword" id="keyword">
            </td>
            <td align="right">
            <br>
            <input style="font-size:20pt; font-family:courier;"; type="submit" value="Keyword-Search" name="apilookup">
            </td>
            </tr>
            </table>
        </form>
<?php
    if (isset($_POST["apilookup"])) {
        $k = $_POST["Keyword"];

        $query = "SELECT name, url, category, description FROM website WHERE ";
        $query .= "name LIKE \"%" .$k ."%\" OR ";
        $query .= "category LIKE \"%" .$k ."%\" OR ";
        $query .= "description LIKE \"%" .$k ."%\";";
        
        $search = $db->prepare($query);
        $r = $search->execute();

        $le = $db->lastErrorMsg();
        if (strlen($le) > 0 && $le !== "not an error") {
            echo "<br>$le<br>";
        }

        $api = [];
        while($g = $r->fetchArray(SQLITE3_ASSOC)) {
            $api []= $g;
        }

        echo makeTable($api);
    } else {
        $k = "";

        $query = "SELECT name, url, category, description FROM website WHERE ";
        $query .= "name LIKE \"%" .$k ."%\" OR ";
        $query .= "category LIKE \"%" .$k ."%\" OR ";
        $query .= "description LIKE \"%" .$k ."%\";";
        
        $search = $db->prepare($query);
        $r = $search->execute();

        $le = $db->lastErrorMsg();
        if (strlen($le) > 0 && $le !== "not an error") {
            echo "<br>$le<br>";
        }

        $api = [];
        while($g = $r->fetchArray(SQLITE3_ASSOC)) {
            $api []= $g;
        }

        echo makeTable($api);
    }
?>
    </body>
</html>
