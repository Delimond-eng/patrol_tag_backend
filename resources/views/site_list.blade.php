@extends("layouts.app")


@section("content")
<!-- BEGIN: Content -->
<div class="content">
    <div class="intro-y flex items-center mt-8">
        <h2 class="text-lg font-medium mr-auto">
            Liste des sites
        </h2>
    </div>
    <div id="App" v-cloak>
        <div class="grid grid-cols-12 gap-6 mt-5">
            <div class="intro-y col-span-12 flex flex-wrap xl:flex-nowrap items-center mt-2">
                <a href="{{ url("/site.create") }}" class="btn btn-primary shadow-md"> <i class="w-2 h-2 mr-2" data-lucide="plus"></i> Créer un nouveau site</a>
                <div class="hidden xl:block mx-auto text-slate-500"></div>
                <div class="w-full xl:w-auto flex items-center mt-3 xl:mt-0">
                    <div class="w-56 relative text-slate-500">
                        <input type="text" v-model="search" class="form-control w-56 box pr-10" placeholder="Recherche...">
                        <i class="w-4 h-4 absolute my-auto inset-y-0 mr-3 right-0" data-lucide="search"></i>
                    </div>
                </div>
            </div>
            <!-- BEGIN: Data List -->
            <div class="intro-y col-span-12 overflow-auto 2xl:overflow-visible">
                <table class="table table-report -mt-2">
                    <thead>
                        <tr>
                            <th class="whitespace-nowrap">NOM & CODE</th>
                            <th class="text-center whitespace-nowrap">ADRESSE</th>
                            <th class="text-center whitespace-nowrap">GPS</th>
                            <th class="text-center whitespace-nowrap">TELEPHONE</th>
                            <th class="text-center whitespace-nowrap">ACTIONS</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="intro-x" v-for="(data, index) in allSites" :key="data.id">
                            <td class="!py-3.5">
                                <div class="flex items-center">
                                    <div class="ml-4">
                                        <a href="javascript:void(0);" class="font-medium whitespace-nowrap">@{{ data.name }}</a>
                                        <div class="text-slate-500 text-xs whitespace-nowrap mt-0.5">@{{ data.code }}
                                        </div>
                                    </div>
                            </td>
                            <td class="concat"> @{{ data.adresse }}</td>
                            <td class="text-center">@{{ data.latlng }}</td>
                            <td class="text-center">@{{ data.latlng }}</td>
                            <td class="table-report__action w-56">
                                <div class="flex justify-center items-center">
                                    <a class="flex items-center mr-3 text-primary" href="javascript:;" @click.prevent="selectedAreas = data.areas; form.id = data.id; form.name = data.name" data-tw-toggle="modal" data-tw-target="#modal-add-on"> <i data-lucide="plus" class="w-4 h-4 mr-1"></i>Ajout zones </a>
                                    <a class="flex items-center text-primary mr-3" :href="'/loadpdf/'+data.id"> <i data-lucide="printer" class="w-4 h-4"></i> </a>
                                    <a class="flex items-center text-danger" href="javascript:;"> <i data-lucide="trash-2" class="w-4 h-4"></i> </a>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div id="modal-add-on" class="modal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <form @submit.prevent="createSite" method="POST" action="{{ route('site.create') }}" class="modal-content form-site">
                    <!-- BEGIN: Modal Header -->
                    <div class="modal-header">
                        <h2 v-if="form.name" class="font-medium text-base mr-auto">
                            @{{ form.name }}
                        </h2>
                    </div>
                    <!-- END: Modal Header -->
                    <!-- BEGIN: Modal Body -->
                    <div class="modal-body">
                        <div class="grid grid-cols-12 gap-2 gap-y-1">
                            <h2 v-if="selectedAreas.length > 0" class="font-medium text-base col-span-12">
                                Zones de patrouille existantes
                            </h2>
                            <div class="flex items-center bg-slate-200 py-2 col-span-12" v-for="(item, i) in selectedAreas" :key="item.id">
                                <div class="border-l-2 border-primary dark:border-primary pl-4">
                                    <a href="javascript:void(0);" class="font-medium">@{{ item.libelle }}</a>
                                </div>
                                <div class="ml-auto">
                                    <a @click.prevent="deleteArea(item.id)" class="flex items-center text-danger mr-2 tooltip" title="Suppression de la zone" href="javascript:;">
                                        <span v-show="load_id === item.id"><i data-loading-icon="oval" data-color="white" class="w-4 h-4 ml-2"></i> </span>
                                        <span v-show="load_id !== item.id"><i data-lucide="trash-2" class="w-4 h-4"></i> </span>
                                    </a>
                                </div>
                            </div>

                            <h2 class="font-medium text-base col-span-12">
                                Veuillez ajoutes les zones à ce site !
                            </h2>

                            <div class="input-form mt-1 col-span-12" v-for="(input, j) in form.areas">
                                <label for="validation-form-3" class="form-label w-full flex flex-col sm:flex-row"> Libellé@{{ j }} *
                                    <span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-primary" v-if="j===0">
                                        <a href="javascript:void(0);" @click.prevent="form.areas.push({libelle:''})">Ajouter</a>
                                    </span>
                                    <span v-else class="sm:ml-auto mt-1 sm:mt-0 text-xs text-red-500">
                                        <a href="javascript:void(0);" @click.prevent="form.areas.splice(j,1)">Reduire</a>
                                    </span>
                                </label>
                                <input id="validation-form-3" v-model="input.libelle" type="text" name="libelle" class="form-control" placeholder="Saisir le libellé de la zone..." required>
                            </div>
                        </div>
                    </div>
                    <!-- END: Modal Body -->
                    <!-- BEGIN: Modal Footer -->
                    <div class="modal-footer">
                        <button id="btn-reset" type="button" @click.prevent="reset" data-tw-dismiss="modal" class="btn btn-outline-secondary w-20 mr-1">Fermer</button>
                        <button :disabled="isLoading" type="submit" class="btn btn-primary mt-5">Sauvegarder les modifications <span v-if="isLoading"><i data-loading-icon="oval" data-color="white" class="w-4 h-4 ml-2"></i> </span></button>
                    </div>
                    <!-- END: Modal Footer -->

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

                </form>
            </div>
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
