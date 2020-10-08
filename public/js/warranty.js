document.addEventListener('DOMContentLoaded', function () {

    var myTable = $('#warrantyTable').DataTable({
        "dom": "lrtip",
    });

    document.querySelector('#searchBox').addEventListener('input', (e) => {
        e.preventDefault();
        myTable.search(e.target.value).draw();
    });

});

async function getInfo( id ){
    await Livewire.emit('showWarrantyDetails', { 'id': id });
    $("#warrantyDetailsModal").modal("toggle");
}