<?php
session_start();
?> 

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<section class="content">

    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title"><b>Add Meals</b></h3>
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

                    <a onclick="sess_chk('print', 'crn');" class="btn btn-default btn-sm">
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
                    <label class="col-md-2 control-label" for="contact">Room No</label>
                    <div class="col-md-3">
                        <select id="room_no"  class="form-control input-sm">

                            <?php
                            $sql = "select room_no from room_category";
                            foreach ($conn->query($sql) as $row) {
                                echo "<option value='" . $row["room_no"] . "'>" . $row["room_no"] . "</option>";
                            }
                            ?>
                        </select> 
                    </div>
                    <div class="col-sm-2">
                     &nbsp;&nbsp; 
                    <span class="pull-right">
                      <button type="button" class="btn btn-primary btn-sm"   data-toggle="modal" data-target="#addmealorderlist"><i class="fa fa-plus-circle"></i> Search Added List</button>
                    </span>
                </div>
                </div>


                <table class="table table-responsive">
                    <tr class='info'>
                        <th style="width: 160px;text-align: center">Meal/Drink</th> 
                        <th style="width: 20px;text-align: center">Qty</th>
                        <th style="width: 10px;text-align: center">Date/Time</th>
                        <th style="width: 120px;text-align: center">Note</th>
                        <th style="width: 10px;text-align: center">Amount</th>
                        <th style="width: 10px;text-align: center"></th>
                    </tr>

                    <tr>

                        <td style="width: 200px;">
                            <input type="text" placeholder="Meal/Drink" id="meal" class="form-control input-sm">
                        </td>
                        <td style="width: 50px;">
                            <input type="number" placeholder="Qty" id="qty" class="form-control input-sm">
                        </td>
                        <td style="width: 20px;">
                            <input type="date"   id="datetime" class="form-control  input-sm">
                        </td>
                        <td style="width: 160px;">
                            <input type="text" placeholder="Note" id="note" class="form-control input-sm">
                        </td>
                        <td style="width: 80px;">
                            <input type="text" placeholder="Amount" id="amount" class="form-control input-sm">
                        </td>
                        <td><a onclick="add_tmp();" class="btn btn-default btn-sm"> <span class="fa fa-plus"></span> &nbsp; </a></td>

                    </tr>
                </table>

                <div id="itemdetails" >

                </div>
                <div class="form-group" ></div>
                <div class="form-group" ></div>
                <div class="form-group" ></div>
                <div class="form-group">
                    <div class="col-sm-7" ></div>
                    <label class="col-md-2 control-label" for="contact">Grand Total</label>
                    <div class="col-md-2">
                        <input disabled="" type="text" id='gtot' class="form-control input-sm"> 
                    </div>
                </div>
            </div>
        </form>
    </div>

</section> 

<script src="js/add_meals.js" type="text/javascript"></script>
<script>newent();</script>