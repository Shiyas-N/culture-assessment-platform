document.addEventListener("DOMContentLoaded", () => {
  document.querySelectorAll("#publish").forEach((button) => {
    button.addEventListener("click", function () {
      const surveyId = this.getAttribute("data-id");
      const currentStatus = this.getAttribute("data-status");

      fetch("../../api/survey_api.php", {
        method: "PATCH",
        headers: {
          "Content-Type": "application/json",
        },
        body: JSON.stringify({
          action: "toggle",
          id: surveyId,
        }),
      })
        .then((response) => response.json())
        .then((data) => {
          if (data.success) {
            alert(data.message);

            const newStatus = currentStatus === "1" ? "0" : "1";
            this.setAttribute("data-status", newStatus);
            this.textContent = newStatus === "1" ? "Unpublish" : "Publish";

            this.classList.toggle("publish");
            this.classList.toggle("unpublish");
          } else {
            alert("Failed to update status.");
            console.error(data.error || "Unknown error");
          }
        })
        .catch((err) => {
          console.error("Error toggling publish:", err);
          alert("Request failed.");
        });
    });
  });

  document.querySelectorAll(".delete").forEach((btn) => {
    btn.addEventListener("click", () => {
      const surveyId = btn.getAttribute("data-id");

      if (!confirm("Are you sure you want to delete this survey?")) return;

      fetch(`../../api/survey_api.php?id=${surveyId}`, {
        method: "DELETE",
      })
        .then((response) => response.json())
        .then((data) => {
          if (!data.success) {
            alert("❌ Failed to delete survey.");
            console.error(data.error || "Unknown error");
          }
          location.reload();
        })
        .catch((error) => {
          alert("❌ Error deleting survey.");
          console.error(error);
        });
    });
  });
});
