document.addEventListener("DOMContentLoaded", function () {
  const form = document.getElementById("survey-form");

  form.addEventListener("submit", function (e) {
    e.preventDefault();

    const title = document.getElementById("title").value;
    const issue = document.getElementById("issue").value;
    const deadline = document.getElementById("deadline").value;
    const description = document.getElementById("description").value;
    const experience = document.getElementById("experience").value;

    fetch("../../api/survey_api.php", {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
      },
      body: JSON.stringify({
        action: "create",
        title,
        issue,
        deadline,
        description,
        experience,
      }),
    })
      .then((res) => res.json())
      .then((data) => {
        if (data.success) {
          alert(data.message);
          form.reset();
          window.location.href = "dashboard.php";
        } else {
          alert("Failed to create survey: " + data.message);
        }
      })
      .catch((err) => {
        console.error("Error:", err);
        alert("An error occurred while creating the survey.");
      });
  });
});

