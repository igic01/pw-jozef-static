const cartStorageKey = "v4e-cart";
const cartRoot = document.querySelector("[data-cart-items]");

function readCart() {
    try {
        const cart = JSON.parse(window.localStorage.getItem(cartStorageKey) || "[]");
        return Array.isArray(cart) ? cart : [];
    } catch (error) {
        console.warn("Korpa nije mogla biti učitana.", error);
        return [];
    }
}

function saveCart(cart) {
    window.localStorage.setItem(cartStorageKey, JSON.stringify(cart));
    window.dispatchEvent(new CustomEvent("v4e:cart-updated"));
}

function priceToNumber(price) {
    return Number.parseFloat(String(price).replace(",", ".").replace(/[^0-9.]/g, "")) || 0;
}

function formatPrice(price) {
    return `${price.toLocaleString("sr-Latn", { minimumFractionDigits: 0, maximumFractionDigits: 2 })} €`;
}

function createCartItem(item) {
    const row = document.createElement("article");
    row.className = "v5c-item";
    row.dataset.cartItem = item.id;

    const product = document.createElement("div");
    product.className = "v5c-product";

    const imageFrame = document.createElement("div");
    imageFrame.className = "v5c-item-image";
    const image = document.createElement("img");
    image.src = item.image || "../assets/images/placeholder.webp";
    image.alt = item.name;
    image.loading = "lazy";
    imageFrame.appendChild(image);

    const content = document.createElement("div");
    content.className = "v5c-item-content";
    const name = document.createElement("h2");
    name.className = "v5c-item-name";
    const nameLink = document.createElement("a");
    const productKey = String(item.id).startsWith("product:") ? String(item.id).slice("product:".length) : "";
    nameLink.href = item.url || (productKey ? `product.html?product=${encodeURIComponent(productKey)}` : "product.html");
    nameLink.textContent = item.name;
    name.appendChild(nameLink);
    content.appendChild(name);

    const unitPrice = document.createElement("p");
    unitPrice.className = "v5c-unit-price";
    unitPrice.textContent = item.price;
    content.appendChild(unitPrice);

    const shortDescription = document.createElement("p");
    shortDescription.className = "v5c-item-description";
    shortDescription.textContent = item.description || "Kratak opis proizvoda biće dodat naknadno.";
    content.appendChild(shortDescription);

    if (Array.isArray(item.details) && item.details.length) {
        const details = document.createElement("ul");
        details.className = "v5c-item-details";
        item.details.forEach((detail) => {
            const detailItem = document.createElement("li");
            detailItem.textContent = detail;
            details.appendChild(detailItem);
        });
        content.appendChild(details);
    }

    const actions = document.createElement("div");
    actions.className = "v5c-item-actions";
    const stepper = document.createElement("div");
    stepper.className = "v5c-stepper";
    const decrease = document.createElement("button");
    decrease.type = "button";
    decrease.dataset.cartAdjust = item.id;
    decrease.dataset.delta = "-1";
    decrease.setAttribute("aria-label", "Smanji količinu");
    decrease.textContent = "−";
    const quantity = document.createElement("input");
    quantity.type = "number";
    quantity.min = "1";
    quantity.max = "99";
    quantity.value = String(Math.max(1, Number(item.quantity) || 1));
    quantity.dataset.cartQuantity = item.id;
    quantity.setAttribute("aria-label", item.kind === "event" ? "Broj mjesta" : "Količina");
    const increase = document.createElement("button");
    increase.type = "button";
    increase.dataset.cartAdjust = item.id;
    increase.dataset.delta = "1";
    increase.setAttribute("aria-label", "Povećaj količinu");
    increase.textContent = "+";
    stepper.append(decrease, quantity, increase);
    const lineTotal = document.createElement("strong");
    lineTotal.className = "v5c-line-total";
    lineTotal.textContent = formatPrice(priceToNumber(item.price) * Number(quantity.value));
    const remove = document.createElement("button");
    remove.type = "button";
    remove.className = "v5c-remove";
    remove.dataset.cartRemove = item.id;
    remove.setAttribute("aria-label", `Ukloni ${item.name}`);
    const trashIcon = document.createElement("i");
    trashIcon.className = "fa-solid fa-trash-can v5c-trash-icon";
    trashIcon.setAttribute("aria-hidden", "true");
    remove.appendChild(trashIcon);
    actions.append(stepper, remove);
    content.appendChild(actions);

    product.append(imageFrame, content);
    row.append(product, lineTotal);
    return row;
}

function renderCart() {
    if (!cartRoot) return;
    const cart = readCart();
    const empty = document.querySelector("[data-cart-empty]");
    const layout = document.querySelector("[data-cart-layout]");
    const totalPrice = document.querySelector("[data-cart-total-price]");
    const checkout = document.querySelector("[data-cart-checkout]");
    const price = cart.reduce((total, item) => total + priceToNumber(item.price) * (Number(item.quantity) || 0), 0);

    cartRoot.replaceChildren(...cart.map(createCartItem));
    if (empty) empty.hidden = cart.length !== 0;
    if (layout) layout.hidden = cart.length === 0;
    if (totalPrice) totalPrice.textContent = formatPrice(price);
    if (checkout) checkout.disabled = cart.length === 0;
}

cartRoot?.addEventListener("change", (event) => {
    const quantityInput = event.target.closest("[data-cart-quantity]");
    if (!quantityInput) return;
    const cart = readCart();
    const item = cart.find((entry) => entry.id === quantityInput.dataset.cartQuantity);
    if (!item) return;
    item.quantity = Math.min(99, Math.max(1, Number.parseInt(quantityInput.value, 10) || 1));
    saveCart(cart);
    renderCart();
});

cartRoot?.addEventListener("click", (event) => {
    const adjustButton = event.target.closest("[data-cart-adjust]");
    if (adjustButton) {
        const cart = readCart();
        const item = cart.find((entry) => entry.id === adjustButton.dataset.cartAdjust);
        if (!item) return;
        const delta = Number.parseInt(adjustButton.dataset.delta, 10) || 0;
        item.quantity = Math.min(99, Math.max(1, (Number(item.quantity) || 1) + delta));
        saveCart(cart);
        renderCart();
        return;
    }

    const removeButton = event.target.closest("[data-cart-remove]");
    if (!removeButton) return;
    saveCart(readCart().filter((item) => item.id !== removeButton.dataset.cartRemove));
    renderCart();
});

document.querySelector("[data-coupon-form]")?.addEventListener("submit", (event) => {
    event.preventDefault();
});

renderCart();
