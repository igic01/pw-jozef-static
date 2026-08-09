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

    @media (prefers-reduced-motion: reduce) {
        .v4e-slide,
        .v4e-media img,
        .v4e-voucher-track {
            transition-duration: 0.01ms !important;
        }
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
    .v4e-hero {
        --v4e-red: #bf2020;
        --v4e-white: #ffffff;
        --v4e-paper: #f3ebdf;
        position: relative;
        width: 100%;
        height: min(100vh, 940px);
        overflow: hidden;
        background: #080808;
        border: 1px solid rgba(255, 255, 255, 0.14);
        box-shadow: 0 28px 80px rgba(0, 0, 0, 0.42);
        isolation: isolate;
        font-family: "Open Sans Local", Arial, sans-serif;
    }

    .v4e-hero,
    .v4e-hero *,
    .v4e-info,
    .v4e-info *,
    .v4e-voucher,
    .v4e-voucher *,
    .v4e-private,
    .v4e-private *,
    .v4e-club,
    .v4e-club * {
        box-sizing: border-box;
        font-family: "Open Sans Local", Arial, sans-serif;
    }

    .v4e-hero::before {
        content: "";
        position: absolute;
        inset: 20px;
        border: 1px solid rgba(243, 235, 223, 0.18);
        pointer-events: none;
        z-index: 4;
    }

    .v4e-hero::after {
        content: "";
        position: absolute;
        inset: 0;
        background:
            radial-gradient(circle at 10% 18%, rgba(191, 32, 32, 0.18), transparent 16%),
            radial-gradient(circle at 84% 16%, rgba(255, 255, 255, 0.06), transparent 18%),
            linear-gradient(180deg, rgba(0, 0, 0, 0.18), rgba(0, 0, 0, 0.12));
        mix-blend-mode: screen;
        pointer-events: none;
        z-index: 1;
    }

    .v4e-stage {
        position: absolute;
        inset: 0;
    }

    .v4e-slide {
        position: absolute;
        inset: 0;
        opacity: 0;
        transition: opacity 1s ease;
    }

    .v4e-slide.is-active {
        opacity: 1;
    }

    .v4e-media {
        position: absolute;
        inset: 0;
        overflow: hidden;
    }

    .v4e-media img {
        position: absolute;
        inset: 0;
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .v4e-media img {
        filter: saturate(1.04) contrast(1.03) brightness(0.95);
        transform: scale(1.06);
        transition: transform 7s ease;
    }

    .v4e-slide.is-active .v4e-media img {
        transform: scale(1);
    }

    .v4e-media::before {
        content: "";
        position: absolute;
        inset: 0;
        background:
            linear-gradient(180deg, rgba(0, 0, 0, 0.08), rgba(0, 0, 0, 0.74)),
            linear-gradient(130deg, rgba(191, 32, 32, 0.18), transparent 34%),
            linear-gradient(90deg, rgba(0, 0, 0, 0.35), transparent 42%, transparent 68%, rgba(0, 0, 0, 0.26));
        z-index: 1;
        pointer-events: none;
    }

    .v4e-media::after {
        content: "";
        position: absolute;
        inset: 0;
        background:
            repeating-linear-gradient(90deg,
                rgba(255, 255, 255, 0.03) 0,
                rgba(255, 255, 255, 0.03) 1px,
                transparent 1px,
                transparent 24px);
        mix-blend-mode: soft-light;
        opacity: 0.42;
        z-index: 1;
        pointer-events: none;
    }

    .v4e-content {
        position: absolute;
        inset: 0;
        z-index: 3;
        display: grid;
        place-items: center;
        padding: clamp(30px, 5vw, 62px);
        pointer-events: none;
    }

    .v4e-shell {
        width: min(760px, 100%);
        padding: clamp(24px, 3vw, 36px);
        background:
            linear-gradient(180deg, rgba(255, 255, 255, 0.06), rgba(255, 255, 255, 0.015)),
            rgba(9, 7, 7, 0.44);
        border: 1px solid rgba(243, 235, 223, 0.16);
        backdrop-filter: blur(9px);
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.25);
        text-align: center;
    }

    .v4e-eyebrow {
        margin: 0 0 16px;
        color: rgba(243, 235, 223, 0.84);
        font-size: 0.78rem;
        font-weight: 700;
        letter-spacing: 0.28em;
        text-transform: uppercase;
    }

    .v4e-title {
        margin: 0;
        color: var(--v4e-paper);
        font-family: "Archivo Black", Arial, sans-serif;
        font-size: clamp(3.6rem, 7vw, 7.8rem);
        font-weight: 400;
        line-height: 0.9;
        letter-spacing: 0;
        text-transform: uppercase;
        text-wrap: balance;
    }

    .v4e-title .v4e-accent {
        color: var(--v4e-red);
    }

    .v4e-text {
        margin: 20px 0 0;
        max-width: 36ch;
        margin-left: auto;
        margin-right: auto;
        color: rgba(255, 255, 255, 0.8);
        font-size: clamp(1rem, 1.45vw, 1.08rem);
        line-height: 1.85;
    }

    .v4e-ui {
        position: absolute;
        right: 30px;
        bottom: 28px;
        z-index: 5;
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 10px 12px;
        background: rgba(8, 8, 8, 0.42);
        border: 1px solid rgba(243, 235, 223, 0.16);
        backdrop-filter: blur(10px);
    }

    .v4e-nav,
    .v4e-dot {
        border: 0;
        color: var(--v4e-white);
        cursor: pointer;
    }

    .v4e-nav {
        width: 46px;
        height: 46px;
        background: rgba(255, 255, 255, 0.08);
        font-size: 1.1rem;
        transition: background-color 0.3s ease, transform 0.3s ease;
    }

    .v4e-nav:hover {
        background: rgba(191, 32, 32, 0.72);
        transform: translateY(-1px);
    }

    .v4e-dots {
        display: flex;
        gap: 8px;
        align-items: center;
    }

    .v4e-dot {
        width: 10px;
        height: 10px;
        padding: 0;
        background: rgba(255, 255, 255, 0.4);
        transition: width 0.3s ease, background-color 0.3s ease;
    }

    .v4e-dot.is-active {
        width: 30px;
        background: var(--v4e-red);
    }

    @media (max-width: 820px) {
        .v4e-hero {
            height: 100vh;
        }

        .v4e-hero::before {
            inset: 12px;
        }

        .v4e-content {
            padding: 18px 18px 106px;
            place-items: center;
        }

        .v4e-shell {
            width: 100%;
            padding: 20px 18px;
        }

        .v4e-ui {
            left: 18px;
            right: 18px;
            bottom: 18px;
            justify-content: space-between;
        }
    }

    @media (max-width: 560px) {
        .v4e-content {
            padding: 16px 16px 120px;
        }

        .v4e-shell {
            padding: 18px 16px;
        }

        .v4e-title {
            font-size: clamp(2.7rem, 12vw, 4.4rem);
        }

        .v4e-text {
            max-width: none;
            font-size: 0.94rem;
            line-height: 1.7;
        }

        .v4e-ui {
            gap: 10px;
            padding: 8px 10px;
        }

        .v4e-nav {
            width: 42px;
            height: 42px;
        }
    }

    .v4e-info {
        position: relative;
        width: 100%;
        min-height: 100vh;
        background: #f7f3ec;
        color: #111111;
        border: 1px solid rgba(0, 0, 0, 0.12);
        margin-top: 0;
        font-family: "Open Sans Local", Arial, sans-serif;
        overflow: hidden;
    }

    .v4e-info::before {
        content: "";
        position: absolute;
        inset: 20px;
        border: 1px solid rgba(0, 0, 0, 0.2);
        pointer-events: none;
    }

    .v4e-info::after {
        content: "";
        position: absolute;
        inset: 0;
        background:
            linear-gradient(90deg, rgba(0, 0, 0, 0.04) 0, rgba(0, 0, 0, 0.04) 1px, transparent 1px, transparent 120px),
            linear-gradient(180deg, rgba(191, 32, 32, 0.03), rgba(191, 32, 32, 0.03));
        background-size: 120px 100%, 100% 100%;
        opacity: 0.55;
        pointer-events: none;
    }

    .v4e-info-grid {
        position: relative;
        z-index: 1;
        display: grid;
        grid-template-columns: minmax(280px, 0.95fr) minmax(320px, 1.15fr);
        gap: clamp(28px, 4vw, 54px);
        align-items: center;
        min-height: 100vh;
        padding: clamp(32px, 5vw, 64px);
    }

    .v4e-info-gallery {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 16px;
    }

    .v4e-info-card {
        position: relative;
        aspect-ratio: 1 / 1;
        min-height: 180px;
        overflow: hidden;
        border: 1px solid rgba(0, 0, 0, 0.22);
        background: #d8e2ee;
    }

    .v4e-info-card img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        filter: saturate(0.95) contrast(1.02);
    }

    .v4e-info-copy {
        max-width: 620px;
    }

    .v4e-info-copy h2 {
        margin: 0;
        color: #bf2020;
        font-family: "Archivo Black", Arial, sans-serif;
        font-size: clamp(2.4rem, 5vw, 4.9rem);
        font-weight: 400;
        line-height: 0.92;
        text-transform: uppercase;
        letter-spacing: 0;
        text-align: left;
    }

    .v4e-info-copy h3 {
        margin: 28px 0 12px;
        color: #bf2020;
        font-family: "Archivo Black", Arial, sans-serif;
        font-size: clamp(2rem, 4vw, 3.2rem);
        font-weight: 400;
        line-height: 0.95;
        letter-spacing: 0;
        text-align: left;
    }

    .v4e-info-copy p {
        margin: 0 0 16px;
        max-width: 58ch;
        color: #1a1a1a;
        font-size: clamp(0.98rem, 1.2vw, 1.08rem);
        line-height: 1.72;
    }

    .v4e-voucher {
        position: relative;
        width: 100%;
        background: #f7f3ec;
        color: #111111;
        border: 1px solid rgba(0, 0, 0, 0.12);
        font-family: "Open Sans Local", Arial, sans-serif;
        overflow: hidden;
    }

    .v4e-voucher::before {
        content: "";
        position: absolute;
        inset: 20px;
        border: 1px solid rgba(0, 0, 0, 0.14);
        pointer-events: none;
    }

    .v4e-voucher::after {
        content: "";
        position: absolute;
        inset: 0;
        background:
            linear-gradient(90deg, rgba(0, 0, 0, 0.04) 0, rgba(0, 0, 0, 0.04) 1px, transparent 1px, transparent 120px),
            linear-gradient(180deg, rgba(191, 32, 32, 0.03), rgba(191, 32, 32, 0.03));
        background-size: 120px 100%, 100% 100%;
        opacity: 0.55;
        pointer-events: none;
    }

    .v4e-voucher-inner {
        position: relative;
        z-index: 1;
        display: grid;
        gap: 28px;
        justify-items: center;
        padding: clamp(40px, 6vw, 72px) clamp(20px, 5vw, 48px) clamp(52px, 7vw, 84px);
        text-align: center;
    }

    .v4e-voucher-copy {
        display: grid;
        gap: 14px;
        max-width: 980px;
        text-align: center;
    }

    .v4e-voucher-title {
        margin: 0;
        color: #bf2020;
        font-family: "Archivo Black", Arial, sans-serif;
        font-size: clamp(2.4rem, 5vw, 4.9rem);
        font-weight: 400;
        line-height: 0.92;
        letter-spacing: 0;
        text-transform: uppercase;
    }

    .v4e-voucher-text {
        margin: 0;
        color: #1a1a1a;
        font-size: clamp(1rem, 1.3vw, 1.08rem);
        line-height: 1.6;
    }

    .v4e-voucher-stage {
        width: min(980px, 100%);
        display: grid;
        gap: 18px;
        justify-items: center;
    }

    .v4e-voucher-carousel {
        position: relative;
        width: 100%;
        overflow: hidden;
    }

    .v4e-voucher-track {
        display: flex;
        transition: transform 0.65s ease;
        will-change: transform;
    }

    .v4e-voucher-slide {
        flex: 0 0 100%;
        padding: 0 clamp(6px, 1vw, 12px);
    }

    .v4e-voucher-frame {
        position: relative;
        padding: clamp(12px, 2vw, 16px);
        background: #bf2020;
        border: 1px solid rgba(0, 0, 0, 0.12);
        box-shadow: 0 22px 50px rgba(0, 0, 0, 0.14);
    }

    .v4e-voucher-frame img {
        display: block;
        width: 100%;
        height: auto;
        background: #ffffff;
    }

    .v4e-voucher-dots {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
    }

    .v4e-voucher-dot {
        width: 10px;
        height: 10px;
        padding: 0;
        border: 0;
        border-radius: 999px;
        background: rgba(191, 32, 32, 0.28);
        cursor: pointer;
        transition: transform 0.3s ease, background-color 0.3s ease, width 0.3s ease;
    }

    .v4e-voucher-dot.is-active {
        width: 34px;
        background: #bf2020;
        transform: translateY(-1px);
    }

    .v4e-private,
    .v4e-club {
        position: relative;
        width: 100%;
        background: #f7f3ec;
        color: #111111;
        border: 1px solid rgba(0, 0, 0, 0.12);
        font-family: "Open Sans Local", Arial, sans-serif;
        overflow: hidden;
    }

    .v4e-club {
        background: #f7f3ec url("http://paintandwine.local/wp-content/uploads/2026/06/placeholder-1.webp") center / cover no-repeat;
    }

    .v4e-private::before,
    .v4e-club::before {
        content: "";
        position: absolute;
        inset: 20px;
        border: 1px solid rgba(0, 0, 0, 0.14);
        pointer-events: none;
    }

    .v4e-private::after,
    .v4e-club::after {
        content: "";
        position: absolute;
        inset: 0;
        background:
            linear-gradient(90deg, rgba(0, 0, 0, 0.04) 0, rgba(0, 0, 0, 0.04) 1px, transparent 1px, transparent 120px),
            linear-gradient(180deg, rgba(191, 32, 32, 0.03), rgba(191, 32, 32, 0.03));
        background-size: 120px 100%, 100% 100%;
        opacity: 0.55;
        pointer-events: none;
    }

    .v4e-club::after {
        display: none;
    }

    .v4e-private-inner {
        position: relative;
        z-index: 1;
        display: grid;
        gap: 34px;
        width: min(1440px, calc(100% - 40px));
        margin: 0 auto;
        padding: clamp(40px, 6vw, 76px) clamp(20px, 5vw, 48px) clamp(52px, 7vw, 88px);
    }

    .v4e-private-copy {
        display: grid;
        gap: 14px;
        max-width: 860px;
        margin: 0 auto;
        text-align: center;
    }

    .v4e-private-copy h2 {
        margin: 0;
        color: #bf2020;
        font-family: "Archivo Black", Arial, sans-serif;
        font-size: clamp(2.4rem, 5vw, 4.7rem);
        font-weight: 400;
        line-height: 0.94;
        letter-spacing: 0;
        text-transform: uppercase;
    }

    .v4e-private-copy p {
        margin: 0 auto;
        max-width: 62ch;
        color: #1a1a1a;
        font-size: clamp(1rem, 1.3vw, 1.08rem);
        line-height: 1.72;
    }

    .v4e-private-grid {
        display: grid;
        grid-template-columns: repeat(5, minmax(0, 1fr));
        gap: 18px;
        align-items: stretch;
    }

    .v4e-private-card {
        display: grid;
        grid-template-rows: auto 1fr;
        min-height: 460px;
        background: transparent;
        border: 0;
        box-shadow: none;
        overflow: visible;
        padding: 0 12px 18px;
    }

    .v4e-private-card figure {
        width: min(214px, 92%);
        aspect-ratio: 1 / 1;
        margin: 0 auto 14px;
        overflow: hidden;
        border-radius: 50%;
        background: #d8e2ee;
        border: 0;
    }

    .v4e-private-card img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        filter: saturate(0.96) contrast(1.02);
        transition: transform 0.5s ease;
    }

    .v4e-private-card:hover img {
        transform: scale(1.04);
    }

    .v4e-private-card-body {
        display: flex;
        flex-direction: column;
        gap: 10px;
        padding: 0;
        text-align: center;
    }

    .v4e-private-card h3 {
        margin: 0;
        color: #bf2020;
        font-family: "Archivo Black", Arial, sans-serif;
        font-size: clamp(1.35rem, 1.85vw, 1.85rem);
        font-weight: 400;
        line-height: 1;
        text-transform: uppercase;
        letter-spacing: 0;
        text-align: center;
    }

    .v4e-private-card p {
        margin: 0 auto;
        max-width: 22ch;
        color: #1a1a1a;
        font-size: 0.9rem;
        line-height: 1.55;
        text-align: center;
    }

    .v4e-private-card a {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: fit-content;
        min-height: 44px;
        margin: auto auto 0;
        padding: 0 17px;
        color: #f7f3ec;
        background: #bf2020;
        border: 1px solid #bf2020;
        text-decoration: none;
        font-size: 0.82rem;
        font-weight: 700;
        letter-spacing: 0.08em;
        text-transform: uppercase;
        transition: background-color 0.3s ease, color 0.3s ease, transform 0.3s ease;
    }

    .v4e-private-card a:hover {
        background: transparent;
        color: #bf2020;
        transform: translateY(-1px);
    }

    .v4e-club-inner {
        position: relative;
        z-index: 1;
        display: grid;
        gap: clamp(22px, 4vw, 36px);
        justify-items: center;
        width: min(1080px, calc(100% - 40px));
        margin: 0 auto;
        padding: clamp(42px, 7vw, 86px) clamp(20px, 5vw, 48px);
    }

    .v4e-club-panel {
        display: grid;
        gap: 18px;
        width: 100%;
        padding: clamp(30px, 5vw, 58px);
        background: #f7f3ec;
        border: 1px solid rgba(0, 0, 0, 0.2);
        box-shadow: 0 22px 48px rgba(0, 0, 0, 0.1);
        text-align: center;
    }

    .v4e-club-panel h2 {
        margin: 0;
        color: #111111;
        font-family: "Archivo Black", Arial, sans-serif;
        font-size: clamp(3rem, 6.8vw, 6.2rem);
        font-weight: 400;
        line-height: 0.92;
        letter-spacing: 0;
        text-transform: uppercase;
    }

    .v4e-club-panel p {
        margin: 0 auto;
        max-width: 52ch;
        color: #1a1a1a;
        font-size: clamp(0.95rem, 1.15vw, 1.04rem);
        line-height: 1.6;
    }

    .v4e-club-form {
        display: grid;
        grid-template-columns: 1fr;
        gap: 14px;
        width: min(860px, 100%);
        margin: 4px auto 0;
    }

    .v4e-club-form textarea {
        width: 100%;
        min-height: 210px;
        padding: 16px 18px;
        color: #111111;
        background: rgba(247, 243, 236, 0.82);
        border: 1px solid rgba(0, 0, 0, 0.32);
        border-radius: 0;
        font: inherit;
        line-height: 1.6;
        outline: none;
        resize: vertical;
        transition: border-color 0.3s ease, background-color 0.3s ease;
    }

    .v4e-club-form textarea:focus {
        background: #ffffff;
        border-color: #bf2020;
    }

    .v4e-club-form button {
        justify-self: center;
        min-height: 52px;
        padding: 0 34px;
        color: #f7f3ec;
        background: #bf2020;
        border: 1px solid #bf2020;
        cursor: pointer;
        font: inherit;
        font-size: 0.88rem;
        font-weight: 700;
        letter-spacing: 0.08em;
        text-transform: uppercase;
        transition: background-color 0.3s ease, color 0.3s ease, transform 0.3s ease;
    }

    .v4e-club-form button:hover {
        background: transparent;
        color: #bf2020;
        transform: translateY(-1px);
    }

    .v4e-club-copy {
        display: grid;
        gap: 18px;
        width: min(860px, 100%);
    }

    .v4e-club-copy p {
        margin: 0;
        max-width: none;
        color: #1a1a1a;
        font-size: clamp(1.05rem, 1.45vw, 1.3rem);
        line-height: 1.72;
    }

    @media (max-width: 920px) {
        .v4e-info-grid {
            grid-template-columns: 1fr;
            align-items: start;
        }

        .v4e-info {
            min-height: auto;
        }

        .v4e-info-grid {
            min-height: auto;
        }

        .v4e-voucher-inner {
            text-align: left;
            justify-items: stretch;
        }

        .v4e-voucher-stage {
            width: 100%;
        }

        .v4e-voucher-dots {
            justify-content: flex-start;
        }

        .v4e-private-grid {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }

        .v4e-private-card {
            min-height: 430px;
        }

        .v4e-private-card figure {
            width: min(220px, 78%);
        }

    }

    @media (max-width: 640px) {
        .v4e-info::before {
            inset: 12px;
        }

        .v4e-info-grid {
            padding: 22px 18px;
            gap: 24px;
        }

        .v4e-info-gallery {
            gap: 12px;
        }

        .v4e-voucher::before {
            inset: 12px;
        }

        .v4e-voucher-inner {
            gap: 22px;
            padding: 28px 18px 34px;
        }

        .v4e-voucher-title {
            font-size: clamp(2rem, 9vw, 3rem);
        }

        .v4e-voucher-slide {
            padding: 0 2px;
        }

        .v4e-private::before,
        .v4e-club::before {
            inset: 12px;
        }

        .v4e-private-inner {
            gap: 24px;
            padding: 28px 18px 36px;
        }

        .v4e-private-grid {
            grid-template-columns: 1fr;
        }

        .v4e-private-card {
            min-height: auto;
            padding: 0 18px 22px;
        }

        .v4e-private-card figure {
            width: min(220px, 72%);
        }

        .v4e-club-inner {
            width: 100%;
            gap: 24px;
            padding: 28px 18px 36px;
        }

        .v4e-club-panel {
            padding: 22px 18px;
        }

        .v4e-club-form {
            grid-template-columns: 1fr;
        }

        .v4e-club-form button {
            justify-self: stretch;
            width: 100%;
        }
    }
