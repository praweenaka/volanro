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



function save_category() {


    xmlHttp = GetXmlHttpObject();
    if (xmlHttp == null) {
        alert("Browser does not support HTTP Request");
        return;
    }
    if (document.getElementById('category_name').value == "") {
        document.getElementById('msg_box').innerHTML = "<div class='alert alert-warning' role='alert'><span class='center-block'>Category Name Not Entered</span></div>";
        return false;
    }

    var url = "controll_data.php";
    url = url + "?Command=" + "save_cat_item";


    url = url + "&category_name=" + document.getElementById('category_name').value;
//    url = url + "&uniq=" + document.getElementById('uniq').value;


    xmlHttp.onreadystatechange = result_save_cat;
    xmlHttp.open("GET", url, true);
    xmlHttp.send(null);

}

function result_save_cat() {
    var XMLAddress1;

    if (xmlHttp.readyState == 4 || xmlHttp.readyState == "complete") {

        if (xmlHttp.responseText == "Saved Category") {
            document.getElementById('msg_box').innerHTML = "<div class='alert alert-success' role='alert'><span class='center-block'>Category Added..</span></div>";
            document.getElementById('category_name').value = "";
            setTimeout("location.reload(true);", 500);

        } else {
            document.getElementById('msg_box').innerHTML = "<div class='alert alert-warning' role='alert'><span class='center-block'>" + xmlHttp.responseText + "</span></div>";
        }
    }
}

function update_category(id) {

    xmlHttp = GetXmlHttpObject();
    if (xmlHttp == null) {
        alert("Browser does not support HTTP Request");
        return;
    }
//    if (document.getElementById('category_name').value == "") {
//        document.getElementById('msg_box').innerHTML = "<div class='alert alert-warning' role='alert'><span class='center-block'>Category Name Not Entered</span></div>";
//        return false;
//    }
//     
    var name = document.getElementById("myTable").rows[id].cells[0].firstChild.value;

    var url = "controll_data.php";
    url = url + "?Command=" + "update_cat_item";

    url = url + "&id=" + id;
    url = url + "&name=" + name;

    xmlHttp.onreadystatechange = result_update_cat;
    xmlHttp.open("GET", url, true);
    xmlHttp.send(null);

}

function result_update_cat() {
    var XMLAddress1;

    if (xmlHttp.readyState == 4 || xmlHttp.readyState == "complete") {

        if (xmlHttp.responseText == "Update Category") {
            document.getElementById('msg_box').innerHTML = "<div class='alert alert-success' role='alert'><span class='center-block'>Update Category..</span></div>";
            setTimeout("location.reload(true);", 500);

        } else {
            document.getElementById('msg_box').innerHTML = "<div class='alert alert-warning' role='alert'><span class='center-block'>" + xmlHttp.responseText + "</span></div>";
        }
    }

}

function remove_category(cdata) {


    xmlHttp = GetXmlHttpObject();
    if (xmlHttp == null) {
        alert("Browser does not support HTTP Request");
        return;
    }
//    if (document.getElementById('category_name').value == "") {
//        document.getElementById('msg_box').innerHTML = "<div class='alert alert-warning' role='alert'><span class='center-block'>Category Name Not Entered</span></div>";
//        return false;
//    }

    var url = "controll_data.php";
    url = url + "?Command=" + "remove_cat_item";
    url = url + "&id=" + cdata;
//    url = url + "&uniq=" + document.getElementById('uniq').value;


    xmlHttp.onreadystatechange = result_remove_cat;
    xmlHttp.open("GET", url, true);
    xmlHttp.send(null);

}

function result_remove_cat() {

    var XMLAddress1;

    if (xmlHttp.readyState == 4 || xmlHttp.readyState == "complete") {

        if (xmlHttp.responseText == "Delete Category") {
            document.getElementById('msg_box').innerHTML = "<div class='alert alert-success' role='alert'><span class='center-block'>Delete Category..</span></div>";
            setTimeout("location.reload(true);", 500);

        } else {
            document.getElementById('msg_box').innerHTML = "<div class='alert alert-warning' role='alert'><span class='center-block'>" + xmlHttp.responseText + "</span></div>";
        }
    }
}

function room_number_save() {


    xmlHttp = GetXmlHttpObject();
    if (xmlHttp == null) {
        alert("Browser does not support HTTP Request");
        return;
    }
    if (document.getElementById('room_num').value == "") {
        document.getElementById('msg_box_roomNo').innerHTML = "<div class='alert alert-warning' role='alert'><span class='center-block'>Room No Not Entered</span></div>";
        return false;
    }

    var url = "controll_data.php";
    url = url + "?Command=" + "save_room_no";

    url = url + "&room_num=" + document.getElementById('room_num').value;
    url = url + "&room_cat=" + document.getElementById('room_cat').value;


    xmlHttp.onreadystatechange = result_room_number_save;
    xmlHttp.open("GET", url, true);
    xmlHttp.send(null);

}

