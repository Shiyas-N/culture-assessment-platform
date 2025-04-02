document.addEventListener("DOMContentLoaded", function () {
    loadSurveys();

    document.getElementById("survey-form")?.addEventListener("submit", function (e) {
        e.preventDefault();
        const formData = new FormData(this);

        fetch("/api/survey_api.php?action=create", {
            method: "POST",
            body: formData,
        }).then(response => response.json()).then(data => {
            alert(data.message);
            if (data.success) location.href = "survey_list.php";
        });
    });
});

function loadSurveys() {
    fetch("/api/survey_api.php?action=fetch")
        .then(response => response.json())
        .then(data => {
            const tbody = document.getElementById("survey-list");
            tbody.innerHTML = data.map(survey => `
                <tr>
                    <td>${survey.id}</td>
                    <td>${survey.title}</td>
                    <td>${survey.issue}</td>
                    <td>${survey.deadline}</td>
                    <td>${survey.members_polled}</td>
                    <td><button onclick="publishSurvey(${survey.id})">Publish</button></td>
                </tr>
            `).join("");
        });
}

function publishSurvey(surveyId) {
    fetch(`/api/survey_api.php?action=publish&id=${surveyId}`)
        .then(response => response.json())
        .then(data => {
            alert(data.message);
            loadSurveys();
        });
}
