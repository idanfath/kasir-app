<header class="bg-gray-800 text-white ">
    <div class="  px-8 py-4 flex justify-between items-center">
        <div class="text-lg font-bold">
            <a href="/">Kasir App</a>
        </div>
        {{-- <div>
            <div>
                {{ Auth::check() ? Auth::user()->name : 'Guest' }}
            </div>
            <div>
                {{ Auth::check() ? Auth::user()->role : 'Guest' }}
            </div>
            <div>
                {{ Auth::check() ? 'Logout' : 'Login' }}
            </div>
        </div> --}}
        @if (Auth::check())
            <div class="flex items-center space-x-4">
                <span>{{ Auth::user()->name }}</span>
                <span class="text-gray-400">|</span>
                <span>{{ Auth::user()->role }}</span>
                <span class="text-gray-400">|</span>
                <form action="{{ route('logout') }}" method="post">
                    @csrf
                    <p type="submit" class="cursor-pointer underline text-red-500 hover:text-red-700"
                        onc`lick="
                        event.preventDefault();
                        this.closest('form').submit()">
                        Logout
                    </p>
                </form>
            </div>
        @else
            <div class="flex items-center space-x-4">
                <span>Guest</span>
                <span class="text-gray-400">|</span>
                <a href="{{ route('login') }}" class="underline text-blue-500 hover:text-blue-700">Login</a>
            </div>
        @endif
    </div>
</header>
