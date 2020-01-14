<!DOCTYPE html>
<html lang="en">
    <head>
        <title>BMI</title>
        <link rel="stylesheet" type="text/css" href="bmi.css">
    </head>
    <body>
        <div id="container">
            <?php
                if($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['submit']))
                {
                    $feet = $_POST["feet"];
                    $inch = $_POST["inch"];
                    $weight = $_POST["pounds"];

                    $height = ($feet*12) + $inch;
                    $bmi = number_format(($weight/($height**2))*703, 1);
                    $index = "";

                    switch (true){
                        case $bmi == "nan":
                        case $bmi == "inf":
                            $index = "Invalid Input";
                            break;
                        case $bmi < 18.5:
                            $index = "Underweight";
                            break;
                        case $bmi < 24.9:
                            $index = "Normal";
                            break;
                        case $bmi < 29.9:
                            $index = "Overweight";
                            break;
                        default:
                            $index = "Obese";
                            break;
                    }
                    if ($index == "Invalid Input"){
                        echo "<strong>$index</strong>";
                    }else {
                        if ($index != "Normal"){
                            $bmi = '<strong>' . $bmi . "</strong>";
                        }
                        echo "<h1>Your Height: $feet" . "'" .  $inch . '"'. "</h1>
                        <h1>Your Weight: $weight lb</h1>
                        <h1>Your BMI is " . $bmi . ", You are $index </h1>";
                    }
                }
            ?>
        </div>
    </body>
</html>