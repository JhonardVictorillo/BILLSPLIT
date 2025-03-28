<!-- Login Modal -->
<div id="loginModal" class="hidden fixed inset-0 bg-gray-900 bg-opacity-50 flex justify-center items-center">
    <div class="bg-white p-6 rounded-lg w-1/2 flex relative shadow-lg">
        <!-- Close Button -->
        <button onclick="closeModal('loginModal')" class="absolute top-4 right-4 text-gray-600 hover:text-gray-900 text-2xl">
            &times;
        </button>

        <!-- Left Side (Text & Design) -->
        <div class="w-1/2 p-8 flex flex-col justify-center items-center bg-gradient-to-r from-blue-500 to-blue-700 text-white rounded-l-lg shadow-md">
            <h2 class="text-3xl font-bold text-center">Welcome Back!</h2>
            <p class="mt-3 text-center text-lg">
                Join a community that simplifies your bill payments and manages expenses effortlessly.
            </p>
            <p class="mt-6 text-center">
                New here?  
                <button onclick="toggleModal('registerModal')" class="text-yellow-300 font-semibold hover:underline">Create an account</button>
            </p>
        </div>

        <!-- Right Side (Login Form) -->
        <div class="w-1/2 p-8 flex flex-col justify-center">
            <h2 class="text-3xl font-bold text-center mb-6 text-gray-800">Sign In</h2>
            
            <input type="text" placeholder="Email" class="w-full px-4 py-3 border border-gray-300 rounded mb-4 focus:outline-none focus:ring-2 focus:ring-blue-500">
            
            <input type="password" placeholder="Password" class="w-full px-4 py-3 border border-gray-300 rounded mb-4 focus:outline-none focus:ring-2 focus:ring-blue-500">
            
            <div class="flex justify-between items-center mb-4 text-sm">
                <label class="text-gray-600">
                    <input type="checkbox" class="mr-1"> Remember me
                </label>
                <a href="#" class="text-blue-600 hover:underline">Forgot password?</a>
            </div>

            <div id="loginErrors"></div>

            <button type ="submit"class="w-full bg-blue-600 text-white py-3 rounded-lg font-semibold hover:bg-blue-700 transition">
                Login
            </button>
        </div>
    </div>
</div>

<script>
document.getElementById('loginForm').addEventListener('submit', function(event) {
    event.preventDefault();
    
    let formData = new FormData(this);
    let errorContainer = document.getElementById("loginErrors");
    errorContainer.innerHTML = ""; // Clear previous errors

    fetch("{{ route('login') }}", {
        method: "POST",
        body: formData,
        headers: {
            "X-CSRF-TOKEN": "{{ csrf_token() }}"
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert(data.message);
            location.reload();
        } else {
            showErrors(errorContainer, data.errors || { message: data.message });
        }
    })
    .catch(error => console.error('Error:', error));
});

// Function to display validation errors
function showErrors(container, errors) {
    for (let key in errors) {
        let errorMessage = document.createElement("p");
        errorMessage.className = "text-red-500 text-sm mt-1";
        errorMessage.innerText = errors[key];
        container.appendChild(errorMessage);
    }
}
</script>