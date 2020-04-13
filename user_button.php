
<!-- /.modal -->

<!-- Delete Customer -->
<div class="modal fade" id="del_<?php echo $row['category']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <center><h4 class="modal-title" id="myModalLabel">Delete Customer</h4></center>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <?php
                    $sql1 = "select * from category where category='" . $row['category'] . "'";
                    $result = $conn->query($sql1);
                    $row1 = $result->fetch();
                    ?> 
                    <form role="form" method="POST" action="addcategory.php?Command=delet1">
                        <input type="text"   style="width:400px; text-transform:capitalize;" value="<?php echo $row['category']; ?>" class="form-control" name="code">
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Cancel</button>
                            <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i> Delete</button>
                        </div>
                    </form>
                </div>                 
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="edit_<?php echo $row['category']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <center><h4 class="modal-title" id="myModalLabel">Edit Customer</h4></center>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <?php
                    $sql1 = "select * from category where category='" . $row['category'] . "'";
                    $result = $conn->query($sql1);
                    $row1 = $result->fetch();
                    ?>
                    <div style="height:10px;"></div>
                    <form role="form" method="POST" action="addcategory.php?Command=edit">
                        <div class="form-group input-group">
                            <span class="input-group-addon" style="width:120px;">Code:</span>
                            <input type="text" style="width:400px; text-transform:capitalize;" value="<?php echo $row1['category']; ?>" class="form-control" name="code">
                        </div>
                        <div style="height:10px;"></div>
                        <div class="form-group input-group">
                            <span class="input-group-addon" style="width:120px;">Name:</span>
                            <input type="text"   style="width:400px; text-transform:capitalize;" value="<?php echo $row1['category']; ?>" class="form-control" name="name">
                        </div>


                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Cancel</button>
                            <button type="submit" class="btn btn-success"><i class="fa fa-check-square-o"></i> Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>