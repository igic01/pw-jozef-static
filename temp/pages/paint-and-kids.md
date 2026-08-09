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
    html,
    body {
        margin: 0;
        padding: 0;
    }

    .pc2-page,
    .pc2-page * {
        box-sizing: border-box;
    }

    .pc2-page {
        --paper: #f7f1e8;
        --paper-2: #fcf8f3;
        --ink: #171523;
        --text: #534e62;
        --muted: #82798c;
        --line: rgba(23, 21, 35, 0.12);
        --red: #bf2020;
        --orange: #ff8b5e;
        --pink: #ef6686;
        --blue: #527dff;
        --gold: #e3b85c;
        --teal: #3ab6a3;
        --shadow: 0 24px 64px rgba(47, 33, 45, 0.14);
        position: relative;
        overflow: hidden;
        background:
            radial-gradient(circle at 12% 10%, rgba(255, 139, 94, 0.16), transparent 24%),
            radial-gradient(circle at 88% 16%, rgba(82, 125, 255, 0.14), transparent 24%),
            radial-gradient(circle at 18% 62%, rgba(239, 102, 134, 0.12), transparent 22%),
            radial-gradient(circle at 78% 88%, rgba(58, 182, 163, 0.12), transparent 28%),
            linear-gradient(180deg, #fbf7f2 0%, #f7f1e8 44%, #f3eadf 100%);
        color: var(--text);
        font-family: "Open Sans Local", Arial, sans-serif;
    }

    .pc2-page::before {
        content: "";
        position: absolute;
        inset: 0;
        background:
            linear-gradient(90deg, rgba(0, 0, 0, 0.03) 0, rgba(0, 0, 0, 0.03) 1px, transparent 1px, transparent 120px);
        opacity: 0.4;
        pointer-events: none;
    }

    .pc2-section {
        position: relative;
        z-index: 1;
        padding: 14px;
        background: transparent;
    }

    .pc2-shell {
        width: min(1200px, 100%);
        margin: 0 auto;
    }

    .pc2-hero {
        position: relative;
        width: 100%;
        min-height: 100vh;
        overflow: hidden;
        border: 0;
        box-shadow: none;
        isolation: isolate;
        background: transparent;
    }

    .pc2-hero::before {
        content: "";
        position: absolute;
        inset: 12px;
        border: 1px solid rgba(243, 235, 223, 0.18);
        pointer-events: none;
        z-index: 5;
    }

    .pc2-stage,
    .pc2-slide,
    .pc2-media {
        position: absolute;
        inset: 0;
    }

    .pc2-slide {
        opacity: 0;
        transition: opacity 0.9s ease;
    }

    .pc2-slide.is-active {
        opacity: 1;
    }

    .pc2-media {
        overflow: hidden;
    }

    .pc2-media img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        filter: saturate(1.03) contrast(1.02) brightness(0.88);
        transform: scale(1.06);
        transition: transform 6.5s ease;
    }

    .pc2-slide.is-active .pc2-media img {
        transform: scale(1);
    }

    .pc2-media::before {
        content: "";
        position: absolute;
        inset: 0;
        background:
            linear-gradient(180deg, rgba(0, 0, 0, 0.1), rgba(0, 0, 0, 0.75)),
            linear-gradient(125deg, rgba(191, 32, 32, 0.22), transparent 36%),
            radial-gradient(circle at 80% 22%, rgba(255, 139, 94, 0.16), transparent 16%);
        z-index: 1;
    }

    .pc2-media::after {
        content: "";
        position: absolute;
        inset: 0;
        background:
            repeating-linear-gradient(90deg,
                rgba(255, 255, 255, 0.025) 0,
                rgba(255, 255, 255, 0.025) 1px,
                transparent 1px,
                transparent 24px);
        opacity: 0.42;
        z-index: 1;
    }

    .pc2-hero-content {
        position: relative;
        z-index: 3;
        min-height: 100vh;
        display: grid;
        place-items: center;
        padding: 18px 18px 102px;
        text-align: center;
    }

    .pc2-hero-card {
        width: min(780px, 100%);
        padding: 20px 18px;
        background:
            linear-gradient(180deg, rgba(255, 255, 255, 0.08), rgba(255, 255, 255, 0.02)),
            rgba(10, 8, 10, 0.46);
        border: 1px solid rgba(243, 235, 223, 0.18);
        backdrop-filter: blur(10px);
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.24);
        display: grid;
        justify-items: center;
        margin: 0 auto;
        text-align: center;
    }

    .pc2-kicker,
    .pc2-badge {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        width: fit-content;
        padding: 10px 16px;
        border-radius: 999px;
        font-size: 0.78rem;
        font-weight: 700;
        letter-spacing: 0.16em;
        text-transform: uppercase;
    }

    .pc2-kicker {
        color: rgba(243, 235, 223, 0.88);
        background: rgba(255, 255, 255, 0.08);
    }

    .pc2-badge {
        color: var(--ink);
        background: rgba(255, 255, 255, 0.88);
    }

    .pc2-kicker::before,
    .pc2-badge::before {
        content: "";
        width: 26px;
        height: 10px;
        border-radius: 999px;
        background: linear-gradient(90deg, var(--red), var(--orange), var(--blue));
    }

    .pc2-title,
    .pc2-subtitle,
    .pc2-frame-title {
        margin: 0;
        font-family: "Archivo Black", Arial, sans-serif;
        font-weight: 700;
        line-height: 0.9;
        letter-spacing: 0;
        text-transform: uppercase;
        text-align: center;
    }

    .pc2-title {
        margin-top: 16px;
        color: #f3ebdf;
        font-size: clamp(3rem, 13vw, 6.8rem);
    }

    .pc2-title .accent {
        color: #ff9a72;
    }

    .pc2-subtitle {
        color: var(--red);
        font-size: clamp(2.3rem, 9vw, 4.4rem);
    }

    .pc2-frame-title {
        color: var(--ink);
        font-size: clamp(2.1rem, 8vw, 3.6rem);
    }

    .pc2-hero-text,
    .pc2-text,
    .pc2-list,
    .pc2-answer p,
    .pc2-note,
    .pc2-label {
        margin: 0;
        font-size: 0.98rem;
        line-height: 1.72;
    }

    .pc2-hero-text {
        margin-top: 16px;
        max-width: 36ch;
        color: rgba(255, 255, 255, 0.82);
        margin-left: auto;
        margin-right: auto;
    }

    .pc2-actions {
        display: grid;
        gap: 12px;
        justify-content: center;
        margin-top: 18px;
    }

    .pc2-button {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-height: 52px;
        width: 100%;
        padding: 0 22px;
        border-radius: 999px;
        text-decoration: none;
        font-weight: 700;
        transition: transform 0.25s ease, background-color 0.25s ease, box-shadow 0.25s ease;
    }

    .pc2-button:hover {
        transform: translateY(-2px);
    }

    .pc2-button.primary {
        color: #fff;
        background: linear-gradient(135deg, var(--red), var(--orange));
        box-shadow: 0 16px 28px rgba(191, 32, 32, 0.26);
    }

    .pc2-button.secondary {
        color: #f3ebdf;
        background: rgba(255, 255, 255, 0.08);
        border: 1px solid rgba(243, 235, 223, 0.16);
    }

    .pc2-ui {
        position: absolute;
        left: 18px;
        right: 18px;
        bottom: 18px;
        z-index: 5;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
        padding: 10px 12px;
        background: rgba(8, 8, 8, 0.42);
        border: 1px solid rgba(243, 235, 223, 0.16);
        backdrop-filter: blur(10px);
    }

    .pc2-nav,
    .pc2-dot {
        border: 0;
        cursor: pointer;
    }

    .pc2-nav {
        width: 42px;
        height: 42px;
        color: #fff;
        background: rgba(255, 255, 255, 0.08);
        font-size: 1rem;
    }

    .pc2-dots {
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .pc2-dot {
        width: 10px;
        height: 10px;
        padding: 0;
        border-radius: 999px;
        background: rgba(255, 255, 255, 0.4);
        transition: width 0.3s ease, background-color 0.3s ease;
    }

    .pc2-dot.is-active {
        width: 30px;
        background: var(--orange);
    }

    .pc2-grid,
    .pc2-footer,
    .pc2-voucher-layout {
        display: grid;
        gap: 18px;
        grid-template-columns: 1fr;
    }

    .pc2-frame,
    .pc2-faq,
    .pc2-poster,
    .pc2-stat {
        position: relative;
        border: 1px solid rgba(0, 0, 0, 0.12);
        box-shadow: var(--shadow);
    }

    .pc2-frame,
    .pc2-faq {
        background: rgba(255, 252, 247, 0.72);
        backdrop-filter: blur(12px);
        padding: 22px 18px;
    }

    .pc2-frame::before,
    .pc2-faq::before,
    .pc2-voucher::before {
        content: "";
        position: absolute;
        inset: 12px;
        border: 1px solid rgba(0, 0, 0, 0.08);
        pointer-events: none;
    }

    .pc2-frame > *,
    .pc2-faq > * {
        position: relative;
        z-index: 1;
    }

    .pc2-frame {
        display: grid;
        gap: 14px;
        justify-items: center;
        text-align: center;
    }

    .pc2-faq {
        display: grid;
        gap: 14px;
        overflow: hidden;
        background:
            linear-gradient(135deg, rgba(255, 255, 255, 0.82), rgba(247, 241, 232, 0.68)),
            rgba(255, 252, 247, 0.72);
        justify-items: center;
        text-align: center;
    }

    .pc2-faq .pc2-badge,
    .pc2-faq .pc2-subtitle {
        justify-self: center;
    }

    .pc2-note {
        color: var(--muted);
        max-width: 46ch;
        margin-left: auto;
        margin-right: auto;
    }

    .pc2-collage {
        display: grid;
        gap: 12px;
        grid-template-columns: repeat(2, minmax(0, 1fr));
    }

    .pc2-poster {
        margin: 0;
        overflow: hidden;
        background: #fff;
        aspect-ratio: 4 / 5;
    }

    .pc2-poster:nth-child(1) {
        transform: rotate(-3deg);
    }

    .pc2-poster:nth-child(2) {
        transform: rotate(3deg);
        margin-top: 24px;
    }

    .pc2-poster:nth-child(3) {
        transform: rotate(2deg);
    }

    .pc2-poster:nth-child(4) {
        transform: rotate(-2deg);
        margin-top: 18px;
    }

    .pc2-poster img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
    }

    .pc2-stats {
        display: grid;
        gap: 12px;
        grid-template-columns: 1fr;
    }

    .pc2-stat {
        padding: 18px 16px;
        background: rgba(255, 255, 255, 0.82);
        text-align: center;
    }

    .pc2-stat strong {
        display: block;
        color: var(--ink);
        font-size: 1.65rem;
        line-height: 1;
    }

    .pc2-stat span {
        display: block;
        margin-top: 7px;
        color: var(--muted);
        font-size: 0.9rem;
    }

    .pc2-list {
        padding-left: 18px;
        justify-self: stretch;
        text-align: left;
    }

    .pc2-list li + li {
        margin-top: 9px;
    }

    .pc2-voucher {
        position: relative;
        background: transparent;
        border: 1px solid rgba(0, 0, 0, 0.12);
        overflow: hidden;
    }

    .pc2-voucher::after {
        content: "";
        position: absolute;
        inset: 0;
        background:
            linear-gradient(90deg, rgba(0, 0, 0, 0.04) 0, rgba(0, 0, 0, 0.04) 1px, transparent 1px, transparent 120px);
        opacity: 0.32;
        pointer-events: none;
    }

    .pc2-voucher-inner {
        position: relative;
        z-index: 1;
        display: grid;
        gap: 24px;
        padding: 26px 18px 32px;
    }

    .pc2-voucher .pc2-frame {
        overflow: hidden;
    }

    .pc2-voucher .pc2-subtitle {
        max-width: 12ch;
        font-size: clamp(1.65rem, 4.6vw, 3rem);
        line-height: 1.05;
        overflow-wrap: anywhere;
    }

    .pc2-voucher .pc2-text {
        max-width: 48ch;
    }

    .pc2-voucher-card {
        margin: 0;
        padding: 12px;
        background: #fff;
        border: 1px solid rgba(0, 0, 0, 0.12);
        box-shadow: 0 16px 36px rgba(0, 0, 0, 0.12);
    }

    .pc2-voucher-card img {
        display: block;
        width: 100%;
        height: clamp(210px, 38vw, 360px);
        object-fit: cover;
    }

    .pc2-faq-list {
        display: grid;
        gap: 10px;
        margin-top: 6px;
    }

    .pc2-faq-item {
        position: relative;
        overflow: hidden;
        background: rgba(255, 255, 255, 0.72);
        border: 1px solid rgba(23, 21, 35, 0.12);
        box-shadow: 0 10px 24px rgba(47, 33, 45, 0.07);
        transition: border-color 0.24s ease, background-color 0.24s ease, box-shadow 0.24s ease;
    }

    .pc2-faq-item::before {
        content: "";
        position: absolute;
        inset: 0 auto 0 0;
        width: 4px;
        background: linear-gradient(180deg, var(--red), var(--orange));
        opacity: 0;
        transition: opacity 0.24s ease;
    }

    .pc2-faq-item.open {
        background: rgba(255, 252, 247, 0.96);
        border-color: rgba(191, 32, 32, 0.28);
        box-shadow: 0 18px 36px rgba(47, 33, 45, 0.12);
    }

    .pc2-faq-item.open::before {
        opacity: 1;
    }

    .pc2-question {
        width: 100%;
        min-height: 68px;
        padding: 18px 18px 18px 22px;
        border: 0;
        background: transparent;
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 16px;
        color: var(--ink);
        font: inherit;
        font-weight: 700;
        line-height: 1.32;
        text-align: left;
        cursor: pointer;
        transition: color 0.24s ease, background-color 0.24s ease;
    }



    .pc2-question:hover {
        color: var(--red);
        background: rgba(191, 32, 32, 0.035);
    }

    .pc2-question:active{
       background: transparent; 
    }

    .pc2-icon {
        width: 34px;
        height: 34px;
        border: 1px solid rgba(191, 32, 32, 0.24);
        border-radius: 0;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        background: rgba(191, 32, 32, 0.08);
        color: var(--red);
        font-size: 1.1rem;
        line-height: 1;
        transition: transform 0.24s ease, background-color 0.24s ease, color 0.24s ease, border-color 0.24s ease;
        flex: 0 0 auto;
    }

    .pc2-faq-item.open .pc2-icon {
        transform: rotate(45deg);
        color: #fff7f0;
        background: var(--red);
        border-color: var(--red);
    }

    .pc2-answer {
        display: grid;
        grid-template-rows: 0fr;
        transition: grid-template-rows 0.3s ease;
    }

    .pc2-faq-item.open .pc2-answer {
        grid-template-rows: 1fr;
    }

    .pc2-answer-inner {
        overflow: hidden;
        padding: 0 18px 0 22px;
    }

    .pc2-answer p {
        margin: 0;
        padding: 0 0 20px;
        color: var(--muted);
        max-width: 72ch;
    }

    [data-pc2-reveal] {
        opacity: 0;
        transform: translateY(24px);
        transition: opacity 0.7s ease, transform 0.7s ease;
    }

    [data-pc2-reveal].visible {
        opacity: 1;
        transform: translateY(0);
    }

    @media (min-width: 700px) {
        .pc2-section {
            padding: 18px;
        }

        .pc2-hero::before {
            inset: 20px;
        }

        .pc2-hero-content {
            padding: 22px 22px 110px;
            place-items: center;
        }

        .pc2-hero-card,
        .pc2-frame,
        .pc2-faq {
            padding: 26px 24px;
        }

        .pc2-actions {
            grid-template-columns: repeat(2, minmax(0, max-content));
        }

        .pc2-button {
            width: auto;
        }

        .pc2-stats {
            grid-template-columns: repeat(3, minmax(0, 1fr));
        }

        .pc2-faq-list {
            gap: 12px;
        }

        .pc2-question {
            padding: 20px 22px 20px 26px;
            font-size: 1.02rem;
        }

        .pc2-answer-inner {
            padding: 0 24px 0 26px;
        }
    }

    @media (min-width: 960px) {
        .pc2-section {
            padding: 24px;
        }

        .pc2-grid {
            grid-template-columns: minmax(300px, 0.9fr) minmax(0, 1.1fr);
            align-items: center;
        }

        .pc2-grid.reverse {
            grid-template-columns: minmax(0, 1.05fr) minmax(320px, 0.95fr);
        }

        .pc2-footer {
            grid-template-columns: minmax(0, 1fr);
            align-items: start;
        }

        .pc2-voucher-layout {
            grid-template-columns: minmax(0, 1.08fr) minmax(280px, 0.92fr);
            align-items: center;
        }

        .pc2-voucher-inner {
            padding: 40px 34px 46px;
        }

        .pc2-collage {
            gap: 16px;
        }

        .pc2-ui {
            left: auto;
            right: 30px;
            bottom: 28px;
            width: auto;
        }
    }
