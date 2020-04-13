<?php
session_start();
?> 

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<section class="content">

    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title"><b>Category</b></h3>
        </div>
        <form name= "form1" role="form" class="form-horizontal">

            <div class="box-body">

                <input type="hidden" id="tmpno" class="form-control">

                <input type="hidden" id="item_count" class="form-control">

                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                Category

                                <span class="pull-right">
                                    <button type="button" class="btn btn-primary btn-sm" style="margin-top: -5px;" data-toggle="modal" data-target="#addcategory"><i class="fa fa-plus-circle"></i> Add Category</button>
                                </span>
                            </div>
                            <!-- /.panel-heading -->
                            <div class="panel-body">
                                <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>Name</th> 
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <p id="demo" ></p>
                                    <tbody>
                                        <?php
                                        include './connection_sql.php';
                                        $sql = "select * from category order by id desc ";
                                        foreach ($conn->query($sql) as $row) {
                                            ?>
                                            <tr>
                                                <td><?php echo $row['category']; ?></td>
                                                <td style="width: 25%">
                                                    <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#edit_<?php echo $row['category']; ?>"><i class="fa fa-edit"></i> Edit</button>
                                                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#del_<?php echo $row['category']; ?>"><i class="fa fa-trash"></i> Delete</button>
                                                    <?php include('user_button.php'); ?>
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

            </div>
        </form>
    </div>

</section> 


