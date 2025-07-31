<?php


?>
<ul class="navbar-nav ms-auto">
    @if ((bool) ApplicationSetting::get('is_guest_registration_allowed') === true)
        <li class="nav-item">
            <a href="{{ route('register') }}" class="nav-link">新規登録</a>
        </li>
    @endif
    <li class="nav-item">
        <a href="{{ route('login') }}" class="nav-link">ログイン</a>
    </li>
</ul>
