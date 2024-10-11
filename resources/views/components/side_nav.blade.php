<nav class="side-nav">
    <ul>
        <li>
            <a href="/" class="side-menu {{ Route::is("dashboard") ? 'side-menu--active' : '' }}">
                <div class="side-menu__icon"> <i data-lucide="monitor"></i> </div>
                <div class="side-menu__title"> Monitoring </div>
            </a>
        </li>

        <li>
            <a href="javascript:;.html" class="side-menu {{ Route::is("site.create") || Route::is("sites.list") ? 'side-menu--active' : '' }}">
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
                    <a href="{{ url("/sites.list") }}" class="side-menu">
                        <div class="side-menu__icon"> <i data-lucide="minus"></i> </div>
                        <div class="side-menu__title"> Liste des sites </div>
                    </a>
                </li>
            </ul>
        </li>
        <li>
            <a href="javascript:;" class="side-menu {{ Route::is("agent.create") || Route::is("agents.list") ? 'side-menu--active' : '' }}">
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
                    <a href="{{ url("/agents.list") }}" class="side-menu">
                        <div class="side-menu__icon"> <i data-lucide="minus"></i> </div>
                        <div class="side-menu__title"> Liste des agents </div>
                    </a>
                </li>
            </ul>
        </li>

        <li>
            <a href="{{ url("/reports") }}" class="side-menu  {{ Route::is("reports") ? 'side-menu--active' : '' }}">
                <div class="side-menu__icon"> <i data-lucide="bar-chart-2"></i> </div>
                <div class="side-menu__title"> Rapports patrouille </div>
            </a>
        </li>
        <li>
            <a href="{{url("/schedules")}}" class="side-menu {{ Route::is("schedules") ? 'side-menu--active' : '' }}">
                <div class="side-menu__icon"> <i data-lucide="watch"></i> </div>
                <div class="side-menu__title"> Planning de patrouille </div>
            </a>
        </li>
        <li class="side-nav__devider my-6"></li>
        <li>
            <a href="{{url("/announces")}}" class="side-menu {{ Route::is("announces") ? 'side-menu--active' : '' }}">
                <div class="side-menu__icon"> <i data-lucide="twitch"></i> </div>
                <div class="side-menu__title"> Communiqués </div>
            </a>
        </li>

        <li>
            <a href="javascript:;" class="side-menu  {{ Route::is("requests") || Route::is("signalements") ? 'side-menu--active' : '' }}">
                <div class="side-menu__icon"> <i data-lucide="command"></i> </div>
                <div class="side-menu__title">
                    Requêtes & signalements
                    <div class="side-menu__sub-icon"> <i data-lucide="chevron-down"></i> </div>
                </div>
            </a>
            <ul class="side-menu__sub">
                <li>
                    <a href="{{ url("/requests") }}" class="side-menu">
                        <div class="side-menu__icon"> <i data-lucide="minus"></i> </div>
                        <div class="side-menu__title"> Requêtes </div>
                    </a>
                </li>
                <li>
                    <a href="{{ url("/signalements") }}" class="side-menu">
                        <div class="side-menu__icon"> <i data-lucide="minus"></i> </div>
                        <div class="side-menu__title">Signalements </div>
                    </a>
                </li>
            </ul>
        </li>

        <li class="side-nav__devider my-6"></li>
        <li>
            <a href="javascript:void(0)" class="side-menu">
                <div class="side-menu__icon"> <i data-lucide="user"></i> </div>
                <div class="side-menu__title"> Gestion d'habilitation </div>
            </a>
        </li>

        <li class="side-nav__devider my-6"></li>
        <li>
            <a href="javascript:void(0)" class="side-menu">
                <div class="side-menu__icon"> <i data-lucide="alert-circle"></i> </div>
                <div class="side-menu__title"> Assistance technique </div>
            </a>
        </li>
        <li>
            <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="side-menu">
                <div class="side-menu__icon"> <i data-lucide="toggle-right"></i> </div>
                <div class="side-menu__title"> Déconnexion </div>
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </li>
    </ul>
</nav>
