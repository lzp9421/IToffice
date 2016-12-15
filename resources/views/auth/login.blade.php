@include('layout.header', ['title' => '登录'])

<!-- resources/views/auth/login.blade.php -->
@if (count($errors) > 0)
    <div class="alert alert-danger">
        <ul style="color:red;">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<form method="POST" action="/auth/login" class="am-form am-form-inline">
    {!! csrf_field() !!}
    <fieldset>
        <legend>表单标题</legend>
        <div class="am-form-group">
            <label for="emial">Email</label>
            <input type="email" name="email" id="emial" value="{{ old('email') }}">
        </div>

        <div class="am-form-group">
            <label for="pasword">Password</label>
            <input type="password" name="password" id="password">
        </div>

        <div class="am-form-group">
            <input type="checkbox" name="remember" id="remember">
            <label for="remember">Remember Me</label>
        </div>

        <div>
            <button type="submit">Login</button>
        </div>
    </fieldset>
</form>

<p><a href="{{ url('auth/register') }}">注册</a></p>


<p><a href="{{ url('password/email') }}">找回密码</a></p>

<p><a href="{{ url('auth/wechat') }}">使用微信登录</a></p>

@include('layout.footer')