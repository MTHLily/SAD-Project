//Buttons to add ram amd storages
let addRam = document.createElement( 'button' );
addRam.innerHTML = "Add More";
addRam.classList.add( 'btn');
addRam.classList.add( 'w-100');
addRam.type = 'button';
addRam.onclick = addRAMInput;

let addStorage = document.createElement( 'button' );
addStorage.innerHTML = "Add More";
addStorage.classList.add( 'btn');
addStorage.classList.add( 'w-100');
addStorage.type = 'button';
addStorage.onclick = addStorageInput;

//Adds a ram input to the #ram_div div
function addRAMInput( event ){
	let select = document.querySelector('#ramDiv select').cloneNode( true );
	select.name = "ram_id";
	select.classList.add('w-100')
	select.getElementsByTagName('option')[0].innerHTML = "Add More RAM";
	select.addEventListener( 'change', selectHandler );
	event.target.parentElement.insertBefore( select, event.target );
}

//Same, but for storages
function addStorageInput( event ){
	let select = document.querySelector('#storageDiv select').cloneNode( true );
	select.name = "storage_id";
	select.classList.add('w-100')
	select.getElementsByTagName('option')[0].innerHTML = "Add More Storage";
	select.addEventListener( 'change', selectHandler );
	event.target.parentElement.insertBefore( select, event.target );
}

//Handles the select for both ram and storages
function selectHandler( event ){
	//Find the first select of the ram_div/storage_div
	let firstSelect = event.target.parentElement.querySelector('select');

	if( event.target == firstSelect )
		//Adds the add button if the first select is not blank. You should change this to be less finicky
		if( event.target.value != '')
			event.target.parentElement.appendChild( (event.target.parentElement.id == 'ramDiv' ) ? addRam : addStorage );
		else
		//Removes the add button if first select is blank.
			event.target.parentElement.removeChild( (event.target.parentElement.id == 'ramDiv' ) ? addRam : addStorage );
	else
		//Removes the select if a null value is selected AND it's not the first select.
		if( event.target.value == '')
			event.target.parentElement.removeChild(event.target);
}

$("#assignSystemForm").submit(function(event) {

    event.preventDefault(); // avoid to execute the actual submit of the form.

	let rams = [], storages = [];

    document.querySelectorAll('select[name="ram_id"]').forEach(
    	ram => {
    		rams.push( ram.value );
    	});
    document.querySelectorAll('select[name="storage_id"]').forEach(
    	storage => {
    		storages.push( storage.value );
    	});

    document.querySelector("#ram_ids").value = JSON.stringify(rams);
    document.querySelector("#storage_ids").value = JSON.stringify(storages);

    $(this).submit();
    
});

document.querySelector('#ramDiv select').addEventListener('change', selectHandler );
document.querySelector('#storageDiv select').addEventListener('change', selectHandler );
