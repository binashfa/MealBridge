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
to-[#C4C3E3] h-screen overflow-hidden">

    <div class="flex h-screen">

        @include('community.sidebar')

        <!-- MAIN -->
        <main class="flex-1 overflow-hidden px-8 py-6">

            <!-- HEADER -->
            <div class="flex items-center gap-4 mb-5">

                <div class="w-14 h-14 rounded-2xl
                bg-[#504E76] text-white
                flex items-center justify-center shadow-xl">

                    <i class='bx bx-cog text-2xl'></i>

                </div>

                <div>

                    <h1 class="text-3xl font-black text-[#504E76]">
                        Settings
                    </h1>

                    <p class="text-sm text-[#504E76]/70">
                        Manage your account settings
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

            <!-- CONTENT -->
            <div class="grid grid-cols-2 gap-5 h-[calc(100vh-150px)]">

                <!-- PROFILE -->
                <form
                    action="/settings/update"
                    method="POST"
                    enctype="multipart/form-data"

                    class="bg-white/30 backdrop-blur-2xl
                    border border-white/20
                    rounded-3xl p-6 shadow-2xl
                    flex flex-col justify-between">

                    @csrf

                    <div>

                        <!-- TITLE -->
                        <div class="flex items-center gap-3 mb-5">

                            <i class='bx bx-user text-3xl text-[#504E76]'></i>

                            <div>

                                <h1 class="text-2xl font-black text-[#504E76]">
                                    Profile
                                </h1>

                                <p class="text-xs text-[#504E76]/60">
                                    Personal information
                                </p>

                            </div>

                        </div>

                        <!-- PHOTO -->
                        <div class="flex flex-col items-center mb-5">

                            <img
                                src="{{ $user->profile_photo
                                ? asset('storage/' . $user->profile_photo)
                                : 'https://ui-avatars.com/api/?name=' . $user->username }}"

                                class="w-24 h-24 rounded-full
                                object-cover border-4
                                border-white shadow-xl">

                            <input
                                type="file"
                                name="profile_photo"

                                class="mt-3 text-sm w-full">

                        </div>

                        <!-- INPUTS -->
                        <div class="space-y-4">

                            <div>

                                <label class="block text-sm
                                font-semibold text-[#504E76] mb-1">

                                    Username

                                </label>

                                <input
                                    type="text"
                                    name="username"

                                    value="{{ $user->username }}"

                                    class="w-full p-3 rounded-2xl
                                    bg-white/70 border border-white/30">

                            </div>

                            <div>

                                <label class="block text-sm
                                font-semibold text-[#504E76] mb-1">

                                    Email

                                </label>

                                <input
                                    type="email"
                                    name="email"

                                    value="{{ $user->email }}"

                                    class="w-full p-3 rounded-2xl
                                    bg-white/70 border border-white/30">

                            </div>

                            <div>

                                <label class="block text-sm
                                font-semibold text-[#504E76] mb-1">

                                    Phone Number

                                </label>

                                <input
                                    type="text"
                                    name="no_telp"

                                    value="{{ $user->no_telp }}"

                                    class="w-full p-3 rounded-2xl
                                    bg-white/70 border border-white/30">

                            </div>

                        </div>

                    </div>

                    <!-- BUTTON -->
                    <button
                        type="submit"

                        class="mt-5 w-full bg-[#504E76]
                        hover:bg-[#F1642E]
                        transition-all duration-300
                        text-white font-bold py-3
                        rounded-2xl shadow-xl">

                        Update Profile

                    </button>

                </form>

                <!-- NOTIFICATION -->
                <form
                    action="/settings/update"
                    method="POST"

                    class="bg-white/30 backdrop-blur-2xl
                    border border-white/20
                    rounded-3xl p-6 shadow-2xl
                    flex flex-col justify-between">

                    @csrf

                    <div>

                        <!-- TITLE -->
                        <div class="flex items-center gap-3 mb-5">

                            <i class='bx bx-bell text-3xl text-[#504E76]'></i>

                            <div>

                                <h1 class="text-2xl font-black text-[#504E76]">
                                    Notifications
                                </h1>

                                <p class="text-xs text-[#504E76]/60">
                                    Notification preferences
                                </p>

                            </div>

                        </div>

                        <!-- TOGGLE -->
                        <div class="bg-white/40 rounded-2xl p-5 mb-5">

                            <div class="flex items-center justify-between">

                                <div>

                                    <h1 class="text-lg font-bold text-[#504E76]">
                                        Enable Notifications
                                    </h1>

                                    <p class="text-xs text-[#504E76]/60">
                                        Turn alerts on or off
                                    </p>

                                </div>

                                <!-- TOGGLE -->
                                <label class="relative inline-flex items-center cursor-pointer">

                                    <input
                                        type="checkbox"
                                        name="notification_enabled"
                                        class="sr-only peer"

                                        {{ $notification->notification_enabled ? 'checked' : '' }}>

                                    <div class="w-14 h-8 bg-gray-200
                rounded-full peer
                peer-checked:bg-[#B8B1FF]
                transition-all duration-300

                after:content-['']
                after:absolute
                after:top-1
                after:left-1
                after:bg-white
                after:rounded-full
                after:h-6
                after:w-6
                after:transition-all
                after:duration-300

                peer-checked:after:translate-x-6">
                                    </div>

                                </label>

                            </div>

                        </div>

                        <!-- SOUND -->
                        <div>

                            <label class="block text-sm
                            font-semibold text-[#504E76] mb-2">

                                Notification Sound

                            </label>

                            <select
                                name="notification_sound"

                                class="w-full p-3 rounded-2xl
                                bg-white/70 border border-white/30">

                                <option
                                    value="Classic Bell"
                                    {{ $notification->notification_sound == 'Classic Bell' ? 'selected' : '' }}>

                                    Classic Bell

                                </option>

                                <option
                                    value="Soft Pop"
                                    {{ $notification->notification_sound == 'Soft Pop' ? 'selected' : '' }}>

                                    Soft Pop

                                </option>

                                <option
                                    value="Digital Ping"
                                    {{ $notification->notification_sound == 'Digital Ping' ? 'selected' : '' }}>

                                    Digital Ping

                                </option>

                                <option
                                    value="Nature Drop"
                                    {{ $notification->notification_sound == 'Nature Drop' ? 'selected' : '' }}>

                                    Nature Drop

                                </option>

                            </select>

                        </div>

                    </div>

                    <!-- BUTTON -->
                    <button
                        type="submit"

                        class="mt-5 w-full bg-[#F1642E]
                        hover:bg-[#504E76]
                        transition-all duration-300
                        text-white font-bold py-3
                        rounded-2xl shadow-xl">

                        Save Notification Settings

                    </button>

                </form>

            </div>

        </main>

    </div>

</body>

</html>