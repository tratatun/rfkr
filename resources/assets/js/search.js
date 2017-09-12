$(function(){
	$('#search').keyup(function(){
		var $this = $(this),
			thisValue = $this.val(),
			thisValueLength = thisValue.length,
			searchBtn = $this.closest('.search__bottom-row').find('.right-col__search-btn');

		thisValueLength > 0 ? searchBtn.removeAttr('disabled') : searchBtn.attr('disabled', 'true');
	});
});