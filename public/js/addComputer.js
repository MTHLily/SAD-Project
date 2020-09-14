//Get the department selector and add a function that runs when it changes
document.querySelector( "#department_select" ).addEventListener( "change", ( event ) =>{

	// if( event.target.value == "new_department" )
	// 	document.querySelector( "#new_department" ).style.display = "block";
	// else
	// 	document.querySelector( "#new_department" ).style.display = "none";

	if( event.target.value == "new_department" ){
		document.querySelector( "#new_department" ).classList.add("w-100");
		document.querySelector( "#new_department" ).disabled = false;
	}
	else{
		document.querySelector( "#new_department" ).classList.remove("w-100");
		document.querySelector( "#new_department" ).disabled = true;
	}

});