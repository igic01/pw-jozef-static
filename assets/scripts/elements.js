function setupHeader(scope) {
    const header = scope.querySelector("[data-header]");
    if (!header || header.dataset.ready === "true") return;
    header.dataset.ready = "true";

    const menuToggle = header.querySelector(".v4e-navbar-toggle");
    const menu = header.querySelector(".v4e-navbar-menu");
    const languageDropdown = header.querySelector("[data-language-dropdown]");
    const currentPath = window.location.pathname.replace(/\/$/, "/index.html");

    menu?.querySelectorAll("a").forEach((link) => {
        const linkPath = new URL(link.href, window.location.href).pathname;
        if (linkPath === currentPath) link.setAttribute("aria-current", "page");
        else link.removeAttribute("aria-current");
    });

    menuToggle?.addEventListener("click", () => {
        const isOpen = header.classList.toggle("is-open");
        menuToggle.setAttribute("aria-expanded", String(isOpen));
        menuToggle.setAttribute("aria-label", isOpen ? "Zatvori meni" : "Otvori meni");
    });

    menu?.addEventListener("click", (event) => {
        if (!event.target.closest("a")) return;
        header.classList.remove("is-open");
        menuToggle?.setAttribute("aria-expanded", "false");
    });

    if (!languageDropdown) return;
    const languageToggle = languageDropdown.querySelector(".v4e-language-toggle");
    const currentLanguage = languageDropdown.querySelector(".v4e-language-current");

    languageToggle?.addEventListener("click", (event) => {
        event.stopPropagation();
        const isOpen = languageDropdown.classList.toggle("is-open");
        languageToggle.setAttribute("aria-expanded", String(isOpen));
    });

    languageDropdown.querySelector(".v4e-language-options")?.addEventListener("click", (event) => {
        const option = event.target.closest("[data-language]");
        if (!option) return;
        currentLanguage.textContent = option.dataset.language;
        languageDropdown.classList.remove("is-open");
        languageToggle?.setAttribute("aria-expanded", "false");
    });

    document.addEventListener("click", (event) => {
        if (languageDropdown.contains(event.target)) return;
        languageDropdown.classList.remove("is-open");
        languageToggle?.setAttribute("aria-expanded", "false");
    });
}

function setupHero(scope) {
    const hero = scope.querySelector("[data-hero]");
    if (!hero || hero.dataset.ready === "true") return;
    hero.dataset.ready = "true";

    const slides = [...hero.querySelectorAll(".v4e-slide")];
    const dotsRoot = hero.querySelector(".v4e-dots");
    let activeIndex = 0;

    const showSlide = (index) => {
        activeIndex = (index + slides.length) % slides.length;
        slides.forEach((slide, slideIndex) => slide.classList.toggle("is-active", slideIndex === activeIndex));
        dotsRoot?.querySelectorAll(".v4e-dot").forEach((dot, dotIndex) => {
            dot.classList.toggle("is-active", dotIndex === activeIndex);
            dot.setAttribute("aria-current", dotIndex === activeIndex ? "true" : "false");
        });
    };

    slides.forEach((_, index) => {
        const dot = document.createElement("button");
        dot.type = "button";
        dot.className = "v4e-dot";
        dot.setAttribute("aria-label", `Prikaži slajd ${index + 1}`);
        dot.addEventListener("click", () => {
            showSlide(index);
        });
        dotsRoot?.appendChild(dot);
    });

    hero.addEventListener("click", (event) => {
        const button = event.target.closest("[data-direction]");
        if (!button) return;
        showSlide(activeIndex + (button.dataset.direction === "next" ? 1 : -1));
    });

    showSlide(0);
}

