<?php
    $link = mysql_connect("localhost", "root", "") or die("Couldn't make connection.");
    $db = mysql_select_db("ChatApp", $link) or die("Couldn't select database.");
    session_start();
?>

<?php
    if(isset($_SESSION['id'])) {

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

<html>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<script>
    $(document).ready(function(){
    $("#chat").click(function(){
        window.location.replace("chat.php");
    });
});
</script>

    <body>
        <div class="container">
            <header>
                <button id="chat" class="button" style="vertical-align:middle"><span>Chat Now</span></button>
            </header>
            <main>
                <div class="row">
                    <div class="col-lg-4 col-sm-4"></div>
                    <div class="col-lg-4 col-sm-4 center-content">
                        <div class="photo-left">
                            <img class="photo" src="https://image.noelshack.com/fichiers/2017/38/2/1505775062-1505606859-portrait-1961529-960-720.jpg"/>
                            <div class="active"></div>
                        </div>
                        <h4 class="name">Jane Doe</h4>
                        <button class="edit-button"><i class="fa fa-edit"></i></button>
                        <p class="desc">Hi ! My name is Jane Doe. I'm a UI/UX Designer from Paris, in France. I really enjoy photography and mountains.</p>
                        <div class="wrapper">
                            <textarea name="desc_textarea" id="" cols="20" rows="10"></textarea>
                            <div class="controls">
                                <button class="textarea-button">Add Description</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-4"></div>
                </div>
            </main>
        </div>
    </body>

<style>
html,body {
  background: #efefef;
  font-family: "Arial";
}

.container {
  max-width: 1250px;
  margin: 30px auto 30px;
  padding: 0 !important;
  width: 90%;
  height: 92%;
  background-color: #f1f1f1;
  box-shadow: 0 3px 6px rgba(0,0,0,0.10), 0 3px 6px rgba(0,0,0,0.10);
}

header {
  background: #eee;
  /*background-image: url("https://image.noelshack.com/fichiers/2017/38/2/1505775648-annapurnafocus.jpg");*/
  background-repeat: no-repeat;
  background-position: center;
  background-size: cover;
  background-color: black;
  height: 250px;
}

header i {
  position: relative;
  cursor: pointer;
  right: -96%;
  top: 25px;
  font-size: 18px !important;
  color: #fff;
}

@media (max-width:800px) {
  header {
    height: 150px;
  } 
  
  header i {
    right: -90%;
  }
}

main {
      padding: 20px 20px 0px 20px;
}

.left {
  display: flex;
  align-items: center;
  justify-content: center;
  flex-direction: column;
}

.photo {
  width: 200px;
  height: 200px;
  margin-top: -120px;
  border-radius: 100px;
  border: 4px solid #fff;
}

.active {
  width: 20px;
  height: 20px;
  border-radius: 20px;
  position: absolute;
  right: calc(50% - 70px);
  top: 45px;
  background-color: #FFC107;
  border: 3px solid #fff;
}

@media (max-width:990px) {
  .active {
    right: calc(50% - 60px);
    top: 50px;
  } 
}

.name {
  margin-top: 20px;
  font-family: "Open Sans";
  font-weight: 600;
  font-size: 18pt;
  color: #777;
}

.info {
  margin-top: -5px;
  margin-bottom: 5px;
  font-family: 'Montserrat', sans-serif;
  font-size: 11pt;
  color: #aaa;
}

.stats {
  margin-top: 25px;
  text-align: center;
  padding-bottom: 20px;
  border-bottom: 1px solid #ededed;
  font-family: 'Montserrat', sans-serif;
}


.number-stat {
  padding: 0px;
  font-size: 14pt;
  font-weight: bold;
  font-family: 'Montserrat', sans-serif;
  color: #aaa;
}

.desc-stat {
  margin-top: -15px;
  font-size: 10pt;
  color: #bbb;
}

.desc {
  text-align: center;
  margin-top: 25px;
  margin: 25px 40px;
  color: #999;
  font-size: 11pt;
  font-family: "Open Sans";
  padding-bottom: 25px;
  border-bottom: 1px solid #ededed;
}

.social {
  margin: 5px 0 12px 0;
  text-align: center;
  display: inline-block;
  font-size: 20pt;
}

.social i {
  cursor: pointer;
  margin: 0 15px;
}

.social i:nth-child(1)  { color: #4267b2; }
.social i:nth-child(2)  { color: #1da1f2; }
.social i:nth-child(3)  { color: #bd081c; }
.social i:nth-child(4)  { color: #36465d; }

.right {
  padding: 0 25px 0 25px !important;
}

.nav {
  display: inline-flex;
}

.nav li {
  margin: 40px 30px 0 10px;
  cursor: pointer;
  font-size: 13pt;
  text-transform: uppercase;
  font-family: 'Montserrat', sans-serif;
  font-weight: 500;
  color: #888;
}

.nav li:hover, .nav li:nth-child(1)  { 
  color: #999;
  border-bottom: 2px solid #999;
}

.follow {
  position: absolute;
  right: 8%;
  top: 35px;
  font-size: 11pt;
  background-color: #42b1fa;
  color: #fff;
  padding: 8px 15px;
  cursor: pointer;
  transition: all .4s;
  font-family: 'Montserrat', sans-serif;
  font-weight: 400;
}

.follow:hover {
  box-shadow: 0 0 15px rgba(0,0,0,0.2), 0 0 15px rgba(0,0,0,0.2);
}

@media (max-width:990px) {
  .nav {
    display: none;
  }
  
  .follow {
    width: 50%;
    margin-left: 25%;
    display: block;
    position: unset;
    text-align: center;
  }
}
.gallery  {
  margin-top: 35px;
}

.gallery div {
  margin-bottom: 30px;
}

.gallery img {
  box-shadow: 0 3px 6px rgba(0,0,0,0.10), 0 3px 6px rgba(0,0,0,0.10);
  width: auto; 
  height: auto;
  cursor: pointer;
  max-width: 100%;
}

.center-content {
    text-align: center;
}

/* button */
.button {
  display: inline-block;
  border-radius: 4px;
  background-color: #5fd608;
  border: none;
  color: #FFFFFF;
  text-align: center;
  font-size: 20px;
  transition: all 0.5s;
  cursor: pointer;
  margin: 5px;
  float: right;
}

.button span {
  cursor: pointer;
  display: inline-block;
  position: relative;
  transition: 0.5s;
}

.button span:after {
  content: '\00bb';
  position: absolute;
  opacity: 0;
  top: 0;
  right: -20px;
  transition: 0.5s;
}

.button:hover span {
  padding-right: 25px;
}

.button:hover span:after {
  opacity: 1;
  right: 0;
}

.edit-button {
    float: right;
    border-radius: 16px;
    width: 32px;
    height: 32px;
}

/* textarea */
.wrapper{
    background: #eee;
    border: 1px solid #999;
    padding: 0;
    margin:0;
}
.wrapper textarea{
    background: linear-gradient(to bottom, #e5e5e5 0%,#f2f2f2 100%);
    border:none;
    height: 100px;
    -moz-box-sizing: border-box;
    box-sizing: border-box;
    border-bottom: 1px dotted #999;
    resize: none;
}
.wrapper textarea:focus{
    outline: none;
}
.controls{
    text-align: right;
    margin-top: -6px;
}
.textarea-button{
    background: linear-gradient(to bottom, #ffffff 0%,#e5e5e5 100%);
    border: 1px solid #999;
    padding: 10px 25px;
    font-weight: bold;
    color: rgb(77,77,77);
    border-width: 1px 0 0 1px;
}
</style>
</html>