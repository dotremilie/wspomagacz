<nav class="bg-white dark:bg-slate-900 text-slate-800 dark:text-white fixed bottom-0 w-full h-[60px] flex justify-between items-center">
        <?php if ($_SERVER['REQUEST_URI'] === '/'): ?>
            <div class="flex flex-col gap-2 justify-center items-center w-full py-3">
                <i data-feather="home"></i>
                <span class="h-[0.15rem] rounded-xl bg-red-600 w-1/4"></span>
            </div>
        <?php else: ?>
            <a href="/"
               class="flex flex-col gap-2 justify-center items-center w-full py-3 group active:text-red-600 active:dark:bg-slate-800 transition">
                <i data-feather="home"></i>
                <span class="h-[0.15rem] rounded-xl hidden bg-white w-1/4 group-hover:block group-active:bg-red-600 transition"></span>
            </a>
        <?php endif; ?>
        <?php if ($_SERVER['REQUEST_URI'] === '/exercises'): ?>
            <div class="flex flex-col gap-2 justify-center items-center w-full py-3">
                <i data-feather="zap"></i>
                <span class="h-[0.15rem] rounded-xl bg-red-600 w-1/4"></span>
            </div>
        <?php else:?>
            <a href="/exercises"
               class="flex flex-col gap-2 justify-center items-center w-full py-3 group active:text-red-600 active:dark:bg-slate-800 transition">
                <i data-feather="zap"></i>
                <span class="h-[0.15rem] rounded-xl hidden bg-white w-1/4 group-hover:block group-active:bg-red-600 transition"></span>
            </a>
        <?php endif; ?>
        <div class="w-full flex justify-center items-center transition">
            <a href="/training"
               class="flex gap-2 justify-center items-center w-full p-3 bg-red-600 rounded-xl active:bg-red-500">
                <i data-feather="plus"></i>
            </a>
        </div>
        <?php if ($_SERVER['REQUEST_URI'] === '/ranking'): ?>
            <div class="flex flex-col gap-2 justify-center items-center w-full py-3">
                <i data-feather="award"></i>
                <span class="h-[0.15rem] rounded-xl bg-red-600 w-1/4"></span>
            </div>
        <?php else: ?>
            <a href="/ranking"
               class="flex flex-col gap-2 justify-center items-center w-full py-3 group active:text-red-600 active:dark:bg-slate-800 transition">
                <i data-feather="award"></i>
                <span class="h-[0.15rem] rounded-xl hidden bg-white w-1/4 group-hover:block group-active:bg-red-600 transition"></span>
            </a>
        <?php endif; ?>
        <?php if ($_SERVER['REQUEST_URI'] === '/profile'): ?>
            <div class="flex flex-col gap-2 justify-center items-center w-full py-3">
                <i data-feather="user"></i>
                <span class="h-[0.15rem] rounded-xl bg-red-600 w-1/4"></span>
            </div>
        <?php else: ?>
            <a href="/profile"
               class="flex flex-col gap-2 justify-center items-center w-full py-3 group active:text-red-600 active:dark:bg-slate-800 transition">
                <i data-feather="user"></i>
                <span class="h-[0.15rem] rounded-xl hidden bg-white w-1/4 group-hover:block group-active:bg-red-600 transition"></span>
            </a>
        <?php endif; ?>
</nav>

<script>feather.replace();</script>