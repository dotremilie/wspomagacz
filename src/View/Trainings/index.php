<!doctype html>
<html lang="en">
<?php

use Wspomagacz\Enums\TrainingStatus;
use Wspomagacz\Model\Training;

require_once __DIR__ . "/../../../templates/head.php"; ?>
<body class="bg-white dark:bg-slate-900 dark:text-white text-slate-800 mb-20">
<?php require_once __DIR__ . "/../../../templates/header.php"; ?>
<section class="mx-auto p-4 flex flex-col gap-6">
    <div class="w-full">
        <div class="text-2xl font-bold mb-4">Twoje Treningi</div>
        <div class="w-full flex flex-col gap-4 justify-center items-center">
            <?php
            /** @var array $data */
            /** @var Training $training */

            if (!empty($data)): ?>
                <a href="/trainings/create"
                   class="w-full text-center bg-red-400 transition active:bg-red-500 rounded-xl p-3 disabled:bg-gray-400">
                    Nowy trening
                </a>
                <?php foreach ($data as $training): ?>
                    <a id="training-<?= $training->getId() ?>" href="/trainings/<?= $training->getId() ?>"
                       class="w-full p-6 dark:bg-slate-800 bg-slate-100 rounded-xl flex justify-between items-center">
                        <div>
                            <div class="text-lg font-bold"><?= $training->getName() ?></div>
                            <div class="text-gray-400 max-w-64 truncate">
                                <?php switch ($training->getStatus()):
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
                            <div class="text-gray-400 max-w-64 truncate">
                                <div class="flex gap-2 items-center">
                                    <i class="ti ti-calendar"></i>
                                    <div class="max-w-64 truncate"><?= $training->getDate()->format('d.m.Y') ?></div>
                                </div>
                            </div>
                        </div>
                        <i data-feather="chevron-right" class="text-gray-400"></i>
                    </a>
                <?php endforeach;
            else: ?>
                <div class="w-full">
                    <div class="text-xl w-full flex flex-col gap-6 text-center rounded-xl">
                        <div class="text-center dark:text-slate-400 text-slate-600">
                            Nie znaleziono żadnych treningów.
                        </div>
                        <a href="/trainings/create"
                           class="w-full text-center bg-red-400 transition active:bg-red-500 rounded-xl p-3 disabled:bg-gray-400">
                            Nowy trening
                        </a>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>
<?php require_once __DIR__ . "/../../../templates/footer.php"; ?>
</body>
</html>

