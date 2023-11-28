const Helper = {};

Helper.RandomString = function (length = 10) {
	let result           = '';
	let characters       = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
	let charactersLength = characters.length;
	for (let i = 0; i < length; i++ ) {
		result += characters.charAt(Math.floor(Math.random() * charactersLength));
	}
	return result;
};

Helper.text2slug = function (slug) {
	//Đổi chữ hoa thành chữ thường
	slug = slug.toLowerCase();

	//Đổi ký tự có dấu thành không dấu
	slug = slug.replace(/á|à|ả|ạ|ã|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ/gi, 'a');
	slug = slug.replace(/é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ/gi, 'e');
	slug = slug.replace(/i|í|ì|ỉ|ĩ|ị/gi, 'i');
	slug = slug.replace(/ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ/gi, 'o');
	slug = slug.replace(/ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự/gi, 'u');
	slug = slug.replace(/ý|ỳ|ỷ|ỹ|ỵ/gi, 'y');
	slug = slug.replace(/đ/gi, 'd');
	//Xóa các ký tự đặt biệt
	slug = slug.replace(/\`|\~|\!|\@|\#|\||\$|\%|\^|\&|\*|\(|\)|\+|\=|\,|\.|\/|\?|\>|\<|\'|\"|\:|\;|_/gi, '');
	//Đổi khoảng trắng thành ký tự gạch ngang
	slug = slug.replace(/ /gi, "-");
	//Đổi nhiều ký tự gạch ngang liên tiếp thành 1 ký tự gạch ngang
	//Phòng trường hợp người nhập vào quá nhiều ký tự trắng
	slug = slug.replace(/\-\-\-\-\-/gi, '-');
	slug = slug.replace(/\-\-\-\-/gi, '-');
	slug = slug.replace(/\-\-\-/gi, '-');
	slug = slug.replace(/\-\-/gi, '-');
	//Xóa các ký tự gạch ngang ở đầu và cuối
	slug = '@' + slug + '@';

	let from = "ÁÄÂÀÃÅČÇĆĎÉĚËÈÊẼĔȆĞÍÌÎÏİŇÑÓÖÒÔÕØŘŔŠŞŤÚŮÜÙÛÝŸŽáäâàãåčçćďéěëèêẽĕȇğíìîïıňñóöòôõøðřŕšşťúůüùûýÿžþÞĐđßÆa·/_,:;";
	let to   = "AAAAAACCCDEEEEEEEEGIIIIINNOOOOOORRSSTUUUUUYYZaaaaaacccdeeeeeeeegiiiiinnooooooorrsstuuuuuyyzbBDdBAa------";
	for (let i=0, l=from.length ; i<l ; i++) {
		slug = slug.replace(new RegExp(from.charAt(i), 'g'), to.charAt(i));
	}

	return slug.replace(/\@\-|\-\@|\@/gi, '');
};

Helper.formatNumber = function (value) {
	return (value || '0').toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,');
}

window.Helper = Helper;
