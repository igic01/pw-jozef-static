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
    .v4e-about {
        --v4e-red: #bf2020;
        --v4e-red-soft: #ff8f8f;
        --v4e-white: #ffffff;
        --v4e-paper: #f3ebdf;
        --v4e-ink: #111111;
        --v4e-ink-soft: #1a1a1a;
        --v4e-frame: #223447;
        font-family: "Open Sans Local", Arial, sans-serif;
    }

    .v4e-about,
    .v4e-about * {
        box-sizing: border-box;
    }

    .v4e-about-hero {
        --v4e-red: #bf2020;
        --v4e-white: #ffffff;
        --v4e-paper: #f3ebdf;
        position: relative;
        width: 100%;
        min-height: 100vh;
        overflow: hidden;
        background: #080808;
        border: 1px solid rgba(255, 255, 255, 0.14);
        box-shadow: 0 28px 80px rgba(0, 0, 0, 0.42);
        isolation: isolate;
    }

    .v4e-about-hero::before,
    .v4e-about-panel::before {
        content: "";
        position: absolute;
        inset: 20px;
        border: 1px solid rgba(243, 235, 223, 0.18);
        pointer-events: none;
        z-index: 4;
    }

    .v4e-about-hero::after {
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

    .v4e-about-stage {
        position: absolute;
        inset: 0;
    }

    .v4e-about-slide {
        position: absolute;
        inset: 0;
        opacity: 0;
        transition: opacity 1s ease;
    }

    .v4e-about-slide.is-active {
        opacity: 1;
    }

    .v4e-about-media {
        position: absolute;
        inset: 0;
        overflow: hidden;
    }

    .v4e-about-media img {
        position: absolute;
        inset: 0;
        width: 100%;
        height: 100%;
        object-fit: cover;
        filter: saturate(0.38) contrast(0.9) brightness(0.48);
        transform: scale(1.06);
        transition: transform 7s ease;
    }

    .v4e-about-slide.is-active .v4e-about-media img {
        transform: scale(1);
    }

    .v4e-about-media::before {
        content: "";
        position: absolute;
        inset: 0;
        background:
            linear-gradient(180deg, rgba(0, 0, 0, 0.26), rgba(0, 0, 0, 0.8)),
            linear-gradient(130deg, rgba(191, 32, 32, 0.18), transparent 34%),
            linear-gradient(90deg, rgba(0, 0, 0, 0.45), transparent 42%, transparent 68%, rgba(0, 0, 0, 0.32));
        z-index: 1;
        pointer-events: none;
    }

    .v4e-about-media::after {
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

    .v4e-about-content {
        position: relative;
        z-index: 3;
        min-height: 100vh;
        display: grid;
        place-items: center;
        padding: clamp(30px, 5vw, 62px);
        text-align: center;
    }

    .v4e-about-shell {
        width: min(1120px, 100%);
        margin: 0 auto;
        display: grid;
        gap: 26px;
        justify-items: center;
        text-align: center;
    }

    .v4e-about-head {
        width: min(760px, calc(100% - 40px));
        padding: clamp(24px, 3vw, 36px);
        background:
            linear-gradient(180deg, rgba(255, 255, 255, 0.06), rgba(255, 255, 255, 0.015)),
            rgba(9, 7, 7, 0.44);
        border: 1px solid rgba(243, 235, 223, 0.16);
        backdrop-filter: blur(9px);
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.25);
        display: grid;
        justify-items: center;
        margin: 0 auto;
        text-align: center;
        overflow: hidden;
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
        max-width: 10ch;
        font-size: clamp(2.7rem, 6.1vw, 5.8rem);
        font-weight: 600;
        line-height: 1.08;
        letter-spacing: 0;
        text-transform: uppercase;
        text-wrap: balance;
        text-align: center;
        overflow-wrap: anywhere;
    }

    .v4e-title .v4e-accent {
        color: var(--v4e-red-soft);
    }

    .v4e-text {
        margin: 20px 0 0;
        max-width: 44ch;
        color: rgba(255, 255, 255, 0.82);
        font-size: clamp(1.12rem, 1.6vw, 1.28rem);
        line-height: 1.85;
        text-align: center;
    }

    .v4e-about-lead {
        display: grid;
        grid-template-columns: minmax(250px, 320px) minmax(320px, 1fr);
        gap: clamp(22px, 3.4vw, 44px);
        align-items: center;
        justify-items: center;
        text-align: center;
    }

    .v4e-about-avatar {
        width: min(320px, 100%);
        aspect-ratio: 1 / 1;
        border-radius: 999px;
        border: 1px solid rgba(243, 235, 223, 0.82);
        background: rgba(34, 52, 71, 0.95);
        overflow: hidden;
        justify-self: center;
    }

    .v4e-about-avatar img,
    .v4e-about-card img,
    .v4e-about-grid img,
    .v4e-about-wide img,
    .v4e-about-tall img,
    .v4e-about-side img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
    }

    .v4e-about-panel {
        position: relative;
        width: 100%;
        min-height: auto;
        background: #f7f3ec;
        color: #111111;
        border: 1px solid rgba(0, 0, 0, 0.12);
        overflow: hidden;
    }

    .v4e-about-panel::after {
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

    .v4e-about-inner {
        position: relative;
        z-index: 1;
        width: min(1320px, calc(100% - 40px));
        min-height: auto;
        margin: 0 auto;
        display: grid;
        gap: 22px;
        align-content: start;
        justify-items: center;
        text-align: center;
        padding: clamp(30px, 4.5vw, 54px) clamp(18px, 4vw, 42px);
    }

    .v4e-about-kicker {
        margin: 0;
        color: var(--v4e-red);
        font-size: clamp(1.55rem, 2.5vw, 2.35rem);
        font-weight: 700;
        text-align: center;
    }

    .v4e-about-panel h2,
    .v4e-about-panel h3 {
        margin: 0;
        color: var(--v4e-red);
        font-family: "Archivo Black", Arial, sans-serif;
        font-weight: 600;
        line-height: 0.94;
        letter-spacing: 0;
        text-transform: uppercase;
        text-align: center;
    }

    .v4e-about-panel h2 {
        font-size: clamp(2.4rem, 5vw, 4.9rem);
    }

    .v4e-about-panel h3 {
        font-size: clamp(2rem, 4vw, 3.2rem);
    }

    .v4e-about-copy p,
    .v4e-about-copy li,
    .v4e-about-copy .v4e-about-note {
        margin: 0;
        color: #1a1a1a;
        font-size: clamp(1.12rem, 1.45vw, 1.28rem);
        line-height: 1.78;
    }

    .v4e-about-split {
        display: grid;
        grid-template-columns: minmax(260px, 0.95fr) minmax(320px, 1.1fr);
        gap: clamp(20px, 3.2vw, 40px);
        align-items: center;
    }

    .v4e-about-split-reverse {
        display: grid;
        grid-template-columns: minmax(320px, 1.1fr) minmax(260px, 0.95fr);
        gap: clamp(20px, 3.2vw, 40px);
        align-items: center;
    }

    .v4e-about-columns {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: clamp(18px, 2.6vw, 34px);
        align-items: start;
    }

    .v4e-about-copy {
        display: grid;
        gap: 12px;
        justify-items: center;
        text-align: center;
    }

    .v4e-about-card {
        position: relative;
        aspect-ratio: 1 / 1;
        overflow: hidden;
        border: 1px solid rgba(0, 0, 0, 0.22);
        background: #d8e2ee;
    }

    .v4e-about-wide {
        aspect-ratio: 16 / 5;
        overflow: hidden;
        border: 1px solid rgba(0, 0, 0, 0.22);
        background: #d8e2ee;
    }

    .v4e-about-grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 14px;
    }

    .v4e-about-grid .v4e-about-card {
        min-height: 180px;
    }

    .v4e-about-row {
        display: grid;
        grid-template-columns: repeat(4, minmax(0, 1fr));
        gap: 14px;
    }

    .v4e-about-row .v4e-about-card {
        aspect-ratio: 1 / 1;
    }

    .v4e-about-center {
        text-align: center;
        justify-items: center;
    }

    .v4e-about-tall {
        aspect-ratio: 4 / 5;
        overflow: hidden;
        border: 1px solid rgba(0, 0, 0, 0.22);
        background: #d8e2ee;
    }

    .v4e-about-trio {
        display: grid;
        grid-template-columns: minmax(180px, 0.78fr) minmax(360px, 1.1fr) minmax(180px, 0.78fr);
        gap: clamp(16px, 2.4vw, 24px);
        align-items: center;
    }

    .v4e-about-trio .v4e-about-copy {
        max-width: 520px;
        justify-self: center;
    }

    .v4e-about-trio h3 {
        max-width: 12ch;
        font-size: clamp(1.65rem, 3vw, 2.45rem);
        line-height: 1.08;
        overflow-wrap: anywhere;
    }

    .v4e-about-side {
        width: min(100%, 420px);
        aspect-ratio: 4 / 3;
        overflow: hidden;
        border: 1px solid rgba(0, 0, 0, 0.22);
        background: #d8e2ee;
    }

    .v4e-about-ending {
        margin: 10px 0 0;
        color: #111111;
        font-family: "Archivo Black", Arial, sans-serif;
        font-size: clamp(1.65rem, 2.45vw, 2.65rem);
        line-height: 1.2;
        text-align: center;
        text-transform: uppercase;
    }

    .v4e-about-faq-title {
        margin: 0;
        color: #111111;
        font-family: "Archivo Black", Arial, sans-serif;
        font-size: clamp(3rem, 7vw, 5.2rem);
        font-weight: 800;
        line-height: 0.92;
        text-transform: uppercase;
        text-align: center;
    }

    .v4e-about-faq-subtitle {
        margin: 6px 0 0;
        color: #111111;
        font-size: clamp(1.35rem, 2vw, 2.05rem);
        font-weight: 700;
        text-align: center;
    }

    .v4e-about-faq {
        display: grid;
        gap: 12px;
        width: min(980px, 100%);
        margin: 0 auto;
        padding-left: clamp(0px, 5vw, 72px);
        text-align: left;
    }

    .v4e-about-faq-item {
        display: grid;
        grid-template-columns: 40px 1fr;
        gap: 10px;
        align-items: start;
    }

    .v4e-about-faq-item .v4e-about-number,
    .v4e-about-faq-item strong {
        color: #111111;
        font-size: clamp(1.12rem, 1.65vw, 1.32rem);
        line-height: 1.35;
        font-weight: 700;
    }

    .v4e-about-faq-item p {
        margin: 0;
        color: #1a1a1a;
        font-size: clamp(1.08rem, 1.45vw, 1.22rem);
        line-height: 1.58;
    }

    @media (max-width: 920px) {

        .v4e-about-lead,
        .v4e-about-split,
        .v4e-about-split-reverse,
        .v4e-about-columns,
        .v4e-about-trio {
            grid-template-columns: 1fr;
        }

        .v4e-about-row {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }

        .v4e-about-inner {
            min-height: auto;
        }

        .v4e-about-panel {
            min-height: auto;
        }

        .v4e-about-trio .v4e-about-copy {
            max-width: 760px;
        }

        .v4e-about-trio h3 {
            max-width: 16ch;
        }
    }

    @media (max-width: 640px) {

        .v4e-about-hero::before,
        .v4e-about-panel::before {
            inset: 12px;
        }

        .v4e-about-content {
            padding: 18px 18px 28px;
        }

        .v4e-about-head {
            width: min(100%, calc(100% - 8px));
            padding: 20px 18px;
        }

        .v4e-title {
            max-width: 9ch;
            font-size: clamp(2.35rem, 10vw, 3.8rem);
            line-height: 1.1;
        }

        .v4e-about-inner {
            width: min(100%, calc(100% - 24px));
            padding: 22px 14px 28px;
        }

        .v4e-about-grid,
        .v4e-about-row {
            grid-template-columns: 1fr;
        }

        .v4e-about-faq {
            padding-left: 0;
        }

        .v4e-about-faq-item {
            grid-template-columns: 30px 1fr;
        }
    }
