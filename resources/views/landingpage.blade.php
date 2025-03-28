<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>BillEase - Welcome</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
    <link rel="stylesheet" href="{{asset ('css/landingpage.css')}}" />
</head>
<body class="bg-gray-100">
    <header class="bg-blue-600 text-white py-4 px-6 flex justify-between items-center">
        <div class="flex items-center">
            <img src="/images/logo.webp" alt="BillEase Logo" class="h-10 w-10 mr-2 rounded-full">
            <h1 class="text-2xl font-bold">BillEase</h1>
        </div>
        <button onclick="toggleModal('loginModal')" class="bg-white text-blue-600 px-4 py-2 rounded shadow hover:bg-gray-200">
            Login
        </button>
    </header>

    <main class="flex flex-col items-center justify-center h-screen text-center px-6">
        <h2 class="text-4xl font-bold text-blue-600 mb-4">Simplify Your Bill Splitting</h2>
        <p class="text-lg text-gray-700 mb-6">Easily split expenses with friends and track your shared bills effortlessly.</p>
        
        <div class="flex space-x-6 mb-8">
            <div class="p-6 bg-white shadow-md rounded-lg w-64 text-center">
                <i data-lucide="users" class="h-16 w-16 mx-auto mb-2"></i>
                <h3 class="font-bold text-lg">Invite Users</h3>
                <p class="text-gray-600">Easily invite guests and registered users to split bills.</p>
            </div>
            <div class="p-6 bg-white shadow-md rounded-lg w-64 text-center">
                <i data-lucide="dollar-sign" class="h-16 w-16 mx-auto mb-2"></i>
                <h3 class="font-bold text-lg">Track Expenses</h3>
                <p class="text-gray-600">Monitor who paid and who owes in one place.</p>
            </div>
            <div class="p-6 bg-white shadow-md rounded-lg w-64 text-center">
                <i data-lucide="check-circle" class="h-16 w-16 mx-auto mb-2"></i>
                <h3 class="font-bold text-lg">Easy to Use</h3>
                <p class="text-gray-600">Simple interface for hassle-free bill management.</p>
            </div>
        </div>

        <div class="flex space-x-4">
            <a href="/guest" class="bg-gray-700 text-white px-6 py-3 rounded shadow hover:bg-gray-800">Continue as Guest</a>
            <button onclick="toggleModal('registerModal')" class="bg-blue-600 text-white px-6 py-3 rounded shadow hover:bg-blue-700">Create an Account</button>
        </div>
    </main>

 @include('modal.login')    
  @include('modal.registeration')    
    <script>
        lucide.createIcons();

       
        function toggleModal(modalId) {
        document.getElementById('loginModal').classList.add('hidden');
        document.getElementById('registerModal').classList.add('hidden');

        if (modalId) {
            document.getElementById(modalId).classList.remove('hidden');
        }
    }  
    
    function closeModal(modalId) {
    document.getElementById(modalId).classList.add('hidden');
}

// Close modal when clicking outside the modal content
document.addEventListener('click', function (event) {
    const loginModal = document.getElementById('loginModal');
    const registerModal = document.getElementById('registerModal');

    // Check if the clicked element is outside the modal content
    if (event.target === loginModal) {
        closeModal('loginModal');
    } else if (event.target === registerModal) {
        closeModal('registerModal');
    }
});
    </script>
</body>
</html>
