<?php
session_start();
?> 

<meta name="viewport" content="width=device-width, initial-scale=1.0">

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

                <div class="table-responsive " style="margin-top: 45px; height:300px; width: 100%;overflow:auto;">          

                    <div id="table_row" >

                        <!--table data--> 
                        <table id="myTable123"  class="table">
                            <thead>
                                <tr> 
                                    <th>Keeper</th>
                                    <th>Room No</th> 
                                    <th>From</th>
                                    <th>To</th> 
                                    <th>Action</th>
                                    <th>Note</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php
                                $sql1 = "SELECT * from house_keeping where cancel='0'";
                                $tb_row = 0;
                                foreach ($conn->query($sql1) as $row1) {

                                    $tb_row++;
                                    ?>  
                                    <tr id="row">  
                                        <td><input value="<?php echo $row1["keeper"] ?>" type="text" id="<?php echo $row1["id"] . "keeper"; ?>" name="keeper"  disabled="" class="form-control marg" required placeholder="Keeper" ></td>
                                        <td>
                                            <select  class="form-control marg" name="roomno" size="1"   id="<?php echo $row1["id"] . "roomnum"; ?>">
                                                <option  value=<?php echo $row1["room_no"]; ?>><?php echo $row1["room_no"]; ?></option>
                                                <?php
                                                $sql = "select room_no from room_category";
                                                foreach ($conn->query($sql) as $row) {
                                                    echo "<option value='" . $row["room_no"] . "'>" . $row["room_no"] . "</option>";
                                                }
                                                ?>
                                            </select>
                                        </td>
                                        <td><input value="<?php echo $row1["from_t"] ?>" type="time" id="<?php echo $row1["id"] . "ftime"; ?>"   name="ftime"  class="form-control marg" required placeholder="From" ></td>
                                        <td><input value="<?php echo $row1["to_t"] ?>" type="time" id="<?php echo $row1["id"] . "ttime"; ?>"   name="ttime"  class="form-control marg" required placeholder="To" ></td>
                                        <td><select  class="form-control marg" name="tbl_room_cat_list" size="1"   id="<?php echo $row1["id"] . "action"; ?>">
                                                <option  value=<?php echo $row1["action"]; ?>><?php echo $row1["action"]; ?></option>
                                                <?php
                                                if ($row1["action"] == 'Working') {
                                                    echo "<option value = 'Free'>Free</option>";
                                                } else {
                                                    echo "<option value = 'Working'>Working</option>";
                                                }
                                                ?>


                                            </select>
                                        </td>
                                        <td ><input value="<?php echo $row1["note"] ?>" type="text" id="<?php echo $row1["id"] . "note"; ?>"   name="keeper" class="form-control marg" required placeholder="Note" ></td>
                                        <td>
                                            <button  onclick="keeper_update('<?php echo $row1["id"]; ?>')" type="button" class="btn btn-success btnDelete btn-sm">Update</button>
                                        </td>      
                                        <td>
                                            <button   onclick="remove_keeper('<?php echo $row1["id"]; ?>', '<?php echo $row1["keeper"]; ?>')"type="button" class="btn btn-danger btnDelete btn-sm">Remove</button>
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
        </form>
    </div>

</section> 

<script src="js/house_keeping.js" type="text/javascript"></script>

