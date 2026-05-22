<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MealBridge — Share Food, Change Lives</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&family=Playfair+Display:ital,wght@0,700;0,900;1,700&display=swap" rel="stylesheet">

    <style>
        * { scroll-behavior: smooth; box-sizing: border-box; }

        body {
            font-family: 'Poppins', sans-serif;
            overflow-x: hidden;
            background: #FAF7ED;
            color: #504E76;
        }

        /* ── GLASS ── */
        .glass {
            background: rgba(255, 255, 255, 0.40);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.35);
        }

        /* ── GRADIENT TEXT ── */
        .gradient-text {
            background: linear-gradient(135deg, #504E76 0%, #6E6AB3 50%, #E8C067 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        /* ── NOISE OVERLAY ── */
        body::before {
            content: '';
            position: fixed;
            inset: 0;
            background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 256 256' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='noise'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.9' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23noise)' opacity='0.03'/%3E%3C/svg%3E");
            pointer-events: none;
            z-index: 0;
            opacity: .5;
        }

        /* ── ORBS ── */
        .orb {
            position: absolute;
            border-radius: 50%;
            filter: blur(80px);
            pointer-events: none;
        }

        /* ── NAVBAR ── */
        .navbar {
            position: fixed;
            top: 16px;
            left: 50%;
            transform: translateX(-50%);
            z-index: 100;
            width: calc(100% - 40px);
            max-width: 1100px;
            background: rgba(255,255,255,0.55);
            backdrop-filter: blur(22px);
            -webkit-backdrop-filter: blur(22px);
            border: 1px solid rgba(255,255,255,0.5);
            border-radius: 20px;
            padding: 14px 24px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            box-shadow: 0 8px 32px rgba(80,78,118,0.08);
        }

        /* ── FLOATING ── */
        .float-1 { animation: float1 6s ease-in-out infinite; }
        .float-2 { animation: float2 8s ease-in-out infinite; }
        .float-3 { animation: float3 7s ease-in-out infinite; }

        @keyframes float1 {
            0%,100% { transform: translateY(0) rotate(0deg); }
            50%      { transform: translateY(-18px) rotate(3deg); }
        }
        @keyframes float2 {
            0%,100% { transform: translateY(0) rotate(0deg); }
            50%      { transform: translateY(-12px) rotate(-4deg); }
        }
        @keyframes float3 {
            0%,100% { transform: translateY(0); }
            50%      { transform: translateY(-22px); }
        }

        /* ── FADE IN ── */
        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(28px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        .fade-up { animation: fadeUp 0.7s cubic-bezier(.22,.68,0,1.1) both; }
        .d1 { animation-delay: .1s; }
        .d2 { animation-delay: .2s; }
        .d3 { animation-delay: .3s; }
        .d4 { animation-delay: .4s; }
        .d5 { animation-delay: .5s; }
        .d6 { animation-delay: .6s; }

        /* ── SCROLL REVEAL ── */
        .reveal {
            opacity: 0;
            transform: translateY(32px);
            transition: opacity .7s cubic-bezier(.22,.68,0,1.1), transform .7s cubic-bezier(.22,.68,0,1.1);
        }

        .reveal.visible {
            opacity: 1;
            transform: translateY(0);
        }

        /* ── STAT CARD ── */
        .stat-card {
            position: relative;
            overflow: hidden;
        }

        .stat-card::before {
            content: '';
            position: absolute;
            left: 0; top: 15%; height: 70%;
            width: 4px;
            border-radius: 0 3px 3px 0;
        }

        .sc-purple::before { background: #504E76; }
        .sc-green::before  { background: #4CAF7D; }
        .sc-orange::before { background: #F1642E; }

        /* ── FEATURE CARD ── */
        .feature-card {
            transition: all .35s ease;
        }

        .feature-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 28px 48px rgba(80,78,118,0.14);
        }

        /* ── STEP DOT ── */
        .step-dot {
            width: 48px;
            height: 48px;
            border-radius: 14px;
            background: #504E76;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 900;
            font-size: 18px;
            flex-shrink: 0;
            box-shadow: 0 8px 20px rgba(80,78,118,0.28);
        }

        /* ── BTN ── */
        .btn-primary {
            background: linear-gradient(135deg, #504E76, #6B689B);
            color: white;
            font-weight: 700;
            border-radius: 16px;
            padding: 14px 32px;
            transition: all .3s ease;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            box-shadow: 0 8px 24px rgba(80,78,118,0.28);
            text-decoration: none;
        }

        .btn-primary:hover {
            background: linear-gradient(135deg, #E7B96A, #E89A4A);
            transform: translateY(-2px);
            box-shadow: 0 14px 32px rgba(232,185,106,0.30);
        }

        .btn-ghost {
            background: rgba(255,255,255,0.5);
            color: #504E76;
            font-weight: 600;
            border-radius: 16px;
            padding: 14px 28px;
            transition: all .3s ease;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            border: 1.5px solid rgba(80,78,118,0.15);
            text-decoration: none;
        }

        .btn-ghost:hover {
            background: rgba(255,255,255,0.75);
            transform: translateY(-2px);
        }

        /* ── SCROLLBAR ── */
        ::-webkit-scrollbar { width: 6px; }
        ::-webkit-scrollbar-thumb { background: #504E76; border-radius: 50px; }
        ::-webkit-scrollbar-track { background: transparent; }

        /* ── DIVIDER ── */
        .section-divider {
            width: 48px;
            height: 4px;
            border-radius: 4px;
            background: linear-gradient(90deg, #504E76, #E8C067);
            margin: 0 auto 16px;
        }
    </style>
</head>

<body>

<!-- BG ORBS -->
<div style="position:fixed;inset:0;pointer-events:none;z-index:0;overflow:hidden;">
    <div class="orb" style="width:500px;height:500px;background:rgba(195,193,227,0.45);top:-120px;right:-100px;"></div>
    <div class="orb" style="width:400px;height:400px;background:rgba(253,248,226,0.6);bottom:-80px;left:-100px;"></div>
    <div class="orb" style="width:300px;height:300px;background:rgba(241,100,46,0.08);top:40%;left:40%;"></div>
</div>

<!-- ══════════════ NAVBAR ══════════════ -->
<nav class="navbar">
    <div class="flex items-center gap-2.5">
        <div class="w-9 h-9 rounded-xl bg-[#504E76] flex items-center justify-center shadow-md">
            <i class='bx bx-leaf text-white text-lg'></i>
        </div>
        <span class="font-black text-[#504E76] text-lg">MealBridge</span>
    </div>

    <!-- Desktop links -->
    <div class="hidden md:flex items-center gap-7 text-sm font-semibold text-[#504E76]/70">
        <a href="#how" class="hover:text-[#504E76] transition-colors">How It Works</a>
        <a href="#features" class="hover:text-[#504E76] transition-colors">Features</a>
        <a href="#stats" class="hover:text-[#504E76] transition-colors">Impact</a>
    </div>

    <div class="flex items-center gap-2">
        <a href="/login" class="btn-ghost py-2.5 px-5 text-sm rounded-xl">Login</a>
        <a href="/register" class="btn-primary py-2.5 px-5 text-sm rounded-xl">
            Get Started
        </a>
    </div>
</nav>

<!-- ══════════════ HERO ══════════════ -->
<section class="relative min-h-screen flex items-center justify-center px-5 pt-28 pb-16" style="z-index:1;">
    <div class="max-w-4xl mx-auto text-center">

        <!-- BADGE -->
        <div class="fade-up d1 inline-flex items-center gap-2
                    glass rounded-full px-5 py-2 mb-8
                    text-sm font-semibold text-[#504E76]">
            <span class="w-2 h-2 rounded-full bg-[#4CAF7D] inline-block"></span>
            Food sharing platform for communities
        </div>

        <!-- HEADLINE -->
        <h1 class="fade-up d2 font-black leading-[1.1] mb-6"
            style="font-family:'Playfair Display',serif; font-size: clamp(2.8rem, 7vw, 5.5rem);">
            <span class="gradient-text">Bridge the Gap</span><br>
            <span class="text-[#504E76]">Between Food & Need</span>
        </h1>

        <!-- SUBHEADLINE -->
        <p class="fade-up d3 text-[#504E76]/65 leading-relaxed mb-10 max-w-xl mx-auto"
           style="font-size: clamp(1rem, 2vw, 1.15rem);">
            MealBridge connects food suppliers with communities in need —
            turning surplus into sustenance, one donation at a time.
        </p>

        <!-- CTA BUTTONS -->
        <div class="fade-up d4 flex flex-col sm:flex-row items-center justify-center gap-3">
            <a href="/register" class="btn-primary">
                <i class='bx bx-donate-heart text-xl'></i>
                Start Donating
            </a>
            <a href="#how" class="btn-ghost">
                <i class='bx bx-play-circle text-xl'></i>
                How It Works
            </a>
        </div>

        <!-- FLOATING CARDS -->
        <div class="fade-up d5 relative mt-16 max-w-2xl mx-auto">

            <!-- MAIN GLASS CARD -->
            <div class="glass rounded-3xl p-6 shadow-2xl"
                 style="box-shadow: 0 32px 64px rgba(80,78,118,0.14);">

                <div class="flex items-center justify-between mb-4">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl bg-[#504E76] flex items-center justify-center">
                            <i class='bx bx-package text-white text-lg'></i>
                        </div>
                        <div class="text-left">
                            <p class="font-bold text-[#504E76] text-sm">Active Donation</p>
                            <p class="text-[#504E76]/50 text-xs">Just now</p>
                        </div>
                    </div>
                    <span class="text-xs font-bold bg-green-100 text-green-700 px-3 py-1 rounded-xl">
                        Accepted ✓
                    </span>
                </div>

                <div class="grid grid-cols-3 gap-3">
                    <div class="bg-white/50 rounded-2xl p-3 text-center">
                        <p class="text-2xl font-black text-[#504E76]">12</p>
                        <p class="text-[9px] font-bold uppercase tracking-widest text-[#504E76]/50 mt-0.5">Portions</p>
                    </div>
                    <div class="bg-white/50 rounded-2xl p-3 text-center">
                        <p class="text-2xl font-black text-[#4CAF7D]">3</p>
                        <p class="text-[9px] font-bold uppercase tracking-widest text-[#504E76]/50 mt-0.5">Communities</p>
                    </div>
                    <div class="bg-white/50 rounded-2xl p-3 text-center">
                        <p class="text-2xl font-black text-[#E8C067]">1h</p>
                        <p class="text-[9px] font-bold uppercase tracking-widest text-[#504E76]/50 mt-0.5">Pickup</p>
                    </div>
                </div>

            </div>

            <!-- FLOATING PILL LEFT -->
            <div class="float-1 absolute -left-6 top-4 glass rounded-2xl px-4 py-3 shadow-lg hidden sm:flex items-center gap-2">
                <div class="w-8 h-8 rounded-lg bg-[#F1642E]/15 flex items-center justify-center">
                    <i class='bx bx-heart text-[#F1642E]'></i>
                </div>
                <div>
                    <p class="text-xs font-bold text-[#504E76]">+24 meals</p>
                    <p class="text-[10px] text-[#504E76]/50">Saved today</p>
                </div>
            </div>

            <!-- FLOATING PILL RIGHT -->
            <div class="float-2 absolute -right-6 bottom-4 glass rounded-2xl px-4 py-3 shadow-lg hidden sm:flex items-center gap-2">
                <div class="w-8 h-8 rounded-lg bg-[#4CAF7D]/15 flex items-center justify-center">
                    <i class='bx bx-check-circle text-[#4CAF7D]'></i>
                </div>
                <div>
                    <p class="text-xs font-bold text-[#504E76]">Verified</p>
                    <p class="text-[10px] text-[#504E76]/50">Supplier</p>
                </div>
            </div>

        </div>

    </div>
</section>

<!-- ══════════════ STATS ══════════════ -->
<section id="stats" class="relative px-5 py-16" style="z-index:1;">
    <div class="max-w-5xl mx-auto">
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">

            <div class="reveal stat-card sc-purple glass rounded-2xl px-5 py-5 flex items-center gap-4"
                 style="box-shadow: 0 12px 35px rgba(80,78,118,0.08);">
                <div class="w-12 h-12 rounded-2xl bg-[#504E76]/10 flex items-center justify-center shrink-0">
                    <i class='bx bx-package text-[#504E76] text-2xl'></i>
                </div>
                <div>
                    <h3 class="text-3xl font-black text-[#504E76]">1,200+</h3>
                    <p class="text-[10px] font-bold uppercase tracking-widest text-[#504E76]/50 mt-0.5">Meals Donated</p>
                </div>
            </div>

            <div class="reveal stat-card sc-green glass rounded-2xl px-5 py-5 flex items-center gap-4"
                 style="box-shadow: 0 12px 35px rgba(80,78,118,0.08);">
                <div class="w-12 h-12 rounded-2xl bg-green-100 flex items-center justify-center shrink-0">
                    <i class='bx bx-group text-green-600 text-2xl'></i>
                </div>
                <div>
                    <h3 class="text-3xl font-black text-[#504E76]">340+</h3>
                    <p class="text-[10px] font-bold uppercase tracking-widest text-[#504E76]/50 mt-0.5">Communities Helped</p>
                </div>
            </div>

            <div class="reveal stat-card sc-orange glass rounded-2xl px-5 py-5 flex items-center gap-4"
                 style="box-shadow: 0 12px 35px rgba(80,78,118,0.08);">
                <div class="w-12 h-12 rounded-2xl bg-orange-100 flex items-center justify-center shrink-0">
                    <i class='bx bx-store text-orange-500 text-2xl'></i>
                </div>
                <div>
                    <h3 class="text-3xl font-black text-[#504E76]">80+</h3>
                    <p class="text-[10px] font-bold uppercase tracking-widest text-[#504E76]/50 mt-0.5">Active Suppliers</p>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- ══════════════ HOW IT WORKS ══════════════ -->
<section id="how" class="relative px-5 py-16" style="z-index:1;">
    <div class="max-w-5xl mx-auto">

        <div class="text-center mb-12 reveal">
            <div class="section-divider"></div>
            <h2 class="text-2xl lg:text-4xl font-black text-[#504E76]"
                style="font-family:'Playfair Display',serif;">
                How It Works
            </h2>
            <p class="text-[#504E76]/60 mt-2 text-sm lg:text-base">Simple steps to make a difference</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-5">

            <div class="reveal glass rounded-3xl p-6 feature-card"
                 style="box-shadow: 0 12px 35px rgba(80,78,118,0.08);">
                <div class="step-dot mb-5">1</div>
                <h3 class="text-xl font-black text-[#504E76] mb-2">Register as Supplier</h3>
                <p class="text-[#504E76]/60 text-sm leading-relaxed">
                    Create your account in minutes and verify your identity as a food supplier.
                </p>
            </div>

            <div class="reveal glass rounded-3xl p-6 feature-card"
                 style="box-shadow: 0 12px 35px rgba(80,78,118,0.08);">
                <div class="step-dot mb-5" style="background: #4CAF7D;">2</div>
                <h3 class="text-xl font-black text-[#504E76] mb-2">List Your Food</h3>
                <p class="text-[#504E76]/60 text-sm leading-relaxed">
                    Add surplus food details — type, quantity, pickup location, and time. Takes under a minute.
                </p>
            </div>

            <div class="reveal glass rounded-3xl p-6 feature-card"
                 style="box-shadow: 0 12px 35px rgba(80,78,118,0.08);">
                <div class="step-dot mb-5" style="background: #E8C067;">3</div>
                <h3 class="text-xl font-black text-[#504E76] mb-2">Help Communities</h3>
                <p class="text-[#504E76]/60 text-sm leading-relaxed">
                    Communities receive your donation. Track impact through your dashboard in real time.
                </p>
            </div>

        </div>

    </div>
</section>

<!-- ══════════════ FEATURES ══════════════ -->
<section id="features" class="relative px-5 py-16" style="z-index:1;">
    <div class="max-w-5xl mx-auto">

        <div class="text-center mb-12 reveal">
            <div class="section-divider"></div>
            <h2 class="text-2xl lg:text-4xl font-black text-[#504E76]"
                style="font-family:'Playfair Display',serif;">
                Everything You Need
            </h2>
            <p class="text-[#504E76]/60 mt-2 text-sm lg:text-base">Designed for suppliers who care</p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">

            <div class="reveal glass rounded-2xl p-5 feature-card"
                 style="box-shadow:0 12px 35px rgba(80,78,118,0.07);">
                <div class="w-12 h-12 rounded-2xl bg-[#504E76]/10 flex items-center justify-center mb-4">
                    <i class='bx bx-map-pin text-[#504E76] text-2xl'></i>
                </div>
                <h4 class="font-black text-[#504E76] mb-1.5">Live Location</h4>
                <p class="text-sm text-[#504E76]/60 leading-relaxed">Auto-detect pickup location with one tap using your GPS.</p>
            </div>

            <div class="reveal glass rounded-2xl p-5 feature-card"
                 style="box-shadow:0 12px 35px rgba(80,78,118,0.07);">
                <div class="w-12 h-12 rounded-2xl bg-green-100 flex items-center justify-center mb-4">
                    <i class='bx bx-check-shield text-green-600 text-2xl'></i>
                </div>
                <h4 class="font-black text-[#504E76] mb-1.5">Verified Network</h4>
                <p class="text-sm text-[#504E76]/60 leading-relaxed">All suppliers and community partners are verified for safety.</p>
            </div>

            <div class="reveal glass rounded-2xl p-5 feature-card"
                 style="box-shadow:0 12px 35px rgba(80,78,118,0.07);">
                <div class="w-12 h-12 rounded-2xl bg-orange-100 flex items-center justify-center mb-4">
                    <i class='bx bx-bell text-orange-500 text-2xl'></i>
                </div>
                <h4 class="font-black text-[#504E76] mb-1.5">Real-time Alerts</h4>
                <p class="text-sm text-[#504E76]/60 leading-relaxed">Get notified the moment your donation is accepted or picked up.</p>
            </div>

            <div class="reveal glass rounded-2xl p-5 feature-card"
                 style="box-shadow:0 12px 35px rgba(80,78,118,0.07);">
                <div class="w-12 h-12 rounded-2xl bg-pink-100 flex items-center justify-center mb-4">
                    <i class='bx bx-line-chart text-pink-500 text-2xl'></i>
                </div>
                <h4 class="font-black text-[#504E76] mb-1.5">Impact Dashboard</h4>
                <p class="text-sm text-[#504E76]/60 leading-relaxed">Track your total donations, communities helped, and more.</p>
            </div>

            <div class="reveal glass rounded-2xl p-5 feature-card"
                 style="box-shadow:0 12px 35px rgba(80,78,118,0.07);">
                <div class="w-12 h-12 rounded-2xl bg-purple-100 flex items-center justify-center mb-4">
                    <i class='bx bx-history text-purple-500 text-2xl'></i>
                </div>
                <h4 class="font-black text-[#504E76] mb-1.5">Donation History</h4>
                <p class="text-sm text-[#504E76]/60 leading-relaxed">Full log of all your past donations with status and details.</p>
            </div>

            <div class="reveal glass rounded-2xl p-5 feature-card"
                 style="box-shadow:0 12px 35px rgba(80,78,118,0.07);">
                <div class="w-12 h-12 rounded-2xl bg-yellow-100 flex items-center justify-center mb-4">
                    <i class='bx bx-mobile text-yellow-600 text-2xl'></i>
                </div>
                <h4 class="font-black text-[#504E76] mb-1.5">Mobile Friendly</h4>
                <p class="text-sm text-[#504E76]/60 leading-relaxed">Fully responsive — donate and manage on any device, anywhere.</p>
            </div>

        </div>

    </div>
</section>

<!-- ══════════════ CTA ══════════════ -->
<section class="relative px-5 py-20" style="z-index:1;">
    <div class="max-w-3xl mx-auto text-center reveal">

        <div class="glass rounded-3xl p-10 lg:p-14"
             style="box-shadow: 0 32px 64px rgba(80,78,118,0.12);">

            <div class="w-16 h-16 rounded-2xl bg-[#504E76] text-white
                        flex items-center justify-center mx-auto mb-6 shadow-xl float-3">
                <i class='bx bx-donate-heart text-3xl'></i>
            </div>

            <h2 class="text-2xl lg:text-4xl font-black text-[#504E76] mb-3"
                style="font-family:'Playfair Display',serif;">
                Ready to Make an Impact?
            </h2>

            <p class="text-[#504E76]/60 mb-8 text-sm lg:text-base leading-relaxed max-w-md mx-auto">
                Join hundreds of suppliers already helping communities.
                Every meal you share changes a life.
            </p>

            <div class="flex flex-col sm:flex-row items-center justify-center gap-3">
                <a href="/register" class="btn-primary">
                    <i class='bx bx-user-plus text-xl'></i>
                    Join as Supplier
                </a>
                <a href="/login" class="btn-ghost">
                    Already have an account? Login
                </a>
            </div>

        </div>

    </div>
</section>

<!-- ══════════════ FOOTER ══════════════ -->
<footer class="relative px-5 py-8 border-t border-white/30" style="z-index:1;">
    <div class="max-w-5xl mx-auto flex flex-col sm:flex-row items-center justify-between gap-4">

        <div class="flex items-center gap-2.5">
            <div class="w-8 h-8 rounded-xl bg-[#504E76] flex items-center justify-center">
                <i class='bx bx-leaf text-white text-sm'></i>
            </div>
            <span class="font-black text-[#504E76]">MealBridge</span>
        </div>

        <p class="text-[#504E76]/45 text-sm text-center">
            © 2025 MealBridge. Bridging food & communities. 🌿
        </p>

        <div class="flex items-center gap-4 text-sm font-semibold text-[#504E76]/55">
            <a href="#" class="hover:text-[#504E76] transition-colors">Privacy</a>
            <a href="#" class="hover:text-[#504E76] transition-colors">Terms</a>
            <a href="/login" class="hover:text-[#504E76] transition-colors">Login</a>
        </div>

    </div>
</footer>

<script>
    // SCROLL REVEAL
    const revealEls = document.querySelectorAll('.reveal');

    const observer = new IntersectionObserver((entries) => {
        entries.forEach((entry, i) => {
            if (entry.isIntersecting) {
                setTimeout(() => {
                    entry.target.classList.add('visible');
                }, i * 80);
                observer.unobserve(entry.target);
            }
        });
    }, { threshold: 0.12 });

    revealEls.forEach(el => observer.observe(el));
</script>

</body>
</html>