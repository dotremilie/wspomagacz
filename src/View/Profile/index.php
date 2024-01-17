<!doctype html>
<html lang="en">
<?php require_once __DIR__ . "/../../../templates/head.php"; ?>
<body class="bg-gray-100 dark:bg-slate-900 dark:text-white text-slate-800">
<?php require_once __DIR__ . "/../../../templates/header.php"; ?>
<section class="container mx-auto mt-4 p-4">
    <div class="mb-4">
        <h2 class="text-xl font-bold mb-2">DJ Daddy Riddim</h2>
        <div class="border p-4 rounded-lg">
            <p class="text-lg font-bold mb-2">Nazwa użytkownika: riddaddy</p>
            <p class="text-gray-600 mb-2">Wiek: 30</p>
            <p class="text-gray-600 mb-2">Lokalizacja: Radgoszcz, Polska</p>
            <p class="text-gray-600 mb-2">Liczba treningów: 1678</p>
        </div>
    </div>
    <div>
        <h2 class="text-xl font-bold mb-2">Zmiana hasła</h2>
        <form class="border p-4 rounded-lg">
            <div class="mb-4">
                <label for="currentPassword" class="block text-gray-700 text-sm font-bold mb-2">Current
                    Password:</label>
                <input type="password" id="currentPassword" name="currentPassword"
                       class="border rounded-lg px-3 py-2 w-full">
            </div>
            <div class="mb-4">
                <label for="newPassword" class="block text-gray-700 text-sm font-bold mb-2">New Password:</label>
                <input type="password" id="newPassword" name="newPassword" class="border rounded-lg px-3 py-2 w-full">
            </div>
            <div>
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg">Change Password</button>
            </div>
        </form>
    </div>
</section>
<?php require_once __DIR__ . "/../../../templates/footer.php"; ?>
</body>
</html>