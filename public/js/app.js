/* =============================================
   APP.JS — Nike Pakistan Store
   Admin login · Full validation · Order flow
   ============================================= */

// ─── CREDENTIALS ─────────────────────────────
const ADMIN_USER = "UmerAhsan";
const ADMIN_PASS = "admin99";
let isAdminLoggedIn = false;

// ─── STATE ───────────────────────────────────
let cart = [];
let currentProduct = null;
let currentQty = 1;
let selectedSize = null;
let currentPaymentMethod = "card";
let adminInitialized = false;
let dtables = {};

// ─── PKR FORMATTER ───────────────────────────
function pkr(n) {
  return "Rs. " + Math.round(n).toLocaleString("en-PK");
}

// ─── TOAST ───────────────────────────────────
function showToast(msg, type) {
  const t   = document.getElementById("toast");
  const m   = document.getElementById("toast-msg");
  const ico = document.getElementById("toast-icon");
  m.textContent = msg;
  t.classList.remove("toast-error");
  if (type === "error") {
    t.classList.add("toast-error");
    ico.className = "fa fa-triangle-exclamation";
  } else {
    ico.className = "fa fa-circle-check";
  }
  t.classList.add("show");
  clearTimeout(t._timer);
  t._timer = setTimeout(() => t.classList.remove("show"), 3500);
}

// ─── PAGES ───────────────────────────────────
function showPage(name) {
  // Guard admin page
  if (name === "admin" && !isAdminLoggedIn) {
    showPage("admin-login");
    return;
  }
  document.querySelectorAll(".page").forEach(p => p.classList.remove("active"));
  document.getElementById("page-" + name).classList.add("active");

  document.querySelectorAll(".nav-links a").forEach(a => a.classList.remove("active"));
  const navEl = document.getElementById("nav-" + name);
  if (navEl) navEl.classList.add("active");

  window.scrollTo({ top: 0, behavior: "smooth" });

  if (name === "products") renderProductsPage();
  if (name === "admin")    initAdmin();
  if (name === "checkout") updateCheckoutUI();
}

function requireAdminLogin() {
  if (isAdminLoggedIn) {
    showPage("admin");
  } else {
    // Reset login form
    document.getElementById("login-username").value = "";
    document.getElementById("login-password").value = "";
    document.getElementById("login-error").style.display = "none";
    clearFieldError("login-username");
    clearFieldError("login-password");
    showPage("admin-login");
  }
}

// ─── ADMIN LOGIN ─────────────────────────────
function handleAdminLogin(e) {
  e.preventDefault();
  let valid = true;

  const user = document.getElementById("login-username").value.trim();
  const pass = document.getElementById("login-password").value;

  // Validate fields first
  if (!user) {
    setFieldError("login-username", "Username is required");
    valid = false;
  } else {
    clearFieldError("login-username");
  }
  if (!pass) {
    setFieldError("login-password", "Password is required");
    valid = false;
  } else {
    clearFieldError("login-password");
  }
  if (!valid) return;

  // Check credentials
  const btn = document.getElementById("login-btn");
  btn.disabled = true;
  btn.querySelector(".btn-login-text").textContent = "Signing in…";

  setTimeout(() => {
    if (user === ADMIN_USER && pass === ADMIN_PASS) {
      isAdminLoggedIn = true;
      document.getElementById("login-error").style.display = "none";
      btn.disabled = false;
      btn.querySelector(".btn-login-text").textContent = "Sign In";
      showPage("admin");
      showToast("Welcome back, Umer Ahsan!");
    } else {
      // Wrong credentials
      isAdminLoggedIn = false;
      const errEl  = document.getElementById("login-error");
      const errMsg = document.getElementById("login-error-msg");

      if (user !== ADMIN_USER && pass !== ADMIN_PASS) {
        errMsg.textContent = "Incorrect username and password. Please try again.";
      } else if (user !== ADMIN_USER) {
        errMsg.textContent = "Username not found. Check your username and try again.";
      } else {
        errMsg.textContent = "Incorrect password. Please try again.";
      }
      errEl.style.display = "flex";

      // Shake the form
      errEl.style.animation = "none";
      void errEl.offsetWidth; // reflow
      errEl.style.animation = "";

      // Highlight wrong fields
      if (user !== ADMIN_USER) {
        const uEl = document.getElementById("login-username");
        uEl.classList.add("is-error");
        setFieldError("login-username", "Username not recognized");
      }
      if (pass !== ADMIN_PASS) {
        const pEl = document.getElementById("login-password");
        pEl.classList.add("is-error");
        setFieldError("login-password", "Password is incorrect");
        pEl.value = "";
      }

      btn.disabled = false;
      btn.querySelector(".btn-login-text").textContent = "Sign In";
    }
  }, 600);
}

