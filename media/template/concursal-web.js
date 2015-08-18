/*
#***********************************************************
#* Código Javascript propio de la aplicación [concursal-web]		
#*															
#* ¡Atención! Este fichero es interpretado como UTF-8
#***********************************************************
*/


/**
 * Functions for (search form) sections selection
 */
$(document)
	.ready(
			function(){
				updateStyles();
				
				$("#filtro-busqueda #secciones-busqueda #chk-resoluciones-procesales")
					.click ( function ( event ) { clickOnSection ( $(this), $("#filtro-busqueda #secciones-busqueda #seccion-resoluciones-procesales") ); });
				$("#filtro-busqueda #secciones-busqueda #chk-resoluciones-concursales")
					.click( function ( event ) { clickOnSection ( $(this), $("#filtro-busqueda #secciones-busqueda #seccion-resoluciones-concursales") ); });     													
				$("#filtro-busqueda #secciones-busqueda #chk-acuerdos-extrajudiciales")
					.click( function ( event ) { clickOnSection ( $(this), $("#filtro-busqueda #secciones-busqueda #seccion-acuerdos-extrajudiciales") ); });
							
			}
		  );


function loadCookieBar(message,acceptText,declineText,policyText,policyURL){
	$.cookieBar({
		message: message,
		acceptText: acceptText,
		declineButton: true,
		declineText: declineText,
		policyButton: true,
		policyText: policyText,
		policyURL: policyURL,
		acceptOnContinue: false,
		fixed: true
	});	
}

function updateStyles(){ /* Function changing styles depending on selected sections */
	var section1Selected = $( "#filtro-busqueda #secciones-busqueda #chk-resoluciones-procesales" ).is(':checked');
	var section1Label= $("#filtro-busqueda #secciones-busqueda #seccion-resoluciones-procesales"); 
	var section2Selected = $( "#filtro-busqueda #secciones-busqueda #chk-resoluciones-concursales" ).is(':checked');
	var section2Label= $("#filtro-busqueda #secciones-busqueda #seccion-resoluciones-concursales");
	var section3Selected = $( "#filtro-busqueda #secciones-busqueda #chk-acuerdos-extrajudiciales" ).is(':checked');
	var section3Label= $("#filtro-busqueda #secciones-busqueda #seccion-acuerdos-extrajudiciales");
	
	if(!section1Selected)
		section1Label.toggleClass("non-active active");
	if(!section2Selected)
		section2Label.toggleClass("non-active active");
	if(!section3Selected)
		section3Label.toggleClass("non-active active");
}

function clickOnSection ( $chk, $label ){
	if ( allowToggle ( !$chk.is(':checked') ) ){							
		$label.toggleClass("non-active active");								
		updateFormLabels ();
	}else{
		//$(this).attr("checked", "checked"); //fails
		document.getElementById($chk.attr("id")).checked = "checked";									
	}		
}
function allowToggle ( unselectMode ){ /* Function checking empty sections selection */	
	if ( !unselectMode ){
		return true;
	}		
	var section1Selected = $( "#filtro-busqueda #secciones-busqueda #chk-resoluciones-procesales" ).is(':checked');
	var section2Selected = $( "#filtro-busqueda #secciones-busqueda #chk-resoluciones-concursales" ).is(':checked');
	var section3Selected = $( "#filtro-busqueda #secciones-busqueda #chk-acuerdos-extrajudiciales" ).is(':checked');
	return  ! (!section1Selected && !section2Selected && !section3Selected);		 	
}
function updateFormLabels (){ /* Function changing form labels depending on selected sections */
	var section1Selected = $( "#filtro-busqueda #secciones-busqueda #chk-resoluciones-procesales" ).is(':checked');
	var section2Selected = $( "#filtro-busqueda #secciones-busqueda #chk-resoluciones-concursales" ).is(':checked');
	var section3Selected = $( "#filtro-busqueda #secciones-busqueda #chk-acuerdos-extrajudiciales" ).is(':checked');	
	
	// change "Nº expediente / Nº procedimiento" label
	if ( section1Selected || section2Selected ){		
		if ( section3Selected ){
			$( "#filtro-busqueda #busqueda-avanzada #identificador-label" ).text('Nº Procedimiento / Nº Expediente');			
		}else{
			$( "#filtro-busqueda #busqueda-avanzada #identificador-label" ).text('Nº Procedimiento');			
		}
	}else{ 
		if ( section3Selected ){	
			$( "#filtro-busqueda #busqueda-avanzada #identificador-label" ).text('Nº Expediente');
		}else{
			$( "#filtro-busqueda #busqueda-avanzada #identificador-label" ).text('Nº Procedimiento / Nº Expediente');			
		}
	}
}


