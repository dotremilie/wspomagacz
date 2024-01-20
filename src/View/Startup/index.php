<!DOCTYPE html>
<html lang="en">
<?php require_once __DIR__ . "/../../../templates/head.php"; ?>
<body class="bg-white dark:bg-slate-900 dark:text-white text-slate-800">
<section class="w-screen h-screen flex flex-col">
    <?php require_once __DIR__ . "/../../../templates/header.php"; ?>
    <header class="bg-white dark:bg-slate-800 text-center flex flex-col justify-center gap-4 p-6 py-12">
        <div class="text-4xl font-bold">Witaj we Wspomagaczu!</div>
        <div class="text-lg">Zaloguj się żeby zacząć swoją przygodę.</div>
    </header>
    <div class="flex flex-col gap-6 p-6 grow justify-center">
        <a href="/login"
           class="w-full text-center bg-red-400 transition rounded-xl p-3 disabled:bg-gray-400">Zaloguj
            się</a>
        <div class="w-full text-center">Nie masz jeszcze konta?</div>
        <a href="/signup"
           class="w-full text-center bg-slate-800 transition active:bg-red-400 rounded-xl p-3 disabled:bg-gray-400">Zarejestruj
            się</a>
    </div>
</section>
</body>
</html>