</style>

<section class="v4e-hero" aria-label="Editorial hero with hover color reveal">
    <div class="v4e-stage">
        <article class="v4e-slide">
            <div class="v4e-media">
                <img src="http://paintandwine.local/wp-content/uploads/2026/06/placeholder-1.webp"
                    alt="Artistic hero scene one" />
            </div>
        </article>
        <article class="v4e-slide">
            <div class="v4e-media">
                <img src="http://paintandwine.local/wp-content/uploads/2026/06/placeholder-1.webp"
                    alt="Artistic hero scene two" />
            </div>
        </article>
        <article class="v4e-slide">
            <div class="v4e-media">
                <img src="http://paintandwine.local/wp-content/uploads/2026/06/placeholder-1.webp"
                    alt="Artistic hero scene three" />
            </div>
        </article>
    </div>

    <div class="v4e-content">
        <div class="v4e-shell">
            <p class="v4e-eyebrow">Version 4</p>
            <h1 class="v4e-title">Color Wakes <span class="v4e-accent">Under</span> The Hand</h1>
            <p class="v4e-text">
                The text sits directly on the image, while hover pulls color out of the monochrome frame
                in a slow radial bloom that follows the cursor position.
            </p>
        </div>
    </div>

    <div class="v4e-ui" aria-label="Carousel controls">
        <button class="v4e-nav" type="button" data-v4e-direction="prev" aria-label="Previous slide">&#8592;</button>
        <div class="v4e-dots" aria-label="Slide navigation"></div>
        <button class="v4e-nav" type="button" data-v4e-direction="next" aria-label="Next slide">&#8594;</button>
    </div>
