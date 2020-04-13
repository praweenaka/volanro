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


    document.getElementById('meal').value = "";
    document.getElementById('qty').value = "";
    document.getElementById('datetime').value = "";
    document.getElementById('note').value = "";
    document.getElementById('mealcharge').value = "";
    document.getElementById('roomchargetot').value = "";
    document.getElementById('advance').value = "";
    document.getElementById('gtot').value = "";

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

    var url = "payment_data.php";
    url = url + "?Command=" + "getdt";
    url = url + "&ls=" + "new";

    xmlHttp.onreadystatechange = assign_dt;
    xmlHttp.open("GET", url, true);
    xmlHttp.send(null);

}



function assign_dt() {

    var XMLAddress1;

    if (xmlHttp.readyState == 4 || xmlHttp.readyState == "complete") {

//        XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("id");
//
//
//        var idno = XMLAddress1[0].childNodes[0].nodeValue;
//
//        if (idno.length === 1) {
//            idno = "B/0000" + idno;
//        } else if (idno.length === 2) {
//            idno = "B/000" + idno;
//        } else if (idno.length === 3) {
//            idno = "B/00" + idno;
//        } else if (idno.length === 4) {
//            idno = "B/0" + idno;
//        } else if (idno.length === 5) {
//            idno = "B/" + idno;
//        }
//
//        document.form1.code.value = idno;
//
//
//        XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("uniq");
//        document.getElementById("uniq").value = XMLAddress1[0].childNodes[0].nodeValue;

        XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("content");
        document.getElementById("itemdetails").innerHTML = XMLAddress1[0].childNodes[0].nodeValue;
    }
}


function add_tmp() {


    xmlHttp = GetXmlHttpObject();
    if (xmlHttp == null) {
        alert("Browser does not support HTTP Request");
        return;
    }

    if (document.getElementById('meal').value == "") {
        document.getElementById('msg_box').innerHTML = "<div class='alert alert-warning' role='alert'><span class='center-block'>Meal Name Not Entered</span></div>";
        return false;
    }
    if (document.getElementById('qty').value == "") {
        document.getElementById('msg_box').innerHTML = "<div class='alert alert-warning' role='alert'><span class='center-block'>Qty Not Entered</span></div>";
        return false;
    }



    var url = "add_meals_data.php";
    url = url + "?Command=" + "setitem";
    url = url + "&Command1=" + "add_tmp";
    url = url + "&room_no=" + document.getElementById('room_no').value;
    url = url + "&meal=" + document.getElementById('meal').value;
    url = url + "&qty=" + document.getElementById('qty').value;
    url = url + "&datetime=" + document.getElementById('datetime').value;
    url = url + "&note=" + document.getElementById('note').value;
    url = url + "&amount=" + document.getElementById('amount').value;

    document.getElementById('msg_box').innerHTML = "";
    xmlHttp.onreadystatechange = result_addtmp;
    xmlHttp.open("GET", url, true);
    xmlHttp.send(null);


}

function del_mealitem(cdate) {

    xmlHttp = GetXmlHttpObject();
    if (xmlHttp == null) {
        alert("Browser does not support HTTP Request");
        return;
    }

    var url = "add_meals_data.php";
    url = url + "?Command=" + "setitem";
    url = url + "&Command1=" + "del_item";

    url = url + "&room_no=" + document.getElementById('room_no').value;
    url = url + "&id=" + cdate;

    xmlHttp.onreadystatechange = result_addtmp;
    xmlHttp.open("GET", url, true);
    xmlHttp.send(null);

}

function update_item(id) {

    xmlHttp = GetXmlHttpObject();
    if (xmlHttp == null) {
        alert("Browser does not support HTTP Request");
        return;
    }

    var name = document.getElementById("itemdetails").rows[id].cells[0].firstChild.value;

    var url = "add_meals_data.php";
    url = url + "?Command=" + "update_item";

    url = url + "&id=" + id;
    url = url + "&name=" + name;
    alert(url);
    xmlHttp.onreadystatechange = result_addtmp;
    xmlHttp.open("GET", url, true);
    xmlHttp.send(null);

}


function result_addtmp() {
    var XMLAddress1;

    if (xmlHttp.readyState == 4 || xmlHttp.readyState == "complete") {

//        if (XMLAddress1[0].childNodes[0].nodeValue != "") {
//            document.getElementById('msg_box').innerHTML = "<div class='alert alert-warning' role='alert'><span class='center-block'>" + XMLAddress1[0].childNodes[0].nodeValue + "</span></div>";
//
//        } else {
//            document.getElementById('msg_box').innerHTML = "";
//
//        }

        XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("sales_table");
        document.getElementById('itemdetails').innerHTML = XMLAddress1[0].childNodes[0].nodeValue;

//        XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("item_count");
//        document.getElementById('item_count').value = XMLAddress1[0].childNodes[0].nodeValue;

        XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("gtot");
        document.getElementById('gtot').value = XMLAddress1[0].childNodes[0].nodeValue;

        document.getElementById('meal').value = "";
        document.getElementById('qty').value = "";
        document.getElementById('datetime').value = "";
        document.getElementById('note').value = "";
        document.getElementById('amount').value = "";

        document.getElementById('meal').focus();

    }
}



