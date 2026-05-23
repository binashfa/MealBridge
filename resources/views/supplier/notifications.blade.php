<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
        content="width=device-width, initial-scale=1.0">

    <title>Notifications - MealBridge</title>

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
            background: linear-gradient(135deg,
                    #504E76,
                    #6E6AB3,
                    #E7B96A);

            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

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

        .fade-up {
            animation: fadeUp .6s ease both;
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

        @include('supplier.sidebar')

        <!-- MAIN -->
        <main
            class="flex-1 overflow-y-auto px-4 sm:px-6 lg:px-8 py-6 lg:py-8 pt-16 lg:pt-8">

            <!-- TOP -->
            <div
                class="flex flex-col lg:flex-row justify-between lg:items-center gap-5 mb-8 fade-up">

                <!-- TITLE -->
                <div class="flex items-center gap-4">

                    <div
                        class="w-16 h-16 rounded-3xl bg-[#504E76]
                        flex items-center justify-center
                        shadow-xl floating shrink-0">

                        <i class='bx bx-bell text-3xl text-white'></i>

                    </div>

                    <div>

                        <h1
                            class="text-3xl lg:text-5xl font-black gradient-text">

                            Notifications

                        </h1>

                        <p
                            class="text-[#504E76]/60 mt-1 text-sm lg:text-base">

                            Stay updated with your donation activities ✨

                        </p>

                    </div>

                </div>

                <!-- PROFILE -->
                <div
                    class="glass rounded-3xl px-5 py-3
                    soft-shadow smooth-card
                    flex items-center gap-4">

                    <div>

                        <h1
                            class="font-black text-[#504E76] text-lg">

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
            @if($notifications->isEmpty())

            <div
                class="glass rounded-[35px] p-16 soft-shadow
                flex flex-col items-center justify-center text-center">

                <div
                    class="w-28 h-28 rounded-full bg-[#504E76]/10
                    flex items-center justify-center mb-6 floating">

                    <i
                        class='bx bx-bell-off text-6xl text-[#504E76]/30'></i>

                </div>

                <h1
                    class="text-3xl font-black text-[#504E76] mb-3">

                    No Notifications Yet

                </h1>

                <p class="text-[#504E76]/60 mb-7">

                    New donation updates will appear here.

                </p>

            </div>

            @else

            <!-- NOTIFICATION LIST -->
            <div class="space-y-5">

                @foreach($notifications as $i => $notification)

                @php
                    $delay = ($i % 8) * 0.08;
                @endphp

                <!-- CARD -->
                <div

                    class="group relative overflow-hidden rounded-[32px]
                    glass border border-white/30

                    shadow-[0_10px_40px_rgba(80,78,118,0.10)]

                    hover:shadow-[0_25px_60px_rgba(80,78,118,0.18)]

                    transition-all duration-500
                    hover:-translate-y-2

                    fade-up"

                    {!! 'style="animation-delay: '.$delay.'s;"' !!}
                >

                    <!-- GLOW -->
                    <div
                        class="absolute inset-0 opacity-0
                        group-hover:opacity-100
                        transition duration-500

                        bg-gradient-to-br
                        from-[#504E76]/10
                        via-transparent
                        to-[#E7B96A]/10">
                    </div>

                    <!-- CONTENT -->
                    <div
                        class="relative z-10 p-6 flex flex-col lg:flex-row lg:items-center justify-between gap-5">

                        <!-- LEFT -->
                        <div class="flex items-start gap-4">

                            <!-- ICON -->
                            <div

                                class="w-16 h-16 rounded-3xl

                                bg-gradient-to-br
                                from-[#504E76]
                                to-[#6E6AB3]

                                flex items-center justify-center

                                shadow-lg shrink-0

                                transition duration-500
                                group-hover:rotate-6
                                group-hover:scale-110">

                                <i
                                    class='bx bx-bell text-3xl text-white'></i>

                            </div>

                            <!-- TEXT -->
                            <div>

                                <h1
                                    class="text-xl font-black text-[#504E76] mb-2">

                                    {{ $notification->title ?? 'Notification' }}

                                </h1>

                                <p
                                    class="text-[#504E76]/70 leading-relaxed">

                                    {{ $notification->message ?? 'You have a new notification.' }}

                                </p>

                                <div
                                    class="flex items-center gap-2 mt-3 text-sm text-[#504E76]/50">

                                    <i class='bx bx-time-five'></i>

                                    <span>

                                        {{ $notification->created_at->diffForHumans() }}

                                    </span>

                                </div>

                            </div>

                        </div>

                        <!-- RIGHT -->
                        <div class="flex items-center gap-3">

                            @if(isset($notification->status))

                            <span

                                class="px-4 py-2 rounded-2xl
                                text-xs font-bold

                                @if($notification->status == 'pending')
                                    bg-yellow-100 text-yellow-700

                                @elseif($notification->status == 'approved')
                                    bg-blue-100 text-blue-700

                                @elseif($notification->status == 'completed')
                                    bg-green-100 text-green-700

                                @else
                                    bg-gray-100 text-gray-700
                                @endif
                                ">

                                {{ ucfirst($notification->status) }}

                            </span>

                            @endif

                        </div>

                    </div>

                </div>

                @endforeach

            </div>

            @endif

            <div class="h-10"></div>

        </main>

    </div>

</body>

</html>