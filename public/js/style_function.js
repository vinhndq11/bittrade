const $ = jQuery;

const $form = $('form.form-main');
function validForm(){
	$form.find('.has-error:not(.prevent-submit)').removeClass('has-error');
	let $inputHasError = $form.find('input.required, textarea.required, select.required, input[required], textarea[required], select[required]')
		.filter((i,v) => !$(v).val());
	if($inputHasError.length){
		let $navTab = $inputHasError.first().closest('.nav-tabs-custom');
		if($navTab.length){
			$navTab.find(`ul.nav-tabs>li>a[href="#${$inputHasError.closest('.tab-pane').attr('id')}"]`).click();
		}
		$inputHasError.each(function () {
			$(this).closest('.form-group').addClass('has-error');
		})
		return false;
	}
	return !$form.find('.prevent-submit').length;
}

(function () {
	const SETTING_SIDEBAR_COLLAPSE = 'sidebar_collapse';
	let enable = localStorage.getItem(SETTING_SIDEBAR_COLLAPSE);
	if(enable === '1' && !jQuery('body').hasClass('sidebar-collapse')){
		jQuery('body').addClass('sidebar-collapse');
	}
	jQuery('a.sidebar-toggle').click(function () {
		if(!jQuery('body').hasClass('sidebar-collapse')){
			localStorage.setItem(SETTING_SIDEBAR_COLLAPSE, '1');
		} else{
			localStorage.setItem(SETTING_SIDEBAR_COLLAPSE, '0');
		}
	});
})();

jQuery(function () {
    let input = jQuery('#inputMatKhau');
    let btn = jQuery('#btnShowHidden');
    (input.attr('type') === 'text') ? btn.text('Ẩn') : btn.text('Hiển thị');
    btn.click(function () {
        if (input.attr('type') === 'text') {
            input.attr('type', 'password');
            jQuery(this).text('Hiển thị');
        } else {
            input.attr('type', 'text');
            jQuery(this).text('Ẩn');
        }
    });
});

function deleteRow(url, text) {
	const row = $(this).closest('tr');
	$.confirm({
		icon: 'fa fa-warning',
		title: 'Xác nhận xóa',
		content: 'Bạn có chắc muốn xóa <strong>' + text + '</strong> ?',
		type: 'red',
		theme: 'light',
		typeAnimated: true,
		buttons: {
			ok: {
				text: 'Xóa',
				btnClass: 'btn-red',
				action: function () {
					$.ajax({
						url: url,
						type: 'DELETE',
						dataType: 'json',
						success: function (res) {
							if (res.success) {
								Notify('Thông báo', res.message, 'success');
								console.log(row);
								row.fadeOut('fast');
								if (typeof callbackAfterDelete !== 'undefined'){
									callbackAfterDelete(res);
								}
							} else{
								Notify('Lỗi', res.stt, 'error');
							}
						},
						error: function (e) {
							Notify('Lỗi', e.statusText, 'error');
						}
					});
				}
			},
			close: {
				text: 'Đóng'
			}
		}
	});
}

jQuery(function () {
    const options = {
        aPad: false
    };
    $.each(jQuery('.format-number[type="number"]'), function () {
        let money_value = jQuery(this).val();
        let class_control = jQuery(this).attr('class');

        let item = jQuery('<input class="' + class_control + '" data-v-min="-1000000000000000" type="text" value="' + money_value + '" />');
        item.autoNumeric('init', options);

        jQuery(this)
            .css('display', 'none')
            .after(item);
    });
    jQuery("body").on("keyup change", 'input.format-number[type="text"]', function () {
        let money = jQuery(this).val().replace(/,/g, '');
        console.log(money);
        jQuery(this).prev('input.format-number[type="number"]').val(money);
    });
});

jQuery(function () {
    jQuery('.select2').select2();
});

jQuery(function () {
    if(navigator.platform === 'MacIntel'){
        jQuery('select.form-control:not(.select2)').wrap('<div class="select-list"></div>');
    }
});

jQuery(function () {
        jQuery('.time-picker')
            .wrap('<div class="input-group bootstrap-timepicker timepicker" style="width: 100%;"></div>')
            .timepicker({
                showMeridian: false
            });
});

jQuery(function () {
	jQuery('.date-picker')
		.datepicker({
			format: 'yyyy-mm-dd'
		});

	$.each(jQuery('.format-date-time'), function (index, obj) {
		$(obj).datetimepicker({
			format: $(obj).data('format') || 'DD/MM/YYYY HH:mm:ss'
		});
	});

	$.each(jQuery('.format-date'), function (index, obj) {
		$(obj).datetimepicker({
			format: $(obj).data('format') || 'DD/MM/YYYY'
		});
	});

});

