document.addEventListener("DOMContentLoaded", function () {
  document.querySelectorAll(".deleteRule").forEach((button) => {
    button.addEventListener("click", function () {
      const ruleId = this.getAttribute("data-id");

      const params = new URLSearchParams(window.location.search);
      const surveyId = params.get("survey_id");

      fetch(`../../api/rule_api.php?id=${ruleId}`, { method: "DELETE" })
        .then((res) => res.json())
        .then((response) => {
          if (response.success) {
            alert("Rule Deleted Successfully");
            location.href = `survey_rules.php?survey_id=${surveyId}`;
          } else {
            alert("Error Deleting Rule");
          }
        });
    });
  });
});

document.querySelectorAll(".editRule").forEach((button) => {
  button.addEventListener("click", function () {
    const ruleId = this.getAttribute("data-id");

    window.location.href = `rule_edit.php?id=${ruleId}&survey_id=${surveyId}`;
  });
});
