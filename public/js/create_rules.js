function getSurveyIdFromURL() {
  const params = new URLSearchParams(window.location.search);
  return params.get("survey_id");
}

const surveyId = getSurveyIdFromURL();

document.addEventListener("DOMContentLoaded", async function () {
  const conditionsContainer = document.getElementById("conditionsContainer");
  const addConditionBtn = document.getElementById("addConditionBtn");

  let questions = [];
  let answers = [];

  async function fetchQuestions() {
    const res = await fetch(
      `../../api/question_survey_api.php?survey_id=${surveyId}`
    );
    const data = await res.json();
    questions = Array.isArray(data) ? data : [];
  }

  async function fetchAnswers() {
    const res = await fetch("../../api/answer_option_api.php");
    const data = await res.json();
    answers = Array.isArray(data) ? data : [];
  }

  await Promise.all([fetchQuestions(), fetchAnswers()]);

  function createConditionRow() {
    const div = document.createElement("div");
    div.classList.add("condition");

    const questionSelect = document.createElement("select");
    questionSelect.name = "question_id";
    questions.forEach((q) => {
      const opt = document.createElement("option");
      opt.value = q.id;
      opt.textContent = q.text;
      questionSelect.appendChild(opt);
    });

    const answerSelect = document.createElement("select");
    answerSelect.name = "answer_option_id";
    answers.forEach((a) => {
      const opt = document.createElement("option");
      opt.value = a.id;
      opt.textContent = a.answer_text;
      answerSelect.appendChild(opt);
    });

    const operatorSelect = document.createElement("select");
    operatorSelect.name = "logic_operator";
    ["AND", "OR"].forEach((op) => {
      const opt = document.createElement("option");
      opt.value = op;
      opt.textContent = op;
      operatorSelect.appendChild(opt);
    });

    const deleteBtn = document.createElement("button");
    deleteBtn.type = "button";
    deleteBtn.textContent = "Remove";
    deleteBtn.classList.add("delete-condition");
    deleteBtn.addEventListener("click", function () {
      div.remove();
    });

    div.append(
      "Question: ",
      questionSelect,
      " Answer: ",
      answerSelect,
      " Operator: ",
      operatorSelect,
      " ",
      deleteBtn
    );
    conditionsContainer.appendChild(div);
    return div;
  }

  createConditionRow();

  addConditionBtn.addEventListener("click", createConditionRow);

  document
    .getElementById("createRuleForm")
    .addEventListener("submit", function (e) {
      e.preventDefault();

      const conditions = document.querySelectorAll(".condition");
      if (conditions.length === 0) {
        alert("Please add at least one condition");
        return;
      }

      const ruleName = this.rule_name.value;
      const ruleType = this.rule_type.value;

      const submitBtn = this.querySelector('button[type="submit"]');
      const originalText = submitBtn.textContent;
      submitBtn.disabled = true;
      submitBtn.textContent = "Creating...";

      fetch("../../api/rule_api.php", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({
          rule_name: ruleName,
          rule_type: ruleType,
          survey_id: surveyId,
        }),
      })
        .then((res) => res.json())
        .then((data) => {
          if (data.success && data.rule_id) {
            const ruleId = data.rule_id;

            const conditionPromises = [];
            const conditionData = [];

            conditions.forEach((row) => {
              const condition = {
                rule_id: ruleId,
                question_id: row.querySelector("select[name='question_id']")
                  .value,
                answer_option_id: row.querySelector(
                  "select[name='answer_option_id']"
                ).value,
                logic_operator: row.querySelector(
                  "select[name='logic_operator']"
                ).value,
              };

              conditionData.push(condition);

              conditionPromises.push(
                fetch("../../api/rule_condition_api.php", {
                  method: "POST",
                  headers: { "Content-Type": "application/json" },
                  body: JSON.stringify(condition),
                }).then((res) => res.json())
              );
            });

            Promise.all(conditionPromises)
              .then((results) => {
                const failures = results.filter((result) => !result.success);
                if (failures.length > 0) {
                  console.error("Some conditions failed:", failures);
                  alert(
                    `Rule created but ${failures.length} conditions failed to save.`
                  );
                } else {
                  alert("Rule Created Successfully");
                  window.location.href = `survey_rules.php?survey_id=${surveyId}`;
                }
              })
              .catch((err) => {
                console.error("Condition creation error:", err);
                fetch(`../../api/rule_api.php?id=${ruleId}`, {
                  method: "DELETE",
                });
                alert("Error creating conditions. Rule has been rolled back.");
              })
              .finally(() => {
                submitBtn.disabled = false;
                submitBtn.textContent = originalText;
              });
          } else {
            alert("Error creating rule.");
            submitBtn.disabled = false;
            submitBtn.textContent = originalText;
          }
        })
        .catch((err) => {
          console.error("Rule creation error:", err);
          alert("Error connecting to the server.");
          submitBtn.disabled = false;
          submitBtn.textContent = originalText;
        });
    });
});