function setupStore(scope) {
    const store = scope.querySelector("[data-store]");
    if (!store || store.dataset.ready === "true") return;
    store.dataset.ready = "true";

    const host = scope instanceof HTMLElement && scope.matches("include-element")
        ? scope
        : store.closest("include-element");
    const config = host?.dataset || {};
    const eventsSource = scope.querySelector("[data-store-events]");
    const grid = store.querySelector("[data-store-grid]");
    const viewport = store.querySelector("[data-store-viewport]");
    const empty = store.querySelector("[data-store-empty]");
    const title = store.querySelector("[data-store-title]");
    const subtitle = store.querySelector("[data-store-subtitle]");
    const eyebrow = store.querySelector("[data-store-eyebrow]");
    const previous = store.querySelector('[data-store-direction="previous"]');
    const next = store.querySelector('[data-store-direction="next"]');
    const layout = config.storeLayout === "carousel" ? "carousel" : "grid";
    const theme = config.storeTheme || "classic";
    const requestedTypes = (config.eventType || "all").split(",").map((value) => value.trim()).filter(Boolean);
    const hideDifficulty = config.hideDifficulty === "true";
    const bookingLink = config.storeLink || "schedule.html";
    const typeLabels = {
        "paint-wine": "Paint & Wine",
        neon: "Neon Paint & Cocktails",
        kids: "Paint & Kids"
    };
    let events = [];

    try {
        events = JSON.parse(eventsSource?.textContent || "[]");
    } catch (error) {
        console.error("Store events could not be parsed.", error);
    }

    if (!requestedTypes.includes("all")) {
        events = events.filter((event) => requestedTypes.includes(event.type));
    }

    store.dataset.layout = layout;
    store.dataset.theme = theme;
    store.dataset.hideDifficulty = String(hideDifficulty);
    if (config.storeTitle && title) title.textContent = config.storeTitle;
    if (config.storeSubtitle && subtitle) subtitle.textContent = config.storeSubtitle;
    if (config.storeEyebrow && eyebrow) eyebrow.textContent = config.storeEyebrow;
    if (config.storeEyebrow === "" && eyebrow) eyebrow.hidden = true;

    const createEventCard = (event) => {
        const card = document.createElement("article");
        card.className = `v5e-card v5e-card--${event.type}`;

        const top = document.createElement("div");
        top.className = "v5e-card-top";
        const dateGroup = document.createElement("div");
        const date = document.createElement("div");
        date.className = "v5e-date";
        date.textContent = event.date;
        const dateMeta = document.createElement("div");
        dateMeta.className = "v5e-date-meta";
        const day = document.createElement("div");
        day.className = "v5e-day";
        day.textContent = event.day;
        const time = document.createElement("span");
        time.className = "v5e-time";
        time.textContent = event.time;
        dateMeta.append(day, time);
        dateGroup.append(date, dateMeta);
        top.appendChild(dateGroup);

        const image = document.createElement("div");
        image.className = "v5e-image";
        const imageElement = document.createElement("img");
        imageElement.src = event.img;
        imageElement.alt = `${event.title} radionica`;
        imageElement.loading = "lazy";
        image.appendChild(imageElement);

        const name = document.createElement("h3");
        name.className = "v5e-name";
        name.textContent = event.title;

        const type = document.createElement("div");
        type.className = "v5e-type";
        type.textContent = typeLabels[event.type] || event.type;

        const meta = document.createElement("div");
        meta.className = "v5e-card-meta";
        const difficulty = document.createElement("span");
        difficulty.className = "v5e-difficulty";
        const difficultyValue = Math.min(5, Math.max(1, Number.parseInt(event.difficulty, 10) || 1));
        difficulty.textContent = `Težina: ${"/".repeat(difficultyValue)}`;
        difficulty.setAttribute("aria-label", `Težina ${difficultyValue} od 5`);
        difficulty.title = `Težina ${difficultyValue} od 5`;
        meta.appendChild(difficulty);

        const footer = document.createElement("div");
        footer.className = "v5e-card-footer";
        const price = document.createElement("span");
        price.className = "v5e-price";
        price.textContent = event.price;
        const link = document.createElement("a");
        link.className = "button v5e-button";
        link.href = bookingLink;
        link.textContent = "Rezerviši";
        footer.append(price, link);

        card.append(top, image, name, type, meta, footer);
        return card;
    };

    grid?.replaceChildren(...events.map(createEventCard));
    if (empty) empty.hidden = events.length > 0;

    const updateArrows = () => {
        if (!viewport || layout !== "carousel") return;
        const maxScroll = viewport.scrollWidth - viewport.clientWidth;
        if (previous) previous.disabled = viewport.scrollLeft <= 2;
        if (next) next.disabled = viewport.scrollLeft >= maxScroll - 2;
    };

    store.addEventListener("click", (event) => {
        const direction = event.target.closest("[data-store-direction]");
        if (!direction || !viewport || layout !== "carousel") return;
        const amount = viewport.clientWidth * 0.82 * (direction.dataset.storeDirection === "next" ? 1 : -1);
        viewport.scrollBy({
            left: amount,
            behavior: window.matchMedia("(prefers-reduced-motion: reduce)").matches ? "auto" : "smooth"
        });
    });

    viewport?.addEventListener("scroll", updateArrows, { passive: true });
    window.addEventListener("resize", updateArrows);
    requestAnimationFrame(updateArrows);
}