</style>

<div class="pc2-page">
    <section class="pc2-hero" aria-label="Paint and Kids editorial hero">
        <div class="pc2-stage">
            <article class="pc2-slide">
                <div class="pc2-media">
                    <img src="http://paintandwine.local/wp-content/uploads/2026/06/placeholder-1.webp"
                        alt="Dijete slika na platnu u studiju" />
                </div>
            </article>
            <article class="pc2-slide">
                <div class="pc2-media">
                    <img src="http://paintandwine.local/wp-content/uploads/2026/06/placeholder-1.webp"
                        alt="Djeca slikaju zajedno za stolom" />
                </div>
            </article>
            <article class="pc2-slide">
                <div class="pc2-media">
                    <img src="http://paintandwine.local/wp-content/uploads/2026/06/placeholder-1.webp"
                        alt="Djevojcica sa cetkicom i bojama" />
                </div>
            </article>
        </div>

        <div class="pc2-hero-content">
            <div class="pc2-hero-card">
                <span class="pc2-kicker">Paint and Kids</span>
                <h1 class="pc2-title">Color Wakes <span class="accent">With</span> Small Hands.</h1>
                <p class="pc2-hero-text">
                    Kreativna radionica u kojoj roditelji i djeca zajedno slikaju, druze se i stvaraju
                    uspomene kroz boje, igru i opustenu atmosferu.
                </p>
                <div class="pc2-actions">
                    <a class="pc2-button primary" href="#pc2-story">Ko smo mi?</a>
                    <a class="pc2-button secondary" href="#pc2-faq">Najcesca pitanja</a>
                </div>
            </div>
        </div>

        <div class="pc2-ui" aria-label="Hero carousel controls">
            <button class="pc2-nav" type="button" data-pc2-direction="prev" aria-label="Previous slide">&#8592;</button>
            <div class="pc2-dots" aria-label="Slide navigation"></div>
            <button class="pc2-nav" type="button" data-pc2-direction="next" aria-label="Next slide">&#8594;</button>
        </div>
    </section>

    <section class="pc2-section" id="pc2-story">
        <div class="pc2-shell pc2-grid">
            <div class="pc2-collage" data-pc2-reveal>
                <figure class="pc2-poster">
                    <img src="http://paintandwine.local/wp-content/uploads/2026/06/placeholder-1.webp"
                        alt="Slikarski pribor i cetkice u bojama" />
                </figure>
                <figure class="pc2-poster">
                    <img src="http://paintandwine.local/wp-content/uploads/2026/06/placeholder-1.webp"
                        alt="Dijete drzi svoj naslikani rad" />
                </figure>
                <figure class="pc2-poster">
                    <img src="http://paintandwine.local/wp-content/uploads/2026/06/placeholder-1.webp"
                        alt="Slikanje na platnu u ateljeu" />
                </figure>
                <figure class="pc2-poster">
                    <img src="http://paintandwine.local/wp-content/uploads/2026/06/placeholder-1.webp"
                        alt="Djevojcica slika u toplom studiju" />
                </figure>
            </div>

            <div class="pc2-frame" data-pc2-reveal>
                <span class="pc2-badge">Ko smo mi?</span>
                <h2 class="pc2-subtitle">Paint and Kids su slikarske radionice namijenjene za djecu i roditelje.</h2>
                <p class="pc2-text">
                    Ukoliko ste roditelj, ovo je vasa prilika za zblizavanje i povezivanje sa djetetom uz
                    kreativan rad i kvalitetno provedeno vrijeme.
                </p>
                <p class="pc2-text">
                    Radionice su namijenjene za djecu od 4 do 14 godina uz pratnju jednog ili oba roditelja.
                </p>
                <div class="pc2-stats">
                    <div class="pc2-stat">
                        <strong>4-14</strong>
                        <span>Uzrast djece</span>
                    </div>
                    <div class="pc2-stat">
                        <strong>1-2</strong>
                        <span>Roditelja u pratnji</span>
                    </div>
                    <div class="pc2-stat">
                        <strong>90</strong>
                        <span>Minuta druzenja</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="pc2-section" id="pc2-benefits">
        <div class="pc2-shell pc2-grid reverse">
            <div class="pc2-frame" data-pc2-reveal>
                <span class="pc2-badge">Uspomene sa djetetom</span>
                <h2 class="pc2-subtitle">Kreirajte znacajne uspomene sa vasim djetetom!</h2>
                <p class="pc2-text">Na nasim radionicama vas ocekuje:</p>
                <ul class="pc2-list">
                    <li>Sav neophodan materijal za rad.</li>
                    <li>Strucno korak po korak vodjenje instruktorice.</li>
                    <li>90 minuta kvalitetnog vremena sa vasim malisanom.</li>
                    <li>Prilika za dublje povezivanje i razvoj nezaboravnih uspomena sa djetetom.</li>
                </ul>
                <p class="pc2-note">A finalni rad nosite kuci kao uspomenu.</p>
            </div>

            <div class="pc2-frame" data-pc2-reveal>
                <h3 class="pc2-frame-title">Studio Feel</h3>
                <p class="pc2-note">
                    Vizuelno smo spojili toplu, razigranu energiju sa uredjenim editorial okvirom i jacim galerijskim karakterom.
                </p>
                <div class="pc2-collage" style="margin-top: 6px;">
                    <figure class="pc2-poster">
                        <img src="http://paintandwine.local/wp-content/uploads/2026/06/placeholder-1.webp"
                            alt="Djeca slikaju na radionici" />
                    </figure>
                    <figure class="pc2-poster">
                        <img src="http://paintandwine.local/wp-content/uploads/2026/06/placeholder-1.webp"
                            alt="Ruka sa cetkicom i bojama" />
                    </figure>
                </div>
            </div>
        </div>
    </section>
    
    <section class="pc2-section">
        [paint_wine_products categories="paint-and-kids"]

    </section>

    <section class="pc2-section" id="pc2-voucher">
        <div class="pc2-shell">
            <section class="pc2-voucher" aria-label="Voucher section">
                <div class="pc2-voucher-inner pc2-voucher-layout">
                    <div class="pc2-frame" data-pc2-reveal>
                        <span class="pc2-badge">Voucher</span>
                        <h2 class="pc2-subtitle">Iznenadite nekoga posebnim iskustvom!</h2>
                        <p class="pc2-text">
                            Za neobican poklon tu su Paint and Kids voucheri. Za mame, tate, sinove ili cerke.
                            Svi su dobrodosli da zajednicki uprljaju ruke bojama.
                        </p>
                    </div>

                    <figure class="pc2-voucher-card" data-pc2-reveal>
                        <img src="http://paintandwine.local/wp-content/uploads/2026/06/placeholder-1.webp"
                            alt="Kreativni voucher vizual sa cetkicom i bojama" />
                        <figcaption class="pc2-label" style="padding-top: 12px;">
                            Poklonite zajednicko vrijeme.
                        </figcaption>
                    </figure>
                </div>
            </section>
        </div>
    </section>

    <section class="pc2-section" id="pc2-faq">
        <div class="pc2-shell pc2-footer">
            <div class="pc2-faq" data-pc2-reveal>
                <span class="pc2-badge">Najcesca pitanja</span>
                <h2 class="pc2-subtitle">Najcesca pitanja</h2>

                <div class="pc2-faq-list">
                    <div class="pc2-faq-item open">
                        <button class="pc2-question" type="button" aria-expanded="true">
                            Koja je cijena radionice?
                            <span class="pc2-icon">+</span>
                        </button>
                        <div class="pc2-answer">
                            <div class="pc2-answer-inner">
                                <p>Cijena za jedno dijete i roditelja iznosi 30 EUR. Cijena za dodatno dijete ili odraslu osobu iznosi 15 EUR.</p>
                            </div>
                        </div>
                    </div>

                    <div class="pc2-faq-item">
                        <button class="pc2-question" type="button" aria-expanded="false">
                            Za koji uzrast su ove radionice?
                            <span class="pc2-icon">+</span>
                        </button>
                        <div class="pc2-answer">
                            <div class="pc2-answer-inner">
                                <p>Paint and Kids su radionice za uzrast od 4 do 14 godina uz pratnju roditelja.</p>
                            </div>
                        </div>
                    </div>

                    <div class="pc2-faq-item">
                        <button class="pc2-question" type="button" aria-expanded="false">
                            Da li moze da neko vino za roditelje?
                            <span class="pc2-icon">+</span>
                        </button>
                        <div class="pc2-answer">
                            <div class="pc2-answer-inner">
                                <p>Naravno! Za djecu smo pripremili sokove, a roditelji se mogu posluziti nekim od vina iz selekcije Paint and Wine Podgorica.</p>
                            </div>
                        </div>
                    </div>

                    <div class="pc2-faq-item">
                        <button class="pc2-question" type="button" aria-expanded="false">
                            Da li organizujete djecje rodjendane i proslave?
                            <span class="pc2-icon">+</span>
                        </button>
                        <div class="pc2-answer">
                            <div class="pc2-answer-inner">
                                <p>Da! Posaljite nam upit na mail <a href="mailto:tagpaintandwine@gmail.com">tagpaintandwine@gmail.com</a> sa upitom za datum, lokaciju i broj osoba, a mi cemo vam poslati ponudu.</p>
                            </div>
                        </div>
                    </div>

                    <div class="pc2-faq-item">
                        <button class="pc2-question" type="button" aria-expanded="false">
                            Koliko traje radionica?
                            <span class="pc2-icon">+</span>
                        </button>
                        <div class="pc2-answer">
                            <div class="pc2-answer-inner">
                                <p>Radionica traje oko 90 minuta.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
