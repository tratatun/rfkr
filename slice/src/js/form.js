$(function(){
	$("select").minimalect({
		placeholder: 'Не выбрано'
	});

	// $.validator.addMethod("checkSelect", function(value, element) {
	// 	var $selectedOption = $(element).closest('.form-group').find('.minict_wrapper').find('li.selected');
	// 	if($selectedOption){
	// 		$(element).parents(".error").removeClass(errorClass).addClass(validClass);
	// 	}
	// });

	$('.message-send__form').validate({
		highlight: function(element, errorClass, validClass) {
			$(element).closest('.form-group').addClass(errorClass).removeClass(validClass);
			$('.message-send__form').addClass(errorClass).removeClass(validClass);
		},
		unhighlight: function(element, errorClass, validClass) {
			$(element).parents(".error").removeClass(errorClass).addClass(validClass);
		},
		rules: {
			firstname: {
				required: true,
				minlength: 2
			},
			lastname: {
				required: true,
				minlength: 2
			},
			address: {
				required: true,
				minlength: 10
			},
			email: {
				required: true,
				email: true
			},
			message: {
				required: true
			},
			thematic: {
				required: true
			}
		}
	});
});