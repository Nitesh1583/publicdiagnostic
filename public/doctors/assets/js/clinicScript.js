document.addEventListener("DOMContentLoaded", () => {
  // ===== HEADER / SIDEBAR HANDLERS (your existing code) =====
  lucide.createIcons();

  const menuToggle = document.getElementById("menuToggle");
  const sidebar = document.getElementById("sidebar");
  const overlay = document.getElementById("overlay");
  const closeSidebar = document.getElementById("closeSidebar");

  if (menuToggle && sidebar && overlay && closeSidebar) {
    menuToggle.addEventListener("click", () => {
      sidebar.classList.add("open");
      overlay.classList.add("show");
    });

    overlay.addEventListener("click", () => {
      sidebar.classList.remove("open");
      overlay.classList.remove("show");
    });

    closeSidebar.addEventListener("click", () => {
      sidebar.classList.remove("open");
      overlay.classList.remove("show");
    });
  }

  // ===== FAB MENU =====
  const fabBtn = document.getElementById("fabBtn");
  const fabMenu = document.getElementById("fabMenu");

  if (fabBtn && fabMenu) {
    let open = false;
    fabBtn.addEventListener("click", () => {
      open = !open;
      fabMenu.classList.toggle("show", open);
      fabBtn.innerHTML = open
        ? '<i data-lucide="x"></i>'
        : '<i data-lucide="plus"></i>';
      lucide.createIcons();
    });
  }

  // ===== TAB BAR (Menu / Schedule) =====
  const menuTab = document.getElementById("menuTab");
  const scheduleTab = document.getElementById("scheduleTab");
  const servicesSection = document.getElementById("services");
  const scheduleSection = document.getElementById("schedule");

  if (menuTab && scheduleTab && servicesSection && scheduleSection) {
    menuTab.addEventListener("click", () => {
      menuTab.classList.add("active");
      menuTab.classList.remove("inactive");
      scheduleTab.classList.add("inactive");
      scheduleTab.classList.remove("active");

      servicesSection.classList.add("active");
      scheduleSection.classList.remove("active");
    });

    scheduleTab.addEventListener("click", () => {
      scheduleTab.classList.add("active");
      scheduleTab.classList.remove("inactive");
      menuTab.classList.add("inactive");
      menuTab.classList.remove("active");

      scheduleSection.classList.add("active");
      servicesSection.classList.remove("active");
    });
  }

  // ===== SCHEDULE INNER TABS =====
  const tabs = document.querySelectorAll(".schedule_section-tab");
  const contents = document.querySelectorAll(".schedule_section-tab-content");

  if (tabs.length && contents.length) {
    tabs.forEach((tab) => {
      tab.addEventListener("click", () => {
        tabs.forEach((t) => t.classList.remove("active"));
        contents.forEach((c) => c.classList.remove("active"));

        tab.classList.add("active");
        const target = document.getElementById(tab.dataset.target);
        if (target) target.classList.add("active");
      });
    });
  }
});