function setupVoucher(scope) {
    const voucher = scope.querySelector("[data-voucher]");
    if (!voucher || voucher.dataset.ready === "true") return;
    voucher.dataset.ready = "true";

    const track = voucher.querySelector(".v4e-voucher-track");
    const slides = [...voucher.querySelectorAll(".v4e-voucher-slide")];
    const dotsRoot = voucher.querySelector(".v4e-voucher-dots");
    const reduceMotion = window.matchMedia("(prefers-reduced-motion: reduce)").matches;
    let activeIndex = 0;
    let autoplayId;

    const showSlide = (index) => {
        activeIndex = (index + slides.length) % slides.length;
        track.style.transform = `translate3d(-${activeIndex * 100}%, 0, 0)`;
        dotsRoot.querySelectorAll(".v4e-voucher-dot").forEach((dot, dotIndex) => {
            dot.classList.toggle("is-active", dotIndex === activeIndex);
        });
    };

    const restartAutoplay = () => {
        window.clearInterval(autoplayId);
        if (reduceMotion || document.hidden || slides.length < 2) return;
        autoplayId = window.setInterval(() => showSlide(activeIndex + 1), 3200);
    };

    slides.forEach((_, index) => {
        const dot = document.createElement("button");
        dot.type = "button";
        dot.className = "v4e-voucher-dot";
        dot.setAttribute("aria-label", `Prikaži vaučer ${index + 1}`);
        dot.addEventListener("click", () => {
            showSlide(index);
            restartAutoplay();
        });
        dotsRoot.appendChild(dot);
    });

    document.addEventListener("visibilitychange", restartAutoplay);
    showSlide(0);
    restartAutoplay();
}

function setupPrivateWorkshops(scope) {
    const page = scope.querySelector("[data-private-workshops]");
    if (!page || page.dataset.ready === "true") return;
    page.dataset.ready = "true";

    const modal = page.querySelector("[data-workshop-modal]");
    const modalContent = modal?.querySelector(".v4p-modal-content");
    const closeButton = modal?.querySelector(".v4p-modal-close");
    const details = page.querySelector(".v4p-hidden-detail");
    let lastTrigger = null;

    const closeModal = () => {
        if (!modal || !modal.classList.contains("is-open")) return;
        modal.classList.remove("is-open");
        modal.setAttribute("aria-hidden", "true");
        modalContent.innerHTML = "";
        document.body.style.removeProperty("overflow");
        lastTrigger?.focus();
    };

    const openModal = (key, trigger) => {
        const detail = details?.querySelector(`[data-workshop-detail="${key}"]`);
        if (!detail || !modal || !modalContent) return;
        modalContent.innerHTML = detail.innerHTML;
        const title = modalContent.querySelector("h3");
        if (title) title.id = "workshop-modal-title";
        modal.classList.add("is-open");
        modal.setAttribute("aria-hidden", "false");
        document.body.style.overflow = "hidden";
        lastTrigger = trigger;
        closeButton?.focus();
    };

    page.addEventListener("click", (event) => {
        const trigger = event.target.closest("[data-workshop-open]");
        if (trigger) {
            openModal(trigger.dataset.workshopOpen, trigger);
            return;
        }
        if (event.target.closest("[data-workshop-close]")) closeModal();
    });

    document.addEventListener("keydown", (event) => {
        if (event.key === "Escape") closeModal();
    });

    page.querySelector(".v4p-form")?.addEventListener("submit", (event) => {
        event.preventDefault();
    });
}

