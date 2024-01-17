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
    <div class="flex flex-col gap-6 p-6 grow justify-center">
        <div class="text-2xl font-bold">Zaloguj się</div>
        <label>
            <input type="text" name="login"
                   class="w-full p-3 border bg-transparent border-slate-400 rounded dark:focus:bg-white dark:focus:bg-opacity-10 transition"
                   placeholder="Nazwa użytkownika">
        </label>
        <label>
            <input type="password" name="password"
                   class="w-full p-3 border bg-transparent border-slate-400 rounded dark:focus:bg-white dark:focus:bg-opacity-10 transition"
                   placeholder="Hasło">
        </label>
        <div class="font-bold text-red-400 w-full text-right">Zapomniałeś hasło?</div>
        <button class="w-full bg-red-400 transition active:bg-red-500 rounded p-3">Zaloguj</button>
    </div>
</section>
</body>
</html>