<!doctype html>
<html lang="en">
<?php

use Wspomagacz\Enums\TrainingStatus;
use Wspomagacz\Model\Equipment;
use Wspomagacz\Model\ExerciseMuscle;
use Wspomagacz\Model\Training;
use Wspomagacz\Model\TrainingExercise;

require_once __DIR__ . "/../../../templates/head.php"; ?>
<body class="bg-white dark:bg-slate-900 dark:text-white text-slate-800 mb-20">
<?php require_once __DIR__ . "/../../../templates/header.php"; ?>
<section class="mx-auto p-4 flex flex-col gap-4">
    <?php
    /** @var array $data */
    /** @var Training $training */

    if (isset($data['training'])):
        $training = $data['training']; ?>
        <form action="/trainings/<?= $training->getId() ?>/edit/save" class="flex flex-col gap-4">
            <div class="w-full">
                <div class="relative rounded-xl w-full">
                    <div class="absolute pointer-events-none inset-y-0 left-0 pl-3 flex items-center">
                        <i data-feather="edit-2" class="absolute h-5 w-5 text-slate-400"></i>
                    </div>
                    <label>
                        <input type="text" name="name"
                               class="w-full block pl-10 p-3 border bg-transparent border-slate-400 rounded-xl dark:focus:bg-white dark:focus:bg-opacity-10 transition"
                               placeholder="Nazwa" value="<?= $training->getName(); ?>">
                    </label>
                </div>
            </div>
            <div class="w-full">
                <div class="relative rounded-xl w-full">
                    <div class="absolute pointer-events-none inset-y-0 left-0 pl-3 flex items-center">
                        <i data-feather="calendar" class="absolute h-5 w-5 text-slate-400"></i>
                    </div>
                    <label>
                        <input type="date" name="date"
                               class="w-full block pl-10 p-3 border bg-transparent border-slate-400 rounded-xl dark:focus:bg-white dark:focus:bg-opacity-10 transition"
                               placeholder="Data" value="<?= (new DateTime())->format('Y-m-d'); ?>">
                    </label>
                </div>
            </div>
            <input type="submit"
                   class="w-full text-center border border-lime-400 text-lime-400 transition rounded-xl p-3 disabled:bg-gray-400"
                   value="Zapisz Trening">
        </form>
    <?php endif; ?>
</section>
<?php require_once __DIR__ . "/../../../templates/footer.php"; ?>
</body>
</html>
