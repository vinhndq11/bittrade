/**
 * Created by Hadesker on 03/08/2017.
 */
function setImage(img) {
    if (img.files[0]) {
        var FR = new FileReader();
        FR.addEventListener("load", function (e) {
            $('#anhdaidien').attr('src', e.target.result);
        });
        FR.readAsDataURL(img.files[0]);
    }
    else {
        $('#anhdaidien').attr('src', defaultPath);
    }
}

function setImageC(img, input) {
    var _URL = window.URL || window.webkitURL;
    var root = input.parent();
    if (img.files[0]) {
        var ig = new Image();
        ig.onload = function () {
            root.find('.anhdaidienC').attr('src', this.src);
            root.find('input[name="clearIMG"]').val(0);
            var gcd = (a, b) => (b == 0) ? a : gcd (b, a%b);
            var g = gcd(this.width,this.height);
            root.find('.aspect').html((this.width/g)+"x"+(this.height/g));
        };
        ig.src = _URL.createObjectURL(img.files[0]);
    }
    else {
        root.find('.anhdaidienC').attr('src', defaultPath);
    }
}

function xoaAll(input) {
    var root = input.parent().parent();
    var inputImage = root.find('input[type="file"]');
    root.find('input[name="clearIMG"]').val(1);
    root.find('img').attr('src', defaultPath);
    inputImage.replaceWith(inputImage.val('').clone(true));
}

$(".anhdaidienC").each(function() {
    var tmpImg = new Image();
    tmpImg.src = this.src;
    tmpImg.onload = function() {
        var gcd = (a, b) => (b == 0) ? a : gcd (b, a%b);
        var g = gcd(this.width,this.height);
        var src = this.src;
        var aspect = (this.width/g)+"x"+(this.height/g);
        $('img[src="'+src+'"]').parent().find('.aspect').html(aspect);
    } ;
});

