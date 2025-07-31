<x-layout title="パスワード変更" main_additional_class="d-flex flex-column justify-content-center align-items-center">
    <h2 class="text-center">パスワード変更</h2>
    <p>管理者よりパスワード変更の依頼をされています。<br>下記のフォームより新しいパスワードへ変更してください。</p>
    <form action="{{ route('changePassword') }}" method="post" class="rounded bg-secondary-subtle w-100 p-3" style="max-width: 350px;">
        @csrf
        <div class="mb-3">
            <label for="password" class="form-label">新しいパスワード</label>
            <input type="password" name="password" value="{{ old('password') }}" autocomplete="new-password" id="password" class="form-control @error('password') is-invalid @enderror">
            @error('password')
                <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>
        <div class="mb-3">
            <label for="password_confirmation" class="form-label">新しいパスワード(確認用)</label>
            <input type="password" name="password_confirmation" autocomplete="off" id="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror">
            @error('password_confirmation')
                <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>
        <div class="text-center">
            <input type="submit" value="設定" class="btn btn-primary w-100">
        </div>
    </form>
</x-layout>