</section>

<section class="v4e-info" aria-label="About Paint and Wine">
    <div class="v4e-info-grid">
        <div class="v4e-info-gallery">
            <figure class="v4e-info-card">
                <img src="http://paintandwine.local/wp-content/uploads/2026/06/placeholder-1.webp"
                    alt="Paint and Wine moment one" />
            </figure>
            <figure class="v4e-info-card">
                <img src="http://paintandwine.local/wp-content/uploads/2026/06/placeholder-1.webp"
                    alt="Paint and Wine moment two" />
            </figure>
            <figure class="v4e-info-card">
                <img src="http://paintandwine.local/wp-content/uploads/2026/06/placeholder-1.webp"
                    alt="Paint and Wine moment three" />
            </figure>
            <figure class="v4e-info-card">
                <img src="http://paintandwine.local/wp-content/uploads/2026/06/placeholder-1.webp"
                    alt="Paint and Wine moment four" />
            </figure>
        </div>

        <div class="v4e-info-copy">
            <h2>OTKRIJTE I VI UMJETNIKA U SEBI!</h2>
            <p>
                Paint&amp;Wine su slikarske radionice za amatere i ljude bez ikakvog slikarskog iskustva
                sa neograničenom konzumacijom vrhunskog vina.
            </p>

            <h3>O čemu se radi?</h3>
            <p>
                Na našem mjesečnom programu odabete temu koja vam se najviše sviđa i prijavite se za
                radionicu sa tim datumom. Kada dođete, čeka vas sav materijal potreban za slikanje
                i instruktorica koja vas vodi korak po korak kroz proces.
            </p>
            <p>
                Kod nas se možete odlučiti za bijelo, roze ili crveno vino, uvijek vrhunske kvalitete.
            </p>
            <p>
                Na kraju radionice svi idete sa sopstvenom kreacijom i sa sobom kući nosite umjetničko
                djelo, uspomenu na kvalitetno druženje ili poklon za nekoga.
            </p>
        </div>
    </div>
