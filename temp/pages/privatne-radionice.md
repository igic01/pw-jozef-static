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
    @font-face {
        font-family: 'Archivo Black';
        src: url('/wp-content/themes/twentytwentyfive/assets/fonts/myFonts/ArchivoBlack-Regular.ttf') format('truetype');
    }

    @font-face {
        font-family: 'Open Sans Local';
        src: url('/wp-content/themes/twentytwentyfive/assets/fonts/myFonts/open-sans.regular%20%281%29.ttf') format('truetype');
    }

    .v4p-page {
        --v4p-red: #bf2020;
        --v4p-paper: #f7f3ec;
        --v4p-ink: #111111;
        --v4p-border: rgba(0, 0, 0, 0.14);
        --v4p-soft: rgba(255, 255, 255, 0.68);
        --v4p-blue: #d8e2ee;
        width: 100%;
        background: #080808;
        font-family: "Open Sans Local", Arial, sans-serif;
    }

    .v4p-page,
    .v4p-page * {
        box-sizing: border-box;
    }

    .v4p-frame {
        position: relative;
        width: 100%;
        background: var(--v4p-paper);
        color: var(--v4p-ink);
        border: 1px solid rgba(0, 0, 0, 0.12);
        overflow: hidden;
    }

    .v4p-frame::before {
        content: "";
        position: absolute;
        inset: 20px;
        border: 1px solid var(--v4p-border);
        pointer-events: none;
    }

    .v4p-frame::after {
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

    .v4p-inner {
        position: relative;
        z-index: 1;
        width: min(1440px, calc(100% - 40px));
        margin: 0 auto;
        padding: clamp(40px, 6vw, 76px) clamp(20px, 5vw, 48px);
    }

    .v4p-title,
    .v4p-heading,
    .v4p-card h3,
    .v4p-modal-body h3,
    .v4p-form-copy h2 {
        margin: 0;
        color: var(--v4p-red);
        font-family: "Archivo Black", Arial, sans-serif;
        font-weight: 400;
        text-transform: uppercase;
        letter-spacing: 0;
        text-align: center;
    }

    .v4p-hero {
        position: relative;
        width: 100%;
        min-height: min(100vh, 920px);
        overflow: hidden;
        border: 1px solid rgba(255, 255, 255, 0.14);
        box-shadow: 0 28px 80px rgba(0, 0, 0, 0.42);
        isolation: isolate;
    }

    .v4p-hero::before {
        content: "";
        position: absolute;
        inset: 20px;
        border: 1px solid rgba(243, 235, 223, 0.18);
        pointer-events: none;
        z-index: 4;
    }

    .v4p-hero::after {
        content: "";
        position: absolute;
        inset: 0;
        background:
            radial-gradient(circle at 12% 18%, rgba(191, 32, 32, 0.2), transparent 18%),
            linear-gradient(180deg, rgba(0, 0, 0, 0.1), rgba(0, 0, 0, 0.74)),
            linear-gradient(130deg, rgba(191, 32, 32, 0.14), transparent 34%);
        pointer-events: none;
        z-index: 1;
    }

    .v4p-hero-media,
    .v4p-hero-media img {
        position: absolute;
        inset: 0;
        width: 100%;
        height: 100%;
    }

    .v4p-hero-media img {
        object-fit: cover;
        filter: saturate(1.02) contrast(1.02) brightness(0.72);
        transform: scale(1.04);
    }

    .v4p-hero-content {
        position: relative;
        z-index: 2;
        display: grid;
        align-items: center;
        justify-items: center;
        min-height: min(100vh, 920px);
        padding: clamp(30px, 5vw, 62px);
        text-align: center;
    }

    .v4p-hero-shell {
        width: fit-content;
        max-width: min(980px, calc(100% - 32px));
        margin: 0 auto;
        padding: clamp(24px, 3vw, 36px);
        background:
            linear-gradient(180deg, rgba(255, 255, 255, 0.06), rgba(255, 255, 255, 0.015)),
            rgba(9, 7, 7, 0.48);
        border: 1px solid rgba(243, 235, 223, 0.16);
        backdrop-filter: blur(9px);
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.25);
    }

    .v4p-eyebrow {
        margin: 0 0 16px;
        color: rgba(243, 235, 223, 0.84);
        font-size: 0.78rem;
        font-weight: 700;
        letter-spacing: 0.28em;
        text-transform: uppercase;
    }

    .v4p-title {
        color: #f3ebdf;
        max-width: 11ch;
        margin-inline: auto;
        font-size: clamp(3rem, 6.4vw, 6.7rem);
        line-height: 0.9;
        overflow-wrap: normal;
        text-wrap: balance;
    }

    .v4p-title .v4p-accent {
        color: #ffffff;
    }

    .v4p-lead {
        margin: 18px 0 0;
        max-width: 38ch;
        margin-left: auto;
        margin-right: auto;
        color: rgba(255, 255, 255, 0.82);
        font-size: clamp(1rem, 1.45vw, 1.08rem);
        line-height: 1.82;
        text-align: center;
    }

    .v4p-heading {
        font-size: clamp(2.4rem, 5vw, 4.8rem);
        line-height: 0.94;
    }

    .v4p-intro {
        max-width: 72ch;
        margin: 14px auto 0;
        font-size: clamp(1rem, 1.3vw, 1.08rem);
        line-height: 1.72;
        text-align: center;
    }

    .v4p-types-grid {
        display: grid;
        grid-template-columns: repeat(4, minmax(0, 1fr));
        gap: 18px;
        margin-top: 34px;
    }

    .v4p-card {
        display: grid;
        grid-template-rows: auto 1fr;
        background: var(--v4p-soft);
        border: 1px solid var(--v4p-border);
        box-shadow: 0 18px 38px rgba(0, 0, 0, 0.08);
        overflow: hidden;
    }

    .v4p-card-media {
        position: relative;
        aspect-ratio: 4 / 5;
        background: var(--v4p-blue);
        overflow: hidden;
    }

    .v4p-card-media img,
    .v4p-gallery-card img,
    .v4p-modal-media img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .v4p-card-media img,
    .v4p-gallery-card img {
        filter: saturate(0.96) contrast(1.02);
        transition: transform 0.45s ease;
    }

    .v4p-card:hover .v4p-card-media img,
    .v4p-gallery-card:hover img {
        transform: scale(1.04);
    }

    .v4p-card-body {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 12px;
        padding: 18px 16px 20px;
        text-align: center;
    }

    .v4p-card-body .v4p-button {
        margin: auto auto 0;
    }

    .v4p-card h3 {
        font-size: clamp(1.45rem, 2.2vw, 2rem);
        line-height: 0.98;
    }

    .v4p-card p,
    .v4p-modal-body p,
    .v4p-modal-body li,
    .v4p-form-note {
        margin: 0;
        color: #1a1a1a;
        font-size: 0.96rem;
        line-height: 1.68;
    }

    .v4p-card p {
        text-align: center;
    }

    .v4p-button,
    .v4p-form button {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: fit-content;
        min-height: 46px;
        padding: 0 18px;
        color: #f7f3ec;
        background: var(--v4p-red);
        border: 1px solid var(--v4p-red);
        border-radius: 0;
        text-decoration: none;
        font-size: 0.88rem;
        font-weight: 700;
        letter-spacing: 0.08em;
        text-transform: uppercase;
        cursor: pointer;
        transition: background-color 0.3s ease, color 0.3s ease, transform 0.3s ease;
    }

    .v4p-button:hover,
    .v4p-form button:hover {
        background: transparent;
        color: var(--v4p-red);
        transform: translateY(-1px);
    }

    .v4p-page .v4p-button:focus,
    .v4p-page .v4p-button:active,
    .v4p-page .v4p-form button:focus,
    .v4p-page .v4p-form button:active,
    .v4p-page .v4p-modal-close:focus,
    .v4p-page .v4p-modal-close:active {
        color: #f7f3ec !important;
        background: var(--v4p-red) !important;
        border-color: var(--v4p-red) !important;
        box-shadow: none !important;
        outline: 2px solid rgba(191, 32, 32, 0.28);
        outline-offset: 2px;
    }

    .v4p-gallery-grid {
        display: grid;
        grid-template-columns: repeat(4, minmax(0, 1fr));
        gap: 18px;
        margin-top: 30px;
    }

    .v4p-gallery-card {
        position: relative;
        aspect-ratio: 1 / 1;
        overflow: hidden;
        border: 1px solid var(--v4p-border);
        background: var(--v4p-blue);
        box-shadow: 0 18px 38px rgba(0, 0, 0, 0.08);
    }

    .v4p-form-copy h2 {
        max-width: 13ch;
        margin-inline: auto;
        font-size: clamp(2rem, 3.6vw, 3.7rem);
        line-height: 1;
        overflow-wrap: break-word;
        word-break: normal;
    }

    .v4p-form-grid {
        display: grid;
        gap: 14px;
    }

    .v4p-field {
        display: grid;
        gap: 8px;
    }

    .v4p-field label,
    .v4p-form-copy p,
    .v4p-form-subtitle {
        font-size: 0.85rem;
        font-weight: 700;
        letter-spacing: 0.08em;
        text-transform: uppercase;
    }

    .v4p-field input,
    .v4p-field select,
    .v4p-field textarea {
        width: 100%;
        padding: 14px 16px;
        color: var(--v4p-ink);
        background: rgba(255, 255, 255, 0.72);
        border: 1px solid rgba(0, 0, 0, 0.2);
        border-radius: 0;
        font: inherit;
    }

    .v4p-field textarea {
        min-height: 132px;
        resize: vertical;
    }

    .v4p-form-layout {
        display: grid;
        grid-template-columns: minmax(340px, 0.82fr) minmax(0, 1.18fr);
        gap: clamp(28px, 4vw, 56px);
        align-items: start;
    }

    .v4p-form-copy {
        display: grid;
        justify-items: center;
        gap: 14px;
        min-width: 0;
        position: sticky;
        top: 24px;
        text-align: center;
    }

    .v4p-form-copy > * {
        min-width: 0;
        max-width: 100%;
    }

    .v4p-form-note {
        max-width: 46ch;
        margin-inline: auto;
        text-align: center;
    }

    .v4p-form-grid {
        grid-template-columns: repeat(2, minmax(0, 1fr));
    }

    .v4p-field.is-wide {
        grid-column: 1 / -1;
    }

    .v4p-modal {
        position: fixed;
        inset: 0;
        z-index: 999;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 24px;
        opacity: 0;
        visibility: hidden;
        pointer-events: none;
        transition: opacity 0.25s ease, visibility 0.25s ease;
    }

    .v4p-modal.is-open {
        opacity: 1;
        visibility: visible;
        pointer-events: auto;
    }

    .v4p-modal-backdrop {
        position: absolute;
        inset: 0;
        background: rgba(8, 8, 8, 0.68);
    }

    .v4p-modal-dialog {
        position: relative;
        z-index: 1;
        width: min(980px, 100%);
        max-height: min(88vh, 920px);
        overflow: auto;
        background: var(--v4p-paper);
        border: 1px solid rgba(0, 0, 0, 0.16);
        box-shadow: 0 32px 80px rgba(0, 0, 0, 0.34);
    }

    .v4p-modal-dialog::before {
        content: "";
        position: absolute;
        inset: 20px;
        border: 1px solid var(--v4p-border);
        pointer-events: none;
    }

    .v4p-modal-content {
        position: relative;
        z-index: 1;
        display: grid;
        grid-template-columns: minmax(260px, 0.82fr) minmax(0, 1.18fr);
        gap: 26px;
        padding: clamp(26px, 4vw, 40px);
    }

    .v4p-modal-media {
        aspect-ratio: 4 / 5;
        background: var(--v4p-blue);
        border: 1px solid var(--v4p-border);
        overflow: hidden;
    }

    .v4p-modal-body {
        display: grid;
        align-content: start;
        gap: 14px;
        padding-right: 24px;
    }

    .v4p-modal-body h3 {
        font-size: clamp(2rem, 4vw, 3.4rem);
        line-height: 0.94;
    }

    .v4p-modal-body ul {
        margin: 0;
        padding-left: 18px;
    }

    .v4p-modal-close {
        position: absolute;
        top: 16px;
        right: 16px;
        z-index: 2;
        width: 46px;
        height: 46px;
        color: #f7f3ec;
        background: var(--v4p-red);
        border: 1px solid var(--v4p-red);
        font-size: 1.3rem;
        cursor: pointer;
    }

    .v4p-modal-close:hover {
        background: transparent;
        color: var(--v4p-red);
    }

    .v4p-hidden-detail {
        display: none;
    }

    @media (max-width: 1100px) {
        .v4p-types-grid,
        .v4p-gallery-grid {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }

        .v4p-form-layout,
        .v4p-modal-content {
            grid-template-columns: 1fr;
        }

        .v4p-form-copy {
            position: static;
        }
    }

    @media (max-width: 720px) {
        .v4p-hero::before,
        .v4p-frame::before,
        .v4p-modal-dialog::before {
            inset: 12px;
        }

        .v4p-inner {
            width: min(100%, calc(100% - 24px));
            padding: 28px 18px;
        }

        .v4p-hero-content {
            min-height: auto;
            padding: 18px 18px 34px;
            align-items: center;
        }

        .v4p-hero-shell {
            width: 100%;
            max-width: 100%;
            padding: 20px 18px;
        }

        .v4p-title {
            max-width: 100%;
            font-size: clamp(2.4rem, 14vw, 4.2rem);
        }

        .v4p-form-grid,
        .v4p-types-grid,
        .v4p-gallery-grid {
            grid-template-columns: 1fr;
        }

        .v4p-modal {
            padding: 12px;
        }

        .v4p-modal-content {
            gap: 18px;
            padding: 20px 16px 24px;
        }

        .v4p-modal-body {
            padding-right: 0;
        }
    }
