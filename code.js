/*code.js aside-elementin kuvien vaihtaminen toiseen tietyn aikamäärä välein*/

var asideKuvat = ["images/onnea2.jpg","images/onnea4.png","images/halloween3.jpg","images/halloween5.jpg","images/ystävänpäivä3.png","images/ystävänpäivä7.png","images/kutsu2.png","images/kutsu4.png"];
var asideLinkit = ["kategoria.php?kategoria=onnittelut","kategoria.php?kategoria=halloween","kategoria.php?kategoria=ystävänpäivä","kategoria.php?kategoria=kutsukortit"];
var asideOtsikot = ["Onnittelut","Halloween","Ystävänpäivä","Kutsukortit"];
var x = 0, y = 0;


function seuraavaKuva() {
	document.getElementById("asideImg1").src = asideKuvat[x];
	document.getElementById("asideImg2").src = asideKuvat[x+1];
	document.getElementById("asideLink").href = asideLinkit[y];
	document.getElementById("asideOtsikko").innerHTML = asideOtsikot[y];
    x = x+2;
	y++;
    if(x == asideKuvat.length){
        x = 0;
    }
	if(y == asideLinkit.length){
		y = 0;
	}
}

function vaihdaKuva() {
	setInterval(seuraavaKuva, 7000);
}
