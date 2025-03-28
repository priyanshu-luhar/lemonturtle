<?php
    require_once("config.php");
    
    if (isset($_POST["submit"])) {
        $insert = $db->prepare("INSERT INTO listing (listerID, title, description, price) VALUES (:myID, :myTitle, :myDesc, :myPrice)");
        
        $insert->bindValue(":myID", $_SESSION['userID'], SQLITE3_TEXT);
        $insert->bindValue(":myTitle", $_POST["Title"], SQLITE3_TEXT);
        $insert->bindValue(":myDesc", $_POST["Description"], SQLITE3_TEXT);
        $insert->bindValue(":myPrice", $_POST["Price"], SQLITE3_TEXT);
        
        $r = $insert->execute();
        
        $le = $db->lastErrorMsg();
        if (strlen($le) > 0 && $le !== "not an error") {
            echo "<br>$le<br>";
        }

    }

?>
