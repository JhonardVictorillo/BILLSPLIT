<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | BillSplit Pro</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        .input-field {
            padding: 12px 16px;
            font-size: 16px;
        }
        .error-message {
            font-size: 14px;
            margin-top: 8px;
        }
    </style>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#4F46E5',
                        secondary: '#10B981',
                        danger: '#EF4444'
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
            <div class="flex justify-between items-center py-6">
                <div class="flex items-center">
                    <div class="flex-shrink-0 flex items-center">
                        <svg class="h-10 w-10 text-primary" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span class="ml-3 text-2xl font-bold text-gray-900">BillSplit Pro</span>
                    </div>
                </div>
                <div class="flex items-center space-x-6">
                    <a href="{{route('landingpage')}}" class="text-gray-500 hover:text-gray-900 text-base font-medium">Home</a>
                    <a href="{{route('register.form')}}" class="text-gray-500 hover:text-gray-900 text-base font-medium">Register</a>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="flex-grow flex items-center justify-center p-6">
        <div class="max-w-lg w-full mx-auto px-4 sm:px-8 py-12">
            <div class="bg-white p-10 rounded-lg shadow-sm border border-gray-200">
                <div class="text-center mb-10">
                    <h2 class="text-3xl font-bold text-gray-900">Welcome back</h2>
                    <p class="mt-4 text-base text-gray-600">
                        Log in to your BillSplit Pro account to manage your shared expenses.
                    </p>
                </div>

                <!-- Session Status -->
                @if (session('status'))
                    <div class="mb-6 p-4 bg-green-100 border border-green-400 text-green-700 rounded text-base">
                        {{ session('status') }}
                    </div>
                @endif

                <!-- Validation Errors -->
                @if ($errors->any())
                    <div class="mb-6 p-4 bg-red-100 border border-red-400 text-red-700 rounded text-base">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form class="space-y-6" method="POST" action="{{ route('login') }}">
                    @csrf

                    <!-- Username/Email -->
                    <div>
                        <label for="username" class="block text-base font-medium text-gray-700">
                            Username or Email <span class="text-danger">*</span>
                        </label>
                        <div class="mt-2 relative">
                            <input id="username" name="username" type="text" required 
                                class="input-field block w-full border border-gray-300 rounded-md focus:ring-primary focus:border-primary"
                                value="{{ old('username') }}"
                                autofocus
                                oninput="validateLoginField()">
                            <div class="error-message text-danger hidden" id="username-error"></div>
                        </div>
                    </div>

                    <!-- Password -->
                    <div>
                        <label for="password" class="block text-base font-medium text-gray-700">
                            Password <span class="text-danger">*</span>
                        </label>
                        <div class="mt-2 relative">
                            <input id="password" name="password" type="password" required 
                                class="input-field block w-full border border-gray-300 rounded-md focus:ring-primary focus:border-primary"
                                oninput="validatePasswordField()">
                            <div class="error-message text-danger hidden" id="password-error"></div>
                        </div>
                    </div>

                    <!-- Remember Me & Forgot Password -->
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <input id="remember" name="remember" type="checkbox" 
                                class="h-5 w-5 text-primary focus:ring-primary border-gray-300 rounded">
                            <label for="remember" class="ml-3 block text-base text-gray-700">
                                Remember me
                            </label>
                        </div>

                        <div class="text-base">
                            <a href="#forgot-password" id="forgot-password-link" class="font-medium text-primary hover:text-primary-dark">
                                Forgot your password?
                            </a>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="pt-4">
                        <button type="submit" id="submit-button"
                            class="w-full flex justify-center py-3 px-6 border border-transparent rounded-md shadow-sm text-base font-medium text-white bg-primary hover:bg-primary-dark focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary">
                            Log in
                        </button>
                    </div>
                </form>

                <!-- Forgot Password Modal -->
                <div class="hidden fixed inset-0 bg-gray-500 bg-opacity-75 flex items-center justify-center z-50" id="forgot-password-modal">
                    <div class="bg-white rounded-lg shadow-xl max-w-md w-full p-6">
                        <div class="flex justify-between items-start">
                            <h3 class="text-lg font-medium text-gray-900">Reset your password</h3>
                            <button type="button" id="close-modal" class="text-gray-400 hover:text-gray-500">
                                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>
                        <form method="POST" action="{{ route('password.email') }}">
                             @csrf
                        <div class="mt-4">
                            <p class="text-sm text-gray-600">
                                Enter your email address and we'll send you a link to reset your password.
                            </p>
                            <div class="mt-4">
                                <label for="email" class="block text-sm font-medium text-gray-700">
                                    Email address <span class="text-red-600">*</span>
                                </label>
                                <div class="mt-1">
                                    <input id="email" name="email" type="email" required 
                                        class="py-2 px-3 block w-full border border-gray-300 rounded-md focus:ring-primary focus:border-primary">
                                </div>
                            </div>
                        </div>
                        <div class="mt-5 sm:mt-6">
                            <button type="submit" id="send-reset-link"
                                class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-primary hover:bg-primary-dark focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary">
                                Send reset link
                            </button>
                        </div>
                        </form>
                    </div>
                </div>
                @if ($errors->has('email'))
                    <script>
                        document.getElementById('forgot-password-modal').classList.remove('hidden');
                    </script>
                @endif

                <div class="mt-8 text-center">
                    <p class="text-base text-gray-600">
                        Don't have an account? <a href="{{ route('register.form') }}" class="font-medium text-primary hover:text-primary-dark">Register</a>
                    </p>
                </div>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-gray-800 py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <p class="text-base text-gray-400">
                &copy; 2025 BillSplit Pro. All rights reserved.
            </p>
        </div>
    </footer>

    <script>
        // Field validation functions
        function validateLoginField() {
            const login = document.getElementById('username');
            const errorElement = document.getElementById('username-error');
            
            errorElement.classList.add('hidden');
            login.classList.remove('border-danger');
            
            if (!login.value.trim()) {
                showError('username', 'Username or email is required');
                return false;
            }
            
            return true;
        }

        function validatePasswordField() {
            const password = document.getElementById('password');
            const errorElement = document.getElementById('password-error');
            
            errorElement.classList.add('hidden');
            password.classList.remove('border-danger');
            
            if (!password.value.trim()) {
                showError('password', 'Password is required');
                return false;
            }
            
            return true;
        }

        // Show error message
        function showError(fieldName, message) {
            const field = document.getElementById(fieldName);
            const errorElement = document.getElementById(`${fieldName}-error`);
            
            errorElement.textContent = message;
            errorElement.classList.remove('hidden');
            field.classList.add('border-danger');
        }

        // Form validation on submit
        document.querySelector('form').addEventListener('submit', function(e) {
            // Validate fields
            const isValidLogin = validateLoginField();
            const isValidPassword = validatePasswordField();
            
            if (!isValidLogin || !isValidPassword) {
                e.preventDefault();
                // Scroll to first error
                const firstError = document.querySelector('.border-danger');
                if (firstError) {
                    firstError.scrollIntoView({ behavior: 'smooth', block: 'center' });
                }
            }
        });

        // Forgot password modal
        document.getElementById('forgot-password-link').addEventListener('click', function(e) {
            e.preventDefault();
            document.getElementById('forgot-password-modal').classList.remove('hidden');
        });
        
        document.getElementById('close-modal').addEventListener('click', function() {
            document.getElementById('forgot-password-modal').classList.add('hidden');
        });
        
        // document.getElementById('send-reset-link').addEventListener('click', function() {
        //     const email = document.getElementById('email');
            
        //     if (!email.value.trim() || !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email.value)) {
        //         alert('Please enter a valid email address');
        //         return;
        //     }
            
        //     // Here you would typically submit the form to your Laravel backend
        //     // For demo purposes, we'll just show the success message
        //     document.getElementById('forgot-password-modal').classList.add('hidden');
            
        //     // Show success message (you would replace this with actual form submission)
        //     alert('Password reset link sent! Please check your email.');
        // });
    </script>
</body>
</html>