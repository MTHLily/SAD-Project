document.addEventListener('DOMContentLoaded', function () {

	var myTable = $('.dataTable').DataTable({
				paging: false,
				searching: false,
				info: false,
	});

	//Do this function if warranty select table is found.
	if( $("#warrantySelectTable") != undefined ){

		let warrantyTable = $("#warrantySelectTable").DataTable({
			select: 'single',
			dom: "tf",
			autoWidth: false,
			columnDefs: [
				{ "width": "15%", "targets": [0, 1],
				  "width": "70%", "targets": [ 2 ],
				}
			],
			"scrollY": "600px",
			"scrollCollapse": true,
			// "scrollX": "100%",
			// "scrollXInner": "100%",
			// "aaSorting": [[0, "asc"]],
			// "sScrollY": 300,
			// "sScrollX": "90%",
			// "sScrollXInner": "100%",


			"paging": false,
		});

		warrantyTable.on( 'select', function( e, dt, type, indexes ){
			// console.log({e, dt, type, indexes});
			console.log(  );
			document.querySelector('#selectedWarranty').value = warrantyTable[type](indexes).nodes()[0].dataset.warrantyId;
		});
		
	}

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

async function showCompDetails( id ){

	let div = document.querySelector("#compdet");

	const URL = window.location.origin + "/api/components/" + id;

	let comp = await (await fetch(URL)).json();

	div.querySelector("input[name='component_name']").value = comp.component_name

	$("#compDetails").modal('toggle');

	console.log(comp);

}

async function getWarrantyInfo(id) {
	await Livewire.emit('showWarrantyDetails', id );
	$("#warrantyDetailsModal").modal("toggle");
}

async function getComputerInfo(id) {
	await Livewire.emit('showComputerDetails', id );
	$("#computerDetailsModal").modal("toggle");
}

async function showWarrantyCreate( category, id) {
	await Livewire.emit('showWarrantyCreate', category, id );
	$("#warrantyCreateModal").modal("toggle");
}

async function showComputerSystemDetails(id) {
	await Livewire.emit('showComputerSystemDetails', id );
	$("#computerSystemDetailsModal").modal("toggle");
}

async function getAssignmentInfo(id) {
	$("#assignmentDetailsModal").modal("toggle");
	await Livewire.emit('showAssignmentDetails', id);
}

async function showAssignPeripherals(id) {
	$("#assignPeripheralsModal").modal("toggle");
	await Livewire.emit('showAssignPeripherals', id);
}
