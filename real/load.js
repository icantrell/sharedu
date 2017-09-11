	function startLoading(element) {
	  Element.show('mainAreaLoading');
	  Element.hide(element);
	}
	
	function finishLoading(element) {
	  Element.show(element);
	  setTimeout("Effect.toggle('mainAreaLoading');", 5000);
	}

	function loadContent(id,element,file) {
	  //startLoading(element);
	  new Ajax.Updater(element, file, {method: 'post', postBody:'content='+ id +''});
	  //finishLoading(element);
	}
