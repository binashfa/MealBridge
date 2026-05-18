<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">

    <meta name="viewport"
        content="width=device-width, initial-scale=1.0">

    <title>Donate Food</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <link
        href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css'
        rel='stylesheet'>
</head>

<body class="bg-gradient-to-br from-[#FDF8E2] to-[#C4C3E3] h-screen overflow-hidden">

    <div class="flex h-screen">

        <!-- SIDEBAR -->
        @include('supplier.sidebar')

        <!-- MAIN -->
        <main class="flex-1 overflow-hidden px-8 py-5 pt-16">

            <!-- HEADER -->
            <div class="flex items-center gap-4 mb-5">

                <div class="w-14 h-14 rounded-2xl
                    bg-[#504E76] text-white
                    flex items-center justify-center shadow-xl">

                    <i class='bx bx-donate-heart text-2xl'></i>

                </div>

                <div>

                    <h1 class="text-3xl font-black text-[#504E76]">
                        Donate Food
                    </h1>

                    <p class="text-sm text-[#504E76]/70">
                        Share your extra food with communities in need
                    </p>

                </div>

            </div>

            <!-- SUCCESS -->
            @if(session('success'))

            <div class="mb-4 bg-green-100
                border border-green-300
                text-green-700 px-4 py-3
                rounded-2xl text-sm">

                {{ session('success') }}

            </div>

            @endif

            <!-- FORM -->
            <div class="bg-white/30 backdrop-blur-2xl
                border border-white/20
                rounded-3xl p-6 shadow-2xl">

                <form
                    action="/donate"
                    method="POST"
                    enctype="multipart/form-data"

                    class="grid grid-cols-2 gap-4">

                    @csrf

                    <!-- FOOD NAME -->
                    <div>

                        <label class="block text-sm
                            font-semibold text-[#504E76] mb-2">

                            Food Name

                        </label>

                        <input
                            type="text"
                            name="food_name"
                            placeholder="Bread, Rice Box"

                            class="w-full p-3 rounded-2xl
                            bg-white/70 border border-white/30
                            focus:outline-none text-sm">

                    </div>

                    <!-- CATEGORY -->
                    <div>

                        <label class="block text-sm
                            font-semibold text-[#504E76] mb-2">

                            Food Category

                        </label>

                        <select
                            name="category"

                            class="w-full p-3 rounded-2xl
                            bg-white/70 border border-white/30
                            focus:outline-none text-sm">

                            <option value="Rice">
                                Rice
                            </option>

                            <option value="Bread">
                                Bread
                            </option>

                            <option value="Snack">
                                Snack
                            </option>

                            <option value="Drink">
                                Drink
                            </option>

                        </select>

                    </div>

                    <!-- QUANTITY -->
                    <div>

                        <label class="block text-sm
                            font-semibold text-[#504E76] mb-2">

                            Quantity

                        </label>

                        <input
                            type="number"
                            name="quantity"
                            placeholder="Total quantity"

                            class="w-full p-3 rounded-2xl
                            bg-white/70 border border-white/30
                            focus:outline-none text-sm">

                    </div>

                    <!-- EXPIRED -->
                    <div>

                        <label class="block text-sm
                            font-semibold text-[#504E76] mb-2">

                            Estimated Consumption

                        </label>

                        <input
                            type="date"
                            name="expired_date"

                            class="w-full p-3 rounded-2xl
                            bg-white/70 border border-white/30
                            focus:outline-none text-sm">

                    </div>

                    <!-- LOCATION -->
                    <div>

                        <label class="block text-sm
                            font-semibold text-[#504E76] mb-2">

                            Pickup Location

                        </label>

                        <input
                            type="text"
                            name="pickup_location"
                            placeholder="Pickup location"

                            class="w-full p-3 rounded-2xl
                            bg-white/70 border border-white/30
                            focus:outline-none text-sm">

                    </div>

                    <!-- PICKUP TIME -->
                    <div>

                        <label class="block text-sm
                            font-semibold text-[#504E76] mb-2">

                            Pickup Time

                        </label>

                        <input
                            type="datetime-local"
                            name="pickup_time"

                            class="w-full p-3 rounded-2xl
                            bg-white/70 border border-white/30
                            focus:outline-none text-sm">

                    </div>

                    <!-- PHOTO -->
                    <div>

                        <label class="block text-sm
                            font-semibold text-[#504E76] mb-2">

                            Food Photo

                        </label>

                        <input
                            type="file"
                            name="food_photo"

                            class="w-full p-3 rounded-2xl
                            bg-white/70 border border-white/30
                            text-sm">

                    </div>

                    <!-- DESCRIPTION -->
                    <div>

                        <label class="block text-sm
                            font-semibold text-[#504E76] mb-2">

                            Description

                        </label>

                        <textarea
                            name="description"
                            rows="4"
                            placeholder="Food details..."

                            class="w-full p-3 rounded-2xl
                            bg-white/70 border border-white/30
                            focus:outline-none resize-none text-sm"></textarea>

                    </div>

                    <!-- BUTTON -->
                    <div class="col-span-2 pt-1">

                        <button
                            type="submit"

                            class="w-full bg-[#504E76]
                            hover:bg-[#F1642E]
                            transition-all duration-300
                            text-white font-bold py-4
                            rounded-2xl shadow-xl">

                            Donate Now

                        </button>

                    </div>

                </form>

            </div>

        </main>

    </div>

</body>

</html>