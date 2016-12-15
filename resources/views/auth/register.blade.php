@include('layout.header', ['title' => '登录'])

<!-- resources/views/auth/register.blade.php -->
@if (count($errors) > 0)
    <div class="alert alert-danger">
        <ul style="color:red;">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<form method="POST" action="/auth/register" class="am-form am-form-inline">
    {!! csrf_field() !!}
    <fieldset>
        <legend>表单标题</legend>
        <div class="am-form-group">
            <label for="name">Name</label>
            <input type="text" name="name" id="name" value="{{ old('name') }}">
        </div>

        <div class="am-form-group">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" value="{{ old('email') }}">
        </div>

        <div class="am-form-group">
            <label for="password">Password</label>
            <input type="password" name="password" id="password">
        </div>

        <div class="am-form-group">
            <label for="password_confirmation">Confirm Password</label>
            <input type="password" name="password_confirmation" id="password_confirmation">
        </div>

        <div>
            <button type="submit">Register</button>
        </div>
    </fieldset>
</form>

@include('layout.footer')