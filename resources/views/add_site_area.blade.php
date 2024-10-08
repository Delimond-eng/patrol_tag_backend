@extends("layouts.app")

@section("content")
<!-- BEGIN: Content -->
<div class="content">
    <div class="intro-x flex items-center mt-8">
        <h2 class="text-lg font-medium mr-auto">
            Création site + zones de patrouille
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
                        <form class="form-site" method="POST" action="{{ route("site.create") }}" @submit.prevent="createSite">
                            <div class="input-form">
                                <label for="validation-form-1" class="form-label w-full flex flex-col sm:flex-row"> Nom du site <span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-slate-500">*</span> </label>
                                <input id="validation-form-1" v-model="form.name" type="text" name="name" class="form-control" placeholder="Entrer le nom du site" minlength="2" required>
                            </div>
                            <div class="input-form mt-2">
                                <label for="validation-form-1" class="form-label w-full flex flex-col sm:flex-row"> Code du site <span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-slate-500">*</span> </label>
                                <input id="validation-form-1" v-model="form.code" type="text" name="code" class="form-control" placeholder="Entrer le code du site" minlength="2" required>
                            </div>

                            <div class="input-form mt-2">
                                <label for="validation-form-6" class="form-label w-full flex flex-col sm:flex-row"> Adresse <span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-slate-500">*</span> </label>
                                <textarea id="validation-form-6" v-model="form.adresse" class="form-control" name="adresse" placeholder="N°xx, Q.xx, C.xxxxxx" minlength="10" required></textarea>
                            </div>

                            <div class="input-form mt-2">
                                <label for="validation-form-2" class="form-label w-full flex flex-col sm:flex-row"> Téléphone <span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-slate-500">(optionnel)</span> </label>
                                <input id="validation-form-2" v-model="form.phone" type="tel" name="phone" class="form-control" placeholder="+(243)xx xxx xxx" minlength="10">
                            </div>


                            <h2 class="font-medium text-base text-primary mr-auto mt-3">
                                Zones de patrouille *
                            </h2>
                            <div class="input-form mt-2" v-for="(data, index) in form.areas" :key="index">
                                <label for="validation-form-3" class="form-label w-full flex flex-col sm:flex-row"> Libellé *
                                    <span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-primary" v-if="index===0">
                                        <a href="javascript:void(0);" @click.prevent="form.areas.push({libelle:''})">Ajouter</a>
                                    </span>
                                    <span v-else class="sm:ml-auto mt-1 sm:mt-0 text-xs text-red-500">
                                        <a href="javascript:void(0);" @click.prevent="form.areas.splice(index,1)">Reduire</a>
                                    </span>
                                </label>
                                <input id="validation-form-3" v-model="data.libelle" type="text" name="libelle" class="form-control" placeholder="Saisir le libellé de la zone..." required>
                            </div>
                            <button :disabled="isLoading" type="submit" class="btn btn-primary mt-5">Enregistrer <span v-if="isLoading"><i data-loading-icon="oval" data-color="white" class="w-4 h-4 ml-2"></i> </span></button>
                            <button @click.prevent="reset" type="button" class="btn btn-light mt-5">Annuler</button>
                        </form>
                        <!-- END: Validation Form -->
                        <!-- BEGIN: Success Notification Content -->
                        <div id="success-notification-content" class="toastify-content hidden flex">
                            <i class="text-success" data-lucide="check-circle"></i>
                            <div class="ml-4 mr-4">
                                <div class="font-medium">Opération effectuée !</div>
                                <div class="text-slate-500 mt-1"> la création d'un nouveau site de patrouille effectuée ! </div>
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
                <img src="{{ asset('assets/images/loading.gif') }}" class="w-12 h-12" />
            </div>
        </div>
    </div>

</div>
<!-- END: Content -->
@endsection

@section("scripts")
<script type="module" src="{{ asset("assets/js/scripts/areas_manager.js") }}"></script>
@endsection