</div>

<script>
    (function () {
        const root = document.currentScript.previousElementSibling;
        if (!root || !root.classList.contains('pc2-page')) return;

        const revealItems = Array.from(root.querySelectorAll('[data-pc2-reveal]'));
        const faqItems = Array.from(root.querySelectorAll('.pc2-faq-item'));
        const hero = root.querySelector('.pc2-hero');
        const heroSlides = hero ? Array.from(hero.querySelectorAll('.pc2-slide')) : [];
        const heroDotsRoot = hero ? hero.querySelector('.pc2-dots') : null;
        const heroPrev = hero ? hero.querySelector('[data-pc2-direction="prev"]') : null;
        const heroNext = hero ? hero.querySelector('[data-pc2-direction="next"]') : null;
        let heroIndex = 0;
        let heroAutoplayId = 0;

        if ('IntersectionObserver' in window) {
            const observer = new IntersectionObserver((entries) => {
                entries.forEach((entry) => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('visible');
                        observer.unobserve(entry.target);
                    }
                });
            }, { threshold: 0.16 });

            revealItems.forEach((item) => observer.observe(item));
        } else {
            revealItems.forEach((item) => item.classList.add('visible'));
        }

        faqItems.forEach((item) => {
            const button = item.querySelector('.pc2-question');
            button.addEventListener('click', () => {
                const shouldOpen = !item.classList.contains('open');

                faqItems.forEach((faq) => {
                    faq.classList.remove('open');
                    faq.querySelector('.pc2-question').setAttribute('aria-expanded', 'false');
                });

                if (shouldOpen) {
                    item.classList.add('open');
                    button.setAttribute('aria-expanded', 'true');
                }
            });
        });

        function setHeroSlide(index) {
            heroIndex = (index + heroSlides.length) % heroSlides.length;
            heroSlides.forEach((slide, slideIndex) => {
                slide.classList.toggle('is-active', slideIndex === heroIndex);
            });
            if (heroDotsRoot) {
                heroDotsRoot.querySelectorAll('.pc2-dot').forEach((dot, dotIndex) => {
                    dot.classList.toggle('is-active', dotIndex === heroIndex);
                });
            }
        }

        function restartHeroAutoplay() {
            window.clearInterval(heroAutoplayId);
            heroAutoplayId = window.setInterval(() => setHeroSlide(heroIndex + 1), 5200);
        }

        if (hero && heroSlides.length && heroDotsRoot && heroPrev && heroNext) {
            heroSlides.forEach((_, index) => {
                const dot = document.createElement('button');
                dot.type = 'button';
                dot.className = 'pc2-dot';
                dot.setAttribute('aria-label', 'Go to slide ' + (index + 1));
                dot.addEventListener('click', () => {
                    setHeroSlide(index);
                    restartHeroAutoplay();
                });
                heroDotsRoot.appendChild(dot);
            });

            heroPrev.addEventListener('click', () => {
                setHeroSlide(heroIndex - 1);
                restartHeroAutoplay();
            });

            heroNext.addEventListener('click', () => {
                setHeroSlide(heroIndex + 1);
                restartHeroAutoplay();
            });

            setHeroSlide(0);
            restartHeroAutoplay();
        }

    })();
</script>
[paint_wine_footer]