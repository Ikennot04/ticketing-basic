<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @include('partials.head')
</head>

<body>
    <div class="min-h-screen flex items-center justify-center bg-[#FDFDFC]">
        <form class="bg-white p-8 rounded-lg shadow-md w-full max-w-sm border border-[#e3e3e0]">
            <h2 class="text-2xl font-semibold mb-6 text-center text-[#1b1b18]">Sign Up</h2>
            <div class="mb-4">
                <label class="block text-sm font-medium text-[#1b1b18] mb-1" for="name">Name</label>
                <input class="w-full px-3 py-2 border border-[#e3e3e0] rounded focus:outline-none focus:border-[#1b1b18]"
                    type="text" id="name" name="name" required>
            </div>
            <div class="mb-4">
                <label class="block text-sm font-medium text-[#1b1b18] mb-1" for="email">Email</label>
                <input class="w-full px-3 py-2 border border-[#e3e3e0] rounded focus:outline-none focus:border-[#1b1b18]"
                    type="email" id="email" name="email" required>
            </div>
            <div class="mb-6">
                <label class="block text-sm font-medium text-[#1b1b18] mb-1" for="password">Password</label>
                <input class="w-full px-3 py-2 border border-[#e3e3e0] rounded focus:outline-none focus:border-[#1b1b18]"
                    type="password" id="password" name="password" required>
            </div>
            <button type="submit"
                class="w-full bg-[#1b1b18] text-white py-2 rounded font-medium hover:bg-black transition-colors">Sign Up</button>
            <p class="mt-4 text-center text-sm text-[#706f6c]">
                Already have an account?
                <a href="{{ route('login') }}" class="text-[#1b1b18] underline hover:text-black">Login</a>
            </p>
        </form>
    </div>
</body>

</html>
