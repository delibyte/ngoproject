<x-layout>
    <div class="max-w-4xl mx-auto">
        <header class="text-center mb-12">
            <h1 class="text-4xl font-bold mb-4">Support a Cause</h1>
            <p class="text-lg text-gray-700">Make a difference today.</p>
        </header>

        <section class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <div class="bg-white p-8 rounded-xl shadow-md">
                <h2 class="text-2xl font-bold mb-4">Donate Now</h2>
                    <div class="mb-4">
                        <label for="amount" class="block text-sm font-semibold mb-2">Amount</label>
                        <input type="text" id="amount" name="amount" placeholder="Enter amount"
                            class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-blue-500">
                    </div>
                    <div class="mb-4">
                        <label for="name" class="block text-sm font-semibold mb-2">Name</label>
                        <input type="text" id="name" name="name" placeholder="Enter your name"
                            class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-blue-500">
                    </div>
                    <div class="mb-4">
                        <label for="email" class="block text-sm font-semibold mb-2">Email</label>
                        <input type="email" id="email" name="email" placeholder="Enter your email"
                            class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-blue-500">
                    </div>
                    <a href="/register">
                        <button class="w-full bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded-md transition duration-300">Donate</button>
                    </a>
            </div>
            <div class="bg-white p-8 rounded-xl shadow-md">
                <h2 class="text-2xl font-bold mb-4">Why Donate?</h2>
                <p class="text-gray-700">Your donations help us continue our mission to make the world a better place.</p>
                <ul class="mt-4">
                    <li class="flex items-center mb-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-blue-500" viewBox="0 0 20 20"
                            fill="currentColor">
                            <path
                                d="M10 18a8 8 0 1 1 0-16 8 8 0 0 1 0 16zm1-14a1 1 0 0 1 2 0v6a1 1 0 0 1-2 0V4zm0 10a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
                        </svg>
                        <span class="text-gray-700">Transparent donations</span>
                    </li>
                    <li class="flex items-center mb-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-blue-500" viewBox="0 0 20 20"
                            fill="currentColor">
                            <path d="M10 18a8 8 0 1 1 0-16 8 8 0 0 1 0 16zm-1-3a1 1 0 1 1 2 0v-1a1 1 0 1 1-2 0v1zm1-5a1 1 0 0 1 2 0v1a1 1 0 0 1-2 0v-1zm1-3a1 1 0 0 1 0-2h-1a1 1 0 0 1 0 2h1z"
                                clip-rule="evenodd" />
                        </svg>
                        <span class="text-gray-700">Secure payments</span>
                    </li>
                    <li class="flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-blue-500" viewBox="0 0 20 20"
                            fill="currentColor">
                            <path d="M10 18a8 8 0 1 1 0-16 8 8 0 0 1 0 16zm-1-3a1 1 0 1 1 2 0v-1a1 1 0 1 1-2 0v1zm1-5a1 1 0 0 1 2 0v1a1 1 0 0 1-2 0v-1zm1-3a1 1 0 0 1 0-2h-1a1 1 0 0 1 0 2h1z"
                                clip-rule="evenodd" />
                        </svg>
                        <span class="text-gray-700">Impactful causes</span>
                    </li>
                </ul>
            </div>
        </section>
    </div>
</x-layout>
