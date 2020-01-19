<?php

    //include("dbs.cgi");
    include("session.cgi");
    //include("dbs.cgi");
    
    //$target_dir = "uploads/";
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Upload</title>
        <style type = "text/css">
            body {
                font-family:Arial, Helvetica, sans-serif;
                font-size:14px;
            }
            label {
                font-weight:bold;
                width:100%;
                font-size:14px;
            }
            .box {
                border:#666666 solid 1px;
            }
            html{
                background-color: #e5edf1;
            }
        </style>
   </head>
   <body>
      <div align = "center" style = "position: relative;top:25%;vertical-align:middle;">
         <div style = "width:75%; border: solid 1px #333333; " align = "left">
            <div style = "background-color:#333333; color:#FFFFFF; padding:3px;"><b>Upload</b></div>	
            <div style = "margin:30px">
            <form action="" method="post" enctype="multipart/form-data">
                    <label>Select image to upload: </label>
                    <input type="file" id="imageUp" name="imageUp" class = "box">
                    <br><br>
                    <?php
                    $uploadOk = 1;
                    $error = "";
                    $reset="Upload Image";
                    //Checks if the selected file is an image
                    //if ($_SERVER["REQUEST_METHOD"] == "GET" || $_FILES["imageUp"]["error"] == "4"){$error = "No file selected";}
                    /*else */if($_SERVER["REQUEST_METHOD"] == "POST" && $_FILES["imageUp"]["error"] != "4" ){
                        $target_file = /*$target_dir . "1_" . */basename($_FILES["imageUp"]["name"]);
                        $uploadOk = 1;
                        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
                        $check = getimagesize($_FILES["imageUp"]["tmp_name"]);
                        if($check !== false) {
                            //echo '<img src="' . $target_file . '" / align="center" style="width:75%" alt=' . basename($_FILES["imageUp"]["name"]) . '>';
                        } else {
                            $error = "File is not an image.";
                            $uploadOk = 0;
                        }
                        // Check file size
                        if ($_FILES["imageUp"]["size"] > 1000000) {
                            $error = "Sorry, your file is too large.";
                            $uploadOk = 0;
                        }
                        // Allow certain file formats
                        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
                        && $imageFileType != "gif" ) {
                            $error = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                            $uploadOk = 0;
                        }
                        // Check if $uploadOk is set to 0 by an error
                        if ($uploadOk == 0) {
                            //$error = "Sorry, your file was not uploaded.";
                        // if everything is ok, try to upload file
                        } else {
                            /* if (move_uploaded_file($_FILES["imageUp"]["tmp_name"],$target_file)) {
                                echo "<p font-size:11px; margin-top:10px>The picture has been uploaded.<p>";
                            } else {
                                $error = "Sorry, there was an error uploading your file.";
                            } */
                            $image=addslashes($_FILES["imageUp"]["tmp_name"]);
                            $name=addslashes($_FILES["imageUp"]["name"]);
                            $image=file_get_contents($image);
                            $image=base64_encode($image);
                            $sql="insert into images (name,raw) value ('$name','$image')";
                            $result=mysqli_query($db,$sql);
                            //if($result) echo "<br>Image Uploaded";
                            $sql="select * from images where name='$name'";
                            $result=mysqli_query($db,$sql);
                            if($row = mysqli_fetch_array($result)){
                                echo '<img width="300px" src="data:image;base64,'.$row[2].' ">';
                                echo "<br><br>Image Uploaded<br>";
                                $reset="Upload Another";
                            }
                        }
                    } //else { $error = ""; }
                    ?>
                    <br>
                    <input type="submit" value="<?php echo $reset; ?>" name="submit" class = "box">
                    <input type="submit" value="Home" name="back" class = "box" align = "right">
                    <?php if(isset($_POST["back"])) { header("Location: home.php"); } ?>
                </form>
               <div style = "font-size:11px; color:#cc0000; margin-top:10px"><?php echo $error; ?></div>
            </div>
         </div>
      </div>

    </body>
</html>