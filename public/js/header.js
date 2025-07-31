$(document).ready(function () {
    //ANCHOR - ヘッダーリンクをアクティベート
    const currentPath = window.location.pathname;
    const items = $('header a.nav-link, header a.dropdown-item');

    items.each(function () {
        const linkPath = new URL($(this).prop('href'), window.location.origin).pathname;

        if (linkPath === currentPath || linkPath === currentPath.replace(/\/$/, '')) {
            $(this).addClass('active');
            $(this).attr('aria-current', 'page');
        }
    });
});
