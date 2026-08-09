<style>
    @font-face {
        font-family: 'Archivo Black';
        src: url('/wp-content/themes/twentytwentyfive/assets/fonts/myFonts/ArchivoBlack-Regular.ttf') format('truetype');
    }

    @font-face {
        font-family: 'Open Sans Local';
        src: url('/wp-content/themes/twentytwentyfive/assets/fonts/myFonts/open-sans.regular%20%281%29.ttf') format('truetype');
    }

    .v4e-navbar {
        --v4e-red: #bf2020;
        --v4e-paper: #f7f3ec;
        --v4e-ink: #111111;
        --v4e-soft-ink: #1a1a1a;
        position: relative;
        top: auto;
        left: auto;
        z-index: 999;
        width: 100%;
        transform: none;
        background:
            linear-gradient(180deg, rgba(255, 255, 255, 0.82), rgba(247, 243, 236, 0.74)),
            rgba(247, 243, 236, 0.78);
        border: 1px solid rgba(0, 0, 0, 0.16);
        box-shadow: 0 14px 36px rgba(0, 0, 0, 0.14);
        backdrop-filter: blur(14px);
        color: var(--v4e-ink);
        font-family: "Open Sans Local", Arial, sans-serif;
        isolation: isolate;
        overflow: visible;
    }

    .v4e-navbar,
    .v4e-navbar * {
        box-sizing: border-box;
    }

    .v4e-navbar::before {
        content: "";
        position: absolute;
        inset: 20px;
        border: 1px solid rgba(0, 0, 0, 0.12);
        pointer-events: none;
        z-index: -1;
    }

    .v4e-navbar::after {
        content: "";
        position: absolute;
        inset: 0;
        background:
            linear-gradient(90deg, rgba(0, 0, 0, 0.04) 0, rgba(0, 0, 0, 0.04) 1px, transparent 1px, transparent 118px),
            linear-gradient(180deg, rgba(191, 32, 32, 0.04), rgba(191, 32, 32, 0.02));
        opacity: 0.7;
        pointer-events: none;
        z-index: -2;
    }

    .v4e-navbar-inner {
        display: grid;
        grid-template-columns: minmax(150px, 0.6fr) minmax(0, 1080px) minmax(150px, 0.6fr);
        align-items: center;
        gap: clamp(14px, 2vw, 28px);
        width: min(1440px, 100%);
        margin: 0 auto;
        min-height: 100px;
        padding: 14px clamp(18px, 4vw, 42px);
        overflow: visible;
    }

    .v4e-navbar-logo {
        display: inline-flex;
        align-items: center;
        justify-self: start;
        width: clamp(92px, 9vw, 132px);
        min-width: 92px;
        text-decoration: none;
    }

    .v4e-navbar-logo img {
        display: block;
        width: 100%;
        height: auto;
        max-height: 58px;
        object-fit: contain;
    }

    .v4e-navbar-menu {
        display: grid;
        grid-template-columns: repeat(8, minmax(0, 1fr));
        align-items: center;
        justify-self: center;
        gap: clamp(5px, 0.72vw, 12px);
        width: 100%;
        min-width: 0;
    }

    .v4e-navbar-menu a {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 100%;
        min-height: 42px;
        padding: 0 6px;
        color: var(--v4e-soft-ink);
        border: 1px solid transparent;
        text-decoration: none;
        font-size: clamp(0.68rem, 0.72vw, 0.82rem);
        font-weight: 800;
        letter-spacing: 0.04em;
        line-height: 1.2;
        text-align: center;
        text-transform: uppercase;
        transition: background-color 0.3s ease, border-color 0.3s ease, color 0.3s ease, transform 0.3s ease;
    }

    .v4e-navbar-menu a:hover,
    .v4e-navbar-menu a:focus-visible {
        color: var(--v4e-paper);
        background: var(--v4e-red);
        border-color: var(--v4e-red);
        outline: none;
        transform: translateY(-1px);
    }

    .v4e-navbar-actions {
        display: flex;
        align-items: center;
        justify-content: flex-end;
        justify-self: end;
        gap: 10px;
        min-height: 46px;
        overflow: visible;
    }

    .v4e-navbar-translate {
        position: relative;
        z-index: 1001;
        width: auto;
        min-width: 0;
        height: 46px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 0;
        background: rgba(255, 255, 255, 0.66);
        border: 1px solid rgba(0, 0, 0, 0.16);
        overflow: visible;
    }

    .v4e-language-dropdown {
        position: relative;
        display: inline-flex;
        align-items: center;
        height: 100%;
    }

    .v4e-language-toggle {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        min-width: 58px;
        height: 44px;
        padding: 0 10px;
        color: var(--v4e-ink);
        background: transparent;
        border: 0;
        cursor: pointer;
    }

    .v4e-language-toggle:focus-visible {
        outline: none;
        box-shadow: inset 0 0 0 1px rgba(191, 32, 32, 0.42);
    }

    .v4e-language-current {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 24px;
        height: 24px;
    }

    .v4e-language-arrow {
        width: 14px;
        height: 14px;
        transition: transform 0.25s ease;
    }

    .v4e-language-dropdown.is-open .v4e-language-arrow {
        transform: rotate(180deg);
    }

    .v4e-language-options {
        position: absolute;
        top: calc(100% + 6px);
        right: 0;
        display: grid;
        gap: 6px;
        min-width: 58px;
        padding: 8px;
        background: rgba(247, 243, 236, 0.98);
        border: 1px solid rgba(0, 0, 0, 0.16);
        box-shadow: 0 14px 30px rgba(0, 0, 0, 0.14);
        opacity: 0;
        visibility: hidden;
        transform: translateY(-4px);
        transition: opacity 0.2s ease, transform 0.2s ease, visibility 0.2s ease;
    }

    .v4e-language-dropdown.is-open .v4e-language-options {
        opacity: 1;
        visibility: visible;
        transform: translateY(0);
    }

    .v4e-language-options a {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 36px;
        height: 32px;
        color: inherit;
        text-decoration: none;
        border: 1px solid transparent;
        transition: border-color 0.2s ease, background-color 0.2s ease;
    }

    .v4e-language-options a:hover,
    .v4e-language-options a:focus-visible,
    .v4e-language-options .gt-current-lang {
        background: rgba(191, 32, 32, 0.08);
        border-color: rgba(191, 32, 32, 0.42);
        outline: none;
    }

    .v4e-navbar-translate img {
        display: block;
        width: 24px !important;
        height: 24px !important;
        max-width: 24px;
        max-height: 24px;
        object-fit: cover;
    }

    .v4e-language-options span {
        position: absolute;
        width: 1px;
        height: 1px;
        padding: 0;
        margin: -1px;
        overflow: hidden;
        clip: rect(0, 0, 0, 0);
        white-space: nowrap;
        border: 0;
    }

    .v4e-navbar-cart {
        position: relative;
        z-index: 1001;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 46px;
        height: 46px;
        padding: 0;
        background: transparent;
        border: 0;
        overflow: visible;
    }

    .v4e-navbar-toggle svg {
        width: 20px;
        height: 20px;
        display: block;
    }

    .v4e-navbar-cart > *,
    .v4e-navbar-cart a,
    .v4e-navbar-cart .widget,
    .v4e-navbar-cart .woocommerce,
    .v4e-navbar-cart [class*="mini-cart"],
    .v4e-navbar-cart [class*="cart"] {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        margin: 0;
        line-height: 1;
    }

    .v4e-navbar-toggle {
        display: none;
        align-items: center;
        justify-content: center;
        width: 46px;
        height: 46px;
        padding: 0;
        color: var(--v4e-ink);
        background: rgba(255, 255, 255, 0.66);
        border: 1px solid rgba(0, 0, 0, 0.16);
        cursor: pointer;
        transition: background-color 0.3s ease, border-color 0.3s ease, color 0.3s ease;
    }

    .v4e-navbar-toggle:hover,
    .v4e-navbar-toggle:focus-visible {
        color: var(--v4e-paper);
        background: var(--v4e-red);
        border-color: var(--v4e-red);
        outline: none;
    }

    @media (max-width: 1180px) {
        .v4e-navbar-inner {
            grid-template-columns: auto auto 1fr;
        }

        .v4e-navbar-toggle {
            display: inline-flex;
            order: 2;
        }

        .v4e-navbar-actions {
            order: 3;
        }

        .v4e-navbar-menu {
            grid-column: 1 / -1;
            order: 4;
            display: none;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            justify-content: flex-start;
            justify-self: stretch;
            width: 100%;
            padding: 14px 0 4px;
            border-top: 1px solid rgba(0, 0, 0, 0.14);
        }

        .v4e-navbar.is-open .v4e-navbar-menu {
            display: grid;
        }

        .v4e-navbar-menu a {
            min-height: 44px;
            background: rgba(255, 255, 255, 0.62);
            border-color: rgba(0, 0, 0, 0.12);
        }
    }

    @media (max-width: 640px) {
        .v4e-navbar::before {
            inset: 12px;
        }

        .v4e-navbar-inner {
            min-height: 72px;
            grid-template-columns: 1fr auto auto;
            gap: 8px;
            padding: 12px 14px;
        }

        .v4e-navbar-logo {
            width: 88px;
            min-width: 88px;
        }

        .v4e-navbar-actions {
            gap: 8px;
        }

        .v4e-navbar-translate {
            height: 42px;
        }

        .v4e-language-toggle {
            min-width: 54px;
            height: 40px;
            padding: 0 8px;
            gap: 6px;
        }

        .v4e-navbar-menu {
            display: none;
            grid-template-columns: 1fr;
            gap: 8px;
        }

        .v4e-navbar.is-open .v4e-navbar-menu {
            display: grid;
        }

        .v4e-navbar-menu a {
            width: 100%;
            justify-content: center;
            text-align: center;
        }
    }

    @media (max-width: 420px) {
        .v4e-navbar-inner {
            grid-template-columns: auto 1fr auto;
        }

        .v4e-navbar-logo {
            width: 78px;
            min-width: 78px;
        }

        .v4e-navbar-actions {
            grid-column: 1 / -1;
            width: 100%;
            justify-content: flex-end;
        }
    }
