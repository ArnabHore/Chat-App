<?php
$link = mysql_connect("localhost", "root", "") or die("Couldn't make connection.");
$db = mysql_select_db("ChatApp", $link) or die("Couldn't select database.");
session_start();
?>
    
<?php
if (isset($_SESSION['id'])) {
//        unset($_SESSION['id']);
    header('Location: chat.php');
    die();
} else if (isset($_POST["signup"])) {
    $query = "INSERT INTO user (name, username, password) VALUES ('" . $_POST["name"] . "', '" . $_POST["username"] . "', '" . md5($_POST["password"]) . "')";
    if (mysql_query($query)) {
        $fetch_query = "SELECT LAST_INSERT_ID()";//"SELECT id FROM user ORDER BY created_on LIMIT 1";
        $result = mysql_query($fetch_query);
        $last_id = mysql_fetch_array($result)[0];
        $_SESSION['id'] = $last_id;
        echo $_SESSION['id']."\n";
        header('Location: chat.php');
        exit();
//        while ($row = mysql_fetch_array($result)) {
//            echo $row[0]."\n";
//        }
        echo 'saved!';
    } else {
        echo 'not saved!';
    }
} else if (isset ($_POST["login"])) {
    $fetch_query = "SELECT * FROM user WHERE username='".$_POST['username']."'";
    $result = mysql_query($fetch_query);
    while ($row = mysql_fetch_array($result)) {
        if ($row['password'] == md5($_POST['password'])) {
            $_SESSION['id'] = $row['id'];
            header('Location: chat.php');
            exit();
        }
    }
    echo 'login failed';
}
?>

<!DOCTYPE html>
<html lang="en" >

<head>
  <meta charset="UTF-8">
  <title>Sign-Up/Login Form</title>
  <link href='https://fonts.googleapis.com/css?family=Titillium+Web:400,300,600' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">

  
      <link rel="stylesheet" href="css/style.css">

  
</head>

<body>

    <!--<h3>Sign Up</h3>
<form method="POST" action="index.php">
    <input type="text" name="name" placeholder="Enter Name" required="true">
    <input type="text" name="username" placeholder="Enter Username" required="true">
    <input type="password" name="password" placeholder="Enter Password" required="true">
    <input type="submit" value="Sign Up" name="signup">
</form>

<h3>Login</h3>
<form method="POST" action="index.php">
    <input type="text" name="username" placeholder="Enter Username" required="true">
    <input type="password" name="password" placeholder="Enter Password" required="true">
    <input type="submit" value="Login" name="login">
</form>-->
  <div class="form">
      
      <ul class="tab-group">
        <li class="tab active"><a href="#signup">Sign Up</a></li>
        <li class="tab"><a href="#login">Log In</a></li>
      </ul>
      
      <div class="tab-content">
        <div id="signup">   
          <h1>Sign Up for Free</h1>
          
          <form method="POST" action="index.php">
          
            <div class="field-wrap">
              <label>
                Name<span class="req">*</span>
              </label>
              <input type="text" name="name" required autocomplete="off" />
            </div>
        
            <div class="field-wrap">
              <label>
                Username<span class="req">*</span>
              </label>
              <input type="text" name="username" required autocomplete="off"/>
            </div>

          <div class="field-wrap">
            <label>
              Set A Password<span class="req">*</span>
            </label>
            <input type="password" name="password" required autocomplete="off"/>
          </div>
          
          <button type="submit" class="button button-block"/>Get Started</button>
          
          </form>

        </div>
        
        <div id="login">   
          <h1>Welcome Back!</h1>
          
          <form method="POST" action="index.php">
          
            <div class="field-wrap">
            <label>
              Username<span class="req">*</span>
            </label>
            <input type="text" name="username" required autocomplete="off"/>
          </div>
          
          <div class="field-wrap">
            <label>
              Password<span class="req">*</span>
            </label>
            <input type="password" name="password" required autocomplete="off"/>
          </div>
          
          <p class="forgot"><a href="#">Forgot Password?</a></p>
          
          <button class="button button-block" name="login"/>Log In</button>
          
          </form>

        </div>
        
      </div><!-- tab-content -->
      
</div> <!-- /form -->
  <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>

  

    <script  src="js/index.js"></script>




</body>

</html>
