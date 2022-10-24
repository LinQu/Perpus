const btnEdit = document.getElementById("btnEdit");
const btnsubmit = document.getElementById("btnSubmit");

function showForm() {}

btnEdit.addEventListener("click", () => {
  const form = document.getElementById("form");
  console.log(form);

  if (form.style.display === "none") {
    // 👇️ this SHOWS the form
    form.style.display = "block";
  } else {
    // 👇️ this HIDES the form
    form.style.display = "none";
  }
});

btnsubmit.addEventListener("click", () => {
  const form = document.getElementById("form");
  console.log(form);

  if (form.style.display === "none") {
    // 👇️ this SHOWS the form
    form.style.display = "block";
  } else {
    // 👇️ this HIDES the form
    form.style.display = "none";
  }
});
