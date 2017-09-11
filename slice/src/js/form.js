$(function(){
	$('select').minimalect({
		placeholder: 'Не выбрано'
	});

	$('.message-send .form-group__textarea').keyup(function(){
		var $this = $(this),
			thisValue = $this.val(),
			thisValueLenght = thisValue.length;
		$this.closest('.form-group').find('.form-group__tip span').html(440 - thisValueLenght);
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

	$('.admin-login__form').validate({
		highlight: function(element, errorClass, validClass) {
			$(element).closest('.form-group').addClass(errorClass).removeClass(validClass);
		},
		unhighlight: function(element, errorClass, validClass) {
			$(element).parents(".error").removeClass(errorClass).addClass(validClass);
		},
		rules: {
			email: {
				required: true,
				email: true
			},
			password: {
				required: true
			}
		}
	});
});