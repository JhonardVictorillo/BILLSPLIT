<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register | BillSplit Pro</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
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
                    <a href="{{route('landingpage')}}" class="text-gray-500 hover:text-gray-900 text-sm font-medium">Home</a>
                    <a href="{{route('login.form')}}" class="text-gray-500 hover:text-gray-900 text-sm font-medium">Login</a>
                </div>
            </div>
        </div>
    </header>
    <!-- Main Content -->
    <main class="flex-grow">
        <div class="max-w-xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="bg-white p-8 rounded-lg shadow-sm border border-gray-200">
                <div class="text-center mb-8">
                    <h2 class="text-2xl font-bold text-gray-900">Create your account</h2>
                    <p class="mt-2 text-md text-gray-600">
                        Join BillSplit Pro to easily manage shared expenses with friends and family.
                    </p>
                </div>

                <!-- Form Success Message -->
                @if(session('success'))
                <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded">
                    {{ session('success') }}
                </div>
                @endif

                <!-- Form Error Message -->
                <div id="form-errors" class="hidden mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded">
                    <ul id="error-list"></ul>
                </div>

                <form class="space-y-4" id="registrationForm" method="POST" action="{{ route('register') }}">
                    @csrf
                    
                    <!-- Name Fields -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label for="first_name" class="block text-sm font-medium text-gray-700">
                                First Name <span class="text-danger">*</span>
                            </label>
                            <div class="mt-1 relative">
                                <input id="first_name" name="first_name" type="text" required 
                                    class="py-2 px-3 block w-full border border-gray-300 rounded-md focus:ring-primary focus:border-primary"
                                    value="{{ old('first_name') }}"
                                    onblur="validateField('first_name')">
                                <div class="mt-1 text-xs text-danger hidden" id="first_name-error"></div>
                            </div>
                        </div>
                        <div>
                            <label for="last_name" class="block text-sm font-medium text-gray-700">
                                Last Name <span class="text-danger">*</span>
                            </label>
                            <div class="mt-1 relative">
                                <input id="last_name" name="last_name" type="text" required 
                                    class="py-2 px-3 block w-full border border-gray-300 rounded-md focus:ring-primary focus:border-primary"
                                    value="{{ old('last_name') }}"
                                    onblur="validateField('last_name')">
                                <div class="mt-1 text-xs text-danger hidden" id="last_name-error"></div>
                            </div>
                        </div>
                    </div>

                    <!-- Nickname -->
                    <div>
                        <label for="nickname" class="block text-sm font-medium text-gray-700">
                            Nickname <span class="text-danger">*</span>
                        </label>
                        <div class="mt-1 relative">
                            <input id="nickname" name="nickname" type="text" required 
                                class="py-2 px-3 block w-full border border-gray-300 rounded-md focus:ring-primary focus:border-primary"
                                value="{{ old('nickname') }}"
                                onblur="validateField('nickname')"
                                oninput="checkFieldAvailability('nickname')">
                            <div class="mt-1 text-xs text-danger hidden" id="nickname-error"></div>
                            <div class="hidden mt-1 text-xs text-green-600" id="nickname-available">
                                Nickname is available!
                            </div>
                        </div>
                    </div>

                    <!-- Email -->
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700">
                            Email <span class="text-danger">*</span>
                        </label>
                        <div class="mt-1 relative">
                            <input id="email" name="email" type="email" required 
                                class="py-2 px-3 block w-full border border-gray-300 rounded-md focus:ring-primary focus:border-primary"
                                value="{{ old('email') }}"
                                onblur="validateField('email')"
                                oninput="checkFieldAvailability('email')">
                            <div class="mt-1 text-xs text-danger hidden" id="email-error"></div>
                            <div class="hidden mt-1 text-xs text-green-600" id="email-available">
                                Email is available!
                            </div>
                        </div>
                    </div>

                    <!-- Username -->
                    <div>
                        <label for="username" class="block text-sm font-medium text-gray-700">
                            Username <span class="text-danger">*</span>
                        </label>
                        <div class="mt-1 relative">
                            <input id="username" name="username" type="text" required 
                                class="py-2 px-3 block w-full border border-gray-300 rounded-md focus:ring-primary focus:border-primary"
                                value="{{ old('username') }}"
                                onblur="validateField('username')"
                                oninput="checkFieldAvailability('username')">
                            <div class="mt-1 text-xs text-danger hidden" id="username-error"></div>
                            <div class="hidden mt-1 text-xs text-green-600" id="username-available">
                                Username is available!
                            </div>
                        </div>
                    </div>

                    <!-- Password -->
                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700">
                            Password <span class="text-danger">*</span>
                        </label>
                        <div class="mt-1 relative">
                            <input id="password" name="password" type="password" required 
                                class="py-2 px-3 block w-full border border-gray-300 rounded-md focus:ring-primary focus:border-primary"
                                onblur="validateField('password')"
                                oninput="validatePassword()">
                                <button type="button" onclick="togglePassword('password')" class="absolute inset-y-0 right-2 flex items-center">
                                        👁️
                                    </button>
                               
                            <div class="mt-1 text-xs text-danger hidden" id="password-error"></div>

                            <div class="mt-2">
                                <div class="flex items-center mb-1">
                                    <div id="length-check" class="w-4 h-4 mr-2 rounded-full border border-gray-300"></div>
                                    <span class="text-xs text-gray-600">8-16 characters</span>
                                </div>
                                <div class="flex items-center mb-1">
                                    <div id="uppercase-check" class="w-4 h-4 mr-2 rounded-full border border-gray-300"></div>
                                    <span class="text-xs text-gray-600">1 uppercase letter</span>
                                </div>
                                <div class="flex items-center mb-1">
                                    <div id="lowercase-check" class="w-4 h-4 mr-2 rounded-full border border-gray-300"></div>
                                    <span class="text-xs text-gray-600">1 lowercase letter</span>
                                </div>
                                <div class="flex items-center mb-1">
                                    <div id="number-check" class="w-4 h-4 mr-2 rounded-full border border-gray-300"></div>
                                    <span class="text-xs text-gray-600">1 Number</span>
                                </div>
                                <div class="flex items-center">
                                    <div id="special-check" class="w-4 h-4 mr-2 rounded-full border border-gray-300"></div>
                                    <span class="text-xs text-gray-600">1 special character</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Confirm Password -->
                    <div>
                        <label for="password_confirmation" class="block text-sm font-medium text-gray-700">
                            Confirm Password <span class="text-danger">*</span>
                        </label>
                        <div class="mt-1 relative">
                            <input id="password_confirmation" name="password_confirmation" type="password" required 
                                class="py-2 px-3 block w-full border border-gray-300 rounded-md focus:ring-primary focus:border-primary"
                                onblur="validatePasswordConfirmation()">
                                <button type="button" onclick="togglePassword('password_confirmation')" class="absolute inset-y-0 right-2 flex items-center">
                                        👁️
                                    </button>
                            <div class="mt-1 text-xs text-danger hidden" id="password_confirmation-error"></div>
                        </div>
                    </div>

                    

                    <!-- Submit Button -->
                    <div>
                        <button type="submit" id="submit-button"
                            class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-primary hover:bg-primary-dark focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary">
                            Create Account
                        </button>
                    </div>
                </form>

                <div class="mt-6 text-center">
                    <p class="text-sm text-gray-600">
                        Already have an account? <a href="{{ route('login.form') }}" class="font-medium text-primary hover:text-primary-dark">Log in</a>
                    </p>
                </div>
            </div>
        </div>
    </main>

    <!-- Footer (unchanged) -->
    <!-- ... keep your existing footer code ... -->

    <script>
        // Field validation function
        function validateField(fieldName) {
            const field = document.getElementById(fieldName);
            const errorElement = document.getElementById(`${fieldName}-error`);
            
            // Reset error state
            errorElement.classList.add('hidden');
            field.classList.remove('border-danger');
            
            if (!field.value.trim()) {
                showError(fieldName, 'This field is required');
                return false;
            }
            
            // Field-specific validation
            switch(fieldName) {
                case 'first_name':
                case 'last_name':
                case 'nickname':
                case 'username':
                    if (/\s/.test(field.value)) {
                        showError(fieldName, 'Spaces are not allowed');
                        return false;
                    }
                    break;
                case 'email':
                    if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(field.value)) {
                        showError(fieldName, 'Please enter a valid email address');
                        return false;
                    }
                    break;
            }
            
            return true;
        }

        // Password validation
        function validatePassword() {
    const password = document.getElementById('password');
    const errorElement = document.getElementById('password-error');

    errorElement.classList.add('hidden');
    password.classList.remove('border-danger');

    const hasLength = password.value.length >= 8 && password.value.length <= 16;
    const hasUpper = /[A-Z]/.test(password.value);
    const hasLower = /[a-z]/.test(password.value);
    const hasNumber = /\d/.test(password.value); // Check for number
    const hasSpecial = /[!@#$%^&*(),.?":{}|<>]/.test(password.value);

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
                if (element) { // Ensure the element exists
                    if (isValid) {
                        element.classList.add('bg-green-500', 'border-green-500');
                        element.classList.remove('border-gray-300');
                    } else {
                        element.classList.remove('bg-green-500', 'border-green-500');
                        element.classList.add('border-gray-300');
                    }
                } else {
                    console.error(`Element with id ${elementId} not found.`);
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

         // Check availability for a field (nickname, email, or username)
    function checkFieldAvailability(field) {
        const fieldElement = document.getElementById(field);
        const errorElement = document.getElementById(`${field}-error`);
        const availableElement = document.getElementById(`${field}-available`);

        if (!fieldElement.value.trim()) return;

        axios.get(`/check/${field}?${field}=${fieldElement.value}`)
            .then(response => {
                if (response.data.available) {
                    availableElement.classList.remove('hidden');
                    errorElement.classList.add('hidden');
                    fieldElement.classList.remove('border-danger');
                } else {
                    availableElement.classList.add('hidden');
                    showError(field, `This ${field} is already taken`);
                }
            })
            .catch(error => {
                console.error(`Error checking ${field}:`, error);
            });
    }

        // Show error message
        function showError(fieldName, message) {
            const field = document.getElementById(fieldName);
            const errorElement = document.getElementById(`${fieldName}-error`);
            
            errorElement.textContent = message;
            errorElement.classList.remove('hidden');
            field.classList.add('border-danger');
        }

        // Form submission
        document.getElementById('registrationForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            // Validate all fields
            const isValidFirstName = validateField('first_name');
            const isValidLastName = validateField('last_name');
            const isValidNickname = validateField('nickname');
            const isValidEmail = validateField('email');
            const isValidUsername = validateField('username');
            const isValidPassword = validatePassword();
            const isValidConfirmPassword = validatePasswordConfirmation();
            
           
            
            if (isValidFirstName && isValidLastName && isValidNickname && isValidEmail && 
                isValidUsername && isValidPassword && isValidConfirmPassword) {
                
                // Disable submit button to prevent multiple submissions
                document.getElementById('submit-button').disabled = true;   
                
                // Submit the form
                this.submit();
            } else {
                // Scroll to first error
                const firstError = document.querySelector('.border-danger');
                if (firstError) {
                    firstError.scrollIntoView({ behavior: 'smooth', block: 'center' });
                }
            }
        });

         // Event listeners to check availability when fields lose focus
    document.getElementById('nickname').addEventListener('blur', function() {
        checkFieldAvailability('nickname');
    });
    document.getElementById('email').addEventListener('blur', function() {
        checkFieldAvailability('email');
    });
    document.getElementById('username').addEventListener('blur', function() {
        checkFieldAvailability('username');
    });
    </script>
</body>
</html>