function setupPaintKids(scope) {
    const page = scope.querySelector("[data-paint-kids]");
    if (!page || page.dataset.ready === "true") return;
    page.dataset.ready = "true";

    page.querySelectorAll("[data-carousel]").forEach((carouselRoot) => {
        const scroller = carouselRoot.querySelector(".hero-carousel");
        const previous = carouselRoot.querySelector("[data-carousel-prev]");
        const next = carouselRoot.querySelector("[data-carousel-next]");
        if (!scroller || !previous || !next) return;

        const scrollBySlide = (direction) => {
            scroller.scrollBy({
                left: direction * scroller.clientWidth,
                behavior: "smooth"
            });
        };

        previous.addEventListener("click", () => scrollBySlide(-1));
        next.addEventListener("click", () => scrollBySlide(1));
    });
}

function setupNeonPage(scope) {
    const page = scope.querySelector("[data-neon-page]");
    if (!page || page.dataset.ready === "true") return;
    page.dataset.ready = "true";

    const hero = page.querySelector("[data-neon-hero]");
    const slides = hero ? [...hero.querySelectorAll(".npk-slide")] : [];
    const dotsRoot = hero?.querySelector(".npk-dots");
    let activeIndex = 0;

    const showSlide = (index) => {
        if (!slides.length) return;
        activeIndex = (index + slides.length) % slides.length;
        slides.forEach((slide, slideIndex) => slide.classList.toggle("is-active", slideIndex === activeIndex));
        dotsRoot?.querySelectorAll(".npk-dot").forEach((dot, dotIndex) => {
            dot.classList.toggle("is-active", dotIndex === activeIndex);
            dot.setAttribute("aria-current", dotIndex === activeIndex ? "true" : "false");
        });
    };

    slides.forEach((_, index) => {
        const dot = document.createElement("button");
        dot.type = "button";
        dot.className = "npk-dot";
        dot.setAttribute("aria-label", `Prikaži sliku ${index + 1}`);
        dot.addEventListener("click", () => {
            showSlide(index);
        });
        dotsRoot?.appendChild(dot);
    });

    hero?.addEventListener("click", (event) => {
        const control = event.target.closest("[data-neon-direction]");
        if (!control) return;
        showSlide(activeIndex + (control.dataset.neonDirection === "next" ? 1 : -1));
    });

    hero?.addEventListener("keydown", (event) => {
        if (event.key !== "ArrowLeft" && event.key !== "ArrowRight") return;
        showSlide(activeIndex + (event.key === "ArrowRight" ? 1 : -1));
    });

    showSlide(0);
}

