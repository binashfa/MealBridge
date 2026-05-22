<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">

    <meta name="viewport"
        content="width=device-width, initial-scale=1.0">

    <title>Donate Food</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <!-- LEAFLET CSS -->
    <link
        rel="stylesheet"
        href="https://unpkg.com/leaflet/dist/leaflet.css" />


    <link
        href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css'
        rel='stylesheet'>
</head>

<body class="bg-gradient-to-br from-[#FDF8E2] to-[#C4C3E3] h-screen overflow-hidden">

    <div class="flex h-screen">

        <!-- SIDEBAR -->
        @include('supplier.sidebar')

        <!-- MAIN -->
        <main class="flex-1 overflow-hidden px-8 py-5 pt-8">

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

                    class="grid grid-cols-2 gap-x-4 gap-y-2">

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
                            type="datetime-local"
                            name="expired_date"

                            class="w-full p-3 rounded-2xl
                            bg-white/70 border border-white/30
                            focus:outline-none text-sm">

                    </div>

                    <!-- LOCATION INPUT -->
                    <div>

                        <label class="block text-sm
        font-semibold text-[#504E76] mb-2">

                            Pickup Location

                        </label>

                        <div class="flex gap-2">

                            <input
                                type="text"
                                id="pickup_location"
                                name="pickup_location"
                                placeholder="Getting your location..."

                                class="w-full p-3 rounded-2xl
            bg-white/70 border border-white/30
            focus:outline-none text-sm">

                            <!-- BUTTON -->
                            <button
                                type="button"
                                onclick="getLocation()"

                                class="px-4 rounded-2xl
            bg-[#504E76]
            hover:bg-[#F1642E]
            transition-all duration-300
            text-white">

                                <i class='bx bx-current-location'></i>

                            </button>

                        </div>

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

                    <!-- BOTTOM SECTION -->
                    <div class="col-span-2 grid grid-cols-2 gap-5">

                        <!-- MAP -->
                        <div>

                            <div
                                id="map"
                                class="w-full h-[230px]
            rounded-3xl overflow-hidden shadow-lg">
                            </div>

                        </div>

                        <!-- RIGHT SIDE -->
                        <div class="flex flex-col justify-between h-[250px]">

                            <!-- FOOD PHOTO -->
                            <div>

                                <label class="block text-sm font-semibold text-[#504E76] mb-2">

                                    Food Photo

                                </label>

                                <label
                                    class="w-full h-[60px]
                                        bg-white/70 border border-white/30
                                        rounded-2xl flex items-center px-4
                                        cursor-pointer hover:bg-white/90
                                        transition-all duration-300">

                                    <i class='bx bx-image-add
                                        text-2xl text-[#504E76] mr-3'></i>

                                    <!-- FILE NAME -->
                                    <span
                                        id="file-name"
                                        class="text-sm text-[#504E76]/70 truncate">

                                        Upload food image

                                    </span>

                                    <input
                                        type="file"
                                        name="food_photo"
                                        class="hidden"

                                        onchange="
                                            document.getElementById('file-name')
                                            .innerText = this.files[0].name
                                        ">

                                </label>

                            </div>

                            <!-- DESCRIPTION -->
                            <div class="mt-4 flex-1">

                                <label class="block text-sm
            font-semibold text-[#504E76] mb-2">

                                    Description

                                </label>

                                <textarea
                                    name="description"
                                    placeholder="Food details..."

                                    class="w-full h-[90px]
                                    p-4 rounded-2xl
                                    bg-white/70
                                    border border-white/30
                                    focus:outline-none
                                    text-sm resize-none"></textarea>

                            </div>

                        </div>

                    </div>

                    <!-- BUTTON -->
                    <div class="col-span-2">

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

    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

    <script>
        // DEFAULT MAP
        let map = L.map('map').setView([-6.2088, 106.8456], 13);

        // TILE
        L.tileLayer(
            'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; OpenStreetMap'
            }
        ).addTo(map);

        // MARKER
        let marker;

        // GET LOCATION
        function getLocation() {

            if (navigator.geolocation) {

                navigator.geolocation.getCurrentPosition(

                    async function(position) {

                            let lat = position.coords.latitude;
                            let lng = position.coords.longitude;

                            // MOVE MAP
                            map.setView([lat, lng], 16);

                            // REMOVE OLD MARKER
                            if (marker) {
                                map.removeLayer(marker);
                            }

                            // ADD NEW MARKER
                            marker = L.marker([lat, lng])
                                .addTo(map);

                            // GET ADDRESS
                            let response = await fetch(

                                `https://nominatim.openstreetmap.org/reverse?format=json&lat=${lat}&lon=${lng}`

                            );

                            let data = await response.json();

                            // INPUT VALUE
                            document.getElementById(
                                'pickup_location'
                            ).value = data.display_name;

                        },

                        function(error) {

                            alert(
                                "Location access denied."
                            );

                        }
                );

            } else {

                alert(
                    "Geolocation is not supported."
                );
            }
        }

        // AUTO LOAD LOCATION
        getLocation();
    </script>

</body>

</html>