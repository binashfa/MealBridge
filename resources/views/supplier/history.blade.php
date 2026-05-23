<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Donation History - MealBridge</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    <link rel="preconnect" href="https://fonts.googleapis.com">

    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">

    <style>
        * {
            font-family: 'Poppins', sans-serif;
            scroll-behavior: smooth;
        }

        body {
            overflow-x: hidden;
            background:
                linear-gradient(135deg,
                    #FDF8E2 0%,
                    #ECEAF8 55%,
                    #D6D4F4 100%);
        }

        .glass {
            background: rgba(255, 255, 255, 0.40);
            backdrop-filter: blur(18px);
            -webkit-backdrop-filter: blur(18px);
            border: 1px solid rgba(255, 255, 255, 0.35);
        }

        .soft-shadow {
            box-shadow:
                0 10px 30px rgba(80, 78, 118, 0.10),
                0 4px 10px rgba(0, 0, 0, 0.04);
        }

        .smooth-card {
            transition: all .35s ease;
        }

        .smooth-card:hover {
            transform: translateY(-6px);
            box-shadow:
                0 18px 40px rgba(80, 78, 118, 0.16);
        }

        .btn-hover {
            transition: all .3s ease;
        }

        .btn-hover:hover {
            transform: scale(1.03);
        }

        .floating {
            animation: floating 4s ease-in-out infinite;
        }

        @keyframes floating {
            0% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(-7px);
            }

            100% {
                transform: translateY(0px);
            }
        }

        .gradient-text {
            background: linear-gradient(135deg,
                    #504E76,
                    #6E6AB3,
                    #E7B96A);

            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .history-card {
            position: relative;
            overflow: hidden;
        }

        .history-card::before {
            content: '';
            position: absolute;
            top: 12%;
            left: 0;
            width: 4px;
            height: 76%;
            border-radius: 0 5px 5px 0;
            background: linear-gradient(to bottom,
                    #504E76,
                    #E7B96A);
        }

        .claim-row {
            background: rgba(255, 255, 255, 0.55);
            border: 1px solid rgba(255, 255, 255, 0.45);
            border-radius: 18px;
            padding: 12px;
        }

        .fade-up {
            animation: fadeUp .5s ease both;
        }

        @keyframes fadeUp {
            from {
                opacity: 0;
                transform: translateY(25px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .modal-input {
            width: 100%;
            border-radius: 16px;
            background: rgba(80, 78, 118, 0.06);
            border: 1px solid rgba(80, 78, 118, 0.12);
            padding: 12px 16px 12px 45px;
            outline: none;
            transition: .3s;
            font-size: 13px;
            color: #504E76;
        }

        .modal-input:focus {
            border-color: #504E76;
            background: white;
            box-shadow: 0 0 0 4px rgba(80, 78, 118, 0.10);
        }

        .modal-input-wrap {
            position: relative;
        }

        .modal-input-wrap i {
            position: absolute;
            top: 50%;
            left: 14px;
            transform: translateY(-50%);
            color: rgba(80, 78, 118, 0.40);
        }

        .modal-label {
            display: block;
            margin-bottom: 8px;
            font-size: 12px;
            font-weight: 700;
            color: #504E76;
        }

        ::-webkit-scrollbar {
            width: 7px;
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

<body class="h-screen overflow-hidden">

    <div class="flex h-screen overflow-x-hidden">

        @include('supplier.sidebar')

        <!-- MAIN -->
        <main class="flex-1 overflow-y-auto px-4 sm:px-6 lg:px-8 py-6 lg:py-8 pt-16 lg:pt-8">

            <!-- TOP -->
            <div class="flex flex-col lg:flex-row justify-between lg:items-center gap-5 mb-7 fade-up">

                <!-- TITLE -->
                <div class="flex items-center gap-4">

                    <div
                        class="w-14 h-14 rounded-2xl bg-[#504E76] flex items-center justify-center shadow-xl floating shrink-0">

                        <i class='bx bx-history text-2xl text-white'></i>

                    </div>

                    <div>

                        <h1 class="text-2xl lg:text-4xl font-black gradient-text leading-tight">

                            Donation History

                        </h1>

                        <p class="text-[#504E76]/60 mt-1 text-sm lg:text-base">

                            Track your donation journey beautifully ✨

                        </p>

                    </div>

                </div>

                <!-- PROFILE -->
                <div class="glass rounded-3xl px-5 py-3 soft-shadow smooth-card flex items-center gap-4">

                    <div>

                        <h1 class="font-black text-[#504E76] text-lg">

                            {{ Auth::user()->username }}

                        </h1>

                        <p class="text-[#504E76]/60 text-sm">

                            Supplier

                        </p>

                    </div>

                    <img
                        src="{{ Auth::user()->profile_photo ? asset(Auth::user()->profile_photo) : 'https://ui-avatars.com/api/?name=' . urlencode(Auth::user()->username) }}"
                        class="w-14 h-14 rounded-full object-cover border-4 border-white shadow-lg">

                </div>

            </div>

            <!-- EMPTY -->
            @if($histories->isEmpty())

            <div
                class="glass rounded-[35px] p-16 soft-shadow flex flex-col items-center justify-center text-center fade-up">

                <div
                    class="w-28 h-28 rounded-full bg-[#504E76]/10 flex items-center justify-center mb-6 floating">

                    <i class='bx bx-package text-6xl text-[#504E76]/30'></i>

                </div>

                <h1 class="text-3xl font-black text-[#504E76] mb-3">

                    No Donation History

                </h1>

                <p class="text-[#504E76]/60 mb-7">

                    Your donation activities will appear here.

                </p>

                <a href="/donate"
                    class="bg-gradient-to-r from-[#504E76] to-[#6E6AB3]
                          hover:from-[#E7B96A] hover:to-[#E89A4A]
                          text-white px-7 py-3 rounded-2xl
                          font-bold shadow-xl btn-hover">

                    Start Donation

                </a>

            </div>

            @else

            <!-- GRID -->
            <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 2xl:grid-cols-4 gap-5">

                @foreach($histories as $i => $history)

                @php
                $delay = ($i % 8) * 0.06;
                @endphp

                <div
                    class="history-card glass rounded-[30px] overflow-hidden soft-shadow smooth-card fade-up"
                    {!! 'style="animation-delay: ' .$delay.'s;"' !!}>

                    <!-- IMAGE -->
                    <div class="relative">

                        <img
                            src="{{ asset($history->food_photo) }}"
                            onerror="this.src='https://placehold.co/600x300/e8e6f7/504E76?text=No+Photo'"
                            class="w-full h-[150px] object-cover">

                        <!-- STATUS -->
                        <div class="absolute top-3 right-3">

                            <span
                                class="px-3 py-1 rounded-xl text-[10px] font-bold backdrop-blur-md

                @if($history->status == 'pending')
                    bg-yellow-100/90 text-yellow-700

                @elseif($history->status == 'distribution')
                    bg-blue-100/90 text-blue-700

                @elseif($history->status == 'completed')
                    bg-green-100/90 text-green-700

                @else
                    bg-gray-100/90 text-gray-700
                @endif
                ">

                                {{ ucfirst($history->status) }}

                            </span>

                        </div>

                    </div>

                    <!-- BODY -->
                    <div class="p-5">

                        <!-- FOOD -->
                        <h1
                            class="font-black text-[#504E76]
            text-xl leading-tight mb-4 break-words">

                            {{ $history->food_name }}

                        </h1>

                        <!-- STATS -->
                        <div class="grid grid-cols-3 gap-2 mb-4">

                            <div class="bg-white/50 rounded-2xl p-3 text-center">

                                <p
                                    class="text-[10px]
                    uppercase tracking-wider
                    text-[#504E76]/50">

                                    Total

                                </p>

                                <h1
                                    class="font-black
                    text-[#504E76]
                    text-lg">

                                    {{ $history->quantity }}

                                </h1>

                            </div>

                            <div class="bg-white/50 rounded-2xl p-3 text-center">

                                <p
                                    class="text-[10px]
                    uppercase tracking-wider
                    text-[#504E76]/50">

                                    Left

                                </p>

                                <h1
                                    class="font-black
                    text-[#504E76]
                    text-lg">

                                    {{ $history->remaining_quantity }}

                                </h1>

                            </div>

                            <div class="bg-white/50 rounded-2xl p-3 text-center">

                                <p
                                    class="text-[10px]
                    uppercase tracking-wider
                    text-[#504E76]/50">

                                    Exp

                                </p>

                                <h1
                                    class="font-black
                    text-[#504E76]
                    text-xs">

                                    {{ \Carbon\Carbon::parse($history->expired_date)->format('d M') }}

                                </h1>

                            </div>

                        </div>

                        <!-- CLAIMS -->
                        @if($history->claims->count() > 0)

                        <p
                            class="text-[10px]
            font-bold
            uppercase
            tracking-widest
            text-[#504E76]/40
            mb-3">

                            Claims

                        </p>

                        <div class="space-y-3 mb-4">

                            @foreach($history->claims as $claim)

                            <div class="claim-row">

                                <div class="flex justify-between items-start gap-2 mb-3">

                                    <div class="min-w-0">

                                        <h1
                                            class="font-bold
                            text-[#504E76]
                            text-sm truncate">

                                            {{ $claim->community->nama_komunitas }}

                                        </h1>

                                        <p
                                            class="text-[#504E76]/60
                            text-xs">

                                            {{ $claim->claimed_quantity }} portions

                                        </p>

                                    </div>

                                    <span
                                        class="px-2 py-1 rounded-lg text-[10px] font-bold

                        @if($claim->status == 'requested')
                            bg-yellow-100 text-yellow-700

                        @elseif($claim->status == 'approved')
                            bg-blue-100 text-blue-700

                        @elseif($claim->status == 'distribution')
                            bg-purple-100 text-purple-700

                        @elseif($claim->status == 'completed')
                            bg-green-100 text-green-700
                        @endif
                        ">

                                        {{ ucfirst($claim->status) }}

                                    </span>

                                </div>

                                <!-- ACTION -->
                                <div class="flex justify-end items-center gap-2">

                                    @if($claim->status == 'requested')

                                    <form
                                        action="/approve-donation/{{ $claim->id }}"
                                        method="POST">

                                        @csrf

                                        <button
                                            class="bg-[#A3B565]
                            hover:bg-[#8ea14f]

                            text-white
                            px-4 py-2
                            rounded-xl
                            text-xs
                            font-bold
                            btn-hover">

                                            Accept

                                        </button>

                                    </form>

                                    @elseif($claim->status == 'approved')

                                    <!-- CHAT -->
                                    <a
                                        href="https://wa.me/{{ preg_replace('/^0/', '62', $claim->community->user->no_telp) }}"
                                        target="_blank"

                                        class="bg-[#F1642E]
    hover:bg-[#dd5622]

    text-white
    px-4 py-2
    rounded-xl
    text-xs
    font-bold
    transition-all duration-300
    btn-hover">

                                        Chat

                                    </a>

                                    <!-- SEND -->
                                    <button
                                        onclick="openModal('{{ $claim->id }}')"

                                        class="bg-gradient-to-r
    from-[#504E76]
    to-[#6E6AB3]

    hover:from-[#433f63]
    hover:to-[#5a56a3]

    text-white
    px-4 py-2
    rounded-xl
    text-xs
    font-bold
    btn-hover">

                                        Send

                                    </button>

                                    @elseif($claim->status == 'distribution')

                                    <span class="text-purple-600 text-xs font-bold">

                                        Waiting...

                                    </span>

                                    @elseif($claim->status == 'completed')

                                    <span class="text-green-600 text-xs font-bold">

                                        Done

                                    </span>

                                    @endif

                                </div>

                            </div>

                            @endforeach

                        </div>

                        @endif

                        <!-- MAP -->
                        <a
                            href="https://www.google.com/maps/search/?api=1&query={{ urlencode($history->pickup_location) }}"
                            target="_blank"

                            class="w-full bg-white/50
            hover:bg-[#504E76]

            text-[#504E76]
            hover:text-white

            py-3 rounded-2xl

            flex items-center justify-center gap-2

            text-sm font-bold

            transition-all duration-300
            btn-hover">

                            <i class='bx bx-map text-lg'></i>

                            View on Maps

                        </a>

                    </div>

                </div>

                @endforeach
            </div>

            <!-- PAGINATION -->
            <div class="mt-8 flex justify-center">

                <div class="glass rounded-2xl p-3 soft-shadow">

                    {{ $histories->links() }}

                </div>

            </div>

            @endif

            <div class="h-8"></div>

        </main>

    </div>

</body>

</html>