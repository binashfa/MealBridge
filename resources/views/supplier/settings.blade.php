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
</head>

<body class="bg-gradient-to-br from-[#FDF8E2]
to-[#C4C3E3]">

    <div class="flex h-screen">

        @include('supplier.sidebar')

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
                    action="/settings/update"
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

                                Supplier Account

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
                    action="/settings/password"
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

</body>

</html>