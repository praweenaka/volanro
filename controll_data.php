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

if ($_GET["Command"] == "setitem") {

    header('Content-Type: text/xml');
    $ResponseXML = "";
    $ResponseXML .= "<salesdetails>";
    $sql = "delete from booking_tmp where id='" . $_GET['id'] . "' and uniq='" . $_GET['uniq'] . "'";
    $result = $conn->query($sql);

    $sql = "select * from booking_tmp where booking_code='" . $_GET['booking_code'] . "' and uniq='" . $_GET['uniq'] . "' and a_room='" . $_GET['a_room'] . "' ";
    $result = $conn->query($sql);
    if ($row = $result->fetch()) {
        echo "Already Add Table";
        exit();
    }
    if ($_GET["Command1"] == "add_tmp") {

        $sql = "Insert into booking_tmp (booking_code,category,packege,a_room,n_adult,n_child,e_person,date_from,date_to,uniq)values
			('" . $_GET['booking_code'] . "', '" . $_GET['category'] . "', '" . $_GET['packege'] . "','" . $_GET['a_room'] . "','" . $_GET['n_adult'] . "','" . $_GET['n_child'] . "','" . $_GET['e_person'] . "','" . $_GET['from'] . "','" . $_GET['to'] . "','" . $_GET['uniq'] . "') ";

        $result = $conn->query($sql);

        if (!$result) {
            echo $sql . "<br>";
            echo mysqli_error($GLOBALS['dbinv']);
        }
    }
    $ResponseXML .= "<sales_table><![CDATA[<table class=\"table\"> ";

    $i = 1;

    $sql = "Select * from booking_tmp where uniq='" . $_GET['uniq'] . "'";
    foreach ($conn->query($sql) as $row) {
        $ResponseXML .= "<tr>
                         <td>" . $row['date_from'] . "</td>
                         <td>" . $row['date_to'] . "</td>
                         <td>" . $row['category'] . "</td>
                         <td>" . $row['packege'] . "</td>
                         <td>" . $row['a_room'] . "</td>
                         <td>" . $row['n_adult'] . "</td>
                         <td>" . $row['n_child'] . "</td>
                         <td>" . $row['e_person'] . "</td> 
                         <td><a class=\"btn btn-danger btn-xs\" onClick=\"del_tmpitem('" . $row['id'] . "')\"> <span class='fa fa-remove'></span></a></td>
                         </tr>";

        $i = $i + 1;
    }

    $ResponseXML .= "</table>]]></sales_table>";
//    $ResponseXML .= "<item_count><![CDATA[" . $i . "]]></item_count>"; 
    $ResponseXML .= "</salesdetails>";
    echo $ResponseXML;
}

if ($_GET["Command"] == "save_cat_item") {

    try {
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $conn->beginTransaction();
        $sql = "select * from category where category='" . $_GET['category_name'] . "' ";
        $result = $conn->query($sql);
        if ($row = $result->fetch()) {
            echo "Already Entered";
            exit();
        }

        $sql = "Insert into category (category,sdate) values 
		('" . $_GET['category_name'] . "','" . date("Y-m-d") . "')";
        $result = $conn->query($sql);

        $sqlp = "select id from category where cancel='0' order by id desc LIMIT 1";
        $result = $conn->query($sqlp);
        $rowp = $result->fetch();

        for ($index = 1; $index < 5; $index++) {

            $sql1 = "insert into room_cat_price (room_catergory_id, type)values
                     ('{$rowp[0]}','$index')";
            $result1 = $conn->query($sql1);
        }

        $sql = "insert into entry_log(refno, username, docname, trnType, stime, sdate) values ('10', '" . $_SESSION["CURRENT_USER"] . "', 'Category', 'Save', '" . date("Y-m-d H:i:s") . "', '" . date("Y-m-d") . "')";
        $result = $conn->query($sql);



        $conn->commit();
        echo "Saved Category";
    } catch (Exception $e) {
        $conn->rollBack();
        echo $e;
    }
}

if ($_GET['Command'] == "update_cat_item") {

    $sql = "update category   set   category='" . $_GET['name'] . "'   where  id='" . $_GET['id'] . "'";
    $result = $conn->query($sql);
    echo "Update Category";
}
if ($_GET['Command'] == "remove_cat_item") {

    $sql = "update category   set   cancel='1'   where  id='" . $_GET['id'] . "'";
    $result = $conn->query($sql);

    $sql = "update room_cat_price   set   cancel='1'   where  room_cat_price_id='" . $_GET['id'] . "'";
    $result = $conn->query($sql);


    echo "Delete Category";
}

if ($_GET["Command"] == "save_room_no") {

    try {
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $conn->beginTransaction();
        $sql = "select * from room_category where room_no='" . $_GET['room_num'] . "' ";
        $result = $conn->query($sql);
        if ($row = $result->fetch()) {
            echo "Already Entered";
            exit();
        }

        $sql = "Insert into room_category (room_no,category) values 
		('" . $_GET['room_num'] . "','" . $_GET['room_cat'] . "')";

        $result = $conn->query($sql);


        $sql = "insert into entry_log(refno, username, docname, trnType, stime, sdate) values ('10', '" . $_SESSION["CURRENT_USER"] . "', 'Room No', 'Save', '" . date("Y-m-d H:i:s") . "', '" . date("Y-m-d") . "')";
        $result = $conn->query($sql);



        $conn->commit();
        echo "Saved RoomCategory";
    } catch (Exception $e) {
        $conn->rollBack();
        echo $e;
    }
}


if ($_GET['Command'] == "update_room_item") {

    $sql = "update room_category   set   category='" . $_GET['category'] . "'   where  room_no='" . $_GET['room_no'] . "'";

    $result = $conn->query($sql);
    echo "Update Room";
}

if ($_GET['Command'] == "remove_room_item") {

    $sql = "update room_category   set   cancel='1'   where  room_no='" . $_GET['room_no'] . "'";

    $result = $conn->query($sql);
    echo "Delete Room";
}

if ($_GET['Command'] == "update_catpack_item") {

    $room_cat_price_id = $_GET["room_cat_price_id"];
    $bedtype = $_GET["bedtype"];
    $price = $_GET["price"];
    $adult = $_GET["adult"];
    $child = $_GET["child"];
    $room_no = $_GET["room_no"];

    $sql = "update room_cat_price  set  "
            . " bdtype='$bedtype',"
            . " price='$price',"
            . " adult='$adult',"
            . " child='$child',"
            . " room_no='$room_no' "
            . " where idroom_cat_price='{$room_cat_price_id}'";

    $result = $conn->query($sql);
    echo "Update Category Packege";
}
?>