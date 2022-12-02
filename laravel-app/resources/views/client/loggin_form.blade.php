<div id="loggin">
    <div class="title_search" style="border: none; margin-top: 18px">ĐĂNG NHẬP TÀI KHOẢN</div>
    <div style="font-size: 12px; width: 80%; height: 20px; margin: auto; text-align: center; color: #677279; margin-top: 5px">Nhập Email và mật khẩu của bạn:</div>

    <form role="form" method="POST" action="/loggin_account">
        {{ csrf_field() }}
    <div class="form" style="position: relative">
        <div class="form__item">
          <input type="text" required name="email_loggin" id="email_loggin">
          <label for="">Email</label>
        </div>
        <div class="form__item">
          <input type="password" required name="password_loggin" id="password_loggin">
          <label for="">Mật khẩu</label>
        </div>
        <div style="position: absolute; width: 95%; top: 130px; font-size: 12px; color:gray; font-style: italic" id="ktLoggin"></div>
      </div>
    <input type="submit" class="loggin" style="margin-left:13px; margin-top: 10px" value="ĐĂNG NHẬP" onclick="return checkUserLoggin();">
    </form>

    <div style="width: 52%; margin: auto; color: #677279; font-size: 12px; margin-top: 20px">
        <div style="float: left">Khách hàng mới?</div>
        <a href="/account/register" style="text-decoration: none; cursor: pointer; margin-left: 5px">Tạo tài khoản</a>
    </div>
    <div style="width: 60%; margin: auto; color: #677279; font-size: 12px; margin-top: 15px">
        <div style="float: left">Quên mật khẩu?</div>
        <a href="#" style="text-decoration: none; cursor: pointer; margin-left: 5px">Khôi phục mật khẩu</a>
    </div>


</div>