function adminLogout() {
  isAdminLoggedIn = false;
  adminInitialized = false;
  showPage("home");
  showToast("Logged out successfully");
}

function togglePassword(btn) {
  const input = btn.parentElement.querySelector("input");
  const icon  = btn.querySelector("i");
  if (input.type === "password") {
    input.type = "text";
    icon.className = "fa fa-eye-slash";
  } else {
    input.type = "password";
    icon.className = "fa fa-eye";
  }
}

// ─── VALIDATION HELPERS ───────────────────────
function setFieldError(fieldId, msg) {
  const el  = document.getElementById(fieldId);
  const err = document.getElementById("err-" + fieldId);
  if (el)  { el.classList.add("is-error"); el.classList.remove("is-valid"); }
  if (err) err.textContent = msg;
}

function clearFieldError(fieldId) {
  const el  = document.getElementById(fieldId);
  const err = document.getElementById("err-" + fieldId);
  if (el)  { el.classList.remove("is-error"); }
  if (err && err.textContent) {
    err.textContent = "";
    if (el && el.value && el.value.trim()) el.classList.add("is-valid");
  }
}

function isValidEmail(email) {
  return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);
}

function isValidPhone(phone) {
  const cleaned = phone.replace(/\s/g, "");
  return /^0?3[0-9]{9}$/.test(cleaned);
}

function isValidCardNumber(num) {
  return num.replace(/\s/g, "").length === 16;
}

function isValidExpiry(exp) {
  if (!/^\d{2}\/\d{2}$/.test(exp)) return false;
  const [m, y] = exp.split("/").map(Number);
  if (m < 1 || m > 12) return false;
  const now = new Date();
  const fullYear = 2000 + y;
  if (fullYear < now.getFullYear()) return false;
  if (fullYear === now.getFullYear() && m < now.getMonth() + 1) return false;
  return true;
}

// ─── CART ─────────────────────────────────────
function cartCount()   { return cart.reduce((s, i) => s + i.qty, 0); }
function cartSubtotal(){ return cart.reduce((s, i) => s + i.price * i.qty, 0); }

function updateCartUI() {
  const count = cartCount();
  document.getElementById("cart-badge").textContent = count;
  document.getElementById("cart-count-label").textContent =
    count + " item" + (count !== 1 ? "s" : "");

  const container = document.getElementById("cart-items-container");

  if (cart.length === 0) {
    container.innerHTML = `
      <div class="cart-empty-state">
        <div class="cart-empty-icon"><i class="fa fa-bag-shopping"></i></div>
        <div class="cart-empty-text">Your bag is empty</div>
        <div class="cart-empty-sub">Add some kicks to get started</div>
      </div>`;
    document.getElementById("cart-footer").style.display = "none";
    return;
  }

  document.getElementById("cart-footer").style.display = "block";
  container.innerHTML = cart.map((item, idx) => `
    <div class="cart-drawer-item">
      <div class="cdi-img">
        <img src="${item.img}" alt="${item.name}"
          onerror="this.src='https://images.unsplash.com/photo-1542291026-7eec264c27ff?w=200&q=60'">
      </div>
      <div style="flex:1;min-width:0">
        <div class="cdi-name">${item.name}</div>
        <div class="cdi-meta">Size: ${item.size} &nbsp;|&nbsp; Qty: ${item.qty}</div>
        <div style="display:flex;align-items:center;gap:12px;margin-top:6px">
          <button onclick="updateCartQty(${idx},-1)" style="width:26px;height:26px;border:1px solid #ddd;background:#fff;font-size:16px;cursor:pointer;display:flex;align-items:center;justify-content:center">−</button>
          <span style="font-family:var(--font-head);font-size:18px">${item.qty}</span>
          <button onclick="updateCartQty(${idx},1)" style="width:26px;height:26px;border:1px solid #ddd;background:#fff;font-size:16px;cursor:pointer;display:flex;align-items:center;justify-content:center">+</button>
        </div>
        <div class="cdi-price">${pkr(item.price * item.qty)}</div>
      </div>
      <button class="cdi-remove" onclick="removeFromCart(${idx})" title="Remove">
        <i class="fa fa-xmark"></i>
      </button>
    </div>`).join("");

  const sub = cartSubtotal();
  const tax = sub * 0.17;
  document.getElementById("cart-subtotal").textContent    = pkr(sub);
  document.getElementById("cart-tax-display").textContent = pkr(tax);
  document.getElementById("cart-total").textContent       = pkr(sub + tax);

  updateCheckoutUI();
}

