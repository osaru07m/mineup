<x-layout title="設定">
    <div class="d-flex justify-content-start align-items-center gap-2 mb-2">
        <img src="https://www.gravatar.com/avatar/{{ md5(strtolower(trim($auth->email))) }}?s=50" class="rounded">
        <h2 class="mb-0">設定</h2>
    </div>
    <div class="row g-2">
        <div class="col-12 col-lg-6 d-flex">
            <form action="{{ route('setting.info') }}" method="post" class="card flex-fill">
                @csrf
                <div class="card-body">
                    <h3 class="card-title fs-5">基本情報</h3>
                    <div class="row g-3 align-items-center mb-2">
                        <div class="col-12 col-lg-4 text-start text-lg-end">
                            <label for="last_name" class="col-form-label">姓</label>
                        </div>
                        <div class="col-12 col-lg-8">
                            <input type="text" name="last_name" value="{{ old('last_name') ?? $auth->last_name }}" autocomplete="family-name" id="last_name" class="form-control @error('last_name') is-invalid @enderror">
                            @error('last_name')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="row g-3 align-items-center mb-2">
                        <div class="col-12 col-lg-4 text-start text-lg-end">
                            <label for="first_name" class="col-form-label">名</label>
                        </div>
                        <div class="col-12 col-lg-8">
                            <input type="text" name="first_name" value="{{ old('first_name') ?? $auth->first_name }}" autocomplete="given-name" id="first_name" class="form-control @error('first_name') is-invalid @enderror">
                            @error('first_name')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="row g-3 align-items-center mb-2">
                        <div class="col-12 col-lg-4 text-start text-lg-end">
                            <label for="email" class="col-form-label">メールアドレス</label>
                        </div>
                        <div class="col-12 col-lg-8">
                            <input type="email" name="email" value="{{ old('email') ?? $auth->email }}" autocomplete="email" id="email" class="form-control @error('email') is-invalid @enderror">
                            @error('email')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="row g-3 align-items-center mb-2">
                        <div class="col-12 col-lg-4 text-start text-lg-end">
                            <label for="language" class="col-form-label">言語</label>
                        </div>
                        <div class="col-12 col-lg-8">
                            <select name="language" id="language" class="form-select @error('language') is-invalid @enderror">
                                <option value="auto" {{ (old('language') === 'auto' || $auth->language === 'auto') ? 'selected' : '' }}>自動</option>
                                <option value="ja" {{ (old('language') === 'ja' || $auth->language === 'ja') ? 'selected' : '' }}>日本語</option>
                            </select>
                            @error('language')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="text-center">
                        <input type="submit" value="更新" class="btn btn-outline-primary">
                    </div>
                </div>
            </form>
        </div>
        <div class="col-12 col-lg-6 d-flex">
            <form action="{{ route('setting.auth') }}" method="post" class="card flex-fill">
                @csrf
                <div class="card-body">
                    <h3 class="card-title fs-5">認証</h3>
                    <div class="row g-3 align-items-center mb-2">
                        <div class="col-12 col-lg-4 text-start text-lg-end">
                            <label for="login" class="col-form-label">ログインID</label>
                        </div>
                        <div class="col-12 col-lg-8">
                            @php
                                $loginTooltipText = $auth->is_admin
                                    ? 'ユーザー管理にて変更可能'
                                    : '管理者のみ変更可能';
                            @endphp
                            <input type="text" value="{{ $auth->login }}" id="login" class="form-control" disabled data-bs-toggle="tooltip" title="{{ $loginTooltipText }}">
                        </div>
                    </div>
                    <div class="row g-3 align-items-center mb-2">
                        <div class="col-12 col-lg-4 text-start text-lg-end">
                            <label for="password" class="col-form-label">新たなパスワード</label>
                        </div>
                        <div class="col-12 col-lg-8">
                            <input type="password" name="password" autocomplete="new-password" id="password" class="form-control @error('password') is-invalid @enderror">
                            @error('password')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="row g-3 align-items-center mb-2">
                        <div class="col-12 col-lg-4 text-start text-lg-end">
                            <label for="password_confirmation" class="col-form-label">新たなパスワード(確認用)</label>
                        </div>
                        <div class="col-12 col-lg-8">
                            <input type="password" name="password_confirmation" autocomplete="off" id="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror">
                            @error('password_confirmation')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="text-center">
                        <input type="submit" value="更新" class="btn btn-outline-primary">
                    </div>
                </div>
            </form>
        </div>
    </div>
    @push('javascript')
        <script>
            $(function () {
                $('[data-bs-toggle="tooltip"]').tooltip();
            });
        </script>
    @endpush
</x-layout>
