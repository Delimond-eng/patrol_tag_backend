@extends('layouts.auth')

@section('content')
<div class="container sm:px-10">
    <div class="block xl:grid grid-cols-2 gap-4">
        <!-- BEGIN: Login Info -->
        <div class="hidden xl:flex flex-col min-h-screen">
            <a href="#" class="-intro-x flex items-center pt-5">
                <img alt="Midone - HTML Admin Template" class="w-6" src="assets/images/patrol.svg">
                <span class="text-white text-lg font-extrabold ml-3"> PATROL TAG </span>
            </a>
            <div class="my-auto">
                <img alt="Midone - HTML Admin Template" class="-intro-x w-1/2 -mt-16" src="assets/images/illustration.svg">
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
        <form method="POST" action="{{ route('login') }}" class="h-screen xl:h-auto flex py-5 xl:py-0 my-10 xl:my-0">
            @csrf
            <div class="my-auto mx-auto xl:ml-20 bg-white dark:bg-darkmode-600 xl:bg-transparent px-5 sm:px-8 py-8 xl:p-0 rounded-md shadow-md xl:shadow-none w-full sm:w-3/4 lg:w-2/4 xl:w-auto">
                <h2 class="intro-x font-bold text-2xl xl:text-3xl text-center xl:text-left">
                    Connexion
                </h2>
                <div class="intro-x mt-2 text-slate-400 xl:hidden text-center">A few more clicks to sign in to your account. Manage all your e-commerce accounts in one place</div>
                <div class="intro-x mt-8">
                    <input type="email" name="email" class="intro-x login__input form-control  py-3 px-4 block @error('email') has-error @enderror" placeholder="Email" required>
                    <input type="password" name="password" class="intro-x login__input form-control py-3 px-4 block mt-4 @error('password') has-error @enderror" placeholder="Password" required>
                </div>
                <div class="intro-x flex text-slate-600 dark:text-slate-500 text-xs sm:text-sm mt-4">
                    <div class="flex items-center mr-auto">
                        <input id="remember-me" type="checkbox" class="form-check-input border mr-2" name="remember" {{ old('remember') ? 'checked' : '' }}>
                        <label class="cursor-pointer select-none" for="remember-me">Garder ma session</label>
                    </div>
                </div>
                <div class="intro-x mt-5 xl:mt-8 text-center xl:text-left flex flex-col xl:flex-row justify-center xl:justify-start">
                    <button type="submit" class="btn btn-primary py-3 px-4 w-full align-top">Connecter</button>
                </div>
                <div class="intro-x mt-10 xl:mt-24 text-slate-600 dark:text-slate-500 text-center xl:text-left"> Patrol Tag By Rapid Tech Solution. all right reserved. <a class="text-primary dark:text-slate-200" href="#">Privacy Policy</a> </div>
            </div>
        </form>
        <!-- END: Login Form -->
    </div>
</div>
@endsection