function toggleCart() {
  document.getElementById("cart-overlay").classList.toggle("open");
  document.getElementById("cart-drawer").classList.toggle("open");
}

function removeFromCart(idx) {
  const name = cart[idx].name;
  cart.splice(idx, 1);
  updateCartUI();
  showToast(name + " removed from bag");
}

function updateCartQty(idx, delta) {
  cart[idx].qty = Math.max(1, cart[idx].qty + delta);
  updateCartUI();
}

function addToCart(product, size, qty) {
  size = size || product.sizes[0];
  qty  = qty  || 1;
  const existing = cart.find(i => i.id === product.id && i.size === size);
  if (existing) {
    existing.qty += qty;
  } else {
    cart.push({
      id:    product.id,
      name:  product.name,
      price: product.price,
      img:   product.imgs[0],
      size:  size,
      qty:   qty
    });
  }
  updateCartUI();
  showToast("Added to bag: " + product.name);
}

function addToCartById(id) {
  const p = products.find(p => p.id === id);
  if (p) addToCart(p, p.sizes[0], 1);
}

function addCurrentToCart() {
  if (!currentProduct) return;
  if (!selectedSize) {
    const errEl = document.getElementById("size-error-msg");
    errEl.style.display = "flex";
    errEl.style.animation = "none";
    void errEl.offsetWidth;
    errEl.style.animation = "";
    // scroll to sizes
    document.getElementById("detail-sizes").scrollIntoView({ behavior: "smooth", block: "center" });
    return;
  }
  document.getElementById("size-error-msg").style.display = "none";
  addToCart(currentProduct, selectedSize, currentQty);
}

function changeQty(delta) {
  currentQty = Math.max(1, currentQty + delta);
  document.getElementById("qty-display").textContent = currentQty;
}

// ─── PRODUCT CARD ─────────────────────────────
function createProductCard(p) {
  return `
    <div class="product-card" onclick="showProduct(${p.id})">
      ${p.badge ? `<div class="pc-badge ${p.badge === "NEW" ? "new" : ""}">${p.badge}</div>` : ""}
      <button class="pc-wishlist" onclick="event.stopPropagation();this.classList.toggle('active')">
        <i class="fa fa-heart"></i>
      </button>
      <div class="pc-img">
        <img src="${p.imgs[0]}" alt="${p.name}" loading="lazy"
          onerror="this.src='https://images.unsplash.com/photo-1542291026-7eec264c27ff?w=600&q=70'">
      </div>
      <div class="pc-body">
        <div class="pc-cat">${p.category}</div>
        <div class="pc-name">${p.name}</div>
        <div class="pc-subtitle">${p.subtitle}</div>
        <div class="pc-price-row">
          <span class="pc-price">${pkr(p.price)}</span>
          ${p.oldPrice ? `<span class="pc-old-price">${pkr(p.oldPrice)}</span>` : ""}
        </div>
        <div class="pc-colors">
          ${p.colors.map(c => `
            <div class="pc-color" style="background:${c};border:2px solid ${c==='#fff'?'#ddd':'transparent'}"
              onclick="event.stopPropagation()"></div>`).join("")}
        </div>
        <button class="btn-pc-add"
          onclick="event.stopPropagation();addToCart(products[${p.id-1}],null,1)">
          Add to Bag
        </button>
      </div>
    </div>`;
}

// ─── HOME ─────────────────────────────────────
function renderHomeProducts() {
  const g = document.getElementById("home-products-grid");
  if (g) g.innerHTML = products.slice(0, 6).map(p => createProductCard(p)).join("");
}

