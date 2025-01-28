$(document).ready(function(){
	
	$.validator.setDefaults({
		ignore: 'input[type=hidden], .select2-search__field',
	    errorClass: 'validation-error-label',
	    successClass: 'validation-valid-label',
	    highlight: function(element, errorClass) {
	        $(element).removeClass(errorClass);
	    },
	    unhighlight: function(element, errorClass) {
	        $(element).removeClass(errorClass);
	    },
	    errorPlacement: function(error, element) {
	        // Styled checkboxes, radios, bootstrap switch
	        if (element.parents('div').hasClass("checker") || element.parents('div').hasClass("choice") || element.parent().hasClass('bootstrap-switch-container') ) {
	            if(element.parents('label').hasClass('checkbox-inline') || element.parents('label').hasClass('radio-inline')) {
	                error.appendTo( element.parent().parent().parent().parent() );
	            }
	             else {
	                error.appendTo( element.parent().parent().parent().parent().parent() );
	            }
	        }

	        // Unstyled checkboxes, radios
	        else if (element.parents('div').hasClass('checkbox') || element.parents('div').hasClass('radio')) {
	            error.appendTo( element.parent().parent().parent() );
	        }

	        // Input with icons and Select2
	        else if (element.parents('div').hasClass('has-feedback') || element.hasClass('select2-hidden-accessible')) {
	            error.appendTo( element.parent() );
	        }

	        // Inline checkboxes, radios
	        else if (element.parents('label').hasClass('checkbox-inline') || element.parents('label').hasClass('radio-inline')) {
	            error.appendTo( element.parent().parent() );
	        }

	        // Input group, styled file input
	        else if (element.parent().hasClass('uploader') || element.parents().hasClass('input-group')) {
	            error.appendTo( element.parent().parent() );
	        }

	        else {
	            error.insertAfter(element);
	        }
	    },
	    validClass: "validation-valid-label",
	    success: function(label) {
	        label.addClass("validation-valid-label").text("Success.")
	    }
	});

	$.validator.addMethod("letterswithspace", function(value, element) {
    	return this.optional(element) || /^[a-z\s]+$/i.test(value);
	}, "Please enter letters only.");

	$.validator.addMethod("valueNotEquals", function(value, element, arg){
		return arg !== value;
	}, "Value must not equal arg.");

	$.validator.addMethod("lettersonly", function(value, element) {
		return this.optional(element) || /^[a-z\s]+$/i.test(value);
	}, "Letters only please");

	$.validator.addMethod("uploadFile", function (val, element) {

          let size = element.files[0].size;

           if (size > 1048576)
           {
               console.log("returning false");
                return false;
           } else {
               console.log("returning true");
               return true;
           }

      }, "File type error");	
 
})