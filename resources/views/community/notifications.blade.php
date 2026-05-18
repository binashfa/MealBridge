<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Notifications</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>

<body class="bg-gradient-to-br from-[#FDF8E2] to-[#C4C3E3] h-screen overflow-hidden">

    <div class="flex h-screen">

        @include('community.sidebar')

        <main class="flex-1 overflow-y-auto p-6 lg:p-8">

            <!-- HEADER -->
            <div class="flex items-center gap-3 mb-6">

                <div class="w-12 h-12 rounded-2xl bg-[#504E76]
                text-white flex items-center justify-center shadow-lg">

                    <i class='bx bx-bell text-2xl'></i>

                </div>

                <div>

                    <h1 class="text-3xl font-black text-[#504E76]">
                        Notifications
                    </h1>

                    <p class="text-sm text-[#504E76]/70">
                        Latest updates from MealBridge
                    </p>

                </div>

            </div>

            <!-- LIST -->
            <div class="space-y-4">

                @foreach($notifications as $notification)

                    <div class="bg-white/25 backdrop-blur-2xl
                    border border-white/20
                    rounded-2xl p-4 shadow-lg">

                        <div class="flex items-start justify-between gap-4">

                            <div>

                                <h1 class="text-lg font-bold text-[#504E76]">

                                    {{ $notification->title }}

                                </h1>

                                <p class="text-sm text-[#504E76]/70 mt-2 leading-relaxed">

                                    {{ $notification->message }}

                                </p>

                            </div>

                            <span class="text-xs text-[#504E76]/50 whitespace-nowrap">

                                {{ $notification->created_at->diffForHumans() }}

                            </span>

                        </div>

                    </div>

                @endforeach

            </div>

        </main>

    </div>

</body>

</html>