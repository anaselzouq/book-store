window.addToCart = function (bookId, element) {
    const alertBox = document.getElementById("cart-alert");
    const cartCount = document.getElementById("cart-count");
    const icon = element.querySelector("i");

    if (icon) {
        icon.classList.remove("fa-shopping-cart");
        icon.classList.add("fa-spinner", "fa-spin");
        icon.style.color = "#007bff";
    }

    fetch(`/add-to-cart/${bookId}`, {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content"),
            "Accept": "application/json"
        },
        body: JSON.stringify({})
    })
        .then((response) => response.json())
        .then((data) => {
            if (data.status === "success") {
                alertBox.innerHTML = `<i class="fas fa-check-circle me-2"></i> تم إضافة الكتاب إلى السلة!`;
                alertBox.style.backgroundColor = "#d1e7dd";
                alertBox.style.color = "#0f5132";
                alertBox.style.display = "flex";

                if (cartCount && data.cartCount !== undefined) {
                    cartCount.innerText = data.cartCount;
                    cartCount.classList.toggle("d-none", data.cartCount <= 0);
                }

                if (icon) {
                    icon.classList.remove("fa-spinner", "fa-spin");
                    icon.classList.add("fa-check");
                    icon.style.color = "green";
                }
            } else {
                throw new Error("فشل الإضافة");
            }
        })
        .catch((error) => {
            alertBox.innerHTML = `❌ لم يتم الإضافة إلى السلة!`;
            alertBox.style.backgroundColor = "#f8d7da";
            alertBox.style.color = "#842029";
            alertBox.style.display = "flex";

            if (icon) {
                icon.classList.remove("fa-spinner", "fa-spin");
                icon.classList.add("fa-shopping-cart");
                icon.style.color = "red";
            }
        });

    setTimeout(() => {
        alertBox.style.display = "none";
        if (icon) {
            icon.classList.remove("fa-check", "fa-spinner", "fa-spin");
            icon.classList.add("fa-shopping-cart");
            icon.style.color = "";
        }
    }, 5000);
};

let msgsearch = document.getElementById("notfoundmessage");

setTimeout(() => {
    if (msgsearch) {
        msgsearch.style.display = "none";
    }
},3000)
