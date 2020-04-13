<?php

session_start();


require_once ("connection_sql.php");

header('Content-Type: text/xml');

date_default_timezone_set('Asia/Colombo');
if ($_GET["Command"] == "getdt") {
    echo "<?xml version=\"1.0\" encoding=\"utf-8\"?>\n";

    $ResponseXML = "";
    $ResponseXML .= "<new>";

    $sql = "SELECT booking_code FROM invpara";
    $result = $conn->query($sql);

    $row = $result->fetch();
    $no = $row['booking_code'];
    $uniq = uniqid();
    $ResponseXML .= "<id><![CDATA[$no]]></id>";
    $ResponseXML .= "<uniq><![CDATA[$uniq]]></uniq>";

    $ResponseXML .= "</new>";

    echo $ResponseXML;
}



if ($_GET["Command"] == "save_keeper") {

    try {
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $conn->beginTransaction();
//        $sql = "select * from room_category where room_no='" . $_GET['room_num'] . "' ";
//        $result = $conn->query($sql);
//        if ($row = $result->fetch()) {
//            echo "Already Entered";
//            exit();
//        }

        $sql = "Insert into house_keeping (room_no,keeper,from_t,to_t,action) values 
		('" . $_GET['room_no'] . "','" . $_GET['keeper'] . "','" . $_GET['from'] . "','" . $_GET['to'] . "','" . $_GET['action'] . "')";

        $result = $conn->query($sql);


        $sql = "insert into entry_log(refno, username, docname, trnType, stime, sdate) values ('10', '" . $_SESSION["CURRENT_USER"] . "', 'House Keeper work', 'Save', '" . date("Y-m-d H:i:s") . "', '" . date("Y-m-d") . "')";
        $result = $conn->query($sql);



        $conn->commit();
        echo "Saved Keeper";
    } catch (Exception $e) {
        $conn->rollBack();
        echo $e;
    }
}


if ($_GET['Command'] == "update_keeper") {

    $sql = "update house_keeping   set   action='" . $_GET['action'] . "',  note='" . $_GET['note'] . "'   where  id='" . $_GET['id'] . "'";

    $result = $conn->query($sql);
    echo "Update Keeper";
}

if ($_GET['Command'] == "remove_keeper") {

    $sql = "update house_keeping   set   cancel='1'   where  id='" . $_GET['id'] . "'";

    $result = $conn->query($sql);
    echo "Delete Keeper";
}

?>