</section>

[paint_wine_products exclude_category="pw-shop"]

<section class="v4e-voucher" aria-label="Paint and Wine voucher">
    <div class="v4e-voucher-inner">
        <div class="v4e-voucher-copy">
            <h2 class="v4e-voucher-title">ŽELITE DA IZNENADITE VOLJENU OSOBU POSEBNIM POKLONOM?</h2>
            <p class="v4e-voucher-text">Tu je Paint and Wine</p>
        </div>

        <div class="v4e-voucher-stage">
            <div class="v4e-voucher-carousel" data-v4e-voucher-carousel>
                <div class="v4e-voucher-track">
                    <figure class="v4e-voucher-slide">
                        <div class="v4e-voucher-frame">
                            <img src="http://paintandwine.local/wp-content/uploads/2026/06/placeholder-1.webp"
                                alt="Paint and Wine gift voucher" />
                        </div>
                    </figure>
                    <figure class="v4e-voucher-slide">
                        <div class="v4e-voucher-frame">
                            <img src="http://paintandwine.local/wp-content/uploads/2026/06/placeholder-1.webp"
                                alt="Paint and Wine gift voucher alternative view" />
                        </div>
                    </figure>
                    <figure class="v4e-voucher-slide">
                        <div class="v4e-voucher-frame">
                            <img src="http://paintandwine.local/wp-content/uploads/2026/06/placeholder-1.webp"
                                alt="Paint and Wine gift voucher close view" />
                        </div>
                    </figure>
                </div>
            </div>
            <div class="v4e-voucher-dots" aria-label="Voucher slideshow navigation"></div>
        </div>
    </div>
