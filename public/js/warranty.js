$(document).ready( function(){

    $.noConflict();

    var myTable = $('#warrantyTable').DataTable({
        searching: false,
    });

    document.querySelector('#searchBox').addEventListener( 'input', ( e ) => {
        myTable.search( e.target.value ).draw();
    });

});