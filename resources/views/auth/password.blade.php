@include('layout.header', ['title' => '登录'])

<!-- resources/views/auth/password.blade.php -->
@if (count($errors) > 0)
    <div class="alert alert-danger">
        <ul style="color:red;">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<form method="POST" action="/password/email" class="am-form am-form-inline">
    {!! csrf_field() !!}
    <fieldset>
        <legend>表单标题</legend>
        <div class="am-form-group">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" value="{{ old('email') }}">
        </div>

        <div>
            <button type="submit">Send Password Reset Link</button>
        </div>
    </fieldset>
</form>

@include('layout.footer')