 // Elements
      const openBtn = document.querySelector(".add_payment_detail");
      const closeBtn = document.getElementById("addPaymentClose");
      const popup = document.getElementById("addPaymentPopup");
      const overlay = document.querySelector(".add_payment_popup-overlay");

      // Open popup
      openBtn.addEventListener("click", () => {
        popup.classList.add("active");
      });

      // Close popup
      closeBtn.addEventListener("click", () => {
        popup.classList.remove("active");
      });

      // Close on overlay click
      overlay.addEventListener("click", (e) => {
        if (e.target === overlay) {
          popup.classList.remove("active");
        }
      });

      // Close on Escape
      document.addEventListener("keydown", (e) => {
        if (e.key === "Escape" && popup.classList.contains("active")) {
          popup.classList.remove("active");
        }
      });

      // Save Button
      document
        .querySelector(".add_payment_save-btn")
        .addEventListener("click", () => {
          alert("Payment details saved!");
          popup.classList.remove("active");
        });
