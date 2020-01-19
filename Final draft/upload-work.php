<?php

    //https://www.w3schools.com/php/php_file_upload.asp
    //include("dbs.cgi");
    include("session.cgi");
    //include("dbs.cgi");
    
    //$target_dir = "uploads/";
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Upload</title>
        <style>
            .box__dragndrop,
            .box__uploading,
            .box__success,
            .box__error {
                display: none;
            }
            .box.has-advanced-upload {
                background-color: white;
                outline: 2px dashed black;
                outline-offset: -10px;
            }
            .box.has-advanced-upload .box__dragndrop {
                display: inline;
            }
            .box.is-dragover {
                background-color: grey;
            }
        </style>
        <script>
            var isAdvancedUpload = function() {
                var div = document.createElement('div');
                    return (('draggable' in div) || ('ondragstart' in div && 'ondrop' in div)) && 'FormData' in window && 'FileReader' in window;
            }();
            var $form = $('.box');
            if (isAdvancedUpload) {

                var droppedFiles = false;

                $form.on('drag dragstart dragend dragover dragenter dragleave drop', function(e) {
                    e.preventDefault();
                    e.stopPropagation();
                })
                .on('dragover dragenter', function() {
                    $form.addClass('is-dragover');
                })
                .on('dragleave dragend drop', function() {
                    $form.removeClass('is-dragover');
                })
                .on('drop', function(e) {
                    droppedFiles = e.originalEvent.dataTransfer.files;
                });

            }
        </script>
    </head>
    <body bgcolor = "#FFFFFF">
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
        <form method="post" action="" enctype="multipart/form-data" class="box has-advanced-upload">
        
            <div class="box__input">
                <svg class="box__icon" xmlns="http://www.w3.org/2000/svg" width="50" height="43" viewBox="0 0 50 43"><path d="M48.4 26.5c-.9 0-1.7.7-1.7 1.7v11.6h-43.3v-11.6c0-.9-.7-1.7-1.7-1.7s-1.7.7-1.7 1.7v13.2c0 .9.7 1.7 1.7 1.7h46.7c.9 0 1.7-.7 1.7-1.7v-13.2c0-1-.7-1.7-1.7-1.7zm-24.5 6.1c.3.3.8.5 1.2.5.4 0 .9-.2 1.2-.5l10-11.6c.7-.7.7-1.7 0-2.4s-1.7-.7-2.4 0l-7.1 8.3v-25.3c0-.9-.7-1.7-1.7-1.7s-1.7.7-1.7 1.7v25.3l-7.1-8.3c-.7-.7-1.7-.7-2.4 0s-.7 1.7 0 2.4l10 11.6z"></path></svg>
                <input type="file" name="imageUp" id="imageUp" class="box__file">
                <label for="file"><strong>Choose a file</strong><span class="box__dragndrop"> or drag it here</span>.</label>
                <button type="submit" value="<?php echo $reset; ?>" name="submit" class = "box__button">
                <button type="submit" value="Home" name="back" align = "right">
                <?php if(isset($_POST["back"])) { header("Location: home.php"); } ?>
            </div>


            <div class="box__uploading">Uploading…</div>
            <div class="box__success">Done! <a href="upload.php" class="box__restart" role="button">Upload more?</a></div>
            <div class="box__error">Error! <span></span>. <a href="upload.php" class="box__restart" role="button">Try again!</a></div>
            <input type="hidden" name="ajax" value="1"></form>
        
        
    </body>
</html>