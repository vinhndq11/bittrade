(function($) {
	$.put = function (url, data, callback) {
		$.ajax({
			url: url,
			type: 'PUT',
			data: data,
			dataType: 'json'
		}).done(callback);
	};

	$.fn.extend({
		serializeObject: function() {
			let formArray = $(this[0]).serializeArray();
			let returnArray = {};
			for (let i = 0; i < formArray.length; i++){
				returnArray[formArray[i]['name']] = formArray[i]['value'];
			}
			return returnArray;
		}
	});
})(jQuery);
