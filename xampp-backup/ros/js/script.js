function setOrder(subid,cid,prodid){
    window.location = "order/setorder.php?subid=" + subid + "&id=" + cid + "&proid=" + prodid;
}

function cancelOrder(subid){
    var r = confirm("Cancel Order?");
    if (r == true) {
        window.location = "order/cancel.php?sub=" + subid;
    }
}

