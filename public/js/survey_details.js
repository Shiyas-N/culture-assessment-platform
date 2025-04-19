const urlParams = new URLSearchParams(window.location.search);
const surveyId = urlParams.get("id");

function deleteQuestion(questionId) {
  if (confirm("Are you sure you want to delete this question?")) {
    console.log("Deleting question with ID:", questionId);

    fetch("../../api/question_survey_api.php", {
      method: "DELETE",
      headers: {
        "Content-Type": "application/json",
      },
      body: JSON.stringify({
        survey_id: surveyId,
        question_id: questionId,
      }),
    })
      .then((response) => response.json())
      .then((data) => {
        if (data.success) {
          window.location.reload();
        } else {
          alert(
            "Error deleting question: " + (data.message || "Unknown error")
          );
        }
      })
      .catch((error) => {
        console.error("Error:", error);
        alert("An error occurred while deleting the question.");
      });
  }
}