</section>

<script>
    (function () {
        const root = document.currentScript.parentElement;
        const hero = root.querySelector(".v4e-hero");
        if (!hero) return;
        const slides = Array.from(hero.querySelectorAll(".v4e-slide"));
        const dotsRoot = hero.querySelector(".v4e-dots");
        const prev = hero.querySelector('[data-v4e-direction="prev"]');
        const next = hero.querySelector('[data-v4e-direction="next"]');
        const autoplayDelay = 5200;
        const reduceMotion = window.matchMedia("(prefers-reduced-motion: reduce)").matches;
        let activeIndex = 0;
        let autoplayId;

        function renderDots() {
            slides.forEach((_, index) => {
                const dot = document.createElement("button");
                dot.type = "button";
                dot.className = "v4e-dot";
                dot.setAttribute("aria-label", `Go to slide ${index + 1}`);
                dot.addEventListener("click", () => {
                    setSlide(index);
                    restartAutoplay();
                });
                dotsRoot.appendChild(dot);
            });
        }

        function updateDots() {
            const dots = dotsRoot.querySelectorAll(".v4e-dot");
            dots.forEach((dot, index) => {
                dot.classList.toggle("is-active", index === activeIndex);
            });
        }

        function setSlide(index) {
            activeIndex = (index + slides.length) % slides.length;
            slides.forEach((slide, slideIndex) => {
                slide.classList.toggle("is-active", slideIndex === activeIndex);
            });
            updateDots();
        }

        function restartAutoplay() {
            window.clearInterval(autoplayId);
            if (reduceMotion || document.hidden) return;
            autoplayId = window.setInterval(() => {
                setSlide(activeIndex + 1);
            }, autoplayDelay);
        }

        function stopAutoplay() {
            window.clearInterval(autoplayId);
        }

        prev.addEventListener("click", () => {
            setSlide(activeIndex - 1);
            restartAutoplay();
        });

        next.addEventListener("click", () => {
            setSlide(activeIndex + 1);
            restartAutoplay();
        });

        renderDots();
        window.requestAnimationFrame(() => {
            setSlide(0);
            restartAutoplay();
        });

        document.addEventListener("visibilitychange", () => {
            if (document.hidden) {
                stopAutoplay();
                return;
            }

            restartAutoplay();
        });
    })();

    (function () {
        const voucher = document.querySelector("[data-v4e-voucher-carousel]");
        if (!voucher) return;

        const track = voucher.querySelector(".v4e-voucher-track");
        const slides = Array.from(voucher.querySelectorAll(".v4e-voucher-slide"));
        const dotsRoot = voucher.parentElement.querySelector(".v4e-voucher-dots");
        const autoplayDelay = 3200;
        const reduceMotion = window.matchMedia("(prefers-reduced-motion: reduce)").matches;
        let activeIndex = 0;
        let autoplayId;

        function updateTrack() {
            track.style.transform = `translate3d(-${activeIndex * 100}%, 0, 0)`;
            dotsRoot.querySelectorAll(".v4e-voucher-dot").forEach((dot, index) => {
                dot.classList.toggle("is-active", index === activeIndex);
            });
        }

        function setSlide(index) {
            activeIndex = (index + slides.length) % slides.length;
            updateTrack();
        }

        function restartAutoplay() {
            window.clearInterval(autoplayId);
            if (reduceMotion || document.hidden) return;
            autoplayId = window.setInterval(() => {
                setSlide(activeIndex + 1);
            }, autoplayDelay);
        }

        function stopAutoplay() {
            window.clearInterval(autoplayId);
        }

        slides.forEach((_, index) => {
            const dot = document.createElement("button");
            dot.type = "button";
            dot.className = "v4e-voucher-dot";
            dot.setAttribute("aria-label", `Prikaži voucher ${index + 1}`);
            dot.addEventListener("click", () => {
                setSlide(index);
                restartAutoplay();
            });
            dotsRoot.appendChild(dot);
        });

        setSlide(0);
        restartAutoplay();

        document.addEventListener("visibilitychange", () => {
            if (document.hidden) {
                stopAutoplay();
                return;
            }

            restartAutoplay();
        });
    })();
