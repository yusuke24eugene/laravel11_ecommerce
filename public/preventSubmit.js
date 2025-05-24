const input = document.querySelector("#input");
const form = document.querySelector("#form");

form.addEventListener("submit", (e) => {
    if (!input.value) {
        e.preventDefault();
    }
});
