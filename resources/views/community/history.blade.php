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

<body class="bg-gradient-to-br from-[#FDF8E2] to-[#C4C3E3] min-h-screen overflow-hidden">

    <div class="flex h-screen">

        @include('community.sidebar')

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

                        <h1 class="text-3xl font-black text-[#504E76]">

                            Donation History

                        </h1>

                        <p class="text-sm text-[#504E76]/70">

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
            <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6">

                @foreach($histories as $history)

                <div class="bg-white/30
                    backdrop-blur-2xl
                    border border-white/20
                    rounded-3xl
                    p-3
                    shadow-xl">

                    <!-- IMAGE -->
                    <img
                        src="{{ asset($history->donation->food_photo) }}"
                        class="w-full h-[120px]
                        object-cover rounded-2xl">

                    <!-- TOP -->
                    <div class="mt-3">

                        <div class="flex items-start justify-between gap-2">

                            <h1 class="text-lg font-black text-[#504E76] leading-tight">

                                {{ $history->donation->food_name }}

                            </h1>

                            <!-- STATUS -->
                            <div class="
                            px-2 py-1 rounded-xl
                            text-[10px] font-semibold whitespace-nowrap

                            @if($history->status == 'requested')
                                bg-yellow-100 text-yellow-700
                            @elseif($history->status == 'distribution')
                                bg-blue-100 text-blue-700
                            @elseif($history->status == 'completed')
                                bg-green-100 text-green-700
                            @endif
                            ">

                                {{ ucfirst($history->status) }}

                            </div>

                        </div>

                        <!-- DATE -->
                        <p class="text-[11px] text-[#504E76]/60 mt-1">

                            {{ $history->created_at->format('d M Y • H:i') }}

                        </p>

                    </div>

                    <!-- INFO -->
                    <div class="mt-4 space-y-3">

                        <!-- ROW 1 -->
                        <div class="flex justify-between gap-3">

                            <div>

                                <p class="text-[10px] text-[#504E76]/50">

                                    Quantity

                                </p>

                                <h1 class="font-bold text-[#504E76] text-xs mt-1">

                                    {{ $history->claimed_quantity }}

                                </h1>

                            </div>

                            <div>

                                <p class="text-[10px] text-[#504E76]/50">

                                    Supplier

                                </p>

                                <h1 class="font-bold text-[#504E76] text-xs mt-1">

                                    {{ $history->donation->supplier->nama_toko ?? '-' }}

                                </h1>

                            </div>

                            <div class="text-right">

                                <p class="text-[10px] text-[#504E76]/50">

                                    Expired

                                </p>

                                <h1 class="font-bold text-[#504E76] text-xs mt-1">

                                    {{ $history->donation->expired_date }}

                                </h1>

                            </div>

                        </div>

                        <!-- ROW 2 -->
                        <div class="flex justify-between gap-3">

                            <div>

                                <p class="text-[10px] text-[#504E76]/50">

                                    Pickup

                                </p>

                                <h1 class="font-bold text-[#504E76] text-xs mt-1">

                                    {{ $history->donation->pickup_time }}

                                </h1>

                            </div>

                            <div class="text-right max-w-[150px]">

                                <p class="text-[10px] text-[#504E76]/50">

                                    Pickup Location

                                </p>

                                <h1 class="font-bold text-[#504E76] text-xs mt-1 truncate">

                                    {{ $history->donation->pickup_location }}

                                </h1>

                            </div>

                        </div>

                        

                    </div>

                    <!-- BUTTONS -->
                    <div class="flex gap-2 mt-4">

                        <!-- MAP -->
                        <a
                            href="https://www.google.com/maps/search/?api=1&query={{ urlencode($history->donation->pickup_location) }}"

                            target="_blank"

                            class="
                            {{ $history->status == 'distribution' ? 'w-1/2' : 'w-full' }}

                            bg-[#504E76]
                            hover:bg-[#F1642E]
                            transition-all duration-300
                            text-white
                            py-2 rounded-2xl
                            flex items-center justify-center gap-1
                            text-xs font-semibold">

                            <i class='bx bx-map'></i>

                            Maps

                        </a>

                        <!-- RECEIVE -->
                        @if($history->status == 'distribution')

                        <button
                            onclick="openDetailModal('{{ $history->id }}')"

                            class="w-1/2 bg-[#A3B565] hover:bg-[#8ea14f] transition-all duration-300 text-white py-2 rounded-2xl text-xs font-semibold">

                            Detail

                        </button>

                        @endif

                    </div>

                </div>

                @endforeach

            </div>


            <!-- MODALS -->
            @foreach($histories as $history)

            <div
                id="modal-{{ $history->id }}"

                class="hidden fixed inset-0
            bg-black/40 backdrop-blur-sm
            z-50 flex items-center justify-center px-4">

                <div class="bg-white rounded-3xl
            p-6 w-full max-w-[400px]
            shadow-2xl">

                    <!-- HEADER -->
                    <div class="flex items-center justify-between mb-5">

                        <h1 class="text-xl font-black text-[#504E76]">

                            Confirm Donation

                        </h1>

                        <button
                            type="button"

                            onclick="closeModal('{{ $history->id }}')"

                            class="text-3xl text-[#504E76] leading-none">

                            &times;

                        </button>

                    </div>

                    <!-- FORM -->
                    <form
                        action="/complete-donation/{{ $history->id }}"
                        method="POST"
                        enctype="multipart/form-data">

                        @csrf

                        <!-- INFO -->
                        <div class="space-y-3">

                            <div>

                                <p class="text-xs text-[#504E76]/60">

                                    Food Name

                                </p>

                                <h1 class="font-bold text-[#504E76] text-base">

                                    {{ $history->donation->food_name }}

                                </h1>

                            </div>

                            <div>

                                <p class="text-xs text-[#504E76]/60">

                                    Supplier

                                </p>

                                <h1 class="font-bold text-[#504E76] text-base">

                                    {{ $history->donation->supplier->nama_toko ?? '-' }}

                                </h1>

                            </div>

                            <div>

                                <p class="text-xs text-[#504E76]/60">

                                    Quantity

                                </p>

                                <h1 class="font-bold text-[#504E76] text-base">

                                    {{ $history->claimed_quantity }}

                                </h1>

                            </div>

                        </div>

                        <!-- PROOF PHOTO -->
                        <div class="mt-5">

                            <label class="block text-sm font-semibold text-[#504E76] mb-2">

                                Upload Proof Photo

                            </label>

                            <input
                                type="file"
                                name="proof_photo"
                                required

                                class="w-full bg-white/60
                            border border-white/30
                            rounded-2xl
                            px-4 py-3
                            text-sm text-[#504E76]

                            file:mr-3
                            file:py-2
                            file:px-3
                            file:rounded-xl
                            file:border-0
                            file:bg-[#504E76]
                            file:text-white
                            file:cursor-pointer">
                        </div>

                        <!-- ACTION -->
                        <div class="flex gap-3 mt-6">

                            <!-- CANCEL -->
                            <button
                                type="button"

                                onclick="closeModal('{{ $history->id }}')"

                                class="flex-1 bg-gray-200
                            hover:bg-gray-300
                            transition-all duration-300
                            py-3 rounded-2xl
                            font-semibold text-[#504E76] text-sm">

                                Cancel

                            </button>

                            <!-- CONFIRM -->
                            <button
                                type="submit"

                                class="flex-1 bg-[#504E76]
                            hover:bg-[#F1642E]
                            transition-all duration-300
                            text-white py-3
                            rounded-2xl
                            font-semibold text-sm">

                                Confirm

                            </button>

                        </div>

                    </form>

                </div>

            </div>

            @endforeach

            @foreach($histories as $history)

            <div
                id="detail-modal-{{ $history->id }}"

                class="hidden fixed inset-0
    bg-black/40 backdrop-blur-sm
    z-50 flex items-center justify-center px-4">

                <div class="bg-white rounded-3xl
    p-6 w-full max-w-[420px]
    shadow-2xl">

                    <!-- HEADER -->
                    <div class="flex items-center justify-between mb-5">

                        <h1 class="text-xl font-black text-[#504E76]">

                            Distribution Detail

                        </h1>

                        <button
                            type="button"

                            onclick="closeDetailModal('{{ $history->id }}')"

                            class="text-3xl text-[#504E76] leading-none">

                            &times;

                        </button>

                    </div>

                    <!-- INFO -->
                    <div class="space-y-4">

                        <div>

                            <p class="text-xs text-[#504E76]/60">

                                Courier

                            </p>

                            <h1 class="font-bold text-[#504E76]">

                                {{ $history->courier_name }}

                            </h1>

                        </div>

                        <div>

                            <p class="text-xs text-[#504E76]/60">

                                Phone

                            </p>

                            <h1 class="font-bold text-[#504E76]">

                                {{ $history->courier_phone }}

                            </h1>

                        </div>

                        <div>

                            <p class="text-xs text-[#504E76]/60">

                                Delivery Date

                            </p>

                            <h1 class="font-bold text-[#504E76]">

                                {{ $history->delivery_date }}

                            </h1>

                        </div>

                        @if($history->supplier_proof_photo)

                        <img
                            src="{{ asset($history->supplier_proof_photo) }}"

                            class="w-full h-[180px]
                object-cover rounded-2xl">

                        @endif

                    </div>

                    <!-- BUTTON -->
                    <div class="flex gap-3 mt-6">

                        <button
                            type="button"

                            onclick="closeDetailModal('{{ $history->id }}')"

                            class="flex-1 bg-gray-200
                hover:bg-gray-300
                transition-all duration-300
                py-3 rounded-2xl
                font-semibold text-[#504E76] text-sm">

                            Close

                        </button>

                        <!-- RECEIVE -->
                        <button
                            onclick="
                    closeDetailModal('{{ $history->id }}');
                    openModal('{{ $history->id }}');
                "

                            class="flex-1 bg-[#504E76]
                hover:bg-[#F1642E]
                transition-all duration-300
                text-white py-3
                rounded-2xl
                font-semibold text-sm">

                            Receive

                        </button>

                    </div>

                </div>

            </div>

            @endforeach


        </main>

    </div>

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

        function openDetailModal(id) {

            document
                .getElementById(`detail-modal-${id}`)
                .classList.remove('hidden')
        }

        function closeDetailModal(id) {

            document
                .getElementById(`detail-modal-${id}`)
                .classList.add('hidden')
        }
    </script>

</body>

</html>