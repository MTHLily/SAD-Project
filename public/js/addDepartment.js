//Get the department selector and add a function that runs when it changes
document.querySelectorAll('select[name="department_id"]').forEach( ( a )=>{
	a.addEventListener('change', function (event) {

		console.log(event.target.value)

		if( event.target.value == "new_department" ){
			document.querySelector( "#new_department" ).classList.add("w-100");
			document.querySelector( "#new_department" ).disabled = false;
			document.querySelector( "#new_department" ).hidden = false;
		}
		else{
			document.querySelector( "#new_department" ).classList.remove("w-100");
			document.querySelector( "#new_department" ).disabled = true;
			document.querySelector( "#new_department" ).hidden = true;
			document.querySelector( "#new_department" ).value = "";
		}
	});
});