</style>

<div class="v4p-page">
    <section class="v4p-hero" aria-label="Privatne radionice hero">
        <div class="v4p-hero-media">
            <img src="http://paintandwine.local/wp-content/uploads/2026/06/placeholder-1.webp"
                alt="Privatna Paint and Wine radionica" />
        </div>

        <div class="v4p-hero-content">
            <div class="v4p-hero-shell">
                <p class="v4p-eyebrow">Privatne Radionice</p>
                <h1 class="v4p-title">Zakažite <span class="v4p-accent">Privatnu</span> Radionicu!</h1>
                <p class="v4p-lead">
                    Bilo da ste HR u firmi kojem treba nova zanimacija za zaposlene, kuma koja organizuje
                    djevojačko veče, turistička organizacija koja želi da impresionira goste, ili slično,
                    mi smo tu za vas!
                </p>
                <p class="v4p-lead">
                    Radionicu možete zakazati u našem ateljeu, ali i bilo gdje u Crnoj Gori, mi dolazimo
                    na lokaciju.
                </p>
            </div>
        </div>
    </section>

    <section class="v4p-frame" aria-labelledby="v4p-types-title">
        <div class="v4p-inner">
            <h2 class="v4p-heading" id="v4p-types-title">Vrste Radionica</h2>
            <p class="v4p-intro">
                Birajte format koji najbolje odgovara vašem događaju. Svaka radionica može da se organizuje
                u našem ateljeu ili na lokaciji koju vi odaberete.
            </p>

            <div class="v4p-types-grid">
                <article class="v4p-card">
                    <div class="v4p-card-media">
                        <img src="http://paintandwine.local/wp-content/uploads/2026/06/placeholder-1.webp"
                            alt="Klasična Paint and Wine radionica" />
                    </div>
                    <div class="v4p-card-body">
                        <h3>Klasična P&amp;W</h3>
                        <p>Korak po korak do savršene slike uz vino, opuštenu atmosferu i vođenje instruktorke.</p>
                        <button class="v4p-button" type="button" data-v4p-open="classic">Saznaj više</button>
                    </div>
                </article>

                <article class="v4p-card">
                    <div class="v4p-card-media">
                        <img src="http://paintandwine.local/wp-content/uploads/2026/06/placeholder-1.webp"
                            alt="Neon Paint and Cocktails radionica" />
                    </div>
                    <div class="v4p-card-body">
                        <h3>Neon P&amp;C</h3>
                        <p>Večernji format sa UV bojama, koktel atmosferom i dinamičnim vizuelnim efektom.</p>
                        <button class="v4p-button" type="button" data-v4p-open="neon">Saznaj više</button>
                    </div>
                </article>

                <article class="v4p-card">
                    <div class="v4p-card-media">
                        <img src="http://paintandwine.local/wp-content/uploads/2026/06/placeholder-1.webp"
                            alt="Paint and Kids radionica" />
                    </div>
                    <div class="v4p-card-body">
                        <h3>Paint &amp; Kids</h3>
                        <p>Kreativan format za rođendane, porodična okupljanja i razigrane privatne proslave.</p>
                        <button class="v4p-button" type="button" data-v4p-open="kids">Saznaj više</button>
                    </div>
                </article>

                <article class="v4p-card">
                    <div class="v4p-card-media">
                        <img src="http://paintandwine.local/wp-content/uploads/2026/06/placeholder-1.webp"
                            alt="Radionica po mjeri" />
                    </div>
                    <div class="v4p-card-body">
                        <h3>Radionica Po Mjeri</h3>
                        <p>Temu, trajanje i atmosferu prilagođavamo vašem timu, gostima i lokaciji događaja.</p>
                        <button class="v4p-button" type="button" data-v4p-open="custom">Saznaj više</button>
                    </div>
                </article>
            </div>
        </div>
    </section>

    <section class="v4p-frame" aria-labelledby="v4p-gallery-title">
        <div class="v4p-inner">
            <h2 class="v4p-heading" id="v4p-gallery-title">Galerija</h2>

            <div class="v4p-gallery-grid">
                <figure class="v4p-gallery-card">
                    <img src="http://paintandwine.local/wp-content/uploads/2026/06/placeholder-1.webp"
                        alt="Galerija privatne radionice jedan" />
                </figure>
                <figure class="v4p-gallery-card">
                    <img src="http://paintandwine.local/wp-content/uploads/2026/06/placeholder-1.webp"
                        alt="Galerija privatne radionice dva" />
                </figure>
                <figure class="v4p-gallery-card">
                    <img src="http://paintandwine.local/wp-content/uploads/2026/06/placeholder-1.webp"
                        alt="Galerija privatne radionice tri" />
                </figure>
                <figure class="v4p-gallery-card">
                    <img src="http://paintandwine.local/wp-content/uploads/2026/06/placeholder-1.webp"
                        alt="Galerija privatne radionice četiri" />
                </figure>
                <figure class="v4p-gallery-card">
                    <img src="http://paintandwine.local/wp-content/uploads/2026/06/placeholder-1.webp"
                        alt="Galerija privatne radionice pet" />
                </figure>
                <figure class="v4p-gallery-card">
                    <img src="http://paintandwine.local/wp-content/uploads/2026/06/placeholder-1.webp"
                        alt="Galerija privatne radionice šest" />
                </figure>
                <figure class="v4p-gallery-card">
                    <img src="http://paintandwine.local/wp-content/uploads/2026/06/placeholder-1.webp"
                        alt="Galerija privatne radionice sedam" />
                </figure>
                <figure class="v4p-gallery-card">
                    <img src="http://paintandwine.local/wp-content/uploads/2026/06/placeholder-1.webp"
                        alt="Galerija privatne radionice osam" />
                </figure>
            </div>
        </div>
    </section>

    <section class="v4p-frame" aria-labelledby="v4p-form-title">
        <div class="v4p-inner">
            <div class="v4p-form-layout">
                <div class="v4p-form-copy">
                    <h2 id="v4p-form-title">Formular sa osnovnim informacijama za rezervisanje</h2>
                    <p class="v4p-form-note">
                        Pošaljite nam osnovne informacije o događaju i javićemo vam se sa prijedlogom
                        termina, ponudom i svim narednim koracima.
                    </p>
                </div>

                [forminator_form id="161"]
            </div>
        </div>
    </section>

    <div class="v4p-hidden-detail">
        <article data-v4p-detail="classic">
            <div class="v4p-modal-media">
                <img src="http://paintandwine.local/wp-content/uploads/2026/06/placeholder-1.webp"
                    alt="Klasična Paint and Wine radionica" />
            </div>
            <div class="v4p-modal-body">
                <h3>Klasična Paint and Wine Radionica</h3>
                <p>
                    Kod nas u ateljeu, ili na lokaciji koju vi odaberete, zakažite radionicu na kojoj će se
                    svi učesnici zajedno opustiti, smijati i kvalitetno provesti vrijeme. Učesnici će slikati
                    unaprijed odabranu temu, korak po korak sa instruktorkom, dok uživaju u vrhunskim vinima
                    i druženju.
                </p>
                <p>
                    Emocije učesnika na kraju radionice su neprocjenjive, a najbolje od svega je što rad
                    ostaje kao suvenir.
                </p>
                <p><strong>Preporuka za:</strong> kolektive, veće turističke grupe, MICE grupe i događaje na kojima želite uspomenu koja ostaje.</p>
            </div>
        </article>

        <article data-v4p-detail="neon">
            <div class="v4p-modal-media">
                <img src="http://paintandwine.local/wp-content/uploads/2026/06/placeholder-1.webp"
                    alt="Neon Paint and Cocktails radionica" />
            </div>
            <div class="v4p-modal-body">
                <h3>Neon Paint &amp; Cocktails</h3>
                <p>
                    Ovaj format donosi intenzivnije boje, UV svjetlo i energiju večernjeg izlaska, ali i dalje
                    zadržava jednostavan korak-po-korak pristup zbog kojeg svi mogu da učestvuju.
                </p>
                <p>
                    Idealan je kada želite malo jaču atmosferu, zabavniji ritam i vizuelno upečatljiv sadržaj
                    za privatni event ili poseban izlazak.
                </p>
                <p><strong>Preporuka za:</strong> djevojačke večeri, večernje evente, mlađe grupe i brend aktivacije.</p>
            </div>
        </article>

        <article data-v4p-detail="kids">
            <div class="v4p-modal-media">
                <img src="http://paintandwine.local/wp-content/uploads/2026/06/placeholder-1.webp"
                    alt="Paint and Kids radionica" />
            </div>
            <div class="v4p-modal-body">
                <h3>Paint &amp; Kids</h3>
                <p>
                    Lagani i razigrani format u kojem je fokus na druženju, kreativnosti i iskustvu koje je
                    prilagođeno mlađim učesnicima i porodičnim grupama.
                </p>
                <p>
                    Tempo radionice, izbor motiva i trajanje mogu se prilagoditi uzrastu i tipu proslave kako
                    bi događaj ostao opušten i jednostavan za organizaciju.
                </p>
                <p><strong>Preporuka za:</strong> rođendane, porodične proslave i privatna okupljanja sa djecom.</p>
            </div>
        </article>

        <article data-v4p-detail="custom">
            <div class="v4p-modal-media">
                <img src="http://paintandwine.local/wp-content/uploads/2026/06/placeholder-1.webp"
                    alt="Radionica po mjeri" />
            </div>
            <div class="v4p-modal-body">
                <h3>Radionica Po Mjeri</h3>
                <p>
                    Kada imate specifičan koncept, temu, broj gostiju ili lokaciju, osmišljavamo privatnu
                    radionicu koja odgovara baš tom događaju.
                </p>
                <p>
                    Zajedno definišemo format, trajanje, vrstu pića, nivo vođenja i sve detalje kako bi
                    sadržaj bio usklađen sa vašim gostima i ciljem događaja.
                </p>
                <p><strong>Preporuka za:</strong> kompanije, turističke grupe, hotele, agencije i posebne privatne proslave.</p>
            </div>
        </article>
    </div>

    <div class="v4p-modal" id="v4p-modal" aria-hidden="true">
        <div class="v4p-modal-backdrop" data-v4p-close></div>
        <div class="v4p-modal-dialog" role="dialog" aria-modal="true" aria-labelledby="v4p-modal-title">
            <button class="v4p-modal-close" type="button" aria-label="Zatvori prozor" data-v4p-close>&times;</button>
            <div class="v4p-modal-content" id="v4p-modal-content"></div>
        </div>
    </div>
