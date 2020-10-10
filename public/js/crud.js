$(document).ready( function () {
	$.noConflict();
	myTable = $('.dataTable').DataTable({
				paging: false,
				searching: false,
				info: false
	});

	$('#searchBox').keyup(function(){
		myTable.search($(this).val()).draw();
	})
} );
