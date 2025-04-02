document.addEventListener("DOMContentLoaded", function () {
  document
    .getElementById("createRuleForm")
    .addEventListener("submit", function (e) {
      e.preventDefault();

      const formData = new FormData(this);
      fetch("../../api/rule_api.php", {
        method: "POST",
        body: formData,
      }).then((success) => {
          if (success) {
            alert("Rule Created Successfully");
            window.location.href = "survey_rules.php";
          } else {
            alert("Error Creating Rule");
          }
        });
    });

 
  
});
