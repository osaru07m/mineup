<x-layout title="ログイン" main_additional_class="d-flex flex-column justify-content-center align-items-center">
    <h2 class="visually-hidden">ログイン</h2>
    <form action="{{ route('login') }}" method="post" class="rounded bg-secondary-subtle w-100 p-3" style="max-width: 350px;">
        @csrf
        <div class="mb-3">
            <label for="login" class="form-label">ログインID</label>
            <input type="text" name="login" value="{{ old('login') }}" autocomplete="username" id="login" class="form-control @error('login') is-invalid @enderror">
            @error('login')
                <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">パスワード</label>
            <input type="password" name="password" autocomplete="current-password" id="password" class="form-control @error('password') is-invalid @enderror">
            @error('password')
                <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>
        <div class="mb-3 form-check">
            <input type="checkbox" name="remember" id="remember" class="form-check-input" {{ old('remember') ? 'checked' : '' }}>
            <label for="remember" class="form-check-label">ログインを維持</label>
        </div>
        <div class="text-center">
            <input type="submit" value="ログイン" class="btn btn-primary w-100">
        </div>
    </form>
</x-layout>
