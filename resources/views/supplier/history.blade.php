<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">

    <meta name="viewport"
        content="width=device-width, initial-scale=1.0">

    <title>Donation History</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <link
        href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css'
        rel='stylesheet'>
</head>

<body class="bg-gradient-to-br from-[#FDF8E2] to-[#C4C3E3] min-h-screen">

    <div class="flex min-h-screen">

        @include('supplier.sidebar')

        <main class="flex-1 overflow-y-auto px-6 py-5">

            <!-- HEADER -->
            <div class="flex items-center justify-between mb-5">

                <!-- LEFT -->
                <div class="flex items-center gap-3">

                    <div class="w-12 h-12 rounded-2xl
        bg-[#504E76]
        text-white
        flex items-center justify-center shadow-lg">

                        <i class='bx bx-history text-2xl'></i>

                    </div>

                    <div>

                        <h1 class="text-[20px] font-black text-[#504E76]">

                            Donation History

                        </h1>

                        <p class="text-[10px] text-[#504E76]/70">

                            Track your donation activities

                        </p>

                    </div>

                </div>

                <!-- RIGHT -->
                <div>

                    {{ $histories->links() }}

                </div>

            </div>

            <!-- LIST -->
            <!-- LIST -->
            <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6">

                @foreach($histories as $history)

                <div class="bg-white/30 backdrop-blur-2xl border border-white/20 rounded-[24px] p-3 shadow-lg">

                    <!-- IMAGE -->
                    <img
                        src="{{ asset($history->food_photo) }}"
                        onerror="this.src='https://placehold.co/600x400?text=No+Image'"
                        class="w-full h-[100px] object-cover rounded-2xl">

                    <!-- TOP -->
                    <div class="mt-3">

                        <div class="flex items-start justify-between gap-2">

                            <h1 class="text-[14px] font-black text-[#504E76] leading-tight">

                                {{ $history->food_name }}

                            </h1>

                        </div>

                        <!-- DATE -->
                        <p class="text-[9px] text-[#504E76]/60 mt-1">

                            {{ $history->created_at->format('d M Y • H:i') }}

                        </p>

                    </div>
                    <!-- INFO -->
                    <div class="mt-3 space-y-3">

                        <!-- ROW -->
                        <div class="flex justify-between gap-2">

                            <div>

                                <p class="text-[8px] text-[#504E76]/50">
                                    Total Qty
                                </p>

                                <h1 class="font-bold text-[#504E76] text-[10px] mt-1">

                                    {{ $history->quantity }}

                                </h1>

                            </div>

                            <div>

                                <p class="text-[8px] text-[#504E76]/50">
                                    Remaining
                                </p>

                                <h1 class="font-bold text-[#504E76] text-[10px] mt-1">

                                    {{ $history->remaining_quantity }}

                                </h1>

                            </div>

                            <div class="text-right">

                                <p class="text-[8px] text-[#504E76]/50">
                                    Expired
                                </p>

                                <h1 class="font-bold text-[#504E76] text-[10px] mt-1">

                                    {{ $history->expired_date }}

                                </h1>

                            </div>

                        </div>

                        <!-- CLAIMS -->
                        @foreach($history->claims as $claim)

                        <div class="bg-white/40 rounded-2xl p-3">

                            <!-- TOP -->
                            <div class="flex items-center justify-between">

                                <div>

                                    <p class="text-[8px] text-[#504E76]/50">
                                        Community
                                    </p>

                                    <h1 class="font-bold text-[#504E76] text-[11px]">

                                        {{ $claim->community->nama_komunitas }}

                                    </h1>

                                </div>

                                <!-- STATUS -->
                                <div class="
                px-2 py-1 rounded-lg
                text-[8px]
                font-semibold

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

                                </div>

                            </div>

                            <!-- CLAIM INFO -->
                            <div class="mt-2 flex justify-between items-center">

                                <div>

                                    <p class="text-[8px] text-[#504E76]/50">
                                        Claimed
                                    </p>

                                    <h1 class="font-bold text-[#504E76] text-[10px]">

                                        {{ $claim->claimed_quantity }} portions

                                    </h1>

                                </div>

                                <!-- ACCEPT -->
                                @if($claim->status == 'requested')

                                <form
                                    action="/approve-donation/{{ $claim->id }}"
                                    method="POST">

                                    @csrf

                                    <button
                                        class="bg-[#A3B565]
        hover:bg-[#8ea14f]
        transition-all duration-300
        text-white
        px-4 py-2
        rounded-xl
        text-[9px]
        font-semibold">

                                        Accept

                                    </button>

                                </form>

                                @elseif($claim->status == 'approved')

                                <button
                                    onclick="openModal('{{ $claim->id }}')"

                                    class="bg-[#504E76]
    hover:bg-[#F1642E]
    transition-all duration-300
    text-white
    px-4 py-2
    rounded-xl
    text-[9px]
    font-semibold">

                                    Send

                                </button>

                                @elseif($claim->status == 'distribution')

                                <p class="text-[9px] text-purple-600 font-semibold">

                                    Waiting Confirmation

                                </p>

                                @elseif($claim->status == 'completed')

                                <p class="text-[9px] text-green-600 font-semibold">

                                    Completed

                                </p>

                                @endif

                            </div>

                        </div>

                        @endforeach

                    </div>

                    <!-- BUTTON -->
                    <div class="mt-3">

                        <a
                            href="https://www.google.com/maps/search/?api=1&query={{ urlencode($history->pickup_location) }}"
                            target="_blank"

                            class="w-full
        bg-[#504E76]
        hover:bg-[#F1642E]
        transition-all duration-300
        text-white
        py-2 rounded-xl
        flex items-center justify-center gap-1
        text-[9px] font-semibold">

                            <i class='bx bx-map text-xs'></i>

                            Maps

                        </a>

                    </div>

                </div>

                @endforeach

            </div>
        </main>

    </div>

    @foreach($histories as $history)

    @foreach($history->claims as $claim)

    <div
        id="modal-{{ $claim->id }}"

        class="hidden fixed inset-0
        bg-black/40 backdrop-blur-sm
        z-50 flex items-center justify-center px-4">

        <div class="bg-white rounded-3xl
        p-6 w-full max-w-[400px]
        shadow-2xl">

            <div class="flex items-center justify-between mb-5">

                <h1 class="text-xl font-black text-[#504E76]">

                    Distribution Proof

                </h1>

                <button
                    type="button"

                    onclick="closeModal('{{ $claim->id }}')"

                    class="text-3xl text-[#504E76] leading-none">

                    &times;

                </button>

            </div>

            <form
                action="/send-distribution/{{ $claim->id }}"
                method="POST"
                enctype="multipart/form-data">

                @csrf

                <!-- DELIVERY DATE -->
                <div class="mb-3">

                    <label class="block text-sm font-semibold text-[#504E76] mb-2">

                        Delivery Date

                    </label>

                    <input
                        type="datetime-local"
                        name="delivery_date"
                        required

                        class="w-full bg-white/60
            border border-white/30
            rounded-2xl
            px-4 py-3
            text-sm text-[#504E76]">
                </div>

                <!-- COURIER NAME -->
                <div class="mb-3">

                    <label class="block text-sm font-semibold text-[#504E76] mb-2">

                        Courier Name

                    </label>

                    <input
                        type="text"
                        name="courier_name"
                        required

                        placeholder="Input courier name"

                        class="w-full bg-white/60
            border border-white/30
            rounded-2xl
            px-4 py-3
            text-sm text-[#504E76]">
                </div>

                <!-- COURIER PHONE -->
                <div class="mb-3">

                    <label class="block text-sm font-semibold text-[#504E76] mb-2">

                        Courier Phone

                    </label>

                    <input
                        type="text"
                        name="courier_phone"
                        required

                        placeholder="08xxxxxxxxxx"

                        class="w-full bg-white/60
            border border-white/30
            rounded-2xl
            px-4 py-3
            text-sm text-[#504E76]">
                </div>

                <!-- PHOTO -->
                <div class="mb-4">

                    <label class="block text-sm font-semibold text-[#504E76] mb-2">

                        Distribution Proof Photo

                    </label>

                    <input
                        type="file"
                        name="supplier_proof_photo"
                        required

                        class="w-full bg-white/60
            border border-white/30
            rounded-2xl
            px-4 py-3
            text-sm text-[#504E76]">
                </div>

                <!-- BUTTON -->
                <button
                    type="submit"

                    class="w-full
        bg-[#504E76]
        hover:bg-[#F1642E]
        transition-all duration-300
        text-white py-3
        rounded-2xl
        font-semibold text-sm">

                    Start Distribution

                </button>

            </form>

        </div>

    </div>

    @endforeach

    @endforeach

    @if($history->status == 'distribution')

    <div class="mt-3 bg-white/40 rounded-2xl p-3">

        <p class="text-[10px] text-[#504E76]/50">
            Courier
        </p>

        <h1 class="font-bold text-[#504E76] text-xs">

            {{ $history->courier_name }}

        </h1>

        <p class="text-[10px] text-[#504E76]/50 mt-2">
            Phone
        </p>

        <h1 class="font-bold text-[#504E76] text-xs">

            {{ $history->courier_phone }}

        </h1>

        <p class="text-[10px] text-[#504E76]/50 mt-2">
            Delivery Date
        </p>

        <h1 class="font-bold text-[#504E76] text-xs">

            {{ $history->delivery_date }}

        </h1>

    </div>

    @endif

    <script>
        function openModal(id) {
            document
                .getElementById(`modal-${id}`)
                .classList.remove('hidden')
        }

        function closeModal(id) {
            document
                .getElementById(`modal-${id}`)
                .classList.add('hidden')
        }
    </script>

</body>

</html>