// ─── PRODUCTS PAGE ────────────────────────────
function renderProductsPage() {
  const sort = document.getElementById("sort-select")?.value || "featured";
  let list = [...products];
  if (sort === "price-low")  list.sort((a, b) => a.price - b.price);
  if (sort === "price-high") list.sort((a, b) => b.price - a.price);
  if (sort === "newest")     list.reverse();
  const g = document.getElementById("products-grid");
  if (g) g.innerHTML = list.map(p => createProductCard(p)).join("");
  const c = document.getElementById("product-count");
  if (c) c.textContent = list.length;
}

function sortProducts() { renderProductsPage(); }

// ─── SINGLE PRODUCT ───────────────────────────
function showProduct(id) {
  currentProduct = products.find(p => p.id === id);
  currentQty = 1; selectedSize = null;
  if (!currentProduct) return;

  document.getElementById("detail-category").textContent    = currentProduct.category;
  document.getElementById("detail-name").textContent        = currentProduct.name;
  document.getElementById("detail-subtitle").textContent    = currentProduct.subtitle;
  document.getElementById("detail-rating").textContent      = currentProduct.rating;
  document.getElementById("detail-price").textContent       = pkr(currentProduct.price);
  document.getElementById("detail-description").textContent = currentProduct.desc;
  document.getElementById("qty-display").textContent        = "1";
  document.getElementById("size-error-msg").style.display   = "none";

  const oldEl  = document.getElementById("detail-old-price");
  const saveEl = document.getElementById("detail-save");
  if (currentProduct.oldPrice) {
    oldEl.textContent  = pkr(currentProduct.oldPrice);
    oldEl.classList.remove("hidden");
    const pct = Math.round((1 - currentProduct.price / currentProduct.oldPrice) * 100);
    saveEl.textContent = "SAVE " + pct + "%";
    saveEl.classList.remove("hidden");
  } else {
    oldEl.classList.add("hidden");
    saveEl.classList.add("hidden");
  }

  // Gallery
  document.getElementById("gallery-main-inner").innerHTML =
    `<img src="${currentProduct.imgs[0]}" alt="${currentProduct.name}"
       onerror="this.src='https://images.unsplash.com/photo-1542291026-7eec264c27ff?w=800&q=80'">`;

  document.getElementById("gallery-thumbs").innerHTML =
    currentProduct.imgs.map((img, i) => `
      <div class="g-thumb ${i===0?"active":""}" onclick="setGalleryImg(this,'${img}')">
        <img src="${img}" alt=""
          onerror="this.src='https://images.unsplash.com/photo-1542291026-7eec264c27ff?w=200&q=60'">
      </div>`).join("");

  document.getElementById("detail-colors").innerHTML =
    currentProduct.colors.map((c, i) => `
      <div class="color-swatch ${i===0?"active":""}"
           style="background:${c};${c==='#fff'?'border:2px solid #ccc!important;':''}"
           onclick="setActiveColor(this)"></div>`).join("");

  document.getElementById("detail-sizes").innerHTML =
    currentProduct.sizes.map(s => `
      <div class="sz-option" onclick="selectSize(this,'${s}')">${s}</div>`).join("");

  document.getElementById("single-wishlist").classList.remove("active");
  showPage("single");
}

function setGalleryImg(thumb, src) {
  document.getElementById("gallery-main-inner").innerHTML =
    `<img src="${src}" alt=""
       onerror="this.src='https://images.unsplash.com/photo-1542291026-7eec264c27ff?w=800&q=80'">`;
  document.querySelectorAll(".g-thumb").forEach(t => t.classList.remove("active"));
  thumb.classList.add("active");
}

function setActiveColor(el) {
  document.querySelectorAll(".color-swatch").forEach(s => s.classList.remove("active"));
  el.classList.add("active");
}

function selectSize(el, size) {
  document.querySelectorAll(".sz-option").forEach(s => s.classList.remove("active"));
  el.classList.add("active");
  selectedSize = size;
  document.getElementById("size-error-msg").style.display = "none";
}

function toggleWishlist() {
  const btn = document.getElementById("single-wishlist");
  btn.classList.toggle("active");
  showToast(btn.classList.contains("active") ? "Added to wishlist ♥" : "Removed from wishlist");
}