</style>

<nav class="v4e-navbar" aria-label="Main navigation">
    <div class="v4e-navbar-inner">
        <a class="v4e-navbar-logo" href="/" aria-label="Paint and Wine početna">
            <img src="http://paintandwine.local/wp-content/uploads/2026/04/logo.png" alt="Paint and Wine" />
        </a>

        <button class="v4e-navbar-toggle" type="button" aria-label="Otvori meni" aria-expanded="false">
            <svg viewBox="0 0 24 24" aria-hidden="true" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M4 7h16M4 12h16M4 17h16" />
            </svg>
        </button>

        <div class="v4e-navbar-menu">
            <a href="/">Početna</a>
            <a href="/raspored">Raspored</a>
            <a href="/privatne-radionice">Privatne radionice</a>
            <a href="/paint-and-kids">Paint and Kids</a>
            <a href="/neon-paint-and-cocktails/">Neon paint and cocktails</a>
            <a href="/pw-shop">P &amp; W Shop</a>
            <a href="/o-nama">O nama</a>
            <a href="/galerija">Galerija</a>
        </div>

        <div class="v4e-navbar-actions">
            <div class="v4e-navbar-translate" aria-label="Language selector">
                <div class="v4e-language-dropdown">
                    <button class="v4e-language-toggle" type="button" aria-label="Promijeni jezik"
                        aria-expanded="false">
                        <span class="v4e-language-current" aria-hidden="true"></span>
                        <svg class="v4e-language-arrow" viewBox="0 0 24 24" aria-hidden="true" fill="none"
                            stroke="currentColor" stroke-width="2">
                            <path d="m6 9 6 6 6-6" />
                        </svg>
                    </button>

                    <div class="v4e-language-options">
                        [gt-link lang="sr" label="Crnogorski" widget_look="flags_name"]
                        [gt-link lang="en" label="English" widget_look="flags_name"]
                        [gt-link lang="sq" label="Albanian" widget_look="flags_name"]
                        [gt-link lang="ru" label="Russian" widget_look="flags_name"]
                    </div>
                </div>
            </div>

            <div class="v4e-navbar-cart" aria-label="Korpa">
                [whmc_mini_cart]
            </div>
        </div>
    </div>
