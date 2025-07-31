<x-layout title="新規登録" main_additional_class="d-flex flex-column justify-content-center align-items-center">
    <h2 class="text-center">新規登録</h2>
    @if (session('success') == true)
        <div class="rounded bg-secondary-subtle w-100 p-3" style="max-width: 350px;">
            <p>登録が完了しました。<br>管理者が承認をするとログインすることができます。</p>
            <p class="mb-0">しばらく経っても承認されない場合は管理者へお問い合わせください。</p>
        </div>
    @else
        <form action="{{ route('register') }}" method="post" class="rounded bg-secondary-subtle w-100 p-3" style="max-width: 350px;">
            @csrf
            <div class="mb-3">
                <label for="login" class="form-label">ログインID</label>
                <input type="text" name="login" value="{{ old('login') }}" autocomplete="off" id="login" class="form-control @error('login') is-invalid @enderror">
                @error('login')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">パスワード</label>
                <input type="password" name="password" autocomplete="new-password" id="password" class="form-control @error('password') is-invalid @enderror">
                @error('password')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-3">
                <label for="password_confirmation" class="form-label">パスワード(確認用)</label>
                <input type="password" name="password_confirmation" autocomplete="off" id="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror">
                @error('password_confirmation')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-3">
                <label for="last_name" class="form-label">姓</label>
                <input type="text" name="last_name" autocomplete="family-name" id="last_name" class="form-control @error('last_name') is-invalid @enderror">
                @error('last_name')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-3">
                <label for="first_name" class="form-label">名</label>
                <input type="text" name="first_name" autocomplete="given-name" id="first_name" class="form-control @error('first_name') is-invalid @enderror">
                @error('first_name')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">メールアドレス</label>
                <input type="email" name="email" autocomplete="email" id="email" class="form-control @error('email') is-invalid @enderror">
                @error('email')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-3">
                <label for="language" class="form-label">使用言語</label>
                <select name="language" id="language" class="form-select @error('language') is-invalid @enderror">
                    <option value="auto" selected>自動</option>
                    <option value="ja">日本語</option>
                </select>
                @error('language')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
            <div class="text-center">
                <input type="submit" value="登録" class="btn btn-primary w-100">
            </div>
        </form>
    @endif
</x-layout>
