<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">

    <meta name="viewport"
        content="width=device-width, initial-scale=1.0">

    <title>Settings</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css'
        rel='stylesheet'>

    <link
        rel="stylesheet"
        href="https://cdn-uicons.flaticon.com/uicons-solid-rounded/css/uicons-solid-rounded.css">
</head>

<body class="bg-gradient-to-br from-[#FDF8E2]
to-[#C4C3E3]">

    <div class="flex h-screen">

        @include('community.sidebar')

        <!-- MAIN -->
        <main class="flex-1 overflow-y-auto px-8 py-6">

            <!-- HEADER -->
            <div class="flex items-center gap-4 mb-5">

                <div class="w-14 h-14 rounded-2xl
                bg-[#504E76] text-white
                flex items-center justify-center shadow-xl">

                    <i class='bx bx-cog text-2xl'></i>

                </div>

                <div>

                    <h1 class="text-2xl font-black text-[#504E76]">
                        Profile Settings
                    </h1>

                    <p class="text-sm text-[#504E76]/60">
                        Update your personal information
                    </p>

                </div>

            </div>

            <!-- SUCCESS -->
            @if(session('success'))

            <div class="mb-4 bg-green-100
            border border-green-300
            text-green-700 p-3 rounded-2xl text-sm">

                {{ session('success') }}

            </div>

            @endif

            @if(session('error'))

            <div class="mb-4 bg-red-100
border border-red-300
text-red-700 p-3 rounded-2xl text-sm">

                {{ session('error') }}

            </div>

            @endif


            @if ($errors->any())

            <div class="mb-4 bg-red-100
border border-red-300
text-red-700 p-3 rounded-2xl text-sm">

                <ul class="list-disc pl-5">

                    @foreach ($errors->all() as $error)

                    <li>{{ $error }}</li>

                    @endforeach

                </ul>

            </div>

            @endif

            <!-- CONTENT -->
            <div class="max-w-5xl space-y-6">

                <!-- PROFILE FORM -->
                <form
                    action="/community-settings/update"
                    method="POST"
                    enctype="multipart/form-data"

                    class="bg-white/30 backdrop-blur-2xl border border-white/20 rounded-[35px] p-10 shadow-2xl">

                    @csrf
                    @method('POST')

                    <!-- TOP PROFILE -->
                    <div class="flex items-center gap-6 mb-10">

                        <!-- PHOTO -->
                        <div class="relative">

                            <img
                                src="{{ $user->profile_photo
                                ? asset($user->profile_photo)
                                : 'https://ui-avatars.com/api/?name=' . urlencode($user->username) }}"

                                onerror="this.src='https://ui-avatars.com/api/?name={{ urlencode($user->username) }}'"

                                class="w-28 h-28 rounded-full
                                object-cover border-[5px]
                                border-white shadow-xl">

                            <!-- CAMERA -->
                            <label
                                class="absolute bottom-1 right-1 w-9 h-9 rounded-full bg-[#F1642E] hover:scale-105 transition-all duration-300 flex items-center justify-center text-white cursor-pointer shadow-lg">

                                <i class='bx bx-camera text-lg'></i>

                                <input
                                    type="file"
                                    name="profile_photo"
                                    class="hidden">
                            </label>

                        </div>

                        <!-- INFO -->
                        <div>

                            <h1 class="text-3xl font-black text-[#504E76]">

                                {{ $user->username }}

                            </h1>

                            <p class="text-[#504E76]/60 mt-1">

                                {{ $user->email }}

                            </p>

                            <div class="mt-3 inline-flex items-center gap-2 bg-[#504E76]/10 text-[#504E76] px-4 py-2 rounded-xl text-sm font-semibold">

                                <i class='bx bx-user'></i>

                                Community Account

                            </div>

                        </div>

                    </div>

                    <!-- INPUT GRID -->
                    <div class="grid grid-cols-2 gap-6">

                        <!-- USERNAME -->
                        <div>

                            <label class="block text-sm font-semibold text-[#504E76] mb-2">

                                Username

                            </label>

                            <input
                                type="text"
                                name="username"
                                value="{{ $user->username }}"

                                class="w-full h-[60px] px-5 rounded-2xl bg-white/70 border border-white/30 focus:outline-none focus:ring-2 focus:ring-[#504E76]/30">
                        </div>

                        <!-- EMAIL -->
                        <div>

                            <label class="block text-sm font-semibold text-[#504E76] mb-2">

                                Email Address

                            </label>

                            <input
                                type="email"
                                name="email"
                                value="{{ $user->email }}"

                                class="w-full h-[60px]
                    px-5 rounded-2xl
                    bg-white/70
                    border border-white/30
                    focus:outline-none
                    focus:ring-2
                    focus:ring-[#504E76]/30">
                        </div>

                        <!-- PHONE -->
                        <div>

                            <label class="block text-sm
                font-semibold text-[#504E76] mb-2">

                                Phone Number

                            </label>

                            <input
                                type="text"
                                name="no_telp"
                                value="{{ $user->no_telp }}"

                                class="w-full h-[60px]
                    px-5 rounded-2xl
                    bg-white/70
                    border border-white/30
                    focus:outline-none
                    focus:ring-2
                    focus:ring-[#504E76]/30">
                        </div>

                        <!-- ROLE -->
                        <div>

                            <label class="block text-sm
                font-semibold text-[#504E76] mb-2">

                                Account Role

                            </label>

                            <input
                                type="text"
                                value="{{ ucfirst($user->role) }}"
                                disabled

                                class="w-full h-[60px]
                    px-5 rounded-2xl
                    bg-[#504E76]/10
                    border border-white/20
                    text-[#504E76] font-semibold">
                        </div>

                        <!-- COMMUNITY NAME -->
                        <div>

                            <label class="block text-sm font-semibold text-[#504E76] mb-2">

                                Community Name

                            </label>

                            <input
                                type="text"
                                name="nama_komunitas"
                                value="{{ $community->nama_komunitas }}"

                                class="w-full h-[60px]
        px-5 rounded-2xl
        bg-white/70
        border border-white/30
        focus:outline-none
        focus:ring-2
        focus:ring-[#504E76]/30">

                        </div>

                        <!-- COMMUNITY PURPOSE -->
                        <div>

                            <div class="flex items-center justify-between mb-2">

                                <label class="block text-sm font-semibold text-[#504E76]">

                                    Community Purpose

                                </label>

                                <!-- COUNTER -->
                                <span
                                    id="purposeCounter"

                                    class="text-xs font-semibold text-[#504E76]/60">

                                    0 / 150

                                </span>

                            </div>

                            <input
                                type="text"

                                id="tujuan_komunitas"

                                name="tujuan_komunitas"

                                maxlength="150"

                                value="{{ $community->tujuan_komunitas }}"

                                placeholder="Example: Helping distribute food to people in need"

                                class="w-full h-[60px]
        px-5 rounded-2xl
        bg-white/70
        border border-white/30
        focus:outline-none
        focus:ring-2
        focus:ring-[#504E76]/30">

                        </div>

                        <!-- COMMUNITY ADDRESS -->
                        <div class="col-span-2">

                            <label class="block text-sm font-semibold text-[#504E76] mb-2">

                                Community Address

                            </label>

                            <!-- INPUT + BUTTON -->
                            <div class="flex gap-3">

                                <!-- ADDRESS -->
                                <input
                                    type="text"

                                    id="alamat_komunitas"

                                    name="alamat_komunitas"

                                    value="{{ $community->alamat_komunitas }}"

                                    placeholder="Click detect location"

                                    class="flex-1 h-[60px]
            px-5 rounded-2xl
            bg-white/70
            border border-white/30
            focus:outline-none
            focus:ring-2
            focus:ring-[#504E76]/30">

                                <!-- BUTTON -->
                                <button
                                    type="button"

                                    id="locationButton"

                                    onclick="getLocation()"

                                    class="h-[60px]
            px-6 rounded-2xl
            bg-[#504E76]
            hover:bg-[#F1642E]
            transition-all duration-300
            text-white
            flex items-center gap-2
            whitespace-nowrap">

                                    <i class="fi fi-sr-marker"></i>

                                    Detect

                                </button>

                            </div>

                            <!-- LOADING TEXT -->
                            <p
                                id="locationLoading"

                                class="hidden text-sm text-[#504E76]/60 mt-3">

                            </p>

                            <!-- LAT LONG -->
                            <input
                                type="hidden"
                                id="latitude"
                                name="latitude"
                                value="{{ $community->latitude }}">

                            <input
                                type="hidden"
                                id="longitude"
                                name="longitude"
                                value="{{ $community->longitude }}">

                        </div>

                    </div>

                    <!-- BUTTON -->
                    <div class="flex justify-end mt-8">

                        <button
                            type="submit"

                            class="bg-[#504E76]
                hover:bg-[#F1642E]
                transition-all duration-300
                text-white font-bold
                px-10 py-4
                rounded-2xl shadow-xl">

                            Save Changes

                        </button>

                    </div>

                </form>

                <!-- PASSWORD FORM -->
                <form
                    action="/community-settings/password"
                    method="POST"

                    class="bg-white/30
        backdrop-blur-2xl
        border border-white/20
        rounded-[35px]
        p-10 shadow-2xl">

                    @csrf

                    <!-- TITLE -->
                    <div class="flex items-center gap-4 mb-8">

                        <div class="w-14 h-14 rounded-2xl
            bg-[#504E76]
            text-white
            flex items-center justify-center">

                            <i class='bx bx-lock-alt text-2xl'></i>

                        </div>

                        <div>

                            <h1 class="text-3xl font-black text-[#504E76]">

                                Change Password

                            </h1>

                            <p class="text-[#504E76]/60 text-sm mt-1">

                                Update your account password securely

                            </p>

                        </div>

                    </div>

                    <!-- INPUT -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

                        <!-- CURRENT -->
                        <div>

                            <label class="block text-sm
                font-semibold text-[#504E76] mb-2">

                                Current Password

                            </label>

                            <input
                                type="password"
                                name="current_password"

                                placeholder="Current password"

                                class="w-full h-[60px]
                    px-5 rounded-2xl
                    bg-white/70
                    border border-white/30
                    focus:outline-none
                    focus:ring-2
                    focus:ring-[#504E76]/30">
                        </div>

                        <!-- NEW -->
                        <div>

                            <label class="block text-sm
                font-semibold text-[#504E76] mb-2">

                                New Password

                            </label>

                            <input
                                type="password"
                                name="new_password"

                                placeholder="New password"

                                class="w-full h-[60px]
                    px-5 rounded-2xl
                    bg-white/70
                    border border-white/30
                    focus:outline-none
                    focus:ring-2
                    focus:ring-[#504E76]/30">
                        </div>

                        <!-- CONFIRM -->
                        <div>

                            <label class="block text-sm
                font-semibold text-[#504E76] mb-2">

                                Confirm Password

                            </label>

                            <input
                                type="password"
                                name="new_password_confirmation"

                                placeholder="Confirm password"

                                class="w-full h-[60px]
                    px-5 rounded-2xl
                    bg-white/70
                    border border-white/30
                    focus:outline-none
                    focus:ring-2
                    focus:ring-[#504E76]/30">
                        </div>

                    </div>

                    <!-- BUTTON -->
                    <div class="flex justify-end mt-8">

                        <button
                            type="submit"

                            class="bg-[#F1642E]
                hover:bg-[#d9531f]
                transition-all duration-300
                text-white font-bold
                px-10 py-4
                rounded-2xl shadow-xl">

                            Update Password

                        </button>

                    </div>

                </form>

            </div>

        </main>

    </div>

    <script>
        async function getLocation() {
            const addressInput =
                document.getElementById('alamat_komunitas');

            const loadingText =
                document.getElementById('locationLoading');

            const button =
                document.getElementById('locationButton');

            /*
            |--------------------------------------------------------------------------
            | LOADING STATE
            |--------------------------------------------------------------------------
            */

            loadingText.classList.remove('hidden');

            addressInput.value =
                'Checking your current address...';

            addressInput.disabled = true;

            button.disabled = true;

            button.classList.add(
                'opacity-60',
                'cursor-not-allowed'
            );

            /*
            |--------------------------------------------------------------------------
            | GEOLOCATION
            |--------------------------------------------------------------------------
            */

            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(

                    async function(position) {
                        let lat =
                            position.coords.latitude;

                        let lng =
                            position.coords.longitude;

                        document.getElementById(
                            'latitude'
                        ).value = lat;

                        document.getElementById(
                            'longitude'
                        ).value = lng;

                        /*
                        |--------------------------------------------------------------------------
                        | REVERSE GEOCODING
                        |--------------------------------------------------------------------------
                        */

                        let response = await fetch(
                            `https://nominatim.openstreetmap.org/reverse?format=json&lat=${lat}&lon=${lng}`
                        );

                        let data = await response.json();

                        if (data.display_name) {
                            addressInput.value =
                                data.display_name;
                        }

                        /*
                        |--------------------------------------------------------------------------
                        | RESET
                        |--------------------------------------------------------------------------
                        */

                        loadingText.classList.add('hidden');

                        addressInput.disabled = false;

                        button.disabled = false;

                        button.classList.remove(
                            'opacity-60',
                            'cursor-not-allowed'
                        );
                    }
                );
            }
        }



        const purposeInput =
            document.getElementById('tujuan_komunitas');

        const purposeCounter =
            document.getElementById('purposeCounter');

        function updateCounter() {
            let currentLength =
                purposeInput.value.length;

            purposeCounter.innerText =
                `${currentLength} / 150`;

            /*
            |--------------------------------------------------------------------------
            | CHANGE COLOR
            |--------------------------------------------------------------------------
            */

            if (currentLength >= 150) {
                purposeCounter.classList.remove(
                    'text-[#504E76]/60'
                );

                purposeCounter.classList.add(
                    'text-red-500'
                );

                purposeInput.classList.add(
                    'border-red-400',
                    'ring-2',
                    'ring-red-300'
                );
            } else {
                purposeCounter.classList.remove(
                    'text-red-500'
                );

                purposeCounter.classList.add(
                    'text-[#504E76]/60'
                );

                purposeInput.classList.remove(
                    'border-red-400',
                    'ring-2',
                    'ring-red-300'
                );
            }
        }

        updateCounter();

        purposeInput.addEventListener(
            'input',
            updateCounter
        );
    </script>

</body>

</html>