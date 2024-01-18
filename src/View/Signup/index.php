<!doctype html>
<html lang="en">
<?php use Wspomagacz\Model\InputField;

require_once __DIR__ . "/../../../templates/head.php"; ?>
<body class="bg-white dark:bg-slate-900 dark:text-white text-slate-800">
<section class="w-screen h-screen flex flex-col">
    <?php require_once __DIR__ . "/../../../templates/header.php"; ?>
    <header class="bg-white dark:bg-slate-800 text-center flex flex-col justify-center gap-4 p-6 py-12">
        <div class="text-4xl font-bold">Wyciskaj ze Wspomagaczem!</div>
        <div class="text-lg">Od rozpoczęcia treningu dzieli Cię już tylko jeden krok.</div>
    </header>
    <form method="post" action="/startup/signup/validate" name="signup" class="flex flex-col gap-6 p-6 grow justify-center">
        <div class="text-2xl font-bold">Zarejestruj się</div>
        <?php
        // Define an array with input field details
        /** @var array $data */
        $inputFields = $data;

        // Loop through each input field and generate HTML
        /** @var InputField $field */
        foreach ($inputFields as $field):
            $id = $field->getId();
            $placeholder = $field->getPlaceholder();
            $errorText = $field->getErrorText();
            $icon = $field->getIcon();
            ?>
            <div class="w-full" id="<?= "$id-container" ?>">
                <div class="relative rounded w-full">
                    <div class="absolute pointer-events-none inset-y-0 left-0 pl-3 flex items-center">
                        <i data-feather="<?= $icon ?>"
                           class="absolute h-5 w-5 text-slate-400"></i>
                    </div>
                    <label>
                        <input type="<?= $id === 'password' || $id === 'repeat-password' ? 'password' : 'text' ?>"
                               name="<?= $id ?>" id="<?= "$id-input" ?>"
                               class="w-full <?= $id === 'password' || $id === 'repeat-password' ? 'pl-10' : 'px-10' ?> block p-3 border bg-transparent border-slate-400 rounded dark:focus:bg-white dark:focus:bg-opacity-10 transition"
                               placeholder="<?= $placeholder ?>">
                    </label>
                    <div id="<?= "$id-error-icon" ?>"
                         class="hidden absolute pointer-events-none inset-y-0 right-6 pr-3 flex items-center">
                    </div>
                </div>
                <div class="hidden text-red-400 mt-2" id="<?= "$id-error" ?>">
                    <?= $errorText ?>
                </div>
            </div>
        <?php endforeach; ?>
        <div class="w-full">Rejestrując się akceptujesz <a href="" class="text-red-400 font-bold">Warunki
                korzystania</a> oraz <a href="" class="text-red-400 font-bold">Politykę prywatności</a>.
        </div>
        <input type="submit" id="submit-button" name="signup" class="w-full bg-red-400 transition active:bg-red-500 rounded p-3 disabled:bg-gray-400"
               value="Zarejestruj" disabled>
    </form>
</section>
<script>
    $(function () {
        const loginInput = $('#login-input');
        const loginError = $('#login-error');
        const loginErrorIcon = $('#login-error-icon');
        const passwordInput = $('#password-input');
        const passwordError = $('#password-error');
        const passwordErrorIcon = $('#password-error-icon');
        const repeatPasswordInput = $('#repeat-password-input');
        const repeatPasswordError = $('#repeat-password-error');
        const repeatPasswordErrorIcon = $('#repeat-password-error-icon');
        const emailInput = $('#email-input');
        const emailError = $('#email-error');
        const emailErrorIcon = $('#email-error-icon');
        const submitButton = $('#submit-button');

        function inputApplyStyle(input, error, errorIcon, state) {
            const successIcon = '<i data-feather="check" class="absolute h-5 w-5 text-lime-400"></i>';
            const failureIcon = '<i data-feather="x" class="absolute h-5 w-5 text-red-400"></i>';

            errorIcon.removeClass('hidden')
            input.removeClass('border-slate-400');

            if (state) {
                input.addClass('border-lime-400').removeClass('border-red-400')
                errorIcon.html(successIcon)
                error.addClass('hidden')
            } else {
                input.addClass('border-red-400').removeClass('border-lime-400')
                errorIcon.html(failureIcon)
                error.removeClass('hidden')
            }

            feather.replace();
        }

        function validateInput(input, regex) { return regex.test(input.val()); }

        function updateSubmitButton() {
            const isLoginValid = validateInput(loginInput, /^[a-zA-Z0-9]{3,24}$/);
            const isPasswordValid = validateInput(passwordInput, /^(?=.*[0-9])(?=.*[!@#$%^&*])(?=.*[a-zA-Z]).{8,}$/);
            const isRepeatPasswordValid = repeatPasswordInput.val() === passwordInput.val();
            const isEmailValid = validateInput(emailInput, /^[^\s@]+@[^\s@]+\.[^\s@]+$/);

            const isFormValid = isLoginValid && isPasswordValid && isRepeatPasswordValid && isEmailValid;

            console.log(isFormValid);

            submitButton.prop('disabled', !isFormValid);
        }

        // Validation for login input
        loginInput.on('blur', function () {
            inputApplyStyle(loginInput, loginError, loginErrorIcon, validateInput(loginInput, /^[a-zA-Z0-9]{3,24}$/));
            updateSubmitButton();
        });

        // Validation for password input
        passwordInput.on('blur', function () {
            inputApplyStyle(passwordInput, passwordError, passwordErrorIcon, validateInput(loginInput, /^(?=.*[0-9])(?=.*[!@#$%^&*])(?=.*[a-zA-Z]).{8,}$/));
            updateSubmitButton();
        });

        // Validation for repeat password input
        repeatPasswordInput.on('blur', function () {
            inputApplyStyle(repeatPasswordInput, repeatPasswordError, repeatPasswordErrorIcon,
                validateInput(passwordInput, /^(?=.*[0-9])(?=.*[!@#$%^&*])(?=.*[a-zA-Z]).{8,}$/) ? repeatPasswordInput.val() === passwordInput.val() : false)

            updateSubmitButton();
        });

        // Validation for email input
        emailInput.on('blur', function () {
            inputApplyStyle(emailInput, emailError, emailErrorIcon, validateInput(loginInput, /^[^\s@]+@[^\s@]+\.[^\s@]+$/));
            updateSubmitButton();
        });
    });

    feather.replace();
</script>
</body>
</html>