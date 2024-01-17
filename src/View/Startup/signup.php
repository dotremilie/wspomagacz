<!doctype html>
<html lang="en">
<?php require_once __DIR__ . "/../../../templates/head.php"; ?>
<body class="bg-gray-100 dark:bg-slate-900 dark:text-white text-slate-800">
<section class="w-screen h-screen flex flex-col">
    <?php require_once __DIR__ . "/../../../templates/header.php"; ?>
    <header class="bg-white dark:bg-slate-800 text-center flex flex-col justify-center gap-4 p-6 py-12">
        <div class="text-4xl font-bold">Wyciskaj ze Wspomagaczem!</div>
        <div class="text-lg">Od rozpoczęcia treningu dzieli Cię już tylko jeden krok.</div>
    </header>
    <form method="post" action="/startup/signup" class="flex flex-col gap-6 p-6 grow justify-center">
        <div class="text-2xl font-bold">Zarejestruj się</div>
        <div class="w-full">
            <div class="relative rounded w-full">
                <div class="absolute pointer-events-none inset-y-0 left-0 pl-3 flex items-center">
                    <i data-feather="user" class="absolute h-5 w-5 text-slate-400"></i>
                </div>
                <label>
                    <input type="text" name="login"
                           class="w-full px-10 block py-3 border bg-transparent border-slate-400 rounded dark:focus:bg-white dark:focus:bg-opacity-10 transition"
                           placeholder="Nazwa użytkownika">
                </label>
                <div class="absolute pointer-events-none inset-y-0 right-6 pr-3 flex items-center">
                    <i data-feather="x" class="absolute h-5 w-5 text-red-400"></i>
                </div>
            </div>
            <div class="text-red-400 mt-2">
                Nieprawidłowa nazwa użytkownika.
            </div>
        </div>

        <div class="relative rounded w-full">
            <div class="absolute pointer-events-none inset-y-0 left-0 pl-3 flex items-center">
                <i data-feather="lock" class="absolute h-5 w-5 text-slate-400"></i>
            </div>
            <label>
                <input type="password" name="password"
                       class="w-full pl-10 block p-3 border bg-transparent border-slate-400 rounded dark:focus:bg-white dark:focus:bg-opacity-10 transition"
                       placeholder="Hasło">
            </label>
        </div>
        <div class="relative rounded w-full">
            <div class="absolute pointer-events-none inset-y-0 left-0 pl-3 flex items-center">
                <i data-feather="lock" class="absolute h-5 w-5 text-slate-400"></i>
            </div>
            <label>
                <input type="password" name="repeat-password"
                       class="w-full pl-10 block p-3 border bg-transparent border-slate-400 rounded dark:focus:bg-white dark:focus:bg-opacity-10 transition"
                       placeholder="Powtórz hasło">
            </label>
        </div>
        <div class="relative rounded w-full">
            <div class="absolute pointer-events-none inset-y-0 left-0 pl-3 flex items-center">
                <i data-feather="at-sign" class="absolute h-5 w-5 text-slate-400"></i>
            </div>
            <label>
                <input type="text" name="email"
                       class="w-full pl-10 block p-3 border bg-transparent border-slate-400 rounded dark:focus:bg-white dark:focus:bg-opacity-10 transition"
                       placeholder="Adres e-mail">
            </label>
        </div>
        <div class="relative rounded w-full">
            <div class="absolute pointer-events-none inset-y-0 left-0 pl-3 flex items-center">
                <i data-feather="at-sign" class="absolute h-5 w-5 text-slate-400"></i>
            </div>
            <label>
                <input type="text" name="repeat-email"
                       class="w-full pl-10 block p-3 border bg-transparent border-slate-400 rounded dark:focus:bg-white dark:focus:bg-opacity-10 transition"
                       placeholder="Powtórz adres e-mail">
            </label>
        </div>
        <div class="w-full">Rejestrując się akceptujesz <a href="" class="text-red-400 font-bold">Warunki korzystania</a> oraz <a href="" class="text-red-400 font-bold">Politykę prywatności</a>.</div>
        <input type="submit" class="w-full bg-red-400 transition active:bg-red-500 rounded p-3" value="Zarejestruj">
    </form>
</section>

<script>feather.replace();</script>
</body>
</html>