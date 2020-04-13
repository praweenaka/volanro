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
    $sql = "delete from addmeal_tmp where room_no='" . $_GET['room_no'] . "' and id= '" . $_GET['id'] . "'";
    
    $result = $conn->query($sql);

//    $sql = "select * from addmeal_tmp where roomno='" . $_GET['roomno'] . "' ";
//    $result = $conn->query($sql);
//    if ($row = $result->fetch()) {
//        echo "Already Add Table";
//        exit();
//    }
    if ($_GET["Command1"] == "add_tmp") {

        $sql = "Insert into addmeal_tmp (room_no,meal,qty,datetime,note,amount)values
			('" . $_GET['room_no'] . "', '" . $_GET['meal'] . "', '" . $_GET['qty'] . "','" . $_GET['datetime'] . "','" . $_GET['note'] . "','" . $_GET['amount'] . "') ";

        $result = $conn->query($sql);

//        if (!$result) {
//            echo $sql . "<br>";
//            echo mysqli_error($GLOBALS['dbinv']);
//        }
    }
    $ResponseXML .= "<sales_table><![CDATA[<table class=\"table\">
                        <th style='width: 20px;text-align: center'>Meal/Drink</th>
                        <th style='width: 20px;text-align: center'>Qty</th>
                        <th style='width: 10px;text-align: center'>Date/Time</th>
                        <th style='width: 120px;text-align: center'>Note</th>
                        <th style='width: 10px;text-align: center'>Amount</th>
                        <th style='width: 10px;text-align: center'>Sub Amount</th>
                        <th style='width: 10px;text-align: center'></th>";

    $i = 1;
    $gtot = 0;
    $sql = "Select * from addmeal_tmp where room_no='" . $_GET['room_no'] . "'";
    foreach ($conn->query($sql) as $row) {
        $ResponseXML .= "<tr>  
                         <td style='width: 380px;'> <input disabled type='text' placeholder='Meal/Drink' value='" . $row['meal'] . "' id='meal' class='form-control input-sm'></td>
                         <td style='width: 150px;'> <input disabled type='text'  placeholder='Qty' value='" . $row['qty'] . "' id='qty' class='form-control input-sm'></td>
                         <td style='width: 320px;'> <input disabled type='text'  value='" . $row['datetime'] . "' id='datetime' class='form-control input-sm'></td>
                         <td style='width: 360px;'> <input disabled type='text' placeholder='Note' value='" . $row['note'] . "' id='note' class='form-control input-sm'></td>
                         <td style='width: 180px;'> <input   type='text' placeholder='Amount' value='" . $row['amount'] . "' id='amount' class='form-control input-sm'></td>  
                         <td style='width: 180px;'> <input disabled type='text' placeholder='Sub Total' value='" . $row['qty'] * $row['amount'] . "' id='subtotal' class='form-control input-sm'></td>  
                       
                         <td><button onClick=\"del_mealitem('" . $row['id'] . "')\"  type='button' class='btn btn-danger btnDelete btn-sm'>Remove</button></td>
                         </tr>";

        $gtot = $gtot + ($row['qty'] * $row['amount']);
    }

    $ResponseXML .= "</table>]]></sales_table>";
    $ResponseXML .= "<gtot><![CDATA[" . $gtot . "]]></gtot>";
    $ResponseXML .= "</salesdetails>";
    echo $ResponseXML;
}

if ($_GET["Command"] == "save_inv") {

    try {
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $conn->beginTransaction();
//        $sql = "delete from addmeal_item where room_no = '" . $_GET['room_no'] . "'";
//        $result = $conn->query($sql);
//  
        $sql = "Select * from addmeal_tmp where room_no='" . $_GET['room_no'] . "'";
        foreach ($conn->query($sql) as $row) {
            $sql = "Insert into addmeal_item(room_no,meal,qty,datetime,note,amount)values
			('" . $_GET['room_no'] . "', '" . $row['meal'] . "', '" . $row['qty'] . "','" . $row['datetime'] . "','" . $row['note'] . "','" . $row['amount'] . "') ";

            $result = $conn->query($sql);
        }

        $sql3 = "delete from addmeal_tmp where room_no = '" . $_GET['room_no'] . "'";
        $result = $conn->query($sql3);

        $sql = "insert into entry_log(refno, username, docname, trnType, stime, sdate) values ('10', '" . $_SESSION["CURRENT_USER"] . "', 'addmeal', 'Save', '" . date("Y-m-d H:i:s") . "', '" . date("Y-m-d") . "')";
        $result = $conn->query($sql);



        $conn->commit();
        echo "Saved Meal Plan";
    } catch (Exception $e) {
        $conn->rollBack();
        echo $e;
    }
}
 


