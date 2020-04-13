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

function new_ent() {

//    document.getElementById('category').value = "";
//    document.getElementById('packege').value = "";
//    document.getElementById('a_room').value = "";
//    document.getElementById('n_adult').value = "";
//    document.getElementById('n_child').value = "";
//    document.getElementById('e_person').value = "";
//    
//    
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
    document.getElementById('msg_box1').innerHTML = "";

    getdt();
//    location.reload();
}

function getdt() {

    xmlHttp = GetXmlHttpObject();
    if (xmlHttp === null) {
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


function add_tmp12() {


    xmlHttp = GetXmlHttpObject();
    if (xmlHttp == null) {
        alert("Browser does not support HTTP Request");
        return;
    }
    document.getElementById('msg_box1').innerHTML = "";
    if (document.getElementById('code').value == "") {
        document.getElementById('msg_box').innerHTML = "<div class='alert alert-warning' role='alert'><span class='center-block'>New Is Not Selected</span></div>";
        return false;
    }
    if (document.getElementById('uniq').value == "") {
        document.getElementById('msg_box').innerHTML = "<div class='alert alert-warning' role='alert'><span class='center-block'>New Is Not Selected</span></div>";
        return false;
    }
    if (document.getElementById('from').value == "") {
        document.getElementById('msg_box').innerHTML = "<div class='alert alert-warning' role='alert'><span class='center-block'>Date From Is Not Selected</span></div>";
        return false;
    }
    if (document.getElementById('to').value == "") {
        document.getElementById('msg_box').innerHTML = "<div class='alert alert-warning' role='alert'><span class='center-block'>Date To Is Not Selected</span></div>";
        return false;
    }

    var url = "booking_data.php";
    url = url + "?Command=" + "setitem";
    url = url + "&Command1=" + "add_tmp";

    var res = document.getElementById('code').value;
    res = res.substring(1);

    url = url + "&uniq=" + document.getElementById('uniq').value;
    url = url + "&booking_code=" + document.getElementById('code').value;
    url = url + "&category=" + document.getElementById('category').value;
    url = url + "&packege=" + document.getElementById('packege').value;
    url = url + "&a_room=" + document.getElementById('a_room').value;
    url = url + "&n_adult=" + document.getElementById('n_adult').value;
    url = url + "&n_child=" + document.getElementById('n_child').value;

    url = url + "&from=" + document.getElementById('from').value;
    url = url + "&to=" + document.getElementById('to').value;

    document.getElementById('msg_box').innerHTML = "";
    document.getElementById('msg_box1').innerHTML = "";

    xmlHttp.onreadystatechange = re_add_tmp;
    xmlHttp.open("GET", url, true);
    xmlHttp.send(null);


}

function re_add_tmp() {
    var XMLAddress1;

    if (xmlHttp.readyState == 4 || xmlHttp.readyState == "complete") {
        if (xmlHttp.responseText == "Already Add Table") {
            document.getElementById('msg_box').innerHTML = "<div class='alert alert-warning' role='alert'><span class='center-block'>Already Added Table..</span></div>";

        } else {
            XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("sales_table");
            document.getElementById('itemdetails').innerHTML = XMLAddress1[0].childNodes[0].nodeValue;
        }

    }
}


function del_tmpitem(cdate) {

    xmlHttp = GetXmlHttpObject();
    if (xmlHttp == null) {
        alert("Browser does not support HTTP Request");
        return;
    }

    var url = "booking_data.php";
    url = url + "?Command=" + "setitem";
    url = url + "&Command1=" + "del_item";
    url = url + "&id=" + cdate;
    url = url + "&booking_code=" + document.getElementById('code').value;
    url = url + "&uniq=" + document.getElementById('uniq').value;

    document.getElementById('msg_box').innerHTML = "";

    xmlHttp.onreadystatechange = re_add_tmp;
    xmlHttp.open("GET", url, true);
    xmlHttp.send(null);

}



function save_inv1() {

    xmlHttp = GetXmlHttpObject();
    if (xmlHttp == null) {
        alert("Browser does not support HTTP Request");
        return;
    }
    if (document.getElementById('code').value == "") {
        document.getElementById('msg_box1').innerHTML = "<div class='alert alert-warning' role='alert'><span class='center-block'>New Is Not Selected</span></div>";
        return false;
    }
    if (document.getElementById('uniq').value == "") {
        document.getElementById('msg_box1').innerHTML = "<div class='alert alert-warning' role='alert'><span class='center-block'>New Is Not Selected</span></div>";
        return false;
    }
    if (document.getElementById('itemdetails').innerHTML == "") {
        document.getElementById('msg_box1').innerHTML = "<div class='alert alert-warning' role='alert'><span class='center-block'>Plz Fill Booking Details</span></div>";
        return false;
    }
    if (document.getElementById('name').value == "") {
        document.getElementById('msg_box1').innerHTML = "<div class='alert alert-warning' role='alert'><span class='center-block'>Guest Name Is Not Selected</span></div>";
        return false;
    }
    if (document.getElementById('nic').value == "") {
        document.getElementById('msg_box1').innerHTML = "<div class='alert alert-warning' role='alert'><span class='center-block'>Nic Is Not Selected</span></div>";
        return false;
    }




    var url = "booking_data.php";
    url = url + "?Command=" + "save_item";


    url = url + "&booking_code=" + document.getElementById('code').value;
    url = url + "&uniq=" + document.getElementById('uniq').value;
    url = url + "&nic=" + document.getElementById('nic').value;
    url = url + "&name=" + document.getElementById('name').value;
    url = url + "&address=" + document.getElementById('address').value;
    url = url + "&contact=" + document.getElementById('contact').value;
    url = url + "&email=" + document.getElementById('email').value;
    url = url + "&no_vehi=" + document.getElementById('no_vehi').value;
    url = url + "&t_agent=" + document.getElementById('t_agent').value;
    url = url + "&advance=" + document.getElementById('advance').value;

    xmlHttp.onreadystatechange = salessaveresult;
    xmlHttp.open("GET", url, true);
    xmlHttp.send(null);

}

function salessaveresult() {
    var XMLAddress1;

    if (xmlHttp.readyState == 4 || xmlHttp.readyState == "complete") {

        if (xmlHttp.responseText == "Saved") {
            document.getElementById('msg_box1').innerHTML = "<div class='alert alert-success' role='alert'><span class='center-block'>Saved</span></div>";

            setTimeout(function () {
//                $("#msg_box").hide().slideDown(400).delay(2000);
//                $("#msg_box").slideUp(400);
                location.reload()
                new_ent();
            }, 1500);

        } else {
            document.getElementById('msg_box1').innerHTML = "<div class='alert alert-warning' role='alert'><span class='center-block'>" + xmlHttp.responseText + "</span></div>";
        }
    }
}



function avaroom() {

    xmlHttp = GetXmlHttpObject();
    if (xmlHttp == null) {
        alert("Browser does not support HTTP Request");
        return;
    }

    var url = "booking_data.php";
    url = url + "?Command=" + "aviable_room";
    url = url + "&packege=" + document.getElementById('packege').value;
    url = url + "&category=" + document.getElementById('category').value;


    xmlHttp.onreadystatechange = re_avaroom;
    xmlHttp.open("GET", url, true);
    xmlHttp.send(null);

}
function re_avaroom() {
    var XMLAddress1;

    if (xmlHttp.readyState == 4 || xmlHttp.readyState == "complete") {

        document.getElementById('ava_room_div').innerHTML = xmlHttp.responseText;
    }
}

function loadadu() {

    xmlHttp = GetXmlHttpObject();
    if (xmlHttp == null) {
        alert("Browser does not support HTTP Request");
        return;
    }

    var url = "booking_data.php";
    url = url + "?Command=" + "aviable_adult";
    url = url + "&packege=" + document.getElementById('packege').value;
    url = url + "&category=" + document.getElementById('category').value;


    xmlHttp.onreadystatechange = re_avaadult;
    xmlHttp.open("GET", url, true);
    xmlHttp.send(null);

}
function re_avaadult() {
    var XMLAddress1;

    if (xmlHttp.readyState == 4 || xmlHttp.readyState == "complete") {

        document.getElementById('div_adult').innerHTML = xmlHttp.responseText;
    }
}
function loadchild() {

    xmlHttp = GetXmlHttpObject();
    if (xmlHttp == null) {
        alert("Browser does not support HTTP Request");
        return;
    }

    var url = "booking_data.php";
    url = url + "?Command=" + "aviable_child";
    url = url + "&packege=" + document.getElementById('packege').value;
    url = url + "&category=" + document.getElementById('category').value;


    xmlHttp.onreadystatechange = re_avachild;
    xmlHttp.open("GET", url, true);
    xmlHttp.send(null);

}
function re_avachild() {
    var XMLAddress1;

    if (xmlHttp.readyState == 4 || xmlHttp.readyState == "complete") {

        document.getElementById('div_child').innerHTML = xmlHttp.responseText;
    }
}


  