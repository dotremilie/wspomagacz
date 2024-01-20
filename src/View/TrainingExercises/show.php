<html lang="en">
<?php

use Wspomagacz\Enums\TrainingStatus;
use Wspomagacz\Model\Equipment;
use Wspomagacz\Model\ExerciseMuscle;
use Wspomagacz\Model\TrainingExercise;
use Wspomagacz\Model\TrainingExerciseSet;

require_once __DIR__ . "/../../../templates/head.php"; ?>
<body class="bg-white dark:bg-slate-900 dark:text-white text-slate-800 mb-20">
<?php require_once __DIR__ . "/../../../templates/header.php"; ?>
<section class="mx-auto p-4 flex flex-col gap-6">
    <?php
    /** @var array $data */
    /** @var TrainingExercise $exercise */

    if (isset($data['exercise']) && isset($data['training'])):
        $exercise = $data['exercise'];
        $training = $data['training']; ?>
        <div class="w-full">
            <div class="flex flex-col gap-4 mb-4">
                <a href="/trainings/<?= $training->getId() ?>/exercises/<?= $exercise->getId() ?>/delete"
                   class="w-full text-center border border-red-400 text-red-400 transition active:bg-red-500 rounded-xl p-3 disabled:bg-gray-400">
                    Usuń ćwiczenie
                </a>
                <div class="flex flex-col w-full gap-2 dark:bg-slate-800 bg-slate-100 rounded-xl p-4">
                    <div class="w-full flex items-center justify-between">
                        <div class="flex items-center gap-2">
                            <i class="ti ti-pencil text-xl"></i>
                            Nazwa
                        </div>
                        <div class="font-semibold">
                            <?= $exercise->getName(); ?>
                        </div>
                    </div>
                    <div class="w-full flex items-center justify-between">
                        <div class="flex items-center gap-2">
                            <i class="ti ti-barbell text-xl"></i>
                            Ilość serii
                        </div>
                        <div class="font-semibold">
                            <?= count($exercise->getSets()); ?>
                        </div>
                    </div>
                </div>
                <div class="grid w-full grid-cols-3 gap-4">
                    <?php switch ($exercise->getStatus()):
                        case TrainingStatus::Planned: ?>
                            <a class="flex items-center justify-center w-full bg-amber-400 dark:text-slate-800 rounded-xl text-xl p-4">
                                <div class="text-sm truncate flex flex-col justify-center gap-2 items-center aspect-square">
                                    <i data-feather="calendar" class="w-5 h-5"></i>
                                    Planowane
                                </div>
                            </a>
                            <a href="/trainings/<?= $training->getId(); ?>/exercises/<?= $exercise->getId(); ?>?set_status=2" class="flex items-center justify-center w-full dark:bg-slate-800 bg-slate-100 rounded-xl text-xl p-4">
                                <div class="text-sm truncate flex flex-col justify-center gap-2 items-center text-sky-400 aspect-square">
                                    <i data-feather="arrow-right-circle" class="w-5 h-5"></i>
                                    W trakcie
                                </div>
                            </a>
                            <a href="/trainings/<?= $training->getId(); ?>/exercises/<?= $exercise->getId(); ?>?set_status=3" class="flex items-center justify-center w-full bg-lime-400 dark:bg-slate-800 bg-slate-100 rounded-xl text-xl p-4">
                                <div class="text-sm truncate flex flex-col justify-center gap-2 items-center text-lime-400 aspect-square">
                                    <i data-feather="check-circle" class="w-5 h-5"></i>
                                    Wykonane
                                </div>
                            </a>
                            <?php break;
                        case TrainingStatus::InProgress: ?>
                            <a href="/trainings/<?= $training->getId(); ?>/exercises/<?= $exercise->getId(); ?>?set_status=1" class="flex items-center justify-center w-full dark:bg-slate-800 bg-slate-100 rounded-xl text-xl p-4">
                                <div class="text-sm truncate flex flex-col justify-center gap-2 items-center text-amber-400 aspect-square">
                                    <i data-feather="calendar" class="w-5 h-5"></i>
                                    Planowane
                                </div>
                            </a>
                            <a class="flex items-center justify-center w-full bg-sky-400 dark:text-slate-800 rounded-xl text-xl p-4">
                                <div class="text-sm truncate flex flex-col justify-center gap-2 items-center aspect-square">
                                    <i data-feather="arrow-right-circle" class="w-5 h-5"></i>
                                    W trakcie
                                </div>
                            </a>
                            <a href="/trainings/<?= $training->getId(); ?>/exercises/<?= $exercise->getId(); ?>?set_status=3" class="flex items-center justify-center w-full bg-lime-400 dark:bg-slate-800 bg-slate-100 rounded-xl text-xl p-4">
                                <div class="text-sm truncate flex flex-col justify-center gap-2 items-center text-lime-400 aspect-square">
                                    <i data-feather="check-circle" class="w-5 h-5"></i>
                                    Wykonane
                                </div>
                            </a>
                            <?php break;
                        case TrainingStatus::Completed: ?>
                            <a href="/trainings/<?= $training->getId(); ?>/exercises/<?= $exercise->getId(); ?>?set_status=1" class="flex items-center justify-center w-full dark:bg-slate-800 bg-slate-100 rounded-xl text-xl p-4">
                                <div class="text-sm truncate flex flex-col justify-center gap-2 items-center text-amber-400 aspect-square">
                                    <i data-feather="calendar" class="w-5 h-5"></i>
                                    Planowane
                                </div>
                            </a>
                            <a href="/trainings/<?= $training->getId(); ?>/exercises/<?= $exercise->getId(); ?>?set_status=2" class="flex items-center justify-center w-full dark:bg-slate-800 bg-slate-100 rounded-xl text-xl p-4">
                                <div class="text-sm truncate flex flex-col justify-center gap-2 items-center text-sky-400 aspect-square">
                                    <i data-feather="arrow-right-circle" class="w-5 h-5"></i>
                                    W trakcie
                                </div>
                            </a>
                            <a class="flex items-center justify-center w-full bg-lime-400 dark:text-slate-800 rounded-xl text-xl p-4">
                                <div class="text-sm truncate flex flex-col justify-center gap-2 items-center aspect-square">
                                    <i data-feather="check-circle" class="w-5 h-5"></i>
                                    Wykonane
                                </div>
                            </a>
                            <?php break;
                    endswitch; ?>
                </div>
            </div>
            <div class="text-2xl font-bold mb-4">Serie</div>
            <div class="w-full flex flex-col gap-4 justify-center items-center">
                <a href="/trainings/<?= $training->getId() ?>/exercises/<?= $exercise->getId() ?>/add_set"
                   class="w-full text-center bg-red-400 transition active:bg-red-500 rounded-xl p-3 disabled:bg-gray-400">
                    Dodaj serię
                </a>
                <?php
                /** @var TrainingExerciseSet $set */
                /** @var Equipment $eq */
                /** @var ExerciseMuscle $muscle */
                if (!empty($exercise->getSets())):
                    foreach ($exercise->getSets() as $set):
                        ?>
                        <a href="/trainings/<?= $training->getId(); ?>/exercises/<?= $exercise->getId(); ?>/sets/<?= $set->getId(); ?>"
                           class="flex items-center justify-between w-full dark:bg-slate-800 bg-slate-100 rounded-xl text-xl p-4">
                            <div class="flex flex-col h-full justify-center">
                                <div class="mb-4 truncate">Seria nr <?= $set->getOrder() ?></div>
                                <div class="text-sm dark:text-slate-400 text-slate-600 truncate">
                                    <i class="ti ti-123"></i>
                                    <?php echo $set->getRepetitions();

                                    if ($set->getRepetitions() === 1) echo " powtórzenie";
                                    else if ($set->getRepetitions() >= 2 && $set->getRepetitions() <= 4) echo " powtórzenia";
                                    else echo " powtórzeń"; ?>
                                </div>
                                <div class="text-sm dark:text-slate-400 text-slate-600 truncate">
                                    <i class="ti ti-weight"></i>
                                    <?= $set->getWeight() ?>kg
                                </div>
                            </div>
                            <div class="h-full flex items-center dark:text-slate-400 text-slate-600 pl-4">
                                <i data-feather="chevron-right"></i>
                            </div>
                        </a>
                    <?php endforeach;
                else: ?>
                    <div class="w-full items-center justify-center flex flex-col text-center gap-2 dark:text-slate-400 text-slate-600 w-32">
                        <i class="ti ti-mood-cry text-2xl"></i>
                        Nie znaleziono żadnych powtórzeń.
                    </div>
                <?php endif; ?>
            </div>
        </div>
    <?php else: ?>
        <div class="w-full items-center justify-center flex flex-col text-center gap-2 dark:text-slate-400 text-slate-600 w-32">
            <i class="ti ti-mood-cry text-2xl"></i>
            Nie znaleziono takiego ćwiczenia lub nie masz do niego uprawnień.
        </div>
    <?php endif; ?>
</section>
<?php require_once __DIR__ . "/../../../templates/footer.php"; ?>
</body>
</html>
