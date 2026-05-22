<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MealBridge – Auth</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: 'Poppins', sans-serif;
            overflow: hidden;
        }

        /* ── BACKGROUND BLOBS ── */
        .blob {
            position: fixed;
            border-radius: 50%;
            filter: blur(80px);
            opacity: 0.35;
            pointer-events: none;
            animation: blobFloat 8s ease-in-out infinite;
        }

        .blob-1 {
            width: 500px; height: 500px;
            background: #C4C3E3;
            top: -120px; left: -120px;
            animation-delay: 0s;
        }

        .blob-2 {
            width: 400px; height: 400px;
            background: #E8C067;
            bottom: -100px; right: -100px;
            animation-delay: 3s;
        }

        .blob-3 {
            width: 300px; height: 300px;
            background: #A3B565;
            top: 40%; left: 30%;
            animation-delay: 5s;
        }

        @keyframes blobFloat {
            0%, 100% { transform: translate(0, 0) scale(1); }
            50%       { transform: translate(20px, -20px) scale(1.05); }
        }

        /* ── GLASS ── */
        .glass {
            background: rgba(255,255,255,0.30);
            backdrop-filter: blur(24px);
            -webkit-backdrop-filter: blur(24px);
            border: 1px solid rgba(255,255,255,0.35);
        }

        .glass-strong {
            background: rgba(255,255,255,0.55);
            backdrop-filter: blur(32px);
            -webkit-backdrop-filter: blur(32px);
            border: 1px solid rgba(255,255,255,0.50);
        }

        /* ── INPUT ── */
        .auth-input {
            width: 100%;
            padding: 13px 18px 13px 46px;
            border-radius: 16px;
            background: rgba(255,255,255,0.60);
            border: 1.5px solid rgba(255,255,255,0.45);
            outline: none;
            font-size: 13px;
            font-family: 'Poppins', sans-serif;
            color: #504E76;
            transition: all .3s ease;
        }

        .auth-input::placeholder { color: rgba(80,78,118,0.38); }

        .auth-input:focus {
            border-color: #504E76;
            box-shadow: 0 0 0 4px rgba(80,78,118,0.10);
            background: white;
        }

        .auth-input.no-icon { padding-left: 18px; }

        .input-wrap { position: relative; }

        .input-wrap .ii {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: rgba(80,78,118,0.40);
            font-size: 17px;
            pointer-events: none;
            transition: color .3s ease;
        }

        .input-wrap:focus-within .ii { color: #504E76; }

        /* textarea icon top-align */
        .input-wrap .ii-top {
            top: 16px;
            transform: none;
        }

        /* ── LABEL ── */
        .auth-label {
            font-size: 11px;
            font-weight: 700;
            color: #504E76;
            letter-spacing: .5px;
            margin-bottom: 7px;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .auth-label::before {
            content: '';
            display: inline-block;
            width: 5px; height: 5px;
            border-radius: 50%;
            background: linear-gradient(135deg, #504E76, #E8C067);
            flex-shrink: 0;
        }

        /* ── BUTTON ── */
        .btn-primary {
            width: 100%;
            padding: 14px;
            border-radius: 16px;
            font-family: 'Poppins', sans-serif;
            font-size: 14px;
            font-weight: 800;
            color: white;
            cursor: pointer;
            transition: all .3s cubic-bezier(.34,1.56,.64,1);
            letter-spacing: .3px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .btn-primary:hover {
            transform: scale(1.02) translateY(-1px);
            box-shadow: 0 12px 28px rgba(80,78,118,0.30);
        }

        .btn-primary:active { transform: scale(0.98); }

        /* ── OVERLAY PANEL ── */
        #overlay {
            transition: left .7s cubic-bezier(.77,0,.18,1),
                        border-radius .7s cubic-bezier(.77,0,.18,1);
        }

        /* ── FORM PANELS ── */
        #loginPage, #registerPage {
            transition: left .7s cubic-bezier(.77,0,.18,1),
                        opacity .4s ease;
        }

        /* ── ROLE CHIP ── */
        .role-chip {
            flex: 1;
            padding: 11px 10px;
            border-radius: 14px;
            border: 1.5px solid rgba(80,78,118,0.15);
            background: rgba(255,255,255,0.50);
            cursor: pointer;
            transition: all .25s ease;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 5px;
        }

        .role-chip:hover {
            border-color: #504E76;
            background: rgba(80,78,118,0.06);
            transform: translateY(-2px);
        }

        .role-chip.active {
            background: #504E76;
            border-color: #504E76;
            color: white;
            box-shadow: 0 6px 16px rgba(80,78,118,0.28);
            transform: translateY(-2px);
        }

        .role-chip.active i, .role-chip.active span { color: white !important; }

        .role-chip span {
            font-size: 11px;
            font-weight: 700;
            color: #504E76;
        }

        /* ── MASCOT ── */
        .mascot {
            transition: transform .4s cubic-bezier(.34,1.56,.64,1), filter .4s ease;
            filter: drop-shadow(0 16px 32px rgba(0,0,0,0.18));
        }

        .mascot:hover {
            transform: rotate(-6deg) scale(1.08);
            filter: drop-shadow(0 24px 40px rgba(0,0,0,0.25));
        }

        /* ── TOGGLE BTN ── */
        #toggleBtn {
            transition: all .3s cubic-bezier(.34,1.56,.64,1);
        }

        #toggleBtn:hover {
            transform: scale(1.05);
            background: white;
            color: #504E76;
            box-shadow: 0 8px 24px rgba(0,0,0,0.15);
        }

        #toggleBtn:active { transform: scale(0.97); }

        /* ── SCROLLBAR inside register ── */
        .register-scroll::-webkit-scrollbar { width: 4px; }
        .register-scroll::-webkit-scrollbar-thumb { background: rgba(80,78,118,0.25); border-radius: 10px; }
        .register-scroll::-webkit-scrollbar-track { background: transparent; }

        /* ── FADE UP ── */
        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(18px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        .fade-up { animation: fadeUp .5s cubic-bezier(.22,.68,0,1.1) both; }
        .d1 { animation-delay: .08s; }
        .d2 { animation-delay: .15s; }
        .d3 { animation-delay: .22s; }
        .d4 { animation-delay: .29s; }
        .d5 { animation-delay: .36s; }

        /* ── FLOATING BADGE ── */
        .float-badge {
            animation: floatBadge 3s ease-in-out infinite;
        }

        @keyframes floatBadge {
            0%, 100% { transform: translateY(0); }
            50%       { transform: translateY(-8px); }
        }

        /* ── SECTION DIVIDER ── */
        .section-div {
            font-size: 10px;
            font-weight: 800;
            letter-spacing: 3px;
            text-transform: uppercase;
            color: rgba(80,78,118,0.40);
            display: flex;
            align-items: center;
            gap: 10px;
            margin: 14px 0 10px;
        }

        .section-div::before, .section-div::after {
            content: '';
            flex: 1;
            height: 1px;
            background: rgba(80,78,118,0.12);
            border-radius: 10px;
        }

        /* ── ERROR MSG ── */
        .err-msg {
            font-size: 11px;
            color: #E53935;
            margin-top: 4px;
            padding-left: 4px;
        }

        /* ── GRADIENT TEXT ── */
        .gradient-text {
            background: linear-gradient(135deg, #504E76, #6E6AB3, #E8C067);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
    </style>
</head>

<body class="min-h-screen overflow-hidden bg-gradient-to-br from-[#FDF8E2] to-[#C4C3E3] flex items-center justify-center">

    <!-- BLOBS -->
    <div class="blob blob-1"></div>
    <div class="blob blob-2"></div>
    <div class="blob blob-3"></div>

    <div id="wrapper" class="relative w-full h-screen overflow-hidden">

        <!-- ══════════════ LOGIN PAGE ══════════════ -->
        <div id="loginPage"
             class="absolute left-0 top-0 w-1/2 h-full
                    flex items-center justify-center z-20 px-8">

            <div class="w-full max-w-[400px]">

                <!-- HEADING -->
                <div class="mb-8 fade-up d1">
                    <h1 class="text-4xl lg:text-5xl font-black gradient-text leading-tight">
                        Welcome Back!
                    </h1>
                    <p class="text-[#504E76]/60 mt-1 text-sm">
                        Sign in to manage your donations 🍱
                    </p>
                </div>

                @if(session('error'))
                <div class="mb-4 flex items-center gap-2 bg-red-100/80 border border-red-200
                            text-red-600 px-4 py-3 rounded-2xl text-sm fade-up">
                    <i class='bx bx-error-circle'></i>
                    {{ session('error') }}
                </div>
                @endif

                <form action="/login" method="POST" class="space-y-4">
                    @csrf

                    <!-- EMAIL -->
                    <div class="fade-up d2">
                        <label class="auth-label">Email Address</label>
                        <div class="input-wrap">
                            <i class='bx bx-envelope ii'></i>
                            <input type="email" name="email" placeholder="hello@mealbridge.id"
                                   class="auth-input" required>
                        </div>
                    </div>

                    <!-- PASSWORD -->
                    <div class="fade-up d3">
                        <label class="auth-label">Password</label>
                        <div class="input-wrap">
                            <i class='bx bx-lock-alt ii'></i>
                            <input type="password" name="password" id="login-pw"
                                   placeholder="••••••••" class="auth-input" required>
                            <button type="button" onclick="togglePw('login-pw','login-eye')"
                                    class="absolute right-14 top-1/2 -translate-y-1/2
                                           text-[#504E76]/40 hover:text-[#504E76] transition-colors">
                                <i class='bx bx-hide text-lg' id="login-eye"></i>
                            </button>
                        </div>
                    </div>

                    <!-- SUBMIT -->
                    <div class="fade-up d4 pt-2">
                        <button type="submit"
                                class="btn-primary bg-gradient-to-r from-[#504E76] to-[#6E6AB3]
                                       hover:from-[#F1642E] hover:to-[#E8824E]">
                            <i class='bx bx-log-in-circle text-lg'></i>
                            Sign In
                        </button>
                    </div>

                </form>

                <!-- STATS BADGES -->
                <div class="flex gap-3 mt-8 fade-up d5">
                    <div class="glass rounded-2xl px-4 py-3 text-center flex-1 float-badge" style="animation-delay:.2s">
                        <h1 class="font-black text-[#504E76] text-lg">500+</h1>
                        <p class="text-[9px] text-[#504E76]/50 uppercase tracking-widest">Donations</p>
                    </div>
                    <div class="glass rounded-2xl px-4 py-3 text-center flex-1 float-badge" style="animation-delay:.8s">
                        <h1 class="font-black text-[#504E76] text-lg">120+</h1>
                        <p class="text-[9px] text-[#504E76]/50 uppercase tracking-widest">Communities</p>
                    </div>
                    <div class="glass rounded-2xl px-4 py-3 text-center flex-1 float-badge" style="animation-delay:1.4s">
                        <h1 class="font-black text-[#504E76] text-lg">2K+</h1>
                        <p class="text-[9px] text-[#504E76]/50 uppercase tracking-widest">Helped</p>
                    </div>
                </div>

            </div>
        </div>

        <!-- ══════════════ REGISTER PAGE ══════════════ -->
        <div id="registerPage"
             class="absolute left-full top-0 w-1/2 h-full
                    flex items-center justify-center z-10 px-8">

            <div class="w-full max-w-[500px] h-full flex items-center">
                <div class="w-full register-scroll overflow-y-auto py-8" style="max-height: 100vh;">

                    <!-- HEADING -->
                    <div class="mb-6">
                        <h1 class="text-3xl lg:text-4xl font-black gradient-text leading-tight">
                            Create Account
                        </h1>
                        <p class="text-[#504E76]/60 mt-1 text-sm">
                            Join MealBridge and start making a difference 🌱
                        </p>
                    </div>

                    <form action="/register" method="POST" class="space-y-3">
                        @csrf

                        <!-- SECTION: PERSONAL -->
                        <div class="section-div">Personal Info</div>

                        <div class="grid grid-cols-2 gap-3">

                            <!-- USERNAME -->
                            <div>
                                <label class="auth-label">Username</label>
                                <div class="input-wrap">
                                    <i class='bx bx-user ii'></i>
                                    <input type="text" name="username" placeholder="yourname"
                                           class="auth-input">
                                </div>
                            </div>

                            <!-- EMAIL -->
                            <div>
                                <label class="auth-label">Email</label>
                                <div class="input-wrap">
                                    <i class='bx bx-envelope ii'></i>
                                    <input type="email" name="email" placeholder="email@example.com"
                                           class="auth-input">
                                </div>
                            </div>

                            <!-- PHONE -->
                            <div>
                                <label class="auth-label">Phone Number</label>
                                <div class="input-wrap">
                                    <i class='bx bx-phone ii'></i>
                                    <input type="text" name="no_telp" placeholder="08xxxxxxxxxx"
                                           class="auth-input">
                                </div>
                            </div>

                            <!-- PASSWORD -->
                            <div>
                                <label class="auth-label">Password</label>
                                <div class="input-wrap">
                                    <i class='bx bx-lock-alt ii'></i>
                                    <input type="password" name="password" id="reg-pw"
                                           placeholder="••••••••" class="auth-input">
                                    <button type="button" onclick="togglePw('reg-pw','reg-eye')"
                                            class="absolute right-3 top-1/2 -translate-y-1/2
                                                   text-[#504E76]/40 hover:text-[#504E76] transition-colors">
                                        <i class='bx bx-hide text-base' id="reg-eye"></i>
                                    </button>
                                </div>
                            </div>

                        </div>

                        <!-- ROLE SECTION -->
                        <div class="section-div">Select Role</div>

                        <input type="hidden" name="role" id="role-input" value="">

                        <div class="flex gap-3">
                            <div class="role-chip" id="chip-supplier" onclick="selectRole('supplier')">
                                <i class='bx bx-store text-2xl text-[#504E76]'></i>
                                <span>Supplier</span>
                            </div>
                            <div class="role-chip" id="chip-community" onclick="selectRole('community')">
                                <i class='bx bx-group text-2xl text-[#504E76]'></i>
                                <span>Community</span>
                            </div>
                        </div>

                        <!-- SUPPLIER FIELDS -->
                        <div id="supplierField" class="hidden space-y-3">
                            <div class="section-div">Store Details</div>
                            <div class="grid grid-cols-2 gap-3">
                                <div>
                                    <label class="auth-label">Store Name</label>
                                    <div class="input-wrap">
                                        <i class='bx bx-store ii'></i>
                                        <input type="text" name="nama_toko" placeholder="Warung Bahagia"
                                               class="auth-input">
                                    </div>
                                </div>
                                <div>
                                    <label class="auth-label">Store Address</label>
                                    <div class="input-wrap">
                                        <i class='bx bx-map ii ii-top'></i>
                                        <textarea name="alamat_toko" placeholder="Jl. Merdeka No. 1..."
                                                  class="auth-input no-icon resize-none" style="height:80px; padding-left:18px;"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- COMMUNITY FIELDS -->
                        <div id="communityField" class="hidden space-y-3">
                            <div class="section-div">Community Details</div>
                            <div class="grid grid-cols-2 gap-3">
                                <div>
                                    <label class="auth-label">Community Name</label>
                                    <div class="input-wrap">
                                        <i class='bx bx-group ii'></i>
                                        <input type="text" name="nama_komunitas" placeholder="Komunitas Peduli"
                                               class="auth-input">
                                    </div>
                                </div>
                                <div>
                                    <label class="auth-label">Purpose</label>
                                    <div class="input-wrap">
                                        <i class='bx bx-target-lock ii ii-top'></i>
                                        <textarea name="tujuan_komunitas" placeholder="Tujuan komunitas..."
                                                  class="auth-input no-icon resize-none" style="height:80px; padding-left:18px;"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <label class="auth-label">Community Address</label>
                                <div class="input-wrap">
                                    <i class='bx bx-map ii'></i>
                                    <input type="text" name="alamat_komunitas" placeholder="Jl. Kebersamaan No. 2..."
                                           class="auth-input">
                                </div>
                            </div>
                        </div>

                        <!-- SUBMIT -->
                        <div class="pt-2">
                            <button type="submit"
                                    class="btn-primary bg-gradient-to-r from-[#A3B565] to-[#7fa34a]
                                           hover:from-[#504E76] hover:to-[#6E6AB3]">
                                <i class='bx bx-user-plus text-lg'></i>
                                Create Account
                            </button>
                        </div>

                    </form>
                </div>
            </div>
        </div>

        <!-- ══════════════ OVERLAY PANEL ══════════════ -->
        <div id="overlay"
             class="absolute top-0 left-1/2 w-1/2 h-full z-30
                    bg-gradient-to-br from-[#504E76] via-[#6E6AB3] to-[#A3B565]
                    rounded-l-[80px]">

            <!-- OVERLAY CONTENT -->
            <div class="w-full h-full flex flex-col items-center justify-center text-center px-10 gap-6">

                <!-- MASCOT + BRAND -->
                <div class="flex flex-col items-center gap-2">
                    <img src="{{ asset('images/mealbridge-mascot.png') }}"
                         alt="MealBridge"
                         class="w-[200px] lg:w-[260px] mascot">

                    <div class="mt-2">
                        <h1 class="text-4xl lg:text-5xl font-black text-white leading-none">
                            MealBridge
                        </h1>
                        <p class="text-white/70 text-sm mt-2">
                            Sharing food. Supporting communities.
                        </p>
                    </div>
                </div>

                <!-- DIVIDER -->
                <div class="w-16 h-1 rounded-full bg-white/30"></div>

                <!-- PANEL TEXT -->
                <div id="overlayText">
                    <p class="text-white/80 text-sm leading-relaxed">
                        Don't have an account yet?<br>Join us and start making a difference today.
                    </p>
                </div>

                <!-- TOGGLE BUTTON -->
                <button id="toggleBtn"
                        class="border-2 border-white text-white px-10 py-3.5 rounded-full
                               font-bold text-sm tracking-wide backdrop-blur-xl">
                    Register
                </button>

                <!-- FEATURE BADGES -->
                <div class="flex gap-2 mt-2" id="featureBadges">
                    <div class="glass rounded-2xl px-3 py-2 float-badge" style="animation-delay:0s">
                        <i class='bx bx-donate-heart text-white text-xl'></i>
                    </div>
                    <div class="glass rounded-2xl px-3 py-2 float-badge" style="animation-delay:.6s">
                        <i class='bx bx-leaf text-white text-xl'></i>
                    </div>
                    <div class="glass rounded-2xl px-3 py-2 float-badge" style="animation-delay:1.2s">
                        <i class='bx bx-group text-white text-xl'></i>
                    </div>
                </div>

            </div>
        </div>

    </div>

    <script>
        // ── PANEL TOGGLE ──
        const overlay      = document.getElementById('overlay');
        const loginPage    = document.getElementById('loginPage');
        const registerPage = document.getElementById('registerPage');
        const toggleBtn    = document.getElementById('toggleBtn');
        const overlayText  = document.getElementById('overlayText');

        let isLogin = true;

        toggleBtn.addEventListener('click', () => {
            if (isLogin) {
                // → show register
                overlay.classList.remove('left-1/2','rounded-l-[80px]');
                overlay.classList.add('left-0','rounded-r-[80px]');
                loginPage.classList.remove('left-0');
                loginPage.classList.add('-left-full');
                registerPage.classList.remove('left-full');
                registerPage.classList.add('left-1/2');
                toggleBtn.innerText = 'Sign In';
                overlayText.innerHTML = '<p class="text-white/80 text-sm leading-relaxed">Already have an account?<br>Sign in and continue your journey.</p>';
            } else {
                // → show login
                overlay.classList.remove('left-0','rounded-r-[80px]');
                overlay.classList.add('left-1/2','rounded-l-[80px]');
                loginPage.classList.remove('-left-full');
                loginPage.classList.add('left-0');
                registerPage.classList.remove('left-1/2');
                registerPage.classList.add('left-full');
                toggleBtn.innerText = 'Register';
                overlayText.innerHTML = '<p class="text-white/80 text-sm leading-relaxed">Don\'t have an account yet?<br>Join us and start making a difference today.</p>';
            }
            isLogin = !isLogin;
        });

        // ── ROLE CHIPS ──
        function selectRole(role) {
            document.getElementById('role-input').value = role;

            // reset chips
            document.querySelectorAll('.role-chip').forEach(c => c.classList.remove('active'));
            document.getElementById('chip-' + role).classList.add('active');

            // show/hide fields
            document.getElementById('supplierField').classList.toggle('hidden', role !== 'supplier');
            document.getElementById('communityField').classList.toggle('hidden', role !== 'community');
        }

        // ── PASSWORD TOGGLE ──
        function togglePw(inputId, eyeId) {
            const input = document.getElementById(inputId);
            const eye   = document.getElementById(eyeId);
            if (input.type === 'password') {
                input.type = 'text';
                eye.classList.replace('bx-hide','bx-show');
            } else {
                input.type = 'password';
                eye.classList.replace('bx-show','bx-hide');
            }
        }
    </script>

</body>
</html>