jQuery(function () {
	jQuery("a").click(function() {
		if(this.hash){
			window.location.hash = this.hash;
		}
	});
});

const gcd = (a, b) => (b == 0) ? a : gcd (b, a%b);
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
function InitImage($component, $img){
	let imgObject = new Image();
	imgObject.src = $img.attr('src');
	imgObject.onload = function () {
		let g = gcd(this.width, this.height);
		$component.find('.aspect').html((this.width/g)+"x"+(this.height/g));
	};
}

+function(component) {
	$.each(jQuery(component), function (index, obj) {
		let $component = jQuery(obj);
		let $img = $component.find('img');
		InitImage($component, $img);
	});

	const $body = jQuery('body');
	$body.on('click', component + ' .btn-remove-image', function () {
		let $component = jQuery(this).closest(component).removeClass('has-image');
		$component.find('input').val('')
		$component.find('.aspect').html("NaN");
		validForm();
	});
	$body.on('click', component + ' .icon-plus', function () {
		let $component = jQuery(this).closest(component);
		let $img = $component.find('img');
		CKFinderPopup(function (path) {
		    path = path.substr(1);
		    $img.attr('src', path);
			InitImage($component, $img);
			$component.find('input').val(path);
			$component.addClass('has-image');
			validForm();
		});
	});
}('.image-component');

jQuery(function () {
	if(window.location.hash){
		const $tabs = jQuery('.nav-tabs-custom');
		$tabs.each(function () {
			if($(this).find(window.location.hash).length){
				$(this).find('.active').removeClass('active');
				$(this).find(window.location.hash).addClass('in active');
				$(this).find('a[href="'+window.location.hash+'"]').parent().addClass('active');
			}
		});
	}
});

jQuery(function () {
	$('.color-picker').colorpicker({
		format: 'hex'
	});
});

jQuery(document).ready(function(){
	jQuery('input.check').iCheck({
		checkboxClass: 'icheckbox_square'
	}).on('ifChanged', function (event) {
		let data = { id: event.target.value};
		data[jQuery(this).data('type')] = event.target.checked === true ? 1 : 0;
		jQuery.ajax({
			method: 'put',
			url: updateUrl,
			data: data,
			success: function (res) {
				if(res.success){
					jQuery.notify(res.message, {
						allow_dismiss: true,
						type: 'success'
					});
				}
			},
			error: function (e) {
				jQuery.notify('Some errors' + e, {
					allow_dismiss: true,
					type: 'danger'
				});
			}
		})
	});
	jQuery('input.icheck').iCheck({
		checkboxClass: 'icheckbox_square'
	});
});

