<?php
session_start();
?> 

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<section class="content">

    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title"><b>Add Meals</b></h3>
            <h3 class="box-title" style="float: right"><b><p id="time"></p></b></h3>
        </div>
        <form name= "form1" role="form" class="form-horizontal">

            <div class="box-body">

                <input type="hidden" id="tmpno" class="form-control">

                <input type="hidden" id="item_count" class="form-control">

                <div class="row">

                    <div class="col-sm-5" style="background-color: #ffffff">
                        <div id="msg_box"  class="span12 text-center"  ></div>
                        <h4 style="margin-top: 30px; ">Room Category</h4>
                        <div id="msg_box"  class="span12 text-center"  ></div>
                        <br> 
                        <center>
                            <div class="row">
                                <div class="col-lg-1 col-md-1 col-sm-1">
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6">
                                    <input value="" type="text" id="category_name" list="myBrand" name="category_name" class="form-control marg" required="" placeholder="Category Name"> 

                                </div>    
                                <div class="col-lg-4 col-md-4 col-sm-4">
                                    <button class="btn btn-primary btn-block" type="button" onclick="save_category()">
                                        Add to Table
                                    </button> 
                                </div>

                            </div>

                            <div class="row">

                                <div class="table-responsive" style="margin-top: 45px; height:300px; width: 90%;overflow:auto;">          

                                    <div id="table_row">
                                        <!--table data--> 
                                        <table id="myTable" class="table">
                                            <thead>
                                                <tr> 

                                                    <th>Room Category</th>  
                                                    <th>#</th>
                                                    <th>@</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <!--  $sql = "SELECT entryNo FROM entry_nogen";
                                                            $resul = $conn->query($sql);
                                                            $row = $resul->fetch();
                                                            $no = $row['entryNo'];-->
                                                <?php
                                                $sql = "select * from category where cancel='0'";
                                                foreach ($conn->query($sql) as $row) {

                                                    $tb_row++;
                                                    ?>  
                                                    <tr id="row">  

                                                        <td><input value="<?php echo $row["category"] ?>" type="text" id="name" onkeyup="back();"   name="name" class="form-control marg" required placeholder="Category Name" ></td>
                                                        <td>
                                                            <button  onclick="update_category('<?php echo $row["id"]; ?>', '<?php echo $row["id"]; ?>')" type="button" class="btn btn-success btnDelete btn-sm">Update</button>
                                                        </td>      
                                                        <td>
                                                            <button   onclick="remove_category('<?php echo $row["id"]; ?>', '<?php echo $row["id"]; ?>')"type="button" class="btn btn-danger btnDelete btn-sm">Remove</button>
                                                        </td> 
                                                    </tr> 

                                                    <?php
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </center>
                    </div>
                    <div class="col-lg-1 col-md-1 col-sm-1">
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 " style="background-color: #ffffff">
                        <div id="msg_box_roomNo"  class="span12 text-center"  ></div>
                        <h4 style="margin-top: 30px; ">Room Number</h4>
                        <br>
                        <br> <center>
                            <div class="row">
                                <div class="col-lg-1 col-md-1 col-sm-1">
                                </div>
                                <div class="col-lg-3 col-md-3 col-sm-3">
                                    <input value="" type="text" id="room_num" name="room_num" class="form-control marg" required="" placeholder="Room Number"> 

                                </div>    
                                <div class="col-lg-3 col-md-3 col-sm-3">
                                    <select id="room_cat"  onchange='loadcur();' class="form-control input-sm">

                                        <?php
                                        $sql = "select * from category";
                                        foreach ($conn->query($sql) as $row) {
                                            echo "<option value='" . $row["category"] . "'>" . $row["category"] . "</option>";
                                        }
                                        ?>
                                    </select> 

                                </div>    
                                <div class="col-lg-4 col-md-4 col-sm-4">
                                    <button class="btn btn-primary btn-block" type="button" onclick="room_number_save()">
                                        Add to Table
                                    </button>
                                </div>

                            </div>

                            <div class="row" >

                                <div class="table-responsive " style="margin-top: 45px; height:300px; width: 90%;overflow:auto;">          

                                    <div id="table_row" >

                                        <!--table data--> 
                                        <table id="myTable1"  class="table">
                                            <thead>
                                                <tr> 
                                                    <th>Room Number</th>  
                                                    <th>Category</th>
                                                    <th>#</th>
                                                    <th>@</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                                <?php
                                                $sql1 = "SELECT * from room_category where cancel='0'";
                                                $tb_row = 0;
                                                foreach ($conn->query($sql1) as $row1) {

                                                    $tb_row++;
                                                    ?>  
                                                    <tr id="row">  

                                                        <td><input value="<?php echo $row1["room_no"] ?>" type="text" id="tbl_room_num"   name="tbl_room_num" disabled="" class="form-control marg" required placeholder="Room Number" ></td>
                                                        <td><select  class="form-control marg" name="tbl_room_cat_list" size="1"  id="tbl_room_cat_list">
                                                                <option  value=<?php echo $row1["category"]; ?>><?php echo $row1["category"]; ?></option> 
                                                                <?php
                                                                $sql2 = "select * from category  where  cancel='0'";
                                                                foreach ($conn->query($sql2) as $row2) {
                                                                    ?>
                                                                    <option  value=<?php echo $row2["category"]; ?>><?php echo $row2["category"]; ?></option>  
                                                                    <?php
                                                                }
                                                                ?>
                                                            </select></td>

                                                        <td>
                                                            <button  onclick="room_number_update('<?php echo $tb_row; ?>', '<?php echo $row1["room_no"]; ?>')" type="button" class="btn btn-success btnDelete btn-sm">Update</button>
                                                        </td>      
                                                        <td>
                                                            <button   onclick="room_number_remove('<?php echo $row1["room_no"]; ?>', '<?php echo $row1["room_no"]; ?>')"type="button" class="btn btn-danger btnDelete btn-sm">Remove</button>
                                                        </td> 
                                                    </tr> 

                                                    <?php
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </center>
                    </div>
                </div>

                <div class="row ">

                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <h4 style="margin-top: 30px; ">Category - Package</h4>
                        <div id="msg_box_catpack"  class="span12 text-center"  ></div>
                        <br>
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 table-responsive" style="margin-top: 10px; height:420px; overflow:auto;">
                                <?php
                                $sql3 = "select id, category from category where cancel='0' order by id desc ";
                                foreach ($conn->query($sql3) as $row3) {
                                    ?> 
                                    <div class="row">
                                        <!--<div class="col-lg-1 col-md-1 col-sm-1"></div>//-->
                                        <div class="col-lg-12 col-md-12 col-sm-12" style="background-color: #ffffff">
                                            <p style="margin-top: 25px; font-weight: 550; font-size: 17px;">
                                                <?php
                                                echo ' ' . $row3["category"] . ' ';
                                                $room_cat_id = $row3["id"];
                                                ?> </p>
                                            <div class="table-responsive" style="margin-top: 25px; height:270px; overflow:auto;">          
                                                <div id="table_row">
                                                    <!--table data--> 
                                                    <table id="<?php echo 'myTable_cat' . $room_cat_id; ?>"  class="table">
                                                        <thead>
                                                            <tr class="primary"> 
                                                                <th>Room Package</th>   
                                                                <th>Bed Type</th>
                                                                <th>Price</th>
                                                                <th>Adult</th>
                                                                <th>Child</th>
                                                                <th>Room No</th>
                                                                <th>#</th> 
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php
                                                            $sql4 = "select * from room_cat_price where room_catergory_id='$room_cat_id' and cancel='0'";

                                                            $tb_row = 0;
                                                            foreach ($conn->query($sql4) as $row4) {

                                                                $tb_row++;
                                                                ?>  
                                                                <tr id="row" style="background-color: lightgreen">  
                                                                    <td> <?php
                                                                        if ($row4["type"] == 1) {
                                                                            ?>Full Board<?php
                                                                        } else if ($row4["type"] == 2) {
                                                                            ?>Half Board<?php
                                                                        } else if ($row4["type"] == 3) {
                                                                            ?>B & B<?php
                                                                        } else if ($row4["type"] == 4) {
                                                                            ?>Room Only<?php
                                                                        }
                                                                        ?> </td>
                                                                    <td style="background-color: lightgreen"><select  class="form-control" style="width: 150px;" name="bed"    id="bed">
                                                                            <option  value=<?php echo $row4["bdtype"]; ?>><?php echo $row4["bdtype"]; ?></option> 
                                                                            <?php
                                                                            $sql2 = "select * from bed_type  where  cancel='0'";
                                                                            foreach ($conn->query($sql2) as $row2) {
                                                                                ?>
                                                                                <option  value=<?php echo $row2["name"]; ?>><?php echo $row2["name"]; ?></option>  
                                                                                <?php
                                                                            }
                                                                            ?>
                                                                        </select>
                                                                    </td>
                                                                    <td class="tbl_txt_input" style="background-color: lightgreen"><input value="<?php echo $row4["price"] ?>" type="number" id="price"   style="width: 130px; "  class="form-control marg" required  ></td>
                                                                    <td class="tbl_txt_input" style="background-color: lightgreen"><input value="<?php echo $row4["adult"] ?>" type="number" id="adult"  style="width: 90px; "  class="form-control marg" required  ></td>
                                                                    <td class="tbl_txt_input" style="background-color: lightgreen"><input value="<?php echo $row4["child"] ?>" type="number" id="child"      style="width: 90px;" class="form-control marg" required  ></td>

                                                                    <td style="background-color: lightgreen"><select  class="form-control" style="width: 120px; " name="room_no"    id="room_no">
                                                                            <option  value=<?php echo $row4["room_no"]; ?>><?php echo $row4["room_no"]; ?></option> 
                                                                            <?php
                                                                            $sql2 = "select * from room_category  where  cancel='0'";
                                                                            foreach ($conn->query($sql2) as $row2) {
                                                                                ?>
                                                                                <option  value=<?php echo $row2["room_no"]; ?>><?php echo $row2["room_no"]; ?></option>  
                                                                                <?php
                                                                            }
                                                                            ?>
                                                                        </select>
                                                                    </td>

                                                                    <td>
                                                                        <button  onclick="update_cat_package('<?php echo $tb_row; ?>', '<?php echo $row4["idroom_cat_price"]; ?>', '<?php echo $room_cat_id; ?>')" type="button" class="btn btn-primary btnDelete btn-sm">Update</button>
                                                                    </td>      
                                                                </tr> 
                                                                <?php
                                                            }
                                                            ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                }
                                ?>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </form>
    </div>

</section> 

<script src="js/controll.js" type="text/javascript"></script>




<script>
    var myVar = setInterval(myTimer, 1000);

    function myTimer() {

        var d = new Date();
//        var dd = d.toLocaleDateString();
        var tt = d.toLocaleTimeString();
        document.getElementById("time").innerHTML = tt;
    }

</script>
