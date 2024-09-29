@extends('layouts.auth')

@section('content')
<div class="container sm:px-10">
    <div class="block xl:grid grid-cols-2 gap-4">
        <!-- BEGIN: Login Info -->
        <div class="hidden xl:flex flex-col min-h-screen">
            <a href="#" class="-intro-x flex items-center pt-5">
                <img alt="Patrol Tag" class="w-6" src="assets/images/patrol.svg">
                <span class="text-white text-lg font-extrabold ml-3"> PATROL TAG </span>
            </a>
            <div class="my-auto">
                <img alt="Patrol Tag" class="-intro-x w-1/2 -mt-16" src="assets/images/illustration.svg">
                <div class="-intro-x text-white font-medium text-4xl leading-tight mt-10">
                    Authentification
                    <br>
                    Centre de contrôle
                </div>
                <div class="-intro-x mt-5 text-lg text-white text-opacity-70 dark:text-slate-400">Utilisez vos identifiants pour vous authentifier !</div>

            </div>
        </div>
        <!-- END: Login Info -->
        <!-- BEGIN: Login Form -->
        <form id="Auth" v-cloak method="POST" @submit.prevent="login" action="{{ route('login') }}" class="h-screen xl:h-auto flex py-5 xl:py-0 my-10 xl:my-0 login-form">
            @csrf
            <div class="my-auto mx-auto xl:ml-20 bg-white dark:bg-darkmode-600 xl:bg-transparent px-5 sm:px-8 py-8 xl:p-0 rounded-md shadow-md xl:shadow-none w-full sm:w-3/4 lg:w-2/4 xl:w-auto">
                <h2 class="intro-x font-bold text-2xl xl:text-3xl text-center xl:text-left">
                    CONNEXION
                </h2>
                <div class="intro-x mt-8">
                    <div class="input-form">
                        <input type="email" name="email" class="intro-x login__input form-control  py-3 px-4 block" placeholder="Email" required>
                    </div>
                    <div class="input-form">
                        <input type="password" name="password" class="intro-x login__input form-control py-3 px-4 block mt-4" placeholder="Mot de passe" required>
                    </div>
                </div>

                <div class="intro-x mt-5 xl:mt-8 text-center xl:text-left flex flex-col xl:flex-row justify-center xl:justify-start">
                    <button :disabled="isLoading" type="submit" class="btn btn-primary py-3 px-4 w-full align-top">Connecter <span v-if="isLoading"><i data-loading-icon="oval" data-color="white" class="w-4 h-4 ml-2"></i> </span> </button>
                </div>
                <div class="intro-x mt-10 xl:mt-24 text-slate-600 dark:text-slate-500 text-center xl:text-left"> Patrol Tag By Rapid Tech Solution. all right reserved. <a class="text-primary dark:text-slate-200" href="#">Privacy Policy</a> </div>
            </div>

            <!-- BEGIN: Failed Notification Content -->
            <div id="failed-notification-content" class="toastify-content hidden flex">
                <i class="text-danger" data-lucide="x-circle"></i>
                <div class="ml-4 mr-4">
                    <div class="font-medium">Echec d'authentification !</div>
                    <div class="text-slate-500 mt-1">Email ou mot de passe incorrect. </div>
                </div>
            </div>
            <!-- END: Failed Notification Content -->

            <div id="success-notification-content" class="toastify-content hidden flex">
                <i class="text-success" data-lucide="check-circle"></i>
                <div class="ml-4 mr-4">
                    <div class="font-medium">Connexion reussi !</div>
                    <div class="text-slate-500 mt-1">Redirection vers la page d'administration! </div>
                </div>
            </div>

        </form>

        <div class="h-full flex items-center" id="loader">
            <div class="mx-auto text-center">
                <div>
                    Chargement en cours...
                </div>
            </div>
        </div>
        <!-- END: Login Form -->
    </div>
</div>
@endsection

@section("scripts")
<script type="module" src="{{ asset("assets/js/scripts/auth.js") }}"></script>
@endsection
