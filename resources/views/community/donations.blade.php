<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
        content="width=device-width, initial-scale=1.0">

    <title>
        Available Donations
    </title>

    <script src="https://cdn.tailwindcss.com"></script>

    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css'
        rel='stylesheet'>

    <link rel="preconnect"
        href="https://fonts.googleapis.com">

    <link rel="preconnect"
        href="https://fonts.gstatic.com"
        crossorigin>

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
            background: rgba(255, 255, 255, 0.38);

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
            transform: translateY(-8px);

            box-shadow:
                0 20px 40px rgba(80, 78, 118, 0.15);
        }

        .gradient-text {
            background:
                linear-gradient(135deg,
                    #504E76,
                    #6E6AB3,
                    #E7B96A);

            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
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

        ::-webkit-scrollbar {
            width: 7px;
        }

        ::-webkit-scrollbar-thumb {
            background: #504E76;
            border-radius: 20px;
        }
    </style>

</head>

<body class="h-screen overflow-hidden">

    <div class="flex h-screen overflow-x-hidden">

        @include('community.sidebar')

        <!-- MAIN -->
        <main
            class="flex-1 overflow-y-auto px-4 sm:px-6 lg:px-8 py-6 lg:py-8 pt-16 lg:pt-8">

            <!-- TOP -->
            <div class="flex flex-col lg:flex-row justify-between lg:items-center gap-4 mb-7 fade-up d1">

                <!-- LEFT -->
                <div class="flex items-center gap-4">

                    <div class="w-14 h-14 rounded-2xl bg-[#504E76]
        text-white flex items-center justify-center
        shadow-xl floating">

                        <i class='bx bx-food-menu text-2xl'></i>

                    </div>

                    <div>

                        <h1 class="text-2xl lg:text-4xl font-black gradient-text">

                            Available Donations

                        </h1>

                        <p class="text-[#504E76]/65 mt-1 text-sm lg:text-base">

                            Nearby food donations ready for pickup 🍱

                        </p>

                    </div>

                </div>

                <!-- RIGHT -->
                <div class="glass rounded-2xl px-4 py-3 flex items-center gap-3 soft-shadow smooth-card">

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

                        class="w-12 h-12 rounded-full border-4 border-white object-cover shadow-lg">

                </div>

            </div>

            <!-- ALERT -->
            @if(session('error'))

            <div
                class="mb-5 bg-red-100/80 border border-red-300
                text-red-700 px-5 py-4 rounded-3xl">

                {{ session('error') }}

            </div>

            @endif

            @if(session('success'))

            <div
                class="mb-5 bg-green-100/80 border border-green-300
                text-green-700 px-5 py-4 rounded-3xl">

                {{ session('success') }}

            </div>

            @endif

            <!-- GRID -->
            <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 2xl:grid-cols-4 gap-5">

                @foreach($donations as $i => $donation)

                @php
                $delay = ($i % 8) * 0.06;
                @endphp

                <!-- CARD -->
                <div
                    class="glass rounded-[30px] overflow-hidden
                    soft-shadow smooth-card fade-up"

                    {!! 'style="animation-delay: ' .$delay.'s;"' !!}>

                    <!-- IMAGE -->
                    <img
                        src="{{ asset($donation->food_photo) }}"
                        class="w-full h-[180px] object-cover">

                    <!-- BODY -->
                    <div class="p-5">

                        <!-- TITLE -->
                        <div class="flex items-start justify-between gap-3">

                            <div>

                                <h1 class="text-xl font-black text-[#504E76] leading-tight">

                                    {{ $donation->food_name }}

                                </h1>

                                <p class="text-[#504E76]/55 text-sm mt-1">

                                    {{ $donation->supplier->nama_toko ?? 'Unknown Supplier' }}

                                </p>

                            </div>

                            <div
                                class="bg-green-100 text-green-700
                                px-3 py-1 rounded-xl
                                text-xs font-bold whitespace-nowrap">

                                {{ $donation->remaining_quantity }} left

                            </div>

                        </div>

                        <!-- LOCATION -->
                        <a
                            href="https://www.google.com/maps/search/?api=1&query={{ urlencode($donation->pickup_location) }}"
                            target="_blank"

                            class="mt-4 w-full

    bg-white/50
    hover:bg-[#504E76]

    text-[#504E76]
    hover:text-white

    py-3 px-4 rounded-2xl

    flex items-center justify-center gap-2

    text-sm font-bold

    transition-all duration-300
    btn-hover">

                            <i class='bx bx-map text-lg'></i>

                            View Pickup Location

                        </a>

                        <!-- INFO -->
                        <div class="mt-5 grid grid-cols-2 gap-3">

                            <div
                                class="bg-white/45 rounded-2xl p-4">

                                <p class="text-[10px]
                                uppercase tracking-wider
                                text-[#504E76]/45">

                                    Expired

                                </p>

                                <h1 class="font-black text-[#504E76] text-sm mt-2">

                                    {{ \Carbon\Carbon::parse($donation->expired_date)->format('d M Y') }}

                                </h1>

                            </div>

                            <div
                                class="bg-white/45 rounded-2xl p-4">

                                <p class="text-[10px]
                                uppercase tracking-wider
                                text-[#504E76]/45">

                                    Portions

                                </p>

                                <h1 class="font-black text-[#A3B565] text-lg mt-1">

                                    {{ $donation->remaining_quantity }}

                                </h1>

                            </div>

                        </div>

                        <!-- FORM -->
                        <form
                            action="/claim-donation/{{ $donation->id }}"
                            method="POST"
                            class="mt-5">

                            @csrf

                            <!-- INPUT -->
                            <input
                                type="number"
                                name="claim_quantity"

                                min="1"
                                max="{{ $donation->remaining_quantity }}"

                                placeholder="How many portions?"

                                required

                                class="w-full px-4 py-4 rounded-2xl

                                bg-white/60
                                border border-white/40

                                focus:outline-none
                                focus:ring-4
                                focus:ring-[#504E76]/10

                                text-sm text-[#504E76]">

                            <!-- BUTTON -->
                            <button
                                class="w-full mt-3

                                bg-gradient-to-r
                                from-[#504E76]
                                to-[#6E6AB3]

                                hover:from-[#F1642E]
                                hover:to-[#E8824E]

                                transition-all duration-300

                                text-white
                                py-4
                                rounded-2xl

                                text-sm
                                font-bold

                                btn-hover">

                                Claim Pickup

                            </button>

                        </form>

                    </div>

                </div>

                @endforeach

            </div>

            <div class="h-10"></div>

        </main>

    </div>

</body>

</html>