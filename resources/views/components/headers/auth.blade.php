<ul class="navbar-nav me-auto">
    <li class="nav-item">
        <a href="{{ route('home') }}" class="nav-link">ホーム</a>
    </li>
    @if (Auth::user()->is_admin === true)
        <li class="nav-item dropdown">
            <button class="nav-link dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">管理</button>
            <ul class="dropdown-menu">
                <li><a href="{{ route('admin.dashboard') }}" class="dropdown-item">ダッシュボード</a></li>
                <li><a href="{{ route('admin.activities') }}" class="dropdown-item">アクティビティ</a></li>
            </ul>
        </li>
    @endif
</ul>
<ul class="navbar-nav ms-auto">
    <li class="nav-item">
        <a href="{{ route('logout') }}" class="nav-link">ログアウト</a>
    </li>
</ul>
