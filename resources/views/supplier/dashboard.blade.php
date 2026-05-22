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

    <div class="flex h-screen">

        @include('supplier.sidebar')

        <!-- MAIN CONTENT -->
        <main
            id="mainContent"
            class="flex-1 overflow-y-auto px-8 py-8 pt-8">

            <!-- TOPBAR -->
            <div class="flex items-center justify-between mb-6">

                <div>

                    <h1 class="text-4xl font-black text-[#504E76] mb-1">
                        Welcome Back 👋
                    </h1>

                    <p class="text-[#504E76]/70">
                        Manage your food donations easily.
                    </p>

                </div>

                <!-- PROFILE -->
                <div class="bg-white/30 backdrop-blur-2xl
                            rounded-2xl px-5 py-3
                            flex items-center gap-4 shadow-xl">

                    <div>

                        <h1 class="font-bold text-[#504E76]">
                            {{ Auth::user()->username }}
                        </h1>

                        <p class="text-sm text-[#504E76]/70">
                            Supplier
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
            <div class="grid grid-cols-4 gap-4 mb-6">

                <!-- CARD -->
                <div class="bg-white/30 backdrop-blur-2xl
        rounded-3xl p-5 shadow-xl">

                    <div class="flex items-center justify-between">

                        <div>

                            <p class="text-sm text-[#504E76]/70">
                                Total Donations
                            </p>

                            <h1 class="text-4xl font-black text-[#504E76] mt-1">
                                {{ $totalDonations }}
                            </h1>

                        </div>

                        <div class="w-14 h-14 rounded-2xl
                bg-[#504E76]
                text-white flex items-center justify-center">

                            <i class='bx bx-package text-2xl'></i>

                        </div>

                    </div>

                </div>

                <!-- CARD -->
                <div class="bg-white/30 backdrop-blur-2xl
        rounded-3xl p-5 shadow-xl">

                    <div class="flex items-center justify-between">

                        <div>

                            <p class="text-sm text-[#504E76]/70">
                                Accepted
                            </p>

                            <h1 class="text-4xl font-black text-[#504E76] mt-1">
                                {{ $acceptedDonations }}
                            </h1>

                        </div>

                        <div class="w-14 h-14 rounded-2xl
                bg-[#A3B565]
                text-white flex items-center justify-center">

                            <i class='bx bx-check-circle text-2xl'></i>

                        </div>

                    </div>

                </div>

                <!-- CARD -->
                <div class="bg-white/30 backdrop-blur-2xl
        rounded-3xl p-5 shadow-xl">

                    <div class="flex items-center justify-between">

                        <div>

                            <p class="text-sm text-[#504E76]/70">
                                Pending
                            </p>

                            <h1 class="text-4xl font-black text-[#504E76] mt-1">
                                {{ $pendingDonations }}
                            </h1>

                        </div>

                        <div class="w-14 h-14 rounded-2xl
                bg-[#F1642E]
                text-white flex items-center justify-center">

                            <i class='bx bx-time-five text-2xl'></i>

                        </div>

                    </div>

                </div>

                <!-- CARD -->
                <div class="bg-white/30 backdrop-blur-2xl
        rounded-3xl p-5 shadow-xl">

                    <div class="flex items-center justify-between">

                        <div>

                            <p class="text-sm text-[#504E76]/70">
                                Communities Helped
                            </p>

                            <h1 class="text-4xl font-black text-[#504E76] mt-1">
                                {{ $communitiesHelped }}
                            </h1>

                        </div>

                        <div class="w-14 h-14 rounded-2xl
                bg-[#B8B1FF]
                text-white flex items-center justify-center">

                            <i class='bx bx-heart text-2xl'></i>

                        </div>

                    </div>

                </div>

            </div>

            <!-- SECTION 1 -->
            <div class="grid grid-cols-3 gap-5 mb-5">

                <!-- ACTIVE DONATION -->
                <div class="col-span-2 bg-white/30 backdrop-blur-2xl rounded-3xl p-6 shadow-xl">

                    <!-- HEADER -->
                    <div class="flex items-center justify-between mb-5">

                        <h1 class="text-2xl font-black text-[#504E76]">

                            Active Donations

                        </h1>

                        <i class='bx bx-donate-heart text-3xl text-[#504E76]'></i>

                    </div>

                    <!-- GRID -->
                    <div class="grid grid-cols-3 gap-2">

                        @foreach($donations->take(9) as $donation)

                        <!-- CARD -->
                        <div class="bg-white/40 rounded-2xl p-4">

                            <!-- TOP -->
                            <div class="flex items-start justify-between gap-3">

                                <div>

                                    <h1 class="font-black text-[#504E76] text-lg leading-tight">

                                        {{ \Illuminate\Support\Str::limit($donation->food_name, 8, '...') }}

                                    </h1>

                                    <p class="text-sm text-[#504E76]/60 mt-1">

                                        {{ $donation->quantity }} portions

                                    </p>

                                </div>

                                <!-- STATUS -->
                                <span
                                    class="px-3 py-1 rounded-xl text-xs font-semibold whitespace-nowrap

                                    @if($donation->status == 'pending')
                                        bg-yellow-100 text-yellow-700
                                    @elseif($donation->status == 'distribution')
                                        bg-blue-100 text-blue-700
                                    @elseif($donation->status == 'completed')
                                        bg-green-100 text-green-700
                                    @elseif($donation->status == 'compost')
                                        bg-orange-100 text-orange-700
                                    @else
                                        bg-gray-100 text-gray-700
                                    @endif
                                ">

                                    {{ ucfirst($donation->status) }}

                                </span>

                            </div>

                            <!-- BOTTOM -->
                            <div class="mt-4 flex items-center justify-between">

                                <p class="text-xs text-[#504E76]/50">

                                    {{ $donation->created_at->format('d M Y') }}

                                </p>

                                <i class='bx bx-package text-[#504E76] text-xl'></i>

                            </div>

                        </div>

                        @endforeach

                    </div>

                </div>

                <!-- QUICK ACTION -->
                <div class="bg-white/30 backdrop-blur-2xl
        rounded-3xl p-6 shadow-xl">

                    <h1 class="text-2xl font-black
            text-[#504E76] mb-5">

                        Quick Actions

                    </h1>

                    <div class="space-y-4">

                        <a href="/donate"
                            class="bg-[#504E76]
                    hover:bg-[#F1642E]
                    transition-all duration-300
                    text-white rounded-2xl
                    p-4 flex items-center gap-3">

                            <i class='bx bx-plus-circle text-2xl'></i>

                            <span class="font-semibold">
                                New Donation
                            </span>

                        </a>

                        <a href="/history"
                            class="bg-white/40
                    hover:bg-white/60
                    transition-all duration-300
                    rounded-2xl p-4
                    flex items-center gap-3
                    text-[#504E76]">

                            <i class='bx bx-history text-2xl'></i>

                            <span class="font-semibold">
                                View History
                            </span>

                        </a>

                        <a href="/notifications"
                            class="bg-white/40
                    hover:bg-white/60
                    transition-all duration-300
                    rounded-2xl p-4
                    flex items-center gap-3
                    text-[#504E76]">

                            <i class='bx bx-bell text-2xl'></i>

                            <span class="font-semibold">
                                Notifications
                            </span>

                        </a>

                    </div>

                </div>

            </div>

        </main>
    </div>

</body>

</html><!-- MAIN CONTENT -->