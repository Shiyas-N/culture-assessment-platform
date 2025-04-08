    const addedQuestions = new Map(); // Use Map to store both existing and new

    function addSelectedQuestion() {
        const dropdown = document.getElementById('existing_qid');
        const selectedId = dropdown.value;
        const questionList = document.querySelector('#question-list ul');

        if (selectedId && questions[selectedId]) {
            const key = 'existing_' + selectedId;
            if (!addedQuestions.has(key)) {
                addedQuestions.set(key, questions[selectedId]);

                const li = document.createElement('li');
                li.textContent = questions[selectedId];
                questionList.appendChild(li);
            } else {
                alert("Question already added.");
            }
        } else {
            alert("Please select a question first.");
        }
    }

    function addNewQuestion() {
        const input = document.getElementById('new_question_input');
        const text = input.value.trim();
        const questionList = document.querySelector('#question-list ul');

        if (text) {
            const key = 'new_' + text;
            if (!addedQuestions.has(key)) {
                addedQuestions.set(key, text);

                const li = document.createElement('li');
                li.textContent = text;
                questionList.appendChild(li);

                input.value = '';
            } else {
                alert("This question is already added.");
            }
        } else {
            alert("Please enter a new question.");
        }
    }

    function prepareSubmit() {
        const hiddenInput = document.getElementById('final_questions');
        const values = Array.from(addedQuestions.values());
    
        if (values.length === 0) {
            alert("Please add at least one question.");
            return false;
        }
    
        hiddenInput.value = JSON.stringify(values);
        return true;
    }
    