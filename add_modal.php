<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />


<title>Search Item</title>



<link rel="stylesheet" href="css/bootstrap.min.css">


<script language="JavaScript" src="js/add_meals.js"></script>

<!--Add Category--> 
<div class="modal fade" id="addcategory" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <center><h4 class="modal-title" id="myModalLabel">Add New Category</h4></center>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <form role="form" method="POST" action="addcategory.php?Command=save" enctype="multipart/form-data">
                        <div class="container-fluid">
                            <div style="height:15px;"></div>
                            <div class="form-group input-group">
                                <span style="width:120px;" class="input-group-addon">Code:</span>
                                <input type="text" style="width:400px; text-transform:capitalize;" class="form-control" name="code">
                            </div>
                            <div class="form-group input-group">
                                <span style="width:120px;" class="input-group-addon">Name:</span>
                                <input type="text" style="width:400px; text-transform:capitalize;" class="form-control" name="name" required>
                            </div>
                        </div>

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Cancel</button>
                <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save</button>
                </form>
            </div>
        </div>
    </div>
</div>


<!--/.add category--> 

<div class="modal fade" id="addmealorderlist" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <center><h4 class="modal-title" id="myModalLabel">Search Meal Order List</h4></center>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <table width="735"   class="table table-bordered">

                        <tr>
                            <?php
                            $stname = "";
                            if (isset($_GET['stname'])) {
                                $stname = $_GET["stname"];
                            }
                            ?>
                            <td width="24" ><input type="text" size="20" name="cusno" id="cusno" value=""  class="form-control" tabindex="1" onkeyup="<?php echo "update_cust_list('$stname')"; ?>"/></td> 
                    </table>    
                    <div id="filt_table" class="CSSTableGenerator">  <table width="735"   class="table table-bordered">
                            <tr>
                                <th>Room No</th>
                                <th>Orderd Date</th> 
                            </tr>
                            <?php
                            $sql = "SELECT * from addmeal_item";


                            $sql = $sql . " group by room_no limit 50";

                            $stname = "";
                            if (isset($_GET['stname'])) {
                                $stname = $_GET["stname"];
                            }

                            foreach ($conn->query($sql) as $row) {
                                $cuscode = $row['room_no'];
                                echo "<tr>                
                              <td onclick=\"custno('$cuscode', '$stname');\">" . $row['room_no'] . "</a></td>
                              <td onclick=\"custno('$cuscode', '$stname');\">" . $row['datetime'] . "</a></td> 
                             </tr>";
                            }
                            ?>
                        </table>
                    </div>

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Close</button> 
                </form>
            </div>
        </div>
    </div>
</div>

