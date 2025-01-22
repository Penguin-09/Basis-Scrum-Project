const inputGoalText = document.querySelector('[data-inputGoal="text"]');
const inputGoalButton = document.querySelector('[data-inputGoal="button"]');

export function storeUserWeekGoalInput() {
    inputGoalButton.addEventListener('click', (event) => {
        event.preventDefault();
        const inputGoalValue = inputGoalText.value;
        
        // ! Process user week goal input, bijvoorbeeld in localstorage
        if (inputGoalValue.length) {
            console.log(inputGoalValue);
        }
    })
}

export function fetchGoals() {
    fetch('../json/weekGoals.json')
        .then(response => {
            if (!response.ok) {
                throw new Error("Bad network response");
            }
            return response.json();
        })
        .then(json => displayGoals(json.goals))
        .catch(error => console.error(error));
}


async function displayGoals(goals) {
    const goalList = document.querySelector('[data-form="goal-list"]');
    console.log(goals);
    goals.forEach(goal => {
        const goalListItem = document.createElement('li');
        goalListItem.classList.add("my-3", "flex", "flex-row-reverse", "justify-between");
        goalListItem.innerHTML = `
            <input type="checkbox" class="mr-5">
                <label for="" class="">${goal}<label>
            <button class="remove-goal-item-btn">x</button>
        `
        goalList.appendChild(goalListItem);
    });
}