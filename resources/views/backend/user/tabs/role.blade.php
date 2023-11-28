<div class="box user-form">
    <div class="box-body">
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead>
                <tr>
                    <th style="text-align: center; vertical-align: middle;"></th>
                    <th style="text-align: left; vertical-align: middle;">Tên vai trò</th>
                    <th style="text-align: left; vertical-align: middle;">Tên hiển thị</th>
                    <th style="text-align: left; vertical-align: middle;">Mô tả</th>
                    <th style="text-align: center; vertical-align: middle;">Ngày tạo</th>
                    <th style="text-align: center; vertical-align: middle;">...</th>
                </tr>
                </thead>
                <tbody>
                @foreach($roles as $key=>$value)
                    <tr>
                        <td style="text-align: center; vertical-align: middle;">
                            {{ ($key+1) }}
                        </td>
                        <td style="text-align: left; vertical-align: middle;">
                            {{ $value->name }}
                        </td>
                        <td style="text-align: left; vertical-align: middle;">
                            {{ $value->display_name }}
                        </td>
                        <td style="text-align: left; vertical-align: middle;">
                            {{ $value->description }}
                        </td>
                        <td style="text-align: center; vertical-align: middle;">
                            {!! DateTimeObject($value->created_at) !!}
                        </td>
                        <td style="text-align: center; vertical-align: middle;">
                            <input type="checkbox"
                                   {{ $mainData->is_admin ? 'checked disabled readonly' : '' }}
                                   {{ in_array($value->id, $mainData->roles->pluck('id')->toArray()) ? 'checked' : '' }}
                                    data-type="update_role" aria-label="Check" value="{{ $value->id }}" class="check">
                        </td>
                    </tr>
                @endforeach
                </tbody>
                <tfoot>
                <tr>
                    <th style="text-align: center; vertical-align: middle;"></th>
                    <th style="text-align: left; vertical-align: middle;">Tên vai trò</th>
                    <th style="text-align: left; vertical-align: middle;">Tên hiển thị</th>
                    <th style="text-align: left; vertical-align: middle;">Mô tả</th>
                    <th style="text-align: center; vertical-align: middle;">Ngày tạo</th>
                    <th style="text-align: center; vertical-align: middle;">...</th>
                </tr>
                </tfoot>
            </table>

        </div>
    </div>
</div>
