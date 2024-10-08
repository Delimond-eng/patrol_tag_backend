@extends("layouts.app")

@section("content")
<div class="content">
    <div class="grid grid-cols-12 gap-6">
        <div class="col-span-12 2xl:col-span-9">
            <div class="grid grid-cols-12 gap-6">
                <!-- BEGIN: Ads 1 -->
                <div class="col-span-12 lg:col-span-12 mt-6">
                    <div class="box p-8 relative overflow-hidden intro-y" style="background-color:#007efc">
                        <div class="leading-[2.15rem] w-full sm:w-72 text-white text-xl -mt-3 mr-2 font-extrabold uppercase">Patrouille monitoring</div>
                        <div class="w-full sm:w-72 leading-relaxed text-white/70 dark:text-slate-500 mt-3">Recevez en temps réel le processus de patrouille dans chaque site !</div>
                        <img class="hidden sm:block absolute bottom-0 right-0 mr-2 " alt="Patrol tag" style="width:22%" src="assets/images/patrol.gif">
                    </div>
                </div>
                <!-- END: Ads 1 -->
                <div class="col-span-12">
                    <div class="grid grid-cols-12 gap-2" id="App" v-cloak>
                        <!-- BEGIN: Weekly Best Sellers -->
                        <div class="col-span-12 lg:col-span-12 xl:col-span-12" v-if="allPendingPatrols.length > 0">
                            <div class="intro-y flex items-center h-10">
                                <h2 class="text-lg font-medium truncate mr-5">
                                    Patrouilles en cours
                                </h2>
                            </div>
                        </div>
                        <!-- END: Weekly Best Sellers -->
                        <div class="col-span-12" v-if="allPendingPatrols.length > 0">
                            <div class="grid grid-cols-3 sm:grid-cols-3 md:grid-cols-3 lg:grid-cols-3 gap-3">
                                <div class="intro-y" v-for="item in allPendingPatrols" @click.prevent="onSelectItem(item)" data-tw-toggle="modal" data-tw-target="#modal-infos">
                                    <div class="box px-4 py-4 mb-3 flex items-center zoom-in">
                                        <div class="w-10 h-10 flex-none overflow-hidden">
                                            <img alt="Patrol Tag" src="assets/images/security.svg">
                                        </div>
                                        <div class="ml-4 mr-auto">
                                            <div class="font-medium"> <span v-if="item.site">@{{item.site.name}}</span> </div>
                                            <div class="text-slate-500 text-xs mt-0.5"><span v-if="item.agent">@{{item.agent.matricule }}| @{{item.agent.fullname}}</span></div>
                                        </div>
                                        <div class="py-1 px-2 rounded-md text-xs bg-slate-500 text-white cursor-pointer font-medium">
                                            <span v-if="item.scans">@{{ item.scans.length }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-span-12" v-else>
                            <div class="h-64 flex items-center">
                                <div class="mx-auto text-center">
                                    <div class="flex items-center flex-col">
                                        <i data-lucide="alert-octagon" class="text-pending w-12 h-12 mb-3"></i>
                                        <span>Aucune patrouille en cours répertoriée !</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div id="modal-infos" class="modal" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-xl">
                                <div class="modal-content bg-slate-100">
                                    <!-- BEGIN: Modal Body -->
                                    <div class="modal-body">
                                        <div class="grid grid-cols-12 gap-2 gap-y-1" v-if="selectedPatrol">
                                            <div class="col-span-12">
                                                <div class="box p-8 relative overflow-hidden intro-y" style="background-color:#007efc">
                                                    <div class="leading-[2.15rem] w-full sm:w-72 text-white text-xl -mt-3 mr-2 font-extrabold uppercase"> <span v-if="selectedPatrol.site">@{{ selectedPatrol.site.name }}</span> </div>
                                                    <div class="w-full sm:w-72 leading-relaxed text-white/70 dark:text-slate-500 mt-3"><span class="text-white d-flex">@{{ selectedPatrol.started_at }}</span></div>
                                                    <img class="hidden sm:block absolute bottom-0 right-0 mr-2 " alt="Patrol tag" style="width:22%" src="assets/images/patrol.gif">
                                                </div>
                                            </div>

                                            <div class="col-span-12 md:col-span-12">
                                                <div class="mt-5 relative before:block before:absolute before:w-px before:h-[85%] before:bg-slate-200 before:dark:bg-darkmode-400 before:ml-5 before:mt-5">
                                                    <div class="intro-x relative flex items-center mb-3" v-for="data in selectedPatrol.scans">
                                                        <div class="before:block before:absolute before:w-20 before:h-px before:bg-slate-200 before:dark:bg-darkmode-400 before:mt-5 before:ml-5">
                                                            <div class="w-10 h-10 flex-none image-fit overflow-hidden">
                                                                <img alt="icon" src="assets/images/area-2.png">
                                                            </div>
                                                        </div>
                                                        <div class="box px-5 py-3 ml-4 flex-1 zoom-in">
                                                            <div class="flex items-center">
                                                                <div class="font-medium" v-if="data.area">@{{ data.area.libelle }}</div>
                                                                <div class="text-xs text-slate-500 ml-auto">
                                                                    <span>@{{ data.time }}</span>
                                                                </div>
                                                            </div>
                                                            <div class="text-slate-500 mt-1"><span>Distance : @{{ data.distance }}</span> | <span class="font-semibold">Agent : @{{ data.agent.matricule }} - @{{ data.agent.fullname }}</span>
                                                                <span class="py-1 px-2 rounded-md text-xs bg-slate-500 text-white cursor-pointer font-medium ml-6">
                                                                    success
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="h-64 flex items-center" v-else>
                                            <div class="mx-auto text-center">
                                                <div class="flex items-center flex-col">
                                                    <i data-lucide="shield-off" class="text-pending w-12 h-12 mb-3"></i>
                                                    <span>Patrouille clôturée !</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- END: Modal Body -->
                                    <!-- BEGIN: Modal Footer -->
                                    <div class="modal-footer">
                                        <button id="btn-reset" data-tw-dismiss="modal" class="btn btn-outline-secondary w-20 mr-1">Fermer</button>
                                    </div>
                                    <!-- END: Modal Footer -->
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="h-64 flex items-center" id="loader">
                        <div class="mx-auto text-center">
                            <div>
                                <img src="{{ asset('assets/images/loading.gif') }}" class="w-12 h-12" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection

@section("scripts")
<script type="module" src="{{ asset("assets/js/scripts/monitoring.js") }}"></script>
@endsection
