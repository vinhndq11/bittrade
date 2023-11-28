function CKFinderPopup(callback){
	CKFinder.popup({
		chooseFiles: true,
		width: 800,
		height: 600,
		onInit: function (finder) {
			finder.on('files:choose', function (evt) {
				let file = evt.data.files.first();
				let path = file.getUrl();
				callback(path);
			});
			finder.on('file:choose:resizedImage', function (evt) {
				let path = evt.data.resizedUrl;
				callback(path);
			});
		}
	});
}

jQuery(document).ajaxStart(function(){
	$.LoadingOverlay("show");
});
jQuery(document).ajaxStop(function(){
	$.LoadingOverlay("hide");
});

$(function () {
	$('body').attr("spellcheck",false);
	$('button.hd-button-save').click(function () {
		let pageObject = {};
		$('.editable').each(function () {
			let type = $(this).attr('data-type');
			let name = $(this).attr('data-name');
			let $thisContent = $(this);
			$thisContent.find('.hd-clone').remove();
			$thisContent.find('.hd-remove').remove();
			let content = $thisContent.html();
			if(type === 'image'){
				content = $(this).find('.input-text').val();
			}
			// if(type === 'html'){
			// 	content = content.replace(/\n/g, '<br>');
			// }
			pageObject[name] = {
				name: name,
				type: type,
				content: content,
			};
		});
		$.post(window.location.href, { attr: pageObject }).then(({ success, data, message }) => {
			$.alert( message );
		});
	});
	$('button.hd-button-cancel').click(window.close)
	const fileSelectElement = `<div class="hd-input-group">
									<input type="text" placeholder="http://domain.com/img.png" aria-label="" class="input-text" name="" value="">
									<button type="button" class="browser-file" contenteditable="false">
										<img class="img-icon" alt="" src="img/browse-folder.png"/>
									</button>
								</div>`;
	$('.editable').each(function () {
		$(this).attr('contentEditable', true);
		if($(this).attr('data-type') === 'image'){
			let $image = $(this).find('img');
			let $fileSelect = $(fileSelectElement);
			let $input = $fileSelect.find('.input-text').val($image.attr('src'));
			$input.change(function () {
				$image.attr('src', $(this).val());
			});
			$fileSelect.find('button.browser-file').click(() => CKFinderPopup(src => $input.val(src) && $image.attr('src', src)));
			$(this).append($fileSelect);
		}
		if($(this).attr('data-type') === 'list'){
			$(this).find('.editable-item').each(function () {
				let $buttonClone = $(`<span class="hd-clone">+</span>`);
				let $buttonRemove = $(`<span class="hd-remove">x</span>`);
				$buttonClone.click(() => {
					$(this).clone().insertAfter(this);
				});
				$buttonRemove.click(() => {
					$(this).remove();
				});
				$(this).append($buttonClone).append($buttonRemove);
				$(this).find('img').click(function () {
					CKFinderPopup(src => $(this).attr('src', src));
				});
			});
		}
	});

})
