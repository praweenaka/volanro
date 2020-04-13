<?php
 
if ($_GET["Command"] == "save") {
    include './connection_sql.php';
    $code = $_POST['code'];
    $name = $_POST['name'];


    $sql1 = "Insert into category (code, name)values 
    ('" . $code . "', '" . $name . "') ";
    $result = $conn->query($sql1);
//$message = "wrong answer";
//echo "<script type='text/javascript'>alert('$message');</script>";
    header("location: home.php?url=add_category");
}
if ($_GET["Command"] == "edit") {
    include './connection_sql.php';
    $code = $_POST['code'];
    $name = $_POST['name'];

    $sql = "UPDATE category SET code='$code' ,name='$name' WHERE code='$code' "; 
    $result = $conn->query($sql);
    header("location: home.php?url=add_category");
}

if ($_GET["Command"] == "delet1") {
    include './connection_sql.php';
    $code = $_POST['code'];

    $sql3 = "DELETE FROM category WHERE code ='$code'";
    $result1 = $conn->query($sql3);
    header("location: home.php?url=add_category");
}
?>
<!--<script>
window.history.back();
    window.alert('Category added successfully!');
    window.history.back();
</script>-->

