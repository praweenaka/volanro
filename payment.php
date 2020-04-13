<?php
session_start();
?> 

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<section class="content">

    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title"><b>Add Payment</b></h3>
        </div>
        <form name= "form1" role="form" class="form-horizontal">

            <div class="box-body">

                <input type="hidden" id="tmpno" class="form-control">

                <input type="hidden" id="item_count" class="form-control">
                <div class="form-group">

                    <a onclick="newent();" class="btn btn-default btn-sm">
                        <span class="fa fa-user-plus"></span> &nbsp; New
                    </a>

                    <a onclick="save_inv();" class="btn btn-success btn-sm">
                        <span class="fa fa-save"></span> &nbsp; Save
                    </a>

                    <a onclick="print_inv();" class="btn btn-default btn-sm">
                        <span class="fa fa-print"></span> &nbsp; Print
                    </a>

                    <a onclick="sess_chk('cancel', 'crn');" class="btn btn-danger btn-sm">
                        <span class="fa fa-trash-o"></span> &nbsp; Cancel
                    </a>

                </div>
                <div class="form-group"></div>
                <div class="form-group"></div>
                <div id="msg_box"  class="span12 text-center"  ></div>

                <div class="form-group">
                    <label class="col-md-2" for="contact">Customer</label>
                    <div class="col-md-2">
                        <input type="text"  name="cus_name" id="cus_name" class="form-control input-sm">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 " for="contact">Room No</label>
                    <div class="col-md-2">
                        <select id="room_no" onchange="meallist();" class="form-control input-sm">
                            <option value='Select Room'>Select Room</option>
                            <?php
                            $sql = "select room_no from room_category";
                            foreach ($conn->query($sql) as $row) {
                                echo "<option onchange='meallist('" . $row["room_no"] . "');' value='" . $row["room_no"] . "'>" . $row["room_no"] . "</option>";
                            }
                            ?>
                        </select> 
                    </div>

                </div>
                <div class="form-group">
                    <label class="col-md-2" for="contact">Room Charge</label>
                    <div class="col-md-2">
                        <input type="text" onkeyup="subtot();" id="roomcharge" class="form-control input-sm">
                    </div>
                    <label class="col-md-1 " for="contact">Wifi</label>
                    <div class="col-sm-2">
                        <input type="number" onkeyup="subtot();" id="wifi" class="form-control input-sm">
                    </div>
                    <label class="col-md-1 " for="contact">A/C</label>
                    <div class="col-sm-2">
                        <input type="number" onkeyup="subtot();" id="ac" class="form-control input-sm">
                    </div>

                </div>


                <div class="form-group">
                    <label class="col-md-2 " for="contact">Damage</label>
                    <div class="col-sm-2">
                        <input type="number" onkeyup="subtot();" id="damage" class="form-control input-sm">
                    </div>
                    <label class="col-md-1 " for="contact">Other</label>
                    <div class="col-sm-2">
                        <input type="text" onkeyup="subtot();" id="other" class="form-control input-sm">
                    </div>
                </div>
                <div class="form-group"> 
                    <label class="col-md-2 " for="contact">Note</label>
                    <div class="col-sm-2">
                        <textarea id="note" class="form-control input-sm"></textarea>
                    </div>
                </div>

                <div id="itemdetails" >

                </div>
                <div class="form-group" ></div>
                <div class="form-group" ></div>
                <div class="form-group" ></div>
                <div class="form-group">
                    <div class="col-sm-7" ></div>
                    <label class="col-md-2 " for="contact">Meal Charge</label>
                    <div class="col-md-2">
                        <input disabled="" type="text" id='mealcharge' class="form-control input-sm"> 
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-7" ></div>
                    <label class="col-md-2 " for="contact">Room Charge Total</label>
                    <div class="col-md-2">
                        <input disabled="" type="text" onblur="grandtot();" id='roomchargetot' class="form-control input-sm"> 
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-7" ></div>
                    <label class="col-md-2 " for="contact">Advance</label>
                    <div class="col-md-2">
                        <input disabled="" type="text" id='advance' class="form-control input-sm"> 
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-7" ></div>
                    <label class="col-md-2 " for="contact">Grand Total</label>
                    <div class="col-md-2">
                        <input disabled="" type="text" id='gtot' class="form-control input-sm"> 
                    </div>
                </div>
            </div>
        </form>
    </div>

</section> 

<script src="js/payment.js" type="text/javascript"></script>
<!--<script>newent();</script>-->