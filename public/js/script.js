document.addEventListener("DOMContentLoaded", function () {
  document
    .getElementById("createRuleForm")
    .addEventListener("submit", function (e) {
      e.preventDefault();

      const formData = new FormData(this);
      fetch("../../api/rule_api.php", {
        method: "POST",
        body: formData,
      })
        .then((response) => response.json())
        .then((data) => {
          if (data.success) {
            alert("Rule Created Successfully");
            location.reload();
          } else {
            alert("Error Creating Rule");
          }
        });
    });

  document.querySelectorAll(".deleteRule").forEach((button) => {
    button.addEventListener("click", function () {
      const ruleId = this.getAttribute("data-id");

      fetch(`../../api/rule_api.php?id=${ruleId}`, { method: "DELETE" })
        .then((response) => response.json())
        .then((data) => {
          if (data.success) {
            alert("Rule Deleted Successfully");
            location.reload();
          } else {
            alert("Error Deleting Rule");
          }
        });
    });
  });
});
