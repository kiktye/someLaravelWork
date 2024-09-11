<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Brainster Forum</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Hanken+Grotesk:wght@400;500;600&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/f5fd16f46e.js" crossorigin="anonymous"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-shadowed text-gna font-hanken-grotesk pb-10">


    <div class="px-10">
        <nav class="flex justify-between items-center py-4 border-b border-black/10">
            <div>
                <a href="/" class="font-bold text-xl">
                    Brainster Forum
                </a>
            </div>


            @auth
                <div class="space-x-6 font-bold flex">
                    <span>Welcome, {{ Auth::user()->username }}</span>

                    <form action="/logout" method="POST">
                        @csrf
                        @method('DELETE')
                        <button>Log Out</button>
                    </form>
                </div>
            @endauth

            @guest
                <div class="space-x-6 font-bold">
                    <a href="/register">Sign Up</a>
                    <a href="/login">Log In</a>
                </div>
            @endguest

        </nav>

        <main class="mt-10 max-w-[986px] m-auto">
            {{ $slot }}
        </main>
    </div>

</body>

</html>
