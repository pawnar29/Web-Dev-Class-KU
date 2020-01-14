<!DOCTYPE html>
<html lang="en">
    <head>
        <title>BMI</title>
        <link rel="stylesheet" type="text/css" href="bmi.css">
    </head>
    <body>
        <div id="container">
            <h1>Body Mass Index Calculator</h1>
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                <div id="height">
                    <p>Your Height:</p>
                    <label>Feet: <input type="number" id="feet" name="feet" required="required"></label>
                    <label>Inch(es): <input type="number" id="inch" name="inch" required="required" min="0" max="11"></label>
                </div>
                <div id="weight">
                    <p>Your Weight:</p>
                    <label>Pounds: <input type="number" id="pounds" name="pounds" required="required"></label>
                </div>
                <input type="submit" id="submit" name="submit" value="Calculate">
            </form>
            <div id="formFooter">IT330, The University of Kansas, Edwards Campus</div>
            <?php
                include 'code.php';
            ?>
            <table>
                <tr>
                    <td>Underweight</td>
                    <td>< 18.5</td>
                </tr>
                <tr>
                    <td>Normal weight</td>
                    <td>18.5 - 24.9</td>
                </tr>
                <tr>
                    <td>Overrweight</td>
                    <td>25 - 29.9</td>
                </tr>
                <tr>
                    <td>Obesity</td>
                    <td>30 or greater</td>
                </tr>
            </table>
        </div>
    </body>
</html>
