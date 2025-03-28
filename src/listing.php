<?php
    session_start();
    require_once("config.php");
    require_once("nav.php");

    if (isset($_POST["addsubmit"])) {
        if (isset($_SESSION['userID'])) {
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
            /*
            $listingID = "a";

            //$search = $db->prepare("SELECT * from listing where listerID = :myID and title = \":myTitle\";");
            $search = $db->prepare("SELECT * from listing where listerID = :myID");
            $search->bindValue(":myID", $_SESSION['userID'], SQLITE3_TEXT);
            //$search->bindValue(":myTitle", $_POST["Title"], SQLITE3_TEXT);
            
            $q = $search->execute();

            $le = $db->lastErrorMsg();
            if (strlen($le) > 0 && $le !== "not an error") {
                echo "<br>$le<br>";
            }
            
            while($g = $q->fetchArray(SQLITE3_ASSOC)) {
                $listingID = $g['listingID'];
            }

            echo "listingID = $lisitngID<br>";
             */

            $filename = $_FILES["filefield"]["tmp_name"];
            $imgDir = '../img/';
            $myFiles = $imgDir .$_FILES['filefield']['name'];
            $uploadOk = 1;

            $check = getimagesize($_FILES["filefield"]["tmp_name"]);
            if($check !== false) {
                $uploadOk = 1;
            } else {
                $uploadOk = 0;
            }

            if ($uploadOk == 0) {
                echo "<br>Sorry, your file was not uploaded.<br>";
            } else {
                if (move_uploaded_file($_FILES["filefield"]["tmp_name"], $myFiles)) {
                    echo "<br> Listing Added Successfully!<br>";
            /*
                    $insert = $db->prepare("INSERT INTO images (listingID, fullpath) VALUES (:myLID, :fpath)");
                    
                    $insert->bindValue(":myLID", $listingID, SQLITE3_TEXT);
                    $insert->bindValue(":fpath", $myFiles, SQLITE3_TEXT);
                    
                    $r = $insert->execute();
                    $le = $db->lastErrorMsg();
                    if (strlen($le) > 0 && $le !== "not an error") {
                        echo "<br>$le<br>";
                    }
             */
                } else {
                    echo "<br>Sorry, your file was not uploaded.<br>";
                }
            }
        } else {
            echo "<br>Sorry, you cannot add a listing without being Logged In<br>";
        }
    }
?>

<html>
    <body style="font-family: monospace; font-size: 150%; color: white; background-color:black;">
        <h1>Add a Listing</h1>        
        <form action="listing.php" method="post" enctype="multipart/form-data">
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
            <!--<input type="file" name="filefield[]" multiple id="files">-->
            <input type="file" name="filefield" id="files">
            <br>
            <br>
            <input type="submit" value="SUBMIT" name="addsubmit">
        </form>
        <h1>My Listings</h1>        
<?php
    $show = $db->prepare("SELECT listingID, title, description, price, listedTime from listing where listerID = :myID");
    $show->bindValue(":myID", $_SESSION['userID'], SQLITE3_TEXT);
    $s = $show->execute();

    while($g = $s->fetchArray(SQLITE3_ASSOC)) {
        $title = $g['title'];
        $price = $g['price'];
        $listingID = $g['listingID'];
        echo "Title: $title - Price: $ $price - ID = $listingID<br>";
    }
?>
        <h1>LISITNGS</h1>        
<?php
    $show = $db->prepare("SELECT title, description, price, listerID, listedTime from listing");
    $s = $show->execute();

    while($g = $s->fetchArray(SQLITE3_ASSOC)) {
        $title = $g['title'];
        $price = $g['price'];
        $lID = $g['listerID'];

        $getname = $db->prepare("SELECT username from person where userID = :lid");
        $getname->bindValue(":lid", $lID, SQLITE3_TEXT);
        $x = $getname->execute();
        while($y = $x->fetchArray(SQLITE3_ASSOC)) {
            $uname = $y['username'];
            echo "Title: $title - Price: $ $price - Listed by: $uname<br>";
        }

    }
?>
    </body>
</html>



