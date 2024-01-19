<!doctype html>
<html lang="en">
<?php

use Wspomagacz\Enums\TrainingStatus;
use Wspomagacz\Model\Equipment;
use Wspomagacz\Model\ExerciseMuscle;
use Wspomagacz\Model\Training;
use Wspomagacz\Model\TrainingExercise;
use Wspomagacz\Model\TrainingExerciseSet;

require_once __DIR__ . "/../../../templates/head.php"; ?>
<body class="bg-white dark:bg-slate-900 dark:text-white text-slate-800 mb-20">
<?php require_once __DIR__ . "/../../../templates/header.php"; ?>
<section class="mx-auto p-4 flex flex-col gap-6">
    <?php
    /** @var array $data */
    /** @var TrainingExercise $set */

    if (isset($data['exercise']) && isset($data['training']) && isset($data['set'])):
        $set = $data['set'];
        $exercise = $data['exercise'];
        $training = $data['training']; ?>
        <div class="w-full">
            <div class="flex flex-col gap-4 mb-4">
                <a href="/trainings/<?= $training->getId() ?>/exercise/<?= $exercise->getId() ?>/set/<?= $set->getId() ?>/delete"
                   class="w-full text-center border border-red-400 text-red-400 transition active:bg-red-500 rounded-xl p-3 disabled:bg-gray-400">
                    Usuń serię
                </a>
                <div class="flex flex-col w-full gap-2 dark:bg-slate-800 bg-slate-100 rounded-xl p-4">
                    <div class="w-full flex items-center justify-between">
                        <div class="flex items-center gap-2">
                            <i class="ti ti-arrows-sort text-xl"></i>
                            Kolejność serii
                        </div>
                        <div class="font-semibold">
                            <?= $set->getOrder(); ?>
                        </div>
                    </div>
                    <div class="w-full flex items-center justify-between">
                        <div class="flex items-center gap-2">
                            <i class="ti ti-123 text-xl"></i>
                            Powtórzenia
                        </div>
                        <div class="font-semibold">
                            <?= $set->getRepetitions(); ?>
                        </div>
                    </div>
                    <div class="w-full flex items-center justify-between">
                        <div class="flex items-center gap-2">
                            <i class="ti ti-barbell text-xl"></i>
                            Waga
                        </div>
                        <div class="font-semibold">
                            <?= $set->getWeight(); ?>kg
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php else: ?>
        <div class="w-full items-center justify-center flex flex-col text-center gap-2 dark:text-slate-400 text-slate-600 w-32">
            <i class="ti ti-mood-cry text-2xl"></i>
            Nie znaleziono takiej serii lub nie masz do niej uprawnień.
        </div>
    <?php endif; ?>
</section>
<?php require_once __DIR__ . "/../../../templates/footer.php"; ?>
</body>
</html>

