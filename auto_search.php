<link rel="stylesheet" href="js/jquery-ui-1.12.1/jquery-ui.min.css" />
<script src="js/jquery-ui-1.12.1/jquery-ui.min.js"></script>    <!-- minified  --> 
<script>
    $(function () {
        if ($('#t_agent').length > 0) {
            $("#t_agent").autocomplete({
                source: "booking_data.php?Command=get_list1&gl_name=" + document.getElementById('t_agent').value,
                minLength: 1,
                select: function (event, ui) {
                    $("#t_agent").val(ui.item.id); 
                    return false;
                }
            });
        }
    });


//    $(function () {
//        if ($('#tcustomer').length > 0) {
//            $("#tcustomer").autocomplete({
//                source: "tourPlan_data.php?Command=get_list3&gl_name=" + document.getElementById('tcustomer').value,
//                minLength: 1,
//                select: function (event, ui) {
//                    $("#tcode").val(ui.item.id);
//                    $("#tcustomer").val(ui.item.name);
//                    $("#address").val(ui.item.add1 + ui.item.add2);
////                                            $("#itemPrice").focus();
//                    return false;
//                }
//            });
//        }
//    });


</script>


