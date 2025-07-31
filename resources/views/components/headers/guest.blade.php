<ul class="navbar-nav ms-auto">
    @if ($isGuestRegistrationAllowed === true)
        <li class="nav-item">
            <a href="{{ route('register') }}" class="nav-link">新規登録</a>
        </li>
    @endif
    <li class="nav-item">
        <a href="{{ route('login') }}" class="nav-link">ログイン</a>
    </li>
</ul>
