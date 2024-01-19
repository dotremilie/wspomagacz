<!doctype html>
<html lang="en">
<?php

use Wspomagacz\Model\Equipment;
use Wspomagacz\Model\Exercise;
use Wspomagacz\Model\ExerciseMuscle;
use Wspomagacz\Model\Training;

require_once __DIR__ . "/../../../templates/head.php"; ?>
<body class="bg-white dark:bg-slate-900 dark:text-white text-slate-800 mb-20">
<?php require_once __DIR__ . "/../../../templates/header.php"; ?>
<section class="mx-auto p-4 flex flex-col gap-4">
    <?php
    /** @var array $data */
    /** @var Training $training */

    $name = "";
    $date = "";

    if (isset($data['training'])) {
        $training = $data['training'];
        $name = $training->getName();
        $date = $training->getDate()->format('Y-m-d');
    }
    ?>
    <form action="/trainings/create" class="flex flex-col gap-4">
        <div class="w-full">
            <div class="relative rounded-xl w-full">
                <div class="absolute pointer-events-none inset-y-0 left-0 pl-3 flex items-center">
                    <i data-feather="edit-2" class="absolute h-5 w-5 text-slate-400"></i>
                </div>
                <label>
                    <input type="text"
                           class="w-full block pl-10 p-3 border bg-transparent border-slate-400 rounded-xl dark:focus:bg-white dark:focus:bg-opacity-10 transition"
                           placeholder="Nazwa" value="<?= $name ?>">
                </label>
            </div>
        </div>
        <div class="w-full">
            <div class="relative rounded-xl w-full">
                <div class="absolute pointer-events-none inset-y-0 left-0 pl-3 flex items-center">
                    <i data-feather="calendar" class="absolute h-5 w-5 text-slate-400"></i>
                </div>
                <label>
                    <input type="date"
                           class="w-full block pl-10 p-3 border bg-transparent border-slate-400 rounded-xl dark:focus:bg-white dark:focus:bg-opacity-10 transition"
                           placeholder="Data" value="<?= $date ?>">
                </label>
            </div>
        </div>
        <input type="submit"
               class="w-full text-center border border-lime-400 text-lime-400 transition rounded-xl p-3 disabled:bg-gray-400"
               value="Zapisz trening">
    </form>
    <div class="w-full">
        <div class="text-2xl font-bold mb-4">Ćwiczenia</div>
        <div class="w-full flex flex-col gap-4 justify-center items-center">
            <?php
            /** @var array $data */
            /** @var Exercise $exercise */
            /** @var Equipment $eq */
            /** @var ExerciseMuscle $muscle */
            if (!empty($data['exercises'])):
                foreach ($data['exercises'] as $exercise):
                    $equipment = [];
                    $muscles = [];

                    foreach ($exercise->getEquipmentUsed() as $eq) $equipment[] = $eq->getName();
                    foreach ($exercise->getMusclesUsed() as $muscle) $muscles[] = $muscle->getName();

                    ?>
                    <div
                       class="w-full p-6 dark:bg-slate-800 bg-slate-100 rounded-xl flex justify-between items-center">
                        <div>
                            <div class="text-lg font-bold"><?= $exercise->getName() ?></div>
                            <div class="text-gray-400 max-w-64 truncate">
                                <div class="flex gap-2 items-center">
                                    <i class="ti ti-activity"></i>
                                    <div class="max-w-64 truncate"><?php echo implode(", ", $muscles) ?></div>
                                </div>
                                <div class="flex gap-2 items-center">
                                    <i class="ti ti-barbell"></i>
                                    <div class="max-w-64 truncate"><?php echo implode(", ", $equipment) ?></div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach;
            else: ?>
                <div class="w-full items-center justify-center flex flex-col text-center gap-2 dark:text-slate-400 text-slate-600 w-32">
                    <i class="ti ti-mood-cry text-2xl"></i>
                    Nie znaleziono żadnych ćwiczeń.
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>
<?php require_once __DIR__ . "/../../../templates/footer.php"; ?>
</body>
</html>