<!doctype html>
<html lang="en">
<?php

use Wspomagacz\Model\Equipment;
use Wspomagacz\Model\Exercise;
use Wspomagacz\Model\ExerciseMuscle;

require_once __DIR__ . "/../../../templates/head.php"; ?>
<body class="bg-white dark:bg-slate-900 dark:text-white text-slate-800 mb-20">
<?php require_once __DIR__ . "/../../../templates/header.php"; ?>
<section class="mx-auto p-4 flex flex-col gap-6">
    <?php
    /** @var array $data */
    /** @var Exercise $exercise */
    /** @var Equipment $eq */
    /** @var ExerciseMuscle $muscle */
    if (isset($data['exercise'])):
        $exercise = $data['exercise'];
        $equipment = [];

        foreach ($exercise->getEquipmentUsed() as $eq) $equipment[] = $eq->getName();
        ?>
        <div class="w-full p-6 dark:bg-slate-800 bg-slate-100 rounded-xl flex justify-between items-center">
            <div>
                <div class="text-lg font-bold"><?= $exercise->getName() ?></div>
                <div class="text-gray-400 max-w-64 truncate">
                    <div class="flex gap-2 items-center">
                        <i class="ti ti-barbell"></i>
                        <div class="max-w-64 truncate"><?php echo implode(", ", $equipment) ?></div>
                    </div>
                </div>
            </div>
        </div>
        <div>
        <div class="text-2xl font-bold mb-4">Używane mięśnie</div>
        <div class="flex flex-col gap-4">
            <?php foreach ($exercise->getMusclesUsed() as $muscle): ?>
                <div class="flex justify-between items-center dark:bg-slate-800 bg-slate-100 rounded-xl text-xl p-4">
                    <div class="flex flex-col h-full leading-none justify-center"> <?= $muscle->getName() ?> </div>
                    <div class="h-full flex gap-1 items-center dark:text-slate-400 text-slate-600 pl-4">
                        <?php switch ($muscle->getStrength()):
                            case 1: ?>
                                <span class="bg-amber-400 rounded h-6 w-4"></span>
                                <span class="dark:bg-slate-700 bg-slate-200 rounded h-6 w-4"></span>
                                <span class="dark:bg-slate-700 bg-slate-200 rounded h-6 w-4"></span>
                                <?php break;
                            case 2: ?>
                                <span class="bg-amber-400 rounded h-6 w-4"></span>
                                <span class="bg-orange-400 rounded h-6 w-4"></span>
                                <span class="dark:bg-slate-700 bg-slate-200 rounded h-6 w-4"></span>
                                <?php break;
                            case 3: ?>
                                <span class="bg-amber-400 rounded h-6 w-4"></span>
                                <span class="bg-orange-400 rounded h-6 w-4"></span>
                                <span class="bg-red-400 rounded h-6 w-4"></span>
                                <?php break;
                            default: ?>
                                <span class="dark:bg-slate-700 bg-slate-200 rounded h-6 w-4"></span>
                                <span class="dark:bg-slate-700 bg-slate-200 rounded h-6 w-4"></span>
                                <span class="dark:bg-slate-700 bg-slate-200 rounded h-6 w-4"></span>
                                <?php break;
                        endswitch; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <div class="w-full items-center justify-center flex flex-col text-center gap-2 dark:text-slate-400 text-slate-600 w-32">
            <i class="ti ti-mood-cry text-2xl"></i>
            Nie znaleziono takiego ćwiczenia.
        </div>
    <?php endif; ?>
</section>
<?php require_once __DIR__ . "/../../../templates/footer.php"; ?>
</body>
</html>

