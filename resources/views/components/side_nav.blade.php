<nav class="side-nav">
    <ul>
        <li>
            <a href="/" class="side-menu {{ Route::is("dashboard") ? 'side-menu--active' : '' }}">
                <div class="side-menu__icon"> <i data-lucide="monitor"></i> </div>
                <div class="side-menu__title"> Monitoring </div>
            </a>
        </li>

        <li>
            <a href="javascript:;.html" class="side-menu {{ Route::is("site.create") ? 'side-menu--active' : '' }}">
                <div class="side-menu__icon"> <i data-lucide="map"></i> </div>
                <div class="side-menu__title">
                    Gestion des sites
                    <div class="side-menu__sub-icon"> <i data-lucide="chevron-down"></i> </div>
                </div>
            </a>
            <ul class="side-menu__sub">
                <li>
                    <a href="{{ url('/site.create') }}" class="side-menu">
                        <div class="side-menu__icon"> <i data-lucide="minus"></i> </div>
                        <div class="side-menu__title"> Création site & zones </div>
                    </a>
                </li>
                <li>
                    <a href="" class="side-menu">
                        <div class="side-menu__icon"> <i data-lucide="minus"></i> </div>
                        <div class="side-menu__title"> Liste des sites </div>
                    </a>
                </li>
            </ul>
        </li>
        <li>
            <a href="javascript:;.html" class="side-menu {{ Route::is("agent.create") ? 'side-menu--active' : '' }}">

                <div class="side-menu__icon"> <i data-lucide="users"></i> </div>
                <div class="side-menu__title">
                    Gestion agents
                    <div class="side-menu__sub-icon"> <i data-lucide="chevron-down"></i> </div>
                </div>
            </a>
            <ul class="side-menu__sub">
                <li>
                    <a href="{{ url('/agent.create') }}" class="side-menu">
                        <div class="side-menu__icon"> <i data-lucide="minus"></i> </div>
                        <div class="side-menu__title"> Création agent </div>
                    </a>
                </li>
                <li>
                    <a href="" class="side-menu">
                        <div class="side-menu__icon"> <i data-lucide="minus"></i> </div>
                        <div class="side-menu__title"> Assignation </div>
                    </a>
                </li>
                <li>
                    <a href="" class="side-menu">
                        <div class="side-menu__icon"> <i data-lucide="minus"></i> </div>
                        <div class="side-menu__title"> Liste des agents </div>
                    </a>
                </li>
            </ul>
        </li>

        <li>
            <a href="" class="side-menu">
                <div class="side-menu__icon"> <i data-lucide="bar-chart-2"></i> </div>
                <div class="side-menu__title"> Rapports patrouille </div>
            </a>
        </li>

        <li class="side-nav__devider my-6"></li>


        <li>
            <a href="" class="side-menu">
                <div class="side-menu__icon"> <i data-lucide="alert-circle"></i> </div>
                <div class="side-menu__title"> Assistance technique </div>
            </a>
        </li>
        <li>
            <a href="" class="side-menu">
                <div class="side-menu__icon"> <i data-lucide="toggle-right"></i> </div>
                <div class="side-menu__title"> Déconnexion </div>
            </a>
        </li>


    </ul>
</nav>
