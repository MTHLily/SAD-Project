//Function that fires when user clicks edit button
async function edit( id, compId, empId ){


    //Show modal via jquery, and show it's loading 
    $("#editModal").modal('show');
    $("#editModal .loading").show();
    $("#editModal .loaded").hide();

    //Get the URL to get data from
    const computerURL = window.location.origin + "/api/computers/all";
    const employeeURL = window.location.origin + "/api/employees/all";
    
    //Get assignment from server as a JSON
    let computers = await (await fetch(computerURL)).json();
    let employees = await (await fetch(employeeURL)).json();

    //Once loaded, hide the loading div and show the inputs
    $("#editModal .loading").hide();
    $("#editModal .loaded").show();

    //Change the form action to the corresponding assignment
    document.querySelector('#editForm').action = "/assignments/" + id;

    //Filter out unavailable computers and employees
    computers = computers.filter( comp => comp.status == "Available" );
    employees = employees.filter( employee => employee.status == "Available" );

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
    data.forEach( opt =>{
        let option = document.createElement('option');
        option.value = data.id;
        if( opt.last_name )
            option.innerText = `${opt.last_name}, ${opt.first_name} ${opt.middle_initial}`;
        else
            option.innerText = `${opt.pc_name}`;
        el.appendChild( option );
    });
}