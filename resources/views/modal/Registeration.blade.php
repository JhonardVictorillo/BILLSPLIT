<!-- Register Modal -->
<div id="registerModal" class="hidden fixed inset-0 bg-gray-900 bg-opacity-50 flex justify-center items-center">
    <div class="bg-white p-6 rounded-lg w-1/2 flex relative shadow-lg">
        <!-- Close Button -->
        <button onclick="closeModal('registerModal')" class="absolute top-4 right-4 text-gray-600 hover:text-gray-900 text-2xl">
            &times;
        </button>

        <!-- Left Side (Text & Design) -->
        <div class="w-1/2 p-8 flex flex-col justify-center items-center bg-gradient-to-r from-blue-500 to-blue-700 text-white rounded-l-lg shadow-md">
            <h2 class="text-3xl font-bold text-center">Join Us Today!</h2>
            <p class="mt-3 text-center text-lg">
                Start splitting bills with ease. Track payments, manage expenses, and enjoy a stress-free life.
            </p>
            <p class="mt-6 text-center">
                Already a member?  
                <button onclick="toggleModal('loginModal')" class="text-yellow-300 font-semibold hover:underline">Sign in</button>
            </p>
        </div>

        <!-- Right Side (Register Form) -->
        <div class="w-1/2 p-8 flex flex-col justify-center">
            <h2 class="text-3xl font-bold text-center mb-6 text-gray-800">Sign Up</h2>

            <form id="registerForm">
                <input type="text" name="firstname" placeholder="Firstname" class="input-field">
                <p class="error-message" id="firstnameError"></p>

                <input type="text" name="lastname" placeholder="Lastname" class="input-field">
                <p class="error-message" id="lastnameError"></p>

                <input type="text" name="nickname" placeholder="Nickname" class="input-field">
                <p class="error-message" id="nicknameError"></p>

                <input type="email" name="email" placeholder="Email" class="input-field">
                <p class="error-message" id="emailError"></p>

                <input type="text" name="username" placeholder="Username" class="input-field">
                <p class="error-message" id="usernameError"></p>

                <input type="password" name="password" placeholder="Password" class="input-field">
                <p class="error-message" id="passwordError"></p>

                <input type="password" name="password_confirmation" placeholder="Confirm Password" class="input-field">
                <p class="error-message" id="confirmPasswordError"></p>

                <label class="flex items-center mb-4 text-sm text-gray-600">
                    <input type="checkbox" name="terms" class="mr-2"> I agree to the 
                    <a href="#" class="text-green-600 hover:underline ml-1">terms of service</a>
                </label>

                <button type="submit" class="w-full bg-blue-600 text-white py-3 rounded-lg font-semibold hover:bg-blue-700 transition">
                    Register
                </button>
            </form>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const registerForm = document.getElementById('registerForm');
    if (!registerForm) return;

    registerForm.addEventListener('submit', async function (event) {
        event.preventDefault();

        let errors = {};
        let formElements = registerForm.elements;

        // Clear all previous error messages
        document.querySelectorAll(".error-message").forEach(error => error.innerText = "");

        let firstname = formElements['firstname'].value;
        let lastname = formElements['lastname'].value;
        let nickname = formElements['nickname'].value;
        let email = formElements['email'].value;
        let username = formElements['username'].value;
        let password = formElements['password'].value;
        let confirmPassword = formElements['password_confirmation'].value;
        let termsChecked = formElements['terms'].checked;

        // Helper function to show errors
        function showError(field, message) {
            let errorField = document.getElementById(`${field}Error`);
            if (errorField) {
                errorField.innerText = message;
                errorField.classList.add("text-red-500", "text-sm", "mt-1");
            }
        }

        // Validation rules
        let noSpaceRegex = /^[^\s]+$/; // No spaces allowed
        let passwordRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,16}$/;

        if (!noSpaceRegex.test(firstname)) errors.firstname = "No spaces allowed in First Name.";
        if (!noSpaceRegex.test(lastname)) errors.lastname = "No spaces allowed in Last Name.";
        if (!noSpaceRegex.test(nickname)) errors.nickname = "No spaces allowed in Nickname.";
        if (!noSpaceRegex.test(username)) errors.username = "No spaces allowed in Username.";

        if (!passwordRegex.test(password)) {
            errors.password = "Password must be 8-16 characters and include uppercase, lowercase, a number, and a special character.";
        }
        if (password !== confirmPassword) {
            errors.password_confirmation = "Passwords do not match.";
        }

        if (!termsChecked) {
            errors.terms = "You must agree to the terms of service.";
        }

        // Display errors if any
        if (Object.keys(errors).length > 0) {
            for (let key in errors) {
                showError(key, errors[key]);
            }
            return;
        }

        // Proceed with AJAX request
        let formData = new FormData(registerForm);
        
        try {
            let response = await fetch("{{ route('register') }}", {
                method: "POST",
                body: formData,
                headers: {
                    "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content,
                }
            });

            if (!response.ok) throw new Error("Server error. Please try again.");

            let data = await response.json();

            if (data.success) {
                alert(data.message);
                location.reload();
            } else {
                for (let key in data.errors) {
                    showError(key, data.errors[key][0]);
                }
            }
        } catch (error) {
            console.error('Error:', error);
            let errorContainer = document.getElementById("registerErrors");
            if (errorContainer) {
                errorContainer.innerHTML = `<p class="text-red-500 text-sm mt-1">An error occurred. Please try again.</p>`;
            }
        }
    });
});

</script>
