function myListeners()
{
    document.getElementById("btn").addEventListener("click", calculate, false);

    function calculate(e)
    {
        var length = Number(document.getElementById("length").value);
        var width = Number(document.getElementById("width").value);

        var result;

        if(document.getElementById("a").checked){
            result = 'Area: ' + (length*width);
        }
        if(document.getElementById("p").checked){
            result = 'Perimeter: ' + 2*(length+width);
        }
        document.getElementById("result").innerHTML = result;
    }
}

window.onload = myListeners;
