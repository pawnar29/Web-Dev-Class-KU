<!--<div>Login</div>-->
<!-- <a href="login.php">Login</a>
<a href="home.php">Home</a>
<a href="upload.php">Upload</a> -->


<html>
    <script src="https://code.jquery.com/jquery-1.10.2.js"></script>

    <style type = "text/css">
        body {
            height: 100%;
            margin:0;
        }

        .bg { 
            /* The image used */
            //background-image: url("giphy.gif");

            /* Full height */
            height: 100%;
            width: 100%; 

            /* Center and scale the image nicely */
            background-position: center;
            background-repeat: repeat;
            background-size: cover;
            z-index: 0;
        }
        .ov {
            position: relative; 
            width: 5%;
            height: 5%
            opacity:.25;
            z-index: 1;
        }
        img{
            -webkit-animation:spin 4s linear infinite;
            -moz-animation:spin 10s linear infinite;
            animation:spin 5s linear infinite;
        }

        @-moz-keyframes spin { 150% { -moz-transform: rotate(360deg); } }
        @-webkit-keyframes spin { 50% { -webkit-transform: rotate(360deg); } }
        @keyframes spin { 100% { -webkit-transform: rotate(360deg); transform:rotate(-360deg); } }

    </style>
    <body>
        <img src="giphy.gif" class="bg">
    </body>
    <div class="ov" style="left: 100%;"><img src="link.gif" class="ov"></div>
    <div><img src="link.gif" style="width: 5%; height: 5%;" alt="Login"></div>
    <script>
        var divdbl = $( "div:first" );
        divdbl.dblclick(function() {
            window.location.href = "login.php?login=1";
    });
    </script>
</html>
