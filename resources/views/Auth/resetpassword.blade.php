<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password | BillSplit Pro</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="{{ asset('css/All.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
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
                    <a href="{{route('login.form')}}" class="text-gray-500 hover:text-gray-900 text-base font-medium">Login</a>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="flex-grow flex items-center justify-center p-6">
        <div class="max-w-md w-full mx-auto px-4 sm:px-8 py-12">
            <div class="bg-white p-10 rounded-lg shadow-sm border border-gray-200">
                <div class="text-center mb-10">
                    <h2 class="text-3xl font-bold text-gray-900">Reset Your Password</h2>
                    <p class="mt-4 text-base text-gray-600">
                        Enter your new password below.
                    </p>
                </div>

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

                @if (session('status'))
                    <div class="mb-6 p-4 bg-green-100 border border-green-400 text-green-700 rounded text-base">
                        {{ session('status') }}
                    </div>
                @endif

                <form class="space-y-6" method="POST" action="{{ route('password.update') }}">
                    @csrf
                    <input type="hidden" name="token" value="{{ $token }}">

                    <!-- Email (hidden if you want to get it from token) -->
                    <input type="hidden" name="email" value="{{ $email ?? old('email') }}">

                    <!-- New Password -->
                    <div>
                        <label for="password" class="block text-base font-medium text-gray-700">
                            New Password <span class="text-danger">*</span>
                        </label>
                        <div class="mt-2 relative">
                            <input id="password" name="password" type="password" required 
                                class="input-field block w-full border border-gray-300 rounded-md focus:ring-primary focus:border-primary"
                                oninput="validatePassword()">
                                <button type="button" onclick="togglePassword('password')" class="absolute inset-y-0 right-2 flex items-center">
                                        👁️
                                    </button>
                            <div class="error-message text-danger hidden" id="password-error"></div>
                            <div class="mt-4 space-y-2">
                                <div class="flex items-center">
                                    <div id="length-check" class="w-5 h-5 mr-3 rounded-full border border-gray-300"></div>
                                    <span class="text-sm text-gray-600">8-16 characters</span>
                                </div>
                                <div class="flex items-center">
                                    <div id="uppercase-check" class="w-5 h-5 mr-3 rounded-full border border-gray-300"></div>
                                    <span class="text-sm text-gray-600">1 uppercase letter</span>
                                </div>
                                <div class="flex items-center">
                                    <div id="lowercase-check" class="w-5 h-5 mr-3 rounded-full border border-gray-300"></div>
                                    <span class="text-sm text-gray-600">1 lowercase letter</span>
                                </div>
                                <div class="flex items-center">
                                    <div id="lowercase-check" class="w-5 h-5 mr-3 rounded-full border border-gray-300"></div>
                                    <span class="text-sm text-gray-600">1 Number</span>
                                </div>
                                <div class="flex items-center">
                                    <div id="special-check" class="w-5 h-5 mr-3 rounded-full border border-gray-300"></div>
                                    <span class="text-sm text-gray-600">1 special character</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Confirm Password -->
                    <div>
                        <label for="password_confirmation" class="block text-base font-medium text-gray-700">
                            Confirm New Password <span class="text-danger">*</span>
                        </label>
                        <div class="mt-2 relative">
                            <input id="password_confirmation" name="password_confirmation" type="password" required 
                                class="input-field block w-full border border-gray-300 rounded-md focus:ring-primary focus:border-primary"
                                onblur="validatePasswordConfirmation()">
                                <button type="button" onclick="togglePassword('password_confirmation')" class="absolute inset-y-0 right-2 flex items-center">
                                        👁️
                                    </button>
                            <div class="error-message text-danger hidden" id="password_confirmation-error"></div>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="pt-4">
                        <button type="submit" id="submit-button"
                            class="w-full flex justify-center py-3 px-6 border border-transparent rounded-md shadow-sm text-base font-medium text-white bg-primary hover:bg-primary-dark focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary">
                            Reset Password
                        </button>
                    </div>
                </form>

                <div class="mt-8 text-center">
                    <p class="text-base text-gray-600">
                        Remember your password? <a href="{{ route('login.form') }}" class="font-medium text-primary hover:text-primary-dark">Log in</a>
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
        // Password validation
        function validatePassword() {
            const password = document.getElementById('password');
            const errorElement = document.getElementById('password-error');
            
            // Reset states
            errorElement.classList.add('hidden');
            password.classList.remove('border-danger');
            
            // Check password requirements
            const hasLength = password.value.length >= 8 && password.value.length <= 16;
            const hasUpper = /[A-Z]/.test(password.value);
            const hasLower = /[a-z]/.test(password.value);
            const hasNumber = /\d/.test(password.value);
            const hasSpecial = /[!@#$%^&*(),.?":{}|<>]/.test(password.value);
            
            // Update visual indicators
            updateCheckIndicator('length-check', hasLength);
            updateCheckIndicator('uppercase-check', hasUpper);
            updateCheckIndicator('lowercase-check', hasLower);
            updateCheckIndicator('special-check', hasSpecial);
            updateCheckIndicator('number-check', hasNumber);
            
            if (!hasLength || !hasUpper || !hasLower || !hasNumber || !hasSpecial) {
                return false;
            }
            
            return true;
        }
        function togglePassword(fieldId) {
            const passwordField = document.getElementById(fieldId);
            passwordField.type = passwordField.type === 'password' ? 'text' : 'password';
        }

        function updateCheckIndicator(elementId, isValid) {
            const element = document.getElementById(elementId);
            if (isValid) {
                element.classList.add('bg-green-500', 'border-green-500');
                element.classList.remove('border-gray-300');
            } else {
                element.classList.remove('bg-green-500', 'border-green-500');
                element.classList.add('border-gray-300');
            }
        }

        // Password confirmation validation
        function validatePasswordConfirmation() {
            const password = document.getElementById('password');
            const confirmPassword = document.getElementById('password_confirmation');
            const errorElement = document.getElementById('password_confirmation-error');
            
            // Reset states
            errorElement.classList.add('hidden');
            confirmPassword.classList.remove('border-danger');
            
            if (confirmPassword.value !== password.value) {
                showError('password_confirmation', 'Passwords do not match');
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
            const isValidPassword = validatePassword();
            const isValidConfirmPassword = validatePasswordConfirmation();
            
            if (!isValidPassword || !isValidConfirmPassword) {
                e.preventDefault();
                // Scroll to first error
                const firstError = document.querySelector('.border-danger');
                if (firstError) {
                    firstError.scrollIntoView({ behavior: 'smooth', block: 'center' });
                }
            }
        });
    </script>
</body>
</html>