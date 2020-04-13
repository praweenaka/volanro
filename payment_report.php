<?php

include './connection_sql.php';
?>


<style>
    * { margin: 0; padding: 0; }
    body { font: 14px/1.4 helvetica, serif; }
    #page-wrap { width: 900px; margin: 0 auto; }

    textarea { border: 0; font: 15px helvetica, Serif; overflow: hidden; resize: none; }
    table { border-collapse: collapse; }
    table td, table th { border: 1px solid black; padding: 5px; }
    #middle{float: left;width: 300px;height: 150px;text-align: center;}
    #top{font-size: 25px;}
    #header { height: 15px; width: 100%; margin: 20px 0; background: #222; text-align: center; color: white; font: bold 15px Helvetica, Sans-Serif; text-decoration: uppercase; letter-spacing: 20px; padding: 8px 0px; }

    #address { width: 250px; height: 150px; float: left; }
    #add { width: 250px; float: left; }
    #customer { overflow: hidden; }

    #logo { text-align: right; float: right; position: relative; margin-top: 25px; border: 1px solid #fff; max-width: 540px; max-height: 100px; overflow: hidden; }
    #logo:hover, #logo.edit { border: 1px solid #000; margin-top: 0px; max-height: 125px; }
    #logoctr { display: none; }
    #logo:hover #logoctr, #logo.edit #logoctr { display: block; text-align: right; line-height: 25px; background: #eee; padding: 0 5px; }
    #logohelp { text-align: left; display: none; font-style: italic; padding: 10px 5px;}
    #logohelp input { margin-bottom: 5px; }
    .edit #logohelp { display: block; }
    .edit #save-logo, .edit #cancel-logo { display: inline; }
    .edit #image, #save-logo, #cancel-logo, .edit #change-logo, .edit #delete-logo { display: none; }
    #customer-title { font-size: 20px; font-weight: bold; float: left; }

    #meta { margin-top: 1px; width: 300px; float: right; }
    #meta td { text-align: right;  }
    #meta td.meta-head { text-align: left; background: #eee; }
    #meta td textarea { width: 100%; text-align: right; }

    #items { clear: both; width: 100%; margin: 30px 0 0 0; border: 1px solid black; }
    #items th { background: #eee; }
    #items textarea { }
    #items tr.item-row td { border: 1; vertical-align: top; }
    #items td.description { width: 1000px; }
    #items td.item-name { width: 175px; }
    #items td.description textarea, #items td.item-name textarea { width: 100%; }
    #items td.total-line { border-right: 0; text-align: right; }
    #items td.total-value { border-left: 0; padding: 10px; }
    #items td.total-value textarea { height: 20px; background: none; }
    #items td.balance { background: #eee; }
    #items td.blank { border: 0; }

    #terms { text-align: center; margin: 20px 0 0 0; }
    #terms h5 {border-bottom: 1px solid black;text-align: left;}
    #terms textarea { width: 100%; text-align: center;}

    textarea:hover, textarea:focus, #items td.total-value textarea:hover, #items td.total-value textarea:focus, .delete:hover { background-color:#EEFF88; }

    .delete-wpr { position: relative; }
    .delete { display: block; color: #000; text-decoration: none; position: absolute; background: #EEEEEE; font-weight: bold; padding: 0px 3px; border: 1px solid; top: -6px; left: -22px; font-family: Verdana; font-size: 12px; }

</style>



<?php

include './connection_sql.php';

$sql2 = "SELECT * FROM user_mast";
$result = $conn->query($sql2);
$row3 = $result->fetch();
$sql2 = "SELECT * FROM view_booking_main_booking_item";
$result = $conn->query($sql2);
$row3 = $result->fetch();


echo '<br>
        <div id="page-wrap">
 
<div style="clear:both"></div>

<div id="customer">


    <textarea readonly id="address" >VOLANRO (PVT) LTD
No. 69/72, U.D.A. Estate,
Meepe

Tel        -  011-2205205
Email   -  volanro@gmail.com
                info@volanro.com</textarea>
                 
    
<div id="middle"><br><br><b id="top">' . $row3["user_name"] . '</b></div>
    




 <table id="meta">
        <tr>
            <td class="meta-head">AOD NO</td>
            <td><textarea readonly >' . $id . $row3['user_name'] . '</textarea></td>
        </tr>
        <tr>

            <td class="meta-head">Date of Dispatch</td>
            <td><textarea readonly id="date">' . $row3['user_name'] . '</textarea></td>
        </tr>
        <tr>
            <td class="meta-head">Name of Driver</td>
            <td><div class="due">' . $row3['user_name'] . '</div></td>
        </tr>
        <tr>
            <td class="meta-head">JB No</td>
            <td><div class="due">' . $row3['user_name'] . '</div></td>
        </tr>

    </table>
   
</div>

<h2>INVOICE</h2>
<hr>
<h4>CUSTOMER\'S DETAILS</h4>
<br>
<div style="float:  left;">
<p>NAME  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: ' . $row3['user_name'] . '</p>
<p>Name of contact person : ' . $row3['user_name'] . '</p>
</div>

<div style="width: 400px;float:  right;">

<p style="float: left;">ADDRESS &nbsp;:</p>
<textarea readonly style="width: 300px;height: 54;">' . $row3['user_name'] . '</textarea>
<p>Tel No      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: ' . $row3['user_name'] . '</p>
</div>



<br>
<table id="items">

    <tr style="
    font-size:  13;
">
       
        <th style="width: 20px;text-align: center">&nbsp;&nbsp;</th>
        <th style="width: 20px;text-align: center">Meal/Drink</th>
        <th style="width: 20px;  text-align: center">Qty</th> 
        <th style="width: 10px;  text-align: center">Amount</th>
        <th style="width: 10px;  text-align: center">Sub Amount</th>
  
       
    </tr>';



            $sql3 = "Select * from addmeal_item where room_no ='" . $_GET["roomno"] . "' and cancel='0'";
            $count = 0;
            foreach ($conn->query($sql3) as $row4) {

            echo '<tr class = "item-row">
            <td class = "item-name"><div class = "delete-wpr"><textarea readonly>' . $count . '</textarea></div></td>
            <td class = "item-name"><div class = "delete-wpr"><textarea readonly>' . $row4['meal'] . '</textarea></div></td>
            <td class = "description"><textarea readonly>' . $row4['qty'] . '</textarea></td> 
            <td><textarea readonly class = "cost">' . $row4['amount'] . '</textarea></td>
            <td><textarea readonly class = "cost">' . $row4['qty'] * $row4['amount'] . '</textarea></td>

            </tr>';
    ++$count;
}



echo '</table>';


//    if ($count > 10) {
//        
//    } else {
//        $count = 10 - $count;
//        for ($x = 0; $x < $count; $x++) {
//            echo "<br><br>";
//        }
//    }



echo '

<br>
 

<br>

<div id = "terms" style = "margin-top: 0px;">
 
</div>
 
<div style="float: left;margin: 20px;">

<br>
<p>Date</p>    
<br>
 
</div>

<div style="float: left;margin: 20px;">

<br>
<p>............................................</p>   
</div>




<div style="float: right;margin: 20px;">

<br>
<p>............................................</p>    
 
</div>

<div style="float: right;margin: 20px;">

<br>
<p>Signature</p> 
 
</div>




 
</div>


';
?>



