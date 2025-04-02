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

 
  
});
