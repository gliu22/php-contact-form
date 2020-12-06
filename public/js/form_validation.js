const input_name = document.querySelector('input[name="name"]');
const input_email = document.querySelector('input[name="email"]');

input_name.addEventListener("invalid", function (event) {
  if (event.target.validity.valueMissing) {
    event.target.setCustomValidity("Please enter your name!");
  } else if (event.target.validity.patternMismatch) {
    event.target.setCustomValidity(
      "Name format incorrect. Special characters and numbers not allowed."
    );
  }
  event.target.setAttribute("aria-invalid", "true");
});

input_email.addEventListener("invalid", function (event) {
  if (event.target.validity.valueMissing) {
    event.target.setCustomValidity("Please enter your email!");
  } else if (event.target.validity.patternMismatch) {
    event.target.setCustomValidity("Email format incorrect.");
  }
  event.target.setAttribute("aria-invalid", "true");
});

input_name.addEventListener("change", function (event) {
  event.target.setCustomValidity("");
  event.target.removeAttribute("aria-invalid");
});

input_email.addEventListener("change", function (event) {
  event.target.setCustomValidity("");
  event.target.removeAttribute("aria-invalid");
});
