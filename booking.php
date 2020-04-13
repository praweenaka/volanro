<?php
include './connection_sql.php';
?>
<!--<link href="assets/css/bootstrap.css" rel="stylesheet" />
 FONTAWESOME STYLES
<link href="assets/css/font-awesome.css" rel="stylesheet" />
 PAGE LEVEL STYLES 
<link href="assets/css/bootstrap-fileupload.min.css" rel="stylesheet" />
CUSTOM BASIC STYLES
<link href="assets/css/basic.css" rel="stylesheet" />
CUSTOM MAIN STYLES
<link href="assets/css/custom.css" rel="stylesheet" />
 GOOGLE FONTS
<link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />-->

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<section class="content">

    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title"> Booking Details </h3>
        </div>
        <form name= "form1" role="form" class="form-horizontal">
            <div class="box-body">

                <input type="text" id="uniq"  placeholder="uniq" class=" hidden col-sm-1"> 
                <input type="text" id="code"  placeholder="code" class=" hidden col-sm-1"> 

                <input type="hidden" id="item_count" class="form-control">

                <div class="form-group">

                    <a onclick="new_ent();" class="btn btn-primary btn-sm">
                        <span class="fa fa-user-plus"></span> &nbsp; New
                    </a>


                </div>




                <div class="form-group">
                    <label class="col-md-3 control-label" for="c_code"> </label>
                    <div class="col-md-6">
                        <div class='input-group date'  id='dt'>
                            <span class="input-group-addon">
                                <span class="glyphicon  glyphicon-calendar"></span>Check In
                            </span>
                            <input type='date' class="form-control"  id='from' />
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-calendar"></span>Check Out
                            </span>

                            <input type='date' class="form-control" id='to'/>
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-calendar"></span>
                            </span>
                        </div>
                    </div>

                </div> 



                <div class="form-group">
                    <div class="row col-md-5">
                        <h1>Booking Details</h1>
                    </div> 
                    <div class="row col-md-5">
                       <div id="msg_box"  class="span12 text-center"  ></div>
                    </div> 
                   
                </div>

                <div class="form-group"></div>

                <div class="form-group">
                    <div class="row col-md-4">

                        <label class="col-md-5 control-label" for="contact">Room Category</label>
                        <div class="col-md-6">
                            <select id="category"  onchange='loadcur();' class="form-control input-sm">

                                <?php
                                $sql = "select * from category where cancel='0'";
                                foreach ($conn->query($sql) as $row) {
                                    echo "<option value='" . $row["id"] . "'>" . $row["category"] . "</option>";
                                }
                                ?>
                            </select> 
                        </div>
                        <div class="form-group"></div>
                        <div class="form-group"></div> 
                        <label class="col-md-5 control-label" for="contact">Room Packege</label>
                        <div class="col-md-6">
                            <select id="packege"  onchange='loadcur();' class="form-control input-sm">

                                <?php
                                $sql = "select * from room_type";
                                
                                foreach ($conn->query($sql) as $row) {
                                    echo "<option value='" . $row["code"] . "'>" . $row["name"] . "</option>";
                                }
                                ?>
                            </select> 
                        </div>
                        <div class="form-group"></div>
                        <div class="form-group"></div> 
                        <label class="col-md-5 control-label" for="contact">Available Rooms</label>
                        <div class="col-md-5" id="ava_room_div">
                            <select id="a_room"  onclick='avaroom();' class="form-control input-sm">