if ($_GET["Command"] == "update_list") {
    $ResponseXML = "";
    $ResponseXML .= "<table class=\"table\">
	            <tr>
                         <th>Room No</th>
                         <th>Orderd Date</th> 
                    </tr>";


    $sql = "SELECT * from addmeal_item where cancel='0' and room_no <> ''";

    if ($_GET['cusno'] != "") {
        $sql .= " and room_no like '%" . $_GET['cusno'] . "%'";
    }

    $stname = $_GET['stname'];

    $sql .= " group by room_no limit 50";

    foreach ($conn->query($sql) as $row) {
        $cuscode = $row["room_no"];


        $ResponseXML .= "<tr>               
                              <td onclick=\"custno('$cuscode', '$stname');\">" . $row['room_no'] . "</a></td>
                              <td onclick=\"custno('$cuscode', '$stname');\">" . $row['datetime'] . "</a></td> 
                            </tr>";
    }
    $ResponseXML .= "</table>";
    echo $ResponseXML;
}

if ($_GET["Command"] == "pass_quot") {

    $_SESSION["custno"] = $_GET['custno'];

    header('Content-Type: text/xml');
    echo "<?xml version=\"1.0\" encoding=\"utf-8\"?>\n";

    $ResponseXML = "";
    $ResponseXML .= "<salesdetails>";

    $cuscode = $_GET["custno"];

    $sql = "Select * from addmeal_item where room_no ='" . $cuscode . "' and cancel='0'";


    $sql = $conn->query($sql);
    if ($row = $sql->fetch()) {


//        $ResponseXML .= "<id><![CDATA[" . $row['tour_no'] . "]]></id>";



        $ResponseXML .= "<sales_table><![CDATA[ <table class=\"table\">     
			<tr>
                         
                        <th style='width: 20px;text-align: center'>Meal/Drink</th>
                        <th style='width: 20px;text-align: center'>Qty</th>
                        <th style='width: 10px;text-align: center'>Date/Time</th>
                        <th style='width: 120px;text-align: center'>Note</th>
                        <th style='width: 10px;text-align: center'>Amount</th>
                        <th style='width: 10px;text-align: center'>Sub Amount</th>
                        <th style='width: 10px;text-align: center'></th>
                        </tr>";
        $sql4 = "Select * from addmeal_item where room_no ='" . $cuscode . "' order BY room_no";
        $gtot = 0;
        foreach ($conn->query($sql4) as $row2) {
            $ResponseXML .= "<tr>
                          <td style='width: 380px;'> <input disabled type='text' placeholder='Meal/Drink' value='" . $row2['meal'] . "' id='meal' class='form-control input-sm'></td>
                         <td style='width: 150px;'> <input disabled type='text'  placeholder='Qty' value='" . $row2['qty'] . "' id='qty' class='form-control input-sm'></td>
                         <td style='width: 320px;'> <input disabled type='text'  value='" . $row2['datetime'] . "' id='datetime' class='form-control input-sm'></td>
                         <td style='width: 360px;'> <input disabled type='text' placeholder='Note' value='" . $row2['note'] . "' id='note' class='form-control input-sm'></td>
                         <td style='width: 180px;'> <input   type='text' placeholder='Amount' value='" . $row2['amount'] . "' id='amount' class='form-control input-sm'></td>  
                         <td style='width: 180px;'> <input disabled type='text' placeholder='Sub Total' value='" . $row2['qty'] * $row2['amount'] . "' id='subtotal' class='form-control input-sm'></td>  
                         <td><button onClick=\"update_item('" . $row2['id'] . "')\"  type='button' class='btn btn-success btnDelete btn-sm'>Update</button></td>
                         <td><button onClick=\"del_mealitem('" . $row2['id'] . "')\"  type='button' class='btn btn-danger btnDelete btn-sm'>Remove</button></td>
                        
                    </tr>";
            $gtot = $gtot + ($row2['qty'] * $row2['amount']);
        }
    }
    $ResponseXML .= "   </table>]]></sales_table>";
    $ResponseXML .= "<gtot><![CDATA[" . $gtot . "]]></gtot>";
    $ResponseXML .= "</salesdetails>";
    echo $ResponseXML;
}
?>