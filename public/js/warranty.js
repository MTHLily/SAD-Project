document.addEventListener('DOMContentLoaded', function () {

    var myTable = $('#warrantyTable').DataTable({
        "dom": "lrtip",
    });

    document.querySelector('#searchBox').addEventListener('input', (e) => {
        e.preventDefault();
        myTable.search(e.target.value).draw();
    });


});

async function getInfo(id) {

    $("#infoLoaded").hide();
    $("#infoLoading").show();
    $("#infoModal").modal("toggle");

    //Get the div where the values are being kept
    let div = document.querySelector("#infoLoaded");
    const warrantyURL = window.location.origin + "/api/warranties/" + id;
    const productsURL = window.location.origin + "/api/warranties/" + id + "/products";

    let warranty = await (await fetch(warrantyURL)).json();
    let prod = await (await fetch(productsURL)).json();

    const names = [
        'brand_id',
        'purchase_date',
        'purchase_location',
        'receipt_url',
        'serial_no',
        'warranty_life',
        'notes',
        'status',
    ]

    //Set the values
    names.forEach( name=>{
        if( name != "receipt_url"){
            let el = div.querySelector(`*[name="${name}"]`);
            el.value = warranty[name];
        }
        else{
            let el = div.querySelector('a#receipt_url');
            el.href = `/storage/${warranty[name]}`;
        }
    } );

    if( prod.computer.length > 0 ){

        $("#computerTable").show()

        let tableBody = document.querySelector('#computerTable tbody');
        tableBody.innerHTML = "";

        prod.computer.forEach(computer => {
            let row = tableBody.appendChild(document.createElement("tr"));

            let td = row.appendChild(document.createElement("td"));
            td.innerHTML = computer.asset_tag;

            td = row.appendChild(document.createElement("td"));
            td.innerHTML = computer.pc_name;

            td = row.appendChild(document.createElement("td"));
            td.innerHTML = computer.status;
        });
    }
    else{
        $("#computerTable").hide()
    }

    if( prod.component.length > 0 ){

        $("#componentTable").show()

        let tableBody = document.querySelector('#componentTable tbody');
        tableBody.innerHTML = "";

        prod.component.forEach(component => {
            let row = tableBody.appendChild(document.createElement("tr"));

            let td = row.appendChild(document.createElement("td"));
            td.innerHTML = component.asset_tag;

            td = row.appendChild(document.createElement("td"));
            td.innerHTML = component.component_name;

            td = row.appendChild(document.createElement("td"));
            td.innerHTML = component.status;
        });
    }
    else{
        $("#componentTable").hide()
    }

    if( prod.peripheral.length > 0 ){

        $("#peripheralTable").show()

        let tableBody = document.querySelector('#peripheralTable tbody');
        tableBody.innerHTML = "";

        prod.peripheral.forEach(peripheral => {
            let row = tableBody.appendChild(document.createElement("tr"));

            let td = row.appendChild(document.createElement("td"));
            td.innerHTML = peripheral.asset_tag;

            td = row.appendChild(document.createElement("td"));
            td.innerHTML = peripheral.peripheral_name;

            td = row.appendChild(document.createElement("td"));
            td.innerHTML = peripheral.status;
        });
    }
    else{
        $("#peripheralTable").hide()
    }

    $("#infoLoaded").show();
    $("#infoLoading").hide();

}

function toggleEdit(){

    const names = [
        'brand_id',
        'purchase_date',
        'purchase_location',
        'receipt_url',
        'serial_no',
        'warranty_life',
        'notes',
        'status',
    ]

    if( document.querySelector('#updateButtons').classList.contains("d-none") ){
        document.querySelector('#updateButtons').classList.remove("d-none")
        document.querySelector('#viewButtons').classList.add("d-none")
    }
    else{
        document.querySelector('#updateButtons').classList.add("d-none")
        document.querySelector('#viewButtons').classList.remove("d-none")
    }

}

function toggleNew( show ){
    if( document.querySelector('select[name="brand_id"]').value != "New Brand")
        return;
    if( show ){
        document.querySelector('select[name="brand_id"]').classList.add('d-none');
        document.querySelector('#new_department_div').classList.add('d-flex');
        document.querySelector('#new_department_div').classList.remove('d-none');
    }
    else{
        document.querySelector('select[name="brand_id"]').classList.remove('d-none');
        document.querySelector('#new_department_div').classList.remove('d-flex');
        document.querySelector('#new_department_div').classList.add('d-none');
    }
}