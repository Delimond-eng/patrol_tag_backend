@extends("layouts.app")

@section("content")
<!-- BEGIN: Content -->
<div class="content">
    <div class="intro-x flex items-center mt-8">
        <h2 class="text-lg font-medium mr-auto">
            Création agents
        </h2>
    </div>
    <div class="grid grid-cols-12 gap-6 mt-5" id="App" v-cloak>
        <div class="intro-x col-span-12 lg:col-span-7">
            <!-- BEGIN: Form Validation -->
            <div class="intro-y box">
                <div class="flex flex-col sm:flex-row items-center p-5 border-b border-slate-200/60 dark:border-darkmode-400">
                    <h2 class="font-medium text-base mr-auto">
                        Renseignez tous les champs requis
                    </h2>
                </div>
                <div id="form-site" class="p-5">
                    <div class="preview">
                        <!-- BEGIN: Validation Form -->
                        <form class="form-agent" method="POST" action="{{ route("agent.create") }}" @submit.prevent="createAgent">
                            <div class="input-form">
                                <label for="validation-form-2" class="form-label w-full flex flex-col sm:flex-row"> Site affecté <span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-slate-500">*</span> </label>
                                <select class="form-select w-full" v-model="form.site_id" required>
                                    <option label="Sélectionnez un site affecté" selected hidden></option>
                                    @foreach ($sites as $site)
                                    <option value="{{ $site->id }}">{{ $site->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="input-form mt-2">
                                <label for="validation-form-1" class="form-label w-full flex flex-col sm:flex-row"> Matricule <span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-slate-500">*</span> </label>
                                <input id="validation-form-1" v-model="form.matricule" type="text" name="matricule" class="form-control" placeholder="Entrer le n° matricule de l'agent" minlength="2" required>
                            </div>
                            <div class="input-form mt-2">
                                <label for="validation-form-1" class="form-label w-full flex flex-col sm:flex-row"> Nom complet <span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-slate-500">*</span> </label>
                                <input id="validation-form-1" v-model="form.fullname" type="text" name="fullname" class="form-control" placeholder="Entrer le code du site" minlength="2" required>
                            </div>

                            <div class="input-form mt-2">
                                <label for="validation-form-2" class="form-label w-full flex flex-col sm:flex-row"> Mot de passe <span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-slate-500">(optionnel)</span> </label>
                                <input id="validation-form-2" v-model="form.password" type="text" name="phone" class="form-control" placeholder="Entrer le mot de passe" minlength="5" required>
                            </div>
                            <button :disabled="isLoading" type="submit" class="btn btn-primary mt-5">Enregistrer <span v-if="isLoading"><i data-loading-icon="oval" data-color="white" class="w-4 h-4 ml-2"></i></button>
                            <button @click.prevent="reset" type="button" class="btn btn-light mt-5">Annuler</button>
                        </form>
                        <!-- END: Validation Form -->


                        <!-- BEGIN: Success Notification Content -->
                        <div id="success-notification-content" class="toastify-content hidden flex">
                            <i class="text-success" data-lucide="check-circle"></i>
                            <div class="ml-4 mr-4">
                                <div class="font-medium">Opération effectuée !</div>
                                <div class="text-slate-500 mt-1"> la création de l'agent effectuée avec succès! </div>
                            </div>
                        </div>
                        <!-- END: Success Notification Content -->


                        <!-- BEGIN: Failed Notification Content -->
                        <div id="failed-notification-content" class="toastify-content hidden flex">
                            <i class="text-danger" data-lucide="x-circle"></i>
                            <div class="ml-4 mr-4">
                                <div class="font-medium">Echec de traitement de la requête!</div>
                                <div class="text-slate-500 mt-1" v-if="error">@{{ error }} </div>
                            </div>
                        </div>
                        <!-- END: Failed Notification Content -->
                    </div>

                </div>
            </div>
            <!-- END: Form Validation -->
        </div>
    </div>
    <div class="h-full flex items-center" id="loader">
        <div class="mx-auto text-center">
            <div>
                Chargement en cours...
            </div>
        </div>
    </div>

</div>
<!-- END: Content -->
@endsection

@section("scripts")
<script type="module" src="{{ asset("assets/js/scripts/agent_manager.js") }}"></script>
@endsection
