<?php
    session_start();
    require_once("config.php");
    require_once("nav.php");

    $userID = $_SESSION['userID'];
    echo "UserID = $userID";
    $insertForm = new PhpFormBuilder();

    $insertForm->add_input("- Title: ", array(), "titl");
    $insertForm->add_input("- Description: ", array(), "desc");
    $insertForm->add_input("- Price : [$] ", array(), "price");

    $insertForm->add_input("New", array(
        "type" => "submit",
        "value" => "Create"
    ), "addListing");

    $insertForm->build_form();
    
    if (isset($_POST["addListing"])) {
        $insert = $db->prepare("INSERT INTO listing (listerID, title, description, price) VALUES (:myID, :myTitle, :myDesc, :myPrice)");
        
        $insert->bindValue(":myID", 1, SQLITE3_TEXT);
        $insert->bindValue(":myTitle", $_POST["titl"], SQLITE3_TEXT);
        $insert->bindValue(":myDesc", $_POST["desc"], SQLITE3_TEXT);
        $insert->bindValue(":myPrice", $_POST["price"], SQLITE3_TEXT);
        
        $r = $insert->execute();
        
        $le = $db->lastErrorMsg();
        if (strlen($le) > 0 && $le !== "not an error") {
            echo "<br>$le<br>";
        }

    }

    $show = $db->prepare("SELECT title, description, price, listedTime from listing");
    $s = $show->execute();

?>

<html>
    <body style="font-family: monospace; font-size: 150%; color: white; background-color:black;">
        <h1>Add a Listing</h1>        
        <form action="addListing.php" method="post" enctype="multipart/form-data">
            -  Title:
            <input type="text" name="Title" id="titl">
            <br>
            -  Description:
            <input type="text" name="Description" id="desc">
            <br>
            -  Price:
            <input type="text" name="Price" id="price">
            <br>
            -  Images:
            <input type="file" name="filefield[]" multiple id="files">
            <br>
            <br>
            <input type="submit" value="SUBMIT" name="submit">
        </form>
        <h1>My Listings</h1>        
        <h1>LISITNGS</h1>        

    </body>
</html>
