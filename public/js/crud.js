$(document).ready( function () {
	$.noConflict();
	var myTable = $('.dataTable').DataTable({
				paging: false,
				searching: false,
				info: false
	});

	$('#searchBox').keyup(function(){
		myTable.search($(this).val()).draw();
	})

	document.querySelectorAll('a[name="update_new"]').forEach( ( a )=>{
		a.addEventListener('click', function (event) {
			console.log(event.target);
			let modal = event.target.parentElement.parentElement;
			let selects = modal.querySelectorAll('.modal-body input');
			console.log(selects );
			selects.forEach( select => {
				if( status.name != 'status' )
					select.readOnly = !select.readOnly;
			});
		});
	});

} );