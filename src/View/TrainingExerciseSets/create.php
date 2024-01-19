<!doctype html>
<html lang="en">
<?php

use Wspomagacz\Model\TrainingExerciseSet;

require_once __DIR__ . "/../../../templates/head.php"; ?>
<body class="bg-white dark:bg-slate-900 dark:text-white text-slate-800 mb-20">
<?php require_once __DIR__ . "/../../../templates/header.php"; ?>
<section class="mx-auto p-4 flex flex-col gap-4">
    <?php
    /** @var array $data */
    /** @var TrainingExerciseSet $set */

    if (isset($data['set'])):
        $training = $data['training'];
        $exercise = $data['exercise']; ?>
        <form action="/trainings/<?= $training->getId() ?>/exercises/<?= $exercise->getId() ?>/add_set/save"
              class="flex flex-col gap-4">
            <div class="w-full">
                <div class="relative rounded-xl w-full">
                    <div class="absolute pointer-events-none inset-y-0 left-0 pl-3 flex items-center">
                        <i class="ti ti-123 absolute h-5 w-5 text-slate-400"></i>
                    </div>
                    <label>
                        <input type="number" name="repetitions"
                               class="w-full block pl-10 p-3 border bg-transparent border-slate-400 rounded-xl dark:focus:bg-white dark:focus:bg-opacity-10 transition"
                               placeholder="Powtórzenia">
                    </label>
                </div>
            </div>
            <div class="w-full">
                <div class="relative rounded-xl w-full">
                    <div class="absolute pointer-events-none inset-y-0 left-0 pl-3 flex items-center">
                        <i class="ti ti-weight absolute h-4 w-4 text-slate-400"></i>
                    </div>
                    <label>
                        <input type="number" name="weight"
                               class="w-full block pl-10 p-3 border bg-transparent border-slate-400 rounded-xl dark:focus:bg-white dark:focus:bg-opacity-10 transition"
                               placeholder="Ciężar w kilogramach">
                    </label>
                </div>
            </div>
            <input type="submit"
                   class="w-full text-center border border-lime-400 text-lime-400 transition active:bg-red-500 rounded-xl p-3 disabled:bg-gray-400"
                   value="Zapisz serię">
        </form>
    <?php endif; ?>
</section>
<?php require_once __DIR__ . "/../../../templates/footer.php"; ?>
</body>
</html>
