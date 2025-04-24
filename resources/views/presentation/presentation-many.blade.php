<x-minimal-layout bgColor="#ffffff">
    <div class="absolute top-0 right-0 flex flex-col p-3">
        <a href="?fontSize={{ $fontSize + 2 }}" class="bg-gray-200 opacity-10 hover:opacity-80 transition-opacity flex justify-center items-center w-8 h-8 rounded-t-full">
            +
        </a>
        <a href="?fontSize={{ $fontSize - 2 }}" class="bg-gray-200 opacity-10 hover:opacity-80 transition-opacity flex justify-center items-center w-8 h-8 rounded-b-full">
            -
        </a>
    </div>
    <div class="flex flex-wrap h-screen bg-gradient-to-t from-violet-400 to-fuchsia-300">
        @foreach($games as $game)
            <div class="flex-1 basis-1/4 h-1/2 border border-white border-opacity-30">
                <iframe
                    src="{{ route('presentation', $game) }}?hideControls=1&fontSize={{ $fontSize }}&refreshRate=10000"
                    width="100%"
                    height="100%"
                    class="block"
                ></iframe>
            </div>
        @endforeach
    </div>
    <script>
        // Full refresh every 2 minutes
        setInterval(() => {
            window.location = window.location.href;
        }, 2 * 60 * 1000);
    </script>
</x-minimal-layout>
