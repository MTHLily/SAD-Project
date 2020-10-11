document.addEventListener('DOMContentLoaded', function () {

    var myTable = $('.dataTable').DataTable({
		"dom": "lrtip",
		"scrollY": "400px",
        "scrollCollapse": true,
		paging: false,
		info: false
    });

    document.querySelector('#searchBox').addEventListener( 'input', ( e ) => {
        e.preventDefault();
        myTable.search( e.target.value ).draw();
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

	document.querySelectorAll('button[name="update_new"]').forEach( ( a )=>{
		a.addEventListener('click', function (event) {
			
			let modal = event.target.parentElement.parentElement;
			let inputs = modal.querySelectorAll('.modal-body input');
			let select = modal.querySelectorAll('.modal-body select')

			inputs.forEach( inputs => {
				if( inputs.name != 'status' && inputs.name != 'new_department')
					inputs.disabled = !inputs.disabled;
			});
			select.forEach( select => {
				select.disabled = !select.disabled;
			});
		});
	});

} );


async function showDetails( id ){
	let div = document.querySelector("#compDetail");

	const URL = window.location.origin + "/api/components/" + id;
	console.log(URL)

	let comp = await (await fetch(URL)).json();

	div.querySelector("input[name='asset_tag']").value = comp.asset_tag
	div.querySelector("input[name='component_name']").value = comp.component_name
	div.querySelector("select[name='component_type_id']").value = comp.component_type_id
	div.querySelector("input[name='status']").value = comp.status
	div.querySelector("input[name='issues']").value = comp.issues
	div.querySelector("input[name='remarks']").value = comp.remarks
	document.getElementById("remove").action = "/components/" + id;

}


async function perDetails( id ){
	let div = document.querySelector("#perDetail");

	const URL = window.location.origin + "/api/peripherals/" + id;
	console.log(URL)

	let per = await (await fetch(URL)).json();

	div.querySelector("input[name='asset_tag']").value = per.asset_tag
	div.querySelector("input[name='peripheral_name']").value = per.peripheral_name
	div.querySelector("select[name='peripheral_type']").value = per.peripheral_type
	div.querySelector("input[name='status']").value = per.status
	div.querySelector("input[name='issues']").value = per.issues
	div.querySelector("input[name='remarks']").value = per.remarks
	document.getElementById("remove").action = "/peripherals/" + id;
}

async function empDetails( id ){
	let div = document.querySelector("#empDetail");
	console.log(div)

	const URL = window.location.origin + "/api/employees/" + id;
	console.log(URL)

	let emp = await (await fetch(URL)).json();

	div.querySelector("input[name='last_name']").value = emp.last_name
	div.querySelector("input[name='first_name']").value = emp.first_name
	div.querySelector("input[name='middle_initial']").value = emp.middle_initial
	div.querySelector("input[name='email_address']").value = emp.email_address
	div.querySelector("select[name='department_id']").value = emp.department_id
	div.querySelector("input[name='status']").value = emp.status
	document.getElementById("remove").action = "/employees/" + id;
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