/**
 * Functions to show/hide advanced search form
 */
$(document)
	.ready(
			function(){  
				$( "#filtro-busqueda .enlace-busqueda-avanzada" )
						.click( function( event ) {toogleAdvancedSearchForm(1000,"Mostrar búsqueda avanzada","Ocultar búsqueda avanzada");} );
			}
		); 
function toogleAdvancedSearchForm (speedEffect, showText, hideText) {
	$( "#filtro-busqueda #busqueda-avanzada" )
	.toggle(speedEffect, function() {
						      if ($(this).is(':visible')) {
						    	  $( "#filtro-busqueda .enlace-busqueda-avanzada" )
						    	  	.text(hideText);
						      } else {																        
						    	  $( "#filtro-busqueda .enlace-busqueda-avanzada" )
						    	  	.text(showText);                
						      }
						  }
			);			
}

/**
 * Expands ellipsized text
 * 
 * @param clickTag		- The HTML tag where the click event happens to expand or ellipsize the text
 * 							Usually an anchor, a button...
 * @param textTag		- The HTML tag with the text to ellipsized or expand
 * @param hiddenText	- The text to show in the clickTag when the text is ellipsized
 * 						Usually "Read more..." or something similar
 * @param shownText		- The text to show in the clickTag when the text is fully shown
 * 						Usually "Less text..." or something similar
 * 
 */
function expandEllipsizedText (clickTag, textTag, hiddenText, shownText) {
	if(textTag.hasClass("ellipsize-text")) {
		textTag.removeClass("ellipsize-text");
		clickTag.text(shownText);
	} else {
		textTag.addClass("ellipsize-text");
		clickTag.text(hiddenText);
	}
}


/**
 * Validates whether every value in the array of fields has been fullfilled.
 * If any is fullfiled return true otherwise return false and adds the alert message at the top of the given form
 * 
 * @param formObject	- The form to validate
 * @param arrValues		- An array of input values to validate	
 * @param message		- The message to show when no value has been fullfil
 * 
 * @returns {Boolean}	- True if any of the values has been fullfil
 * 						- False otherwise
 */
function validInputsForForm(formObject, arrValues, message) {
	//Only check if the array is defined, otherwise return true
	if(arrValues!==undefined) {
		//Run over the array
		var b=true;
		for (var i = 0; i < arrValues.length && b; i++) {
			b=(arrValues[i].val()<=0);
		}
		//If true show the alert messages
		if(b) {
			//Remove previous alerts
			$(".alert").remove();
			//Add the new alert to the beggining of the form
			formObject.prepend("<div class=\"alert alert-danger\"><ul><li>"+message+"</div>");
			return false;
		}
	}
	//Execute the default execution
	return true;
}

/**
 * Functions switching tabs
 */
$(function(){		
			$( ".bloque-tabs #tab-resoluciones-procesales" )
					.click( function( event ) { 
								showResolucionesProcesales(this);
							}
						  );
			$( ".bloque-tabs #tab-resoluciones-concursales" )
					.click( function( event ) { 
								showResolucionesConcursales(this);
							}
						  );
			$( ".bloque-tabs #tab-acuerdos-extrajudiciales" )
					.click( function( event ) { 
								showAcuerdosExtrajudiciales(this);
							}
						  );
			
			chooseActiveTab();
		}
	);

