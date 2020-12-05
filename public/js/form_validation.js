//Get all the inputs...
const inputs = document.querySelectorAll("input, select, textarea");
// Loop through them...
for (let input of inputs) {
  // Just before submit, the invalid event will fire, let's apply our class there.
  input.addEventListener(
    "invalid",
    (event) => {
      input.classList.add("error");
    },
    false
  );

  // Optional: Check validity onblur
  input.addEventListener("blur", (event) => {
    input.checkValidity();
  });
}

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
});

input_email.addEventListener("invalid", function (event) {
  if (event.target.validity.valueMissing) {
    event.target.setCustomValidity("Please enter your email!");
  } else if (event.target.validity.patternMismatch) {
    event.target.setCustomValidity("Email format incorrect.");
  }
});

input_name.addEventListener("change", function (event) {
  event.target.setCustomValidity("");
});
input_email.addEventListener("change", function (event) {
  event.target.setCustomValidity("");
});