function toggleAccord(btn) {
  const body   = btn.nextElementSibling;
  const icon   = btn.querySelector("i");
  const isOpen = body.classList.contains("open");
  document.querySelectorAll(".accord-body").forEach(b => b.classList.remove("open"));
  document.querySelectorAll(".accord-btn i").forEach(i => i.className = "fa fa-plus");
  if (!isOpen) { body.classList.add("open"); icon.className = "fa fa-minus"; }
}

// ─── CHECKOUT UI UPDATE ───────────────────────
function updateCheckoutUI() {
  const container = document.getElementById("checkout-items");
  if (!container) return;

  const emptyWarning = document.getElementById("checkout-empty-warning");
  const placeBtn     = document.getElementById("btn-place-order");

  if (cart.length === 0) {
    container.innerHTML = `<p style="color:#aaa;font-size:14px;text-align:center;padding:24px 0">Your bag is empty</p>`;
    if (emptyWarning) emptyWarning.style.display = "flex";
    if (placeBtn)     placeBtn.style.opacity     = "0.5";
  } else {
    container.innerHTML = cart.map(item => `
      <div class="os-item">
        <div class="os-item-img">
          <img src="${item.img}" alt="${item.name}"
            onerror="this.src='https://images.unsplash.com/photo-1542291026-7eec264c27ff?w=200&q=60'">
        </div>
        <div style="flex:1;min-width:0">
          <div class="os-item-name">${item.name}</div>
          <div class="os-item-meta">Size: ${item.size} &nbsp;|&nbsp; Qty: ${item.qty}</div>
        </div>
        <div class="os-item-price">${pkr(item.price * item.qty)}</div>
      </div>`).join("");
    if (emptyWarning) emptyWarning.style.display = "none";
    if (placeBtn)     placeBtn.style.opacity     = "1";
  }

  const sub  = cartSubtotal();
  const tax  = sub * 0.17;
  const ship = sub === 0 ? 0 : (sub >= 15000 ? 0 : 350);

  document.getElementById("co-subtotal").textContent = pkr(sub);
  document.getElementById("co-shipping").textContent = sub === 0 ? "—" : (ship === 0 ? "FREE" : pkr(ship));
  document.getElementById("co-tax").textContent      = pkr(tax);
  document.getElementById("co-total").textContent    = pkr(sub + tax + ship);
}

function setPayment(el, type) {
  currentPaymentMethod = type;
  document.querySelectorAll(".pay-tab").forEach(t => t.classList.remove("active"));
  el.classList.add("active");
  document.getElementById("card-fields").style.display       = type === "card"       ? "block" : "none";
  document.getElementById("easypaisa-fields").style.display  = type === "easypaisa"  ? "block" : "none";
  document.getElementById("cod-fields").style.display        = type === "cod"        ? "block" : "none";
  // Clear card errors when switching payment
  ["co-card","co-expiry","co-cvv","co-cardholder","co-easypaisa"].forEach(id => clearFieldError(id));
}

function formatCard(input) {
  let v = input.value.replace(/\D/g, "").substring(0, 16);
  v = v.replace(/(.{4})/g, "$1 ").trim();
  input.value = v;
}

function formatExpiry(input) {
  let v = input.value.replace(/\D/g, "").substring(0, 4);
  if (v.length >= 2) v = v.substring(0, 2) + "/" + v.substring(2);
  input.value = v;
}

