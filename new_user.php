<!-- Main content -->

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<section class="content">

    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">New User</h3>
        </div>
        <form role="form" class="form-horizontal">
            <div class="box-body">

                <div class="form-group">
                    <a onclick="newent();" class="btn btn-default">
                        <span class="fa fa-user-plus"></span> &nbsp; New
                    </a>
                    <a onclick="save_inv();" class="btn btn-success">
                        <span class="fa fa-save"></span> &nbsp; Save
                    </a>

                </div>

                <div id="msg_box"  class="span12 text-center"  >

                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label" for="txt_usernm">User Name</label>
                    <div class="col-sm-2">
                        <input type="text" placeholder="Name" id="user_name" class="form-control">
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label" for="txt_usernm">Branch</label>
                    <div class="col-sm-2">
                        <select id="user_depart" class="form-control">
                            <option value="Canteen">A</option>
                            <option value="Jenetorial">B</option>
                            <option value="Security">C</option>
                            <option value="Transport">D</option>
                        </select>
                    </div>
                    <!--<input type="text" id="user_depart" class="form-control" placeholder="User Department" />-->
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label" for="txt_password">Password</label>
                    <div class="col-sm-2">
                        <input type="password" placeholder="Password" id="pass1" class="form-control">

                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label" for="txt_password1">Confirm Password</label>
                    <div class="col-sm-2">
                        <input type="password" placeholder="Password" id="pass2" class="form-control">
                    </div>
                </div>			

            </div>
        </form>
    </div>

</section>

<script src="js/create_user.js"></script>