function result_room_number_save() {

    var XMLAddress1;

    if (xmlHttp.readyState == 4 || xmlHttp.readyState == "complete") {

        if (xmlHttp.responseText == "Saved RoomCategory") {
            document.getElementById('msg_box_roomNo').innerHTML = "<div class='alert alert-success' role='alert'><span class='center-block'>Room Added..</span></div>";
            document.getElementById('room_num').value = "";
            setTimeout("location.reload(true);", 500);

        } else {
            document.getElementById('msg_box_roomNo').innerHTML = "<div class='alert alert-warning' role='alert'><span class='center-block'>" + xmlHttp.responseText + "</span></div>";
        }
    }
}

function room_number_update(room, cat) {

    xmlHttp = GetXmlHttpObject();
    if (xmlHttp == null) {
        alert("Browser does not support HTTP Request");
        return;
    }

    var room_no = document.getElementById("myTable1").rows[room].cells[0].firstChild.value;

    var category = document.getElementById("myTable1").rows[room].cells[1].firstChild.value;

    var url = "controll_data.php";
    url = url + "?Command=" + "update_room_item";

    url = url + "&category=" + category;
    url = url + "&room_no=" + room_no;
    xmlHttp.onreadystatechange = result_room_number_update;
    xmlHttp.open("GET", url, true);
    xmlHttp.send(null);

}

function result_room_number_update() {
    var XMLAddress1;

    if (xmlHttp.readyState == 4 || xmlHttp.readyState == "complete") {

        if (xmlHttp.responseText == "Update Room") {
            document.getElementById('msg_box_roomNo').innerHTML = "<div class='alert alert-success' role='alert'><span class='center-block'>Update Room..</span></div>";
            setTimeout("location.reload(true);", 500);
        } else {
            document.getElementById('msg_box_roomNo').innerHTML = "<div class='alert alert-warning' role='alert'><span class='center-block'>" + xmlHttp.responseText + "</span></div>";
        }
    }

}

function room_number_remove(cdata) {


    xmlHttp = GetXmlHttpObject();
    if (xmlHttp == null) {
        alert("Browser does not support HTTP Request");
        return;
    }
//    if (document.getElementById('category_name').value == "") {
//        document.getElementById('msg_box').innerHTML = "<div class='alert alert-warning' role='alert'><span class='center-block'>Category Name Not Entered</span></div>";
//        return false;
//    }

    var url = "controll_data.php";
    url = url + "?Command=" + "remove_room_item";
    url = url + "&room_no=" + cdata;
//    url = url + "&uniq=" + document.getElementById('uniq').value;


    xmlHttp.onreadystatechange = result_room_number_remove;
    xmlHttp.open("GET", url, true);
    xmlHttp.send(null);

}

function result_room_number_remove() {

    var XMLAddress1;

    if (xmlHttp.readyState == 4 || xmlHttp.readyState == "complete") {

        if (xmlHttp.responseText == "Delete Room") {
            document.getElementById('msg_box_roomNo').innerHTML = "<div class='alert alert-success' role='alert'><span class='center-block'>Delete Room..</span></div>";

            setTimeout("location.reload(true);", 500);
        } else {
            document.getElementById('msg_box_roomNo').innerHTML = "<div class='alert alert-warning' role='alert'><span class='center-block'>" + xmlHttp.responseText + "</span></div>";
        }
    }
}

function update_cat_package(row, room_cat_price_id, cat_id) {

    xmlHttp = GetXmlHttpObject();
    if (xmlHttp == null) {
        alert("Browser does not support HTTP Request");
        return;
    }
    var tble_id = "myTable_cat" + cat_id;

    var bedtype = document.getElementById(tble_id).rows[row].cells[1].firstChild.value;
    var price = document.getElementById(tble_id).rows[row].cells[2].firstChild.value;
    var adult = document.getElementById(tble_id).rows[row].cells[3].firstChild.value;
    var child = document.getElementById(tble_id).rows[row].cells[4].firstChild.value;
    var room_no = document.getElementById(tble_id).rows[row].cells[5].firstChild.value; 

    var url = "controll_data.php";
    url = url + "?Command=" + "update_catpack_item";
    url = url + "&room_cat_price_id=" + room_cat_price_id;
    url = url + "&bedtype=" + bedtype;
    url = url + "&price=" + price;
    url = url + "&adult=" + adult;
    url = url + "&child=" + child; 
    url = url + "&room_no=" + room_no;

    xmlHttp.onreadystatechange = result_catpak_update;
    xmlHttp.open("GET", url, true);
    xmlHttp.send(null);
}

function result_catpak_update() {

    var XMLAddress1;

    if (xmlHttp.readyState == 4 || xmlHttp.readyState == "complete") {

        if (xmlHttp.responseText == "Update Category Packege") {
            document.getElementById('msg_box_catpack').innerHTML = "<div class='alert alert-success' role='alert'><span class='center-block'>Update Category Packege..</span></div>";
            setTimeout("location.reload(true);", 500);

        } else {
            document.getElementById('msg_box_catpack').innerHTML = "<div class='alert alert-warning' role='alert'><span class='center-block'>" + xmlHttp.responseText + "</span></div>";
        }
    }
}