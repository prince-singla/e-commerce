function scrollSlider(id, direction) {
    const el = document.getElementById(id);
    if (!el) return;

    const scrollAmount = 600;
    el.scrollBy({
        left: direction * scrollAmount,
        behavior: "smooth"
    });
}

/* Back To Top Button */
document.addEventListener("DOMContentLoaded", function () {
    const btn = document.getElementById("backToTop");

    if (!btn) return;

    window.addEventListener("scroll", function () {
        if (window.scrollY > 400) {
            btn.style.display = "flex";
        } else {
            btn.style.display = "none";
        }
    });

    btn.addEventListener("click", function () {
        window.scrollTo({
            top: 0,
            behavior: "smooth"
        });
    });
});
document.addEventListener("DOMContentLoaded", function () {

    const btn = document.getElementById("ajaxAddToCartBtn");
    const badge = document.getElementById("cartCountBadge");

    if (!btn) return;

    btn.addEventListener("click", async function () {

        const productId = btn.getAttribute("data-product-id");

        btn.disabled = true;
        const oldHTML = btn.innerHTML;
        btn.innerHTML = "Adding...";

        try {

            const res = await fetch(BASE_URL + "cart/ajax_add", {
                method: "POST",
                headers: {
                    "Content-Type": "application/x-www-form-urlencoded"
                },
                body: "product_id=" + encodeURIComponent(productId)
            });

            const data = await res.json();

            if (data.status) {

                if (badge) badge.innerText = data.cart_count;

                btn.innerHTML = `<i class="bi bi-check-circle"></i> Added`;
                setTimeout(() => {
                    btn.innerHTML = oldHTML;
                    btn.disabled = false;
                }, 1200);

            } else {
                alert(data.message || "Something went wrong");
                btn.innerHTML = oldHTML;
                btn.disabled = false;
            }

        } catch (err) {
            alert("Network error");
            btn.innerHTML = oldHTML;
            btn.disabled = false;
        }
    });

});
