function donationType(val){
	var x = val;
	switch(x){
		case '':
			document.getElementById("textboxItem").style.display = "none";
			document.getElementById("textboxAmount").style.display = "none";
			break;
		case '301':
			document.getElementById("textboxItem").style.display = "block";
			document.getElementById("textboxAmount").style.display = "none";
			document.getElementById("input-textboxItem").required = true;
			document.getElementById("input-textboxAmount").required = false;
		break;
		case '302':
			document.getElementById("textboxItem").style.display = "none";
			document.getElementById("textboxAmount").style.display = "block";
			document.getElementById("input-textboxItem").required = false;
			document.getElementById("input-textboxAmount").required = true;
		break;
	}
}
function isNumberKey(evt) {
    var charCode = (evt.which) ? evt.which : event.keyCode;
    if ((charCode < 48 || charCode > 57))
        return false;

    return true;
}
