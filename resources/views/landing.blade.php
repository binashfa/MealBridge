<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MealBridge – Sharing Food, Supporting Communities</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <style>
        * { scroll-behavior: smooth; box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: 'Poppins', sans-serif;
            overflow-x: hidden;
            background: #FDF8E2;
        }

        /* ── BLOBS ── */
        .blob {
            position: fixed;
            border-radius: 50%;
            filter: blur(90px);
            opacity: 0.28;
            pointer-events: none;
            z-index: 0;
            animation: blobFloat 10s ease-in-out infinite;
        }
        .blob-1 { width: 600px; height: 600px; background: #C4C3E3; top: -150px; left: -150px; animation-delay: 0s; }
        .blob-2 { width: 450px; height: 450px; background: #E8C067; bottom: 10%; right: -100px; animation-delay: 3s; }
        .blob-3 { width: 350px; height: 350px; background: #A3B565; top: 40%; left: 35%; animation-delay: 6s; }

        @keyframes blobFloat {
            0%, 100% { transform: translate(0,0) scale(1); }
            50%       { transform: translate(24px,-24px) scale(1.06); }
        }

        /* ── GLASS ── */
        .glass {
            background: rgba(255,255,255,0.32);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid rgba(255,255,255,0.30);
        }

        .glass-dark {
            background: rgba(80,78,118,0.08);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid rgba(80,78,118,0.12);
        }

        /* ── GRADIENT TEXT ── */
        .gradient-text {
            background: linear-gradient(135deg, #504E76, #6E6AB3, #E8C067);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .gradient-text-green {
            background: linear-gradient(135deg, #A3B565, #6E6AB3);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        /* ── SOFT SHADOW ── */
        .soft-shadow { box-shadow: 0 12px 40px rgba(80,78,118,0.12), 0 4px 12px rgba(0,0,0,0.04); }
        .glow-shadow { box-shadow: 0 20px 60px rgba(80,78,118,0.22), 0 8px 20px rgba(0,0,0,0.06); }

        /* ── NAVBAR ── */
        #navbar {
            transition: all .4s ease;
        }
        #navbar.scrolled {
            background: rgba(255,255,255,0.80) !important;
            backdrop-filter: blur(24px);
            box-shadow: 0 4px 24px rgba(80,78,118,0.10);
        }

        .nav-link {
            position: relative;
            font-size: 14px;
            font-weight: 600;
            color: #504E76;
            transition: color .3s ease;
            cursor: pointer;
        }

        .nav-link::after {
            content: '';
            position: absolute;
            bottom: -3px; left: 0;
            width: 0; height: 2px;
            background: linear-gradient(90deg, #504E76, #E8C067);
            border-radius: 10px;
            transition: width .3s ease;
        }

        .nav-link:hover::after { width: 100%; }
        .nav-link:hover { color: #504E76; }

        /* ── BUTTONS ── */
        .btn-primary {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 14px 32px;
            border-radius: 18px;
            font-weight: 800;
            font-size: 14px;
            font-family: 'Poppins', sans-serif;
            cursor: pointer;
            transition: all .3s cubic-bezier(.34,1.56,.64,1);
            letter-spacing: .3px;
        }

        .btn-primary:hover { transform: scale(1.04) translateY(-2px); }
        .btn-primary:active { transform: scale(0.97); }

        .btn-outline {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 13px 30px;
            border-radius: 18px;
            font-weight: 700;
            font-size: 14px;
            font-family: 'Poppins', sans-serif;
            cursor: pointer;
            border: 2px solid rgba(80,78,118,0.25);
            color: #504E76;
            background: rgba(255,255,255,0.50);
            backdrop-filter: blur(12px);
            transition: all .3s cubic-bezier(.34,1.56,.64,1);
        }

        .btn-outline:hover {
            border-color: #504E76;
            background: #504E76;
            color: white;
            transform: scale(1.04) translateY(-2px);
        }

        /* ── HERO MASCOT ── */
        .mascot-hero {
            filter: drop-shadow(0 30px 50px rgba(80,78,118,0.25));
            animation: mascotFloat 5s ease-in-out infinite;
        }

        @keyframes mascotFloat {
            0%, 100% { transform: translateY(0) rotate(0deg); }
            50%       { transform: translateY(-16px) rotate(2deg); }
        }

        /* ── STAT COUNTER CARD ── */
        .stat-card {
            position: relative;
            overflow: hidden;
        }

        .stat-card::before {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0;
            height: 3px;
            background: linear-gradient(90deg, #504E76, #E8C067, #A3B565);
        }

        /* ── FEATURE CARD ── */
        .feature-card {
            transition: all .35s ease;
            cursor: default;
        }

        .feature-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 28px 50px rgba(80,78,118,0.18);
        }

        .feature-icon {
            transition: all .35s cubic-bezier(.34,1.56,.64,1);
        }

        .feature-card:hover .feature-icon {
            transform: scale(1.15) rotate(-8deg);
        }

        /* ── STEP CARD ── */
        .step-connector {
            position: absolute;
            top: 40px;
            left: calc(50% + 60px);
            width: calc(100% - 120px);
            height: 2px;
            background: linear-gradient(90deg, #504E76, #C4C3E3);
            border-radius: 10px;
        }

        .step-card {
            transition: all .35s ease;
        }

        .step-card:hover {
            transform: translateY(-6px);
        }

        .step-num {
            width: 56px; height: 56px;
            border-radius: 18px;
            display: flex; align-items: center; justify-content: center;
            font-weight: 900; font-size: 22px;
            margin: 0 auto 16px;
            transition: all .3s cubic-bezier(.34,1.56,.64,1);
        }

        .step-card:hover .step-num {
            transform: scale(1.1) rotate(-5deg);
        }

        /* ── ROLE CARD ── */
        .role-card {
            transition: all .35s ease;
            position: relative;
            overflow: hidden;
        }

        .role-card::after {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, rgba(80,78,118,0.0), rgba(80,78,118,0.06));
            opacity: 0;
            transition: opacity .35s ease;
            border-radius: inherit;
        }

        .role-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 30px 55px rgba(80,78,118,0.20);
        }

        .role-card:hover::after { opacity: 1; }

        /* ── FLOATING BADGES (hero) ── */
        .hero-badge {
            animation: badgeFloat 4s ease-in-out infinite;
            cursor: default;
            transition: transform .2s ease;
        }

        .hero-badge:hover { transform: scale(1.08) !important; }

        @keyframes badgeFloat {
            0%, 100% { transform: translateY(0); }
            50%       { transform: translateY(-10px); }
        }

        /* ── SCROLL REVEAL ── */
        .reveal {
            opacity: 0;
            transform: translateY(30px);
            transition: opacity .7s ease, transform .7s cubic-bezier(.22,.68,0,1.1);
        }

        .reveal.visible {
            opacity: 1;
            transform: translateY(0);
        }

        /* ── SCROLLBAR ── */
        ::-webkit-scrollbar { width: 6px; }
        ::-webkit-scrollbar-thumb { background: #504E76; border-radius: 50px; }
        ::-webkit-scrollbar-track { background: transparent; }

        /* ── MOBILE MENU ── */
        #mobileMenu {
            transition: all .4s cubic-bezier(.77,0,.18,1);
            transform: translateY(-20px);
            opacity: 0;
            pointer-events: none;
        }

        #mobileMenu.open {
            transform: translateY(0);
            opacity: 1;
            pointer-events: all;
        }

        /* ── SECTION BG ── */
        .section-alt {
            background: linear-gradient(180deg, rgba(196,195,227,0.15) 0%, rgba(255,255,255,0) 100%);
        }
    </style>
</head>

<body>

    <!-- BLOBS -->
    <div class="blob blob-1"></div>
    <div class="blob blob-2"></div>
    <div class="blob blob-3"></div>

    <!-- ════════════════════════════════
         NAVBAR
    ════════════════════════════════ -->
    <nav id="navbar" class="fixed top-0 left-0 right-0 z-50 px-6 lg:px-16 py-4 transition-all duration-300">
        <div class="max-w-7xl mx-auto flex items-center justify-between">

            <!-- LOGO -->
            <a href="#hero" class="flex items-center gap-2 group">
                <img src="{{ asset('images/mealbridge-mascot.png') }}"
                     alt="MealBridge"
                     class="w-10 h-10 object-contain transition-transform duration-300 group-hover:rotate-[-8deg] group-hover:scale-110">
                <span class="text-xl font-black text-[#504E76]">MealBridge</span>
            </a>

            <!-- DESKTOP NAV -->
            <div class="hidden lg:flex items-center gap-8">
                <a href="#features" class="nav-link">Features</a>
                <a href="#how-it-works" class="nav-link">How It Works</a>
                <a href="#roles" class="nav-link">For Who?</a>
                <a href="#cta" class="nav-link">Join Us</a>
            </div>

            <!-- CTA -->
            <div class="hidden lg:flex items-center gap-3">
                <a href="/login" class="btn-outline text-sm py-2.5 px-6">Sign In</a>
                <a href="/register"
                   class="btn-primary bg-gradient-to-r from-[#504E76] to-[#6E6AB3]
                          hover:from-[#F1642E] hover:to-[#E8824E] text-white text-sm py-2.5 px-6 shadow-lg">
                    Get Started
                    <i class='bx bx-right-arrow-alt text-lg'></i>
                </a>
            </div>

            <!-- MOBILE HAMBURGER -->
            <button id="hamburger" class="lg:hidden w-11 h-11 rounded-2xl glass flex items-center justify-center text-[#504E76] transition-all duration-300 hover:bg-[#504E76] hover:text-white">
                <i class='bx bx-menu text-2xl' id="hamburger-icon"></i>
            </button>

        </div>

        <!-- MOBILE MENU -->
        <div id="mobileMenu" class="lg:hidden mt-3 glass rounded-3xl p-5 soft-shadow">
            <div class="flex flex-col gap-2">
                <a href="#features" onclick="closeMenu()" class="flex items-center gap-3 p-3 rounded-2xl hover:bg-white/50 text-[#504E76] font-semibold text-sm transition-all">
                    <i class='bx bx-star text-lg'></i> Features
                </a>
                <a href="#how-it-works" onclick="closeMenu()" class="flex items-center gap-3 p-3 rounded-2xl hover:bg-white/50 text-[#504E76] font-semibold text-sm transition-all">
                    <i class='bx bx-info-circle text-lg'></i> How It Works
                </a>
                <a href="#roles" onclick="closeMenu()" class="flex items-center gap-3 p-3 rounded-2xl hover:bg-white/50 text-[#504E76] font-semibold text-sm transition-all">
                    <i class='bx bx-group text-lg'></i> For Who?
                </a>
                <hr class="border-white/30 my-1">
                <a href="/login" class="flex items-center justify-center gap-2 p-3 rounded-2xl border-2 border-[#504E76]/20 text-[#504E76] font-bold text-sm transition-all hover:bg-[#504E76]/08">
                    Sign In
                </a>
                <a href="/register"
                   class="flex items-center justify-center gap-2 p-3 rounded-2xl
                          bg-gradient-to-r from-[#504E76] to-[#6E6AB3] text-white font-bold text-sm">
                    Get Started <i class='bx bx-right-arrow-alt text-lg'></i>
                </a>
            </div>
        </div>
    </nav>

    <!-- ════════════════════════════════
         HERO
    ════════════════════════════════ -->
    <section id="hero" class="relative min-h-screen flex items-center pt-24 pb-16 px-6 lg:px-16 overflow-hidden">
        <div class="max-w-7xl mx-auto w-full">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">

                <!-- LEFT -->
                <div class="relative z-10">

                    <!-- PILL BADGE -->
                    <div class="inline-flex items-center gap-2 glass rounded-full px-4 py-2 mb-6 soft-shadow reveal">
                        <span class="w-2 h-2 rounded-full bg-[#A3B565] animate-pulse"></span>
                        <span class="text-xs font-bold text-[#504E76] tracking-wide">
                            Reducing Food Waste • Empowering Communities
                        </span>
                    </div>

                    <!-- HEADLINE -->
                    <h1 class="text-5xl lg:text-7xl font-black leading-[1.1] mb-6 reveal" style="transition-delay:.1s">
                        <span class="text-[#504E76]">Bridge the</span><br>
                        <span class="gradient-text">Food Gap</span><br>
                        <span class="text-[#504E76]">Together.</span>
                    </h1>

                    <p class="text-[#504E76]/65 text-base lg:text-lg leading-relaxed mb-8 max-w-[480px] reveal" style="transition-delay:.2s">
                        MealBridge connects restaurants & suppliers with communities in need —
                        turning surplus food into shared meals, one donation at a time.
                    </p>

                    <!-- BUTTONS -->
                    <div class="flex flex-wrap gap-4 mb-10 reveal" style="transition-delay:.3s">
                        <a href="/register"
                           class="btn-primary bg-gradient-to-r from-[#504E76] to-[#6E6AB3]
                                  hover:from-[#F1642E] hover:to-[#E8824E] text-white shadow-xl">
                            <i class='bx bx-donate-heart text-xl'></i>
                            Start Donating
                        </a>
                        <a href="#how-it-works" class="btn-outline">
                            <i class='bx bx-play-circle text-xl'></i>
                            How It Works
                        </a>
                    </div>

                    <!-- STATS -->
                    <div class="flex flex-wrap gap-4 reveal" style="transition-delay:.4s">
                        <div class="stat-card glass rounded-2xl px-5 py-4 soft-shadow">
                            <h1 class="text-2xl font-black text-[#504E76]">500+</h1>
                            <p class="text-[10px] text-[#504E76]/50 uppercase tracking-widest mt-0.5">Donations Made</p>
                        </div>
                        <div class="stat-card glass rounded-2xl px-5 py-4 soft-shadow">
                            <h1 class="text-2xl font-black text-[#504E76]">120+</h1>
                            <p class="text-[10px] text-[#504E76]/50 uppercase tracking-widest mt-0.5">Communities</p>
                        </div>
                        <div class="stat-card glass rounded-2xl px-5 py-4 soft-shadow">
                            <h1 class="text-2xl font-black text-[#504E76]">2K+</h1>
                            <p class="text-[10px] text-[#504E76]/50 uppercase tracking-widest mt-0.5">People Helped</p>
                        </div>
                    </div>

                </div>

                <!-- RIGHT – MASCOT + FLOATING BADGES -->
                <div class="relative flex items-center justify-center reveal" style="transition-delay:.2s">

                    <!-- BG CIRCLE -->
                    <div class="absolute w-[360px] h-[360px] lg:w-[460px] lg:h-[460px] rounded-full
                                bg-gradient-to-br from-[#C4C3E3]/50 to-[#E8C067]/30
                                blur-sm"></div>

                    <!-- MASCOT -->
                    <img src="{{ asset('images/mealbridge-mascot.png') }}"
                         alt="MealBridge Mascot"
                         class="relative z-10 w-[260px] lg:w-[360px] mascot-hero">

                    <!-- FLOATING BADGE – DONATIONS -->
                    <div class="hero-badge absolute top-8 -left-4 lg:left-0 glass rounded-2xl px-4 py-3 soft-shadow"
                         style="animation-delay:.0s">
                        <div class="flex items-center gap-2">
                            <div class="w-9 h-9 rounded-xl bg-[#504E76] flex items-center justify-center">
                                <i class='bx bx-donate-heart text-white text-lg'></i>
                            </div>
                            <div>
                                <h1 class="font-black text-[#504E76] text-sm">New Donation!</h1>
                                <p class="text-[10px] text-[#504E76]/55">Nasi Kotak • 30 portions</p>
                            </div>
                        </div>
                    </div>

                    <!-- FLOATING BADGE – CLAIMED -->
                    <div class="hero-badge absolute bottom-12 -right-2 lg:right-4 glass rounded-2xl px-4 py-3 soft-shadow"
                         style="animation-delay:1.5s">
                        <div class="flex items-center gap-2">
                            <div class="w-9 h-9 rounded-xl bg-[#A3B565] flex items-center justify-center">
                                <i class='bx bx-check-circle text-white text-lg'></i>
                            </div>
                            <div>
                                <h1 class="font-black text-[#504E76] text-sm">Claimed!</h1>
                                <p class="text-[10px] text-[#504E76]/55">Community Peduli • 15 pax</p>
                            </div>
                        </div>
                    </div>

                    <!-- FLOATING BADGE – POINTS -->
                    <div class="hero-badge absolute top-1/2 -right-6 lg:-right-2 glass rounded-2xl px-4 py-3 soft-shadow"
                         style="animation-delay:3s">
                        <div class="flex items-center gap-2">
                            <div class="w-9 h-9 rounded-xl bg-[#E8C067] flex items-center justify-center">
                                <i class='bx bx-coin text-white text-lg'></i>
                            </div>
                            <div>
                                <h1 class="font-black text-[#504E76] text-sm">+50 Points</h1>
                                <p class="text-[10px] text-[#504E76]/55">Daily reward added</p>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>

        <!-- SCROLL INDICATOR -->
        <div class="absolute bottom-8 left-1/2 -translate-x-1/2 flex flex-col items-center gap-2 opacity-50">
            <span class="text-[10px] text-[#504E76] uppercase tracking-widest font-bold">Scroll</span>
            <div class="w-5 h-8 rounded-full border-2 border-[#504E76]/40 flex items-start justify-center pt-1.5">
                <div class="w-1 h-2 rounded-full bg-[#504E76] animate-bounce"></div>
            </div>
        </div>
    </section>

    <!-- ════════════════════════════════
         FEATURES
    ════════════════════════════════ -->
    <section id="features" class="relative py-20 lg:py-28 px-6 lg:px-16 section-alt">
        <div class="max-w-7xl mx-auto">

            <!-- HEADER -->
            <div class="text-center mb-14 reveal">
                <div class="inline-flex items-center gap-2 glass rounded-full px-4 py-2 mb-4">
                    <i class='bx bx-star text-[#E8C067] text-sm'></i>
                    <span class="text-xs font-bold text-[#504E76] tracking-wide">Platform Features</span>
                </div>
                <h2 class="text-4xl lg:text-5xl font-black text-[#504E76] mb-4">
                    Everything You Need to<br>
                    <span class="gradient-text">Make a Difference</span>
                </h2>
                <p class="text-[#504E76]/60 text-base max-w-xl mx-auto">
                    From donating surplus food to claiming meals — MealBridge makes it simple, transparent, and impactful.
                </p>
            </div>

            <!-- FEATURES GRID -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">

                <!-- CARD 1 -->
                <div class="feature-card glass rounded-3xl p-6 soft-shadow reveal" style="transition-delay:.05s">
                    <div class="feature-icon w-14 h-14 rounded-2xl bg-[#504E76] flex items-center justify-center mb-5 shadow-lg">
                        <i class='bx bx-donate-heart text-white text-2xl'></i>
                    </div>
                    <h3 class="text-lg font-black text-[#504E76] mb-2">Easy Donations</h3>
                    <p class="text-[#504E76]/60 text-sm leading-relaxed">
                        Suppliers can post surplus food in under 2 minutes — with photo, location, quantity, and pickup time.
                    </p>
                </div>

                <!-- CARD 2 -->
                <div class="feature-card glass rounded-3xl p-6 soft-shadow reveal" style="transition-delay:.10s">
                    <div class="feature-icon w-14 h-14 rounded-2xl bg-[#A3B565] flex items-center justify-center mb-5 shadow-lg">
                        <i class='bx bx-coin-stack text-white text-2xl'></i>
                    </div>
                    <h3 class="text-lg font-black text-[#504E76] mb-2">Daily Points System</h3>
                    <p class="text-[#504E76]/60 text-sm leading-relaxed">
                        Every community member receives daily points automatically — a fair, transparent currency to claim food.
                    </p>
                </div>

                <!-- CARD 3 -->
                <div class="feature-card glass rounded-3xl p-6 soft-shadow reveal" style="transition-delay:.15s">
                    <div class="feature-icon w-14 h-14 rounded-2xl bg-[#E8C067] flex items-center justify-center mb-5 shadow-lg">
                        <i class='bx bx-qr-scan text-white text-2xl'></i>
                    </div>
                    <h3 class="text-lg font-black text-[#504E76] mb-2">Digital Claim Code</h3>
                    <p class="text-[#504E76]/60 text-sm leading-relaxed">
                        Each claim generates a unique digital code. Suppliers verify it on pickup — zero paper, full accountability.
                    </p>
                </div>

                <!-- CARD 4 -->
                <div class="feature-card glass rounded-3xl p-6 soft-shadow reveal" style="transition-delay:.20s">
                    <div class="feature-icon w-14 h-14 rounded-2xl bg-[#F1642E] flex items-center justify-center mb-5 shadow-lg">
                        <i class='bx bx-map-pin text-white text-2xl'></i>
                    </div>
                    <h3 class="text-lg font-black text-[#504E76] mb-2">Live Location Map</h3>
                    <p class="text-[#504E76]/60 text-sm leading-relaxed">
                        Auto-detect supplier location and show it on an interactive map so communities know exactly where to go.
                    </p>
                </div>

                <!-- CARD 5 -->
                <div class="feature-card glass rounded-3xl p-6 soft-shadow reveal" style="transition-delay:.25s">
                    <div class="feature-icon w-14 h-14 rounded-2xl bg-[#6E6AB3] flex items-center justify-center mb-5 shadow-lg">
                        <i class='bx bx-bar-chart-alt-2 text-white text-2xl'></i>
                    </div>
                    <h3 class="text-lg font-black text-[#504E76] mb-2">Impact Dashboard</h3>
                    <p class="text-[#504E76]/60 text-sm leading-relaxed">
                        Track total donations, communities helped, and portions distributed — all in one beautiful dashboard.
                    </p>
                </div>

                <!-- CARD 6 -->
                <div class="feature-card glass rounded-3xl p-6 soft-shadow reveal" style="transition-delay:.30s">
                    <div class="feature-icon w-14 h-14 rounded-2xl bg-gradient-to-br from-[#504E76] to-[#A3B565] flex items-center justify-center mb-5 shadow-lg">
                        <i class='bx bx-shield-check text-white text-2xl'></i>
                    </div>
                    <h3 class="text-lg font-black text-[#504E76] mb-2">Multi-Role Access</h3>
                    <p class="text-[#504E76]/60 text-sm leading-relaxed">
                        Separate dashboards for suppliers, community members, and admins — each with the right tools and permissions.
                    </p>
                </div>

            </div>
        </div>
    </section>

    <!-- ════════════════════════════════
         HOW IT WORKS
    ════════════════════════════════ -->
    <section id="how-it-works" class="relative py-20 lg:py-28 px-6 lg:px-16">
        <div class="max-w-7xl mx-auto">

            <!-- HEADER -->
            <div class="text-center mb-16 reveal">
                <div class="inline-flex items-center gap-2 glass rounded-full px-4 py-2 mb-4">
                    <i class='bx bx-info-circle text-[#6E6AB3] text-sm'></i>
                    <span class="text-xs font-bold text-[#504E76] tracking-wide">Simple Process</span>
                </div>
                <h2 class="text-4xl lg:text-5xl font-black text-[#504E76] mb-4">
                    How <span class="gradient-text">MealBridge</span> Works
                </h2>
                <p class="text-[#504E76]/60 text-base max-w-lg mx-auto">
                    Two sides, one platform. Whether you're giving or receiving — it takes just a few steps.
                </p>
            </div>

            <!-- SUPPLIER FLOW -->
            <div class="mb-16 reveal">
                <div class="flex items-center gap-3 mb-8">
                    <div class="w-10 h-10 rounded-2xl bg-[#504E76] flex items-center justify-center shadow-lg">
                        <i class='bx bx-store text-white text-lg'></i>
                    </div>
                    <div>
                        <h3 class="font-black text-[#504E76] text-lg">For Suppliers</h3>
                        <p class="text-[#504E76]/55 text-xs">Restaurants, catering & food businesses</p>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                    <!-- STEP -->
                    <div class="step-card glass rounded-3xl p-5 soft-shadow text-center reveal" style="transition-delay:.05s">
                        <div class="step-num bg-[#504E76] text-white mx-auto">1</div>
                        <div class="w-10 h-10 rounded-2xl bg-[#504E76]/10 flex items-center justify-center mx-auto mb-3">
                            <i class='bx bx-user-plus text-[#504E76] text-xl'></i>
                        </div>
                        <h4 class="font-black text-[#504E76] text-sm mb-1">Register</h4>
                        <p class="text-[#504E76]/55 text-xs leading-relaxed">Sign up as a supplier and get your store verified</p>
                    </div>

                    <div class="step-card glass rounded-3xl p-5 soft-shadow text-center reveal" style="transition-delay:.10s">
                        <div class="step-num bg-[#6E6AB3] text-white mx-auto">2</div>
                        <div class="w-10 h-10 rounded-2xl bg-[#6E6AB3]/10 flex items-center justify-center mx-auto mb-3">
                            <i class='bx bx-plus-circle text-[#6E6AB3] text-xl'></i>
                        </div>
                        <h4 class="font-black text-[#504E76] text-sm mb-1">Post Donation</h4>
                        <p class="text-[#504E76]/55 text-xs leading-relaxed">Upload surplus food with photo, quantity & pickup time</p>
                    </div>

                    <div class="step-card glass rounded-3xl p-5 soft-shadow text-center reveal" style="transition-delay:.15s">
                        <div class="step-num bg-[#A3B565] text-white mx-auto">3</div>
                        <div class="w-10 h-10 rounded-2xl bg-[#A3B565]/15 flex items-center justify-center mx-auto mb-3">
                            <i class='bx bx-check-square text-[#A3B565] text-xl'></i>
                        </div>
                        <h4 class="font-black text-[#504E76] text-sm mb-1">Approve Claims</h4>
                        <p class="text-[#504E76]/55 text-xs leading-relaxed">Accept community requests and prepare the food</p>
                    </div>

                    <div class="step-card glass rounded-3xl p-5 soft-shadow text-center reveal" style="transition-delay:.20s">
                        <div class="step-num bg-[#E8C067] text-white mx-auto">4</div>
                        <div class="w-10 h-10 rounded-2xl bg-[#E8C067]/20 flex items-center justify-center mx-auto mb-3">
                            <i class='bx bx-package text-[#E8C067] text-xl'></i>
                        </div>
                        <h4 class="font-black text-[#504E76] text-sm mb-1">Send & Complete</h4>
                        <p class="text-[#504E76]/55 text-xs leading-relaxed">Dispatch the donation and confirm delivery with proof photo</p>
                    </div>
                </div>
            </div>

            <!-- COMMUNITY FLOW -->
            <div class="reveal">
                <div class="flex items-center gap-3 mb-8">
                    <div class="w-10 h-10 rounded-2xl bg-[#A3B565] flex items-center justify-center shadow-lg">
                        <i class='bx bx-group text-white text-lg'></i>
                    </div>
                    <div>
                        <h3 class="font-black text-[#504E76] text-lg">For Communities</h3>
                        <p class="text-[#504E76]/55 text-xs">Groups, organizations & individuals in need</p>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                    <div class="step-card glass rounded-3xl p-5 soft-shadow text-center reveal" style="transition-delay:.05s">
                        <div class="step-num bg-[#504E76] text-white mx-auto">1</div>
                        <div class="w-10 h-10 rounded-2xl bg-[#504E76]/10 flex items-center justify-center mx-auto mb-3">
                            <i class='bx bx-user-plus text-[#504E76] text-xl'></i>
                        </div>
                        <h4 class="font-black text-[#504E76] text-sm mb-1">Register</h4>
                        <p class="text-[#504E76]/55 text-xs leading-relaxed">Sign up as a community and complete your profile</p>
                    </div>

                    <div class="step-card glass rounded-3xl p-5 soft-shadow text-center reveal" style="transition-delay:.10s">
                        <div class="step-num bg-[#6E6AB3] text-white mx-auto">2</div>
                        <div class="w-10 h-10 rounded-2xl bg-[#6E6AB3]/10 flex items-center justify-center mx-auto mb-3">
                            <i class='bx bx-coin text-[#6E6AB3] text-xl'></i>
                        </div>
                        <h4 class="font-black text-[#504E76] text-sm mb-1">Get Daily Points</h4>
                        <p class="text-[#504E76]/55 text-xs leading-relaxed">Receive free points every day — automatically, no action needed</p>
                    </div>

                    <div class="step-card glass rounded-3xl p-5 soft-shadow text-center reveal" style="transition-delay:.15s">
                        <div class="step-num bg-[#A3B565] text-white mx-auto">3</div>
                        <div class="w-10 h-10 rounded-2xl bg-[#A3B565]/15 flex items-center justify-center mx-auto mb-3">
                            <i class='bx bx-search-alt text-[#A3B565] text-xl'></i>
                        </div>
                        <h4 class="font-black text-[#504E76] text-sm mb-1">Find Food</h4>
                        <p class="text-[#504E76]/55 text-xs leading-relaxed">Browse available donations near you and use points to claim</p>
                    </div>

                    <div class="step-card glass rounded-3xl p-5 soft-shadow text-center reveal" style="transition-delay:.20s">
                        <div class="step-num bg-[#E8C067] text-white mx-auto">4</div>
                        <div class="w-10 h-10 rounded-2xl bg-[#E8C067]/20 flex items-center justify-center mx-auto mb-3">
                            <i class='bx bx-smile text-[#E8C067] text-xl'></i>
                        </div>
                        <h4 class="font-black text-[#504E76] text-sm mb-1">Pick Up & Enjoy</h4>
                        <p class="text-[#504E76]/55 text-xs leading-relaxed">Show your claim code at pickup and receive your food</p>
                    </div>
                </div>
            </div>

        </div>
    </section>

    <!-- ════════════════════════════════
         FOR WHO (ROLES)
    ════════════════════════════════ -->
    <section id="roles" class="relative py-20 lg:py-28 px-6 lg:px-16 section-alt">
        <div class="max-w-7xl mx-auto">

            <!-- HEADER -->
            <div class="text-center mb-14 reveal">
                <div class="inline-flex items-center gap-2 glass rounded-full px-4 py-2 mb-4">
                    <i class='bx bx-group text-[#A3B565] text-sm'></i>
                    <span class="text-xs font-bold text-[#504E76] tracking-wide">Who Is It For?</span>
                </div>
                <h2 class="text-4xl lg:text-5xl font-black text-[#504E76] mb-4">
                    Built for <span class="gradient-text">Both Sides</span>
                </h2>
                <p class="text-[#504E76]/60 text-base max-w-lg mx-auto">
                    Whether you have food to give or need to receive — MealBridge has a place for you.
                </p>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

                <!-- SUPPLIER CARD -->
                <div class="role-card glass rounded-3xl p-8 soft-shadow reveal" style="transition-delay:.05s">
                    <div class="flex items-center gap-4 mb-6">
                        <div class="w-16 h-16 rounded-3xl bg-gradient-to-br from-[#504E76] to-[#6E6AB3]
                                    flex items-center justify-center shadow-xl">
                            <i class='bx bx-store text-white text-3xl'></i>
                        </div>
                        <div>
                            <h3 class="text-2xl font-black text-[#504E76]">Supplier</h3>
                            <p class="text-[#504E76]/55 text-sm">Restaurants, Catering & Food Business</p>
                        </div>
                    </div>

                    <div class="space-y-3 mb-7">
                        <div class="flex items-start gap-3">
                            <div class="w-6 h-6 rounded-lg bg-[#504E76]/12 flex items-center justify-center shrink-0 mt-0.5">
                                <i class='bx bx-check text-[#504E76] text-sm font-bold'></i>
                            </div>
                            <p class="text-[#504E76]/70 text-sm">Post surplus food in under 2 minutes</p>
                        </div>
                        <div class="flex items-start gap-3">
                            <div class="w-6 h-6 rounded-lg bg-[#504E76]/12 flex items-center justify-center shrink-0 mt-0.5">
                                <i class='bx bx-check text-[#504E76] text-sm font-bold'></i>
                            </div>
                            <p class="text-[#504E76]/70 text-sm">Reduce food waste and operational cost</p>
                        </div>
                        <div class="flex items-start gap-3">
                            <div class="w-6 h-6 rounded-lg bg-[#504E76]/12 flex items-center justify-center shrink-0 mt-0.5">
                                <i class='bx bx-check text-[#504E76] text-sm font-bold'></i>
                            </div>
                            <p class="text-[#504E76]/70 text-sm">Get documented social impact reports</p>
                        </div>
                        <div class="flex items-start gap-3">
                            <div class="w-6 h-6 rounded-lg bg-[#504E76]/12 flex items-center justify-center shrink-0 mt-0.5">
                                <i class='bx bx-check text-[#504E76] text-sm font-bold'></i>
                            </div>
                            <p class="text-[#504E76]/70 text-sm">Approve, send, and track every donation</p>
                        </div>
                    </div>

                    <a href="/register"
                       class="btn-primary bg-gradient-to-r from-[#504E76] to-[#6E6AB3]
                              hover:from-[#F1642E] hover:to-[#E8824E] text-white w-full justify-center shadow-lg">
                        <i class='bx bx-store text-xl'></i>
                        Join as Supplier
                    </a>
                </div>

                <!-- COMMUNITY CARD -->
                <div class="role-card glass rounded-3xl p-8 soft-shadow reveal" style="transition-delay:.10s">
                    <div class="flex items-center gap-4 mb-6">
                        <div class="w-16 h-16 rounded-3xl bg-gradient-to-br from-[#A3B565] to-[#6E6AB3]
                                    flex items-center justify-center shadow-xl">
                            <i class='bx bx-group text-white text-3xl'></i>
                        </div>
                        <div>
                            <h3 class="text-2xl font-black text-[#504E76]">Community</h3>
                            <p class="text-[#504E76]/55 text-sm">Organizations, Groups & Individuals</p>
                        </div>
                    </div>

                    <div class="space-y-3 mb-7">
                        <div class="flex items-start gap-3">
                            <div class="w-6 h-6 rounded-lg bg-[#A3B565]/18 flex items-center justify-center shrink-0 mt-0.5">
                                <i class='bx bx-check text-[#A3B565] text-sm font-bold'></i>
                            </div>
                            <p class="text-[#504E76]/70 text-sm">Receive daily points — free, every single day</p>
                        </div>
                        <div class="flex items-start gap-3">
                            <div class="w-6 h-6 rounded-lg bg-[#A3B565]/18 flex items-center justify-center shrink-0 mt-0.5">
                                <i class='bx bx-check text-[#A3B565] text-sm font-bold'></i>
                            </div>
                            <p class="text-[#504E76]/70 text-sm">Browse and claim food donations near you</p>
                        </div>
                        <div class="flex items-start gap-3">
                            <div class="w-6 h-6 rounded-lg bg-[#A3B565]/18 flex items-center justify-center shrink-0 mt-0.5">
                                <i class='bx bx-check text-[#A3B565] text-sm font-bold'></i>
                            </div>
                            <p class="text-[#504E76]/70 text-sm">No fees, no forms — just sign up and claim</p>
                        </div>
                        <div class="flex items-start gap-3">
                            <div class="w-6 h-6 rounded-lg bg-[#A3B565]/18 flex items-center justify-center shrink-0 mt-0.5">
                                <i class='bx bx-check text-[#A3B565] text-sm font-bold'></i>
                            </div>
                            <p class="text-[#504E76]/70 text-sm">Digital claim code for hassle-free pickup</p>
                        </div>
                    </div>

                    <a href="/register"
                       class="btn-primary bg-gradient-to-r from-[#A3B565] to-[#7fa34a]
                              hover:from-[#504E76] hover:to-[#6E6AB3] text-white w-full justify-center shadow-lg">
                        <i class='bx bx-group text-xl'></i>
                        Join as Community
                    </a>
                </div>

            </div>
        </div>
    </section>

    <!-- ════════════════════════════════
         CTA
    ════════════════════════════════ -->
    <section id="cta" class="relative py-20 lg:py-28 px-6 lg:px-16">
        <div class="max-w-5xl mx-auto reveal">

            <div class="relative overflow-hidden rounded-[40px] p-10 lg:p-16 text-center
                        bg-gradient-to-br from-[#504E76] via-[#6E6AB3] to-[#A3B565] glow-shadow">

                <!-- BG BLOBS INSIDE CTA -->
                <div class="absolute w-64 h-64 rounded-full bg-white/10 blur-3xl -top-10 -left-10"></div>
                <div class="absolute w-48 h-48 rounded-full bg-[#E8C067]/20 blur-2xl -bottom-8 -right-8"></div>

                <!-- MASCOT SMALL -->
                <img src="{{ asset('images/mealbridge-mascot.png') }}"
                     alt="MealBridge"
                     class="w-24 mx-auto mb-6 relative z-10 mascot-hero"
                     style="animation-duration: 3s;">

                <h2 class="text-4xl lg:text-6xl font-black text-white mb-4 relative z-10">
                    Ready to Bridge<br>the Food Gap?
                </h2>

                <p class="text-white/70 text-base lg:text-lg mb-10 max-w-xl mx-auto relative z-10">
                    Join hundreds of suppliers and communities already making a real difference — one meal at a time.
                </p>

                <div class="flex flex-wrap gap-4 justify-center relative z-10">
                    <a href="/login"
                       class="btn-outline border-white/40 text-white hover:bg-white hover:text-[#504E76]">
                        <i class='bx bx-log-in-circle text-xl'></i>
                        Sign In
                    </a>
                </div>

                <!-- SDGs BADGES -->
                <div class="flex flex-wrap gap-3 justify-center mt-10 relative z-10">
                    <div class="glass rounded-2xl px-4 py-2 flex items-center gap-2">
                        <span class="text-lg">🌍</span>
                        <span class="text-white/80 text-xs font-bold">SDGs 2 – Zero Hunger</span>
                    </div>
                    <div class="glass rounded-2xl px-4 py-2 flex items-center gap-2">
                        <span class="text-lg">♻️</span>
                        <span class="text-white/80 text-xs font-bold">SDGs 12 – Responsible Consumption</span>
                    </div>
                    <div class="glass rounded-2xl px-4 py-2 flex items-center gap-2">
                        <span class="text-lg">🤝</span>
                        <span class="text-white/80 text-xs font-bold">SDGs 10 – Reduced Inequalities</span>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- ════════════════════════════════
         FOOTER
    ════════════════════════════════ -->
    <footer class="relative bg-[#504E76] text-white px-6 lg:px-16 pt-14 pb-8">

        <div class="max-w-7xl mx-auto">

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-10 mb-12">

                <!-- BRAND -->
                <div class="lg:col-span-2">
                    <div class="flex items-center gap-3 mb-4">
                        <img src="{{ asset('images/mealbridge-mascot.png') }}"
                             alt="MealBridge" class="w-12 brightness-0 invert opacity-90">
                        <h1 class="text-2xl font-black">MealBridge</h1>
                    </div>
                    <p class="text-white/60 text-sm leading-relaxed max-w-xs mb-5">
                        Connecting food surplus with communities in need. A platform built on transparency, dignity, and shared responsibility.
                    </p>
                    <div class="flex gap-3">
                        <a href="#" class="w-10 h-10 rounded-xl bg-white/10 hover:bg-white/20 flex items-center justify-center transition-all duration-300 hover:scale-110">
                            <i class='bx bxl-instagram text-lg'></i>
                        </a>
                        <a href="#" class="w-10 h-10 rounded-xl bg-white/10 hover:bg-white/20 flex items-center justify-center transition-all duration-300 hover:scale-110">
                            <i class='bx bxl-twitter text-lg'></i>
                        </a>
                        <a href="#" class="w-10 h-10 rounded-xl bg-white/10 hover:bg-white/20 flex items-center justify-center transition-all duration-300 hover:scale-110">
                            <i class='bx bxl-linkedin text-lg'></i>
                        </a>
                    </div>
                </div>

                <!-- QUICK LINKS -->
                <div>
                    <h4 class="font-black text-sm uppercase tracking-widest text-white/50 mb-4">Platform</h4>
                    <div class="space-y-3">
                        <a href="#features" class="block text-sm text-white/70 hover:text-white transition-colors hover:translate-x-1 transform duration-200">Features</a>
                        <a href="#how-it-works" class="block text-sm text-white/70 hover:text-white transition-colors hover:translate-x-1 transform duration-200">How It Works</a>
                        <a href="#roles" class="block text-sm text-white/70 hover:text-white transition-colors hover:translate-x-1 transform duration-200">For Suppliers</a>
                        <a href="#roles" class="block text-sm text-white/70 hover:text-white transition-colors hover:translate-x-1 transform duration-200">For Communities</a>
                    </div>
                </div>

                <!-- CONTACT -->
                <div>
                    <h4 class="font-black text-sm uppercase tracking-widest text-white/50 mb-4">Contact</h4>
                    <div class="space-y-3">
                        <div class="flex items-start gap-2 text-sm text-white/70">
                            <i class='bx bx-map-pin mt-0.5 shrink-0'></i>
                            <span>Politeknik Negeri Jakarta<br>Depok, Jawa Barat</span>
                        </div>
                        <div class="flex items-center gap-2 text-sm text-white/70">
                            <i class='bx bx-envelope shrink-0'></i>
                            <span>hello@mealbridge.id</span>
                        </div>
                        <div class="flex items-center gap-2 text-sm text-white/70">
                            <i class='bx bx-globe shrink-0'></i>
                            <span>mealbridge.id</span>
                        </div>
                    </div>
                </div>

            </div>

            <!-- BOTTOM BAR -->
            <div class="border-t border-white/15 pt-6 flex flex-col md:flex-row items-center justify-between gap-3">
                <p class="text-white/40 text-xs">
                    © 2026 MealBridge. Built with ❤️ by Tim Icikiwir — Politeknik Negeri Jakarta.
                </p>
                <div class="flex gap-4">
                    <a href="#" class="text-white/40 hover:text-white/70 text-xs transition-colors">Privacy Policy</a>
                    <a href="#" class="text-white/40 hover:text-white/70 text-xs transition-colors">Terms of Use</a>
                </div>
            </div>

        </div>
    </footer>

    <script>
        // ── NAVBAR SCROLL ──
        const navbar = document.getElementById('navbar');
        window.addEventListener('scroll', () => {
            navbar.classList.toggle('scrolled', window.scrollY > 40);
        });

        // ── MOBILE MENU ──
        const hamburger     = document.getElementById('hamburger');
        const hamburgerIcon = document.getElementById('hamburger-icon');
        const mobileMenu    = document.getElementById('mobileMenu');
        let menuOpen = false;

        hamburger.addEventListener('click', () => {
            menuOpen = !menuOpen;
            mobileMenu.classList.toggle('open', menuOpen);
            hamburgerIcon.className = menuOpen ? 'bx bx-x text-2xl' : 'bx bx-menu text-2xl';
        });

        function closeMenu() {
            menuOpen = false;
            mobileMenu.classList.remove('open');
            hamburgerIcon.className = 'bx bx-menu text-2xl';
        }

        // ── SCROLL REVEAL ──
        const reveals = document.querySelectorAll('.reveal');
        const observer = new IntersectionObserver((entries) => {
            entries.forEach((entry, i) => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('visible');
                    observer.unobserve(entry.target);
                }
            });
        }, { threshold: 0.12 });

        reveals.forEach(el => observer.observe(el));
    </script>

</body>
</html>