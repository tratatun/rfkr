$(function(){
	var $attachBtn = $('#attach-btn'),
		$attachInput = $('#attach-input'),
		$attachFileContainer = $('.attach-block__right-col'),
		$attachError = $('.attach-error');

	$('select').minimalect({
		placeholder: 'Не выбрано'
	});

	$('.message-send .form-group__textarea').keyup(function(){
		var $this = $(this),
			thisValue = $this.val(),
			thisValueLenght = thisValue.length;
		$this.closest('.form-group').find('.form-group__tip span').html(440 - thisValueLenght);
	});

	$(document).on('click', '#attach-btn', function(){
		$attachInput.trigger('click');
	});

	$attachInput.on('change', function(e){
		var $this = $(this),
			thisValue = $this.val(),
			thisSize = $this.get(0).files[0].size,
			thisValueParts = thisValue.split('\\'),
			fileName = thisValueParts[thisValueParts.length - 1];

		if(thisSize < 10000001) {
			$('<span class="file-name">' + fileName + '</span><span class="remove-file"></span>').appendTo($attachFileContainer);
			$attachBtn.attr('disabled', true);
			$attachError.removeClass('visible');
		} else {
			$this.val('');
			$attachError.addClass('visible');
			return false;
		}
	});

	$(document).on('click', '.remove-file', function(){
		$attachFileContainer.html('');
		$attachInput.val('');
		$attachBtn.attr('disabled', false);
	})

	// $.validator.addMethod("checkSelect", function(value, element) {
	// 	var $selectedOption = $(element).closest('.form-group').find('.minict_wrapper').find('li.selected');
	// 	if($selectedOption){
	// 		$(element).parents(".error").removeClass(errorClass).addClass(validClass);
	// 	}
	// });

	// $('.message-send__form').validate({
	// 	highlight: function(element, errorClass, validClass) {
	// 		$(element).closest('.form-group').addClass(errorClass).removeClass(validClass);
	// 		$('.message-send__form').addClass(errorClass).removeClass(validClass);
	// 	},
	// 	unhighlight: function(element, errorClass, validClass) {
	// 		$(element).parents(".error").removeClass(errorClass).addClass(validClass);
	// 	},
	// 	rules: {
	// 		firstname: {
	// 			required: true,
	// 			minlength: 2
	// 		},
	// 		lastname: {
	// 			required: true,
	// 			minlength: 2
	// 		},
	// 		address: {
	// 			required: true,
	// 			minlength: 10
	// 		},
	// 		email: {
	// 			required: true,
	// 			email: true
	// 		},
	// 		message: {
	// 			required: true
	// 		},
	// 		thematic: {
	// 			required: true
	// 		}
	// 	}
	// });

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