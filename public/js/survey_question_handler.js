document.addEventListener("DOMContentLoaded", function () {
  const form = document.getElementById("surveyQuestionForm");
  const customQuestionInput = document.getElementById("customQuestion");
  const customList = document.getElementById("customQuestionsList");
  const selectedQuestionsList = document.getElementById(
    "selectedQuestionsList"
  );
  const existingSelect = document.getElementById("existingQuestions");

  const selectedQuestions = new Map();
  const customQuestions = [];

  function renderSelectedQuestions() {
    selectedQuestionsList.innerHTML = "";

    selectedQuestions.forEach((text, id) => {
      const li = document.createElement("li");
      li.textContent = text;

      const removeBtn = document.createElement("button");
      removeBtn.textContent = "❌";
      removeBtn.style.marginLeft = "10px";
      removeBtn.onclick = () => {
        selectedQuestions.delete(id);
        renderSelectedQuestions();

        const option = existingSelect.querySelector(`option[value="${id}"]`);
        if (option) option.selected = false;
      };

      li.appendChild(removeBtn);
      selectedQuestionsList.appendChild(li);
    });
  }

  existingSelect.addEventListener("change", () => {
    Array.from(existingSelect.selectedOptions).forEach((opt) => {
      const id = opt.value;
      const text = opt.text;
      selectedQuestions.set(id, text);
    });
    renderSelectedQuestions();
  });

  document
    .getElementById("addCustomQuestion")
    .addEventListener("click", async () => {
      const question = customQuestionInput.value.trim();
      if (question === "") return;

      try {
        const res = await fetch("../../api/question_api.php", {
          method: "POST",
          headers: { "Content-Type": "application/json" },
          body: JSON.stringify({ question }),
        });

        const data = await res.json();

        if (data.success && data.question_id) {
          selectedQuestions.set(data.question_id, question);
          renderSelectedQuestions();
          customQuestionInput.value = "";
        } else {
          alert("Failed to create custom question");
        }
      } catch (err) {
        console.error("Error adding custom question:", err);
        alert("Error creating custom question");
      }
    });

  form.addEventListener("submit", async function (e) {
    e.preventDefault();

    const params = new URLSearchParams(window.location.search);
    const surveyId = params.get("survey_id");

    console.log(surveyId);
    const entries = Array.from(selectedQuestions.entries());

    const promises = entries.map(([id]) =>
      fetch("../../api/question_survey_api.php", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({ survey_id: surveyId, question_id: id }),
      })
    );

    Promise.all(promises)
      .then(() => {
        alert("Questions saved successfully!");
        window.location.href = `survey_rules.php?survey_id=${surveyId}`;
      })
      .catch((err) => {
        console.error(err);
        alert("Error saving questions");
      });
  });
});
