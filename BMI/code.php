<?php

    if($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['submit']))
    {
        calculateBMI();
    }
    function calculateBMI()
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
        $output = "";
        if ($index == "Invalid Input"){
            $output = $index;
        }else {
            $output = "Your Height: " . $feet . "' " . $inch . "\"<br>" .
                        "Your Weight: " . $weight . " LB<br>" .
                        "Your BMI: " . $bmi . "<br>" .
                        $index;
        }
        echo '<p id="result">' . $output . '</p>';
    }
?>