function setupGallery(scope) {
    const gallery = scope.querySelector("[data-gallery]");
    if (!gallery || gallery.dataset.ready === "true") return;
    gallery.dataset.ready = "true";

    const filters = [...gallery.querySelectorAll("[data-gallery-filter]")];
    const items = [...gallery.querySelectorAll(".v4g-item")];
    const empty = gallery.querySelector(".v4g-empty");
    const loadMore = gallery.querySelector("[data-gallery-load-more]");
    const loadMoreWrap = loadMore?.closest(".v4g-more-wrap");
    const lightbox = gallery.querySelector("[data-gallery-lightbox]");
    const lightboxImage = gallery.querySelector("[data-gallery-lightbox-image]");
    const lightboxTitle = gallery.querySelector("[data-gallery-lightbox-title]");
    const lightboxCategory = gallery.querySelector("[data-gallery-lightbox-category]");
    const lightboxCount = gallery.querySelector("[data-gallery-lightbox-count]");
    const previous = gallery.querySelector("[data-gallery-lightbox-prev]");
    const next = gallery.querySelector("[data-gallery-lightbox-next]");
    const initialCount = Math.max(1, Number.parseInt(gallery.dataset.galleryInitial || "12", 10));
    const batchCount = Math.max(1, Number.parseInt(gallery.dataset.galleryBatch || "12", 10));
    let activeFilter = "all";
    let revealedCount = initialCount;
    let activeIndex = 0;
    let previousBodyOverflow = "";
    let lastTrigger = null;

    const matchingItems = () => items.filter((item) => {
        const categories = (item.dataset.galleryCategories || "").split(",").filter(Boolean);
        return activeFilter === "all" || categories.includes(activeFilter);
    });

    const visibleItems = () => items.filter((item) => !item.classList.contains("is-hidden") && !item.classList.contains("is-deferred"));

    const applyFilter = (filter, resetCount = false) => {
        activeFilter = filter;
        if (resetCount) revealedCount = initialCount;
        const matches = matchingItems();

        items.forEach((item) => {
            const matchIndex = matches.indexOf(item);
            const matchesFilter = matchIndex >= 0;
            item.classList.toggle("is-hidden", !matchesFilter);
            item.classList.toggle("is-deferred", matchesFilter && matchIndex >= revealedCount);
        });

        filters.forEach((button) => {
            const isActive = button.dataset.galleryFilter === filter;
            button.classList.toggle("is-active", isActive);
            button.setAttribute("aria-pressed", String(isActive));
        });

        empty?.classList.toggle("is-visible", matches.length === 0);
        loadMoreWrap?.classList.toggle("is-hidden", matches.length <= revealedCount);
    };

    const showLightboxItem = (index) => {
        const visible = visibleItems();
        if (!visible.length || !lightboxImage) return;
        activeIndex = (index + visible.length) % visible.length;
        const item = visible[activeIndex];
        const image = item.querySelector("img");
        if (!image) return;

        lightboxImage.src = item.dataset.galleryFull || image.currentSrc || image.src;
        lightboxImage.alt = image.alt;
        if (lightboxTitle) lightboxTitle.textContent = item.dataset.galleryTitle || image.alt;
        if (lightboxCategory) lightboxCategory.textContent = item.dataset.galleryLabel || "";
        if (lightboxCount) lightboxCount.textContent = `${activeIndex + 1} / ${visible.length}`;
    };

    const openLightbox = (item) => {
        if (!lightbox) return;
        const index = visibleItems().indexOf(item);
        if (index < 0) return;
        previousBodyOverflow = document.body.style.overflow;
        lastTrigger = item;
        showLightboxItem(index);
        lightbox.classList.add("is-open");
        lightbox.setAttribute("aria-hidden", "false");
        document.body.style.overflow = "hidden";
        next?.focus();
    };

    const closeLightbox = () => {
        if (!lightbox?.classList.contains("is-open")) return;
        lightbox.classList.remove("is-open");
        lightbox.setAttribute("aria-hidden", "true");
        if (lightboxImage) lightboxImage.src = "";
        document.body.style.overflow = previousBodyOverflow;
        lastTrigger?.focus();
    };

    filters.forEach((button) => button.addEventListener("click", () => {
        applyFilter(button.dataset.galleryFilter || "all", true);
    }));

    items.forEach((item) => item.addEventListener("click", () => openLightbox(item)));
    loadMore?.addEventListener("click", () => {
        revealedCount += batchCount;
        applyFilter(activeFilter);
    });
    gallery.querySelectorAll("[data-gallery-lightbox-close]").forEach((button) => button.addEventListener("click", closeLightbox));
    previous?.addEventListener("click", () => showLightboxItem(activeIndex - 1));
    next?.addEventListener("click", () => showLightboxItem(activeIndex + 1));

    document.addEventListener("keydown", (event) => {
        if (!lightbox?.classList.contains("is-open")) return;
        if (event.key === "Escape") closeLightbox();
        if (event.key === "ArrowLeft") showLightboxItem(activeIndex - 1);
        if (event.key === "ArrowRight") showLightboxItem(activeIndex + 1);
    });

    applyFilter(activeFilter, true);
}

function initializeComponents(scope = document) {
    setupHeader(scope);
    setupHero(scope);
    setupStore(scope);
    setupVoucher(scope);
    setupPrivateWorkshops(scope);
    setupPaintKids(scope);
    setupNeonPage(scope);
    setupGallery(scope);
}

class IncludeElement extends HTMLElement {
    async connectedCallback() {
        const name = this.getAttribute("src");
        if (!name) return;

        const path = new URL(`./elements/${name}.html`, window.location.href);

        try {
            const response = await fetch(path);
            if (!response.ok) throw new Error(`Failed to load ${path.pathname}: ${response.status}`);
            this.innerHTML = await response.text();
            initializeComponents(this);
        } catch (error) {
            console.error(error);
            this.innerHTML = `<p class="component-error">Komponenta nije mogla biti učitana.</p>`;
        }
    }
}

customElements.define("include-element", IncludeElement);

if (document.readyState === "loading") {
    document.addEventListener("DOMContentLoaded", () => initializeComponents());
} else {
    initializeComponents();
}
