const products = {
    majica: {
        name: "Paint & Wine majica",
        price: "25 €",
        shortDescription: "Kratak opis proizvoda biće dodat naknadno. Ovo je privremeni tekst za osnovne informacije o majici, materijalu i dostupnim varijantama."
    },
    ceger: {
        name: "Platneni ceger",
        price: "15 €",
        shortDescription: "Kratak opis proizvoda biće dodat naknadno. Ovo je privremeni tekst za osnovne informacije o cegeru, materijalu i načinu korišćenja."
    },
    solja: {
        name: "Studio šolja",
        price: "12 €",
        shortDescription: "Kratak opis proizvoda biće dodat naknadno. Ovo je privremeni tekst za osnovne informacije o šolji, materijalu i održavanju."
    },
    "art-print": {
        name: "Art print",
        price: "18 €",
        shortDescription: "Kratak opis proizvoda biće dodat naknadno. Ovo je privremeni tekst za osnovne informacije o printu, dimenzijama i načinu izrade."
    }
};

const productPage = document.querySelector("[data-product-page]");

if (productPage) {
    const params = new URLSearchParams(window.location.search);
    const productKey = params.get("product") || "majica";
    const eventTypeLabels = {
        "paint-wine": "Paint & Wine",
        "Paint and Wine": "Paint & Wine",
        neon: "Neon Paint & Cocktails",
        "Neon Paint and Cocktails": "Neon Paint & Cocktails",
        kids: "Paint & Kids",
        "Paint and Kids": "Paint & Kids"
    };
    let product = products[productKey] || products.majica;

    if (params.get("kind") === "event") {
        const difficulty = Math.min(5, Math.max(1, Number.parseInt(params.get("difficulty"), 10) || 1));
        const eventType = eventTypeLabels[params.get("type")] || "Paint & Wine radionica";
        product = {
            kind: "event",
            name: params.get("title") || "Paint & Wine radionica",
            price: params.get("price") || "",
            eyebrow: eventType,
            eventType,
            date: [params.get("day"), params.get("date")].filter(Boolean).join(", "),
            time: params.get("time") || "",
            difficulty: "/".repeat(difficulty),
            actionLabel: "Rezerviši mjesto",
            descriptionTitle: "Opis radionice",
            shortDescription: "Ovo je privremeni kratki opis radionice. Dodatne informacije o motivu, materijalu i programu biće dodate naknadno.",
            image: params.get("img") || "../assets/images/placeholder.webp",
        };
    }

    productPage.querySelectorAll("[data-product-field]").forEach((field) => {
        const value = product[field.dataset.productField];
        if (value) field.textContent = value;
    });

    const mainImage = productPage.querySelector("[data-product-image]");
    if (mainImage) {
        mainImage.alt = product.name;
        if (product.image) mainImage.src = product.image;
    }
    const facts = productPage.querySelector("[data-product-facts]");
    const benefits = productPage.querySelector("[data-product-benefits]");

    if (product.kind === "event" && facts) {
        const factValues = [
            ["Tip", product.eventType],
            ["Datum", product.date],
            ["Vrijeme", product.time],
            ["Težina", product.difficulty]
        ].filter(([, value]) => value);

        facts.replaceChildren(...factValues.map(([label, value]) => {
            const fact = document.createElement("div");
            const term = document.createElement("dt");
            const description = document.createElement("dd");
            fact.className = "v5p-fact";
            term.textContent = label;
            description.textContent = value;
            fact.append(term, description);
            return fact;
        }));
        facts.hidden = false;
    }

    if (product.kind === "event" && benefits) {
        const eventBenefits = [
            "Sav potreban materijal uključen je u cijenu",
            "Slikarsko iskustvo nije potrebno",
            "Mjesto se rezerviše za odabrani termin"
        ];
        benefits.replaceChildren(...eventBenefits.map((text) => {
            const item = document.createElement("li");
            item.textContent = text;
            return item;
        }));
    }

    const longDescription = productPage.querySelector("[data-product-long-description]");
    if (product.kind === "event" && longDescription) {
        const paragraphs = [
            "Ovo je privremeni duži opis radionice. Na ovom mjestu biće predstavljene detaljnije informacije o motivu, programu, trajanju i svemu što je uključeno u rezervaciju.",
            "Ovdje se može dodati više informacija o toku radionice, atmosferi i preporukama za dolazak. Tekst će biti zamijenjen finalnim sadržajem kada informacije budu spremne."
        ];
        longDescription.replaceChildren(...paragraphs.map((text) => {
            const paragraph = document.createElement("p");
            paragraph.textContent = text;
            return paragraph;
        }));
    }
    document.title = `${product.name} | Paint & Wine Podgorica`;

    const quantityInput = productPage.querySelector(".v5p-quantity input");
    const cartButton = productPage.querySelector(".v5p-cart-button");
    cartButton?.addEventListener("click", () => {
        const quantity = Math.min(20, Math.max(1, Number.parseInt(quantityInput?.value, 10) || 1));
        const cartKey = "v4e-cart";
        let cart = [];

        try {
            const savedCart = JSON.parse(window.localStorage.getItem(cartKey) || "[]");
            if (Array.isArray(savedCart)) cart = savedCart;
        } catch (error) {
            console.warn("Korpa nije mogla biti učitana.", error);
        }

        const itemId = product.kind === "event"
            ? `event:${product.name}:${product.date}:${product.time}`
            : `product:${productKey}`;
        const existingItem = cart.find((item) => item.id === itemId);

        if (existingItem) {
            existingItem.quantity = Math.min(99, (Number(existingItem.quantity) || 0) + quantity);
        } else {
            cart.push({
                id: itemId,
                kind: product.kind || "product",
                name: product.name,
                price: product.price,
                image: mainImage?.src || "../assets/images/placeholder.webp",
                quantity,
                description: product.shortDescription,
                url: window.location.href,
                details: product.kind === "event"
                    ? [product.eventType, product.date, product.time, `Težina: ${product.difficulty}`].filter(Boolean)
                    : []
            });
        }

        try {
            window.localStorage.setItem(cartKey, JSON.stringify(cart));
            window.dispatchEvent(new CustomEvent("v4e:cart-updated"));
            const originalLabel = product.actionLabel || "Dodaj u korpu";
            cartButton.textContent = product.kind === "event" ? "Mjesto je dodato" : "Dodato u korpu";
            cartButton.classList.add("is-added");
            window.setTimeout(() => {
                cartButton.textContent = originalLabel;
                cartButton.classList.remove("is-added");
            }, 1600);
        } catch (error) {
            console.warn("Proizvod nije mogao biti dodat u korpu.", error);
        }
    });

    const thumbnails = [...productPage.querySelectorAll(".v5p-thumbnail")];
    thumbnails.forEach((thumbnail) => {
        thumbnail.addEventListener("click", () => {
            thumbnails.forEach((item) => item.classList.toggle("is-active", item === thumbnail));
        });
    });
}
