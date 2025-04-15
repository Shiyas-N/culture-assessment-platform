document.addEventListener("DOMContentLoaded", () => {
  const container = document.getElementById("value-container");
  const addButton = document.getElementById("add-button");
  const form = document.getElementById("ruleForm");

  let culturalValues = [];

  fetch("../../api/cultural_value_api.php")
    .then((res) => res.json())
    .then((data) => {
      culturalValues = data;
      addValueSet();
    });

  addButton.addEventListener("click", addValueSet);

  function addValueSet() {
    const div = document.createElement("div");
    div.classList.add("value-set");

    const select = document.createElement("select");
    select.name = "cultural_id[]";

    culturalValues.forEach((value) => {
      const option = document.createElement("option");
      option.value = value.id;
      option.textContent = value.value_name;
      select.appendChild(option);
    });

    const input = document.createElement("input");
    input.type = "number";
    input.name = "points[]";
    input.placeholder = "Points";
    input.required = true;

    const removeBtn = document.createElement("button");
    removeBtn.type = "button";
    removeBtn.textContent = "Remove";
    removeBtn.onclick = () => div.remove();

    div.appendChild(select);
    div.appendChild(input);
    div.appendChild(removeBtn);

    container.appendChild(div);
  }

  form.addEventListener("submit", function (e) {
    e.preventDefault();

    const ruleId = RULE_ID;
    const selects = document.querySelectorAll("select[name='cultural_id[]']");
    const points = document.querySelectorAll("input[name='points[]']");
    const surveyId = SURVEY_ID;

    const data = [];

    selects.forEach((select, i) => {
      data.push({
        rule_id: ruleId,
        cultural_id: select.value,
        points: points[i].value,
      });
    });

    Promise.all(
      data.map((entry) =>
        fetch("../../api/rule_cultural_value_api.php", {
          method: "POST",
          headers: {
            "Content-Type": "application/json",
          },
          body: JSON.stringify(entry),
        }).then((res) => res.json())
      )
    )
      .then((responses) => {
        alert("Submission Successful!");
        window.location.href = `survey_rules.php?survey_id=${surveyId}`;
        console.log(responses);
      })
      .catch((err) => {
        resultDiv.innerHTML =
          "<p style='color: red;'>Error submitting form.</p>";
        console.error(err);
      });
  });
});
