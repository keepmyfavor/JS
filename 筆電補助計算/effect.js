var click = document.getElementById("clickBtn");

function display(){
    var buy = document.getElementById("buy").value;
    var resign = document.getElementById("resign").value;
    var buyCul = new Date(buy);
    var buyCul1 = new Date(buy);
    var resignCul = new Date(resign);
    var duringUsed = Math.abs(resignCul - buyCul) / (1000 * 3600 * 24);
    buyCul1.setFullYear(buyCul1.getFullYear()+2);
    buyCul1.setDate(buyCul1.getDate()+2);
    var twoYear = Math.abs(buyCul1 - buyCul) / (1000 * 3600 * 24) - 2;
    var duringDay = twoYear - duringUsed;
    var subsidy = document.getElementById("subsidy").value;
    document.getElementById("1").innerHTML = buy;
    document.getElementById("2").innerHTML = resign;
    document.getElementById("3").innerHTML = duringUsed;
    document.getElementById("4").innerHTML = duringDay;
    document.getElementById("5").innerHTML = twoYear;
    document.getElementById("6").innerHTML = parseInt((duringDay / twoYear) * subsidy);
    document.getElementById("look").style.display = "block";
}

click.addEventListener("click", display);