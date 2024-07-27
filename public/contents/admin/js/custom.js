///sweat alert code start
$(document).ready(function(){
    $('#example').DataTable();
});

//modal code start
$(document).ready(function(){
    $(document).on("click", "#softDelete", function(){
        var deleteId = $(this).data('id');
        $(".modal_body #modal_id").val( deleteId );
    });

    $(document).on("click", "#restore", function(){
        var restoreId = $(this).data('id');
        $(".modal_body #modal_id").val( restoreId );
    });

    $(document).on("click", "#delete", function(){
        var deleteId = $(this).data('id');
        $(".modal_body #modal_id").val( deleteId );
    });
});

//datepicker code

$( function() {
	$( '#date' ).datepicker({
        autoclose: true,
		format: 'yyyy-mm-dd',
        todayHighlight: true
	});

    $( '#startDate ').datepicker({
        autoclose: true,
		format: 'yyyy-mm-dd',
        todayHighlight: true
	});
} );
