@extends("layouts.app")


@section("content")
<!-- BEGIN: Content -->
<div class="content">
    <div class="intro-y flex items-center mt-8">
        <h2 class="text-lg font-medium mr-auto">
            Liste des agents
        </h2>
    </div>
    <div class="grid grid-cols-12 gap-6 mt-5" id="App" v-cloak>
        <div class="intro-y col-span-12 flex flex-wrap xl:flex-nowrap items-center mt-2">
            <a href="{{ url("/agent.create") }}" class="btn btn-primary shadow-md"> <i class="w-2 h-2 mr-2" data-lucide="plus"></i> Créer un nouveau agent</a>
            <div class="hidden xl:block mx-auto text-slate-500"></div>
            <div class="w-full xl:w-auto flex items-center mt-3 xl:mt-0">
                <div class="w-56 relative text-slate-500">
                    <input type="text" v-model="search" class="form-control w-56 box pr-10" placeholder="Par nom ou matricule...">
                    <i class="w-4 h-4 absolute my-auto inset-y-0 mr-3 right-0" data-lucide="search"></i>
                </div>
            </div>
        </div>
        <!-- BEGIN: Data List -->
        <div class="intro-y col-span-12 overflow-auto 2xl:overflow-visible">
            <table class="table table-report -mt-2">
                <thead>
                    <tr>
                        <th class="whitespace-nowrap">NOM & MATRICULE</th>
                        <th class="text-center whitespace-nowrap">MOT DE PASSE APP</th>
                        <th class="text-center whitespace-nowrap">SITE</th>
                        <th class="text-center whitespace-nowrap">STATUS</th>
                        <th class="text-center whitespace-nowrap">ACTIONS</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="intro-x" v-for="data in allAgents">
                        <td class="!py-3.5">
                            <div class="flex items-center">
                                <div class="w-9 h-9">
                                    <img alt="Patrol Tag" src="assets/images/security-guard.svg" title="">
                                </div>
                                <div class="ml-4">
                                    <a href="javascript:void(0)" class="font-medium whitespace-nowrap">@{{ data.fullname }}</a>
                                    <div class="text-slate-500 text-xs whitespace-nowrap mt-0.5">@{{data.matricule}}</div>
                                </div>
                            </div>
                        </td>
                        <td class="text-center"> <a class="flex items-center justify-center underline decoration-dotted" href="javascript:;">@{{ data.password }}</a> </td>
                        <td class="text-center capitalize uppercase"><span v-if="data.site">@{{ data.site.name }}</span></td>
                        <td class="w-40">
                            <div class="flex items-center justify-center text-success"> <i data-lucide="check-square" class="w-4 h-4 mr-2"></i> @{{ data.status }} </div>
                        </td>
                        <td class="table-report__action w-56">
                            <div class="flex justify-center items-center">
                                <a class="flex items-center text-primary mr-3" href="javascript:;" @click.prevent="form.fullname=data.fullname; form.id= data.id;" data-tw-toggle="modal" data-tw-target="#modal-edit-on"> <i data-lucide="arrow-left-right" class="w-4 h-4 mr-1"></i>Changer site </a>
                                <a class="flex items-center text-danger" href="javascript:;"> <i data-lucide="trash-2" class="w-4 h-4 mr-1"></i></a>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <!-- END: Data List -->

        <div id="modal-edit-on" class="modal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
                <form @submit.prevent="createAgent" method="POST" action="{{ route('agent.create') }}" class="modal-content form-agent">
                    <!-- BEGIN: Modal Header -->
                    <div class="modal-header">
                        <h2 v-if="form.fullname" class="font-medium text-base mr-auto">
                            AGENT <span class="text-primary">@{{ form.fullname }}</span> </h2>
                    </div>
                    <!-- END: Modal Header -->
                    <!-- BEGIN: Modal Body -->
                    <div class="modal-body">
                        <div class="grid grid-cols-12 gap-2 gap-y-1">
                            <h2 class="font-medium text-base col-span-12">
                                Veuillez sélectionner un site pour muter cet agent !
                            </h2>
                            <div class="input-form mt-1 col-span-12">
                                <select class="form-select w-full" v-model="form.site_id" required>
                                    <option label="Sélectionnez un site d'affectation" selected hidden></option>
                                    @foreach ($sites as $site)
                                    <option value="{{ $site->id }}">{{ $site->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <!-- END: Modal Body -->
                    <!-- BEGIN: Modal Footer -->
                    <div class="modal-footer">
                        <button id="btn-reset" type="button" @click.prevent="reset" data-tw-dismiss="modal" class="btn btn-outline-secondary w-20 mr-1">Fermer</button>
                        <button :disabled="isLoading" type="submit" class="btn btn-primary">Sauvegarder les modifications <span v-if="isLoading"><i data-loading-icon="oval" data-color="white" class="w-4 h-4 ml-2"></i> </span></button>
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
<script type="module" src="{{ asset("assets/js/scripts/agent_manager.js") }}"></script>
@endsection
