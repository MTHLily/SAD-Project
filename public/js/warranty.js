document.addEventListener('DOMContentLoaded', function () {

    var myTable = $('#warrantyTable').DataTable({
        "dom": "lrtip",
    });

    document.querySelector('#searchBox').addEventListener('input', (e) => {
        e.preventDefault();
        myTable.search(e.target.value).draw();
    });

    $('input:file').on("change", function () {
        $('input:submit').prop('disabled', !$(this).val());
    });


});

async function getInfo( id ){
    await Livewire.emit('showWarrantyDetails', { 'id': id });
    $("#warrantyDetailsModal").modal("toggle");
    $("#warrantyDetailsModal").modal("toggle");
    $("#warrantyDetailsModal").modal("toggle");
}