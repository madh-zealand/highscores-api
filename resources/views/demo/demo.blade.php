<x-minimal-layout>
    <div
        x-data="{
            currentGameUrl: '{{ $games[0]['url'] ?? '' }}',
            isActive(url) {
                return this.currentGameUrl === url;
            }
        }"
        class="flex flex-col h-screen bg-gradient-to-t from-violet-400 to-fuchsia-300"
    >
        <div class="p-3 bg-slate-800 text-slate-100 text-center text-2xl">
            Valgfaget Webudvikling
        </div>
        <div class="flex-1 flex">
            <div class="flex flex-col divide-y divide-slate-200/70 border border-slate-200/70">
                @foreach($games as $game)
                    <div
                        class="flex-1 flex p-3 cursor-pointer transition-colors duration-200"
                        :class="isActive('{{ $game['url'] }}')
                            ? 'bg-slate-800 text-slate-100'
                            : 'bg-gray-500/10 text-slate-800 hover:bg-gray-500/50'"
                        @click="currentGameUrl = '{{ $game['url'] }}'"
                    >
                        <div class="flex-1">
                            <div class="text-lg font-bold">
                                {{ $game['name'] }}
                            </div>
                            <div class="text-sm">
                                {{ $game['author'] }}
                            </div>
                        </div>
                        <div class="pl-6 flex justify-center items-center text-3xl font-bold">
                            &rsaquo;
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="flex-1">
                <iframe
                    x-bind:src="currentGameUrl"
                    class="w-full h-full border-0"
                    allowfullscreen
                ></iframe>
            </div>
        </div>
    </div>
</x-minimal-layout>
