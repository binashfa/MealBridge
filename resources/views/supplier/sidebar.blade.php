<!-- MENU BUTTON MOBILE -->
<button
    id="menuBtn"
    class="lg:hidden fixed top-5 left-5 z-50
           w-12 h-12 rounded-2xl
           bg-[#504E76] text-white shadow-2xl
           flex items-center justify-center
           menu-btn-interactive">
    <i class='bx bx-menu text-2xl'></i>
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
                    id="mascot-img"
                    class="w-[55px] lg:w-[70px] drop-shadow-xl mascot-img">

                <div>
                    <h1 class="text-2xl lg:text-2xl font-black text-[#504E76] logo-text">
                        MealBridge
                    </h1>

                    <p class="text-[10px] tracking-[3px] lg:tracking-[4px]
                              uppercase text-[#504E76]/70 mt-1">
                        Supplier Panel
                    </p>
                </div>
            </div>
        </div>

        <!-- MENU -->
        <nav class="space-y-2 lg:space-y-4">

            <!-- HOME -->
            <a href="/dashboard-supplier"
               class="nav-link flex items-center gap-3 lg:gap-4
                      {{ request()->is('dashboard-supplier') ? 'bg-[#504E76] text-white shadow-lg active-link' : 'hover:bg-white/30 text-[#504E76]' }}
                      transition-all duration-300
                      p-3 lg:p-4 rounded-2xl group">

                <div class="nav-icon w-10 h-10 lg:w-12 lg:h-12 rounded-2xl
                            {{ request()->is('dashboard-supplier') ? 'bg-white/20' : 'bg-[#FDF8E2]' }}
                            flex items-center justify-center shrink-0 transition-all duration-300">

                    <i class='bx bx-home-alt-2 text-xl lg:text-2xl'></i>
                </div>

                <div class="nav-text">
                    <h1 class="font-semibold text-sm lg:text-base">Home</h1>

                    <p class="text-xs
                              {{ request()->is('dashboard-supplier') ? 'text-white/70' : 'text-[#504E76]/60' }}">
                        Dashboard overview
                    </p>
                </div>

                <div class="nav-dot ml-auto w-2 h-2 rounded-full"></div>
            </a>

            <!-- DONATE -->
            <a href="/donate"
               class="nav-link flex items-center gap-3 lg:gap-4
                      {{ request()->is('donate') ? 'bg-[#504E76] text-white shadow-lg active-link' : 'hover:bg-white/30 text-[#504E76]' }}
                      transition-all duration-300
                      p-3 lg:p-4 rounded-2xl group">

                <div class="nav-icon w-10 h-10 lg:w-12 lg:h-12 rounded-2xl
                            {{ request()->is('donate') ? 'bg-white/20' : 'bg-[#FDF8E2]' }}
                            flex items-center justify-center shrink-0 transition-all duration-300">

                    <i class='bx bx-donate-heart text-xl lg:text-2xl'></i>
                </div>

                <div class="nav-text">
                    <h1 class="font-semibold text-sm lg:text-base">Donate</h1>

                    <p class="text-xs
                              {{ request()->is('donate') ? 'text-white/70' : 'text-[#504E76]/60' }}">
                        Share your food donation
                    </p>
                </div>

                <div class="nav-dot ml-auto w-2 h-2 rounded-full"></div>
            </a>

            <!-- HISTORY -->
            <a href="/history"
               class="nav-link flex items-center gap-3 lg:gap-4
                      {{ request()->is('history') ? 'bg-[#504E76] text-white shadow-lg active-link' : 'hover:bg-white/30 text-[#504E76]' }}
                      transition-all duration-300
                      p-3 lg:p-4 rounded-2xl group">

                <div class="nav-icon w-10 h-10 lg:w-12 lg:h-12 rounded-2xl
                            {{ request()->is('history') ? 'bg-white/20' : 'bg-[#FDF8E2]' }}
                            flex items-center justify-center shrink-0 transition-all duration-300">

                    <i class='bx bx-history text-xl lg:text-2xl'></i>
                </div>

                <div class="nav-text">
                    <h1 class="font-semibold text-sm lg:text-base">History</h1>

                    <p class="text-xs
                              {{ request()->is('history') ? 'text-white/70' : 'text-[#504E76]/60' }}">
                        Donation activity
                    </p>
                </div>

                <div class="nav-dot ml-auto w-2 h-2 rounded-full"></div>
            </a>

            <!-- NOTIFICATIONS -->
            <a href="/notifications"
               class="nav-link flex items-center gap-3 lg:gap-4
                      {{ request()->is('notifications') ? 'bg-[#504E76] text-white shadow-lg active-link' : 'hover:bg-white/30 text-[#504E76]' }}
                      transition-all duration-300
                      p-3 lg:p-4 rounded-2xl group">

                <div class="nav-icon w-10 h-10 lg:w-12 lg:h-12 rounded-2xl
                            {{ request()->is('notifications') ? 'bg-white/20' : 'bg-[#FDF8E2]' }}
                            flex items-center justify-center shrink-0 transition-all duration-300">

                    <i class='bx bx-bell text-xl lg:text-2xl'></i>
                </div>

                <div class="nav-text">
                    <h1 class="font-semibold text-sm lg:text-base">Notifications</h1>

                    <p class="text-xs
                              {{ request()->is('notifications') ? 'text-white/70' : 'text-[#504E76]/60' }}">
                        Donation updates & alerts
                    </p>
                </div>

                <div class="nav-dot ml-auto w-2 h-2 rounded-full"></div>
            </a>

        </nav>
    </div>

    <!-- BOTTOM BUTTON -->
    <div class="mt-auto pt-8 pb-2">

        <div class="grid grid-cols-2 gap-4">

            <!-- SETTINGS -->
            <a href="/settings"
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

<style>

    #sidebar::-webkit-scrollbar{
        width:6px;
    }

    #sidebar::-webkit-scrollbar-thumb{
        background:#504E76;
        border-radius:20px;
    }

    .nav-link,
    .settings-btn,
    .logout-btn,
    .menu-btn-interactive,
    .logo-interactive{
        cursor:pointer;
    }

    .nav-link:not(.active-link):hover{
        transform:translateX(5px);
        background:rgba(255,255,255,0.40)!important;
        box-shadow:0 8px 24px rgba(80,78,118,0.10);
    }

    .nav-link:not(.active-link):hover .nav-icon{
        background:#504E76!important;
        transform:scale(1.08) rotate(-6deg);
    }

    .nav-link:not(.active-link):hover .nav-icon i{
        color:white!important;
    }

    .active-link .nav-dot{
        background:rgba(255,255,255,0.60)!important;
    }

    .logo-interactive:hover .mascot-img{
        transform:rotate(-8deg) scale(1.10);
    }

    .mascot-img{
        transition:all .4s ease;
    }

    .settings-btn:hover{
        transform:scale(1.05);
    }

    .settings-btn:hover .settings-icon{
        transform:rotate(90deg);
    }

    .logout-btn:hover{
        transform:scale(1.05);
    }

</style>

<script>

    const menuBtn = document.getElementById('menuBtn');
    const sidebar = document.getElementById('sidebar');
    const overlay = document.getElementById('overlay');

    menuBtn.addEventListener('click', () => {
        sidebar.classList.toggle('-translate-x-full');
        overlay.classList.toggle('hidden');
    });

    overlay.addEventListener('click', () => {
        sidebar.classList.add('-translate-x-full');
        overlay.classList.add('hidden');
    });

</script>