</nav>

<script>
    (function () {
        const navbar = document.currentScript.previousElementSibling;
        if (!navbar || !navbar.classList.contains("v4e-navbar")) return;

        const toggle = navbar.querySelector(".v4e-navbar-toggle");
        const menu = navbar.querySelector(".v4e-navbar-menu");
        if (!toggle || !menu) return;

        toggle.addEventListener("click", function () {
            const isOpen = navbar.classList.toggle("is-open");
            toggle.setAttribute("aria-expanded", String(isOpen));
            toggle.setAttribute("aria-label", isOpen ? "Zatvori meni" : "Otvori meni");
        });

        menu.querySelectorAll("a").forEach(function (link) {
            link.addEventListener("click", function () {
                navbar.classList.remove("is-open");
                toggle.setAttribute("aria-expanded", "false");
                toggle.setAttribute("aria-label", "Otvori meni");
            });
        });

        const languageDropdown = navbar.querySelector(".v4e-language-dropdown");
        if (!languageDropdown) return;

        const languageToggle = languageDropdown.querySelector(".v4e-language-toggle");
        const languageCurrent = languageDropdown.querySelector(".v4e-language-current");
        const languageOptions = languageDropdown.querySelector(".v4e-language-options");
        if (!languageToggle || !languageCurrent || !languageOptions) return;

        const languageLinks = Array.from(languageOptions.querySelectorAll("a"));

        function setCurrentLanguage(link) {
            if (!link) return;
            const flag = link.querySelector("img");
            languageCurrent.innerHTML = "";

            if (flag) {
                languageCurrent.appendChild(flag.cloneNode(true));
                return;
            }

            languageCurrent.textContent = link.textContent.trim().slice(0, 2).toUpperCase();
        }

        function closeLanguageDropdown() {
            languageDropdown.classList.remove("is-open");
            languageToggle.setAttribute("aria-expanded", "false");
        }

        const currentLanguage = languageOptions.querySelector(".gt-current-lang");
        setCurrentLanguage((currentLanguage && currentLanguage.closest("a")) || languageLinks[0]);

        languageToggle.addEventListener("click", function (event) {
            event.stopPropagation();
            const isOpen = languageDropdown.classList.toggle("is-open");
            languageToggle.setAttribute("aria-expanded", String(isOpen));
        });

        languageLinks.forEach(function (link) {
            link.addEventListener("click", function () {
                setCurrentLanguage(link);
                closeLanguageDropdown();
            });
        });

        document.addEventListener("click", function (event) {
            if (!languageDropdown.contains(event.target)) {
                closeLanguageDropdown();
            }
        });

        document.addEventListener("keydown", function (event) {
            if (event.key === "Escape") {
                closeLanguageDropdown();
            }
        });
    })();
</script>
<style>
    .v4e-navbar {
        --v4e-red: #66f7ff;
        --v4e-paper: #050816;
        --v4e-ink: #ecf6ff;
        --v4e-soft-ink: rgba(236, 246, 255, 0.9);
        background:
            radial-gradient(circle at 12% 20%, rgba(102, 247, 255, 0.18), transparent 22%),
            radial-gradient(circle at 88% 16%, rgba(255, 79, 207, 0.14), transparent 24%),
            linear-gradient(180deg, rgba(8, 12, 24, 0.96), rgba(5, 8, 22, 0.92));
        border-color: rgba(102, 247, 255, 0.2);
        box-shadow: 0 16px 42px rgba(0, 0, 0, 0.34), 0 0 28px rgba(102, 247, 255, 0.08);
    }

    .v4e-navbar::before {
        border-color: rgba(102, 247, 255, 0.2);
    }

    .v4e-navbar::after {
        background:
            linear-gradient(90deg, rgba(102, 247, 255, 0.05) 0, rgba(102, 247, 255, 0.05) 1px, transparent 1px, transparent 118px),
            linear-gradient(180deg, rgba(255, 79, 207, 0.08), rgba(102, 247, 255, 0.04));
    }

    .v4e-navbar-menu a {
        color: rgba(236, 246, 255, 0.9);
    }

    .v4e-navbar-menu a:hover,
    .v4e-navbar-menu a:focus-visible {
        color: #050816;
        background: #66f7ff;
        border-color: #66f7ff;
        box-shadow: 0 0 20px rgba(102, 247, 255, 0.28);
    }

    .v4e-navbar-translate,
    .v4e-navbar-toggle {
        color: #ecf6ff;
        background: rgba(8, 12, 24, 0.72);
        border-color: rgba(102, 247, 255, 0.24);
    }

    .v4e-navbar-toggle:hover,
    .v4e-navbar-toggle:focus-visible {
        color: #050816;
        background: #66f7ff;
        border-color: #66f7ff;
    }

    .v4e-language-options {
        background: rgba(7, 11, 24, 0.98);
        border-color: rgba(102, 247, 255, 0.24);
        box-shadow: 0 16px 34px rgba(0, 0, 0, 0.34), 0 0 22px rgba(255, 79, 207, 0.12);
    }

    .v4e-language-options a:hover,
    .v4e-language-options a:focus-visible,
    .v4e-language-options .gt-current-lang {
        background: rgba(102, 247, 255, 0.1);
        border-color: rgba(102, 247, 255, 0.48);
    }
</style>
<style>
    @media (prefers-reduced-motion: no-preference) {
        html {
            scroll-behavior: smooth;
            scroll-padding-top: 112px;
        }
    }

    body {
        text-rendering: optimizeLegibility;
        -webkit-font-smoothing: antialiased;
    }
</style>

<script>
    (function () {
        if (window.matchMedia("(prefers-reduced-motion: reduce)").matches) return;

        document.addEventListener("click", function (event) {
            const link = event.target.closest('a[href^="#"]');
            if (!link) return;

            const hash = link.getAttribute("href");
            if (!hash || hash === "#") return;

            const target = document.querySelector(hash);
            if (!target) return;

            event.preventDefault();
            target.scrollIntoView({ behavior: "smooth", block: "start" });

            if (window.history && window.history.pushState) {
                window.history.pushState(null, "", hash);
            }
        });
    })();
