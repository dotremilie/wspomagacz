<!doctype html>
<html lang="en">
<?php require_once __DIR__ . "/../../../templates/head.php"; ?>
<body class="bg-white dark:bg-slate-900 dark:text-white text-slate-800 mb-20">
<?php require_once __DIR__ . "/../../../templates/header.php"; ?>
<div class="flex flex-col justify-center items-center gap-4">
    <div class="flex justify-between items-center h-32 dark:bg-slate-800 bg-slate-100 px-4">
        <div>
            <div class="text-4xl font-semibold">sneakydog</div>
            <div class="text-2xl"><span class="text-sm">KG</span></div>
        </div>
    </div>
    <section class="mx-auto rounded-xl px-6 w-full">
        <div class="text-2xl font-bold mb-4">Statystyki</div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            <div class="dark:bg-slate-800 bg-slate-100 p-6 rounded-xl">
                <div class="text-2xl dark:text-sky-400 text-sky-600 flex gap-2 items-center mb-2"><i class="ti ti-weight"></i>Podniesiony ciężar</div>
                <div class="text-xl font-semibold">1000 kg</div>
            </div>
            <div class="dark:bg-slate-800 bg-slate-100 p-6 rounded-xl">
                <div class="text-2xl dark:text-lime-400 text-lime-600 flex gap-2 items-center mb-2"><i class="ti ti-barbell"></i>Wykonane ćwiczenia</div>
                <div class="text-xl font-semibold">10</div>
            </div>
            <div class="dark:bg-slate-800 bg-slate-100 p-6 rounded-xl">
                <div class="text-2xl dark:text-amber-400 text-amber-600 flex gap-2 items-center mb-2"><i class="ti ti-flame"></i>Spalone kalorie</div>
                <div class="text-xl font-semibold text-red-400"><i class="ti ti-exclamation-circle"></i> Nie udało się obliczyć.</div>
            </div>
        </div>
    </section>
</div>
<?php require_once __DIR__ . "/../../../templates/footer.php"; ?>
</body>
</html>