<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Guest Bill View</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://kit.fontawesome.com/YOUR_KIT_ID.js" crossorigin="anonymous"></script>
</head>
<body class="bg-gray-100">
    <header class="bg-blue-600 text-white py-4 px-6 flex justify-between items-center">
        <div class="flex items-center">
            <h1 class="text-2xl font-bold">BillEase</h1>
        </div>
        <a href="/landingpage" class="bg-white text-blue-600 px-4 py-2 rounded shadow hover:bg-gray-200">Back</a>
    </header>

    <main class="flex flex-col items-center justify-center min-h-screen text-center px-6">
        <h2 class="text-3xl font-bold text-blue-600 mb-4">Enter Invitation Code</h2>
        <p class="text-lg text-gray-700 mb-6">To view the bill, enter the invitation code provided by the host.</p>
        <form action="/guest/bill" method="POST" class="bg-white p-6 rounded-lg shadow-md w-96">
            <label for="invite_code" class="block text-gray-700 font-bold mb-2">Invitation Code</label>
            <input type="text" id="invite_code" name="invite_code" required class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600">
            <button type="submit" class="mt-4 bg-blue-600 text-white px-6 py-2 rounded shadow hover:bg-blue-700">View Bill</button>
        </form>
    </main>
</body>
</html>