function chooseActiveTab() {
	var hash = window.location.hash.slice(1);
	var tabProcesales=	$(".bloque-tabs #tab-resoluciones-procesales");
	var tabConcursales=	$(".bloque-tabs #tab-resoluciones-concursales");
	var tabAcuerdos=	$(".bloque-tabs #tab-acuerdos-extrajudiciales");
	
	if(hash == "resoluciones-procesales") {
		showResolucionesProcesales(tabProcesales);
	}
	else if(hash == "resoluciones-concursales") {
		showResolucionesConcursales(tabConcursales);
	}
	else if(hash == "acuerdos-extrajudiciales") {
		showAcuerdosExtrajudiciales(tabAcuerdos);
	}
	else {
		var procesalesCount= $("#resoluciones-procesales-count").text();
		var concursalesCount= $("#resoluciones-concursales-count").text();
		var acuerdosCount= $("#acuerdos-extrajudiciales-count").text();
		
		if(procesalesCount != "0") {
			return showResolucionesProcesales(tabProcesales);
		}
		else if(concursalesCount != "0") {
			return showResolucionesConcursales(tabConcursales);
		}
		else if(acuerdosCount != "0") {
			return showAcuerdosExtrajudiciales(tabAcuerdos);
		}
	}
}

function showResolucionesProcesales(element) {
	// select tab
	$(element).addClass("active");								
	$( ".bloque-tabs #tab-resoluciones-concursales" ).removeClass("active");
	$( ".bloque-tabs #tab-acuerdos-extrajudiciales" ).removeClass("active");								
	//show/hide tabs contents								
	$( ".bloque-tabs #tab-content-resoluciones-procesales" ).addClass("show");								
	$( ".bloque-tabs #tab-content-resoluciones-concursales" ).removeClass("show");								
	$( ".bloque-tabs #tab-content-resoluciones-concursales" ).addClass("hide");		
	$( ".bloque-tabs #tab-content-acuerdos-extrajudiciales" ).removeClass("show");								
	$( ".bloque-tabs #tab-content-acuerdos-extrajudiciales" ).addClass("hide");													    																							
}

function showResolucionesConcursales(element) {
	// select tab
	$( ".bloque-tabs #tab-resoluciones-procesales" ).removeClass("active");								
	$(element).addClass("active");
	$( ".bloque-tabs #tab-acuerdos-extrajudiciales" ).removeClass("active");								
	//show/hide tabs contents									
	$( ".bloque-tabs #tab-content-resoluciones-procesales" ).removeClass("show");									
	$( ".bloque-tabs #tab-content-resoluciones-procesales" ).addClass("hide");
	$( ".bloque-tabs #tab-content-resoluciones-concursales" ).addClass("show");									
	$( ".bloque-tabs #tab-content-acuerdos-extrajudiciales" ).removeClass("show");								
	$( ".bloque-tabs #tab-content-acuerdos-extrajudiciales" ).addClass("hide");													    																						
}

function showAcuerdosExtrajudiciales(element) {
	// select tab
	$( ".bloque-tabs #tab-resoluciones-procesales" ).removeClass("active");								
	$( ".bloque-tabs #tab-resoluciones-concursales" ).removeClass("active");
	$(element).addClass("active");								
	//show/hide tabs contents
	$( ".bloque-tabs #tab-content-resoluciones-concursales" ).removeClass("show");									
	$( ".bloque-tabs #tab-content-resoluciones-concursales" ).addClass("hide");
	$( ".bloque-tabs #tab-content-resoluciones-procesales" ).removeClass("show");									
	$( ".bloque-tabs #tab-content-resoluciones-procesales" ).addClass("hide");	
	$( ".bloque-tabs #tab-content-acuerdos-extrajudiciales" ).addClass("show");	
}

