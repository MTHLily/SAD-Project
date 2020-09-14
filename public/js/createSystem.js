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

function addRAMInput( event ){
	let select = document.querySelector('#ramDiv select').cloneNode( true );
	select.name = "ram_add_id";
	select.classList.add('w-100')
	select.getElementsByTagName('option')[0].innerHTML = "Add More RAM";
	select.addEventListener( 'change', ramHandler );
	event.target.parentElement.insertBefore( select, event.target );
}

function ramHandler( event ){
	if( event.target.name == 'ram_id')
		if( event.target.value != '')
			document.querySelector('#ramDiv').appendChild(addRam);
		else
			document.querySelector('#ramDiv').removeChild(addRam);
	else{
		if( event.target.value == ''){
			document.querySelector('#ramDiv').removeChild(event.target);
		}
	}
}

function addStorageInput( event ){
	let select = document.querySelector('#storageDiv select').cloneNode( true );
	select.name = "storage_add_id";
	select.classList.add('w-100')
	select.getElementsByTagName('option')[0].innerHTML = "Add More Storage";
	select.addEventListener( 'change', storageHandler );
	event.target.parentElement.insertBefore( select, event.target );
}

function storageHandler( event ){
	if( event.target.name == 'storage_id')
		if( event.target.value != '')
			document.querySelector('#storageDiv').appendChild(addStorage);
		else
			document.querySelector('#storageDiv').removeChild(addStorage);
	else{
		if( event.target.value == ''){
			document.querySelector('#storageDiv').removeChild(event.target);
		}
	}
}

document.querySelector('#ramDiv select').addEventListener('change', ramHandler );
document.querySelector('#storageDiv select').addEventListener('change', storageHandler );

$("#assignSystemForm").submit(function(event) {

    event.preventDefault(); // avoid to execute the actual submit of the form.

    let additionalRams = [], additionalStorages = [];

    Array.from(document.querySelectorAll('select[name="ram_add_id"]')).forEach(
    	ram => {
    		additionalRams.push( ram.value );
    	});
    Array.from(document.querySelectorAll('select[name="storage_add_id"]')).forEach(
    	storage => {
    		additionalStorages.push( storage.value );
    	});


    document.querySelector("#additionalRAM").value = JSON.stringify(additionalRams);
    document.querySelector("#additionalStorage").value = JSON.stringify(additionalStorages);

    $(this).submit();
    
});