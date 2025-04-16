<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Guest Access | BillSplit Pro</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#4F46E5',
                        secondary: '#10B981',
                    },
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                    },
                }
            }
        }
    </script>
</head>
<body class="font-sans bg-gray-50 min-h-screen flex flex-col">
    <!-- Header -->
    <header class="bg-white shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center py-4">
                <div class="flex items-center">
                    <div class="flex-shrink-0 flex items-center">
                        <svg class="h-8 w-8 text-primary" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span class="ml-2 text-xl font-bold text-gray-900">BillSplit Pro</span>
                    </div>
                </div>
                <div class="flex items-center space-x-4">
                    <a href="{{route('landingpage')}}" class="text-gray-500 hover:text-gray-900 text-sm font-medium">Back to Home</a>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="flex-grow">
        <div class="max-w-md mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="bg-white p-8 rounded-lg shadow-sm border border-gray-200">
                <div class="text-center mb-8">
                    <svg class="mx-auto h-12 w-12 text-primary" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                    </svg>
                    <h2 class="mt-4 text-2xl font-bold text-gray-900">Guest Access</h2>
                    <p class="mt-2 text-sm text-gray-600">
                        Enter the invitation code provided by your host to view the bill details.
                    </p>
                    <p class="mt-1 text-xs text-gray-500">
                        Note: As a guest, you can only view one bill per day.
                    </p>
                </div>

                <form class="space-y-6" action="#" method="POST">
                    <div>
                        <label for="invitation-code" class="block text-sm font-medium text-gray-700">
                            Invitation Code
                        </label>
                        <div class="mt-1 relative rounded-md shadow-sm">
                            <input id="invitation-code" name="invitation-code" type="text" required 
                                class="py-3 px-4 block w-full border border-gray-300 rounded-md focus:ring-primary focus:border-primary"
                                placeholder="e.g. ABC123XYZ">
                        </div>
                        <p class="mt-1 text-xs text-gray-500">
                            This 8-10 digit code was shared by the bill owner.
                        </p>
                    </div>

                    <div>
                        <label for="your-name" class="block text-sm font-medium text-gray-700">
                            Your Name (Optional)
                        </label>
                        <div class="mt-1">
                            <input id="your-name" name="your-name" type="text" 
                                class="py-3 px-4 block w-full border border-gray-300 rounded-md focus:ring-primary focus:border-primary"
                                placeholder="How you'll appear to others">
                        </div>
                    </div>

                    <div class="flex items-center">
                        <input id="terms" name="terms" type="checkbox" required
                            class="h-4 w-4 text-primary focus:ring-primary border-gray-300 rounded">
                        <label for="terms" class="ml-2 block text-sm text-gray-700">
                            I understand this is a guest session with limited access
                        </label>
                    </div>

                    <div>
                        <button type="submit"
                            class="w-full flex justify-center py-3 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-primary hover:bg-primary-dark focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary">
                            View Bill
                        </button>
                    </div>
                </form>

                <div class="mt-6 text-center">
                    <p class="text-sm text-gray-600">
                        Need full access? <a href="/signup" class="font-medium text-primary hover:text-primary-dark">Create an account</a>
                    </p>
                </div>
            </div>
        </div>
    </main>

    <!-- Simple Footer -->
    <footer class="bg-gray-800 py-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <p class="text-gray-400 text-sm">
                &copy; 2023 BillSplit Pro. All rights reserved.
            </p>
        </div>
    </footer>
</body>
</html>