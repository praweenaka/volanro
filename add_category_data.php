<?php

session_start();


require_once ("connection_sql.php");


date_default_timezone_set('Asia/Colombo');

if ($_GET["Command"] == "getdt") {
    header('Content-Type: text/xml');
    echo "<?xml version=\"1.0\" encoding=\"utf-8\"?>\n";

    $ResponseXML = "";
    $ResponseXML .= "<new>";

    $sql = "SELECT tallyCode FROM tally_nogen";
    $result = $conn->query($sql);
    $row = $result->fetch();
    $no = $row['tallyCode'];
    $ResponseXML .= "<id><![CDATA[$no]]></id>";
    $ResponseXML .= "</new>";

    echo $ResponseXML;
}



if ($_GET["Command"] == "update_list") {
    $ResponseXML = "";
    $ResponseXML .= "<table class=\"table\">
	            <tr>
                        <th width=\"121\">Item No</th>
                        <th width=\"424\"> Item Description </th>
                        
                        <th width=\"121\">Amount</th>  
                    </tr>";


    $sql = "SELECT * from ass_vender where itcode <> ''";
    if ($_GET['refno'] != "") {
        $sql .= " and itcode like '%" . $_GET['refno'] . "%'";
    }
    if ($_GET['cusname'] != "") {
        $sql .= " and itname like '%" . $_GET['cusname'] . "%'";
    }
    $stname = $_GET['stname'];

    $sql .= " ORDER BY itcode limit 50";

    foreach ($conn->query($sql) as $row) {
        $cuscode = $row["itcode"];


        $ResponseXML .= "<tr>               
                              <td onclick=\"itno_undeliver('$cuscode', '$stname');\">" . $row['itcode'] . "</a></td>
                              <td onclick=\"itno_undeliver('$cuscode', '$stname');\">" . $row['itname'] . "</a></td>
                              <td onclick=\"itno_undeliver('$cuscode', '$stname');\">" . $row['price'] . "</a></td>
                            </tr>";
    }
    $ResponseXML .= "</table>";
    echo $ResponseXML;
}

if ($_GET["Command"] == "setitem") {
    header('Content-Type: text/xml');

    $ResponseXML = "";
    $ResponseXML .= "<salesdetails>";


    $sql = "delete from tmp_po_data where plantno='" . $_GET['plantno'] . "' and tmp_no='" . $_GET['tmpno'] . "' ";
    $result = $conn->query($sql);
    if ($_GET["Command1"] == "add_tmp") {
        $plantno = str_replace(",", "", $_GET["plantno"]);
        $serialno = str_replace(",", "", $_GET["serialno"]);
        $morterno = str_replace(",", "", $_GET["morterno"]);



        $sql = "Insert into tmp_po_data (plantno, serialno, morterno,tmp_no)values 
			('" . $_GET['plantno'] . "', '" . $_GET['serialno'] . "', '" . $_GET['morterno'] . "','" . $_GET['tmpno'] . "') ";
        $result = $conn->query($sql);
    }

    $ResponseXML .= "<sales_table><![CDATA[<table class=\"table\">
					<tr>
                                            <th style=\"width: 120px;\">No</th>
                                            <th style=\"width: 120px;\">Plant No</th>
                                            <th style=\"width: 120px;\">Serial No</th>
                                            <th style=\"width: 120px;\">Moter No</th>
                                            <th style=\"width: 100px;\"></th>
					</tr>";

    $i = 1;

    $sql = "Select * from tmp_po_data where tmp_no='" . $_GET['tmpno'] . "'";
    foreach ($conn->query($sql) as $row) {

        $ResponseXML .= "<tr>                              
                             <td>" . $i . "</td>
                                                         <td>" . $row['plantno'] . "</td>
							 <td>" . $row['serialno'] . "</td>
							 <td>" . $row['morterno'] . "</td>
							 <td><a class=\"btn btn-danger btn-xs\" onClick=\"del_item('" . $row['plantno'] . "')\"> <span class='fa fa-remove'></span></a></td>
							 </tr>";

        $i = $i + 1;
    }

    $ResponseXML .= "</table>]]></sales_table>";
    $ResponseXML .= "<item_count><![CDATA[" . $i . "]]></item_count>";
//    $ResponseXML .= "<subtot><![CDATA[" . number_format($mtot, 2, ".", "") . "]]></subtot>";
    $ResponseXML .= "</salesdetails>";

    echo $ResponseXML;
}



if ($_POST["Command"] == "save_item") {

    $target_dir = "uploads/";

    $mrefno = str_replace("/", "-", "hfghf");

    $target_dir = $target_dir . "images" . "/";
    if (!file_exists($target_dir)) {
        if (mkdir($target_dir, 0777, true)) {
            
        }
    }

    $target_file = $target_dir . basename($_FILES["file"]["name"]);
    $uploadOk = 1;
    $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);

    $mok = "no";
//while ($mok == "ok") {
    if (file_exists($target_file)) {
        echo "Sorry, file already exists.";
        $mok = "ok";
    } else {
        $mok = "ok";
    }
//} 

    if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
//            echo "The file " . basename($_FILES["file"]["name"]) . " has been uploaded.";
    } else {
        echo "Sorry, there was an error uploading your file.";
    }




    try {
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $conn->beginTransaction();
        $sql = "delete from tally_sheet where code = '" . $_POST['code'] . "'";
        $result = $conn->query($sql);

        $sql = "Insert into tally_sheet(code,tallyNo,radio,departform,departto,remark,img,approve)values 
    ('" . $_POST['code'] . "','" . $_POST['tallyNo'] . "','" . $_POST['radio'] . "','" . $_POST['departform'] . "','" . $_POST['departto'] . "','" . $_POST['remark'] . "','" . $target_file . "','". $_POST['approve'] . "') ";

        $result = $conn->query($sql);

        $sql2 = "Select * from tmp_po_data where tmp_no='" . $_POST['tmpno'] . "'";
        foreach ($conn->query($sql2) as $row) {

            $sql1 = "Insert into tally_sheet_item(code,plantno,serialno,morterno)values 
    ('" . $_POST['code'] . "','" . $row['plantno'] . "','" . $row['serialno'] . "','" . $row['morterno'] . "') ";

            $result1 = $conn->query($sql1);
        }

        $sql = "SELECT tallyCode FROM tally_nogen";
        $resul = $conn->query($sql);
        $row = $resul->fetch();
        $no = $row['tallyCode'];
        $no2 = $no + 1;
        $sql = "update tally_nogen set tallyCode = $no2 where tallyCode = $no";
        $result = $conn->query($sql);

        $conn->commit();
        echo "Saved";
    } catch (Exception $e) {
        $conn->rollBack();
        echo $e;
    }
}
?>