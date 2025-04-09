document.querySelectorAll(".publish-btn").forEach((button) => {
  button.addEventListener("click", function () {
    const surveyId = this.getAttribute("data-id");

    fetch(`../../api/survey_api.php`, {
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

          // Flip button label and status
          const newStatus =
            this.getAttribute("data-status") === "1" ? "0" : "1";
          this.setAttribute("data-status", newStatus);
          this.textContent = newStatus === "1" ? "Unpublish" : "Publish";

          this.classList.toggle("Publish");
          this.classList.toggle("Unpublish");
        } else {
          alert("Failed to update status.");
        }
      })
      .catch((err) => {
        console.error("Error toggling publish:", err);
        alert("Request failed.");
      });
  });
});
