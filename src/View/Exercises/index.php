<!doctype html>
<html lang="en">
<?php

use Wspomagacz\Model\Equipment;
use Wspomagacz\Model\Exercise;
use Wspomagacz\Model\Muscle;

require_once __DIR__ . "/../../../templates/head.php"; ?>
<body class="bg-white dark:bg-slate-900 dark:text-white text-slate-800 mb-20">
<?php require_once __DIR__ . "/../../../templates/header.php"; ?>
<section class="mx-auto p-4">
    <div class="w-full flex flex-col gap-4 justify-center items-center">
        <?php
        /** @var array $data */
        /** @var Exercise $exercise */
        /** @var Equipment $eq */
        /** @var Muscle $muscle */
        foreach ($data as $exercise):
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
        <?php endforeach; ?>
    </div>
</section>
<?php require_once __DIR__ . "/../../../templates/footer.php"; ?>
</body>
</html>

