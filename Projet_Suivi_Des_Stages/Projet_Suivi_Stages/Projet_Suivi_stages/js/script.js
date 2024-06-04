var passwordInput = document.getElementById("mdp");
var password2Input = document.getElementById("mdp2");
var lengthCriterion = document.querySelector("#password-strength-criteria div:nth-child(1)");
var uppercaseCriterion = document.querySelector("#password-strength-criteria div:nth-child(2)");
var specialCriterion = document.querySelector("#password-strength-criteria div:nth-child(3)");
var numberCriterion = document.querySelector("#password-strength-criteria div:nth-child(4)");

passwordInput.addEventListener("input", updateCheckboxes);
password2Input.addEventListener("input", validatePasswordMatch);

function updateCheckboxes() {
    var password = passwordInput.value;

    lengthCriterion.classList.toggle("criterion-valid", password.length >= 8);
    uppercaseCriterion.classList.toggle("criterion-valid", /[A-Z]/.test(password));
    specialCriterion.classList.toggle("criterion-valid", /[\W_]/.test(password));
    numberCriterion.classList.toggle("criterion-valid", /\d/.test(password));
}

function validatePasswordMatch() {
    var password = passwordInput.value;
    var password2 = password2Input.value;

    if (password === password2) {
        password2Input.classList.remove("invalid-input");
    } else {
        password2Input.classList.add("invalid-input");
        password2Input.focus();
    }
}

function validateurANSSI() {
    var password = passwordInput.value;
    var password2 = password2Input.value;
    var isValid = true;

    if (password.length < 8 || !/[A-Z]/.test(password) || !/[\W_]/.test(password) || !/\d/.test(password)) {
        isValid = false;
        passwordInput.classList.add("invalid-input");
        passwordInput.focus();
    } else {
        passwordInput.classList.remove("invalid-input");
    }

    if (password !== password2) {
        isValid = false;
        password2Input.classList.add("invalid-input");
        password2Input.focus();
    } else {
        password2Input.classList.remove("invalid-input");
    }

    if (!isValid) {
        setTimeout(function() {
            passwordInput.classList.remove("invalid-input");
            password2Input.classList.remove("invalid-input");
        }, 500);
        return false;
    }

    return true;
}





//fonction voir mot de passe
function voirMDP() {
  var passwordInputs = document.getElementsByClassName("toggle-password");
  var showPasswordCheckboxes = document.getElementsByClassName("voirmdp");

  for (var i = 0; i < passwordInputs.length; i++) {
    if (showPasswordCheckboxes[i].checked) {
      passwordInputs[i].type = "text";
    } else {
      passwordInputs[i].type = "password";
    }
  }
}


// fonction pour Réinitialiser l’affichage
function reintialiser() {
  document.getElementById("Identifiant").value = "";
  document.getElementById("MotDePasse").value = "";
  document.getElementById("voirmdp").checked = false;
  document.getElementById("Souvenir").checked = false;
}
