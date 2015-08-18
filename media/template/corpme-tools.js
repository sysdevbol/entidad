
/**
 * Redirect the browser to an url on click event.
 *  
 * @param element css-selector to listen to click events
 * @param dataAttributeUrlHolder data-* attribute to get the target url
 */
function listenForAClickAndGoTo(element, dataAttributeUrlHolder) {
	$(element)
		.click(function() {
			goToUrl($(this).data(dataAttributeUrlHolder));
		});
}

/**
 * Open the target url in a new window (or tab) on click event
 * 
 * @param element css-selector to lisent to click events
 * @param dataAttributeUrlHolder data-* attribute to get the target url
 */
function listenForAClickAndOpen(element, dataAttributeUrlHolder) {
	$(element)
		.click(function () {
			openUrl($(this).data(dataAttributeUrlHolder));
		});
}

/**
 * Redirect the browser to an url 
 * @param url
 */
function goToUrl(url) {
	if(url) {
		window.location= url;		
	}
}

/**
 * Open the url on a new window
 * @param url
 */
function openUrl(url) {
	if(url) {
		window.open(url);
	}
}


/**
 * Open/save publicacion attached file
function openSavePublicacionAttachedFile (applicationUrl, disposition, idDocumentoConcursal, ithFile) {
	var url= applicationUrl + "/publicacion/adjunto/" + disposition + "/" + idDocumentoConcursal + "/" + ithFile;
	//window.location= url;			
	window.open(url);
}
 */