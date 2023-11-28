(function($) {
    $.fn.hadeskerPreviewFile = function(options) {
        let _element = this;

        let root_plugin = function () {
            let scripts = document.querySelectorAll( 'script[src]' );
            let currentScript = scripts[ scripts.length - 1 ].src;
            let currentScriptChunks = currentScript.split( '/' );
            let currentScriptFile = currentScriptChunks[ currentScriptChunks.length - 1 ];
            return currentScript.replace( currentScriptFile, '' ) +'../';
        };

        let img_extention = ['jpeg', 'jpg', 'png', 'gif', 'bmp', 'svg'];

        let defaults = {
            input_name: 'file[]',
            folder_path: 'images',
            multiple: true,
            url_upload_file: 'images',
            param_updload_file: 'file[]'
        };

        let settings = $.extend(defaults, options);

        function img_cover(file_name, src) {
            return '<div class="img-cover">' +
                '<img src="' + src + '" class="img-item">' +
                '<label class="file-name">'+ file_name.split('@^@')[0] +'</label>'+
                '<input type="hidden" name="' + settings.input_name + '" value="' + file_name + '">' +
                '<button type="button" class="trash" onclick="$(this).parent().fadeOut(500, function(){ $(this).remove();})"><i class="fa fa-trash"></i></button>' +
                '</div>';
        }

        let input_file = '<input style="display: none" id="preview-file" type="file" ' + (settings.multiple ? 'multiple' : '') + '>';
        this.append(input_file);

        let extention_file = new Array();
        extention_file['word'] = ['doc', 'docx', 'dot'];
        extention_file['excel'] = ['xls', 'xlsx', 'xla'];
        extention_file['ppt'] = ['ppt', 'pot', 'pps', 'pptx'];
        extention_file['mp3'] = ['mp3'];
        extention_file['pdf'] = ['pdf'];

        let img_default = new Array();
        img_default['word'] = 'img/word.png';
        img_default['excel'] = 'img/excel.png';
        img_default['ppt'] = 'img/ppt.png';
        img_default['mp3'] = 'img/mp3.png';
        img_default['pdf'] = 'img/pdf.png';


        function getSRC(file_name) {           
            let ext = file_name.substr(file_name.lastIndexOf('.') + 1);
            for (let key in extention_file) {
                if (extention_file[key].indexOf(ext) > -1)
                    return root_plugin()+img_default[key];
            }
            return settings.folder_path + '/' + file_name;
        }

        function appendFile(file_name) {
            let src = getSRC(file_name);
            _element.append(img_cover(file_name, src));
        }

        let ajaxLoadFile = function(e) {
            let form_data = new FormData();
            form_data.append('browser', 'true');
            form_data.append('folder_path', settings.folder_path);
            $.each(e.target.files, function(key, value) {
                form_data.append(settings.param_updload_file, value);
            });

            $.ajax({
                type: "POST",
                url: settings.url_upload_file,
                data: form_data,
                processData: false,
                cache: false,
                contentType: false,
                dataType: 'json',
                success: function(res) {
                    if (res.status) {
                        let fi = res.data;
                        $.each(fi, function(key, value) {
                            appendFile(value);
                        });
                    }else
                        Notify('Lỗi',res.message,'error');
                }
            });
        };

        this.add = function() {
            $(input_file).click().change(ajaxLoadFile);
        };

        this.load = function(arr_file) {
            if(arr_file && arr_file[0]!='')
                $.each(arr_file, function(key, value) {
                    appendFile(value);
                });
            return _element;
        };

        return this;
    }

})(jQuery);