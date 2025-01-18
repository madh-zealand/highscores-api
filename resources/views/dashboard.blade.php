<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-5">
                <div class="pb-4">
                    <h3 class="text-base/7 font-semibold text-gray-900">
                        Games
                    </h3>
                    <p class="mt-1 max-w-2xl text-sm/6 text-gray-500">
                        Your games open for highscores.
                    </p>
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    @foreach($games as $game)
                        <a
                            href="#"
                            class="w-full flex-auto overflow-hidden rounded-3xl bg-white hover:bg-gray-50 hover:-translate-y-1 shadow-lg ring-1 ring-gray-900/5"
                        >
                            <div class="px-6 py-3">
                                <div class="group relative flex gap-x-6 rounded-lg">
                                    <div>
                                        <div class="font-semibold text-gray-900 text-base">
                                            {{ $game->title }}
                                        </div>
                                        <div class="mt-1 text-gray-500 text-xs">
                                            Created
                                            {{ $game->created_at->toFormattedDateString() }}
                                            {{ $game->created_at->toTimeString() }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="border-t">
                                <div class="px-6 py-2 flex divide-x">
                                    <div class="flex-1 flex flex-col items-center">
                                        <div class="mt-1 text-gray-800 text-sm">
                                            #
                                        </div>
                                        <div class="mt-1 text-gray-500 text-xs">
                                            Highscores
                                        </div>
                                    </div>
                                    <div class="flex-1 flex flex-col items-center">
                                        <div class="mt-1 text-gray-800 text-sm">
                                            #
                                        </div>
                                        <div class="mt-1 text-gray-500 text-xs">
                                            Since last
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
