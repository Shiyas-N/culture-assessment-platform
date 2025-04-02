
document.addEventListener("DOMContentLoaded", function () {
    
  
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
  

  
