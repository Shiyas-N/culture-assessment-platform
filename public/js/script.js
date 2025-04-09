document.addEventListener("DOMContentLoaded", function() {
    const createSurveyBtn = document.querySelector(".create-survey");

    createSurveyBtn.addEventListener("click", function() {
        alert("Redirect to survey creation form");
        window.location.href = "survey_create.php";
    });
});