</script>

<style>
    html,
    body {
        margin: 0;
        padding: 0;
        background: #050816;
    }

    .npk-page,
    .npk-page * {
        box-sizing: border-box;
    }

    .npk-page {
        --bg: #050816;
        --bg-2: #090d22;
        --panel: rgba(11, 16, 35, 0.72);
        --panel-strong: rgba(10, 14, 28, 0.9);
        --line: rgba(111, 233, 255, 0.22);
        --line-2: rgba(255, 82, 187, 0.22);
        --text: #ecf6ff;
        --muted: rgba(236, 246, 255, 0.72);
        --cyan: #66f7ff;
        --pink: #ff4fcf;
        --violet: #8f63ff;
        --lime: #99ff66;
        --orange: #ff9d00;
        --shadow: 0 24px 80px rgba(0, 0, 0, 0.44);
        position: relative;
        overflow: hidden;
        background: #050816;
        color: var(--text);
        font-family: "Open Sans Local", Arial, sans-serif;
    }

    .npk-page::before,
    .npk-page::after {
        content: "";
        position: absolute;
        inset: 0;
        pointer-events: none;
    }

    .npk-page::before {
        background:
            linear-gradient(90deg, rgba(255, 255, 255, 0.03) 0, rgba(255, 255, 255, 0.03) 1px, transparent 1px, transparent 120px),
            linear-gradient(180deg, rgba(255, 255, 255, 0.02) 0, rgba(255, 255, 255, 0.02) 1px, transparent 1px, transparent 120px);
        opacity: 0.32;
    }

    .npk-page::after {
        background: transparent;
        mix-blend-mode: screen;
    }

    .npk-orb {
        position: absolute;
        border-radius: 50%;
        filter: blur(8px);
        opacity: 0.6;
        pointer-events: none;
        animation: npkFloat 12s ease-in-out infinite;
    }

    .npk-orb.one {
        top: 5%;
        left: 3%;
        width: 180px;
        height: 180px;
        background: radial-gradient(circle, rgba(102, 247, 255, 0.4), transparent 70%);
    }

    .npk-orb.two {
        top: 18%;
        right: 4%;
        width: 240px;
        height: 240px;
        background: radial-gradient(circle, rgba(255, 79, 207, 0.32), transparent 72%);
        animation-delay: -4s;
    }

    .npk-orb.three {
        bottom: 22%;
        left: 10%;
        width: 210px;
        height: 210px;
        background: radial-gradient(circle, rgba(153, 255, 102, 0.18), transparent 72%);
        animation-delay: -8s;
    }

    .npk-section {
        position: relative;
        z-index: 1;
        padding: clamp(18px, 3vw, 28px);
        background: transparent;
    }

    .npk-hero-section {
        padding: 0;
    }

    .npk-shell {
        width: min(1240px, 100%);
        margin: 0 auto;
    }

    .npk-hero-section>.npk-shell {
        width: 100%;
    }

    .npk-card,
    .npk-panel,
    .npk-instruction,
    .npk-voucher-card,
    .npk-book-card {
        position: relative;
        overflow: hidden;
        border: 1px solid var(--line);
        background:
            linear-gradient(180deg, rgba(255, 255, 255, 0.06), rgba(255, 255, 255, 0.015)),
            var(--panel);
        backdrop-filter: blur(14px);
        box-shadow: var(--shadow);
    }

    .npk-section:not(.npk-hero-section) .npk-card,
    .npk-section:not(.npk-hero-section) .npk-panel,
    .npk-section:not(.npk-hero-section) .npk-instruction,
    .npk-section:not(.npk-hero-section) .npk-voucher-card,
    .npk-section:not(.npk-hero-section) .npk-book-card {
        background: transparent;
    }

    .npk-section:not(.npk-hero-section),
    .npk-section:not(.npk-hero-section) .npk-shell,
    .npk-page [class*="paint_wine_products"],
    .npk-page [class*="paint-wine-products"],
    .npk-page [class*="product-grid"],
    .npk-page [class*="products"] {
        background: transparent !important;
    }

    .npk-panel::before,
    .npk-voucher-card::before,
    .npk-book-card::before {
        content: "";
        position: absolute;
        inset: 12px;
        border: 1px solid rgba(255, 255, 255, 0.08);
        pointer-events: none;
    }

    .npk-kicker,
    .npk-pill {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        width: fit-content;
        min-height: 40px;
        padding: 0 16px;
        border-radius: 999px;
        border: 1px solid rgba(255, 255, 255, 0.1);
        background: rgba(7, 11, 24, 0.6);
        color: var(--text);
        font-size: 0.76rem;
        font-weight: 700;
        letter-spacing: 0.18em;
        text-transform: uppercase;
    }

    .npk-kicker::before,
    .npk-pill::before {
        content: "";
        width: 28px;
        height: 8px;
        border-radius: 999px;
        background: linear-gradient(90deg, var(--cyan), var(--pink), var(--orange));
        box-shadow: 0 0 18px rgba(102, 247, 255, 0.5);
    }

    .npk-title,
    .npk-heading,
    .npk-book-title,
    .npk-voucher-title {
        margin: 0;
        font-family: "Archivo Black", Arial, sans-serif;
        text-transform: uppercase;
        line-height: 0.94;
        letter-spacing: 0.02em;
        text-align: center;
    }

    .npk-title {
        font-size: clamp(2.7rem, 6.2vw, 6rem);
        line-height: 0.9;
        word-break: break-word;
        text-shadow:
            0 0 14px rgba(102, 247, 255, 0.26),
            0 0 32px rgba(255, 79, 207, 0.18);
    }

    .npk-heading,
    .npk-voucher-title {
        font-size: clamp(2rem, 5vw, 4rem);
    }

    .npk-book-title {
        font-size: clamp(1.2rem, 2.1vw, 1.7rem);
    }

    .npk-title .cyan,
    .npk-heading .cyan,
    .npk-book-title .cyan,
    .npk-voucher-title .cyan {
        color: var(--cyan);
    }

    .npk-title .pink,
    .npk-heading .pink,
    .npk-book-title .pink,
    .npk-voucher-title .pink {
        color: var(--pink);
    }

    .npk-text,
    .npk-meta,
    .npk-book-card p,
    .npk-instruction p,
    .npk-feature-list li {
        margin: 0;
        color: var(--muted);
        font-size: clamp(0.98rem, 1.2vw, 1.06rem);
        line-height: 1.7;
    }

    .npk-button {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-height: 52px;
        padding: 0 24px;
        border-radius: 999px;
        text-decoration: none;
        font-weight: 700;
        letter-spacing: 0.08em;
        text-transform: uppercase;
        transition: transform 0.28s ease, box-shadow 0.28s ease, border-color 0.28s ease;
    }

    .npk-button.primary {
        color: #081120;
        background: linear-gradient(135deg, var(--cyan), var(--lime));
        box-shadow: 0 0 26px rgba(102, 247, 255, 0.34);
    }

    .npk-button.secondary {
        color: var(--text);
        border: 1px solid rgba(255, 79, 207, 0.3);
        background: rgba(255, 79, 207, 0.12);
        box-shadow: 0 0 20px rgba(255, 79, 207, 0.14);
    }

    .npk-button:hover {
        transform: translateY(-2px) scale(1.01);
    }

    .npk-hero {
        position: relative;
        width: 100%;
        height: min(100vh, 940px);
        min-height: 720px;
        overflow: hidden;
        border: 0;
        background: transparent;
        box-shadow: none;
        isolation: isolate;
    }

    .npk-hero::before {
        content: "";
        position: absolute;
        inset: 18px;
        border: 1px solid rgba(102, 247, 255, 0.14);
        z-index: 4;
        pointer-events: none;
    }

    .npk-hero::after {
        content: "";
        position: absolute;
        inset: 0;
        background:
            radial-gradient(circle at var(--spot-x, 50%) var(--spot-y, 50%), rgba(102, 247, 255, 0.18), transparent 18%),
            radial-gradient(circle at 82% 16%, rgba(255, 79, 207, 0.14), transparent 20%),
            linear-gradient(180deg, rgba(0, 0, 0, 0.1), rgba(0, 0, 0, 0.66)),
            linear-gradient(125deg, rgba(255, 79, 207, 0.18), transparent 35%);
        z-index: 2;
        pointer-events: none;
    }

    .npk-stage,
    .npk-slide,
    .npk-media {
        position: absolute;
        inset: 0;
    }

    .npk-slide {
        position: absolute;
        inset: 0;
        opacity: 0;
        transition: opacity 0.9s ease;
    }

    .npk-slide.is-active {
        opacity: 1;
    }

    .npk-media {
        overflow: hidden;
    }

    .npk-media img {
        position: absolute;
        inset: 0;
        width: 100%;
        height: 100%;
        object-fit: cover;
        filter: saturate(1.18) contrast(1.08) brightness(0.62);
        transform: scale(1.08);
        transition: transform 7s ease;
    }

    .npk-slide.is-active .npk-media img {
        transform: scale(1);
    }

    .npk-media::before {
        content: "";
        position: absolute;
        inset: 0;
        background:
            linear-gradient(90deg, rgba(0, 0, 0, 0.5), transparent 48%, rgba(0, 0, 0, 0.24)),
            linear-gradient(180deg, rgba(2, 5, 15, 0.14), rgba(2, 5, 15, 0.8)),
            radial-gradient(circle at 20% 24%, rgba(102, 247, 255, 0.14), transparent 24%),
            radial-gradient(circle at 82% 16%, rgba(255, 79, 207, 0.14), transparent 24%);
        z-index: 1;
        pointer-events: none;
    }

    .npk-media::after {
        content: "";
        position: absolute;
        inset: 0;
        background:
            repeating-linear-gradient(90deg,
                rgba(255, 255, 255, 0.03) 0,
                rgba(255, 255, 255, 0.03) 1px,
                transparent 1px,
                transparent 26px);
        mix-blend-mode: soft-light;
        opacity: 0.48;
        z-index: 1;
        pointer-events: none;
    }

    .npk-hero-content {
        position: absolute;
        inset: 0;
        z-index: 3;
        display: grid;
        place-items: center;
        padding: clamp(30px, 5vw, 62px);
        pointer-events: none;
    }

    .npk-hero-card {
        width: min(760px, 100%);
        padding: clamp(22px, 3vw, 34px);
        border-radius: 30px;
        pointer-events: auto;
        margin: 0 auto;
    }

    .npk-hero-copy {
        display: grid;
        gap: 16px;
        justify-items: center;
        text-align: center;
    }

    .npk-hero-copy .npk-text {
        max-width: 42ch;
        margin: 0 auto;
    }

    .npk-actions {
        display: flex;
        flex-wrap: wrap;
        gap: 12px;
        justify-content: center;
        margin-top: 6px;
    }

    .npk-hero-ui {
        position: absolute;
        right: 30px;
        bottom: 28px;
        z-index: 5;
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 10px 12px;
        border-radius: 999px;
        background: rgba(8, 12, 24, 0.7);
        border: 1px solid rgba(102, 247, 255, 0.16);
        backdrop-filter: blur(10px);
    }

    .npk-nav,
    .npk-dot {
        border: 0;
        cursor: pointer;
    }

    .npk-nav {
        width: 42px;
        height: 42px;
        border-radius: 50%;
        color: var(--text);
        background: rgba(255, 255, 255, 0.08);
        font-size: 1rem;
        transition: transform 0.25s ease, background-color 0.25s ease;
    }

    .npk-nav:hover {
        transform: translateY(-1px);
        background: rgba(255, 79, 207, 0.22);
    }

    .npk-dots {
        display: flex;
        gap: 8px;
        align-items: center;
    }

    .npk-dot {
        width: 10px;
        height: 10px;
        padding: 0;
        border-radius: 999px;
        background: rgba(255, 255, 255, 0.35);
        transition: width 0.28s ease, background-color 0.28s ease, box-shadow 0.28s ease;
    }

    .npk-dot.is-active {
        width: 30px;
        background: var(--cyan);
        box-shadow: 0 0 18px rgba(102, 247, 255, 0.54);
    }

    .npk-split {
        display: grid;
        grid-template-columns: minmax(280px, 0.95fr) minmax(320px, 1.05fr);
        gap: clamp(20px, 3vw, 36px);
        align-items: center;
    }

    .npk-copy-card,
    .npk-gallery-card,
    .npk-booking-wrap,
    .npk-instructions-wrap,
    .npk-voucher-card {
        border-radius: 30px;
        padding: clamp(22px, 3vw, 34px);
    }

    .npk-copy-card {
        display: grid;
        gap: 16px;
        justify-items: center;
        text-align: center;
    }

    .npk-gallery-card {
        min-height: 100%;
    }

    .npk-gallery-main {
        position: relative;
        aspect-ratio: 1 / 1;
        overflow: hidden;
        border-radius: 24px;
        border: 1px solid rgba(255, 255, 255, 0.1);
        background: #09101f;
    }

    .npk-gallery-main img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        filter: saturate(1.2) contrast(1.06);
    }

    .npk-gallery-main::after {
        content: "Neon Mode";
        position: absolute;
        right: 18px;
        bottom: 18px;
        min-height: 34px;
        padding: 0 14px;
        display: inline-flex;
        align-items: center;
        border-radius: 999px;
        background: rgba(5, 8, 22, 0.7);
        border: 1px solid rgba(102, 247, 255, 0.22);
        color: var(--cyan);
        font-size: 0.76rem;
        letter-spacing: 0.18em;
        text-transform: uppercase;
    }

    .npk-feature-list {
        margin: 0;
        padding-left: 18px;
        display: grid;
        gap: 10px;
        justify-self: stretch;
        text-align: left;
    }

    .npk-booking-wrap,
    .npk-instructions-wrap {
        display: grid;
        gap: 22px;
    }

    .npk-booking-head,
    .npk-voucher-head {
        display: grid;
        gap: 12px;
        text-align: center;
        justify-items: center;
    }

    .npk-booking-grid {
        display: grid;
        grid-template-columns: repeat(4, minmax(0, 1fr));
        gap: 16px;
    }

    .npk-book-card {
        border-radius: 24px;
        padding: 18px;
        display: grid;
        gap: 14px;
    }

    .npk-book-image {
        aspect-ratio: 1 / 1;
        border-radius: 18px;
        overflow: hidden;
        border: 1px solid rgba(255, 255, 255, 0.1);
        background: #0a1023;
    }

    .npk-book-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        filter: saturate(1.25) contrast(1.08);
        transition: transform 0.45s ease;
    }

    .npk-book-card:hover .npk-book-image img {
        transform: scale(1.08);
    }

    .npk-book-footer {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 10px;
    }

    .npk-tag {
        display: inline-flex;
        align-items: center;
        min-height: 30px;
        padding: 0 12px;
        border-radius: 999px;
        background: rgba(102, 247, 255, 0.08);
        border: 1px solid rgba(102, 247, 255, 0.18);
        color: var(--cyan);
        font-size: 0.78rem;
        font-weight: 700;
        letter-spacing: 0.08em;
        text-transform: uppercase;
    }

    .npk-book-link {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-height: 38px;
        padding: 0 14px;
        border-radius: 999px;
        color: var(--text);
        text-decoration: none;
        font-size: 0.76rem;
        font-weight: 700;
        letter-spacing: 0.1em;
        text-transform: uppercase;
        background: rgba(255, 79, 207, 0.12);
        border: 1px solid rgba(255, 79, 207, 0.24);
    }

    .npk-book-link:hover {
        box-shadow: 0 0 20px rgba(255, 79, 207, 0.22);
    }

    .npk-instruction-grid {
        display: grid;
        grid-template-columns: repeat(6, minmax(0, 1fr));
        gap: 16px;
    }

    .npk-instruction {
        border-radius: 24px;
        padding: 18px;
        display: grid;
        gap: 12px;
        justify-items: center;
        text-align: center;
    }

    .npk-icon {
        width: 58px;
        height: 58px;
        border-radius: 50%;
        display: grid;
        place-items: center;
        font-size: 1.4rem;
        color: var(--text);
        background:
            linear-gradient(135deg, rgba(102, 247, 255, 0.18), rgba(255, 79, 207, 0.18)),
            rgba(255, 255, 255, 0.04);
        border: 1px solid rgba(255, 255, 255, 0.1);
        box-shadow:
            inset 0 0 20px rgba(255, 255, 255, 0.03),
            0 0 18px rgba(102, 247, 255, 0.12);
    }

    .npk-instruction h3 {
        margin: 0;
        font-family: "Archivo Black", Arial, sans-serif;
        font-size: 1rem;
        line-height: 1.2;
        text-transform: uppercase;
        text-align: center;
    }

    .npk-voucher-layout {
        display: grid;
        grid-template-columns: minmax(280px, 0.88fr) minmax(0, 1.12fr);
        gap: clamp(20px, 3vw, 32px);
        align-items: center;
    }

    .npk-voucher-card {
        display: grid;
        gap: 18px;
    }

    .npk-voucher-media {
        position: relative;
        overflow: hidden;
        border-radius: 24px;
        background:
            radial-gradient(circle at 18% 20%, rgba(102, 247, 255, 0.14), transparent 24%),
            radial-gradient(circle at 85% 22%, rgba(255, 79, 207, 0.16), transparent 24%),
            linear-gradient(145deg, rgba(9, 14, 32, 0.84), rgba(6, 10, 20, 0.98));
        border: 1px solid rgba(255, 255, 255, 0.08);
        min-height: 420px;
        display: grid;
        place-items: center;
        padding: 24px;
    }

    .npk-section:not(.npk-hero-section) .npk-voucher-media {
        background: transparent;
    }

    .npk-voucher-media img {
        display: block;
        width: min(100%, 740px);
        height: auto;
        border-radius: 18px;
        box-shadow:
            0 0 0 1px rgba(255, 255, 255, 0.08),
            0 0 24px rgba(102, 247, 255, 0.14),
            0 28px 60px rgba(0, 0, 0, 0.34);
        transform: rotate(-3deg);
        transition: transform 0.45s ease;
    }

    .npk-voucher-media:hover img {
        transform: rotate(-1deg) scale(1.02);
    }

    .npk-voucher-note {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        color: var(--cyan);
        font-size: 0.82rem;
        letter-spacing: 0.16em;
        text-transform: uppercase;
    }

    .npk-voucher-note::before {
        content: "";
        width: 12px;
        height: 12px;
        border-radius: 50%;
        background: var(--cyan);
        box-shadow: 0 0 14px var(--cyan);
    }

    [data-npk-reveal] {
        opacity: 0;
        transform: translateY(28px);
        transition: opacity 0.75s ease, transform 0.75s ease;
    }

    [data-npk-reveal].visible {
        opacity: 1;
        transform: translateY(0);
    }

    @keyframes npkFloat {

        0%,
        100% {
            transform: translate3d(0, 0, 0) scale(1);
        }

        50% {
            transform: translate3d(0, -22px, 0) scale(1.04);
        }
    }

    @media (max-width: 1100px) {
        .npk-booking-grid {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }

        .npk-instruction-grid {
            grid-template-columns: repeat(3, minmax(0, 1fr));
        }
    }

    @media (max-width: 960px) {

        .npk-split,
        .npk-voucher-layout {
            grid-template-columns: 1fr;
        }

        .npk-hero {
            min-height: 100vh;
        }

        .npk-hero-content {
            padding: 18px 18px 106px;
            place-items: center;
        }

        .npk-hero-card {
            width: 100%;
            padding: 20px 18px;
        }

        .npk-hero-ui {
            left: 18px;
            right: 18px;
            bottom: 18px;
            justify-content: space-between;
        }
    }

    @media (max-width: 640px) {
        .npk-section {
            padding: 12px;
        }

        .npk-hero::before {
            inset: 12px;
        }

        .npk-hero-card,
        .npk-copy-card,
        .npk-gallery-card,
        .npk-booking-wrap,
        .npk-instructions-wrap,
        .npk-voucher-card {
            padding: 20px 18px;
            border-radius: 24px;
        }

        .npk-booking-grid,
        .npk-instruction-grid {
            grid-template-columns: 1fr;
        }

        .npk-title {
            font-size: clamp(2.35rem, 13vw, 4rem);
        }

        .npk-actions {
            flex-direction: column;
        }

        .npk-button {
            width: 100%;
        }

        .npk-hero {
            min-height: 760px;
        }

        .npk-hero-content {
            padding: 16px 16px 120px;
        }

        .npk-hero-ui {
            gap: 10px;
            padding: 8px 10px;
        }

        .npk-nav {
            width: 42px;
            height: 42px;
        }

        .npk-voucher-media {
            min-height: 280px;
            padding: 18px;
        }
    }
