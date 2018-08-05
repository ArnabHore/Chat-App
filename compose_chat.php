<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<?php
    $link = mysql_connect("localhost", "root", "") or die("Couldn't make connection.");
    $db = mysql_select_db("ChatApp", $link) or die("Couldn't select database.");
    session_start();
?>

<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
body {
    margin: 0 auto;
    max-width: 800px;
    padding: 0 20px;
}

.container {
    border: 2px solid #dedede;
    background-color: #f1f1f1;
    border-radius: 5px;
    padding: 10px;
    margin: 10px 0;
}

.darker {
    border-color: #ccc;
    background-color: #ddd;
}

.container::after {
    content: "";
    clear: both;
    display: table;
}

.container img {
    float: left;
    max-width: 60px;
    width: 100%;
    margin-right: 20px;
    border-radius: 50%;
}

.container img.right {
    float: right;
    margin-left: 20px;
    margin-right:0;
}

.time-right {
    float: right;
    color: #aaa;
}

.time-left {
    float: left;
    color: #999;
}

.textfield {
	position: relative;
	left: 0;
	outline: none;
	border: 1px solid #cdcdcd;
	border-color: rgba(0,0,0,.15);
	background-color: white;
	font-size: 16px;
	border-radius: 50px;
	padding: 10px;
        width: calc(100% - 90px);
	margin-bottom: 20px;
}

.submit_button {
    background-image: url( 'images/send.png');
	height: 64px;
	width: 64px;
	border-width: 0px;
    padding: 25px;
    margin-left: 15px;
}
</style>
</head>
<body>

<?php 
if (isset($_GET['data'])) { 
    $data = $_GET['data'];
	$filename = $_GET['file'];
?>

    <button id="back">&lt; Back</button>
<h2>Chat Messages</h2>

<?php
    $lines = file($filename, FILE_IGNORE_NEW_LINES);
    foreach ($lines as $line) {
        $line_break = explode('<-break;->', $line);
        if ((int)$line_break[0] == (int)$_SESSION['id']) {
?>
                        <div class="container darker">
			  <img src="images/avatar_g2.jpg" alt="Avatar" class="right" style="width:100%;">
			  <p>
		        <?php 
		          echo $line_break[2];
		        ?>
			  </p>
			  <span class="time-left">11:01</span>
			</div>
<?php
		} else {
    		?>
			<div class="container">
  				<img src="images/bandmember.jpg" alt="Avatar" style="width:100%;">
  			  <p>
				  <?php 
				  echo $line_break[2];
				  ?>
			  </p>
			  <span class="time-right">11:00</span>
                        </div>
		<?php
		}	
    }
?>

<form method="POST" action="compose_chat.php?data=<?php echo $data; ?>&file=<?php echo $filename; ?>">
    <input type="text" name="message" required="true" class="textfield" placeholder="Write something here...">
    <input type="hidden" name="receiver" value="<?php echo $data; ?>">
	<!-- <input type="image" src="images/send.png" alt="Submit" width="48" height="48" name="chat_send"> -->
    <input type="submit" name="chat_send" class="submit_button" value="">
</form>
<?php 
} else {
    echo "Oops! User not found! Please go back and try again!";
}
?>


<?php
if(isset($_POST['chat_send'])) {
    $myfile = fopen($filename, "a+") or $myfile = fopen($filename, "w") or die("Unable to open chat!");
    $txt = $_SESSION['id'] . "<-break;->" . date("Y-m-d H:m:s") . "<-break;->" . $_POST['message'] . "<-break;->" . $_POST['receiver'] . "\n";
    fwrite($myfile, $txt);
    fclose($myfile);
} else {
}
?>
</body>

<script>
$(document).ready(function(){
	setTimeout(function(){
		// window.scrollTo(0,document.querySelector(".submit_button").scrollHeight);
	 	window.scrollTo(0,document.body.scrollHeight);
	}, 500);
        
        $("#back").click(function(){
            window.location.replace("chat.php");
        });
});
</script>
</html>
