<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Donate Food – MealBridge</title>

    <!-- Tailwind -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Boxicons -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    <!-- Leaflet -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />

    <!-- Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">

    <style>
        * {
            scroll-behavior: smooth;
        }

        body {
            font-family: 'Poppins', sans-serif;
            overflow-x: hidden;
        }

        .glass {
            background: rgba(255, 255, 255, .35);
            backdrop-filter: blur(18px);
            -webkit-backdrop-filter: blur(18px);
            border: 1px solid rgba(255, 255, 255, .25);
        }

        .soft-shadow {
            box-shadow:
                0 12px 35px rgba(80, 78, 118, .10),
                0 5px 10px rgba(0, 0, 0, .03);
        }

        .smooth-card {
            transition: .35s ease;
        }

        .smooth-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 25px 40px rgba(80, 78, 118, .16);
        }

        .btn-hover {
            transition: .3s ease;
        }

        .btn-hover:hover {
            transform: scale(1.02);
            box-shadow: 0 15px 30px rgba(80, 78, 118, .20);
        }

        .btn-hover:active {
            transform: scale(.97);
        }

        .floating {
            animation: floating 4s ease-in-out infinite;
        }

        @keyframes floating {

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-8px);
            }
        }

        .gradient-text {
            background: linear-gradient(135deg, #504E76, #6E6AB3, #E8C067);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .input-style {
            width: 100%;
            padding: 14px 18px 14px 46px;
            border-radius: 18px;
            background: rgba(255, 255, 255, .75);
            border: 1.5px solid rgba(255, 255, 255, .45);
            outline: none;
            font-size: 14px;
            color: #504E76;
            transition: .3s ease;
        }

        .input-style:focus {
            border-color: #504E76;
            background: white;
            transform: translateY(-2px);
            box-shadow:
                0 0 0 4px rgba(80, 78, 118, .10),
                0 10px 20px rgba(80, 78, 118, .08);
        }

        .input-wrap {
            position: relative;
        }

        .input-icon {
            position: absolute;
            top: 50%;
            left: 16px;
            transform: translateY(-50%);
            color: rgba(80, 78, 118, .45);
            font-size: 18px;
        }

        .section-title {
            font-size: 11px;
            font-weight: 800;
            letter-spacing: 3px;
            text-transform: uppercase;
            color: rgba(80, 78, 118, .45);
            margin-bottom: 16px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .section-title::after {
            content: '';
            flex: 1;
            height: 1px;
            background: rgba(80, 78, 118, .12);
        }

        .field-label {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 13px;
            font-weight: 700;
            color: #504E76;
            margin-bottom: 10px;
        }

        .label-dot {
            width: 6px;
            height: 6px;
            border-radius: 999px;
            background: linear-gradient(135deg, #504E76, #E8C067);
        }

        .cat-chip {
            flex: 1;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 6px;
            padding: 12px 10px;
            border-radius: 18px;
            border: 1.5px solid rgba(80, 78, 118, .12);
            background: rgba(255, 255, 255, .5);
            cursor: pointer;
            transition: .25s ease;
        }

        .cat-chip:hover {
            transform: translateY(-3px);
            border-color: #504E76;
            background: rgba(80, 78, 118, .05);
        }

        .cat-chip.active {
            background: #504E76;
            border-color: #504E76;
        }

        .cat-chip.active i,
        .cat-chip.active span {
            color: white;
        }

        .cat-chip span {
            font-size: 11px;
            font-weight: 700;
            color: #504E76;
        }

        .photo-upload {
            border: 2px dashed rgba(80, 78, 118, .18);
            border-radius: 24px;
            background: rgba(255, 255, 255, .40);
            transition: .3s ease;
            cursor: pointer;
            overflow: hidden;
        }

        .photo-upload:hover {
            transform: translateY(-4px);
            border-color: #504E76;
            background: rgba(80, 78, 118, .05);
        }

        .photo-preview {
            display: none;
            width: 100%;
            height: 180px;
            object-fit: cover;
        }

        #map {
            width: 100%;
            height: 220px;
            border-radius: 20px;
        }

        .fade-up {
            animation: fadeUp .5s cubic-bezier(.22, .68, 0, 1.1) both;
        }

        @keyframes fadeUp {
            from {
                opacity: 0;
                transform: translateY(18px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .d1 {
            animation-delay: .05s;
        }

        .d2 {
            animation-delay: .10s;
        }

        .d3 {
            animation-delay: .15s;
        }

        .d4 {
            animation-delay: .20s;
        }

        .bg-glow-1 {
            position: fixed;
            top: -120px;
            right: -120px;
            width: 320px;
            height: 320px;
            background: rgba(232, 192, 103, .25);
            border-radius: 999px;
            filter: blur(80px);
            pointer-events: none;
        }

        .bg-glow-2 {
            position: fixed;
            bottom: -120px;
            left: -120px;
            width: 320px;
            height: 320px;
            background: rgba(110, 106, 179, .25);
            border-radius: 999px;
            filter: blur(90px);
            pointer-events: none;
        }
    </style>

</head>

<body class="bg-gradient-to-br from-[#FDF8E2] to-[#C4C3E3] min-h-screen overflow-x-hidden">

    <div class="bg-glow-1"></div>
    <div class="bg-glow-2"></div>

    <div class="flex min-h-screen relative z-10">

        @include('supplier.sidebar')

        <!-- MAIN -->
        <main class="flex-1 overflow-y-auto px-4 sm:px-6 lg:px-8 py-6 lg:py-8">

            <!-- HEADER -->
            <div class="flex flex-col lg:flex-row justify-between lg:items-center gap-4 mb-7 fade-up d1">

                <div class="flex items-center gap-4">

                    <div class="w-14 h-14 rounded-2xl bg-[#504E76] text-white flex items-center justify-center shadow-xl floating">
                        <i class='bx bx-donate-heart text-2xl'></i>
                    </div>

                    <div>

                        <h1 class="text-2xl lg:text-4xl font-black gradient-text">
                            Donate Food
                        </h1>

                        <p class="text-[#504E76]/65 mt-1 text-sm lg:text-base">
                            Share your extra food with communities 🍱
                        </p>

                    </div>

                </div>

                <div class="glass rounded-2xl px-4 py-3 flex items-center gap-3 soft-shadow smooth-card">

                    <div>

                        <h1 class="font-black text-[#504E76] text-base lg:text-lg">
                            {{ Auth::user()->username }}
                        </h1>

                        <p class="text-[#504E76]/60 text-xs lg:text-sm">
                            Supplier
                        </p>

                    </div>

                    <img
                        src="{{ Auth::user()->profile_photo ? asset(Auth::user()->profile_photo) : 'https://ui-avatars.com/api/?name=' . urlencode(Auth::user()->username) }}"
                        class="w-12 h-12 rounded-full border-4 border-white object-cover shadow-lg">

                </div>

            </div>

            <!-- FORM -->
            <div class="glass rounded-3xl p-5 lg:p-7 soft-shadow fade-up d2">

                <form action="/donate" method="POST" enctype="multipart/form-data">

                    @csrf

                    <!-- FOOD -->
                    <p class="section-title">Food Information</p>

                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 mb-6">

                        <div>

                            <label class="field-label">
                                <span class="label-dot"></span>
                                Food Name
                            </label>

                            <div class="input-wrap">

                                <i class='bx bx-bowl-rice input-icon'></i>

                                <input type="text" name="food_name" placeholder="e.g. Nasi Kotak"
                                    class="input-style">

                            </div>

                        </div>

                        <div>

                            <label class="field-label">
                                <span class="label-dot"></span>
                                Quantity
                            </label>

                            <div class="input-wrap">

                                <i class='bx bx-package input-icon'></i>

                                <input type="number" name="quantity" placeholder="e.g. 20"
                                    class="input-style">

                            </div>

                        </div>

                    </div>

                    <!-- CATEGORY -->
                    <div class="mb-6">

                        <label class="field-label">
                            <span class="label-dot"></span>
                            Food Category
                        </label>

                        <input type="hidden" id="category-input" name="category" value="Rice">

                        <div class="flex gap-2 flex-wrap sm:flex-nowrap">

                            <div class="cat-chip active" onclick="selectCat(this,'Rice')">
                                <i class='bx bx-bowl-rice text-2xl text-[#504E76]'></i>
                                <span>Rice</span>
                            </div>

                            <div class="cat-chip" onclick="selectCat(this,'Bread')">
                                <i class='bx bx-cookie text-2xl text-[#504E76]'></i>
                                <span>Bread</span>
                            </div>

                            <div class="cat-chip" onclick="selectCat(this,'Snack')">
                                <i class='bx bx-lemon text-2xl text-[#504E76]'></i>
                                <span>Snack</span>
                            </div>

                            <div class="cat-chip" onclick="selectCat(this,'Drink')">
                                <i class='bx bx-drink text-2xl text-[#504E76]'></i>
                                <span>Drink</span>
                            </div>

                        </div>

                    </div>

                    <!-- SCHEDULE -->
                    <p class="section-title">Schedule</p>

                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 mb-6">

                        <div>

                            <label class="field-label">
                                <span class="label-dot"></span>
                                Estimated Consumption
                            </label>

                            <div class="input-wrap">

                                <i class='bx bx-calendar input-icon'></i>

                                <input type="date" name="expired_date" class="input-style">

                            </div>

                        </div>

                        <div>

                            <label class="field-label">
                                <span class="label-dot"></span>
                                Pickup Time
                            </label>

                        <input
                            type="date"
                            name="expired_date"

                            class="w-full p-3 rounded-2xl
                            bg-white/70 border border-white/30
                            focus:outline-none text-sm">

                    </div>

                    <!-- LOCATION -->
                    <p class="section-title">Location & Media</p>

                    <div class="grid grid-cols-1 xl:grid-cols-2 gap-6">

                        <!-- LEFT -->
                        <div class="space-y-6">

                            <div>

                                <label class="field-label">
                                    <span class="label-dot"></span>
                                    Pickup Location
                                </label>

                                <div class="flex gap-2">

                                    <div class="input-wrap flex-1">

                                        <i class='bx bx-map input-icon'></i>

                                        <input type="text" id="pickup_location" name="pickup_location"
                                            placeholder="Getting your location..." class="input-style">

                                    </div>

                                    <button type="button" onclick="getLocation()"
                                        class="w-12 h-12 min-w-[48px] rounded-2xl bg-[#504E76] hover:bg-[#F1642E] text-white flex items-center justify-center shadow-lg btn-hover">

                                        <i class='bx bx-current-location text-xl'></i>

                                    </button>

                                </div>

                            </div>

                            <div class="glass rounded-[26px] p-2 soft-shadow smooth-card">
                                <div id="map"></div>
                            </div>

                        </div>

                        <!-- RIGHT -->
                        <div class="flex flex-col gap-4">

                            <!-- PHOTO -->
                            <div>

                                <label class="field-label">
                                    <span class="label-dot"></span>
                                    Food Photo
                                </label>

                                <label class="photo-upload block">

                                    <img id="photo-preview" class="photo-preview">

                                    <div id="photo-placeholder"
                                        class="py-8 px-5 flex flex-col items-center gap-2">

                                        <div class="w-14 h-14 rounded-2xl bg-[#504E76]/10 flex items-center justify-center">
                                            <i class='bx bx-image-add text-3xl text-[#504E76]'></i>
                                        </div>

                                        <p class="font-bold text-[#504E76] text-sm">
                                            Upload Food Photo
                                        </p>

                                        <p class="text-xs text-[#504E76]/50">
                                            JPG, PNG or JPEG
                                        </p>

                                    </div>

                                    <input type="file" name="food_photo" accept="image/*"
                                        class="hidden" onchange="previewPhoto(this)">

                                </label>

                            </div>

                            <!-- DESCRIPTION -->
                            <div>

                                <label class="field-label">
                                    <span class="label-dot"></span>
                                    Description
                                </label>

                                <textarea
                                    name="description"
                                    placeholder="Describe the food..."
                                    class="input-style resize-none"
                                    style="height:110px; padding-left:18px;"></textarea>

                            </div>

                        </div>

                    </div>

                    <!-- BUTTON -->
                    <button type="submit"
                        class="w-full bg-gradient-to-r from-[#504E76] to-[#6B689B] hover:from-[#E7B96A] hover:to-[#E89A4A] text-white font-black py-4 rounded-2xl shadow-xl flex items-center justify-center gap-3 btn-hover">

                        <i class='bx bx-donate-heart text-xl'></i>

                        Donate Now

                    </button>

                </form>

            </div>

        </main>

    </div>

    <!-- LEAFLET -->
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

    <script>
        // MAP
        let map = L.map('map').setView([-6.2088, 106.8456], 13);

        L.tileLayer(
            'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; OpenStreetMap'
            }
        ).addTo(map);

        let marker;

        // LOCATION
        function getLocation() {

            if (!navigator.geolocation)
                return alert("Geolocation not supported.");

            navigator.geolocation.getCurrentPosition(

                async(pos) => {

                        const {
                            latitude: lat,
                            longitude: lng
                        } = pos.coords;

                        map.setView([lat, lng], 16);

                        if (marker)
                            map.removeLayer(marker);

                        marker = L.marker([lat, lng]).addTo(map);

                        const res = await fetch(
                            `https://nominatim.openstreetmap.org/reverse?format=json&lat=${lat}&lon=${lng}`
                        );

                        const data = await res.json();

                        document.getElementById('pickup_location').value = data.display_name;

                    },

                    () => alert("Location access denied.")
            );
        }

        getLocation();

        // CATEGORY
        function selectCat(el, val) {

            document.querySelectorAll('.cat-chip')
                .forEach(c => c.classList.remove('active'));

            el.classList.add('active');

            document.getElementById('category-input').value = val;
        }

        // PHOTO PREVIEW
        function previewPhoto(input) {

            if (!input.files || !input.files[0]) return;

            const reader = new FileReader();

            reader.onload = (e) => {

                document.getElementById('photo-preview').src = e.target.result;

                document.getElementById('photo-preview').style.display = 'block';

                document.getElementById('photo-placeholder').style.display = 'none';
            };

            reader.readAsDataURL(input.files[0]);
        }
    </script>

</body>

</html>