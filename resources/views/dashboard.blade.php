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
                <!-- BEGIN: Weekly Best Sellers -->
                <div class="col-span-12 lg:col-span-8 xl:col-span-4">
                    <div class="intro-y flex items-center h-10">
                        <h2 class="text-lg font-medium truncate mr-5">
                            Patrouilles en cours...
                        </h2>
                    </div>
                </div>
                <!-- END: Weekly Best Sellers -->
                <div class="col-span-12">
                    <div class="grid grid-cols-3 sm:grid-cols-3 md:grid-cols-3 lg:grid-cols-3 gap-3">
                        @for ($i=0; $i<6; $i++) <div class="intro-y">
                            <div class="box px-4 py-4 mb-3 flex items-center zoom-in">
                                <div class="w-10 h-10 flex-none image-fit rounded-md overflow-hidden">
                                    <img alt="Patrol Tag" src="assets/images/patrol.gif">
                                </div>
                                <div class="ml-4 mr-auto">
                                    <div class="font-medium">SITE : Moero nord</div>
                                    <div class="text-slate-500 text-xs mt-0.5">AGENT : Gaston Delimond</div>
                                </div>
                                <div class="py-1 px-2 rounded-md text-xs bg-slate-500 text-white cursor-pointer font-medium">2 areas</div>
                            </div>
                    </div>
                    @endfor
                </div>

            </div>
        </div>
    </div>

</div>
</div>
@endsection