</div>

<script>
    (function () {
        const root = document.currentScript.previousElementSibling;
        if (!root) return;

        const modal = root.querySelector("#v4p-modal");
        const modalContent = root.querySelector("#v4p-modal-content");
        const openButtons = root.querySelectorAll("[data-v4p-open]");
        const closeButtons = root.querySelectorAll("[data-v4p-close]");
        const details = root.querySelector(".v4p-hidden-detail");
        let lastTrigger = null;
        let previousBodyOverflow = "";
        let previousBodyPaddingRight = "";

        function openModal(key, trigger) {
            const detail = details.querySelector(`[data-v4p-detail="${key}"]`);
            if (!detail) return;

            const scrollbarWidth = window.innerWidth - document.documentElement.clientWidth;
            const bodyPaddingRight = parseFloat(window.getComputedStyle(document.body).paddingRight) || 0;

            modalContent.innerHTML = detail.innerHTML;
            const title = modalContent.querySelector("h3");
            if (title) title.id = "v4p-modal-title";
            previousBodyOverflow = document.body.style.overflow;
            previousBodyPaddingRight = document.body.style.paddingRight;
            modal.classList.add("is-open");
            modal.setAttribute("aria-hidden", "false");
            document.body.style.overflow = "hidden";
            if (scrollbarWidth > 0) {
                document.body.style.paddingRight = `${bodyPaddingRight + scrollbarWidth}px`;
            }
            lastTrigger = trigger || null;
        }

        function closeModal() {
            modal.classList.remove("is-open");
            modal.setAttribute("aria-hidden", "true");
            modalContent.innerHTML = "";
            document.body.style.overflow = previousBodyOverflow;
            document.body.style.paddingRight = previousBodyPaddingRight;
            if (lastTrigger) lastTrigger.focus();
        }

        openButtons.forEach((button) => {
            button.addEventListener("click", () => openModal(button.dataset.v4pOpen, button));
        });

        closeButtons.forEach((button) => {
            button.addEventListener("click", closeModal);
        });

        document.addEventListener("keydown", (event) => {
            if (event.key === "Escape" && modal.classList.contains("is-open")) {
                closeModal();
            }
        });
    })();
</script>
[paint_wine_footer]