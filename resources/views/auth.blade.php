<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>MealBridge Auth</title>

    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="min-h-screen overflow-hidden bg-gradient-to-br from-[#FDF8E2] to-[#C4C3E3] flex items-center justify-center">

    <div id="wrapper"
        class="relative w-full h-screen overflow-hidden">

        <!-- LOGIN -->
        <div id="loginPage"
            class="absolute left-0 top-0 w-1/2 h-full flex items-center justify-center transition-all duration-700 z-20">

            <form action="/login" method="POST" class="w-[380px]">

                @csrf

                <h1 class="text-5xl font-bold text-[#504E76] mb-8">
                    Login
                </h1>

                <input
                    type="email"
                    name="email"
                    placeholder="Email"
                    class="w-full p-4 rounded-2xl mb-4 bg-[#FDF8E2] outline-none">

                <input
                    type="password"
                    name="password"
                    placeholder="Password"
                    class="w-full p-4 rounded-2xl mb-6 bg-[#FDF8E2] outline-none">

                <button
                    class="w-full bg-[#F1642E] hover:bg-[#504E76] transition-all duration-300 p-4 rounded-2xl text-white font-semibold">

                    Login

                </button>

            </form>

        </div>

        <!-- REGISTER -->
        <div id="registerPage"
            class="absolute left-full top-0 w-1/2 h-full flex items-center justify-center transition-all duration-700 z-10">

            <form action="/register" method="POST"
                class="w-[520px] p-8 ">

                @csrf

                <h1 class="text-4xl font-bold text-[#504E76] mb-6">
                    Register
                </h1>

                <!-- GRID -->
                <div class="grid grid-cols-2 gap-4">

                    <input
                        type="text"
                        name="username"
                        placeholder="Username"
                        class="p-4 rounded-2xl bg-[#FDF8E2] outline-none">

                    <input
                        type="email"
                        name="email"
                        placeholder="Email"
                        class="p-4 rounded-2xl bg-[#FDF8E2] outline-none">

                    <input
                        type="text"
                        name="no_telp"
                        placeholder="Phone Number"
                        class="p-4 rounded-2xl bg-[#FDF8E2] outline-none">

                    <input
                        type="password"
                        name="password"
                        placeholder="Password"
                        class="p-4 rounded-2xl bg-[#FDF8E2] outline-none">

                </div>

                <!-- ROLE -->
                <select
                    id="roleSelect"
                    name="role"
                    class="w-full mt-4 p-4 rounded-2xl bg-[#FDF8E2] outline-none">

                    <option value="">
                        Select Role
                    </option>

                    <option value="supplier">
                        Supplier
                    </option>

                    <option value="community">
                        Community
                    </option>

                </select>

                <!-- SUPPLIER -->
                <div id="supplierField" class="hidden mt-4">

                    <div class="grid grid-cols-2 gap-4">

                        <input
                            type="text"
                            name="nama_toko"
                            placeholder="Store Name"
                            class="p-4 rounded-2xl bg-[#FDF8E2] outline-none">

                        <textarea
                            name="alamat_toko"
                            placeholder="Store Address"
                            class="p-4 rounded-2xl bg-[#FDF8E2] outline-none h-[100px] resize-none"></textarea>

                    </div>

                </div>

                <!-- COMMUNITY -->
                <div id="communityField" class="hidden mt-4">

                    <div class="grid grid-cols-2 gap-4">

                        <input
                            type="text"
                            name="nama_komunitas"
                            placeholder="Community Name"
                            class="p-4 rounded-2xl bg-[#FDF8E2] outline-none">

                        <textarea
                            name="tujuan_komunitas"
                            placeholder="Community Purpose"
                            class="p-4 rounded-2xl bg-[#FDF8E2] outline-none h-[100px] resize-none"></textarea>

                    </div>

                    <textarea
                        name="alamat_komunitas"
                        placeholder="Community Address"
                        class="w-full mt-4 p-4 rounded-2xl bg-[#FDF8E2] outline-none h-[90px] resize-none"></textarea>

                </div>

                <!-- BUTTON -->
                <button
                    class="w-full mt-6 bg-[#A3B565] hover:bg-[#504E76]
    transition-all duration-300 p-4 rounded-2xl text-white font-semibold">

                    Register

                </button>

            </form>

        </div>

        <!-- OVERLAY -->
        <div id="overlay"
            class="absolute top-0 left-1/2 w-1/2 h-full bg-gradient-to-br from-[#504E76] to-[#A3B565]
            rounded-l-[100px] transition-all duration-700 z-30">

            <div class="w-full h-full flex flex-col items-center justify-center text-center px-16">

                <!-- LOGO AREA -->
                <div class="flex items-center mb-4">

                    <!-- MASCOT -->
                    <img
                        src="{{ asset('images/mealbridge-mascot.png') }}"
                        alt="MealBridge Mascot"
                        class="w-[290px] drop-shadow-2xl hover:scale-105 transition-all duration-500">

                    <!-- TEXT -->
                    <div class="text-left">

                        <h1 class="text-5xl font-black text-white leading-none mt-12">
                            MealBridge
                        </h1>

                        <p class="text-[#FDF8E2] text-[16px]  mt-2">
                            Sharing food. Supporting communities.
                        </p>

                    </div>

                </div>

                <!-- BUTTON -->
                <button
                    id="toggleBtn"
                    class="border border-white text-white px-10 py-4 rounded-full
    hover:bg-white hover:text-[#504E76]
    transition-all duration-300 font-semibold backdrop-blur-xl">

                    Register

                </button>

            </div>

        </div>

    </div>

    <script>
        const wrapper = document.getElementById('wrapper')
        const overlay = document.getElementById('overlay')
        const loginPage = document.getElementById('loginPage')
        const registerPage = document.getElementById('registerPage')
        const toggleBtn = document.getElementById('toggleBtn')

        let login = true

        toggleBtn.addEventListener('click', () => {

            if (login) {

                overlay.classList.remove(
                    'left-1/2',
                    'rounded-l-[100px]'
                )

                overlay.classList.add(
                    'left-0',
                    'rounded-r-[100px]'
                )

                loginPage.classList.remove('left-0')
                loginPage.classList.add('-left-full')

                registerPage.classList.remove('left-full')
                registerPage.classList.add('left-1/2')

                toggleBtn.innerText = "Login"

                login = false

            } else {

                overlay.classList.remove(
                    'left-0',
                    'rounded-r-[100px]'
                )

                overlay.classList.add(
                    'left-1/2',
                    'rounded-l-[100px]'
                )

                loginPage.classList.remove('-left-full')
                loginPage.classList.add('left-0')

                registerPage.classList.remove('left-1/2')
                registerPage.classList.add('left-full')

                toggleBtn.innerText = "Register"

                login = true

            }

        })

        const roleSelect = document.getElementById('roleSelect')

        const supplierField = document.getElementById('supplierField')

        const communityField = document.getElementById('communityField')

        roleSelect.addEventListener('change', () => {

            if (roleSelect.value == 'supplier') {
                supplierField.classList.remove('hidden')

                communityField.classList.add('hidden')
            } else if (roleSelect.value == 'community') {
                communityField.classList.remove('hidden')

                supplierField.classList.add('hidden')
            } else {
                supplierField.classList.add('hidden')

                communityField.classList.add('hidden')
            }

        })
    </script>

</body>

</html>