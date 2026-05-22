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
</head>

<body class="bg-gradient-to-br from-[#FDF8E2] to-[#C4C3E3] min-h-screen overflow-hidden">

    <div class="flex h-screen">

        @include('community.sidebar')

        <!-- MAIN CONTENT -->
        <main
            id="mainContent"
            class="flex-1 overflow-y-auto px-8 py-8">

            <!-- TOPBAR -->
            <div class="flex items-center justify-between mb-6">

                <div>

                    <h1 class="text-4xl font-black text-[#504E76] mb-1">
                        Welcome Back 👋
                    </h1>

                    <p class="text-[#504E76]/70">
                        Help distribute food to communities in need.
                    </p>

                </div>

                <!-- PROFILE -->
                <div class="bg-white/30 backdrop-blur-2xl rounded-2xl px-5 py-3 flex items-center gap-4 shadow-xl">

                    <div>

                        <h1 class="font-bold text-[#504E76]">
                            {{ Auth::user()->username }}
                        </h1>

                        <p class="text-sm text-[#504E76]/70">
                            Community
                        </p>

                    </div>

                    <img
                        src="{{ Auth::user()->profile_photo
                        ? asset(Auth::user()->profile_photo)
                        : 'https://ui-avatars.com/api/?name=' . urlencode(Auth::user()->username) }}"

                        onerror="this.src='https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->username) }}'"

                        class="w-12 h-12 rounded-full object-cover border-2 border-white shadow-lg">

                </div>

            </div>

            <!-- STATISTICS -->
            <div class="grid grid-cols-4 gap-5 mb-8">

                <!-- ACTIVE PICKUP -->
                <div class="bg-white/30 backdrop-blur-2xl rounded-[30px] p-6 shadow-xl border border-white/20">

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
                <div class="bg-white/30 backdrop-blur-2xl rounded-[30px] p-6 shadow-xl border border-white/20">

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
                <div class="bg-white/30 backdrop-blur-2xl rounded-[30px] p-6 shadow-xl border border-white/20">

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
                <div class="bg-white/30 backdrop-blur-2xl rounded-[30px] p-6 shadow-xl border border-white/20">

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
            <div class="grid grid-cols-3 gap-5 mb-5">

                <!-- AVAILABLE DONATIONS -->
                <div class="col-span-2 bg-white/30 backdrop-blur-2xl rounded-3xl p-6 shadow-xl">

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

                            <div class="flex items-center justify-between">

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

                                    transition-all duration-300 text-white px-4 py-2 rounded-xl text-sm font-semibold">

                                    Claim Pickup

                                </a>

                            </div>

                        </div>

                        @endforeach

                    </div>

                </div>

                <!-- QUICK ACTION -->
                <div class="bg-white/30 backdrop-blur-2xl rounded-3xl p-6 shadow-xl">

                    <h1 class="text-2xl font-black text-[#504E76] mb-5">

                        Quick Actions

                    </h1>

                    <div class="space-y-4">

                        <!-- AVAILABLE DONATIONS -->
                        <a href="/community-dashboard"

                            class="bg-[#504E76] hover:bg-[#F1642E] transition-all duration-300 text-white rounded-2xl p-4 flex items-center gap-3">

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
            <div class="bg-white/30 backdrop-blur-2xl rounded-3xl p-6 shadow-xl mb-5">

                <div class="flex items-center justify-between mb-6">

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