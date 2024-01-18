<!doctype html>
<html lang="en">
<?php use Wspomagacz\Model\RankingCard;

/** @var array $data */
$rankingUserCard = $data['userCard'];

require_once __DIR__ . "/../../../templates/head.php";
require_once __DIR__ . "/../../../templates/header.php"; ?>
<body class="dark:bg-slate-900 bg-white dark:text-slate-100 text-slate-900">
<section class="w-full flex flex-col gap-4 mx-auto">
    <div class="flex justify-between items-center h-32 dark:bg-slate-800 bg-slate-100 px-4">
        <div>
            <div class="text-4xl font-semibold"><?= $rankingUserCard->getUsername(); ?></div>
            <div class="text-2xl"><?= $rankingUserCard->getWeight(); ?><span class="text-sm">KG</span></div>
        </div>
        <div class="text-right">
            <div class="font-semibold text-4xl">No.<?= $rankingUserCard->getPlace(); ?></div>
        </div>
    </div>
    <div>
        <div class="flex flex-col gap-4 px-4">
            <?php
            /** @var RankingCard $rankingCard */
            foreach ($data['ranking'] as $key => $rankingCard): ?>
                <div class="flex justify-between items-center dark:bg-slate-800 bg-slate-100 rounded-xl text-xl h-20">
                    <div class="w-16 h-full border-r dark:border-slate-900 border-white flex items-center justify-center text-4xl
                    <?php if ($key + 1 === 1) echo "text-red-400"; else if ($key + 1 === 2) echo "text-orange-400"; else if ($key + 1 === 3) echo "text-amber-400" ?>">
                        <?= $key + 1; ?>
                    </div>
                    <div class="grow flex flex-col pl-4 h-full leading-none justify-center">
                        <?= $rankingCard->getUsername(); ?>
                        <div class="text-sm dark:text-slate-400 text-slate-600">
                            <?php
                                echo $rankingCard->getTrainings();

                            if ($rankingCard->getTrainings() === 1) {
                                echo " trening";
                            } else if ($rankingCard->getTrainings() >= 2 && $rankingCard->getTrainings() <= 4) {
                                echo " treningi";
                            } else echo " treningów";
                            ?>
                        </div>
                    </div>
                    <div class="w-30 flex items-center text-right px-4 h-full">
                        <div>
                            <?= $rankingCard->getWeight(); ?><span class="text-xs">KG</span>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?php require_once __DIR__ . "/../../../templates/footer.php"; ?>
</body>
</html>