<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('API Tokens') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("Manage your account's API tokens.") }}
        </p>
    </header>

    {{--  Form to create new token  --}}
    <form
        method="post"
        action="{{ route('profile.tokens.create') }}"
        class="mt-6 space-y-6"
    >
        @csrf

        <div>
            <x-input-label
                for="token_name"
                :value="__('Name')"
            />
            <x-text-input
                id="token_name"
                name="token_name"
                type="text"
                class="mt-1 block w-full"
                placeholder=""
                required
            />
            <div class="mt-2 text-sm text-gray-600 space-y-1">
                What is this used for?
            </div>
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>
                {{ __('Generate new token') }}
            </x-primary-button>

            @if (session('status') === 'api-token-generated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600"
                >
                    {{ __('Generated.') }}
                </p>
            @endif
            @if (session('status') === 'api-token-deleted')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600"
                >
                    {{ __('Deleted.') }}
                </p>
            @endif
        </div>
    </form>

    <hr class="my-8">

    {{--  If we have a newly generated token, show the modal with the plain token  --}}
    @if(session('token-id'))
        <div x-data="{ open: true }">
            <div
                x-cloak
                x-show="open"
                x-transition.opacity.duration.200ms
                x-trap.inert.noscroll="open"
                @keydown.esc.window="open = false"
                @click.self="open = false"
                class="fixed inset-0 z-30 flex items-end justify-center bg-black/20 p-4 pb-8 backdrop-blur-md sm:items-center lg:p-8"
                role="dialog"
                aria-modal="true"
                aria-labelledby="defaultModalTitle"
            >
                <!-- Modal Dialog -->
                <div
                    x-show="open"
                    x-transition:enter="transition ease-out duration-200 delay-100 motion-reduce:transition-opacity"
                    x-transition:enter-start="opacity-0 scale-50"
                    x-transition:enter-end="opacity-100 scale-100"
                    class="flex flex-col gap-4 overflow-hidden p-4 sm:p-8 bg-white shadow sm:rounded-lg"
                >
                    <header>
                        <h2 class="text-lg font-medium text-gray-900">
                            {{ __('API Token') }}
                        </h2>

                        <p class="mt-1 text-sm text-gray-600">
                            {{ __("Copy your new API token now. For security, it won't be shown again.") }}
                        </p>
                    </header>
                    <x-text-input
                        type="text"
                        class="mt-1 block w-[32rem]"
                        value="{{ session('new-token') }}"
                        onFocus="this.select()"
                        autofocus
                    />
                    <div class="flex justify-end gap-4">
                        <x-primary-button @click="open = false">
                            {{ __('Close') }}
                        </x-primary-button>
                    </div>
                </div>
            </div>
        </div>
    @endif

    {{--  List all existing tokens  --}}
    <div class="flex flex-col gap-5">
        @if(count($tokens) === 0)
            <div class="mt-1 block w-full text-sm text-center bg-gray-100 px-4 py-2 border border-gray-300 rounded-md shadow-sm">
                You don't have any api tokens yet
            </div>
        @endif
        @foreach($tokens as $token)
            <div
                x-data="{ revoked: false }"
                x-show="!revoked"
                x-transition:leave="transition ease-out duration-300"
                x-transition:leave-start="opacity-100 scale-100"
                x-transition:leave-end="opacity-0 scale-50"
            >
                <div class="flex mt-1 w-full p-3 border border-gray-300 rounded-md shadow-sm">
                    <div class="flex-1 flex flex-col gap-2">
                        <div class="font-bold">
                            {{ $token->name }}
                        </div>
                        <div class="text-sm">
                            @if($token->expires_at === null)
                                <span class="text-green-700">
                                Does not expire
                            </span>
                            @elseif($token->expires_at?->isPast())
                                <span class="text-red-700">
                                Expired
                            </span>
                            @else
                                <span class="text-green-700">
                                Expires in {{ $token->expires_at?->longAbsoluteDiffForHumans() }}
                            </span>
                            @endif
                        </div>
                    </div>
                    <div class="flex-1 flex flex-col items-end gap-2">
                        <form
                            method="post"
                            action="{{ route('profile.tokens.destroy', $token) }}"
                            x-on:submit.prevent="revoked = true"
                        >
                            @csrf
                            @method('delete')
                            <x-danger-button
                                class="ms-3"
                                size="small"
                                @click.debounce.300ms="$event.target.form.submit();"
                            >
                                {{ __('Revoke') }}
                            </x-danger-button>
                        </form>
                        <div class="text-gray-600 text-sm">
                            @if ($token->last_used_at)
                                Last used {{ $token->last_used_at?->longAbsoluteDiffForHumans() }} ago
                            @else
                                Not used yet
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</section>
