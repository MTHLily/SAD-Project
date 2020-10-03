//Get the department selector and add a function that runs when it changes
document.querySelector( "#brand_select" ).addEventListener( "change", ( event ) =>{

	// if( event.target.value == "new_department" )
	// 	document.querySelector( "#new_department" ).style.display = "block";
	// else
	// 	document.querySelector( "#new_department" ).style.display = "none";

	if( event.target.value == "new_brand" ){
		document.querySelector( "#new_brand" ).classList.add("w-100");
		document.querySelector( "#new_brand" ).disabled = false;
	}
	else{
		document.querySelector( "#new_brand" ).classList.remove("w-100");
		document.querySelector( "#new_brand" ).disabled = true;
	}

});