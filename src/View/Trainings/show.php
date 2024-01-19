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
<section class="mx-auto p-4 flex flex-col gap-6">
    <?php
    /** @var array $data */
    /** @var Training $training */

    if (isset($data['training'])):
        $training = $data['training']; ?>
        <div class="w-full">
            <div class="flex flex-col gap-4 mb-4">
                <a href="/trainings/<?= $training->getId() ?>/edit"
                   class="w-full text-center border border-sky-400 text-sky-400 transition rounded-xl p-3 disabled:bg-gray-400">
                    Edytuj trening
                </a>
                <a href="/trainings/<?= $training->getId() ?>/delete"
                   class="w-full text-center border border-red-400 text-red-400 transition rounded-xl p-3 disabled:bg-gray-400">
                    Usuń trening
                </a>
                <div class="flex flex-col w-full gap-2 dark:bg-slate-800 bg-slate-100 rounded-xl p-4">
                    <div class="w-full flex items-center justify-between">
                        <div class="flex items-center gap-2">
                            <i class="ti ti-pencil text-xl"></i>
                            Nazwa
                        </div>
                        <div class="font-semibold">
                            <?= $training->getName(); ?>
                        </div>
                    </div>
                    <div class="w-full flex items-center justify-between">
                        <div class="flex items-center gap-2">
                            <i class="ti ti-barbell text-xl"></i>
                            Ilość ćwiczeń
                        </div>
                        <div class="font-semibold">
                            <?= count($training->getExercises()); ?>
                        </div>
                    </div>
                    <div class="w-full flex items-center justify-between">
                        <div class="flex items-center gap-2">
                            <i class="ti ti-calendar text-xl"></i>
                            Data
                        </div>
                        <div class="font-semibold">
                            <?= $training->getDate()->format('d.m.Y'); ?>
                        </div>
                    </div>
                </div>
                <div class="grid w-full grid-cols-3 gap-4">
                    <?php switch ($training->getStatus()):
                        case TrainingStatus::Planned: ?>
                            <a class="flex items-center justify-center w-full bg-amber-400 dark:text-slate-800 rounded-xl text-xl p-4">
                                <div class="text-sm truncate flex flex-col justify-center gap-2 items-center aspect-square">
                                    <i data-feather="calendar" class="w-5 h-5"></i>
                                    Planowane
                                </div>
                            </a>
                            <a href="/trainings/<?= $training->getId(); ?>?set_status=2" class="flex items-center justify-center w-full dark:bg-slate-800 bg-slate-100 rounded-xl text-xl p-4">
                                <div class="text-sm truncate flex flex-col justify-center gap-2 items-center text-sky-400 aspect-square">
                                    <i data-feather="arrow-right-circle" class="w-5 h-5"></i>
                                    W trakcie
                                </div>
                            </a>
                            <a href="/trainings/<?= $training->getId(); ?>?set_status=3" class="flex items-center justify-center w-full bg-lime-400 dark:bg-slate-800 bg-slate-100 rounded-xl text-xl p-4">
                                <div class="text-sm truncate flex flex-col justify-center gap-2 items-center text-lime-400 aspect-square">
                                    <i data-feather="check-circle" class="w-5 h-5"></i>
                                    Wykonane
                                </div>
                            </a>
                            <?php break;
                        case TrainingStatus::InProgress: ?>
                            <a href="/trainings/<?= $training->getId(); ?>?set_status=1" class="flex items-center justify-center w-full dark:bg-slate-800 bg-slate-100 rounded-xl text-xl p-4">
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
                            <a href="/trainings/<?= $training->getId(); ?>?set_status=3" class="flex items-center justify-center w-full bg-lime-400 dark:bg-slate-800 bg-slate-100 rounded-xl text-xl p-4">
                                <div class="text-sm truncate flex flex-col justify-center gap-2 items-center text-lime-400 aspect-square">
                                    <i data-feather="check-circle" class="w-5 h-5"></i>
                                    Wykonane
                                </div>
                            </a>
                            <?php break;
                        case TrainingStatus::Completed: ?>
                            <a href="/trainings/<?= $training->getId(); ?>?set_status=1" class="flex items-center justify-center w-full dark:bg-slate-800 bg-slate-100 rounded-xl text-xl p-4">
                                <div class="text-sm truncate flex flex-col justify-center gap-2 items-center text-amber-400 aspect-square">
                                    <i data-feather="calendar" class="w-5 h-5"></i>
                                    Planowane
                                </div>
                            </a>
                            <a href="/trainings/<?= $training->getId(); ?>?set_status=2" class="flex items-center justify-center w-full dark:bg-slate-800 bg-slate-100 rounded-xl text-xl p-4">
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
            <div class="text-2xl font-bold mb-4">Ćwiczenia</div>
            <div class="w-full flex flex-col gap-4 justify-center items-center">
                <a href="/trainings/<?= $training->getId(); ?>/add_exercise/"
                   class="w-full text-center bg-red-400 transition active:bg-red-500 rounded-xl p-3 disabled:bg-gray-400">
                    Dodaj ćwiczenie
                </a>
                <?php
                /** @var TrainingExercise $exercise */
                /** @var Equipment $eq */
                /** @var ExerciseMuscle $muscle */
                if (!empty($training->getExercises())):
                    foreach ($training->getExercises() as $exercise):
                        ?>
                        <a href="/trainings/<?= $training->getId(); ?>/exercises/<?= $exercise->getId(); ?>"
                           class="flex items-center justify-between w-full dark:bg-slate-800 bg-slate-100 rounded-xl text-xl p-4">
                            <div class="flex flex-col h-full justify-center">
                                <div class="mb-4 truncate">
                                    <?= $exercise->getName() ?>
                                    <?php switch ($exercise->getStatus()):
                                        case TrainingStatus::Planned: ?>
                                            <div class="text-sm truncate flex gap-2 items-center text-amber-400">
                                                <i data-feather="calendar" class="w-4 h-4"></i>
                                                Zaplanowane
                                            </div>
                                            <?php break;
                                        case TrainingStatus::InProgress: ?>
                                            <div class="text-sm truncate flex gap-2 items-center text-sky-400">
                                                <i data-feather="arrow-right-circle" class="w-4 h-4"></i>
                                                W trakcie
                                            </div>
                                            <?php break;
                                        case TrainingStatus::Completed: ?>
                                            <div class="text-sm truncate flex gap-2 items-center text-lime-400">
                                                <i data-feather="check-circle" class="w-4 h-4"></i>
                                                Wykonane
                                            </div>
                                            <?php break;
                                    endswitch; ?>
                                </div>
                                <div class="text-sm dark:text-slate-400 text-slate-600 truncate">
                                    <?php echo count($exercise->getSets());

                                    if (count($exercise->getSets()) === 1) echo " seria";
                                    else if (count($exercise->getSets()) >= 2 && count($exercise->getSets()) <= 4) echo " serie";
                                    else echo " serii"; ?>
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
                        Nie znaleziono żadnych ćwiczeń.
                    </div>
                <?php endif; ?>
            </div>
        </div>
    <?php else: ?>
        <div class="w-full items-center justify-center flex flex-col text-center gap-2 dark:text-slate-400 text-slate-600 w-32">
            <i class="ti ti-mood-cry text-2xl"></i>
            Nie znaleziono takiego treningu lub nie masz do niego uprawnień.
        </div>
    <?php endif; ?>
</section>
<?php require_once __DIR__ . "/../../../templates/footer.php"; ?>
</body>
</html>

