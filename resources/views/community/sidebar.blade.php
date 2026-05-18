<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>
        MealBridge Community
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
        <!-- SIDEBAR -->
        <aside
    id="sidebar"

    class="fixed lg:relative

    -translate-x-full lg:translate-x-0

    top-0 left-0

    w-[260px]
    h-screen

    bg-white/20
    backdrop-blur-2xl

    border-r border-white/20

    px-5 py-6

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

                            <h1 class="text-2xl font-black text-[#504E76]">
                                MealBridge
                            </h1>

                            <p class="text-[10px] tracking-[1px] uppercase text-[#504E76]/70">
                                Community Panel
                            </p>

                        </div>

                    </div>

                </div>

        <!-- MENU -->
        <nav class="space-y-3">

            <!-- ITEM -->
            <a href="/dashboard-community"
                class="flex items-center gap-4

                {{ request()->is('dashboard-community')
                ? 'bg-[#504E76] text-white shadow-xl'
                : 'hover:bg-white/30 text-[#504E76]' }}

                transition-all duration-300
                p-4 rounded-[24px]">

                <div class="w-11 h-11 rounded-2xl

                {{ request()->is('dashboard-community')
                ? 'bg-white/20'
                : 'bg-[#FDF8E2]' }}

                flex items-center justify-center shrink-0">

                    <i class='bx bx-home-alt-2 text-[24px] leading-none'></i>

                </div>

                <div>

                    <h1 class="font-semibold text-[16px] leading-none">
                        Dashboard
                    </h1>

                    <p class="text-xs mt-1

                    {{ request()->is('dashboard-community')
                    ? 'text-white/70'
                    : 'text-[#504E76]/60' }}">

                        Community overview

                    </p>

                </div>

            </a>

            <!-- DONATIONS -->
            <a href="/available-donations"
                class="flex items-center gap-4

                {{ request()->is('available-donations')
                ? 'bg-[#504E76] text-white shadow-xl'
                : 'hover:bg-white/30 text-[#504E76]' }}

                transition-all duration-300
                p-4 rounded-[24px]">

                <div class="w-11 h-11 rounded-2xl

                {{ request()->is('available-donations')
                ? 'bg-white/20'
                : 'bg-[#FDF8E2]' }}

                flex items-center justify-center shrink-0">

                    <i class='bx bx-food-menu text-[24px]'></i>

                </div>

                <div>

                    <h1 class="font-semibold text-[16px] leading-none">
                        Donations
                    </h1>

                    <p class="text-xs mt-1

                    {{ request()->is('available-donations')
                    ? 'text-white/70'
                    : 'text-[#504E76]/60' }}">

                        Food donations

                    </p>

                </div>

            </a>

            <!-- HISTORY -->
            <a href="/distribution-history"
                class="flex items-center gap-4

                {{ request()->is('distribution-history')
                ? 'bg-[#504E76] text-white shadow-xl'
                : 'hover:bg-white/30 text-[#504E76]' }}

                transition-all duration-300
                p-4 rounded-[24px]">

                <div class="w-11 h-11 rounded-2xl

                {{ request()->is('distribution-history')
                ? 'bg-white/20'
                : 'bg-[#FDF8E2]' }}

                flex items-center justify-center shrink-0">

                    <i class='bx bx-history text-[24px]'></i>

                </div>

                <div>

                    <h1 class="font-semibold text-[16px] leading-none">
                        History
                    </h1>

                    <p class="text-xs mt-1

                    {{ request()->is('distribution-history')
                    ? 'text-white/70'
                    : 'text-[#504E76]/60' }}">

                        Distribution records

                    </p>

                </div>

            </a>

            <!-- NOTIFICATIONS -->
            <a href="/community-notifications"
                class="flex items-center gap-4

                {{ request()->is('community-notifications')
                ? 'bg-[#504E76] text-white shadow-xl'
                : 'hover:bg-white/30 text-[#504E76]' }}

                transition-all duration-300
                p-4 rounded-[24px]">

                <div class="w-11 h-11 rounded-2xl

                {{ request()->is('community-notifications')
                ? 'bg-white/20'
                : 'bg-[#FDF8E2]' }}

                flex items-center justify-center shrink-0">

                    <i class='bx bx-bell text-[24px]'></i>

                </div>

                <div>

                    <h1 class="font-semibold text-[16px] leading-none">
                        Notifications
                    </h1>

                    <p class="text-xs mt-1

                    {{ request()->is('community-notifications')
                    ? 'text-white/70'
                    : 'text-[#504E76]/60' }}">

                        Alerts & updates

                    </p>

                </div>

            </a>

        </nav>

    </div>

    <!-- BOTTOM -->
    <div class="grid grid-cols-2 gap-3">

        <a href="/community-settings"
            class="bg-white/30 hover:bg-white/50
            transition-all duration-300
            text-[#504E76]
            p-4 rounded-2xl
            flex items-center justify-center
            shadow-lg">

            <i class='bx bx-cog text-2xl'></i>

        </a>

        <form action="/logout" method="POST">

            @csrf

            <button
                class="w-full bg-[#F1642E]
                hover:bg-[#504E76]
                transition-all duration-300
                text-white p-4 rounded-2xl
                flex items-center justify-center
                shadow-xl">

                <i class='bx bx-log-out text-2xl'></i>

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