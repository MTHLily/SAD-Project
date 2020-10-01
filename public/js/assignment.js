//Function that fires when user clicks edit button
async function edit( id, compId, empId ){

    //Show modal via jquery, and show it's loading 
    $("#editModal").modal('show');
    $("#editModal .loading").show();
    $("#editModal .loaded").hide();

    //Get the URL to get data from
    const computerURL = window.location.origin + "/api/computers/available";
    const employeeURL = window.location.origin + "/api/employees/available";
    
    //Get assignment from server as a JSON
    let computers = await (await fetch(computerURL)).json();
    let employees = await (await fetch(employeeURL)).json();

    //Once loaded, hide the loading div and show the inputs
    $("#editModal .loading").hide();
    $("#editModal .loaded").show();

    //Change the form action to the corresponding assignment
    document.querySelector('#editForm').action = "/assignments/" + id;

    // //Filter out unavailable computers and employees
    // computers = computers.filter( comp => comp.status == "Available" );
    // employees = employees.filter( employee => employee.status == "Available" );

    //Get the selects and reset them
    let computerSelect = document.querySelector('#computerSelect');
    let employeeSelect = document.querySelector('#employeeSelect');
    computerSelect.innerHTML="";
    employeeSelect.innerHTML="";

    //Create options for current id
    let currComp = document.createElement('option');
    let currEmp = document.createElement('option');

    currComp.value = compId;
    currEmp.value = empId;
    
    currComp.innerText = "Keep current";
    currEmp.innerText = "Keep current";

    computerSelect.appendChild(currComp);
    employeeSelect.appendChild(currEmp);

    //Populate the selects with the available things
    populateSelect(employeeSelect, employees);
    populateSelect(computerSelect, computers);

    console.log( computers, employees );

}

//Helper function for populating the select
function populateSelect( el, data ){
    //Loop through each dataset
    data.forEach( opt =>{
        let option = document.createElement('option');
        option.value = opt.id;

        //If else decision tree to determine if current data is either employee, peripheral or computer
        if( opt.last_name )
            option.innerText = `${opt.last_name}, ${opt.first_name} ${opt.middle_initial}`;
        else if (opt.peripheral_name){
            let types = ["Monitor", "Keyboard", "Device", "Miscellaneous"];
            option.innerText = `${types[opt.peripheral_type - 1]} - ${opt.peripheral_name}`;
        }
        else
            option.innerText = `${opt.pc_name}`;

        el.appendChild( option );
    });
}

async function editPeripherals( id ){
    //Toggle the modal and show it's loading
    $('#editPeripheralsModal').modal('toggle');
    $("#editPeripheralsModal .loading").show();
    $("#editPeripheralsModal .loaded").hide();

    //Get the form and change the action
    let form = document.querySelector('#editPeripheralsForm');
    form.action = "/assignments/" + id + "/peripherals/" ;

    let selectDiv = document.querySelector('#peripheralSelectDiv');
    //Clear the selects
    selectDiv.innerHTML = "";

    //Get the peripherals of selected
    const peripheralsURL = window.location.origin + "/api/assignments/" + id + "/peripherals";

    //Get peripherals from server as a JSON
    let peripherals = await(await fetch(peripheralsURL)).json();

    //Populate the div with the existing peripherals
    peripherals.forEach( addPeripheralSelect );

    //Show the loaded div
    $("#editPeripheralsModal .loading").hide();
    $("#editPeripheralsModal .loaded").show();

}

async function addPeripheralSelect( addOption ){

    //Create a div, a close button and a select
    let div = document.createElement('div');
    div.className = 'd-flex w-100'

    let closeButton = document.createElement('button');
    closeButton.className = "btn";
    closeButton.innerText = "×";
    closeButton.type = "button";
    closeButton.addEventListener("click", e => {
        e.target.parentElement.parentElement.removeChild(e.target.parentElement);
    });

    let select = document.createElement('select');
    select.className = 'custom-select w-100';
    select.name = "peripheral_id"

    //Get the available peripherals
    const peripheralsURL = window.location.origin + "/api/peripherals/available";

    //Get peripherals from server as a JSON
    let peripherals = await (await fetch(peripheralsURL)).json();

    //Add the additional option (for creating previous thing)
    if (addOption != undefined) {
        console.log(addOption);
        let option = document.createElement('option');
        option.value = addOption.id;
        //If else decision tree to determine if current data is either employee, peripheral or computer
        if (addOption.last_name)
            option.innerText = `${addOption.last_name}, ${addOption.first_name} ${addOption.middle_initial}`;
        else if (addOption.peripheral_name){
            let types = ["Monitor", "Keyboard", "Device", "Miscellaneous"];
            option.innerText = `${types[addOption.peripheral_type - 1]} - ${addOption.peripheral_name}`;
        }
        else
            option.innerText = `${addOption.pc_name}`;
        select.appendChild(option);
    }

    //Populate the select with options
    populateSelect(select, peripherals);

    //Insert the new div into the peripherals select div
    div.appendChild(select);
    div.appendChild(closeButton)

    document.querySelector('#peripheralSelectDiv').appendChild( div );

}

//Add custom submit event for edit peripherals form
document.querySelector('#editPeripheralsForm').addEventListener('submit', (e)=>{
    
    e.preventDefault();

    let peripherals = document.querySelectorAll('select[name="peripheral_id"]');
    let id = Array.from(peripherals).map( p => p.value );

    document.querySelector('#peripheral_ids').value = JSON.stringify(id);

    e.target.submit();

});