<!--                                <option>Pending..</option>-->

                            </select> 
                        </div> 
                        <div class="form-group"></div>
                        <div class="form-group"></div>
                        <label class="col-md-5 control-label" for="contact">Number Of Adults</label>
                        <div class="col-md-5" id="div_adult">
                            <select id="n_adult"  onclick='loadadu();' class="form-control input-sm">


                            </select> 
                        </div> 
                        <div class="form-group"></div>
                        <div class="form-group"></div>
                        <label class="col-md-5 control-label" for="contact">Number Of Child</label>
                        <div class="col-md-5" id="div_child">
                            <select id="n_child"  onclick='loadchild();' class="form-control input-sm">

                            </select> 
                        </div> 
                        <div class="form-group"></div>

                    </div>
                    <div class="row col-md-8">
                        <table class="table table-hover">
                            <tr class='success'>
                                <th style="width: 120px;">From</th>
                                <th style="width: 120px;">To</th>
                                <th style="width: 120px;">Category</th>
                                <th style="width: 120px;">Packege</th>
                                <th style="width: 120px;">Room No</th>
                                <th style="width: 120px;">Adults</th>
                                <th style="width: 120px;">Children</th> 
                                <th style="width: 120px;">Action</th>

                            </tr>


                        </table>

                        <div id="itemdetails" class="table-responsive" style="margin-top: 15px; height:200px; overflow:auto;" >

                        </div>
                    </div>
                </div>


                <div class="form-group"></div>
                <div class="form-group">
                    <div class="col-md-3"></div>
                    <a onclick="add_tmp12();" class="btn btn-success btn-sm">
                        <span class="fa fa-user-plus"></span> &nbsp; Add Table
                    </a>
                </div>
                <div class="form-group"> 
                    <div class="row col-md-5">
                        <h1>Guest Details</h1>
                    </div>
                    <div class="row col-md-5 span12 text-center" id="msg_box1"   >

                    </div>

                </div>
                <div class="form-group hidden">
                    <label class="control-label col-lg-4">Pre Defined Image</label>
                    <div class="">
                        <div class="fileupload fileupload-new" data-provides="fileupload">
                            <div class="fileupload-new thumbnail" style="width: 200px; height: 150px;"><img src="assets/img/demoUpload.jpg" alt="" /></div>
                            <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;"></div>
                            <div>
                                <span class="btn btn-file btn-primary"><span class="fileupload-new">Select image</span><span class="fileupload-exists">Change</span><input type="file"></span>
                                <a href="#" class="btn btn-danger fileupload-exists" data-dismiss="fileupload">Remove</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group"></div>
                <div class="form-group"></div>
                <div class="form-group"></div>
                <div class="form-group"> 
                    <label class="col-md-2 control-label"  for="c_code">Guest Name</label>
                    <div class="col-md-3">
                        <input type="text"  name = "c_name" placeholder="Guest Name" id="name" class="form-control input-sm">
                    </div>
                    <label class="col-md-2 control-label"   for="c_code">NIC / Passport Number</label>
                    <div class="col-md-3">
                        <input type="text"   name="c_code" placeholder="NIC / Passport Number" id="nic" class="form-control  input-sm">
                    </div>
                    <div class="form-group"></div>
                    <label class="col-md-2 control-label" placeholder="Address"  >Address</label>
                    <div class="col-md-3">
                        <textarea style="resize: none" class="form-control" id="address"   placeholder="Address" required rows="2"></textarea>
                    </div>
                    <label class="col-md-2 control-label"  >Contact No</label>
                    <div class="col-md-3">
                        <input type="text"    placeholder="Contact"  id="contact" class="form-control input-sm">
                    </div>
                    <div class="form-group"></div>
                    <label class="col-md-2 control-label">Email</label>
                    <div class="col-md-3">
                        <input type="text"   placeholder="Email"  id="email" class="form-control  input-sm">
                    </div>
                    <label class="col-md-2 control-label" >No of Vehicles</label>
                    <div class="col-md-3">
                        <input type="text"  placeholder="No of Vehicles" id="no_vehi" class="form-control input-sm">
                    </div>
                    <div class="form-group"></div>
                    <label class="col-md-2 control-label" for="c_code">Travel Agent</label>
                    <div class="col-md-3">
                        <input type="text"  placeholder="Travel Agent" id="t_agent" class="form-control input-sm">
                    </div>
                    <label class="col-md-2 control-label" for="c_code">Advance Amount</label>
                    <div class="col-md-3">
                        <input type="text"  placeholder="Advance Amount" id="advance" class="form-control input-sm">
                    </div>
                    <div class="form-group"></div>
                    <label class="col-md-2 control-label" for="c_code">Add Note</label>
                    <div class="col-md-3">
                        <textarea style="resize: none" class="form-control" id="note"   placeholder="Add Note" required rows="2"></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-10"></div> 
                    <a onclick="save_inv1();" style="font-size: 24px;" class="btn btn-primary btn-sm">
                        <span class="fa fa-save" ></span> &nbsp; Book Now
                    </a>
                </div>

            </div>
        </form>
    </div>

</section>
<script src="js/booking.js"></script>
<script>
                        new_ent();
</script>
<!-- SCRIPTS -AT THE BOTOM TO REDUCE THE LOAD TIME-->
<!-- JQUERY SCRIPTS -->
<!--<script src="assets/js/jquery-1.10.2.js"></script>
 BOOTSTRAP SCRIPTS 
<script src="assets/js/bootstrap.js"></script>
 PAGE LEVEL SCRIPTS 
<script src="assets/js/bootstrap-fileupload.js"></script>
 METISMENU SCRIPTS 
<script src="assets/js/jquery.metisMenu.js"></script>
 CUSTOM SCRIPTS 
<script src="assets/js/custom.js"></script>-->
<?php
//include 'login.php';
//include './cancell.php';
?>
 