</style>

<div class="npk-page">
    <span class="npk-orb one"></span>
    <span class="npk-orb two"></span>
    <span class="npk-orb three"></span>

    <section class="npk-section npk-hero-section">
        <div class="npk-shell">
            <section class="npk-hero" aria-label="Neon Paint and Cocktails hero">
                <div class="npk-stage">
                    <article class="npk-slide">
                        <div class="npk-media">
                            <img src="http://paintandwine.local/wp-content/uploads/2026/06/placeholder-1.webp"
                                alt="Neon paint palette glowing under UV light" />
                        </div>
                    </article>
                    <article class="npk-slide">
                        <div class="npk-media">
                            <img src="http://paintandwine.local/wp-content/uploads/2026/06/placeholder-1.webp"
                                alt="Guests painting in vibrant fluorescent colors" />
                        </div>
                    </article>
                    <article class="npk-slide">
                        <div class="npk-media">
                            <img src="http://paintandwine.local/wp-content/uploads/2026/06/placeholder-1.webp"
                                alt="Bright neon art setup with cocktails and UV atmosphere" />
                        </div>
                    </article>
                </div>

                <div class="npk-hero-content">
                    <div class="npk-card npk-hero-card" data-npk-reveal>
                        <div class="npk-hero-copy">
                            <span class="npk-kicker">After Dark Experience</span>
                            <h1 class="npk-title">Neon <span class="cyan">Paint</span> and <span
                                    class="pink">Cocktails</span></h1>
                            <p class="npk-text">
                                Isprobajte iskustvo slikanja u mraku uz UV svjetla, fluorescentne boje,
                                koktele i atmosferu koja izgleda kao da ste usli u drugi univerzum.
                            </p>
                            <div class="npk-actions">
                                <a class="npk-button primary" href="#npk-book">Rezervisi radionicu</a>
                                <a class="npk-button secondary" href="#npk-guide">Kako izgleda dolazak</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="npk-hero-ui" aria-label="Hero carousel controls">
                    <button class="npk-nav" type="button" data-npk-direction="prev"
                        aria-label="Previous slide">&#8592;</button>
                    <div class="npk-dots" aria-label="Slide navigation"></div>
                    <button class="npk-nav" type="button" data-npk-direction="next"
                        aria-label="Next slide">&#8594;</button>
                </div>
            </section>
        </div>
    </section>
    
    <section class="npk-section" id="npk-story">
        <div class="npk-shell npk-split">
            <div class="npk-card npk-copy-card" data-npk-reveal>
                <span class="npk-pill">Slikali u mraku?</span>
                <h2 class="npk-heading">Da li ste ikada <span class="cyan">slikali</span> u mraku?</h2>
                <p class="npk-text">
                    Isprobajte unikatno iskustvo slikanja fluorescentnim bojama pod UV svjetlima na nasim
                    Neon Paint and Cocktails radionicama.
                </p>
                <ul class="npk-feature-list">
                    <li>Cekaju vas skica, 4 koktela, slatki detalji, sav materijal i neonski rekviziti.</li>
                    <li>Ne treba vam nikakvo slikarsko umijece, samo pozitivna energija.</li>
                    <li>Moze se doci solo, u paru ili sa ekipom za noc koja se dugo pamti.</li>
                </ul>
            </div>

            <div class="npk-card npk-gallery-card" data-npk-reveal>
                <div class="npk-gallery-main">
                    <img src="http://paintandwine.local/wp-content/uploads/2026/06/placeholder-1.webp"
                        alt="Neon painting scene under ultraviolet light" />
                </div>
            </div>
        </div>
    </section>

    <span id="npk-book"></span>
    [paint_wine_products categories="neon-paint-and-cocktails" style="neon"]


    <section class="npk-section" id="npk-guide">
        <div class="npk-shell">
            <div class="npk-card npk-instructions-wrap" data-npk-reveal>
                <div class="npk-booking-head">
                    <span class="npk-pill">Atmosfera</span>
                    <h2 class="npk-heading">Dobra atmosfera i <span class="cyan">nezaboravan</span> provod</h2>
                    <p class="npk-text">Ako niste sigurni sta da ocekujete, evo brzog neon vodica za dolazak.</p>
                </div>

                <div class="npk-instruction-grid">
                    <article class="npk-instruction">
                        <span class="npk-icon">&#127912;</span>
                        <h3>Dodji spreman za boje</h3>
                        <p>Dobijate sav materijal za rad, pa vi donosite samo raspolozenje i ekipu.</p>
                    </article>

                    <article class="npk-instruction">
                        <span class="npk-icon">&#9201;</span>
                        <h3>Stizi na vrijeme</h3>
                        <p>Pocetak je onda kada instruktorica kaze, zato ne kasnite i uhvatite uvod.</p>
                    </article>

                    <article class="npk-instruction">
                        <span class="npk-icon">&#127865;</span>
                        <h3>Kokteli su dio showa</h3>
                        <p>Pazite na garderobu, ali opusteno. Ovo je vecer za uzivanje, ne za stres.</p>
                    </article>

                    <article class="npk-instruction">
                        <span class="npk-icon">&#128526;</span>
                        <h3>Neonski rekviziti</h3>
                        <p>U prostoru vas cekaju glow detalji, fotke i scena koja trazi dobar kadar.</p>
                    </article>

                    <article class="npk-instruction">
                        <span class="npk-icon">&#10024;</span>
                        <h3>Opusti potez</h3>
                        <p>Kada vidite fluorescentne boje na platnu, sve postaje lakse i zabavnije.</p>
                    </article>

                    <article class="npk-instruction">
                        <span class="npk-icon">&#127926;</span>
                        <h3>Pusti muziku da vodi</h3>
                        <p>Uz ritam, svjetla i koktele, noc se prirodno pretvara u mini party.</p>
                    </article>
                </div>
            </div>
        </div>
    </section>

    <section class="npk-section" id="npk-voucher">
        <div class="npk-shell">
            <div class="npk-card npk-voucher-card" data-npk-reveal>
                <div class="npk-voucher-layout">
                    <div class="npk-voucher-head">
                        <span class="npk-pill">Voucher</span>
                        <h2 class="npk-voucher-title">Iznenadite nekoga <span class="pink">posebnim</span> iskustvom
                        </h2>
                        <p class="npk-text">
                            Ako zelite da nekome poklonite nesto potpuno drugacije, Neon Paint and Cocktails
                            voucher pretvara jedan obican poklon u dvije ure boje, muzike i uspomena.
                        </p>
                        <span class="npk-voucher-note">Gift it with glow</span>
                    </div>

                    <div class="npk-voucher-media">
                        <img src="http://paintandwine.local/wp-content/uploads/2026/06/placeholder-1.webp"
                            alt="Neon Paint and Cocktails voucher placeholder" />
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<script>
    (function () {
        const root = document.currentScript.previousElementSibling;
        if (!root || !root.classList.contains('npk-page')) return;

        const revealItems = Array.from(root.querySelectorAll('[data-npk-reveal]'));
        const hero = root.querySelector('.npk-hero');
        const slides = hero ? Array.from(hero.querySelectorAll('.npk-slide')) : [];
        const dotsRoot = hero ? hero.querySelector('.npk-dots') : null;
        const prev = hero ? hero.querySelector('[data-npk-direction="prev"]') : null;
        const next = hero ? hero.querySelector('[data-npk-direction="next"]') : null;
        let activeIndex = 0;
        let autoplayId = 0;

        if ('IntersectionObserver' in window) {
            const observer = new IntersectionObserver((entries) => {
                entries.forEach((entry) => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('visible');
                        observer.unobserve(entry.target);
                    }
                });
            }, { threshold: 0.18 });

            revealItems.forEach((item) => observer.observe(item));
        } else {
            revealItems.forEach((item) => item.classList.add('visible'));
        }

        function setSlide(index) {
            activeIndex = (index + slides.length) % slides.length;
            slides.forEach((slide, slideIndex) => {
                slide.classList.toggle('is-active', slideIndex === activeIndex);
            });

            if (dotsRoot) {
                dotsRoot.querySelectorAll('.npk-dot').forEach((dot, dotIndex) => {
                    dot.classList.toggle('is-active', dotIndex === activeIndex);
                });
            }
        }

        function restartAutoplay() {
            window.clearInterval(autoplayId);
            autoplayId = window.setInterval(() => {
                setSlide(activeIndex + 1);
            }, 4800);
        }

        if (hero) {
            hero.addEventListener('pointermove', (event) => {
                const bounds = hero.getBoundingClientRect();
                const x = ((event.clientX - bounds.left) / bounds.width) * 100;
                const y = ((event.clientY - bounds.top) / bounds.height) * 100;
                hero.style.setProperty('--spot-x', x + '%');
                hero.style.setProperty('--spot-y', y + '%');
            });
        }

        if (slides.length && dotsRoot && prev && next) {
            slides.forEach((_, index) => {
                const dot = document.createElement('button');
                dot.type = 'button';
                dot.className = 'npk-dot';
                dot.setAttribute('aria-label', 'Go to slide ' + (index + 1));
                dot.addEventListener('click', () => {
                    setSlide(index);
                    restartAutoplay();
                });
                dotsRoot.appendChild(dot);
            });

            prev.addEventListener('click', () => {
                setSlide(activeIndex - 1);
                restartAutoplay();
            });

            next.addEventListener('click', () => {
                setSlide(activeIndex + 1);
                restartAutoplay();
            });

            setSlide(0);
            restartAutoplay();
        }
    })();
</script>
[paint_wine_footer]