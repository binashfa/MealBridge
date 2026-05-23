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

    <style>
        #sidebar::-webkit-scrollbar {
            width: 6px;
        }

        #sidebar::-webkit-scrollbar-thumb {
            background: #504E76;
            border-radius: 20px;
        }

        .nav-link,
        .settings-btn,
        .logout-btn,
        .menu-btn-interactive,
        .logo-interactive {
            cursor: pointer;
        }

        .nav-link:not(.active-link):hover {
            transform: translateX(5px);
            background: rgba(255, 255, 255, 0.40) !important;
            box-shadow: 0 8px 24px rgba(80, 78, 118, 0.10);
        }

        .nav-link:not(.active-link):hover .nav-icon {
            background: #504E76 !important;
            transform: scale(1.08) rotate(-6deg);
        }

        .nav-link:not(.active-link):hover .nav-icon i {
            color: white !important;
        }

        .active-link .nav-dot {
            background: rgba(255, 255, 255, 0.60) !important;
        }

        .logo-interactive:hover .mascot-img {
            transform: rotate(-8deg) scale(1.10);
        }

        .mascot-img {
            transition: all .4s ease;
        }

        .settings-btn:hover {
            transform: scale(1.05);
        }

        .settings-btn:hover .settings-icon {
            transform: rotate(90deg);
        }

        .logout-btn:hover {
            transform: scale(1.05);
        }
    </style>
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
           w-[260px] lg:w-[280px]
           h-screen
           overflow-y-auto
           bg-white/20 backdrop-blur-2xl
           border-r border-white/20
           p-6 lg:p-8
           flex flex-col
           transition-transform duration-500
           z-40">

            <!-- TOP -->
            <div>

                <!-- LOGO -->
                <div class="mb-10 lg:mb-16">

                    <div class="flex items-center logo-interactive cursor-pointer">

                        <img
                            src="{{ asset('images/mealbridge-mascot.png') }}"
                            alt="MealBridge"

                            class="w-[55px] lg:w-[70px] drop-shadow-xl mascot-img">

                        <div>

                            <h1 class="text-2xl font-black text-[#504E76]">

                                MealBridge

                            </h1>

                            <p class="text-[10px] tracking-[3px]
                              uppercase text-[#504E76]/70 mt-1">

                                Community Panel

                            </p>

                        </div>

                    </div>

                </div>

                <!-- MENU -->
                <nav class="space-y-2 lg:space-y-4">

                    <!-- DASHBOARD -->
                    <a href="/dashboard-community"
                        class="nav-link flex items-center gap-3 lg:gap-4
                      {{ request()->is('dashboard-community') ? 'bg-[#504E76] text-white shadow-lg active-link' : 'hover:bg-white/30 text-[#504E76]' }}
                      transition-all duration-300
                      p-3 lg:p-4 rounded-2xl group">

                        <div class="nav-icon w-10 h-10 lg:w-12 lg:h-12 rounded-2xl
                            {{ request()->is('dashboard-community') ? 'bg-white/20' : 'bg-[#FDF8E2]' }}
                            flex items-center justify-center shrink-0 transition-all duration-300">

                            <i class='bx bx-home-alt-2 text-xl lg:text-2xl'></i>

                        </div>

                        <div>

                            <h1 class="font-semibold text-sm lg:text-base">

                                Dashboard

                            </h1>

                            <p class="text-xs
                              {{ request()->is('dashboard-community') ? 'text-white/70' : 'text-[#504E76]/60' }}">

                                Community overview

                            </p>

                        </div>

                        <div class="nav-dot ml-auto w-2 h-2 rounded-full"></div>

                    </a>

                    <!-- DONATIONS -->
                    <a href="/available-donations"
                        class="nav-link flex items-center gap-3 lg:gap-4
                      {{ request()->is('available-donations') ? 'bg-[#504E76] text-white shadow-lg active-link' : 'hover:bg-white/30 text-[#504E76]' }}
                      transition-all duration-300
                      p-3 lg:p-4 rounded-2xl group">

                        <div class="nav-icon w-10 h-10 lg:w-12 lg:h-12 rounded-2xl
                            {{ request()->is('available-donations') ? 'bg-white/20' : 'bg-[#FDF8E2]' }}
                            flex items-center justify-center shrink-0 transition-all duration-300">

                            <i class='bx bx-food-menu text-xl lg:text-2xl'></i>

                        </div>

                        <div>

                            <h1 class="font-semibold text-sm lg:text-base">

                                Donations

                            </h1>

                            <p class="text-xs
                              {{ request()->is('available-donations') ? 'text-white/70' : 'text-[#504E76]/60' }}">

                                Food donations

                            </p>

                        </div>

                        <div class="nav-dot ml-auto w-2 h-2 rounded-full"></div>

                    </a>

                    <!-- HISTORY -->
                    <a href="/distribution-history"
                        class="nav-link flex items-center gap-3 lg:gap-4
                      {{ request()->is('distribution-history') ? 'bg-[#504E76] text-white shadow-lg active-link' : 'hover:bg-white/30 text-[#504E76]' }}
                      transition-all duration-300
                      p-3 lg:p-4 rounded-2xl group">

                        <div class="nav-icon w-10 h-10 lg:w-12 lg:h-12 rounded-2xl
                            {{ request()->is('distribution-history') ? 'bg-white/20' : 'bg-[#FDF8E2]' }}
                            flex items-center justify-center shrink-0 transition-all duration-300">

                            <i class='bx bx-history text-xl lg:text-2xl'></i>

                        </div>

                        <div>

                            <h1 class="font-semibold text-sm lg:text-base">

                                History

                            </h1>

                            <p class="text-xs
                              {{ request()->is('distribution-history') ? 'text-white/70' : 'text-[#504E76]/60' }}">

                                Distribution activity

                            </p>

                        </div>

                        <div class="nav-dot ml-auto w-2 h-2 rounded-full"></div>

                    </a>

                    <!-- NOTIFICATIONS -->
                    <a href="/community-notifications"
                        class="nav-link flex items-center gap-3 lg:gap-4
                      {{ request()->is('community-notifications') ? 'bg-[#504E76] text-white shadow-lg active-link' : 'hover:bg-white/30 text-[#504E76]' }}
                      transition-all duration-300
                      p-3 lg:p-4 rounded-2xl group">

                        <div class="nav-icon w-10 h-10 lg:w-12 lg:h-12 rounded-2xl
                            {{ request()->is('community-notifications') ? 'bg-white/20' : 'bg-[#FDF8E2]' }}
                            flex items-center justify-center shrink-0 transition-all duration-300">

                            <i class='bx bx-bell text-xl lg:text-2xl'></i>

                        </div>

                        <div>

                            <h1 class="font-semibold text-sm lg:text-base">

                                Notifications

                            </h1>

                            <p class="text-xs
                              {{ request()->is('community-notifications') ? 'text-white/70' : 'text-[#504E76]/60' }}">

                                Alerts & updates

                            </p>

                        </div>

                        <div class="nav-dot ml-auto w-2 h-2 rounded-full"></div>

                    </a>

                </nav>

            </div>

            <!-- BOTTOM -->
            <div class="mt-auto pt-8 pb-2">

                <div class="grid grid-cols-2 gap-4">

                    <!-- SETTINGS -->
                    <a href="/community-settings"
                        class="settings-btn
                      h-[72px]
                      rounded-3xl
                      bg-white/50
                      hover:bg-white/70
                      flex items-center justify-center
                      text-[#504E76]
                      shadow-xl
                      transition-all duration-300">

                        <i class='bx bx-cog text-3xl settings-icon'></i>

                    </a>

                    <!-- LOGOUT -->
                    <form action="/logout" method="POST">

                        @csrf

                        <button
                            type="submit"
                            class="logout-btn
                           w-full h-[72px]
                           rounded-3xl
                           bg-[#F1642E]
                           hover:bg-[#504E76]
                           text-white
                           shadow-xl
                           flex items-center justify-center
                           transition-all duration-300">

                            <i class='bx bx-log-out text-3xl logout-icon'></i>

                        </button>

                    </form>

                </div>

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