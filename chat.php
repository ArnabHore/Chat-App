<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

<?php
$link = mysql_connect("localhost", "root", "") or die("Couldn't make connection.");
$db = mysql_select_db("ChatApp", $link) or die("Couldn't select database.");
session_start();
?>

<!--<div>
    <table>
<?php
//    $receiver = 0;
//    $filename = "";
//    $fetch_query = "SELECT * FROM chat WHERE user1='".$_SESSION['id']."' OR user2='".$_SESSION['id']."'";
//    $result = mysql_query($fetch_query);
//    while ($row = mysql_fetch_array($result)) {
//        $query = "";
//        if ($row['user1'] == $_SESSION['id']) {
//            $query = "SELECT name FROM user WHERE id='".$row['user2']."'";
//            $receiver = $row['user2'];
//        }
//        else {
//            $query = "SELECT name FROM user WHERE id='".$row['user1']."'";
//            $receiver = $row['user1'];
//        }
//        $result1 = mysql_query($query);
//        $user_result = mysql_fetch_array($result1);
//        $name = $user_result[0];
//		$filename = $row['file_url'];
//        echo "<tr><td class='username' id='".md5($receiver)."' filename='". $filename ."'>".$name."</td></tr>";
//    }
?>
    </table>
</div>-->

<script>
    $(document).ready(function () {
        $(".container-inside").click(function () {
            window.location.replace("compose_chat.php?data=" + $(this).attr('id') + "&file=" + $(this).attr('filename'));
//        var saveData = $.ajax({
//            type: 'POST',
//            url: "compose_chat.php",
//            data: {data:'aa'},
//            success: function(resultData) {
//                window.location.replace("compose_chat.php?data=aa");
//            }
//        });
        });
    });//$(this).attr('id')
</script>

<style>
    .card {
        /*height: 100px;*/
    }  

    html,body {
        background: #efefef;
        font-family: "Arial";
    }

    .container-inside {
        max-width: 1250px;
        margin: 30px auto 30px;
        padding: 0 !important;
        width: 90%;
        background-color: #f1f1f1;
        box-shadow: 0 3px 6px rgba(0,0,0,0.10), 0 3px 6px rgba(0,0,0,0.10);
        cursor: pointer;
    }

    header {
        background: #eee;
        /*background-image: url("https://image.noelshack.com/fichiers/2017/38/2/1505775648-annapurnafocus.jpg");*/
        background-repeat: no-repeat;
        background-position: center;
        background-size: cover;
        background-color: black;
        height: 100px;
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
            height: 50px;
        } 

        header i {
            right: -90%;
        }
    }

    main {
        padding: 20px 20px 0px 20px;
        height: 95px;
    }

    .left {
        display: flex;
        align-items: center;
        justify-content: center;
        flex-direction: column;
    }

    .photo {
        width: 100px;
        height: 100px;
        margin-top: -72px;
        border-radius: 100px;
        border: 4px solid #fff;
    }

    .active {
        width: 20px;
        height: 20px;
        border-radius: 20px;
        position: absolute;
        right: calc(50% - 35px);
        top: 8px;
        background-color: #FFC107;
        border: 3px solid #fff;
    }

    @media (max-width:990px) {
        .active {
            right: calc(50% - 40px);
            top: 5px;
        } 
    }

    .name {
        /*margin-top: 20px;*/
        font-family: "Open Sans";
        font-weight: 600;
        font-size: 18pt;
        color: #777;
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

    .center-content {
        text-align: center;
    }
</style>

<html>
    <body>
        <div class="container">
            <div class="row">
                <div class="col-lg-2 col-sm-0"></div>
                <div class="col-lg-8 col-sm-12">

                    <?php
                    $receiver = 0;
                    $filename = "";
                    $fetch_query = "SELECT * FROM chat WHERE user1='" . $_SESSION['id'] . "' OR user2='" . $_SESSION['id'] . "'";
                    $result = mysql_query($fetch_query);
                    while ($row = mysql_fetch_array($result)) {
                        $query = "";
                        if ($row['user1'] == $_SESSION['id']) {
                            $query = "SELECT name FROM user WHERE id='" . $row['user2'] . "'";
                            $receiver = $row['user2'];
                        } else {
                            $query = "SELECT name FROM user WHERE id='" . $row['user1'] . "'";
                            $receiver = $row['user1'];
                        }
                        $result1 = mysql_query($query);
                        $user_result = mysql_fetch_array($result1);
                        $name = $user_result[0];
                        $filename = $row['file_url'];
//                        echo "<tr><td class='username' id='" . md5($receiver) . "' filename='" . $filename . "'>" . $name . "</td></tr>";
                        ?>
                    <div class="col-lg-4 col-sm-6 card">
                        <div class="container-inside" id="<?php echo md5($receiver); ?>" filename="<?php echo $filename; ?>">
                            <header></header>
                            <main>
                                <div class="col-lg-12 col-sm-12 center-content">
                                    <div class="photo-left">
                                        <img class="photo" src="https://image.noelshack.com/fichiers/2017/38/2/1505775062-1505606859-portrait-1961529-960-720.jpg"/>
                                        <div class="active"></div>
                                    </div>
                                    <h4 class="name"><?php echo $name; ?></h4>                                                                                
                                </div>
                            </main>
                        </div>
                    </div>
                    <?php
                    }
                    ?>

                    
                </div>
                <div class="col-lg-2 col-sm-0"></div>
            </div>
        </div> 
    </body>
</html>