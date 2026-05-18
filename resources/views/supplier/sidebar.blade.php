<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>
        MealBridge Supplier
    </title>

    <script src="https://cdn.tailwindcss.com"></script>

    <!-- BOXICONS -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>

<body class="bg-gradient-to-br from-[#FDF8E2] to-[#C4C3E3] min-h-screen overflow-hidden">

    <div class="flex h-screen relative">

        <!-- MENU BUTTON MOBILE -->
        <button
            id="menuBtn"
            class="lg:hidden fixed top-6 left-6 z-50
    w-14 h-14 rounded-2xl
    bg-[#504E76] text-white shadow-2xl
    flex items-center justify-center">

            <i class='bx bx-menu text-3xl'></i>

        </button>

        <!-- OVERLAY -->
        <div
            id="overlay"
            class="hidden fixed inset-0 bg-black/30 backdrop-blur-sm z-30 lg:hidden"></div>

        <!-- SIDEBAR -->
        <aside
            id="sidebar"

            class="fixed lg:relative

    -translate-x-full lg:translate-x-0

    top-0 left-0

    w-[280px]
    h-screen

    bg-white/20
    backdrop-blur-2xl

    border-r border-white/20

    p-8

    flex flex-col justify-between

    transition-transform duration-500

    z-40">

            <div>

                <!-- LOGO -->
                <div class="mb-16">

                    <div class="flex items-center">

                        <img
                            src="{{ asset('images/mealbridge-mascot.png') }}"
                            alt="MealBridge"
                            class="w-[70px] drop-shadow-xl">

                        <div>

                            <h1 class="text-3xl font-black text-[#504E76]">
                                MealBridge
                            </h1>

                            <p class="text-xs tracking-[4px] uppercase text-[#504E76]/70 mt-1">
                                Supplier Panel
                            </p>

                        </div>

                    </div>

                </div>

                <!-- MENU -->
                <nav class="space-y-4">

                    <!-- HOME -->
                    <a href="/dashboard-supplier"
                        class="flex items-center gap-4
    {{ request()->is('dashboard-supplier') ? 'bg-[#504E76] text-white shadow-lg' : 'hover:bg-white/30 text-[#504E76]' }}
    transition-all duration-300
    p-4 rounded-2xl">

                        <div class="w-12 h-12 rounded-2xl
    {{ request()->is('dashboard-supplier') ? 'bg-white/20' : 'bg-[#FDF8E2]' }}
    flex items-center justify-center
shrink-0">

                            <i class='bx bx-home-alt-2 text-2xl'></i>

                        </div>

                        <div>

                            <h1 class="font-semibold">
                                Home
                            </h1>

                            <p class="text-sm
        {{ request()->is('dashboard-supplier') ? 'text-white/70' : 'text-[#504E76]/60' }}">

                                Dashboard overview

                            </p>

                        </div>

                    </a>

                    <!-- DONATE -->
                    <a href="/donate"
                        class="flex items-center gap-4
    {{ request()->is('donate') ? 'bg-[#504E76] text-white shadow-lg' : 'hover:bg-white/30 text-[#504E76]' }}
    transition-all duration-300
    p-4 rounded-2xl">

                        <div class="w-12 h-12 rounded-2xl
    {{ request()->is('donate') ? 'bg-white/20' : 'bg-[#FDF8E2]' }}
    flex items-center justify-center
shrink-0">

                            <i class='bx bx-donate-heart text-2xl'></i>

                        </div>

                        <div>

                            <h1 class="font-semibold">
                                Donate
                            </h1>

                            <p class="text-sm
        {{ request()->is('donate') ? 'text-white/70' : 'text-[#504E76]/60' }}">

                                Share your food donation

                            </p>

                        </div>

                    </a>

                    <!-- HISTORY -->
                    <a href="/history"
                        class="flex items-center gap-4
    {{ request()->is('history') ? 'bg-[#504E76] text-white shadow-lg' : 'hover:bg-white/30 text-[#504E76]' }}
    transition-all duration-300
    p-4 rounded-2xl">

                        <div class="w-12 h-12 rounded-2xl
    {{ request()->is('history') ? 'bg-white/20' : 'bg-[#FDF8E2]' }}
    flex items-center justify-center
shrink-0">

                            <i class='bx bx-history text-2xl'></i>

                        </div>

                        <div>

                            <h1 class="font-semibold">
                                History
                            </h1>

                            <p class="text-sm
        {{ request()->is('history') ? 'text-white/70' : 'text-[#504E76]/60' }}">

                                Donation activity

                            </p>

                        </div>

                    </a>

                    <!-- NOTIFICATION -->
                    <a href="/notifications"
                        class="flex items-center gap-4
    {{ request()->is('notifications') ? 'bg-[#504E76] text-white shadow-lg' : 'hover:bg-white/30 text-[#504E76]' }}
    transition-all duration-300
    p-4 rounded-2xl">

                        <div class="w-12 h-12 rounded-2xl
    {{ request()->is('notifications') ? 'bg-white/20' : 'bg-[#FDF8E2]' }}
    flex items-center justify-center
shrink-0">

                            <i class='bx bx-bell text-2xl'></i>

                        </div>

                        <div>

                            <h1 class="font-semibold">
                                Notifications
                            </h1>

                            <p class="text-sm
        {{ request()->is('notifications') ? 'text-white/70' : 'text-[#504E76]/60' }}">

                                Donation updates & alerts

                            </p>

                        </div>

                    </a>

                </nav>

            </div>

            <!-- BOTTOM MENU -->
            <div class="grid grid-cols-2 gap-2">

                <!-- SETTINGS -->
                <a href="/settings"
                    class="bg-white/30 hover:bg-white/50
        transition-all duration-300
        text-[#504E76]
        p-4 rounded-2xl
        flex items-center justify-center gap-2
        font-semibold shadow-lg">

                    <i class='bx bx-cog text-xl'></i>

                </a>

                <!-- LOGOUT -->
                <form action="/logout" method="POST">

                    @csrf

                    <button
                        class="w-full bg-[#F1642E]
            hover:bg-[#504E76]
            transition-all duration-300
            text-white p-4 rounded-2xl
            font-semibold flex items-center justify-center gap-2 shadow-xl">

                        <i class='bx bx-log-out text-xl'></i>

                    </button>

                </form>

            </div>

        </aside>

    </div>

    <!-- SCRIPT -->
    <script>
        const menuBtn = document.getElementById('menuBtn')

        const sidebar = document.getElementById('sidebar')

        const overlay = document.getElementById('overlay')

        menuBtn.addEventListener('click', () => {

            sidebar.classList.toggle('-translate-x-full')

            overlay.classList.toggle('hidden')

        })

        overlay.addEventListener('click', () => {

            sidebar.classList.add('-translate-x-full')

            overlay.classList.add('hidden')

        })
    </script>

</body>

</html>