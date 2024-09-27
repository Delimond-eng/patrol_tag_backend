<!-- BEGIN: Top Menu -->
<nav class="top-nav">
    <ul>
        <li>
            <a href="/" class="top-menu {{ Route::is('dashboard') ? 'top-menu--active': '' }}">
                <div class="top-menu__icon"> <i data-lucide="home"></i> </div>
                <div class="top-menu__title">Evénement</div>
            </a>
        </li>
        <li>
            <a href="javascript:;.html" class="top-menu">
                <div class="top-menu__icon"> <i data-lucide="users"></i> </div>
                <div class="top-menu__title">Invités </div>
            </a>
        </li>
        <li>
            <a href="javascript:;.html" class="top-menu">
                <div class="top-menu__icon"> <i data-lucide="book"></i> </div>
                <div class="top-menu__title">Livre d'or </div>
            </a>
        </li>
        <li>
            <a href="{{ route('subscribe') }}" class="top-menu {{ Route::is('subscribe') ? 'top-menu--active': '' }}">
                <div class="top-menu__icon"> <i data-lucide="settings"></i> </div>
                <div class="top-menu__title">Configurations </div>
            </a>
        </li>
        <li>
            <a href="javascript:;.html" class="top-menu">
                <div class="top-menu__icon"> <i data-lucide="alert-circle"></i> </div>
                <div class="top-menu__title">Assistance </div>
            </a>
        </li>
    </ul>
</nav>
<!-- END: Top Menu -->
