@extends("layouts.app")

@section("content")
<!-- BEGIN: Content -->
<div class="content">
    <div class="intro-y flex items-center mt-8">
        <h2 class="text-lg font-medium mr-auto">
            Création agent
        </h2>
    </div>
    <div class="grid grid-cols-12 gap-6 mt-5">
        <div class="intro-y col-span-12 lg:col-span-6">
            <!-- BEGIN: Form Validation -->
            <div class="intro-y box">
                <div class="flex flex-col sm:flex-row items-center p-5 border-b border-slate-200/60 dark:border-darkmode-400">
                    <h2 class="font-medium text-base mr-auto">
                        Renseignez tous les champs requis
                    </h2>
                </div>
                <div id="form-validation" class="p-5">
                    <div class="preview">
                        <!-- BEGIN: Validation Form -->
                        <form class="validate-form-2">
                            <div class="input-form">
                                <label for="validation-form-1" class="form-label w-full flex flex-col sm:flex-row"> Name <span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-slate-500">Required, at least 2 characters</span> </label>
                                <input id="validation-form-1" type="text" name="name" class="form-control" placeholder="John Legend" minlength="2" required>
                            </div>
                            <div class="input-form mt-3">
                                <label for="validation-form-2" class="form-label w-full flex flex-col sm:flex-row"> Email <span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-slate-500">Required, email address format</span> </label>
                                <input id="validation-form-2" type="email" name="email" class="form-control" placeholder="example@gmail.com" required>
                            </div>
                            <div class="input-form mt-3">
                                <label for="validation-form-3" class="form-label w-full flex flex-col sm:flex-row"> Password <span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-slate-500">Required, at least 6 characters</span> </label>
                                <input id="validation-form-3" type="password" name="password" class="form-control" placeholder="secret" minlength="6" required>
                            </div>
                            <div class="input-form mt-3">
                                <label for="validation-form-4" class="form-label w-full flex flex-col sm:flex-row"> Age <span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-slate-500">Required, integer only & maximum 3 characters</span> </label>
                                <input id="validation-form-4" type="number" name="age" class="form-control" placeholder="21" required>
                            </div>
                            <div class="input-form mt-3">
                                <label for="validation-form-5" class="form-label w-full flex flex-col sm:flex-row"> Profile URL <span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-slate-500">Optional, URL format</span> </label>
                                <input id="validation-form-5" type="url" name="url" class="form-control" placeholder="https://google.com/">
                            </div>
                            <div class="input-form mt-3">
                                <label for="validation-form-6" class="form-label w-full flex flex-col sm:flex-row"> Comment <span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-slate-500">Required, at least 10 characters</span> </label>
                                <textarea id="validation-form-6" class="form-control" name="comment" placeholder="Type your comments" minlength="10" required></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary mr-2 mt-5">Register</button>
                            <button type="button" id="btn-notify" class="btn btn-light mt-5">show notification</button>
                        </form>
                        <!-- END: Validation Form -->
                        <!-- BEGIN: Success Notification Content -->
                        <div id="success-notification-content" class="toastify-content hidden flex">
                            <i class="text-success" data-lucide="check-circle"></i>
                            <div class="ml-4 mr-4">
                                <div class="font-medium">Registration success!</div>
                                <div class="text-slate-500 mt-1"> Please check your e-mail for further info! </div>
                            </div>
                        </div>
                        <!-- END: Success Notification Content -->

                    </div>

                </div>
            </div>
            <!-- END: Form Validation -->
        </div>
    </div>
</div>
<!-- BEGIN: Failed Notification Content -->
<div id="failed-notification-content" class="toastify-content hidden flex">
    <i class="text-danger" data-lucide="x-circle"></i>
    <div class="ml-4 mr-4">
        <div class="font-medium">Registration failed!</div>
        <div class="text-slate-500 mt-1"> Please check the fileld form. </div>
    </div>
</div>
<!-- END: Failed Notification Content -->

<!-- END: Content -->
<!-- BEGIN: Notification Content -->
<div id="test-notify" class="toastify-content hidden flex"> <i data-lucide="hard-drive"></i>
    <div class="ml-4 mr-4">
        <div class="font-medium">Storage Removed!</div>
        <div class="text-slate-500 mt-1">The server will restart in 30 seconds, don't make<br> changes during the update process!</div>
        <div class="font-medium flex mt-1.5"> <a class="text-primary dark:text-slate-400" href="">Restart Now</a> <a class="text-slate-500 ml-3" href="">Cancel</a> </div>
    </div>
</div>
<!-- END: Notification Content -->

@endsection

@section("scripts")
<script src=" https://cdn.jsdelivr.net/npm/pristinejs@1.1.0/dist/pristine.min.js "></script>
<script src=" https://cdn.jsdelivr.net/npm/toastify-js@1.12.0/src/toastify.min.js "></script>
<script src="{{ asset("assets/js/test.js") }}"></script>
@endsection
