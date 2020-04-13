<?php
session_start();
?> 
<section class="content">

    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title"><b>House Keeping</b></h3>
        </div>
        <form name= "form1" role="form" class="form-horizontal">

            <div class="box-body">

                <input type="hidden" id="tmpno" class="form-control">

                <input type="hidden" id="item_count" class="form-control">

                <div id="msg_box"  class="span12 text-center"  ></div> 
                <div class="form-group"></div>
                <div class="form-group"></div>

                <table   class="table">
                    <thead>
                        <tr> 
                            <th>Room No</th>  
                            <th>Keeper</th>
                            <th>From</th>
                            <th>To</th>
                            <th>Action</th>
                            <th></th>
                        </tr>
                    </thead>
                </table>
                <div class="form-group"></div>
                <div class="form-group"> 
                    <div class="col-md-1">
                        <select id="room_no"  class="form-control input-sm">

                            <?php
                            $sql = "select room_no from room_category";
                            foreach ($conn->query($sql) as $row) {
                                echo "<option value='" . $row["room_no"] . "'>" . $row["room_no"] . "</option>";
                            }
                            ?>
                        </select> 
                    </div>

                    <div class="col-md-2">
                        <select id="keeper"  onchange='loadcur();' class="form-control input-sm">

                            <?php
                            $sql = "select * from user_house_keeper";
                            foreach ($conn->query($sql) as $row) {
                                echo "<option value='" . $row["name"] . "'>" . $row["name"] . "</option>";
                            }
                            ?>
                        </select> 
                    </div>
                    <div class="col-sm-2 ">
                        <input type="time" id="from" class="form-control input-sm">
                    </div>
                    <div class="col-sm-2">
                        <input type="time" id="to" class="form-control input-sm">
                    </div>
                    <div class="col-md-3">
                        <select id="action"  onchange='loadcur();' class="form-control input-sm">
                            <option value='Working'>Working</option> 
                            <option value='Free'>Free</option> 

                        </select> 
                    </div>
                    <div class="col-sm-2">
                        <button class="btn btn-primary btn-block" type="button" onclick="keeper_save()">
                            Add to Table
                        </button>
                    </div>
                </div>
                <div class="row">

                    <div class="table-responsive " style="margin-top: 45px; height:300px; width: 100%;overflow:auto;">          

                        <div id="table_row" >

                            <!--table data--> 
                            <table id="myTable123"  class="table">
                                <thead>
                                    <tr> 
                                        <th>Room No</th> 
                                        <th>Keeper</th>
                                        <th>From</th>
                                        <th>To</th> 
                                        <th>Action</th>
                                        <th>Note</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php
                                    $sql1 = "SELECT * from house_keeping where action='Working' and cancel='0'";
                                    $tb_row = 0;
                                    foreach ($conn->query($sql1) as $row1) {

                                        $tb_row++;
                                        ?>  
                                        <tr id="row">  

                                            <td><input value="<?php echo $row1["room_no"] ?>" type="text" id="room_no"   name="room_no" disabled="" class="form-control marg" required placeholder="Room Number" ></td>
                                            <td><input value="<?php echo $row1["keeper"] ?>" type="text" id="keeper"   name="keeper" disabled="" class="form-control marg" required placeholder="Keeper" ></td>
                                            <td><input value="<?php echo $row1["from_t"] ?>" type="text" id="keeper"   name="keeper" disabled="" class="form-control marg" required placeholder="Keeper" ></td>
                                            <td><input value="<?php echo $row1["to_t"] ?>" type="text" id="keeper"   name="keeper" disabled="" class="form-control marg" required placeholder="Keeper" ></td>
                                            <td><select  class="form-control marg" name="tbl_room_cat_list" size="1"  value="<?php echo $row1["action"]; ?>" id="tbl_room_cat_list">

                                                    <option value='Working'>Working</option> 
                                                    <option value='Free'>Free</option> 
                                                </select>
                                            </td>
                                            <td ><input value="<?php echo $row1["note"] ?>" type="text" id="note"   name="keeper" class="form-control marg" required placeholder="Note" ></td>
                                            <td>
                                                <button  onclick="keeper_update('<?php echo $row1["id"]; ?>', '<?php echo $row1["id"]; ?>')" type="button" class="btn btn-success btnDelete btn-sm">Update</button>
                                            </td>      
                                            <td>
                                                <button   onclick="remove_keeper('<?php echo $row1["id"]; ?>', '<?php echo $row1["id"]; ?>')"type="button" class="btn btn-danger btnDelete btn-sm">Remove</button>
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
        </form>
    </div>

</section> 

<script src="js/house_keeping.js" type="text/javascript"></script>