function save_inv() {


    xmlHttp = GetXmlHttpObject();
    if (xmlHttp == null) {
        alert("Browser does not support HTTP Request");
        return;
    }

    if (document.getElementById('itemdetails').innerHTML == "") {
        document.getElementById('msg_box').innerHTML = "<div class='alert alert-warning' role='alert'><span class='center-block'>Meal Not Entered</span></div>";
        return false;
    }



    var url = "add_meals_data.php";
    url = url + "?Command=" + "save_inv";
    url = url + "&room_no=" + document.getElementById('room_no').value;

    document.getElementById('msg_box').innerHTML = "";

    xmlHttp.onreadystatechange = result_save;
    xmlHttp.open("GET", url, true);
    xmlHttp.send(null);


}

function result_save() {
    var XMLAddress1;

    if (xmlHttp.readyState == 4 || xmlHttp.readyState == "complete") {

        if (xmlHttp.responseText == "Saved Meal Plan") {
            document.getElementById('msg_box').innerHTML = "<div class='alert alert-success' role='alert'><span class='center-block'>Saved Meal Plan..</span></div>";


        } else {
            document.getElementById('msg_box').innerHTML = "<div class='alert alert-warning' role='alert'><span class='center-block'>" + xmlHttp.responseText + "</span></div>";
        }
    }

}

function update_cust_list(stname)
{


    xmlHttp = GetXmlHttpObject();
    if (xmlHttp == null)
    {
        alert("Browser does not support HTTP Request");
        return;
    }


    var url = "add_meals_data.php";
    url = url + "?Command=" + "update_list";

    if (document.getElementById('cusno').value != "") {
        url = url + "&mstatus=cusno";
    }


    url = url + "&cusno=" + document.getElementById('cusno').value;
    url = url + "&stname=" + stname;


    xmlHttp.onreadystatechange = showcustresult;
    xmlHttp.open("GET", url, true);
    xmlHttp.send(null);


}

function showcustresult()
{
    var XMLAddress1;

    if (xmlHttp.readyState == 4 || xmlHttp.readyState == "complete")
    {


        document.getElementById('filt_table').innerHTML = xmlHttp.responseText;
    }
}

function custno(code)
{
    //alert(code);
    xmlHttp = GetXmlHttpObject();
    if (xmlHttp == null)
    {
        alert("Browser does not support HTTP Request");
        return;
    }
    var url = "add_meals_data.php";
    url = url + "?Command=" + "pass_quot";
    url = url + "&custno=" + code;

    xmlHttp.onreadystatechange = passcusresult_quot;
    xmlHttp.open("GET", url, true);
    xmlHttp.send(null);

}

function passcusresult_quot()
{
    var XMLAddress1;

    if (xmlHttp.readyState == 4 || xmlHttp.readyState == "complete")
    {

        XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("gtot");
        document.form1.gtot.value = XMLAddress1[0].childNodes[0].nodeValue;

        XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("sales_table");
        document.getElementById('itemdetails').innerHTML = XMLAddress1[0].childNodes[0].nodeValue;

//        $('#addmealorderlist').modal('hide');
    }


}
//===================================================================================================


function meallist()
{

    xmlHttp = GetXmlHttpObject();
    if (xmlHttp == null)
    {
        alert("Browser does not support HTTP Request");
        return;
    }
    var url = "payment_data.php";
    url = url + "?Command=" + "meal_list";
 
    url = url + "&roomno=" + document.getElementById("room_no").value;
 
    xmlHttp.onreadystatechange = result_meallist;
    xmlHttp.open("GET", url, true);
    xmlHttp.send(null);

}

function result_meallist()
{
    var XMLAddress1; 
    if (xmlHttp.readyState == 4 || xmlHttp.readyState == "complete")
    {

        XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("mealcharge");
        document.form1.mealcharge.value = XMLAddress1[0].childNodes[0].nodeValue;

        XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("sales_table");
        document.getElementById('itemdetails').innerHTML = XMLAddress1[0].childNodes[0].nodeValue;

//        $('#addmealorderlist').modal('hide');
    }


}
function subtot()
{

    xmlHttp = GetXmlHttpObject();
    if (xmlHttp == null) {
        alert("Browser does not support HTTP Request");
        return;
    }

    var url = "payment_data.php";
    url = url + "?Command=" + "roomcharge_tot";

//    url = url + "&tot=" + total;
    url = url + "&roomcharge=" + document.getElementById('roomcharge').value;
    url = url + "&wifi=" + document.getElementById('wifi').value;
    url = url + "&ac=" + document.getElementById('ac').value;
    url = url + "&damage=" + document.getElementById('damage').value;
    url = url + "&other=" + document.getElementById('other').value;
   
    xmlHttp.onreadystatechange = result_roomchrtot;
    xmlHttp.open("GET", url, true);
    xmlHttp.send(null);



}


function result_roomchrtot() {


    var XMLAddress1;
//    if (xmlHttp.readyState == 4 || xmlHttp.readyState == "complete") {

    XMLAddress1 = xmlHttp.responseXML.getElementsByTagName("tot");
    document.getElementById('roomchargetot').value = XMLAddress1[0].childNodes[0].nodeValue;

//    }
}



function grandtot()
{

    var num1 = parseFloat(document.getElementById("mealcharge").value);
    var num2 = parseFloat(document.getElementById("roomchargetot").value);


    document.getElementById('gtot').value = num1 + num2;






}

function cal() {


    var num1 = parseFloat(document.getElementById("num1").value) || 0;
    var num2 = parseFloat(document.getElementById("num2").value) || 0;


    document.getElementById('ttttt').value = num1 + num2;


}

function print_inv()
{

    var url = "payment_report.php";
    url = url + "?roomno=" + document.getElementById('room_no').value;

    window.open(url);

}