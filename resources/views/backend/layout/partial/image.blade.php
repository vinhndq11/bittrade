<div class="form-group">
    {{ Form()::label("id_".$image['name'], $image['label']) }}
    <input  type="file" accept="image/gif,image/jpeg,image/jpg,image/png,image/bmp" style="display: none;" name="{{$image['name']}}" id="id_{{$image['name']}}" onchange="setImageC(this, $(this))">
    <div class="input-group" id="imagesList" style="width: 100%;position: relative;">
        <img src="{{asset($image['src'])}}" class="img-thumbnail anhdaidienC" style="width: 100%;" id="anhdaidien" alt="Ảnh đại diện tin tức">
        <div style="font-size: 18px;position: absolute; z-index: 2;top: 5px;left: 5px;font-weight: bold;background: rgba(0, 0, 0, 0.74);padding: 0px 5px;color: white;border-bottom-right-radius: 3px;">
            Tỉ lệ: <span class="aspect">NaN</span>
        </div>
    </div>
    <input type="hidden" name="clearIMG" value="0">
    <div class="btn-group" style="width: 100%;font-weight: bold;">
        <button type="button" style="width: 50%" onclick="$(this).parent().parent().find('input').trigger('click')" class="btn btn-sm btn-primary">
            <i class="fa fa-image"></i> Duyệt ảnh
        </button>
        <button type="button" style="width: 50%" onclick="xoaAll($(this))" class="btn btn-sm btn-warning">
            <i class="fa fa-trash"></i> Xóa ảnh
        </button>
    </div>
</div>
