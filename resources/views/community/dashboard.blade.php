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

    <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/uicons-solid-rounded/css/uicons-solid-rounded.css'>

    <style>
        * {
            scroll-behavior: smooth;
            font-family: 'Poppins', sans-serif;
        }

        body {
            overflow-x: hidden;
        }

        /* GLASS */
        .glass {
            background: rgba(255, 255, 255, 0.35);
            backdrop-filter: blur(18px);
            -webkit-backdrop-filter: blur(18px);
            border: 1px solid rgba(255, 255, 255, 0.25);
        }

        /* SHADOW */
        .soft-shadow {
            box-shadow:
                0 12px 35px rgba(80, 78, 118, 0.10),
                0 5px 10px rgba(0, 0, 0, 0.03);
        }

        /* CARD HOVER */
        .smooth-card {
            transition: all .35s ease;
        }

        .smooth-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 25px 40px rgba(80, 78, 118, 0.16);
        }

        /* BUTTON */
        .btn-hover {
            transition: all .3s ease;
        }

        .btn-hover:hover {
            transform: scale(1.02);
        }

        /* FLOATING */
        .floating {
            animation: floating 4s ease-in-out infinite;
        }

        @keyframes floating {
            0% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(-8px);
            }

            100% {
                transform: translateY(0px);
            }
        }

        /* GRADIENT TEXT */
        .gradient-text {
            background: linear-gradient(135deg,
                    #504E76,
                    #6E6AB3,
                    #E8C067);

            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        /* STAT CARD */
        .stat-card {
            position: relative;
            overflow: hidden;
        }

        .stat-card::before {
            content: '';
            position: absolute;
            left: 0;
            top: 14%;
            height: 72%;
            width: 4px;
            border-radius: 0 4px 4px 0;
            background: #504E76;
        }

        /* FADE */
        .fade-up {
            animation: fadeUp .5s cubic-bezier(.22, .68, 0, 1.1) both;
        }

        @keyframes fadeUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* SCROLLBAR */
        ::-webkit-scrollbar {
            width: 6px;
        }

        ::-webkit-scrollbar-thumb {
            background: #504E76;
            border-radius: 50px;
        }

        ::-webkit-scrollbar-track {
            background: transparent;
        }
    </style>
</head>

<body class="bg-gradient-to-br from-[#FDF8E2] to-[#C4C3E3] h-screen overflow-hidden">

    <div class="flex h-screen">

        @include('community.sidebar')

        <!-- MAIN CONTENT -->
        <main
            id="mainContent"
            class="flex-1 overflow-y-auto px-4 sm:px-6 lg:px-8 py-6 lg:py-8 pt-16 lg:pt-8">

            <!-- TOPBAR -->
            <div class="flex flex-col lg:flex-row justify-between lg:items-center gap-4 mb-7 fade-up">

                <!-- TITLE -->
                <div>

                    <h1 class="text-2xl lg:text-4xl font-black gradient-text leading-tight">
                        Welcome Back, {{ Auth::user()->username }}!
                    </h1>

                    <p class="text-[#504E76]/65 mt-1 text-sm lg:text-base">
                        Help distribute food beautifully 🍱
                    </p>

                </div>

                <!-- PROFILE -->
                <div class="glass rounded-2xl px-4 py-3 flex items-center justify-between gap-3 soft-shadow smooth-card w-full lg:w-auto">

                    <div>

                        <h1 class="font-black text-[#504E76] text-base lg:text-lg">

                            {{ Auth::user()->username }}

                        </h1>

                        <p class="text-[#504E76]/60 text-xs lg:text-sm">

                            Community

                        </p>

                    </div>

                    <img
                        src="{{ Auth::user()->profile_photo
                ? asset(Auth::user()->profile_photo)
                : 'https://ui-avatars.com/api/?name=' . urlencode(Auth::user()->username) }}"

                        class="w-12 h-12 lg:w-14 lg:h-14 rounded-full border-4 border-white object-cover shadow-lg">

                </div>

            </div>

            <!-- STATISTICS -->
            <div class="grid grid-cols-2 xl:grid-cols-4 gap-3 lg:gap-4 mb-7">

                <!-- ACTIVE PICKUP -->
                <div class="stat-card glass soft-shadow smooth-card rounded-2xl px-4 lg:px-5 py-4">

                    <div class="flex items-start justify-between">

                        <div>

                            <p class="text-sm text-[#504E76]/60 font-medium">

                                Active Pickups

                            </p>

                            <h1 class="text-5xl font-black text-[#504E76] mt-3">

                                {{ $activePickups }}

                            </h1>

                        </div>

                        <!-- ICON -->
                        <div class="w-16 h-16 rounded-2xl bg-[#504E76] text-white flex items-center justify-center shadow-lg">

                            <i class="fi fi-sr-box-open-full text-2xl"></i>

                        </div>

                    </div>

                </div>

                <!-- MEALS DISTRIBUTED -->
                <div class="stat-card glass soft-shadow smooth-card rounded-2xl px-4 lg:px-5 py-4">

                    <div class="flex items-start justify-between">

                        <div>

                            <p class="text-sm text-[#504E76]/60 font-medium">

                                Meals Distributed

                            </p>

                            <h1 class="text-5xl font-black text-[#504E76] mt-3">

                                {{ $distributedMeals }}

                            </h1>

                        </div>

                        <!-- ICON -->
                        <div class="w-16 h-16 rounded-2xl bg-[#A3B565] text-white flex items-center justify-center shadow-lg">

                            <i class="fi fi-sr-utensils text-2xl"></i>

                        </div>

                    </div>

                </div>

                <!-- EMERGENCY -->
                <div class="stat-card glass soft-shadow smooth-card rounded-2xl px-4 lg:px-5 py-4">

                    <div class="flex items-start justify-between">

                        <div>

                            <p class="text-sm text-[#504E76]/60 font-medium">

                                Emergency Requests

                            </p>

                            <h1 class="text-5xl font-black text-[#504E76] mt-3">

                                {{ $emergencyRequests }}

                            </h1>

                        </div>

                        <!-- ICON -->
                        <div class="w-16 h-16 rounded-2xl bg-[#F1642E] text-white flex items-center justify-center shadow-lg">

                            <i class="fi fi-sr-triangle-warning text-2xl"></i>

                        </div>

                    </div>

                </div>

                <!-- CLAIM LIMIT -->
                <div class="stat-card glass soft-shadow smooth-card rounded-2xl px-4 lg:px-5 py-4">

                    <!-- TOP -->
                    <div class="flex items-start justify-between">

                        <div>

                            <p class="text-sm text-[#504E76]/60 font-medium">

                                Daily Claim Limit

                            </p>

                            <h1 class="text-4xl font-black text-[#504E76] mt-2">

                                {{ $remainingLimit }}

                                <span class="text-xl font-bold text-[#504E76]/50">
                                    / 30
                                </span>

                            </h1>

                        </div>

                        <!-- ICON -->
                        <div class="w-16 h-16 rounded-2xl bg-[#F1642E] text-white flex items-center justify-center shadow-lg">

                            <i class="fi fi-sr-chart-pie-alt text-2xl"></i>

                        </div>

                    </div>

                    <!-- TEXT -->
                    <p class="text-sm text-[#504E76]/60 mt-5 mb-3">

                        {{ $totalClaimed }} portions already claimed

                    </p>

                    <!-- PROGRESS -->
                    <div class="w-full h-3 bg-white/40 rounded-full mt-5 overflow-hidden">
                        @if($progress >= 100)

                        <div class="h-full w-full bg-[#F1642E] rounded-full"></div>

                        @elseif($progress >= 70)

                        <div class="h-full w-3/4 bg-[#F1642E] rounded-full"></div>

                        @elseif($progress >= 50)

                        <div class="h-full w-1/2 bg-[#F1642E] rounded-full"></div>

                        @elseif($progress >= 25)

                        <div class="h-full w-1/4 bg-[#F1642E] rounded-full"></div>

                        @else

                        <div class="h-full w-[10%] bg-[#F1642E] rounded-full"></div>

                        @endif

                    </div>

                </div>

            </div>

            <!-- SECTION -->
            <div class="grid grid-cols-1 xl:grid-cols-3 gap-5 mb-5">

                <!-- AVAILABLE DONATIONS -->
                <div class="xl:col-span-2 bg-white/30 backdrop-blur-2xl rounded-3xl p-5 lg:p-6 soft-shadow smooth-card fade-up shadow-xl">

                    <div class="flex items-center justify-between mb-5">

                        <h1 class="text-2xl font-black text-[#504E76]">
                            Available Donations
                        </h1>

                        <i class='bx bx-food-menu text-3xl text-[#504E76]'></i>

                    </div>

                    <div class="space-y-4">

                        <!-- CARD -->
                        @foreach($availableDonations as $donation)

                        <div class=" bg-white/40 rounded-2xl p-4

                        @if(
                            \Carbon\Carbon::parse($donation->expired_date)->isToday()
                        )
                        border-2 border-[#F1642E]/30
                        @endif
                        ">

                            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">

                                <div>

                                    <h1 class=" font-bold

                                    @if(
                                        \Carbon\Carbon::parse($donation->expired_date)->isToday()
                                    )
                                    text-[#F1642E]
                                    @else
                                    text-[#504E76]
                                    @endif
                                    ">

                                        {{ $donation->food_name }}

                                    </h1>

                                    <p class="text-sm text-[#504E76]/60 mt-1">

                                        {{ $donation->remaining_quantity }}
                                        portions •

                                        {{ $donation->pickup_location }}

                                    </p>

                                </div>

                                <a
                                    href="/available-donations"

                                    class="
                                    @if(
                                        \Carbon\Carbon::parse($donation->expired_date)->isToday()
                                    )
                                    bg-[#F1642E]
                                    hover:bg-[#504E76]
                                    @else
                                    bg-[#504E76]
                                    hover:bg-[#F1642E]
                                    @endif

                                    w-full sm:w-auto
text-center
transition-all duration-300
text-white px-4 py-3
rounded-xl text-sm font-semibold">

                                    Claim Pickup

                                </a>

                            </div>

                        </div>

                        @endforeach

                    </div>

                </div>

                <!-- QUICK ACTION -->
                <div class="glass rounded-3xl p-5 soft-shadow smooth-card fade-up">

                    <h1 class="text-2xl font-black text-[#504E76] mb-5">

                        Quick Actions

                    </h1>

                    <div class="space-y-4">

                        <!-- AVAILABLE DONATIONS -->
                        <a href="/community-dashboard"

                            class="bg-[#504E76] hover:bg-[#F1642E]
transition-all duration-300
text-white rounded-2xl
p-4 flex items-center gap-3
w-full">

                            <i class='bx bx-food-menu text-2xl'></i>

                            <span class="font-semibold">

                                Available Donations

                            </span>

                        </a>

                        <!-- DISTRIBUTION HISTORY -->
                        <a href="/distribution-history"

                            class="bg-white/40 hover:bg-white/60 transition-all duration-300 rounded-2xl p-4 flex items-center gap-3 text-[#504E76]">

                            <i class='bx bx-history text-2xl'></i>

                            <span class="font-semibold">

                                Distribution History

                            </span>

                        </a>

                    </div>

                </div>

            </div>

            <!-- ACTIVE DISTRIBUTION -->
            <div class="glass rounded-3xl p-5 lg:p-6 soft-shadow smooth-card fade-up mb-5">

                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 mb-6">

                    <h1 class="text-2xl font-black text-[#504E76]">
                        Active Distribution
                    </h1>

                    <i class='bx bx-trip text-3xl text-[#504E76]'></i>

                </div>

                @if($activeDistribution)

                <div class="bg-white/40 rounded-2xl p-5">

                    <p class="text-[#504E76]/70 text-sm mb-2">
                        Pickup From
                    </p>

                    <h1 class="text-xl font-bold text-[#504E76] mb-4">

                        {{ $activeDistribution->donation->supplier->nama_toko }}

                    </h1>

                    <p class="text-[#504E76]/70 text-sm mb-2">
                        Courier
                    </p>

                    <h1 class="text-xl font-bold text-[#504E76] mb-4">

                        {{ $activeDistribution->courier_name }}

                    </h1>

                    <div class=" inline-flex items-center gap-2 bg-blue-100 text-blue-700 px-4 py-2 rounded-xl font-semibold">

                        <i class='bx bx-car'></i>

                        On Delivery

                    </div>

                </div>

                @else

                <div class="bg-white/40 rounded-2xl p-5">

                    <p class="text-[#504E76]/70">

                        No active distribution

                    </p>

                </div>

                @endif

            </div>

        </main>

    </div>

</body>

</html>