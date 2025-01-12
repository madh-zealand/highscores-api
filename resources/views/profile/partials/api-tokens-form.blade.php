<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('API Tokens') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("Manage your account's API tokens.") }}
        </p>
    </header>

    <div class="flex flex-col gap-5">
        @if(count($tokens) === 0)
            <div
                class="mt-1 block w-full text-sm text-center bg-gray-100 px-4 py-2 border border-gray-300 rounded-md shadow-sm"
            >
                You don't have any api tokens yet
            </div>
        @endif
        @foreach($tokens as $token)
            <div>
                <div
                    class="mt-1 block w-full text-sm text-center {{ $token->expires_at?->isPast() ? 'bg-red-100' : 'bg-gray-100' }} px-4 py-2 border border-gray-300 rounded-md shadow-sm"
                >
                    {{ $token->token }}
                </div>
                <div class="flex justify-between gap-2">
                    <div>
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
                    <form method="post" action="{{ route('profile.tokens.destroy', $token) }}">
                        @csrf
                        @method('delete')
                        <button
                            type="submit"
                            class="underline text-sm text-red-600 hover:text-red-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                        >
                            Revoke
                        </button>
                    </form>
                </div>
            </div>
        @endforeach
    </div>

    <form method="post" action="{{ route('profile.tokens.create') }}" class="mt-6 space-y-6">
        @csrf

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Generate new token') }}</x-primary-button>

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
</section>
