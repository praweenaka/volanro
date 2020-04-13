function GetXmlHttpObject() {
    var xmlHttp = null;
    try {
        // Firefox, Opera 8.0+, Safari
        xmlHttp = new XMLHttpRequest();
    } catch (e) {
        // Internet Explorer
        try {
            xmlHttp = new ActiveXObject("Msxml2.XMLHTTP");
        } catch (e) {
            xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
    }
    return xmlHttp;
}

function keyset(key, e) {

    if (e.keyCode == 13) {
        document.getElementById(key).focus();
    }
}

function got_focus(key) {
    document.getElementById(key).style.backgroundColor = "#000066";

}

function lost_focus(key) {
    document.getElementById(key).style.backgroundColor = "#000000";

}

function newent() {

//    document.getElementById('category').value = "";
//    document.getElementById('packege').value = "";
//    document.getElementById('a_room').value = "";
//    document.getElementById('n_adult').value = "";
//    document.getElementById('n_child').value = "";
//    document.getElementById('e_person').value = "";
    document.getElementById('from').value = "";
    document.getElementById('to').value = "";
    document.getElementById('code').value = "";
    document.getElementById('uniq').value = "";
    document.getElementById('nic').value = "";
    document.getElementById('name').value = "";
    document.getElementById('address').value = "";
    document.getElementById('contact').value = "";
    document.getElementById('email').value = "";
    document.getElementById('no_vehi').value = "";
    document.getElementById('t_agent').value = "";
    document.getElementById('advance').value = "";

    document.getElementById('itemdetails').innerHTML = "";
    document.getElementById('msg_box').innerHTML = "";

    getdt();
}

function getdt() {

    xmlHttp = GetXmlHttpObject();
    if (xmlHttp == null) {
        alert("Browser does not support HTTP Request");
        return;
    }

    var url = "booking_data.php";
    url = url + "?Command=" + "getdt";
    url = url + "&ls=" + "new";

    xmlHttp.onreadystatechange = assign_dt;
    xmlHttp.open("GET", url, true);
    xmlHttp.send(null);

}



function assign_dt() {

    var XMLAddress1;

    if (xmlHttp.readyState == 4 || xmlHttp.readyState == "complete") {

        XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("id");


        var idno = XMLAddress1[0].childNodes[0].nodeValue;

        if (idno.length === 1) {
            idno = "B/0000" + idno;
        } else if (idno.length === 2) {
            idno = "B/000" + idno;
        } else if (idno.length === 3) {
            idno = "B/00" + idno;
        } else if (idno.length === 4) {
            idno = "B/0" + idno;
        } else if (idno.length === 5) {
            idno = "B/" + idno;
        }

        document.form1.code.value = idno;


        XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("uniq");
        document.getElementById("uniq").value = XMLAddress1[0].childNodes[0].nodeValue;
    }
}

function keeper_update(id) {

    xmlHttp = GetXmlHttpObject();
    if (xmlHttp == null) {
        alert("Browser does not support HTTP Request");
        return;
    }

    var url = "house_keeping_data.php";
    url = url + "?Command=" + "update_keeper";

    url = url + "&id=" + id;
    url = url + "&name=" + document.getElementById(id + "keeper").value;
    url = url + "&room_no=" + document.getElementById(id + "roomnum").value;
    url = url + "&from=" + document.getElementById(id + "ftime").value;
    url = url + "&to=" + document.getElementById(id + "ttime").value;
    url = url + "&action=" + document.getElementById(id + "action").value;
    url = url + "&note=" + document.getElementById(id + "note").value;


    xmlHttp.onreadystatechange = result_update_keeper;
    xmlHttp.open("GET", url, true);
    xmlHttp.send(null);

}

function result_update_keeper() {
    var XMLAddress1;

    if (xmlHttp.readyState == 4 || xmlHttp.readyState == "complete") {

        if (xmlHttp.responseText == "Update Keeper") {
            document.getElementById('msg_box').innerHTML = "<div class='alert alert-success' role='alert'><span class='center-block'>Update Keeper..</span></div>";
            setTimeout("location.reload(true);", 500);

        } else {
            document.getElementById('msg_box').innerHTML = "<div class='alert alert-warning' role='alert'><span class='center-block'>" + xmlHttp.responseText + "</span></div>";
        }
    }

}

function remove_keeper(cdata) {


    xmlHttp = GetXmlHttpObject();
    if (xmlHttp === null) {
        alert("Browser does not support HTTP Request");
        return;
    }

    var url = "house_keeping_data.php";
    url = url + "?Command=" + "remove_keeper";
    url = url + "&id=" + cdata;
//    url = url + "&uniq=" + document.getElementById('uniq').value;


    xmlHttp.onreadystatechange = result_remove_keeper;
    xmlHttp.open("GET", url, true);
    xmlHttp.send(null);

}

function result_remove_keeper() {

    var XMLAddress1;

    if (xmlHttp.readyState == 4 || xmlHttp.readyState == "complete") {

        if (xmlHttp.responseText == "Delete Keeper") {
            document.getElementById('msg_box').innerHTML = "<div class='alert alert-success' role='alert'><span class='center-block'>Delete Keeper..</span></div>";
            setTimeout("location.reload(true);", 500);

        } else {
            document.getElementById('msg_box').innerHTML = "<div class='alert alert-warning' role='alert'><span class='center-block'>" + xmlHttp.responseText + "</span></div>";
        }
    }
}
