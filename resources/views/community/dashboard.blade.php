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
                <div class="bg-white/30 backdrop-blur-2xl
                rounded-2xl px-5 py-3
                flex items-center gap-4 shadow-xl">

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
                        ? asset('storage/' . Auth::user()->profile_photo)
                        : 'https://ui-avatars.com/api/?name=' . Auth::user()->username }}"

                        class="w-12 h-12 rounded-full
                        object-cover border-2 border-white shadow-lg">

                </div>

            </div>

            <!-- STATISTICS -->
            <div class="grid grid-cols-3 gap-4 mb-6">

                <!-- ACTIVE PICKUP -->
                <div class="bg-white/30 backdrop-blur-2xl
                rounded-3xl p-5 shadow-xl">

                    <div class="flex items-center justify-between">

                        <div>

                            <p class="text-sm text-[#504E76]/70">
                                Active Pickups
                            </p>

                            <h1 class="text-4xl font-black text-[#504E76] mt-1">
                                12
                            </h1>

                        </div>

                        <div class="w-14 h-14 rounded-2xl
                        bg-[#504E76]
                        text-white flex items-center justify-center">

                            <i class='bx bx-package text-2xl'></i>

                        </div>

                    </div>

                </div>

                <!-- MEALS -->
                <div class="bg-white/30 backdrop-blur-2xl
                rounded-3xl p-5 shadow-xl">

                    <div class="flex items-center justify-between">

                        <div>

                            <p class="text-sm text-[#504E76]/70">
                                Meals Distributed
                            </p>

                            <h1 class="text-4xl font-black text-[#504E76] mt-1">
                                540
                            </h1>

                        </div>

                        <div class="w-14 h-14 rounded-2xl
                        bg-[#A3B565]
                        text-white flex items-center justify-center">

                            <i class='bx bx-dish text-2xl'></i>

                        </div>

                    </div>

                </div>

                <!-- EMERGENCY -->
                <div class="bg-white/30 backdrop-blur-2xl
                rounded-3xl p-5 shadow-xl">

                    <div class="flex items-center justify-between">

                        <div>

                            <p class="text-sm text-[#504E76]/70">
                                Emergency Requests
                            </p>

                            <h1 class="text-4xl font-black text-[#504E76] mt-1">
                                5
                            </h1>

                        </div>

                        <div class="w-14 h-14 rounded-2xl
                        bg-[#F1642E]
                        text-white flex items-center justify-center">

                            <i class='bx bx-error text-2xl'></i>

                        </div>

                    </div>

                </div>

            </div>

            <!-- SECTION -->
            <div class="grid grid-cols-3 gap-5 mb-5">

                <!-- AVAILABLE DONATIONS -->
                <div class="col-span-2 bg-white/30
                backdrop-blur-2xl rounded-3xl
                p-6 shadow-xl">

                    <div class="flex items-center justify-between mb-5">

                        <h1 class="text-2xl font-black text-[#504E76]">
                            Available Donations
                        </h1>

                        <i class='bx bx-food-menu text-3xl text-[#504E76]'></i>

                    </div>

                    <div class="space-y-4">

                        <!-- CARD -->
                        <div class="bg-white/40 rounded-2xl p-4">

                            <div class="flex items-center justify-between">

                                <div>

                                    <h1 class="font-bold text-[#504E76]">
                                        🍞 Bread Package
                                    </h1>

                                    <p class="text-sm text-[#504E76]/60 mt-1">
                                        24 portions • BSD • 2 hours left
                                    </p>

                                </div>

                                <button
                                    class="bg-[#504E76]
                                    hover:bg-[#F1642E]
                                    transition-all duration-300
                                    text-white px-4 py-2 rounded-xl text-sm font-semibold">

                                    Claim Pickup

                                </button>

                            </div>

                        </div>

                        <!-- CARD -->
                        <div class="bg-white/40 rounded-2xl p-4 border-2 border-[#F1642E]/30">

                            <div class="flex items-center justify-between">

                                <div>

                                    <h1 class="font-bold text-[#F1642E]">
                                        ⚠️ Rice Box Emergency
                                    </h1>

                                    <p class="text-sm text-[#504E76]/60 mt-1">
                                        40 portions • Gading Serpong • 1 hour left
                                    </p>

                                </div>

                                <button
                                    class="bg-[#F1642E]
                                    hover:bg-[#504E76]
                                    transition-all duration-300
                                    text-white px-4 py-2 rounded-xl text-sm font-semibold">

                                    Urgent Pickup

                                </button>

                            </div>

                        </div>

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

                        <a href="/distribution-map"
                            class="bg-[#504E76]
                            hover:bg-[#F1642E]
                            transition-all duration-300
                            text-white rounded-2xl
                            p-4 flex items-center gap-3">

                            <i class='bx bx-map text-2xl'></i>

                            <span class="font-semibold">
                                Open Distribution Map
                            </span>

                        </a>

                        <a href="/active-distribution"
                            class="bg-white/40
                            hover:bg-white/60
                            transition-all duration-300
                            rounded-2xl p-4
                            flex items-center gap-3
                            text-[#504E76]">

                            <i class='bx bx-package text-2xl'></i>

                            <span class="font-semibold">
                                Active Distribution
                            </span>

                        </a>

                        <a href="/upload-proof"
                            class="bg-white/40
                            hover:bg-white/60
                            transition-all duration-300
                            rounded-2xl p-4
                            flex items-center gap-3
                            text-[#504E76]">

                            <i class='bx bx-upload text-2xl'></i>

                            <span class="font-semibold">
                                Upload Proof
                            </span>

                        </a>

                    </div>

                </div>

            </div>

            <!-- ACTIVE DISTRIBUTION -->
            <div class="bg-white/30 backdrop-blur-2xl
            rounded-3xl p-6 shadow-xl mb-5">

                <div class="flex items-center justify-between mb-6">

                    <h1 class="text-2xl font-black text-[#504E76]">
                        Active Distribution
                    </h1>

                    <i class='bx bx-trip text-3xl text-[#504E76]'></i>

                </div>

                <div class="bg-white/40 rounded-2xl p-5">

                    <p class="text-[#504E76]/70 text-sm mb-2">
                        Pickup From
                    </p>

                    <h1 class="text-xl font-bold text-[#504E76] mb-4">
                        Bakery RasaManis
                    </h1>

                    <p class="text-[#504E76]/70 text-sm mb-2">
                        Destination
                    </p>

                    <h1 class="text-xl font-bold text-[#504E76] mb-4">
                        Panti Asuhan Harapan
                    </h1>

                    <div class="inline-flex items-center gap-2
                    bg-blue-100 text-blue-700
                    px-4 py-2 rounded-xl font-semibold">

                        <i class='bx bx-car'></i>

                        On Delivery

                    </div>

                </div>

            </div>

            <!-- TIMELINE -->
            <div class="bg-white/30 backdrop-blur-2xl
            rounded-3xl p-6 shadow-xl mb-5">

                <div class="flex items-center justify-between mb-6">

                    <h1 class="text-2xl font-black text-[#504E76]">
                        Distribution Timeline
                    </h1>

                    <i class='bx bx-time text-3xl text-[#504E76]'></i>

                </div>

                <div class="space-y-4">

                    <div class="flex items-center gap-4">

                        <div class="w-4 h-4 rounded-full bg-[#504E76]"></div>

                        <p class="font-semibold text-[#504E76]">
                            13:00 Pickup Claimed
                        </p>

                    </div>

                    <div class="flex items-center gap-4">

                        <div class="w-4 h-4 rounded-full bg-[#F8C15C]"></div>

                        <p class="font-semibold text-[#504E76]">
                            13:30 Food Collected
                        </p>

                    </div>

                    <div class="flex items-center gap-4">

                        <div class="w-4 h-4 rounded-full bg-[#4DA8FF]"></div>

                        <p class="font-semibold text-[#504E76]">
                            14:00 On Distribution
                        </p>

                    </div>

                    <div class="flex items-center gap-4">

                        <div class="w-4 h-4 rounded-full bg-[#A3B565]"></div>

                        <p class="font-semibold text-[#504E76]">
                            15:00 Delivered
                        </p>

                    </div>

                </div>

            </div>

            <!-- IMPACT -->
            <div class="grid grid-cols-3 gap-5">

                <div class="bg-white/30 backdrop-blur-2xl
                rounded-3xl p-6 shadow-xl">

                    <h1 class="text-5xl font-black text-[#504E76]">
                        540
                    </h1>

                    <p class="mt-2 text-[#504E76]/70">
                        🍱 Meals Distributed
                    </p>

                </div>

                <div class="bg-white/30 backdrop-blur-2xl
                rounded-3xl p-6 shadow-xl">

                    <h1 class="text-5xl font-black text-[#504E76]">
                        23
                    </h1>

                    <p class="mt-2 text-[#504E76]/70">
                        ❤️ Communities Helped
                    </p>

                </div>

                <div class="bg-white/30 backdrop-blur-2xl
                rounded-3xl p-6 shadow-xl">

                    <h1 class="text-5xl font-black text-[#504E76]">
                        180kg
                    </h1>

                    <p class="mt-2 text-[#504E76]/70">
                        🌱 Food Waste Reduced
                    </p>

                </div>

            </div>

        </main>

    </div>

</body>

</html>