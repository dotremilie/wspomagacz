<!doctype html>
<html lang="en">
<?php require_once __DIR__ . "/../../../templates/head.php"; ?>
<body class="bg-white dark:bg-slate-900 dark:text-white text-slate-800 mb-20">
<?php require_once __DIR__ . "/../../../templates/header.php"; ?>
<div class="flex flex-col justify-center items-center gap-4">
    <section class="mx-auto rounded-xl px-6 w-full">
        <div class="text-2xl font-bold mb-4">Dzisiejszy plan</div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            <div class="dark:bg-slate-800 bg-slate-100 p-6 rounded-xl">
                <div class="text-2xl text-sky-400">Podniesiony ciężar</div>
                <div class="text-xl font-semibold">1000 kg</div>
            </div>
            <div class="dark:bg-slate-800 bg-slate-100 p-6 rounded-xl">
                <div class="text-2xl text-lime-400">Wykonane ćwiczenia</div>
                <div class="text-xl font-semibold">10</div>
            </div>
            <div class="dark:bg-slate-800 bg-slate-100 p-6 rounded-xl">
                <div class="text-2xl text-amber-400">Spalone kalorie</div>
                <div class="text-xl font-semibold">1000 kcal</div>
            </div>
        </div>
    </section>
    <section class="mx-auto pl-6 w-full">
        <div class="text-2xl font-bold mb-4">Popularne treningi</div>
        <div class="flex gap-6 overflow-y-scroll pr-6">
            <div class="flex items-center dark:bg-slate-800 bg-slate-100 rounded-xl text-xl p-4">
                <div class="flex flex-col h-full leading-none justify-center">
                    <div class="mb-4 truncate w-48">
                        Przerzucanie żeliwa
                        <div class="text-sm dark:text-slate-400 text-slate-600 truncate">
                            utworzył <span class="font-semibold">sneakydog</span>
                        </div>
                    </div>
                    8 ćwiczeń
                </div>
                <div class="h-full flex items-center dark:text-slate-400 text-slate-600 pl-6">
                    <i data-feather="plus"></i>
                </div>
            </div>
            <div class="flex flex-col items-center justify-center rounded-xl text-xl p-4">
                <div class="h-full items-center justify-center flex flex-col text-center gap-2 dark:text-slate-400 text-slate-600 w-32">
                    <i data-feather="frown"></i>
                    To wszystko w tej sekcji
                </div>
            </div>
    </section>
    <section class="mx-auto px-6 w-full">
        <h2 class="text-2xl font-bold mb-4">Ostatni Trening</h2>
    </section>
</div>
<?php require_once __DIR__ . "/../../../templates/footer.php"; ?>
</body>
</html>