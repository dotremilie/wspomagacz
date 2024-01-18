<!doctype html>
<html lang="en">
<?php require_once __DIR__ . "/../../../templates/head.php"; ?>
<body class="bg-white dark:bg-slate-900 dark:text-white text-slate-800 mb-20">
<?php require_once __DIR__ . "/../../../templates/header.php"; ?>
<div class="flex flex-col justify-center items-center gap-4">
    <section class="mx-auto pl-6 w-full">
        <div class="text-2xl font-bold mb-4">Dzisiejszy plan</div>
        <div class="">
            <div class="flex gap-6 pr-6 mb-4">
                <div class="flex flex-col w-full gap-2 dark:bg-slate-800 bg-slate-100 rounded-xl p-4">
                    <div class="w-full flex items-center justify-between">
                        <div class="flex items-center gap-2">
                            <i class="ti ti-pencil text-xl"></i>
                            Nazwa
                        </div>
                        <div class="font-semibold">
                            Jedziemy z kurwami
                        </div>
                    </div>
                    <div class="w-full flex items-center justify-between">
                        <div class="flex items-center gap-2">
                            <i class="ti ti-barbell text-xl"></i>
                            Ilość ćwiczeń
                        </div>
                        <div class="font-semibold">
                            10
                        </div>
                    </div>
                </div>
            </div>
            <div class="flex gap-6 overflow-y-scroll pr-6">
                <div class="flex items-center dark:bg-slate-800 bg-slate-100 rounded-xl text-xl p-4">
                    <div class="flex flex-col h-full justify-center">
                        <div class="mb-4 truncate max-w-48">
                            Podnoszenie ciężarów
                            <div class="text-sm truncate flex gap-2 items-center text-lime-400">
                                <i data-feather="check-circle" class="w-4 h-4"></i>
                                Wykonane
                            </div>
                        </div>
                        <div class="text-sm dark:text-slate-400 text-slate-600 truncate">
                            8 powtórzeń
                        </div>
                    </div>
                    <div class="h-full flex items-center dark:text-slate-400 text-slate-600 pl-6">
                        <i data-feather="chevron-right"></i>
                    </div>
                </div>
                <div class="flex items-center dark:bg-slate-800 bg-slate-100 rounded-xl text-xl p-4">
                    <div class="flex flex-col h-full justify-center">
                        <div class="mb-4 truncate max-w-48">
                            Pompki
                            <div class="text-sm truncate flex gap-2 items-center text-amber-400">
                                <i data-feather="calendar" class="w-4 h-4"></i>
                                Zaplanowane
                            </div>
                        </div>
                        <div class="text-sm dark:text-slate-400 text-slate-600 truncate">
                            10 powtórzeń
                        </div>
                    </div>
                    <div class="h-full flex items-center dark:text-slate-400 text-slate-600 pl-6">
                        <i data-feather="chevron-right"></i>
                    </div>
                </div>
                <div class="flex items-center dark:bg-slate-800 bg-slate-100 rounded-xl text-xl p-4">
                    <div class="flex flex-col h-full justify-center">
                        <div class="mb-4 truncate max-w-48">
                            Podciąganie
                            <div class="text-sm truncate flex gap-2 items-center text-sky-400">
                                <i data-feather="arrow-right-circle" class="w-4 h-4"></i>
                                W trakcie
                            </div>
                        </div>
                        <div class="text-sm dark:text-slate-400 text-slate-600 truncate">
                            4 powtórzenia
                        </div>
                    </div>
                    <div class="h-full flex items-center dark:text-slate-400 text-slate-600 pl-6">
                        <i class="ti ti-chevron-right"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="hidden w-full pr-6">
            <div class="text-xl w-full flex flex-col gap-4 p-6 text-center dark:bg-slate-800 bg-slate-100 rounded-xl">
                Nie zaplanowałeś na dzisiaj żadnych treningów. Czy chcesz rozpocząć nowy trening?
                <a href="/training"
                   class="w-full text-center bg-red-400 transition active:bg-red-500 rounded-xl p-3 disabled:bg-gray-400">Nowy
                    Trening
                </a>
            </div>
        </div>
    </section>
    <section class="mx-auto pl-6 w-full">
        <div class="text-2xl font-bold mb-4">Popularne treningi</div>
        <div class="flex gap-6 overflow-y-scroll pr-6">
            <div class="flex items-center dark:bg-slate-800 bg-slate-100 rounded-xl text-xl p-4">
                <div class="flex flex-col h-full leading-none justify-center">
                    <div class="mb-4 truncate max-w-48">
                        Przerzucanie żeliwa
                        <div class="text-sm dark:text-slate-400 text-slate-600 truncate">
                            utworzył <span class="font-semibold">sneakydog</span>
                        </div>
                    </div>
                    8 ćwiczeń
                </div>
                <div class="h-full flex items-center dark:text-slate-400 text-slate-600 pl-6">
                    <i class="ti ti-plus"></i>
                </div>
            </div>
            <div class="flex flex-col items-center justify-center rounded-xl text-xl p-4">
                <div class="h-full items-center justify-center flex flex-col text-center gap-2 dark:text-slate-400 text-slate-600 w-32">
                    <i class="ti ti-mood-cry"></i>
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