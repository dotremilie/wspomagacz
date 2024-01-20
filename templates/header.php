<nav class="bg-white dark:bg-slate-900 p-3 dark:text-slate-100 text-slate-800 sticky top-0 flex items-center">

    <?php if (isset($_SESSION['user_id'])): ?>
        <div class="w-full">
            <h1 class="text-3xl font-bold italic">WSPOMAGACZ</h1>
        </div>
        <a href="/logout" class="dark bg-slate-100 dark:bg-slate-800 h-full rounded p-2 flex items-center">
            <i data-feather="log-out"></i>
        </a>
    <?php else: ?>
        <div class="w-full text-center">
            <h1 class="text-3xl font-bold italic">WSPOMAGACZ</h1>
        </div>
    <?php endif; ?>
</nav>