

_(document).ready(function () {
							
	
	_('#accordion-1').easyAccordion({ 
			autoStart: true, 
			slideInterval: 3000
	});
	
	_('#accordion-2').easyAccordion({ 
			autoStart: false	
	});
	
	_('#accordion-3').easyAccordion({ 
			autoStart: true,
			slideInterval: 5000,
			slideNum:false	
	}); 
	
	_('#accordion-4').easyAccordion({ 
			autoStart: false,
			slideInterval: 5000
	}); 
		

});