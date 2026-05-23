<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Settings</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css'
        rel='stylesheet'>

    <link
        rel="stylesheet"
        href="https://cdn-uicons.flaticon.com/uicons-solid-rounded/css/uicons-solid-rounded.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <style>
        * {
            scroll-behavior: smooth;
        }

        body {
            font-family: 'Poppins', sans-serif;
            overflow-x: hidden;
        }

        .glass {
            background: rgba(255, 255, 255, 0.35);
            backdrop-filter: blur(18px);
            -webkit-backdrop-filter: blur(18px);
            border: 1px solid rgba(255, 255, 255, 0.25);
        }

        .soft-shadow {
            box-shadow:
                0 12px 35px rgba(80, 78, 118, 0.10),
                0 5px 10px rgba(0, 0, 0, 0.03);
        }

        .gradient-text {
            background: linear-gradient(135deg, #504E76, #6E6AB3, #E8C067);
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

        .input-field {
            width: 100%;
            height: 52px;
            padding: 0 18px;
            border-radius: 14px;
            background: rgba(255, 255, 255, 0.75);
            border: 1.5px solid rgba(255, 255, 255, 0.45);
            outline: none;
            font-size: 14px;
            font-family: 'Poppins', sans-serif;
            color: #504E76;
            transition: all .3s ease;
        }

        .input-field::placeholder {
            color: rgba(80, 78, 118, 0.35);
        }

        .input-field:focus {
            border-color: #504E76;
            box-shadow: 0 0 0 4px rgba(80, 78, 118, 0.10);
            background: white;
        }

        .input-field:disabled {
            background: rgba(80, 78, 118, 0.08);
            border-color: transparent;
            cursor: not-allowed;
            color: #504E76;
            font-weight: 600;
        }

        .field-label {
            display: block;
            font-size: 11px;
            font-weight: 700;
            color: #504E76;
            letter-spacing: .6px;
            text-transform: uppercase;
            margin-bottom: 8px;
        }

        .btn-hover {
            transition: all .3s ease;
        }

        .btn-hover:hover {
            transform: scale(1.02);
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

        .fade-up {
            animation: fadeUp 0.5s cubic-bezier(.22, .68, 0, 1.1) both;
        }

        .d1 {
            animation-delay: .05s;
        }

        .d2 {
            animation-delay: .12s;
        }

        .d3 {
            animation-delay: .19s;
        }

        ::-webkit-scrollbar {
            width: 6px;
        }

        ::-webkit-scrollbar-thumb {
            background: #504E76;
            border-radius: 50px;
        }

        ::-webkit-scrollbar-track {
            background: transparent;
        }
    </style>
</head>

<body class="bg-gradient-to-br from-[#FDF8E2] to-[#C4C3E3] min-h-screen">

    <div class="flex h-screen">

        @include('supplier.sidebar')

        <!-- MAIN -->
        <main class="flex-1 overflow-y-auto px-4 sm:px-6 lg:px-8 py-6 lg:py-8 pt-16 lg:pt-8">

            <!-- HEADER -->
            <div class="flex items-center gap-4 mb-7 fade-up">
                <div class="w-13 h-13 w-12 h-12 lg:w-14 lg:h-14 rounded-2xl
                        bg-[#504E76] text-white
                        flex items-center justify-center shadow-xl floating shrink-0">
                    <i class='bx bx-cog text-2xl'></i>
                </div>
                <div>
                    <h1 class="text-2xl lg:text-3xl font-black gradient-text leading-tight">
                        Profile Settings
                    </h1>
                    <p class="text-[#504E76]/60 text-sm mt-0.5">
                        Update your personal information
                    </p>
                </div>
            </div>

            <!-- ALERTS -->
            @if(session('success'))
            <div class="mb-5 fade-up d1 glass rounded-2xl px-5 py-3.5 soft-shadow
                    border-l-4 border-green-500
                    flex items-center gap-3 text-green-700 text-sm font-medium">
                <i class='bx bx-check-circle text-xl text-green-500'></i>
                {{ session('success') }}
            </div>
            @endif

            @if(session('error'))
            <div class="mb-5 fade-up d1 glass rounded-2xl px-5 py-3.5 soft-shadow
                    border-l-4 border-red-400
                    flex items-center gap-3 text-red-600 text-sm font-medium">
                <i class='bx bx-error-circle text-xl text-red-400'></i>
                {{ session('error') }}
            </div>
            @endif

            @if($errors->any())
            <div class="mb-5 fade-up d1 glass rounded-2xl px-5 py-4 soft-shadow
                    border-l-4 border-red-400 text-red-600 text-sm">
                <div class="flex items-center gap-2 font-bold mb-2">
                    <i class='bx bx-error-circle text-lg'></i> Please fix the following:
                </div>
                <ul class="list-disc pl-5 space-y-1">
                    @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <div class="max-w-5xl space-y-5">

                <!-- ====== PROFILE FORM ====== -->
                <div class="glass rounded-3xl p-6 lg:p-8 soft-shadow fade-up d1">

                    <form action="/settings/update" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('POST')

                        <!-- PROFILE TOP -->
                        <div class="flex flex-col sm:flex-row items-center sm:items-start gap-5 mb-8
                                pb-8 border-b border-white/30">

                            <!-- AVATAR -->
                            <div class="relative shrink-0">
                                <img
                                    src="{{ $user->profile_photo
                                    ? asset($user->profile_photo)
                                    : 'https://ui-avatars.com/api/?name=' . urlencode($user->username) . '&background=504E76&color=fff&bold=true&size=128' }}"
                                    onerror="this.src='https://ui-avatars.com/api/?name={{ urlencode($user->username) }}&background=504E76&color=fff&bold=true&size=128'"
                                    class="w-24 h-24 lg:w-28 lg:h-28 rounded-2xl object-cover border-4 border-white shadow-xl">
                                <label class="absolute -bottom-2 -right-2
                                          w-9 h-9 rounded-xl
                                          bg-[#F1642E] hover:bg-[#d9531f]
                                          transition-all duration-300
                                          flex items-center justify-center
                                          text-white cursor-pointer shadow-lg">
                                    <i class='bx bx-camera text-base'></i>
                                    <input type="file" name="profile_photo" class="hidden">
                                </label>
                            </div>

                            <!-- USER INFO -->
                            <div class="text-center sm:text-left">
                                <h2 class="text-2xl lg:text-3xl font-black text-[#504E76]">
                                    {{ $user->username }}
                                </h2>
                                <p class="text-[#504E76]/55 text-sm mt-0.5">{{ $user->email }}</p>
                                <div class="mt-3 inline-flex items-center gap-2
                                        bg-[#504E76]/10 text-[#504E76]
                                        px-4 py-1.5 rounded-xl text-xs font-bold
                                        tracking-wide uppercase">
                                    <i class='bx bx-user text-sm'></i>
                                    Supplier Account
                                </div>
                            </div>

                        </div>

                        <!-- INPUT GRID -->
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5 mb-7">

                            <div>
                                <label class="field-label">Username</label>
                                <input type="text" name="username" value="{{ $user->username }}"
                                    class="input-field">
                            </div>

                            <div>
                                <label class="field-label">Email Address</label>
                                <input type="email" name="email" value="{{ $user->email }}"
                                    class="input-field">
                            </div>

                            <div>
                                <label class="field-label">Phone Number</label>
                                <input type="text" name="no_telp" value="{{ $user->no_telp }}"
                                    placeholder="e.g. 08123456789"
                                    class="input-field">
                            </div>

                            <div>
                                <label class="field-label">Account Role</label>
                                <input type="text" value="{{ ucfirst($user->role) }}"
                                    disabled class="input-field">
                            </div>

                            <!-- STORE NAME -->
                            <div>

                                <label class="block text-sm font-semibold text-[#504E76] mb-2">

                                    Store Name

                                </label>

                                <input
                                    type="text"
                                    name="nama_toko"
                                    value="{{ $supplier->nama_toko }}"

                                    class="w-full h-[60px]
        px-5 rounded-2xl
        bg-white/70
        border border-white/30
        focus:outline-none
        focus:ring-2
        focus:ring-[#504E76]/30">

                            </div>

                            <!-- STORE ADDRESS -->
                            <div>

                                <label class="block text-sm font-semibold text-[#504E76] mb-2">

                                    Store Address

                                </label>

                                <!-- INPUT + BUTTON -->
                                <div class="flex gap-3">

                                    <!-- ADDRESS -->
                                    <input
                                        type="text"

                                        id="alamat_toko"

                                        name="alamat_toko"

                                        value="{{ $supplier->alamat_toko }}"

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

                                <!-- LOADING -->
                                <p
                                    id="locationLoading"

                                    class="hidden text-sm text-[#504E76]/60 mt-3">

                                </p>

                                <!-- LAT LONG -->
                                <input
                                    type="hidden"
                                    id="latitude"
                                    name="latitude"
                                    value="{{ $supplier->latitude }}">

                                <input
                                    type="hidden"
                                    id="longitude"
                                    name="longitude"
                                    value="{{ $supplier->longitude }}">

                            </div>

                        </div>

                        <!-- SAVE BUTTON -->
                        <div class="flex justify-end">
                            <button type="submit"
                                class="bg-[#504E76] hover:bg-[#F1642E]
                                       transition-all duration-300 btn-hover
                                       text-white font-bold
                                       px-8 py-3.5 rounded-2xl shadow-xl
                                       flex items-center gap-2.5">
                                <i class='bx bx-save text-lg'></i>
                                Save Changes
                            </button>
                        </div>

                    </form>

                </div>

                <!-- ====== PASSWORD FORM ====== -->
                <div class="glass rounded-3xl p-6 lg:p-8 soft-shadow fade-up d2">

                    <!-- TITLE -->
                    <div class="flex items-center gap-4 mb-7 pb-6 border-b border-white/30">
                        <div class="w-12 h-12 rounded-2xl bg-[#504E76] text-white
                                flex items-center justify-center shadow-lg shrink-0">
                            <i class='bx bx-lock-alt text-xl'></i>
                        </div>
                        <div>
                            <h1 class="text-2xl lg:text-4xl font-black gradient-text">

                                Change Password

                            </h1>

                            <p class="text-[#504E76]/65 mt-1 text-sm lg:text-base">
                                Update your account password securely 🔒
                            </p>
                        </div>
                    </div>

                    <form action="/settings/password" method="POST">
                        @csrf

                        <!-- INPUT ROW -->
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-5 mb-7">

                            <div>
                                <label class="field-label">Current Password</label>
                                <input type="password" name="current_password"
                                    placeholder="Enter current password"
                                    class="input-field">
                            </div>

                            <div>
                                <label class="field-label">New Password</label>
                                <input type="password" name="new_password"
                                    placeholder="Enter new password"
                                    class="input-field">
                            </div>

                            <div>
                                <label class="field-label">Confirm Password</label>
                                <input type="password" name="new_password_confirmation"
                                    placeholder="Confirm new password"
                                    class="input-field">
                            </div>

                        </div>

                        <!-- UPDATE BUTTON -->
                        <div class="flex justify-end">
                            <button type="submit"
                                class="bg-[#F1642E] hover:bg-[#d9531f]
                                       transition-all duration-300 btn-hover
                                       text-white font-bold
                                       px-8 py-3.5 rounded-2xl shadow-xl
                                       flex items-center gap-2.5">
                                <i class='bx bx-lock-open-alt text-lg'></i>
                                Update Password
                            </button>
                        </div>

                    </form>

                </div>

            </div>

        </main>

    </div>

    <script>
        async function getLocation() {

            const addressInput =
                document.getElementById('alamat_toko');

            const loadingText =
                document.getElementById('locationLoading');

            const button =
                document.getElementById('locationButton');

            /*
            |--------------------------------------------------------------------------
            | LOADING
            |--------------------------------------------------------------------------
            */

            loadingText.classList.remove('hidden');

            loadingText.innerText =
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

                        let data =
                            await response.json();

                        if (data.display_name) {

                            addressInput.value =
                                data.display_name;
                        }

                        /*
                        |--------------------------------------------------------------------------
                        | RESET
                        |--------------------------------------------------------------------------
                        */

                        loadingText.classList.add(
                            'hidden'
                        );

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
    </script>

</body>

</html>