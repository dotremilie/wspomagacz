<!doctype html>
<html lang="pl">
<?php require_once __DIR__ . "/../../../templates/head.php"; ?>

<body class="bg-white dark:bg-slate-900 dark:text-white text-slate-800">
<section class="w-screen h-screen flex flex-col">
    <?php require_once __DIR__ . "/../../../templates/header.php"; ?>
    <header class="bg-white dark:bg-slate-800 text-center flex flex-col justify-center gap-4 p-6 py-12">
        <div class="text-4xl font-bold">Wyciskaj ze Wspomagaczem!</div>
        <div class="text-lg">Twoje treningi już na ciebie czekają.</div>
    </header>
    <form method="post" action="/login/verify" id="login"
          class="flex flex-col gap-6 p-6 grow justify-center">
        <div class="text-2xl font-bold">Zaloguj się</div>
        <div class="w-full" id="login-container">
            <div class="relative rounded w-full">
                <div class="absolute pointer-events-none inset-y-0 left-0 pl-3 flex items-center">
                    <i data-feather="user" class="absolute h-5 w-5 text-slate-400"></i>
                </div>
                <label>
                    <input type="text" name="login" id="login-input"
                           class="w-full px-10 block p-3 border bg-transparent border-slate-400 rounded dark:focus:bg-white dark:focus:bg-opacity-10 transition"
                           placeholder="Nazwa użytkownika">
                </label>
                <div id="login-error-icon"
                     class="hidden absolute pointer-events-none inset-y-0 right-6 pr-3 flex items-center">
                </div>
            </div>
            <div class="hidden text-red-400 mt-2" id="login-error">
                Pole nie może być puste.
            </div>
        </div>

        <div class="w-full" id="password-container">
            <div class="relative rounded w-full">
                <div class="absolute pointer-events-none inset-y-0 left-0 pl-3 flex items-center">
                    <i data-feather="lock" class="absolute h-5 w-5 text-slate-400"></i>
                </div>
                <label>
                    <input type="password" name="password" id="password-input"
                           class="w-full pl-10 block p-3 border bg-transparent border-slate-400 rounded dark:focus:bg-white dark:focus:bg-opacity-10 transition"
                           placeholder="Hasło">
                </label>
                <div id="password-error-icon"
                     class="hidden absolute pointer-events-none inset-y-0 right-6 pr-3 flex items-center">
                </div>
            </div>
            <div class="hidden text-red-400 mt-2" id="password-error">
                Pole nie może być puste.
            </div>
        </div>

        <input type="submit" id="submit-button" name="login"
               class="w-full bg-red-400 transition active:bg-red-500 rounded p-3 disabled:bg-gray-400"
               value="Zaloguj">

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
        const submitButton = $('#submit-button');

        let buttonClicked = false;

        function inputApplyStyle(input, error, errorIcon, state) {
            const successIcon = '<i data-feather="check" class="absolute h-5 w-5 text-lime-400"></i>';
            const failureIcon = '<i data-feather="x" class="absolute h-5 w-5 text-red-400"></i>';

            errorIcon.removeClass('hidden');
            input.removeClass('border-slate-400');

            if (state) {
                input.addClass('border-lime-400').removeClass('border-red-400');
                errorIcon.html(successIcon);
                error.addClass('hidden');
            } else {
                input.addClass('border-red-400').removeClass('border-lime-400');
                errorIcon.html(failureIcon);
                error.removeClass('hidden');
            }

            feather.replace();
        }

        function validateInput(input, regex) {
            return regex.test(input.val());
        }

        submitButton.on('click', function (e) {
            e.preventDefault();

            // Check if login and password are not empty
            const isLoginEmpty = loginInput.val().toString().trim() === '';
            const isPasswordEmpty = passwordInput.val().toString().trim() === '';

            if (isLoginEmpty) {
                inputApplyStyle(loginInput, loginError, loginErrorIcon, false);
            } else {
                inputApplyStyle(loginInput, loginError, loginErrorIcon, validateInput(loginInput, /^[a-zA-Z0-9]{3,24}$/));
            }

            if (isPasswordEmpty) {
                inputApplyStyle(passwordInput, passwordError, passwordErrorIcon, false);
            } else {
                inputApplyStyle(passwordInput, passwordError, passwordErrorIcon, validateInput(passwordInput, /^(?=.*[0-9])(?=.*[!@#$%^&*])(?=.*[a-zA-Z]).{8,}$/));
            }

            if (!isLoginEmpty && !isPasswordEmpty) {
                $('#login').submit();
            }

            buttonClicked = true;
            feather.replace();
        });

        loginInput.on('blur', function () {
            if (buttonClicked)
                inputApplyStyle(loginInput, loginError, loginErrorIcon, !(loginInput.val().toString().trim() === ''));
        });

        passwordInput.on('blur', function () {
            if (buttonClicked)
                inputApplyStyle(passwordInput, passwordError, passwordErrorIcon, !(passwordInput.val().toString().trim() === ''));
        });
    });

    feather.replace();
</script>
</body>
</html>
