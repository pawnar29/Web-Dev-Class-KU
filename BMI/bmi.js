function calculateBMI(e)
{
    var feet = Number(document.getElementById("feet").value);
    var inch = Number(document.getElementById("inch").value);
    var weight = Number(document.getElementById("pounds").value);

    var height = (feet*12) + inch;
    var raw = (weight/(height**2))*703;
    var bmi = raw.toFixed(1);
    var index;
    console.log(bmi);

    switch (true){
        case bmi == "Infinity":
        case bmi == "NaN":
            index = "Invalid Input";
            break;
        case bmi < 18.5:
            index = "Underweight";
            break;
        case bmi < 24.9:
            index = "Normal";
            break;
        case bmi < 29.9:
            index = "Overweight";
            break;
        default:
            index = "Obese";
            break;
    }
    console.log(index);
    var output;
    if (index == "Invalid Input"){
        output = index;
    }else {
        output = "Your Height: " + feet + "' " + inch + "\"<br>" +
                 "Your Weight: " + weight + " LB<br>" +
                 "Your BMI: " + bmi + "<br>" +
                 index;
    }
    document.getElementById("result").innerHTML = output;
}