// ─── CHECKOUT VALIDATION ──────────────────────
function validateCheckout() {
  let valid = true;

  // Step 1: Contact
  const fname = document.getElementById("co-fname").value.trim();
  const lname = document.getElementById("co-lname").value.trim();
  const email = document.getElementById("co-email").value.trim();
  const phone = document.getElementById("co-phone").value.trim();

  if (!fname || fname.length < 2) {
    setFieldError("co-fname", "Please enter your first name (min 2 characters)"); valid = false;
  }
  if (!lname || lname.length < 2) {
    setFieldError("co-lname", "Please enter your last name (min 2 characters)"); valid = false;
  }
  if (!email) {
    setFieldError("co-email", "Email address is required"); valid = false;
  } else if (!isValidEmail(email)) {
    setFieldError("co-email", "Enter a valid email address (e.g. you@email.com)"); valid = false;
  }
  if (!phone) {
    setFieldError("co-phone", "Phone number is required"); valid = false;
  } else if (!isValidPhone(phone)) {
    setFieldError("co-phone", "Enter a valid Pakistani mobile number (e.g. 03001234567)"); valid = false;
  }

  // Step 2: Shipping
  const address  = document.getElementById("co-address").value.trim();
  const city     = document.getElementById("co-city").value.trim();
  const province = document.getElementById("co-province").value;

  if (!address || address.length < 5) {
    setFieldError("co-address", "Enter your complete delivery address"); valid = false;
  }
  if (!city || city.length < 2) {
    setFieldError("co-city", "City is required"); valid = false;
  }
  if (!province) {
    setFieldError("co-province", "Please select your province"); valid = false;
  }

  // Step 3: Payment
  if (currentPaymentMethod === "card") {
    const card       = document.getElementById("co-card").value.trim();
    const expiry     = document.getElementById("co-expiry").value.trim();
    const cvv        = document.getElementById("co-cvv").value.trim();
    const cardholder = document.getElementById("co-cardholder").value.trim();

    if (!card) {
      setFieldError("co-card", "Card number is required"); valid = false;
    } else if (!isValidCardNumber(card)) {
      setFieldError("co-card", "Enter a valid 16-digit card number"); valid = false;
    }
    if (!expiry) {
      setFieldError("co-expiry", "Expiry date is required"); valid = false;
    } else if (!isValidExpiry(expiry)) {
      setFieldError("co-expiry", "Enter a valid future expiry date (MM/YY)"); valid = false;
    }
    if (!cvv) {
      setFieldError("co-cvv", "CVV is required"); valid = false;
    } else if (cvv.length < 3) {
      setFieldError("co-cvv", "CVV must be 3–4 digits"); valid = false;
    }
    if (!cardholder || cardholder.length < 3) {
      setFieldError("co-cardholder", "Enter the name on your card"); valid = false;
    }
  }

  if (currentPaymentMethod === "easypaisa") {
    const epNum = document.getElementById("co-easypaisa").value.trim();
    if (!epNum) {
      setFieldError("co-easypaisa", "Easypaisa number is required"); valid = false;
    } else if (!isValidPhone(epNum)) {
      setFieldError("co-easypaisa", "Enter a valid Easypaisa number (e.g. 03001234567)"); valid = false;
    }
  }

  return valid;
}

// ─── PLACE ORDER ─────────────────────────────
function placeOrder() {
  if (cart.length === 0) {
    showToast("Your bag is empty — add some shoes first!", "error");
    return;
  }

  if (!validateCheckout()) {
    showToast("Please fix the errors above before placing your order.", "error");
    // Scroll to first error
    const firstErr = document.querySelector(".is-error");
    if (firstErr) firstErr.scrollIntoView({ behavior: "smooth", block: "center" });
    return;
  }

  const fname    = document.getElementById("co-fname").value.trim();
  const lname    = document.getElementById("co-lname").value.trim();
  const email    = document.getElementById("co-email").value.trim();
  const city     = document.getElementById("co-city").value.trim();
  const province = document.getElementById("co-province").value;

  const sub    = cartSubtotal();
  const tax    = sub * 0.17;
  const ship   = sub >= 15000 ? 0 : 350;
  const total  = sub + tax + ship;
  const newId  = "ORD-" + String(orders.length + 1).padStart(3, "0");
  const today  = new Date().toISOString().split("T")[0];

  // Add to orders
  orders.push({
    id:       newId,
    customer: fname + " " + lname,
    email,
    items:    cartCount(),
    subtotal: sub,
    total,
    status:   "Processing",
    date:     today
  });

  // Add order items
  cart.forEach((item, i) => {
    orderItems.push({
      id:        "ITEM-" + String(orderItems.length + 1).padStart(3, "0"),
      orderId:   newId,
      product:   item.name,
      size:      item.size,
      color:     "—",
      qty:       item.qty,
      unitPrice: item.price,
      total:     item.price * item.qty
    });
  });

  // Add user if new
  const existingUser = users.find(u => u.email === email);
  if (existingUser) {
    existingUser.orders++;
    existingUser.spent += total;
  } else {
    users.push({
      id:     "USR-" + String(users.length + 1).padStart(3, "0"),
      name:   fname + " " + lname,
      email,
      city:   city + ", " + province,
      orders: 1,
      spent:  total,
      joined: today
    });
  }

  // Show success modal
  const payLabel = { card: "Credit/Debit Card", easypaisa: "Easypaisa", cod: "Cash on Delivery" };
  document.getElementById("om-details").innerHTML = `
    <div class="om-detail-row"><span>Order ID</span><strong>${newId}</strong></div>
    <div class="om-detail-row"><span>Customer</span><strong>${fname} ${lname}</strong></div>
    <div class="om-detail-row"><span>Delivery City</span><strong>${city}, ${province}</strong></div>
    <div class="om-detail-row"><span>Payment</span><strong>${payLabel[currentPaymentMethod]}</strong></div>
    <div class="om-detail-row"><span>Items</span><strong>${cartCount()} item(s)</strong></div>
    <div class="om-detail-row"><span>Total Paid</span><strong style="color:var(--red)">${pkr(total)}</strong></div>
    <div class="om-detail-row"><span>Estimated Delivery</span><strong>3–5 business days</strong></div>`;

  document.getElementById("order-modal").style.display = "flex";

  // Clear cart & form
  cart = [];
  updateCartUI();
  adminInitialized = false; // refresh admin tables

  // Reset checkout form
  ["co-fname","co-lname","co-email","co-phone","co-address","co-city","co-postal",
   "co-card","co-expiry","co-cvv","co-cardholder","co-easypaisa"].forEach(id => {
    const el = document.getElementById(id);
    if (el) { el.value = ""; el.classList.remove("is-error","is-valid"); }
  });
  document.getElementById("co-province").value = "";
}

