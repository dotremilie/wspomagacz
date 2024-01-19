<!doctype html>
<html lang="en">
<?php use Wspomagacz\Enums\TrainingStatus;
use Wspomagacz\Model\Training;
use Wspomagacz\Model\TrainingExercise;
use Wspomagacz\Model\UserExercisePersonalBest;

/** @var array $data */
$userStatistics = $data['userStatistics'];

require_once __DIR__ . "/../../../templates/head.php"; ?>
<body class="bg-white dark:bg-slate-900 dark:text-white text-slate-800 mb-20">
<?php require_once __DIR__ . "/../../../templates/header.php"; ?>
<div class="flex flex-col justify-center items-center gap-4">
    <div class="w-full p-4 dark:bg-slate-800 bg-slate-100">
        <div class="text-4xl font-semibold"> Witaj, <?= $userStatistics->getUsername(); ?>!</div>
    </div>
    <section class="mx-auto pl-4 w-full">
        <div class="text-2xl font-bold mb-4">Dzisiejszy plan</div>
        <?php if (isset($data['todayTraining'])):
            /** @var Training $todayTraining */
            $todayTraining = $data['todayTraining']; ?>
            <div class="flex gap-6 pr-4 mb-4">
                <div class="flex flex-col w-full gap-2 dark:bg-slate-800 bg-slate-100 rounded-xl p-4">
                    <div class="w-full flex items-center justify-between">
                        <div class="flex items-center gap-2">
                            <i class="ti ti-pencil text-xl"></i>
                            Nazwa
                        </div>
                        <div class="font-semibold">
                            <?= $todayTraining->getName(); ?>
                        </div>
                    </div>
                    <div class="w-full flex items-center justify-between">
                        <div class="flex items-center gap-2">
                            <i class="ti ti-barbell text-xl"></i>
                            Ilość ćwiczeń
                        </div>
                        <div class="font-semibold">
                            <?= count($todayTraining->getExercises()); ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="flex gap-6 overflow-x-scroll snap-x overflow-y-hidden pr-4">
                <?php /** @var TrainingExercise $exercise */
                foreach ($todayTraining->getExercises() as $exercise): ?>
                    <a href="/trainings/<?= $todayTraining->getId(); ?>/exercises/<?= $exercise->getId(); ?>" class="flex items-center dark:bg-slate-800 bg-slate-100 rounded-xl text-xl p-4">
                        <div class="flex flex-col h-full justify-center">
                            <div class="mb-4 truncate max-w-48">
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

                                if (count($exercise->getSets()) === 1) echo " powtórzenie";
                                else if (count($exercise->getSets()) >= 2 && count($exercise->getSets()) <= 4) echo " powtórzenia";
                                else echo " powtórzeń"; ?>
                            </div>
                        </div>
                        <div class="h-full flex items-center dark:text-slate-400 text-slate-600 pl-4">
                            <i data-feather="chevron-right"></i>
                        </div>
                    </a>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <div class="w-full pr-4">
                <div class="text-xl w-full flex flex-col gap-6 text-center rounded-xl">
                    <div class="text-center dark:text-slate-400 text-slate-600">
                        Nie zaplanowałeś na dzisiaj treningu.
                    </div>
                    <a href="/trainings/create"
                       class="w-full text-center bg-red-400 transition active:bg-red-500 rounded-xl p-3 disabled:bg-gray-400">
                        Nowy Trening
                    </a>
                </div>
            </div>
        <?php endif; ?>
    </section>
    <section class="mx-auto pl-4 w-full">
        <div class="text-2xl font-bold mb-4">Treningi społeczności</div>
        <div class="flex gap-6 overflow-x-scroll overflow-y-hidden snap-x pr-4">
            <div class="flex items-center dark:bg-slate-800 bg-slate-100 rounded-xl text-xl p-4">
                <div class="flex flex-col h-full leading-none justify-center">
                    <div class="mb-4 truncate max-w-48">
                        Przerzucanie żeliwa
                        <div class="text-sm dark:text-slate-400 text-slate-600 truncate">
                            utworzył <span class="font-semibold">sneakydog</span>
                        </div>
                    </div>
                    8 ćwiczeń
                </div>
                <div class="h-full flex items-center dark:text-slate-400 text-slate-600 pl-4">
                    <i class="ti ti-plus"></i>
                </div>
            </div>
            <div class="flex flex-col items-center justify-center rounded-xl text-xl p-4">
                <div class="h-full items-center justify-center flex flex-col text-center gap-2 dark:text-slate-400 text-slate-600 w-32">
                    <i class="ti ti-mood-cry"></i>
                    To wszystko w tej sekcji
                </div>
            </div>
    </section>
    <section class="mx-auto pl-4 w-full">
        <div class="text-2xl font-bold mb-4">Twoje rekordy</div>
        <div class="grid grid-cols-2 gap-4 overflow-y-scroll pr-4">
            <?php if (isset($data['personalBests'])):
                foreach ($data['personalBests'] as $personalBest): ?>
            <a href="/trainings/<?= $personalBest->getTrainingId(); ?>" class="p-6 dark:bg-slate-800 bg-slate-100 rounded-xl flex items-center">
                <div>
                    <div class="text-lg"><?= $personalBest->getTrainingExerciseName(); ?></div>
                    <div class="text-gray-400 max-w-64 truncate">
                        <div class="flex gap-2 items-center">
                            <i class="ti ti-calendar"></i>
                            <div class="max-w-64 truncate">
                                <?= $personalBest->getDate()->format('d.m.Y'); ?>
                            </div>
                        </div>
                        <div class="flex gap-2 items-center">
                            <i class="ti ti-weight"></i>
                            <div class="max-w-64 truncate"><?= $personalBest->getWeight(); ?>kg</div>
                        </div>
                    </div>
                </div>
            </a>
            <?php endforeach; ?>
            <?php endif; ?>
    </section>
    <section class="mx-auto rounded-xl px-4 w-full">
        <div class="text-2xl font-bold mb-4">Statystyki ogólne</div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            <div class="dark:bg-slate-800 bg-slate-100 p-6 rounded-xl">
                <div class="text-2xl dark:text-sky-400 text-sky-600 flex gap-2 items-center mb-2"><i
                            class="ti ti-weight"></i>Podniesiony ciężar
                </div>
                <div class="text-xl font-semibold"><?= $userStatistics->getWeight(); ?>kg</div>
            </div>
            <div class="dark:bg-slate-800 bg-slate-100 p-6 rounded-xl">
                <div class="text-2xl dark:text-lime-400 text-lime-600 flex gap-2 items-center mb-2"><i
                            class="ti ti-barbell"></i>Wykonane ćwiczenia
                </div>
                <div class="text-xl font-semibold"><?= $userStatistics->getExercises(); ?></div>
            </div>
            <div class="dark:bg-slate-800 bg-slate-100 p-6 rounded-xl">
                <div class="text-2xl dark:text-amber-400 text-amber-600 flex gap-2 items-center mb-2"><i
                            class="ti ti-flame"></i>Spalone kalorie
                </div>
                <div class="text-xl font-semibold"><?= $userStatistics->getBurntCalories(); ?></div>
            </div>
        </div>
    </section>
</div>
<?php require_once __DIR__ . "/../../../templates/footer.php"; ?>
</body>
</html>