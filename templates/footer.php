<nav class="bg-slate-100 dark:bg-slate-800 text-slate-800 dark:text-white fixed bottom-0 w-full flex justify-between">
    <?php if ($_SERVER['REQUEST_URI'] === '/'): ?>
        <a href="/" class="grow flex justify-center p-4 text-red-400 active:dark:bg-slate-700 active:bg-slate-200 transition">
            <i data-feather="home"></i>
        </a>
    <?php else: ?>
        <a href="/" class="grow flex justify-center p-4 active:dark:bg-slate-700 active:bg-slate-200 transition">
            <i data-feather="home"></i>
        </a>
    <?php endif; ?>
    <?php if (str_starts_with($_SERVER['REQUEST_URI'], '/exercises')): ?>
        <a href="/exercises" class="grow flex justify-center p-4 text-red-400 active:dark:bg-slate-700 active:bg-slate-200 transition">
            <i data-feather="zap"></i>
        </a>
    <?php else: ?>
        <a href="/exercises" class="grow flex justify-center p-4 active:dark:bg-slate-700 active:bg-slate-200 transition">
            <i data-feather="zap"></i>
        </a>
    <?php endif; ?>
    <?php if (str_starts_with($_SERVER['REQUEST_URI'], '/training')): ?>
        <a href="/trainings" class="grow flex justify-center p-4 text-red-400 active:dark:bg-slate-700 active:bg-slate-200 transition">
            <i data-feather="activity"></i>
        </a>
    <?php else: ?>
        <a href="/trainings" class="grow flex justify-center p-4 active:dark:bg-slate-700 active:bg-slate-200 transition">
            <i data-feather="activity"></i>
        </a>
    <?php endif; ?>
    <?php if (str_starts_with($_SERVER['REQUEST_URI'], '/ranking')): ?>
        <a href="/ranking" class="grow flex justify-center p-4 text-red-400 active:dark:bg-slate-700 active:bg-slate-200 transition">
            <i data-feather="award"></i>
        </a>
    <?php else: ?>
        <a href="/ranking" class="grow flex justify-center p-4 active:dark:bg-slate-700 active:bg-slate-200 transition">
            <i data-feather="award"></i>
        </a>
    <?php endif; ?>
</nav>
<script>feather.replace()</script>