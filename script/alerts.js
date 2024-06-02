document.addEventListener("DOMContentLoaded", () => {
  const exitBtn = document.getElementById("exitBtn");

  if (exitBtn) {
    exitBtn.addEventListener("click", (e) => {
      e.preventDefault();

      if (confirm("Вы действительно хотите выйти?")) {

        // console.log(e.currentTarget.href);
        location.href = e.currentTarget.href;
      }
    });
  }
});
