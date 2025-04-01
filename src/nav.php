<html>
<head>
    <title>LemonTurtle</title>
</head>
<body style="font-family: monospace; font-size: 150%; color: white; background-color:black;">
    <table style="background-color:#03f8fc; width:100%; height:80px; font-size:16px;">
    <tr>
        <td align="left" valign="center">
        <a href="index.php" style="color: #000000; text-decoration:none;"><h1>HOME</h1></a>
        </td>
        <td align="left" valign="center">
        <a href="map.php" style="color: #000000; text-decoration:none;"><h1>MAP</h1></a>
        </td>
        <td align="left" valign="center">
        <a href="apilookup.php" style="color: #000000; text-decoration:none;"><h1>DATABASE</h1></a>
        </td>
        <td align="left" valign="center">
        <a href="about.php" style="color: #000000; text-decoration:none;"><h1>ABOUT</h1></a>
        </td>
<?php
if (!isset($_SESSION['userID'])) {
    echo '
        <td align="left" valign="center">
        <a href="signin.php" style="color: #000000; text-decoration:none;"><h1>SIGN-IN</h1></a>
        </td>
        <td align="left" valign="center">
        <a href="signup.php" style="color: #000000; text-decoration:none;"><h1>SIGN-UP</h1></a>
        </td>
        <td align="right" valign="center" style="width:50%;">
        <a href="profile.php" style="color: #000000; text-decoration:none;"><h1>My Profile</h1></a>
        </td>
        ';
} else {
    echo '
        <td align="right" valign="center" style="width:70%;">
        <a href="profile.php" style="color: #000000; text-decoration:none;"><h1>';
    $n = $_SESSION['name'];
    echo "$n</h1></a></td>";
}
?>
    </tr>
    </table>
</body>
</html>
