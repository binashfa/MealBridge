<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MealBridge Supplier</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <style>
        * { scroll-behavior: smooth; }

        body {
            overflow-x: hidden;
            font-family: 'Poppins', sans-serif;
        }

        .glass {
            background: rgba(255, 255, 255, 0.35);
            backdrop-filter: blur(18px);
            -webkit-backdrop-filter: blur(18px);
            border: 1px solid rgba(255, 255, 255, 0.25);
        }

        .soft-shadow {
            box-shadow:
                0 12px 35px rgba(80, 78, 118, 0.10),
                0 5px 10px rgba(0, 0, 0, 0.03);
        }

        .smooth-card {
            transition: all .35s ease;
        }

        .smooth-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 25px 40px rgba(80, 78, 118, 0.16);
        }

        .btn-hover {
            transition: all .3s ease;
        }

        .btn-hover:hover {
            transform: scale(1.02);
        }

        .icon-hover {
            transition: all .35s ease;
        }

        .icon-hover:hover {
            transform: rotate(-10deg) scale(1.15);
        }

        .floating {
            animation: floating 4s ease-in-out infinite;
        }

        @keyframes floating {
            0%   { transform: translateY(0px); }
            50%  { transform: translateY(-8px); }
            100% { transform: translateY(0px); }
        }

        .gradient-text {
            background: linear-gradient(135deg, #504E76, #6E6AB3, #E8C067);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        /* STAT CARD — border aksen kiri seperti screenshot */
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
        }

        .stat-purple::before { background: #504E76; }
        .stat-green::before  { background: #4CAF7D; }
        .stat-orange::before { background: #F1642E; }
        .stat-red::before    { background: #E53935; }

        /* FADE IN STAGGER */
        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(20px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        .fade-up { animation: fadeUp 0.5s cubic-bezier(.22,.68,0,1.1) both; }
        .d1 { animation-delay: .05s; }
        .d2 { animation-delay: .10s; }
        .d3 { animation-delay: .15s; }
        .d4 { animation-delay: .20s; }
        .d5 { animation-delay: .25s; }
        .d6 { animation-delay: .30s; }

        /* SCROLLBAR */
        ::-webkit-scrollbar { width: 6px; }
        ::-webkit-scrollbar-thumb { background: #504E76; border-radius: 50px; }
        ::-webkit-scrollbar-track { background: transparent; }
    </style>
</head>

<body class="bg-gradient-to-br from-[#FDF8E2] to-[#C4C3E3] h-screen overflow-hidden">

<div class="flex h-screen">

    @include('supplier.sidebar')

    <!-- MAIN -->
    <main class="flex-1 overflow-y-auto px-4 sm:px-6 lg:px-8 py-6 lg:py-8 pt-16 lg:pt-8">

        <!-- TOP -->
        <div class="flex flex-col lg:flex-row justify-between lg:items-center gap-4 mb-7 fade-up">

            <!-- TITLE -->
            <div>
                <h1 class="text-2xl lg:text-4xl font-black gradient-text leading-tight">
                    Welcome Back, {{ Auth::user()->username }}!
                </h1>
                <p class="text-[#504E76]/65 mt-1 text-sm lg:text-base">
                    Manage your food donations beautifully 🍱
                </p>
            </div>

            <!-- PROFILE -->
            <div class="glass rounded-2xl px-4 py-3 flex items-center gap-3 soft-shadow smooth-card self-start lg:self-auto">
                <div>
                    <h1 class="font-black text-[#504E76] text-base lg:text-lg leading-tight">
                        {{ Auth::user()->username }}
                    </h1>
                    <p class="text-[#504E76]/60 text-xs lg:text-sm">Supplier</p>
                </div>
                <img
                    src="{{ Auth::user()->profile_photo
                        ? asset(Auth::user()->profile_photo)
                        : 'https://ui-avatars.com/api/?name=' . urlencode(Auth::user()->username) }}"
                    onerror="this.src='https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->username) }}'"
                    class="w-12 h-12 lg:w-14 lg:h-14 rounded-full border-4 border-white object-cover shadow-lg">
            </div>

        </div>

        <!-- STATS -->
        <div class="grid grid-cols-2 xl:grid-cols-4 gap-3 lg:gap-4 mb-7">

            <!-- TOTAL -->
            <div class="stat-card stat-purple fade-up d1
                        glass rounded-2xl px-4 lg:px-5 py-4 soft-shadow smooth-card
                        flex items-center gap-3 lg:gap-4">
                <div class="w-12 h-12 lg:w-14 lg:h-14 rounded-2xl bg-[#504E76]/10
                            flex items-center justify-center shrink-0 icon-hover">
                    <i class='bx bx-archive text-[#504E76] text-2xl lg:text-3xl'></i>
                </div>
                <div>
                    <h1 class="text-3xl lg:text-4xl font-black text-[#504E76]">
                        {{ $totalDonations }}
                    </h1>
                    <p class="text-[9px] lg:text-[10px] tracking-[3px] uppercase text-[#504E76]/50 mt-0.5">
                        Total Donations
                    </p>
                </div>
            </div>

            <!-- ACCEPTED -->
            <div class="stat-card stat-green fade-up d2
                        glass rounded-2xl px-4 lg:px-5 py-4 soft-shadow smooth-card
                        flex items-center gap-3 lg:gap-4">
                <div class="w-12 h-12 lg:w-14 lg:h-14 rounded-2xl bg-green-100
                            flex items-center justify-center shrink-0 icon-hover">
                    <i class='bx bx-check-circle text-green-600 text-2xl lg:text-3xl'></i>
                </div>
                <div>
                    <h1 class="text-3xl lg:text-4xl font-black text-[#504E76]">
                        {{ $acceptedDonations }}
                    </h1>
                    <p class="text-[9px] lg:text-[10px] tracking-[3px] uppercase text-[#504E76]/50 mt-0.5">
                        Accepted
                    </p>
                </div>
            </div>

            <!-- PENDING -->
            <div class="stat-card stat-orange fade-up d3
                        glass rounded-2xl px-4 lg:px-5 py-4 soft-shadow smooth-card
                        flex items-center gap-3 lg:gap-4">
                <div class="w-12 h-12 lg:w-14 lg:h-14 rounded-2xl bg-orange-100
                            flex items-center justify-center shrink-0 icon-hover">
                    <i class='bx bx-time-five text-orange-500 text-2xl lg:text-3xl'></i>
                </div>
                <div>
                    <h1 class="text-3xl lg:text-4xl font-black text-[#504E76]">
                        {{ $pendingDonations }}
                    </h1>
                    <p class="text-[9px] lg:text-[10px] tracking-[3px] uppercase text-[#504E76]/50 mt-0.5">
                        Pending
                    </p>
                </div>
            </div>

            <!-- COMMUNITIES -->
            <div class="stat-card stat-red fade-up d4
                        glass rounded-2xl px-4 lg:px-5 py-4 soft-shadow smooth-card
                        flex items-center gap-3 lg:gap-4">
                <div class="w-12 h-12 lg:w-14 lg:h-14 rounded-2xl bg-pink-100
                            flex items-center justify-center shrink-0 icon-hover">
                    <i class='bx bx-group text-pink-500 text-2xl lg:text-3xl'></i>
                </div>
                <div>
                    <h1 class="text-3xl lg:text-4xl font-black text-[#504E76]">
                        {{ $communitiesHelped }}
                    </h1>
                    <p class="text-[9px] lg:text-[10px] tracking-[3px] uppercase text-[#504E76]/50 mt-0.5">
                        Communities
                    </p>
                </div>
            </div>

        </div>

        <!-- CONTENT -->
        <div class="grid grid-cols-1 xl:grid-cols-3 gap-5">

            <!-- DONATIONS -->
            <div class="xl:col-span-2 glass rounded-3xl p-5 lg:p-6 soft-shadow smooth-card fade-up d5">

                <!-- HEADER -->
                <div class="flex items-center justify-between mb-6">
                    <div>
                        <h1 class="text-xl lg:text-2xl font-black text-[#504E76]">Active Donations</h1>
                        <p class="text-[#504E76]/60 mt-0.5 text-sm">Recent donation activities</p>
                    </div>
                    <div class="w-12 h-12 rounded-2xl bg-white/40 flex items-center justify-center">
                        <i class='bx bx-donate-heart text-3xl text-[#504E76] floating'></i>
                    </div>
                </div>

                @if($donations->isEmpty())

                    <!-- EMPTY STATE -->
                    <div class="flex flex-col items-center justify-center text-center py-14 lg:py-20">
                        <div class="w-24 h-24 rounded-full bg-[#504E76]/10
                                    flex items-center justify-center mb-5 floating">
                            <i class='bx bx-package text-5xl text-[#504E76]/30'></i>
                        </div>
                        <h1 class="text-2xl lg:text-3xl font-black text-[#504E76] mb-2">
                            No Donations Yet
                        </h1>
                        <p class="text-[#504E76]/60 text-sm lg:text-base mb-6">
                            Start sharing food with communities 🍱
                        </p>
                        <a href="/donate"
                           class="bg-gradient-to-r from-[#504E76] to-[#6B689B]
                                  hover:from-[#E7B96A] hover:to-[#E89A4A]
                                  text-white px-7 py-3 rounded-2xl font-bold
                                  shadow-xl transition-all duration-300 btn-hover text-sm lg:text-base">
                            Start Donating
                        </a>
                    </div>

                @else

                    <!-- DONATION GRID -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-4">

                        @foreach($donations->take(9) as $donation)
                        <div class="bg-white/40 rounded-2xl p-4 soft-shadow smooth-card">

                            <!-- STATUS -->
                            <div class="flex justify-end mb-3">
                                <span class="px-3 py-1 rounded-xl text-xs font-semibold whitespace-nowrap
                                    @if($donation->status == 'pending')     bg-yellow-100 text-yellow-700
                                    @elseif($donation->status == 'distribution') bg-blue-100 text-blue-700
                                    @elseif($donation->status == 'completed')    bg-green-100 text-green-700
                                    @elseif($donation->status == 'compost')      bg-orange-100 text-orange-700
                                    @else                                         bg-gray-100 text-gray-700
                                    @endif">
                                    {{ ucfirst($donation->status) }}
                                </span>
                            </div>

                            <!-- TITLE -->
                            <h1 class="font-black text-[#504E76] text-lg leading-tight break-words">
                                {{ \Illuminate\Support\Str::limit($donation->food_name, 18, '...') }}
                            </h1>
                            <p class="text-[#504E76]/65 text-sm mt-1">
                                {{ $donation->quantity }} portions
                            </p>

                            <!-- BOTTOM -->
                            <div class="mt-4 pt-3 border-t border-[#504E76]/8
                                        flex items-center justify-between">
                                <p class="text-xs text-[#504E76]/50">
                                    {{ $donation->created_at->format('d M Y') }}
                                </p>
                                <i class='bx bx-package text-[#504E76] text-2xl icon-hover'></i>
                            </div>

                        </div>
                        @endforeach

                    </div>

                @endif

            </div>

            <!-- QUICK ACTIONS -->
            <div class="glass rounded-3xl p-5 soft-shadow smooth-card h-fit fade-up d6">

                <!-- HEADER -->
                <div class="flex items-start justify-between gap-3 mb-5">
                    <div>
                        <h1 class="text-xl lg:text-2xl font-black text-[#504E76] leading-tight">
                            Quick Actions
                        </h1>
                        <p class="text-[#504E76]/60 mt-1 text-sm">
                            Manage your donation easily
                        </p>
                    </div>
                    <div class="w-12 h-12 rounded-2xl bg-white/50 flex items-center justify-center shadow-sm shrink-0">
                        <i class='bx bx-bolt-circle text-2xl text-[#504E76] floating'></i>
                    </div>
                </div>

                <div class="space-y-3">

                    <!-- NEW DONATION -->
                    <a href="/donate"
                       class="bg-gradient-to-r from-[#504E76] to-[#6E6AB3]
                              hover:from-[#E7B96A] hover:to-[#E89A4A]
                              text-white rounded-2xl px-4 py-4
                              flex items-center gap-4
                              transition-all duration-300 btn-hover shadow-lg">
                        <div class="w-12 h-12 min-w-[48px] rounded-xl bg-white/15
                                    flex items-center justify-center">
                            <i class='bx bx-plus-circle text-2xl'></i>
                        </div>
                        <div>
                            <h1 class="text-base font-black leading-tight">New Donation</h1>
                            <p class="text-white/70 text-xs mt-0.5">Share your food today</p>
                        </div>
                    </a>

                    <!-- HISTORY -->
                    <a href="/history"
                       class="bg-white/45 hover:bg-white/65 rounded-2xl px-4 py-4
                              flex items-center gap-4 transition-all duration-300 btn-hover">
                        <div class="w-12 h-12 min-w-[48px] rounded-xl bg-[#F6F3EA]
                                    flex items-center justify-center">
                            <i class='bx bx-history text-xl text-[#504E76]'></i>
                        </div>
                        <div>
                            <h1 class="text-base font-black text-[#504E76] leading-tight">View History</h1>
                            <p class="text-[#504E76]/55 text-xs mt-0.5">Donation activities</p>
                        </div>
                    </a>

                    <!-- NOTIFICATIONS -->
                    <a href="/notifications"
                       class="bg-white/45 hover:bg-white/65 rounded-2xl px-4 py-4
                              flex items-center gap-4 transition-all duration-300 btn-hover">
                        <div class="w-12 h-12 min-w-[48px] rounded-xl bg-[#F6F3EA]
                                    flex items-center justify-center">
                            <i class='bx bx-bell text-xl text-[#504E76]'></i>
                        </div>
                        <div>
                            <h1 class="text-base font-black text-[#504E76] leading-tight">Notifications</h1>
                            <p class="text-[#504E76]/55 text-xs mt-0.5">Donation updates</p>
                        </div>
                    </a>

                </div>

            </div>

        </div>

    </main>

</div>

</body>
</html>