<!doctype html>
<html lang="en">
<?php
use Wspomagacz\Model\Equipment;
use Wspomagacz\Model\Exercise;
use Wspomagacz\Model\Muscle;

require_once __DIR__ . "/../../../templates/head.php";
require_once __DIR__ . "/../../../templates/header.php";
?>
<body class="bg-gray-100 dark:bg-slate-900 dark:text-white text-slate-800">
<section class="mx-auto p-4">
    <div class="w-full flex flex-col gap-4 justify-center items-center">
        <?php
        /** @var array $data */
        /** @var Exercise $exercise */
        /** @var Equipment $equipment */
        /** @var Muscle $muscle */
        foreach ($data as $exercise): ?>
        <a id="exercise-<?= $exercise->getId() ?>" href="" class="w-full p-6 dark:bg-slate-800 rounded-xl flex justify-between items-center">
            <div>
                <div class="text-lg font-bold"><?= $exercise->getName() ?></div>
                <div class="text-gray-400"><?php foreach ($exercise->getEquipmentUsed() as $equipment) echo $equipment->getName() ?> | <?php foreach ($exercise->getMusclesUsed() as $muscle) echo $muscle->getName() ?></div>
            </div>
            <i data-feather="chevron-right" class="text-gray-400"></i>
        </a>
        <?php endforeach; ?>
    </div>
</section>
<?php require_once __DIR__ . "/../../../templates/footer.php"; ?>
</body>
</html>