</style>

<div class="v4e-about">
    <section class="v4e-about-hero" aria-label="About us hero">
        <div class="v4e-about-stage">
            <article class="v4e-about-slide">
                <div class="v4e-about-media">
                    <img src="http://paintandwine.local/wp-content/uploads/2026/06/placeholder-1.webp" alt="Paint and Wine team" />
                </div>
            </article>
            <article class="v4e-about-slide">
                <div class="v4e-about-media">
                    <img src="http://paintandwine.local/wp-content/uploads/2026/06/placeholder-1.webp" alt="Paint and Wine studio" />
                </div>
            </article>
            <article class="v4e-about-slide">
                <div class="v4e-about-media">
                    <img src="http://paintandwine.local/wp-content/uploads/2026/06/placeholder-1.webp" alt="Paint and Wine workshop" />
                </div>
            </article>
        </div>

        <div class="v4e-about-content">
            <div class="v4e-about-shell">
                <div class="v4e-about-head">
                    <p class="v4e-eyebrow">About Us</p>
                    <h1 class="v4e-title">Saznajte Više <span class="v4e-accent">O Nama</span></h1>
                    <p class="v4e-text">Naš tim, naši koncepti i odgovori na najčešća pitanja na jednoj stranici, u
                        istom vizuelnom jeziku kao ostatak sajta.</p>
                </div>

                <div class="v4e-about-lead">
                    <div class="v4e-about-avatar">
                        <img src="http://paintandwine.local/wp-content/uploads/2026/06/placeholder-1.webp" alt="Naš tim" />
                    </div>
                    <p class="v4e-text">
                        Ćao! Ja sam Tamara Radulović i sa svoje 23 godine sam pokrenula Paint and Wine Podgorica.
                        Imala sam želju da Podgorici pružim nešto drugačiju vrstu zabave i sa njom povežem kulturu i
                        umjetnost. Od samog početka, emocije naših gostiju su jasne - oduševljenje, sreća, ponos i
                        zadovoljstvo. Naš fokus je striktno na kvalitetu usluge i proizvoda, a cilj je samo jedan -
                        srećni posjetioci.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <section class="v4e-about-panel" aria-label="Naš tim prvi dio">
        <div class="v4e-about-inner">
            <h2 class="v4e-about-kicker">Naravno, ništa ne bi bilo moguće bez najboljeg tima na svijetu!</h2>

            <div class="v4e-about-columns">
                <div class="v4e-about-copy">
                    <div class="v4e-about-card">
                        <img src="http://paintandwine.local/wp-content/uploads/2026/06/placeholder-1.webp" alt="Tea Radulović" />
                    </div>
                    <p>
                        Poznato lice na radionicama je i moja sestra, Tea Radulović. Ona ima zvaničnu ulogu marketing
                        menadžera, ali je možete vidjeti posvuda i u bezbroj zaduženja. Od početka je uz Paint and Wine
                        i njen doprinos možete vidjeti na društvenim mrežama i tokom radionica. Uvijek će za vas imati
                        spremnu šalu ili aparat da uhvati najbolju fotku.
                    </p>
                </div>

                <div class="v4e-about-copy">
                    <p>
                        Ubrzo nakon otvaranja mi se pridružila moja najbolja drugarica Marija Šutović koja je dala
                        konceptu novu dimenziju i postala partner. Maki je tu za umjetnički dio i pored toga što drži
                        operativni dio poslovanja, jedna je od omiljenih instruktorki. Marija sa lakoćom pristupa poslu
                        i svojom pozitivom svima oko sebe popravi raspoloženje.
                    </p>
                    <div class="v4e-about-card">
                        <img src="http://paintandwine.local/wp-content/uploads/2026/06/placeholder-1.webp" alt="Marija Šutović" />
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="v4e-about-panel" aria-label="Naš tim drugi dio">
        <div class="v4e-about-inner">

            <div class="v4e-about-wide">
                <img src="http://paintandwine.local/wp-content/uploads/2026/06/placeholder-1.webp" alt="Tim na radionici" />
            </div>

            <div class="v4e-about-copy">
                <p>
                    Na našim radionicama će vas uvijek dočekati instruktorka i jedna od dama zaduženih za sipanje vina.
                    Kako je sav materijal obezbijeđen, vama ostaje samo da se prepustite iskustvu i uživate.
                </p>
                <p>
                    Neskromno tvrdimo da imamo najbolji kolektiv, pa bar u Crnoj Gori. Naš tim trenutno broji 7 članova,
                    a nadamo se da će se brojka samo povećavati. Još od prvog dana, imperativ poslovanja Paint and Wine
                    Podgorica jeste da naš tim bude maksimalno zadovoljan i da svaki potez četkice dolazi iz srca. Naši
                    zaposleni su prije svega dobri ljudi, a odmah zatim i sve ostalo. Kriterijumi za zapošljavanje su
                    nešto
                    strožiji, pa zasigurno možemo reći da od nas možete očekivati kvalitet i standard.
                </p>
            </div>
        </div>
    </section>

    <section class="v4e-about-panel" aria-label="Naši koncepti">
        <div class="v4e-about-inner">
            <h2>Naši Koncepti</h2>

            <div class="v4e-about-split">
                <div class="v4e-about-avatar" style="border-color:rgba(0,0,0,0.22); background:#d8e2ee;">
                    <img src="http://paintandwine.local/wp-content/uploads/2026/06/placeholder-1.webp" alt="Paint and Wine Podgorica" />
                </div>
                <div class="v4e-about-copy">
                    <h3>Šta je Paint and Wine Podgorica?</h3>
                    <p>
                        Paint&amp;Wine su slikarske radionice za amatere i ljude bez ikakvog slikarskog iskustva sa
                        neograničenom konzumacijom vrhunskog vina.
                    </p>
                </div>
            </div>

            <div class="v4e-about-split-reverse">
                <div class="v4e-about-copy">
                    <h3>O čemu se radi?</h3>
                    <p>
                        Na našem mjesečnom programu odabete temu koja vam se najviše sviđa i prijavite se za radionicu
                        sa tim datumom. Kada dođete, čeka vas sav materijal neophodan za slikanje (štafelaj, platna,
                        boje, četkice, kecelje isl) i instruktorka koja vas vodi korak po korak kroz proces. Radionica
                        traje oko 2 sata i svi slikamo istu temu. Kod nas se možete odlučiti za bijelo, roze ili crveno
                        (ili svako) vino, uvijek vrhunskog kvaliteta. Na kraju radionice svi izađete sa sopstvenom
                        kreacijom i sa sobom kući nosite umjetničko djelo, uspomenu na kvalitetno druženje ili poklon
                        za nekoga.
                    </p>
                </div>

                <div class="v4e-about-grid">
                    <div class="v4e-about-card"><img src="http://paintandwine.local/wp-content/uploads/2026/06/placeholder-1.webp" alt="Koncept galerija 1" /></div>
                    <div class="v4e-about-card"><img src="http://paintandwine.local/wp-content/uploads/2026/06/placeholder-1.webp" alt="Koncept galerija 2" /></div>
                    <div class="v4e-about-card"><img src="http://paintandwine.local/wp-content/uploads/2026/06/placeholder-1.webp" alt="Koncept galerija 3" /></div>
                    <div class="v4e-about-card"><img src="http://paintandwine.local/wp-content/uploads/2026/06/placeholder-1.webp" alt="Koncept galerija 4" /></div>
                </div>
            </div>
        </div>
    </section>

    <section class="v4e-about-panel" aria-label="Ko može da se prijavi">
        <div class="v4e-about-inner v4e-about-center">
            <div class="v4e-about-copy" style="max-width: 980px;">
                <h3>Ko sve može da se prijavi?</h3>
                <p>Svi! Za naše radionice vam ne treba iskustvo!</p>
                <p>
                    Teme su posebno probrane i prilagođene tako da ih mogu naslikati i oni "koji ne znaju da naslikaju
                    ni čiča glišu" i čak i oni "koji nisu slikali od osnovne škole".
                </p>
                <p>
                    Dobrodošli ste svi - i ako nemate slikarskog iskustva, i ako ste amater, pogotovo ako ste ljubitelji
                    vina, ali takođe i ako ste slikarski talenat koji želi da se zabavi na nešto drugačiji način.
                </p>
                <p>Glavni cilj naših radionica je razonoda, a ne umijeće. Probajte i vi!</p>
            </div>

            <div class="v4e-about-row" style="width:100%;">
                <div class="v4e-about-card"><img src="http://paintandwine.local/wp-content/uploads/2026/06/placeholder-1.webp" alt="Prijava 1" /></div>
                <div class="v4e-about-card"><img src="http://paintandwine.local/wp-content/uploads/2026/06/placeholder-1.webp" alt="Prijava 2" /></div>
                <div class="v4e-about-card"><img src="http://paintandwine.local/wp-content/uploads/2026/06/placeholder-1.webp" alt="Prijava 3" /></div>
                <div class="v4e-about-card"><img src="http://paintandwine.local/wp-content/uploads/2026/06/placeholder-1.webp" alt="Prijava 4" /></div>
            </div>
        </div>
    </section>

    <section class="v4e-about-panel" aria-label="Paint and Kids">
        <div class="v4e-about-inner">
            <div class="v4e-about-split">
                <div class="v4e-about-tall">
                    <img src="http://paintandwine.local/wp-content/uploads/2026/06/placeholder-1.webp" alt="Paint and KIDS Podgorica" />
                </div>

                <div class="v4e-about-copy">
                    <h3>Šta je Paint and KIDS Podgorica?</h3>
                    <p>
                        Kako su Paint and Wine radionice namijenjene licima iznad 18 godina, za naše najmlađe smo
                        kreirali
                        <strong>Paint and Kids</strong> - radionice za djecu i roditelje. Cilj ovih radionica jeste da
                        pruže roditeljima prostor u kojem mogu provesti 90 minuta kreativnog vremena sa svojim
                        mališanima,
                        dublje se povezati sa njima i pružiti im nezaboravne uspomene. Ako ste roditelj, ovo je prilika
                        koju ne smijete propustiti!
                    </p>
                </div>
            </div>
        </div>
    </section>

    <section class="v4e-about-panel" aria-label="Neon Paint and Cocktails">
        <div class="v4e-about-inner">
            <div class="v4e-about-trio">
                <div class="v4e-about-side">
                    <img src="http://paintandwine.local/wp-content/uploads/2026/06/placeholder-1.webp" alt="Neon Paint and Cocktails 1" />
                </div>

                <div class="v4e-about-copy v4e-about-center">
                    <h3>Šta je Neon Paint and Cocktails?</h3>
                    <p>
                        Našim posjetiocima nudimo i mogućnost iskustva slikanja u mraku -
                        <strong>Neon Paint and Cocktails</strong>. Na ovoj radionici slikamo fluorescentnim bojama pod
                        UV reflektorima i uz dobru muziku. Ukoliko volite nesvakidašnja iskustva i veselu atmosferu,
                        Neon je prava radionica za vas!
                    </p>
                </div>

                <div class="v4e-about-side">
                    <img src="http://paintandwine.local/wp-content/uploads/2026/06/placeholder-1.webp" alt="Neon Paint and Cocktails 2" />
                </div>
            </div>

            <p class="v4e-about-ending" style="color:#bf2020;">Ne brinite, to nije sve! Spremamo još puno noviteta. Ostanite uz nas i saznajte!
            </p>
        </div>
    </section>

    <section class="v4e-about-panel" aria-label="FAQ">
        <div class="v4e-about-inner">
            <div>
                <h2 class="v4e-about-faq-title" style="color:#111111;">FAQ</h2>
                <p class="v4e-about-faq-subtitle" style="color:#111111;">Paint and Wine</p>
            </div>

            <div class="v4e-about-faq">
                <div class="v4e-about-faq-item">
                    <div class="v4e-about-number">1.</div>
                    <div>
                        <strong>Gdje se nalazite?</strong>
                        <p>Naš atelje se nalazi u Zagoriču, Ulica Piperska 27.</p>
                    </div>
                </div>

                <div class="v4e-about-faq-item">
                    <div class="v4e-about-number">2.</div>
                    <div>
                        <strong>Ima li opcije za nekoga ko ne pije vino?</strong>
                        <p>Ukoliko ne pijete alkohol, možete probati bezalkoholno vino koje imamo u ponudi ili nam
                            najaviti da niste fan, a mi ćemo za vas obezbijediti neki sok.</p>
                    </div>
                </div>

                <div class="v4e-about-faq-item">
                    <div class="v4e-about-number">3.</div>
                    <div>
                        <strong>Koliko ljudi može doći na radionicu?</strong>
                        <p>Na radionicu možete doći sami ili u broju u kojem poželite. Kapacitet ateljea je 28 osoba,
                            ali za radionice vani zna da ide i preko 100.</p>
                    </div>
                </div>

                <div class="v4e-about-faq-item">
                    <div class="v4e-about-number">4.</div>
                    <div>
                        <strong>Koliko traje radionica?</strong>
                        <p>Radionica traje oko 2 sata i 15 minuta</p>
                    </div>
                </div>

                <div class="v4e-about-faq-item">
                    <div class="v4e-about-number">5.</div>
                    <div>
                        <strong>Mogu li da povedem svoje dijete sa sobom?</strong>
                        <p>Najmlađa lica koja mogu prisustvovati P&amp;W radionicama moraju imati minimalno 14 godina.
                            Za sve mlađe imamo Paint and Kids.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
[paint_wine_footer]

<script>
    (function () {
        const root = document.currentScript.previousElementSibling;
        if (!root || !root.classList.contains("v4e-about")) return;

        const hero = root.querySelector(".v4e-about-hero");
        if (!hero) return;

        const slides = Array.from(hero.querySelectorAll(".v4e-about-slide"));
        const autoplayDelay = 5200;
        let activeIndex = 0;
        let autoplayId;

        function setSlide(index) {
            activeIndex = (index + slides.length) % slides.length;
            slides.forEach((slide, slideIndex) => {
                slide.classList.toggle("is-active", slideIndex === activeIndex);
            });
        }

        function restartAutoplay() {
            window.clearInterval(autoplayId);
            autoplayId = window.setInterval(() => {
                setSlide(activeIndex + 1);
            }, autoplayDelay);
        }

        window.requestAnimationFrame(() => {
            setSlide(0);
            restartAutoplay();
        });
    })();
</script>
