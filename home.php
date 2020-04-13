<?php
include './CheckCookie.php';
require_once ('connection_sql.php');
$cookie_name = "user";
if (isset($_COOKIE[$cookie_name])) {
    $mo = chk_cookie($_COOKIE[$cookie_name]);
    if ($mo != "ok") {
        header('Location: ' . "index.php");
        exit();
    }
} else {
    header('Location: ' . "index.php");
    exit();
}
$mtype = "";
include "header.php";

if (isset($_GET['url'])) {

    if ($_GET['url'] == "new_user") {
        include_once './new_user.php';
    }
    if ($_GET['url'] == "add_category") {
        include_once './add_category.php';
    }
    if ($_GET['url'] == "booking") {
        include_once './booking.php';
    }
    if ($_GET['url'] == "user_p") {
        include_once './user_permission.php';
    }
    if ($_GET['url'] == "add_meals") {
        include_once './add_meals.php';
    }
    if ($_GET['url'] == "controll") {
        include_once './controll.php';
    }
    if ($_GET['url'] == "house_keeping") {
        include_once './house_keeping.php';
    }
    if ($_GET['url'] == "payment") {
        include_once './payment.php';
    }
} else {

    include_once './fpage.php';
}

include_once './footer.php';
?>

</body>
</html>


<!-- jQuery 2.2.3 -->
<script src="plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="bootstrap/js/bootstrap.min.js"></script>
<script src="bootstrap/js/bootstrap-multiselect.js"></script>
<!--<script  type="text/javascript">

    $(function () { 
        $(document).ready(function () {
            $('#brand').multiselect();
        });


    });

</script>-->
<script type="text/javascript">
    $(function () {
        $('.dt').datepicker({
            format: 'yyyy-mm-dd',
            autoclose: true
        });
    });

</script>


<?php
//include './auto_search.php';
include './add_modal.php';
?>

<!--vender-->
<script src="vendor/jquery/jquery.min.js"></script>
<!--<script src="vendor/bootstrap/js/bootstrap.min.js"></script>-->
<script src="dist/js/sb-admin-2.js"></script>
<script src="vendor/metisMenu/metisMenu.min.js"></script>

<!--DataTables JavaScript--> 
<script src="vendor/datatables/js/jquery.dataTables.min.js"></script>
<script src="vendor/datatables-plugins/dataTables.bootstrap.min.js"></script>
<script src="vendor/datatables-responsive/dataTables.responsive.js"></script>

<script>
    $(document).ready(function () {
        $('#dataTables-example').DataTable({
            responsive: true
        });
    });
</script>


<script>
    $(document).ready(function () {
        $('#supTable').DataTable({
            responsive: true
        });
    });
</script>
<script>
    $(document).ready(function () {
        $('#prodTable').DataTable({
            responsive: true
        });
    });
</script>
<script>
    $(document).ready(function () {
        $('#salesTable').DataTable({
            responsive: true
        });
    });
</script>
<script>
    $(document).ready(function () {
        $('#invTable').DataTable({
            responsive: true
        });
    });
</script>

<script src="custom.js"></script>
<!--vender-->

<script src="plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
<script src="js/comman.js"></script>

<!-- AdminLTE App -->
<script src="dist/js/app.min.js"></script>
<!-- SlimScroll 1.3.0 -->
<script src="plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<script src="js/user.js"></script>


<script>
    $("body").addClass("sidebar-collapse");
</script>    

<?php
include './auto_search.php';
?>