<?php
    $link = mysql_connect("localhost", "root", "") or die("Couldn't make connection.");
    $db = mysql_select_db("ChatApp", $link) or die("Couldn't select database.");
    session_start();
?>
<form method="POST" action="login.php">
    <input type="email" name="email" required="true">
    <input type="submit" value="Login">
</form>
<?php
    if(isset($_SESSION['id'])) {
//        unset($_SESSION['id']);
        header('Location: chat.php');
        die();
    } else if (isset ($_POST['email'])) {
        $fetch_query = "SELECT id FROM user WHERE email='".$_POST['email']."'";
        $result = mysql_query($fetch_query);
        while ($row = mysql_fetch_array($result)) {
            $_SESSION['id'] = $row['id'];
            header('Location: chat.php');
            die();
        }
    }
?>