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

</head>

<body class="bg-gradient-to-br
from-[#FDF8E2]
to-[#C4C3E3]
min-h-screen overflow-hidden">

    <div class="flex h-screen">

        @include('community.sidebar')

        <!-- MAIN -->
        <main class="flex-1 overflow-y-auto p-6">

            <!-- HEADER -->
            <div class="flex items-end justify-between mb-5">

                <!-- LEFT -->
                <div class="flex items-center gap-3">

                    <!-- ICON -->
                    <div class="w-12 h-12 rounded-2xl
        bg-[#504E76]
        text-white
        flex items-center justify-center shadow-lg">

                        <i class='bx bx-food-menu text-2xl'></i>

                    </div>

                    <!-- TEXT -->
                    <div>

                        <h1 class="text-[28px] font-black text-[#504E76] leading-none">

                            Available Donations

                        </h1>

                        <p class="text-[#504E76]/70 mt-1 text-[12px]">

                            Nearby food donations ready for pickup

                        </p>

                    </div>

                </div>

                <!-- PAGINATION -->
                <div>

                    {{ $donations->links() }}

                </div>

            </div>

            @if(session('error'))

            <div class="mb-4 bg-red-100
border border-red-300
text-red-700 px-4 py-3
rounded-2xl text-sm">

                {{ session('error') }}

            </div>

            @endif


            @if(session('success'))

            <div class="mb-4 bg-green-100
border border-green-300
text-green-700 px-4 py-3
rounded-2xl text-sm">

                {{ session('success') }}

            </div>

            @endif

            <!-- GRID -->
            <div class="grid grid-cols-4 gap-3">

                @foreach($donations as $donation)

                <!-- CARD -->
                <div class="bg-white/30
        rounded-[28px]
        p-3
        shadow-sm
        border border-gray-100">

                    <!-- TOP -->
                    <div class="flex gap-3">

                        <!-- IMAGE -->
                        <img
                            src="{{ asset('storage/' . $donation->food_photo) }}"

                            class="w-[72px] h-[72px]
                    object-cover rounded-2xl shrink-0">

                        <!-- CONTENT -->
                        <div class="flex-1 min-w-0">

                            <!-- TITLE -->
                            <div class="flex items-start justify-between gap-2">

                                <div class="min-w-0">

                                    <h1 class="text-[15px]
                            font-black
                            text-[#2F2F2F]
                            leading-tight truncate">

                                        {{ $donation->food_name }}

                                    </h1>

                                    <p class="text-[10px]
                            text-gray-400 mt-1 truncate">

                                        {{ $donation->pickup_location }}

                                    </p>

                                </div>

                            </div>

                            <!-- INFO -->
                            <div class="mt-2 space-y-[2px]">

                                <p class="text-[11px] text-gray-500 truncate">

                                    {{ $donation->supplier->nama_toko ?? 'Unknown Supplier' }}

                                </p>

                                <p class="text-[14px]
                        font-black text-[#A3B565]">

                                    {{ $donation->remaining_quantity }} portions left

                                </p>

                                <p class="text-[10px] text-gray-400">

                                    Exp:
                                    {{ \Carbon\Carbon::parse($donation->expired_date)->format('d M Y') }}

                                </p>

                            </div>

                        </div>

                    </div>

                    <!-- BUTTON -->
                    <form
                        action="/claim-donation/{{ $donation->id }}"
                        method="POST"
                        class="mt-4">

                        @csrf

                        <!-- CLAIM QUANTITY -->
                        <input
                            type="number"
                            name="claim_quantity"

                            min="1"
                            max="{{ $donation->remaining_quantity }}"

                            placeholder="How many portions?"

                            required

                            class="w-full mb-3 px-4 py-3 rounded-2xl bg-white/70 border border-white/30 focus:outline-none focus:ring-2 focus:ring-[#504E76]/30 text-sm">

                        <button
                            class="w-full bg-[#504E76] hover:bg-[#F1642E] transition-all duration-300 text-white py-3 rounded-2xl text-sm font-semibold">

                            Claim Pickup

                        </button>

                    </form>

                </div>

                @endforeach

            </div>



        </main>

    </div>

</body>

</html>