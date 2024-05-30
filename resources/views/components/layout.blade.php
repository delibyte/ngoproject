<!doctype html>

<title>NGO</title>
<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700&display=swap" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://cdn.tailwindcss.com"></script>

<style>
    html {
        scroll-behavior: smooth;
    }

    .clamp {
        display: -webkit-box;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .clamp.one-line {
        -webkit-line-clamp: 1;
    }
</style>

<body style="font-family: Open Sans, sans-serif">
    <section class="px-6 py-6">
        <nav class="md:flex md:justify-between md:items-center">
            <div>
                <a href="/">
                    <!--<img src="/images/logo.svg" alt="NGO Logo" width="165" height="16">-->

                    <svg width="200" height="30" xmlns="http://www.w3.org/2000/svg">
                        <text x="3" y="20" font-family="Arial" font-size="20" fill="black">{{ config('app.name') }}</text>
                    </svg>
                </a>
            </div>

            <div class="mt-8 md:mt-0 mr-2 flex items-center">
                @auth
                <div class="dropdown relative">
                    <button class="dropbtn text-xs font-bold uppercase">
                        Welcome, {{ auth()->user()->name }}!
                    </button>
                    <div class="dropdown-content hidden absolute bg-gray-100 mt-2 rounded-xl w-full z-50 overflow-auto max-h-52">
                        <a href="/profile" class="block py-2 px-4 hover:bg-gray-200">Profile</a>
                        <a href="/gateway" class="block py-2 px-4 hover:bg-gray-200">Dashboard</a>
                        <a href="#" id="logout" class="block py-2 px-4 hover:bg-gray-200">Log Out</a>
                        <form id="logout-form" method="POST" action="/logout" class="hidden">
                            @csrf
                        </form>
                    </div>
                </div>
                @else
                    <a href="/register"
                       class="text-xs font-bold uppercase {{ request()->is('register') ? 'text-blue-500' : '' }}">
                        Register
                    </a>

                    <a href="/login"
                       class="ml-6 text-xs font-bold uppercase {{ request()->is('login') ? 'text-blue-500' : '' }}">
                        Log In
                    </a>
                @endauth

            </div>
        </nav>

        {{ $slot }}

        <footer id="newsletter"
                class="bg-gray-100 border border-black border-opacity-5 rounded-xl text-center py-16 px-10 mt-16"
        >
            <img src="/images/lary-newsletter-icon.svg" alt="" class="mx-auto -mb-6" style="width: 145px;">

            <h5 class="text-3xl">Stay in touch with NGO</h5>
            <p class="text-sm mt-3">We promise to keep your inbox clean and only send what is necessary.</p>

            <div class="mt-10">
                <div class="relative inline-block mx-auto lg:bg-gray-200 rounded-full">

                    <form method="POST" action="/newsletter" class="lg:flex text-sm">
                        @csrf

                        <div class="lg:py-3 lg:px-5 flex items-center">
                            <label for="email" class="hidden lg:inline-block">
                                <img src="/images/mailbox-icon.svg" alt="mailbox letter">
                            </label>

                            <div>
                                <input id="email"
                                       name="email"
                                       type="text"
                                       placeholder="Your email address"
                                       class="lg:bg-transparent py-2 lg:py-0 pl-4 focus-within:outline-none">

                                @error('email')
                                    <span class="text-xs text-red-500">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <button type="submit"
                                class="transition-colors duration-300 bg-blue-500 hover:bg-blue-600 mt-4 lg:mt-0 lg:ml-3 rounded-full text-xs font-semibold text-white uppercase py-3 px-8"
                        >
                            Subscribe
                        </button>
                    </form>
                </div>
            </div>
        </footer>
    </section>

    <x-flash/>

    <script>
        $(document).ready(function(){
            $(".dropdown").click(function(){
                $(".dropdown-content").toggleClass("hidden");
                event.stopPropagation();
            });

            $("#logout").click(function(){
                $("#logout-form").submit();
                event.stopPropagation();
            });

            $(document).click(function(event) {
                if (!$(event.target).closest('.dropdown').length) {
                    $(".dropdown-content").addClass("hidden");
                }
            });

            // Stupid chromium pagination darkmode problem fix
            $("[class*='dark:']").removeClass(function(index, className) {
                return (className.match(/(^|\s)dark:\S+/g) || []).join(" ");
            });
        });
    </script>

</body>
