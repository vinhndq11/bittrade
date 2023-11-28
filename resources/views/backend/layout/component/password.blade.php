<div class="input-group">
    <input type="password" class="form-control" name="password" maxlength="255"
           minlength="6" aria-required="true" aria-invalid="true"
           value="" id="inputMatKhau">
    <div class="input-group-btn">
        <button style="margin-right: 0px" type="button" id="btnShowHidden" class="btn btn-warning btn-flat">Ẩn</button>
    </div>
</div>
<label style="color: #3702ff">
    {{isset($mainData) ? "Nếu để trống, mật khẩu sẽ giữ nguyên không thay đổi" : "Nếu để trống, mật khẩu mặc định sẽ được đặt trùng với email" }}
</label>