function closeOrderModal() {
  document.getElementById("order-modal").style.display = "none";
  showPage("home");
}

// ─── CONTACT FORM ─────────────────────────────
function submitContact(e) {
  e.preventDefault();
  let valid = true;

  const fname   = document.getElementById("cf-fname").value.trim();
  const lname   = document.getElementById("cf-lname").value.trim();
  const email   = document.getElementById("cf-email").value.trim();
  const message = document.getElementById("cf-message").value.trim();

  if (!fname || fname.length < 2) {
    setFieldError("cf-fname", "First name is required"); valid = false;
  }
  if (!lname || lname.length < 2) {
    setFieldError("cf-lname", "Last name is required"); valid = false;
  }
  if (!email) {
    setFieldError("cf-email", "Email address is required"); valid = false;
  } else if (!isValidEmail(email)) {
    setFieldError("cf-email", "Enter a valid email address"); valid = false;
  }
  if (!message || message.length < 10) {
    setFieldError("cf-message", "Message must be at least 10 characters"); valid = false;
  }

  if (!valid) { showToast("Please fix the form errors.", "error"); return; }

  const btn = e.target.querySelector("button[type=submit]");
  btn.innerHTML = '<i class="fa fa-circle-notch fa-spin"></i> Sending…';
  btn.disabled  = true;

  const subject = encodeURIComponent(document.getElementById("cf-subject").value);
  const body    = encodeURIComponent(
    "Name: " + fname + " " + lname +
    "\nEmail: " + email +
    "\nSubject: " + document.getElementById("cf-subject").value +
    "\n\n" + message
  );

  setTimeout(() => {
    window.open("mailto:umerahsan696@gmail.com?subject=" + subject + "&body=" + body, "_blank");
    const s = document.getElementById("submit-success");
    s.style.display = "flex"; s.classList.add("show");
    btn.innerHTML = '<i class="fa fa-circle-check"></i> Message Sent!';
    document.getElementById("contact-form").reset();
    document.querySelectorAll("#contact-form .is-valid").forEach(el => el.classList.remove("is-valid"));
  }, 900);
}

// ─── ADMIN ────────────────────────────────────
function statusBadge(s) {
  const m = { Delivered:"delivered", Shipped:"shipped", Processing:"processing", Pending:"pending", Cancelled:"cancelled" };
  return `<span class="status-badge status-${m[s]||"processing"}">${s}</span>`;
}

