<div class="image-multi-component" data-name="{{ $name }}">
    @foreach($list as $src)
    <div class="input-group" style="margin-bottom: 15px">
        <input type="search" value="{{ $src }}" name="{{ $name }}[]" aria-label="" class="form-control">
        <span class="input-group-btn">
            <button class="btn btn-primary btn-browser" type="button"><span class="fa fa-folder-o" aria-hidden="true"></span></button>
            <button class="btn btn-danger btn-remove" type="button"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></button>
        </span>
    </div>
    @endforeach
</div>
<button type="button" class="btn btn-primary btn-add-image-component" style="width: 100%"><i class="fa fa-plus"></i></button>
