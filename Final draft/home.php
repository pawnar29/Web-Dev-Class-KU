<?php
    include("session.cgi");
    //session_start();
    //if(session_destroy() && $exit) { header("Location: ."); die; }
?>
<html>
    <style type = "text/css">
        html{
            background-color: #e5edf1;
        }
        a{
            text-decoration: none;
            color: #007bff;
        }
        .box{
            height: auto;
            border: 5px solid gray;
            padding: 10px;
            margin-right: auto;
            margin-top: 20px;
            text-align: center;
            float: right;
        }
        .images{
            margin-top: 100px;
            height: auto;
            width: 100%;
            border: 3px solid grey;
            border-radius: 5px;
            padding-top: 10px;
            text-align: center;
            display: inline-block;
        }
        body{
            text-align: center;
            display: inline-block;
        }
        img{
            border: 1px solid gray;
            padding: 3px;
            height: 100px;
            width: 100px;
        }
    </style>
   
   <head>
        <title>Photo Gallery </title>
        <div class="box">
            <b>Logged in as <?php echo $login_session; ?>  <a href="exit.php">Sign Out</a></b> 
        </div>
        <div class="box" style="margin-right: 5%;"><a href="upload.php">Upload Pictures</a></div>
   </head>

   
   
   <body >
        <br>
        <div class="images">
            <?php
                $sql="select * from images";
                $result=mysqli_query($db,$sql);
                while($row = mysqli_fetch_array($result)){
                    echo '  <a download="'.$row[1].'" href="data:image;base64,'.$row[2].'" style=" cursor: default;" onclick="return false">
                                <img src="data:image;base64,'.$row[2].' " alt="'.$row[1].'"></img>
                            </a>';
                }
            ?>
        </div>
   </body>
   
</html>