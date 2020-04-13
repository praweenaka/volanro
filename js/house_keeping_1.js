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



function keeper_save() {


    xmlHttp = GetXmlHttpObject();
    if (xmlHttp == null) {
        alert("Browser does not support HTTP Request");
        return;
    }
    if (document.getElementById('from').value == "") {
        document.getElementById('msg_box').innerHTML = "<div class='alert alert-warning' role='alert'><span class='center-block'>From Not Entered</span></div>";
        return false;
    }

    var url = "house_keeping_data.php";
    url = url + "?Command=" + "save_keeper";


    url = url + "&room_no=" + document.getElementById('room_no').value;
    url = url + "&keeper=" + document.getElementById('keeper').value;
    url = url + "&from=" + document.getElementById('from').value;
    url = url + "&to=" + document.getElementById('to').value; 
    url = url + "&action=" + document.getElementById('action').value; 


    xmlHttp.onreadystatechange = result_save_keeper;
    xmlHttp.open("GET", url, true);
    xmlHttp.send(null);

}

function result_save_keeper() {
    var XMLAddress1;

    if (xmlHttp.readyState == 4 || xmlHttp.readyState == "complete") {

        if (xmlHttp.responseText == "Saved Keeper") {
            document.getElementById('msg_box').innerHTML = "<div class='alert alert-success' role='alert'><span class='center-block'>Keeper Added..</span></div>";
          
        } else {
            document.getElementById('msg_box').innerHTML = "<div class='alert alert-warning' role='alert'><span class='center-block'>" + xmlHttp.responseText + "</span></div>";
        }
    }
}

function keeper_update(id) {

    xmlHttp = GetXmlHttpObject();
    if (xmlHttp == null) {
        alert("Browser does not support HTTP Request");
        return;
    }
       
    var name = document.getElementById("myTable123").rows[id].cells[0].firstChild.value;
    var action = document.getElementById("myTable123").rows[id].cells[4].firstChild.value;
    var note = document.getElementById("myTable123").rows[id].cells[5].firstChild.value;
 
    var url = "house_keeping_data.php";
    url = url + "?Command=" + "update_keeper";

    url = url + "&id=" + id;
    url = url + "&name=" + name;
    url = url + "&action=" + action;
    url = url + "&note=" + note;
   

    xmlHttp.onreadystatechange = result_update_keeper;
    xmlHttp.open("GET", url, true);
    xmlHttp.send(null);

}

function result_update_keeper() {
    var XMLAddress1;

    if (xmlHttp.readyState == 4 || xmlHttp.readyState == "complete") {

        if (xmlHttp.responseText == "Update Keeper") {
            document.getElementById('msg_box').innerHTML = "<div class='alert alert-success' role='alert'><span class='center-block'>Update Keeper..</span></div>";


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
//    if (document.getElementById('category_name').value == "") {
//        document.getElementById('msg_box').innerHTML = "<div class='alert alert-warning' role='alert'><span class='center-block'>Category Name Not Entered</span></div>";
//        return false;
//    }

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


        } else {
            document.getElementById('msg_box').innerHTML = "<div class='alert alert-warning' role='alert'><span class='center-block'>" + xmlHttp.responseText + "</span></div>";
        }
    }
}
