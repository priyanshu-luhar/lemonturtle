<?php
    session_start();
    require_once("config.php");
    require_once("nav.php");
    
    if (isset($_POST["signup"])) {
        $insert = $db->prepare("INSERT INTO person (fname, lname, email, hash) VALUES (:Fname, :Lname, :Email, :Phash)");

        $insert->bindValue(":Fname", $_POST["firstname"], SQLITE3_TEXT);
        $insert->bindValue(":Lname", $_POST["lastname"], SQLITE3_TEXT);
        $insert->bindValue(":Email", $_POST["Email"], SQLITE3_TEXT);
        $pswd = password_hash($_POST["Password"], PASSWORD_DEFAULT);

        $insert->bindValue(":Phash", $pswd, SQLITE3_TEXT);

        $insert->execute();

        $le = $db->lastErrorMsg();
        if (strlen($le) > 0 && $le !== "not an error") {
            echo "<br>$le<br>";
        }

        echo "Account Successfully Created!<br>";
    }
?>
<html>
    <body style="font-family: monospace; font-size: 150%; color: white; background-color:black;">
        <form action="signup.php" method="post" enctype="multipart/form-data">
            <br>
            -  First Name
            <input type="text" name="firstname" id="firstname">
            <br>
            <br>
            -  Last Name
            <input type="text" name="lastname" id="firstname">
            <br>
            <br>
            -  Email:
            <input type="text" name="Email" id="email">
            <br>
            <br>
            -  Password:
            <input type="password" name="Password" id="password">
            <br>
            <br>
            <input type="submit" value="SUBMIT" name="signup">
        </form>

    </body>
</html>