</script>

<section class="v4e-private" aria-label="Privatne radionice">
    <div class="v4e-private-inner">
        <div class="v4e-private-copy">
            <h2>ORGANIZUJETE TEAM BUILDING, DJEVOJAČKO VEČE, ROĐENDAN ILI PROSLAVU?</h2>
            <p>Zakažite privatnu radionicu! Nudimo 5 vrsta, a vi odaberite onu najbolju za vas!</p>
        </div>

        <div class="v4e-private-grid">
            <article class="v4e-private-card">
                <figure>
                    <img src="http://paintandwine.local/wp-content/uploads/2026/06/placeholder-1.webp"
                        alt="Team building radionica" />
                </figure>
                <div class="v4e-private-card-body">
                    <h3>Team Building</h3>
                    <p>Privatna radionica za timove i opušteno druženje uz slikanje.</p>
                    <a href="#">Saznaj više</a>
                </div>
            </article>

            <article class="v4e-private-card">
                <figure>
                    <img src="http://paintandwine.local/wp-content/uploads/2026/06/placeholder-1.webp"
                        alt="Djevojačko veče radionica" />
                </figure>
                <div class="v4e-private-card-body">
                    <h3>Djevojačko Veče</h3>
                    <p>Kreativno veče za društvo, vino i uspomene prije proslave.</p>
                    <a href="#">Saznaj više</a>
                </div>
            </article>

            <article class="v4e-private-card">
                <figure>
                    <img src="http://paintandwine.local/wp-content/uploads/2026/06/placeholder-1.webp"
                        alt="Rođendanska radionica" />
                </figure>
                <div class="v4e-private-card-body">
                    <h3>Rođendan</h3>
                    <p>Posebna rođendanska radionica za vaše najbliže goste.</p>
                    <a href="#">Saznaj više</a>
                </div>
            </article>

            <article class="v4e-private-card">
                <figure>
                    <img src="http://paintandwine.local/wp-content/uploads/2026/06/placeholder-1.webp"
                        alt="Porodična proslava radionica" />
                </figure>
                <div class="v4e-private-card-body">
                    <h3>Porodična Proslava</h3>
                    <p>Toplo druženje za porodicu, smijeh i zajedničku sliku.</p>
                    <a href="#">Saznaj više</a>
                </div>
            </article>

            <article class="v4e-private-card">
                <figure>
                    <img src="http://paintandwine.local/wp-content/uploads/2026/06/placeholder-1.webp"
                        alt="Tematska privatna radionica" />
                </figure>
                <div class="v4e-private-card-body">
                    <h3>Tematska Radionica</h3>
                    <p>Odaberite temu i napravite radionicu po svom ukusu.</p>
                    <a href="#">Saznaj više</a>
                </div>
            </article>
        </div>
    </div>
</section>

<section class="v4e-club" aria-label="Vinski saradnik prijava">
    <div class="v4e-club-inner">
        <div class="v4e-club-panel">
            <h2>POSTANITE VINSKI SARADNIK!</h2>
            <p>Ukoliko vam se sviđa naš koncept i želite da naši gosti probaju vaša vina, ostavite nam poruku, a mi ćemo
                vas kontaktirati u kratkom roku!</p>
            [forminator_form id="154"]
        </div>

        <div class="v4e-club-copy">
            <p>Slikanje dokazano smanjuje stres i kortizol, poboljšava emocionalnu regulaciju, smanjuje simptome
                anksioznosti i depresije, povećava samopouzdanje, poboljšava koncentraciju i pažnju.</p>
        </div>
    </div>
</section>

[paint_wine_footer]
