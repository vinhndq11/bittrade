<div class="btn-group" style="min-width: max-content" role="group">
    @if($edit ?? false)
        <a type="button" href="{{ $edit['url'] ?? $edit ?? '' }}" class="btn btn-sm btn-primary"><i class="fa fa-pencil"></i></a>
    @endif
    @if($view ?? false)
        <a type="button" href="{{ $view['url'] ?? $view ?? '' }}" class="btn btn-sm btn-success"><i class="fa fa-eye"></i></a>
    @endif
    @if($detail ?? false)
        <button type="button" data-link="{{ $detail }}" title="Xem giao dịch" class="btn-detail btn btn-sm btn-success"><i class="fa fa-eye"></i></button>
    @endif
    @if($confirm ?? false)
        <button type="button" data-link="{{ $confirm['url'] ?? $confirm ?? '' }}" title="Xác nhận giao dịch" class="btn btn-sm btn-warning btn-confirm"><i class="fa fa-check"></i></button>
    @endif
    @if($delete ?? false)
        <a type="button" onclick="deleteRow.bind(this, '{{ $delete['url'] ?? $delete ?? '' }}','{{ $delete['text'] ?? '' }}')()" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
    @endif
</div>
