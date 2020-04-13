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
        $sql1 = "SELECT * FROM category where id='" . $_GET['category'] . "'";
        $result1 = $conn->query($sql1);
        $row1 = $result1->fetch();

        $sql2 = "SELECT * FROM room_type where id='" . $_GET['packege'] . "'";
        $result2 = $conn->query($sql2);
        $row2 = $result2->fetch();

        $sql = "Insert into booking_tmp (booking_code,category,categoryid,packege,a_room,n_adult,n_child,date_from,date_to,uniq)values
			('" . $_GET['booking_code'] . "', '" . $row1['category'] . "','" . $_GET['category'] . "', '" . $row2['name'] . "','" . $_GET['a_room'] . "','" . $_GET['n_adult'] . "','" . $_GET['n_child'] . "','" . $_GET['from'] . "','" . $_GET['to'] . "','" . $_GET['uniq'] . "') ";

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
                         <td><a class=\"btn btn-danger btn-xs\" onClick=\"del_tmpitem('" . $row['id'] . "')\"> <span class='fa fa-remove'></span></a></td>
                         </tr>";

        $i = $i + 1;
    }

    $ResponseXML .= "</table>]]></sales_table>";
//    $ResponseXML .= "<item_count><![CDATA[" . $i . "]]></item_count>"; 
    $ResponseXML .= "</salesdetails>";
    echo $ResponseXML;
}

if ($_GET["Command"] == "save_item") {

    try {
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $conn->beginTransaction();
        $sql = "select * from booking_main where booking_code='" . $_GET['booking_code'] . "' and uniq='" . $_GET['uniq'] . "' ";
        $result = $conn->query($sql);
        if ($row = $result->fetch()) {
            echo "Already Entered";
            exit();
        }

        $sql = "SELECT booking_code FROM invpara";
        $result = $conn->query($sql);
        $row = $result->fetch();
        $idno = $row['booking_code'];

        if (strlen($idno) == 1) {
            $idno = "B/0000" . $idno;
        } else if (strlen($idno) == 2) {
            $idno = "B/000" . $idno;
        } else if (strlen($idno) == 3) {
            $idno = "B/00" + $idno;
        } else if (strlen($idno) == 4) {
            $idno = "B/0" + $idno;
        } else if (strlen($idno) == 5) {
            $idno = "B/" + $idno;
        }

        $tno = $idno;

        $sql = "select * from booking_tmp where booking_code='" . $_GET['booking_code'] . "' and uniq='" . $_GET['uniq'] . "' ";

        foreach ($conn->query($sql) as $row) {
            $sql = "Insert into booking_item (booking_code,category,packege,a_room,n_adult,n_child,date_from,date_to,uniq)values
			('" . $_GET['booking_code'] . "', '" . $row['category'] . "', '" . $row['packege'] . "','" . $row['a_room'] . "','" . $row['n_adult'] . "','" . $row['n_child'] . "','" . $row['date_from'] . "','" . $row['date_to'] . "','" . $row['uniq'] . "') ";

            $result = $conn->query($sql);
        }



        $sql = "Insert into booking_main (booking_code,nic,name,address,contact,email,no_vehi,t_agent,advance,sdate,uniq) values 
		('" . $tno . "', '" . $_GET['nic'] . "','" . $_GET['name'] . "','" . $_GET['address'] . "','" . $_GET['contact'] . "','" . $_GET['email'] . "','" . $_GET['no_vehi'] . "','" . $_GET['t_agent'] . "','" . $_GET['advance'] . "','" . date("Y-m-d") . "','" . $_GET['uniq'] . "')";
        $result = $conn->query($sql);


        $sql = "update invpara set booking_code=booking_code+1";
        $result = $conn->query($sql);


        $sql = "select * from booking_tmp where booking_code='" . $_GET['booking_code'] . "' and uniq='" . $_GET['uniq'] . "' ";

        foreach ($conn->query($sql) as $row) {
            $sql1 = "update room_cat_price set status=1 where room_catergory_id='" . $row['categoryid'] . "'   and room_no='" . $row['a_room'] . "'";
  
            $result1 = $conn->query($sql1);
        }
        $sql1 = "delete from booking_tmp where  booking_code='" . $_GET['booking_code'] . "' and uniq='" . $_GET['uniq'] . "' ";
        $result = $conn->query($sql1);
        
        $sql = "insert into entry_log(refno, username, docname, trnType, stime, sdate) values ('" . $tno . "', '" . $_SESSION["CURRENT_USER"] . "', 'Booking', 'Save', '" . date("Y-m-d H:i:s") . "', '" . date("Y-m-d") . "')";
        $result = $conn->query($sql);



        $conn->commit();
        echo "Saved";
    } catch (Exception $e) {
        $conn->rollBack();
        echo $e;
    }
}

if ($_GET["Command"] == "aviable_room") {

    $sql1 = "select * from room_cat_price where status='0' and cancel='0' and room_catergory_id='" . $_GET['category'] . "' and type='" . $_GET['packege'] . "' ";

    echo '<select id="a_room" class="form-control input-sm">';
    foreach ($conn->query($sql1) as $row1) {
        echo '<option value=' . $row1["room_no"] . '>' . $row1["room_no"] . '</option>';
    }
    echo '</select>';
}


if ($_GET["Command"] == "aviable_adult") {


    $sql = "select * from room_cat_price where status='0' and cancel='0' and room_catergory_id='" . $_GET['category'] . "' and type='" . $_GET['packege'] . "' ";

    echo '<select id="n_adult" class="form-control input-sm">';
    $count = 0;

    foreach ($conn->query($sql) as $row) {

        $count = $row["adult"];
    }

    for ($x = 1; $x <= $count; $x++) {
        echo '<option value=' . $x . '>' . $x . '</option>';
    }

    echo '</select>';
}

if ($_GET["Command"] == "aviable_child") {

    $sql = "select * from room_cat_price where status='0' and cancel='0' and room_catergory_id='" . $_GET['category'] . "' and type='" . $_GET['packege'] . "' ";

    echo '<select id="n_child" class="form-control input-sm">';
    $count = 0;

    foreach ($conn->query($sql) as $row) {

        $count = $row["child"];
    }

    for ($x = 1; $x <= $count; $x++) {
        echo '<option value=' . $x . '>' . $x . '</option>';
    }
    echo '</select>';
}

if ($_GET["Command"] == "get_list1") {

    // echo $_GET['term'];
    $result = array();

    $sql = "select t_agent from booking_main where  t_agent like '%" . $_GET['term'] . "%' limit 50";

    foreach ($conn->query($sql) as $items) {
        array_push($result, array("id" => $items['t_agent'], "label" => $items['t_agent']));
//array_push($result, array("id"=>$value, "label"=>$key, "value" => strip_tags($key)));
    }

// json_encode is available in PHP 5.2 and above, or you can install a PECL module in earlier versions
    echo json_encode($result);
}
?>