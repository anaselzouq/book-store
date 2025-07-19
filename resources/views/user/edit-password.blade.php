@extends('layouts.footer')
@extends('layouts.nav')

@section('content')
<div class="container py-5">
    <h2 class="mb-4">تغيير كلمة المرور</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form method="POST" action="{{ route('account.password.update') }}">
        @csrf

        <div class="mb-3">
            <label for="current_password" class="form-label">كلمة المرور الحالية</label>
            <input type="password" name="current_password" class="form-control" required>
            @error('current_password')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="new_password" class="form-label">كلمة المرور الجديدة</label>
            <input type="password" name="new_password" class="form-control" required>
            @error('new_password')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="new_password_confirmation" class="form-label">تأكيد كلمة المرور الجديدة</label>
            <input type="password" name="new_password_confirmation" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">تحديث كلمة المرور</button>
    </form>
</div>

@endsection
