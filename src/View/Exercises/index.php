<!doctype html>
<html lang="en">
<?php

use Wspomagacz\Model\CustomExercise;
use Wspomagacz\Model\Equipment;
use Wspomagacz\Model\Exercise;
use Wspomagacz\Model\Muscle;

require_once __DIR__ . "/../../../templates/head.php"; ?>
<body class="bg-white dark:bg-slate-900 dark:text-white text-slate-800 mb-20">
<?php require_once __DIR__ . "/../../../templates/header.php"; ?>
<section class="mx-auto p-4 flex flex-col gap-6">
    <div class="w-full">
        <div class="text-2xl font-bold mb-4">Ćwiczenia</div>
        <div class="w-full flex flex-col gap-4 justify-center items-center">
            <?php
            /** @var array $data */
            /** @var Exercise $exercise */
            /** @var Equipment $eq */
            /** @var Muscle $muscle */
            if (!empty($data['exercises'])):
                foreach ($data['exercises'] as $exercise):
                    $equipment = [];
                    $muscles = [];

                    foreach ($exercise->getEquipmentUsed() as $eq) $equipment[] = $eq->getName();
                    foreach ($exercise->getMusclesUsed() as $muscle) $muscles[] = $muscle->getName();

                    ?>
                    <a id="exercise-<?= $exercise->getId() ?>" href=""
                       class="w-full p-6 dark:bg-slate-800 rounded-xl flex justify-between items-center">
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
                        <i data-feather="chevron-right" class="text-gray-400"></i>
                    </a>
                <?php endforeach;
            else: ?>
                <div class="w-full items-center justify-center flex flex-col text-center gap-2 dark:text-slate-400 text-slate-600 w-32">
                    <i class="ti ti-mood-cry text-2xl"></i>
                    Nie znaleziono żadnych ćwiczeń.
                </div>
            <?php endif; ?>
        </div>
    </div>
    <div class="w-full">
        <div class="text-2xl font-bold mb-4">Twoje ćwiczenia</div>
        <div class="w-full flex flex-col gap-4 justify-center items-center">
            <?php
            /** @var array $data */
            /** @var CustomExercise $exercise */
            /** @var Equipment $eq */
            /** @var Muscle $muscle */
            if (!empty($data['customExercises'])):
                foreach ($data['customExercises'] as $exercise):
                    $equipment = [];
                    $muscles = [];

                    foreach ($exercise->getEquipmentUsed() as $eq) $equipment[] = $eq->getName();
                    foreach ($exercise->getMusclesUsed() as $muscle) $muscles[] = $muscle->getName();

                    ?>
                    <a id="custom-exercise-<?= $exercise->getId() ?>" href=""
                       class="w-full p-6 dark:bg-slate-800 rounded-xl flex justify-between items-center">
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
                        <i data-feather="chevron-right" class="text-gray-400"></i>
                    </a>
                <?php endforeach;
            else: ?>
                <div class="text-xl w-full flex flex-col gap-4 p-6 text-center dark:bg-slate-800 bg-slate-100 rounded-xl">
                    Nie zdefiniowałeś żadnych własnych ćwiczeń. Czy chcesz dodać swoje ćwiczenie?
                    <a href="/training"
                       class="w-full text-center bg-red-400 transition active:bg-red-500 rounded-xl p-3 disabled:bg-gray-400">Nowe
                        Ćwiczenie
                    </a>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>
<?php require_once __DIR__ . "/../../../templates/footer.php"; ?>
</body>
</html>

