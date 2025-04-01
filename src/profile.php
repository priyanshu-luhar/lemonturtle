<?php
    session_start();
    require_once("config.php");
    require_once("nav.php");
    
?>
<html>
    <body style="font-family: monospace; font-size: 150%; color: white; background-color:black;">
        <h1> PROFILE PAGE </h1>
        <br>
<?php
        if (isset($_SESSION['userID'])) {
            $insert = $db->prepare("SELECT fname, lname, email, openTime FROM person where userID = :uid");
            $insert->bindValue(":uid", $_SESSION["userID"], SQLITE3_TEXT);
            $r = $insert->execute();

            $le = $db->lastErrorMsg();
            if (strlen($le) > 0 && $le !== "not an error") {
                echo "<br>$le<br>";
            }

            $fname = "";
            $lname = "";
            $email = "";
            $dateop = "";
            while($g = $r->fetchArray(SQLITE3_ASSOC)) {
                $fname = $g['fname'];
                $lname = $g['lname'];
                $email = $g['email'];
                $dateop = $g['openTime'];
            }

            echo '
            <a href="profile.php" style="text-decoration:none;">
            <img src= "../img/turtle.png" alt="Logo" width="20%">
            </a>';
            echo "<h1>First Name: $fname</h1><br>";
            echo "<h1>Last Name: $lname</h1><br>";
            echo "<h1>Email Address: $email</h1><br>";
            echo "<h1>Account Created: $dateop</h1><br>";
            echo '<a href="delete.php" style="color: #FF0000; text-decoration:none;"><h1>DELETE ACCOUNT</h1></a>';
            echo "<h1>API Request HISTORY</h1><br>";
            
            $insert = $db->prepare("SELECT apiNo, url FROM api where userID = :uid");
            $insert->bindValue(":uid", $_SESSION["userID"], SQLITE3_TEXT);
            $r = $insert->execute();

            $le = $db->lastErrorMsg();
            if (strlen($le) > 0 && $le !== "not an error") {
                echo "<br>$le<br>";
            }

            while($g = $r->fetchArray(SQLITE3_ASSOC)) {
                $q = $g['url'];
                $p = $g['apiNo'];
                echo "<pre>$p    $q</pre><br>";
            }


        } else {
            echo "Sign in to see your Profile!<br>";
        }
?>
    </body>
</html>
