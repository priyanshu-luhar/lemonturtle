<?php
    session_start();
    require_once("config.php");
    require_once("nav.php");
    
    if (isset($_POST["signin"])) {
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
            echo "Login Successful!<br>";
            echo "Welcome, $name.<br>";
            $_SESSION['name'] = $name;
            $_SESSION['userID'] = $userID;

        } else {
            echo "Login Failed!<br>";
        } 
    }
?>
<html>
    <body style="font-family: monospace; font-size: 150%; color: white; background-color:black;">
        <form action="signin.php" method="post" enctype="multipart/form-data">
            <br>
            -  Email:
            <input type="text" name="Email" id="email">
            <br>
            <br>
            -  Password:
            <input type="password" name="Password" id="password">
            <br>
            <br>
            <input type="submit" value="SUBMIT" name="signin">
        </form>

    </body>
</html>