$(function () {
	if(typeof columns !== 'undefined'){
		if(typeof columnDefs === 'undefined'){
			columnDefs = [{}];
		}
		window.tableMain = $('#datatable').DataTable({
			processing: true,
			serverSide: true,
			ajax: {
				url: window['DATATABLE_URL'] || window.location.pathname + '/datatable',
				data: function (d) {
					let params = location.search.substring(1);
					params = params ? JSON.parse('{"' + decodeURI(params).replace(/"/g, '\\"').replace(/&/g, '","').replace(/=/g,'":"') + '"}') : {};
					if(window['filter_function']){
						params = { ...params, ...window['filter_function']() };
					}
					return $.extend( {}, d, params);
				}
			},
			columns: columns,
			columnDefs: [
				{  orderable: false, targets: [ columns.length - 1 ] },
				{  className: 'text-center', targets: [ 0, columns.length - 1 ] },
				...columnDefs,
			],
			order: [[ 0, 'desc' ]]
		});
		$('.filter').on('change', function () {
			window.tableMain.draw();
		});
	}
});

$(function () {
	$.each($('.currency[type="number"]'),function () {
		let money_value = $(this).val();
		let class_control = $(this).attr('class');

		let item = $(`<input class="${class_control}" type="text" value="${money_value}" />`);
		item.priceFormat({
			prefix: '',
			suffix: '',
			allowNegative: true,
			centsLimit: 0
		});

		$(this)
			.css('display','none')
			.after(item);
	});

	$( "form" ).on( "keyup change", 'input.currency[type="text"]', function() {
		$(this).priceFormat({
			prefix: '',
			suffix: '',
			allowNegative: true,
			centsLimit: 0
		});
		let money = $(this).val().replace(/,/g,'');
		$(this).prev('input.currency[type="number"]').val(money);
	});
});

jQuery(window).bind("load", function() {
	jQuery('[data-toggle="tooltip"]').tooltip({
		container: 'body'
	});
});

// jQuery(document).ajaxStart(function(){
// 	$.LoadingOverlay("show");
// });
// jQuery(document).ajaxStop(function(){
// 	$.LoadingOverlay("hide");
// });

jQuery(function () {
	$('#btn-update-status').click(function () {
		let status = $('select#status').val();
		$.confirm({
			title: 'Cảnh báo!',
			content: 'Xác nhận thay đổi trạng thái đơn hàng cho khách hàng.',
			buttons: {
				confirm: {
					text: 'Xác nhận',
					btnClass: 'btn-warning',
					action: function () {
						$.put(window['updateOrderUrl'], {status: status}, function (res) {
							$('.changed_status_at').html(res.data.changed_status_at);
							Notify('Thông báo', res.message);
						})
					}
				},
				cancel: {
					text: 'Hủy',
				}
			}
		});
	});
});

jQuery(function () {
	let optionsCkfinder = {
		filebrowserBrowseUrl: '/plugins/ckfinder/ckfinder.html',
		filebrowserImageBrowseUrl: '/plugins/ckfinder/ckfinder.html?type=Images',
		filebrowserFlashBrowseUrl: '/plugins/ckfinder/ckfinder.html?type=Flash',
		filebrowserUploadUrl: '/plugins/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
		filebrowserImageUploadUrl: '/plugins/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
		filebrowserFlashUploadUrl: '/plugins/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash'
	};

	$('.editor').each(function () {
		let yeulinh = CKEDITOR.replace($(this).attr('id'), optionsCkfinder);
		CKFinder.setupCKEditor(yeulinh, '../');
	});
});

// Make slug and seo from input
function handleGetTextEditor(){
	let timeout = null;
	textInput.onkeyup = function (e) {
		// Clear the timeout if it has already been set.
		// This will prevent the previous task from executing
		// if it has been less than <MILLISECONDS>
		clearTimeout(timeout);

		// Make a new timeout set to go off in 800ms
		timeout = setTimeout(function () {
			console.log('Input Value:', textInput.value);
		}, 500);
	};
}
jQuery(function () {
	const isEdit = parseInt($('form').attr('is_edit'));
	$('input[name*=slug]').each(function () {
		let ref = $(this).attr('ref'), inputName = $(this).attr('name').replace('slug', ref);
		let $this = $(this);
		$('input[name="'+inputName+'"]').on('keyup change', function () {
			if(!isEdit || !$this.val()){
				$this.val(window.Helper.text2slug($(this).val()));
			}
		});
	});
	if(!isEdit){
		$('[name*=seo]').each(function () {
			let ref = $(this).attr('ref'), inputName = $(this).attr('name').replace(/\[.*?\]/g, '['+ref+']');
			let $this = $(this);
			const $ele = $('[name="'+inputName+'"]');
			if($ele.hasClass('editor')){
				const $ckInstance = CKEDITOR.instances[$ele.attr('id')];
				let timeout = null;
				$ckInstance.on('key', function () {
					clearTimeout(timeout);
					timeout = setTimeout(function () {
						$this.val($ckInstance.document.getBody().getText());
					}, 600);
				});
			} else {
				$ele.on('keyup change', function () {
					$this.val($(this).val());
				});
			}
		});
	}
});

jQuery(function () {
	const $group = $('.image-multi-component');
	$('.btn-add-image-component').click(function () {
			$group.append(`<div class="input-group" style="margin-bottom: 15px">
					<input type="search" value="" name="${$group.attr('data-name')}[]" aria-label="" class="form-control">
					<span class="input-group-btn">
						<button class="btn btn-primary btn-browser" type="button"><span class="fa fa-folder-o" aria-hidden="true"></span></button>
            			<button class="btn btn-danger btn-remove" type="button"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></button>
					</span>
				</div>`);
	});
	$group.on('click', '.btn-remove', function () {
		$(this).closest('.input-group').remove();
	});
	$group.on('click', '.btn-browser', function () {
		const $component = $(this).closest('.input-group');
		CKFinderPopup(function (path) {
			path = path.substr(1);
			$component.find('input').val(path);
		});
	});
});

jQuery(function () {
	$('form').on('click', '.btn-browse', function () {
		let $url = $(this).closest('.input-group').find('input.url');
		CKFinderPopup(function (path) {
			$url.val(path);
		});
	});
});

jQuery(function(){
	$('.btn-file>input[type=file]').change(function (e) {
		$(this).closest('.input-group').find('input[data-filename]').val(e.target.files.length ? e.target.files[0].name : '');
	});
});

jQuery(function(){
	$form.submit(validForm);
	$form.on('change, keyup', 'input.required, textarea.required, select.required, input[required], textarea[required], select[required]', validForm);
});

jQuery(function(){
	$('.input-number').on('change', function () {
		$(this).val($(this).val().replace(/[^0-9.]+/g,""));
	});
});