function initAdmin() {
  if (adminInitialized) return;
  adminInitialized = true;

  // Destroy old instances
  ["dashboard-orders-table","products-table","orders-table","order-items-table","users-table"].forEach(id => {
    if ($.fn.DataTable.isDataTable("#" + id)) $("#" + id).DataTable().destroy();
  });

  dtables.dashboard = $("#dashboard-orders-table").DataTable({
    data: orders.map(o => [o.id, o.customer, o.items + " item(s)", pkr(o.total), statusBadge(o.status), o.date]),
    pageLength: 5, order: [[5, "desc"]],
    columns: [{ title:"Order ID" },{ title:"Customer" },{ title:"Items" },{ title:"Amount" },{ title:"Status" },{ title:"Date" }]
  });

  dtables.products = $("#products-table").DataTable({
    data: products.map(p => [
      "#" + p.id,
      `<img src="${p.imgs[0]}" style="width:52px;height:52px;object-fit:cover;border-radius:2px" onerror="this.src='https://images.unsplash.com/photo-1542291026-7eec264c27ff?w=120&q=60'" alt="">`,
      p.name, p.category, pkr(p.price),
      p.stock > 20 ? p.stock : `<span style="color:#e63312;font-weight:700">${p.stock} ⚠</span>`,
      p.stock > 0 ? `<span class="status-badge status-delivered">In Stock</span>` : `<span class="status-badge status-cancelled">Out of Stock</span>`,
      `<button class="tbl-btn tbl-btn-edit" onclick="showToast('Edit: ${p.name}')">Edit</button><button class="tbl-btn tbl-btn-delete" onclick="showToast('Delete: ${p.name}')">Delete</button>`
    ]),
    pageLength: 10,
    columns: [
      { title:"ID" },{ title:"Image", orderable:false },{ title:"Name" },{ title:"Category" },
      { title:"Price (PKR)" },{ title:"Stock" },{ title:"Status", orderable:false },{ title:"Actions", orderable:false }
    ]
  });

  dtables.orders = $("#orders-table").DataTable({
    data: orders.map(o => [
      o.id, o.customer, o.email, o.items, pkr(o.subtotal), pkr(o.total),
      statusBadge(o.status), o.date,
      `<button class="tbl-btn tbl-btn-view" onclick="showToast('View: ${o.id}')">View</button>`
    ]),
    pageLength: 10,
    columns: [
      { title:"Order ID" },{ title:"Customer" },{ title:"Email" },{ title:"Items" },
      { title:"Subtotal" },{ title:"Total" },{ title:"Status", orderable:false },{ title:"Date" },{ title:"Actions", orderable:false }
    ]
  });

  dtables.items = $("#order-items-table").DataTable({
    data: orderItems.map(i => [i.id, i.orderId, i.product, i.size, i.color, i.qty, pkr(i.unitPrice), pkr(i.total)]),
    pageLength: 15,
    columns: [
      { title:"Item ID" },{ title:"Order ID" },{ title:"Product" },{ title:"Size" },
      { title:"Color" },{ title:"Qty" },{ title:"Unit Price" },{ title:"Total" }
    ]
  });

  dtables.users = $("#users-table").DataTable({
    data: users.map(u => [
      u.id, u.name, u.email, u.city, u.orders, pkr(u.spent), u.joined,
      `<button class="tbl-btn tbl-btn-view" onclick="showToast('View: ${u.name}')">View</button><button class="tbl-btn tbl-btn-edit" onclick="showToast('Edit: ${u.name}')">Edit</button>`
    ]),
    pageLength: 10,
    columns: [
      { title:"ID" },{ title:"Name" },{ title:"Email" },{ title:"City" },
      { title:"Orders" },{ title:"Total Spent" },{ title:"Joined" },{ title:"Actions", orderable:false }
    ]
  });
}

function showAdminTab(name, el) {
  document.querySelectorAll(".admin-tab").forEach(t => t.classList.remove("active"));
  document.getElementById("tab-" + name).classList.add("active");
  document.querySelectorAll(".admin-nav-item").forEach(n => n.classList.remove("active"));
  el.classList.add("active");
  const titles = { dashboard:"Dashboard", products:"Products", orders:"Orders", "order-items":"Order Items", users:"Users" };
  document.getElementById("admin-page-title").textContent = titles[name] || name;
  setTimeout(() => {
    const key = name === "order-items" ? "items" : name;
    if (dtables[key]) dtables[key].columns.adjust().draw();
  }, 60);
}

// ─── SIDEBAR SIZE PILLS ───────────────────────
document.addEventListener("DOMContentLoaded", () => {
  document.querySelectorAll(".sz").forEach(btn => {
    btn.addEventListener("click", function () { this.classList.toggle("active"); });
  });
  renderHomeProducts();
  renderProductsPage();
  updateCartUI();
});
