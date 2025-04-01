<?php
    session_start();
    require_once("config.php");
    require_once("nav.php");
    
    if (isset($_POST["delete"])) {
        $search = $db->prepare("SELECT userID, fname, hash FROM person where email = :Email");

        $search->bindValue(":Email", $_POST["Email"], SQLITE3_TEXT);
        
        $r = $search->execute();
        
        $le = $db->lastErrorMsg();
        if (strlen($le) > 0 && $le !== "not an error") {
            echo "<br>$le<br>";
        }

        $hash = "";
        $name = "";
        $userID = "";

        while($g = $r->fetchArray(SQLITE3_ASSOC)) {
            $hash = $g['hash'];
            $name = $g['fname'];
            $userID = $g['userID'];
        }
        
        if (password_verify($_POST["Password"], $hash)) {
            $delete = $db->prepare("delete from person where email = :Email");

            $delete->bindValue(":Email", $_POST["Email"], SQLITE3_TEXT);
            
            $r = $delete->execute();
            $le = $db->lastErrorMsg();
            if (strlen($le) > 0 && $le !== "not an error") {
                echo "<br>$le<br>";
            }

            echo "Account Has been Deleted<br>";
            echo "<script>window.close();</script>";

        } else {
            echo "Delete Failed!<br>";
        } 
    }
?>
<html>
    <body style="font-family: monospace; font-size: 150%; color: white; background-color:black;">
        <form action="delete.php" method="post" enctype="multipart/form-data">
            <br>
            -  Email:
            <input type="text" name="Email" id="email">
            <br>
            <br>
            -  Password:
            <input type="password" name="Password" id="password">
            <br>
            <br>
            <input type="submit" value="CONFIRM DELETE" name="delete">
        </form>

    </body>
</html>
