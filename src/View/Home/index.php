<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?= /** @var string $title */ $title; ?></title>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
</head>
<body class="bg-gray-100 font-sans">


    <nav class="bg-blue-500 p-4 text-white">
        <div class="container mx-auto">
            <h1 class="text-2xl font-bold">Wspomagacz</h1>
            <a href="login.html" class="text-white hover:underline">Logowanie</a>
        </div>
    </nav>


    <section class="container mx-auto mt-8 p-4 bg-white rounded-lg shadow-md max-w-3xl">
        <style>
   
        </style>
        <h2 class="text-2xl font-bold mb-4">Moje dzisiejsze wyniki 🔥 💪</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">

            <div class="bg-blue-500 text-white p-6 rounded-md">
                <h2 class="text-lg font-bold mb-2">Przerzucone żeliwo</h2>
                <p class="text-3xl font-bold">2 tony</p>
            </div>

            <div class="bg-green-500 text-white p-6 rounded-md">
                <h2 class="text-lg font-bold mb-2">Wykonane ćwiczenia dzisiaj</h2>
                <p class="text-3xl font-bold">15</p>
            </div>

            <div class="bg-orange-500 text-white p-6 rounded-md">
                <h2 class="text-lg font-bold mb-2">Spalone kalorie</h2>
                <p class="text-3xl font-bold">1000 kcal</p>
            </div>
        </div>
    </section>


    <section class="container mx-auto mt-8 p-4 bg-white rounded-lg shadow-md max-w-3xl">
        <h2 class="text-2xl font-bold mb-4">Moje ostatnie ćwiczenia</h2>

        <ul>
            <li class="mb-4">
                <p class="text-lg font-bold">Klata na ławeczce</p>
                <p class="text-gray-600">3 serie | 8 powtórzeń | 80kg</p>
            </li>
            <li class="mb-4">
                <p class="text-lg font-bold">Bułgary</p>
                <p class="text-gray-600">3 serie | 12 powtórzeń | 2x10kg</p>
            </li>
            <li class="mb-4">
                <p class="text-lg font-bold">Bułgary</p>
                <p class="text-gray-600">3 serie | 12 powtórzeń | 2x10kg</p>
            </li>
            <li class="mb-4">
                <p class="text-lg font-bold">Bułgary</p>
                <p class="text-gray-600">3 serie | 12 powtórzeń | 2x10kg</p>
            </li>
            <li class="mb-4">
                <p class="text-lg font-bold">Bułgary</p>
                <p class="text-gray-600">3 serie | 12 powtórzeń | 2x10kg</p>
            </li>

        </ul>
    </section>
</body>
</html>