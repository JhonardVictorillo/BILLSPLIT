<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | BillSplit Pro</title>
    <link rel="stylesheet" href="{{ asset('css/All.css') }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
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
<body class="font-sans bg-gray-50">
    <div class="flex h-screen">
         <!-- Sidebar Navigation -->
        <div class="hidden md:flex md:flex-shrink-0">
            <div class="flex flex-col w-64 border-r border-gray-200 bg-white">
                <div class="flex items-center h-16 px-4 border-b border-gray-200">
                    <div class="flex items-center">
                        <svg class="h-8 w-8 text-primary" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span class="ml-2 text-xl font-bold text-gray-900">BillSplit Pro</span>
                    </div>
                </div>
                <div class="flex flex-col flex-grow overflow-y-auto">
                    <nav class="flex-1 px-2 py-4 space-y-1">
                        <a href="#" onclick="showSection('bills')" id="bills-menu" class="sidebar-item active flex items-center px-4 py-2 text-sm font-medium rounded-md group">
                            <i class="fas fa-receipt mr-3 text-primary"></i>
                            Bills
                        </a>
                        <a href="#" onclick="showSection('archive')" id="archive-menu" class="sidebar-item flex items-center px-4 py-2 text-sm font-medium text-gray-600 rounded-md group">
                            <i class="fas fa-archive mr-3 text-gray-400"></i>
                            Archive
                        </a>
                        <a href="#" onclick="showSection('profile')" id="profile-menu" class="sidebar-item flex items-center px-4 py-2 text-sm font-medium text-gray-600 rounded-md group">
                            <i class="fas fa-user-circle mr-3 text-gray-400"></i>
                            Profile
                        </a>
                    </nav>
                </div>
                <div class="p-4 border-t border-gray-200">
                    <div class="flex items-center">
                        <img class="h-10 w-10 rounded-full" src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=128&h=128&q=80" alt="User profile">
                        <div class="ml-3">
                            <p class="text-sm font-medium text-gray-700">John Doe</p>
                            <a href="#" onclick="showSection('profile')" class="text-xs font-medium text-primary hover:text-primary-dark">View profile</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <!-- Main Content -->
        <div class="flex flex-col flex-1 overflow-hidden">
            <!-- Mobile Top Navigation -->
            <div class="md:hidden flex items-center justify-between px-4 py-3 bg-white border-b border-gray-200">
                <div class="flex items-center">
                    <button class="text-gray-500 focus:outline-none">
                        <i class="fas fa-bars"></i>
                    </button>
                    <span id="mobile-header" class="ml-2 text-lg font-bold text-gray-900">Bills</span>
                </div>
                <div class="flex items-center">
                    <button class="p-1 text-gray-400 hover:text-gray-500 focus:outline-none">
                        <i class="fas fa-bell"></i>
                    </button>
                </div>
            </div>

            <!-- Main Content Area -->
            <div class="flex-1 overflow-auto p-4 md:p-6">
                <!-- Bills Section (Default Active) -->
                <div id="bills-section" class="active-section">
                    <div class="flex justify-between items-center mb-6">
                        <h1 class="text-2xl font-bold text-gray-900">Your Bills</h1>
                        <button onclick="showAddBillModal()" class="px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-primary hover:bg-primary-dark focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary">
                            <i class="fas fa-plus mr-2"></i> Add Bill
                        </button>
                    </div>

                    <!-- Bills List -->
                    <div class="bg-white rounded-lg shadow border border-gray-200">
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Bill Name</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total Amount</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    <!-- Sample Bill Row -->
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div class="flex-shrink-0 h-10 w-10 bg-blue-100 rounded-full flex items-center justify-center text-blue-600">
                                                    <i class="fas fa-receipt"></i>
                                                </div>
                                                <div class="ml-4">
                                                    <div class="text-sm font-medium text-gray-900">Weekend Trip</div>
                                                    <div class="text-sm text-gray-500">3 people</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-900">$450.00</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Active</span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            <button onclick="showViewBillModal()" class="text-primary hover:text-primary-dark mr-3">
                                                <i class="fas fa-eye"></i> View
                                            </button>
                                            <button onclick="showEditBillModal()" class="text-yellow-600 hover:text-yellow-900 mr-3">
                                                <i class="fas fa-edit"></i> Edit
                                            </button>
                                            <button onclick="confirmArchiveBill()" class="text-purple-600 hover:text-purple-900 mr-3">
                                                <i class="fas fa-archive"></i> Archive
                                            </button>
                                            <button onclick="confirmDeleteBill()" class="text-danger hover:text-danger-dark">
                                                <i class="fas fa-trash"></i> Delete
                                            </button>
                                        </td>
                                    </tr>
                                    <!-- More bills... -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Archive Section -->
                <div id="archive-section" class="hidden">
                    <div class="flex justify-between items-center mb-6">
                        <h1 class="text-2xl font-bold text-gray-900">Archived Bills</h1>
                        <div class="relative">
                            <select class="appearance-none bg-white border border-gray-300 rounded-md pl-3 pr-8 py-2 text-sm focus:outline-none focus:ring-primary focus:border-primary">
                                <option>All</option>
                                <option>Last 30 days</option>
                                <option>Last 6 months</option>
                                <option>Last year</option>
                            </select>
                            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                                <i class="fas fa-chevron-down"></i>
                            </div>
                        </div>
                    </div>

                    <!-- Archived Bills List -->
                    <div class="bg-white rounded-lg shadow border border-gray-200">
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Bill Name</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total Amount</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date Archived</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    <!-- Sample Archived Bill -->
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div class="flex-shrink-0 h-10 w-10 bg-gray-100 rounded-full flex items-center justify-center text-gray-600">
                                                    <i class="fas fa-receipt"></i>
                                                </div>
                                                <div class="ml-4">
                                                    <div class="text-sm font-medium text-gray-900">Birthday Party</div>
                                                    <div class="text-sm text-gray-500">5 people</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-900">$320.00</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-900">May 15, 2023</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            <button onclick="showViewBillModal()" class="text-primary hover:text-primary-dark mr-3">
                                                <i class="fas fa-eye"></i> View
                                            </button>
                                            <button onclick="restoreBill()" class="text-green-600 hover:text-green-900">
                                                <i class="fas fa-undo"></i> Restore
                                            </button>
                                        </td>
                                    </tr>
                                    <!-- More archived bills... -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Profile Section -->
                <div id="profile-section" class="hidden">
                    <div class="flex justify-between items-center mb-6">
                        <h1 class="text-2xl font-bold text-gray-900">Your Profile</h1>
                        <button onclick="showEditProfileModal()" class="px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary">
                            <i class="fas fa-edit mr-2"></i> Edit Profile
                        </button>
                    </div>

                    <div class="bg-white rounded-lg shadow border border-gray-200 p-6">
                        <div class="flex items-center mb-6">
                            <div class="flex-shrink-0 h-16 w-16 rounded-full bg-purple-100 text-purple-600 flex items-center justify-center text-2xl">
                                <i class="fas fa-user"></i>
                            </div>
                            <div class="ml-4">
                                <h2 class="text-xl font-bold text-gray-900">John Doe</h2>
                                <p class="text-sm text-gray-500">Member since June 2022</p>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <h3 class="text-lg font-medium text-gray-900 mb-4">Account Information</h3>
                                <div class="space-y-4">
                                    <div>
                                        <p class="text-sm font-medium text-gray-500">Username</p>
                                        <p class="text-sm text-gray-900">johndoe</p>
                                    </div>
                                    <div>
                                        <p class="text-sm font-medium text-gray-500">Email</p>
                                        <p class="text-sm text-gray-900">john.doe@example.com</p>
                                    </div>
                                    <div>
                                        <p class="text-sm font-medium text-gray-500">Account Type</p>
                                        <p class="text-sm text-gray-900">Premium Member</p>
                                    </div>
                                </div>
                            </div>

                            <div>
                                <h3 class="text-lg font-medium text-gray-900 mb-4">Personal Information</h3>
                                <div class="space-y-4">
                                    <div>
                                        <p class="text-sm font-medium text-gray-500">First Name</p>
                                        <p class="text-sm text-gray-900">John</p>
                                    </div>
                                    <div>
                                        <p class="text-sm font-medium text-gray-500">Last Name</p>
                                        <p class="text-sm text-gray-900">Doe</p>
                                    </div>
                                    <div>
                                        <p class="text-sm font-medium text-gray-500">Nickname</p>
                                        <p class="text-sm text-gray-900">Johnny</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="mt-8 pt-6 border-t border-gray-200">
                            <button onclick="confirmLogout()" class="px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-danger hover:bg-danger-dark focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-danger">
                                <i class="fas fa-sign-out-alt mr-2"></i> Logout
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Bill Modal -->
    <div id="add-bill-modal" class="hidden fixed inset-0 bg-gray-500 bg-opacity-75 flex items-center justify-center z-50">
        <div class="bg-white rounded-lg shadow-xl max-w-2xl w-full p-6">
            <div class="flex justify-between items-start">
                <h3 class="text-lg font-medium text-gray-900">Create New Bill</h3>
                <button onclick="hideAddBillModal()" class="text-gray-400 hover:text-gray-500">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div class="mt-4">
                <div class="grid grid-cols-1 gap-6">
                    <div>
                        <label for="bill-name" class="block text-sm font-medium text-gray-700">Bill Name</label>
                        <input type="text" id="bill-name" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-primary focus:border-primary">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Invitation Code</label>
                        <div class="mt-1 flex rounded-md shadow-sm">
                            <input type="text" id="invitation-code" readonly class="flex-1 min-w-0 block w-full rounded-none rounded-l-md border-gray-300 focus:ring-primary focus:border-primary py-2 px-3" value="BILL-XY7P9Q">
                            <button onclick="regenerateCode()" class="inline-flex items-center px-3 rounded-r-md border border-l-0 border-gray-300 bg-gray-50 text-gray-500 hover:bg-gray-100 focus:outline-none focus:ring-1 focus:ring-primary focus:border-primary">
                                <i class="fas fa-sync-alt mr-1"></i> Regenerate
                            </button>
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Involved Persons</label>
                        <div class="mt-1 flex">
                            <select class="flex-1 rounded-l-md border-gray-300 focus:ring-primary focus:border-primary py-2 px-3">
                                <option>Select user...</option>
                                <option>Jane Smith (Registered)</option>
                                <option>Mike Johnson (Registered)</option>
                                <option>Add Guest User...</option>
                            </select>
                            <button onclick="addUser()" class="inline-flex items-center px-3 rounded-r-md border border-l-0 border-gray-300 bg-gray-50 text-gray-500 hover:bg-gray-100 focus:outline-none focus:ring-1 focus:ring-primary focus:border-primary">
                                <i class="fas fa-plus"></i> Add
                            </button>
                        </div>
                    </div>

                    <div class="bg-gray-50 p-4 rounded-md">
                        <h4 class="text-sm font-medium text-gray-700 mb-2">Current Participants</h4>
                        <div class="space-y-2">
                            <div class="flex items-center justify-between bg-white p-2 rounded border border-gray-200">
                                <span>You (Host)</span>
                                <button class="text-danger hover:text-danger-dark">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                            <!-- More participants... -->
                        </div>
                    </div>
                </div>
            </div>
            <div class="mt-5 sm:mt-6 grid grid-cols-2 gap-3">
                <button onclick="hideAddBillModal()" type="button" class="w-full flex justify-center py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary">
                    Cancel
                </button>
                <button type="button" onclick="createBill()" class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-primary hover:bg-primary-dark focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary">
                    Create Bill
                </button>
            </div>
        </div>
    </div>

    <!-- View Bill Modal -->
    <div id="view-bill-modal" class="hidden fixed inset-0 bg-gray-500 bg-opacity-75 flex items-center justify-center z-50">
        <div class="bg-white rounded-lg shadow-xl max-w-4xl w-full p-6">
            <div class="flex justify-between items-start">
                <h3 class="text-lg font-medium text-gray-900">Bill: Weekend Trip</h3>
                <button onclick="hideViewBillModal()" class="text-gray-400 hover:text-gray-500">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div class="mt-4">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="md:col-span-2">
                        <div class="bg-white rounded-lg shadow border border-gray-200">
                            <div class="px-4 py-3 border-b border-gray-200 bg-gray-50">
                                <h4 class="text-sm font-medium text-gray-700">Expenses</h4>
                            </div>
                            <div class="divide-y divide-gray-200">
                                <div class="p-4 hover:bg-gray-50">
                                    <div class="flex justify-between">
                                        <div>
                                            <p class="text-sm font-medium text-gray-900">Hotel Accommodation</p>
                                            <p class="text-xs text-gray-500">Paid by John Doe</p>
                                        </div>
                                        <div class="text-right">
                                            <p class="text-sm font-medium text-gray-900">$300.00</p>
                                            <p class="text-xs text-gray-500">3 people</p>
                                        </div>
                                    </div>
                                </div>
                                <!-- More expenses... -->
                            </div>
                            <div class="px-4 py-3 border-t border-gray-200 bg-gray-50 text-right">
                                <button onclick="showAddExpenseModal()" class="text-sm font-medium text-primary hover:text-primary-dark">
                                    <i class="fas fa-plus mr-1"></i> Add Expense
                                </button>
                            </div>
                        </div>
                    </div>
                    <div>
                        <div class="bg-white rounded-lg shadow border border-gray-200">
                            <div class="px-4 py-3 border-b border-gray-200 bg-gray-50">
                                <h4 class="text-sm font-medium text-gray-700">Summary</h4>
                            </div>
                            <div class="p-4">
                                <div class="mb-4">
                                    <p class="text-sm font-medium text-gray-700 mb-1">Total Amount</p>
                                    <p class="text-lg font-bold text-gray-900">$450.00</p>
                                </div>
                                <div class="mb-4">
                                    <p class="text-sm font-medium text-gray-700 mb-2">Participants</p>
                                    <div class="space-y-2">
                                        <div class="flex justify-between text-sm">
                                            <span class="text-gray-600">John Doe</span>
                                            <span class="font-medium">$150.00</span>
                                        </div>
                                        <!-- More participants... -->
                                    </div>
                                </div>
                                <div class="pt-4 border-t border-gray-200">
                                    <p class="text-sm font-medium text-gray-700 mb-1">Invitation Code</p>
                                    <div class="flex items-center">
                                        <code class="bg-gray-100 px-2 py-1 rounded text-sm font-mono">BILL-XY7P9Q</code>
                                        <button onclick="copyCode()" class="ml-2 text-primary hover:text-primary-dark">
                                            <i class="fas fa-copy"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mt-5 sm:mt-6">
                <button onclick="hideViewBillModal()" type="button" class="w-full flex justify-center py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary">
                    Close
                </button>
            </div>
        </div>
    </div>

    <!-- Add Expense Modal -->
    <div id="add-expense-modal" class="hidden fixed inset-0 bg-gray-500 bg-opacity-75 flex items-center justify-center z-50">
        <div class="bg-white rounded-lg shadow-xl max-w-md w-full p-6">
            <div class="flex justify-between items-start">
                <h3 class="text-lg font-medium text-gray-900">Add New Expense</h3>
                <button onclick="hideAddExpenseModal()" class="text-gray-400 hover:text-gray-500">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div class="mt-4">
                <div class="grid grid-cols-1 gap-6">
                    <div>
                        <label for="expense-name" class="block text-sm font-medium text-gray-700">Expense Name</label>
                        <input type="text" id="expense-name" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-primary focus:border-primary">
                    </div>

                    <div>
                        <label for="paid-by" class="block text-sm font-medium text-gray-700">Paid By</label>
                        <select id="paid-by" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-primary focus:border-primary">
                            <option>John Doe</option>
                            <option>Jane Smith</option>
                            <option>Mike Johnson</option>
                        </select>
                    </div>

                    <div>
                        <label for="split-type" class="block text-sm font-medium text-gray-700">Split Type</label>
                        <select id="split-type" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-primary focus:border-primary">
                            <option value="equal">Equally divided</option>
                            <option value="custom">Custom amounts</option>
                        </select>
                    </div>

                    <div id="custom-split-section" class="hidden bg-gray-50 p-4 rounded-md">
                        <h4 class="text-sm font-medium text-gray-700 mb-2">Custom Split</h4>
                        <div class="space-y-2">
                            <div class="flex items-center justify-between">
                                <span>John Doe</span>
                                <input type="number" class="w-20 border border-gray-300 rounded-md shadow-sm py-1 px-2 focus:outline-none focus:ring-primary focus:border-primary" placeholder="Amount">
                            </div>
                            <!-- More custom splits... -->
                        </div>
                    </div>
                </div>
            </div>
            <div class="mt-5 sm:mt-6 grid grid-cols-2 gap-3">
                <button onclick="hideAddExpenseModal()" type="button" class="w-full flex justify-center py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary">
                    Cancel
                </button>
                <button type="button" onclick="addExpense()" class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-primary hover:bg-primary-dark focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary">
                    Add Expense
                </button>
            </div>
        </div>
    </div>

    <script>
        // Section switching functionality
        function showSection(sectionId) {
            // Hide all sections
            document.querySelectorAll('[id$="-section"]').forEach(section => {
                section.classList.remove('active-section');
                section.classList.add('hidden');
            });
            
            // Show selected section
            document.getElementById(`${sectionId}-section`).classList.remove('hidden');
            document.getElementById(`${sectionId}-section`).classList.add('active-section');
            
            // Update mobile header
            const sectionNames = {
                'bills': 'Bills',
                'archive': 'Archive',
                'profile': 'Profile'
            };
            if (document.getElementById('mobile-header')) {
                document.getElementById('mobile-header').textContent = sectionNames[sectionId];
            }
        }

          // Track current active section
    let currentActiveSection = 'bills';

// Section switching functionality
function showSection(sectionId) {
    // Remove active class from all menu items
    document.querySelectorAll('.sidebar-item').forEach(item => {
        item.classList.remove('active');
        const icon = item.querySelector('i');
        icon.classList.remove('text-white');
        icon.classList.add('text-gray-400');
    });

    // Add active class to clicked menu item
    const activeMenuItem = document.getElementById(`${sectionId}-menu`);
    activeMenuItem.classList.add('active');
    const activeIcon = activeMenuItem.querySelector('i');
    activeIcon.classList.remove('text-gray-400');
    activeIcon.classList.add('text-white');

    // Hide all sections
    document.querySelectorAll('[id$="-section"]').forEach(section => {
        section.classList.remove('active-section');
        section.classList.add('hidden');
    });
    
    // Show selected section
    document.getElementById(`${sectionId}-section`).classList.remove('hidden');
    document.getElementById(`${sectionId}-section`).classList.add('active-section');
    
    // Update mobile header
    const sectionNames = {
        'bills': 'Bills',
        'archive': 'Archive',
        'profile': 'Profile'
    };
    if (document.getElementById('mobile-header')) {
        document.getElementById('mobile-header').textContent = sectionNames[sectionId];
    }

    // Update current active section
    currentActiveSection = sectionId;
}

        // Modal control functions
        function showAddBillModal() {
            document.getElementById('add-bill-modal').classList.remove('hidden');
        }

        function hideAddBillModal() {
            document.getElementById('add-bill-modal').classList.add('hidden');
        }

        function showViewBillModal() {
            document.getElementById('view-bill-modal').classList.remove('hidden');
        }

        function hideViewBillModal() {
            document.getElementById('view-bill-modal').classList.add('hidden');
        }

        function showAddExpenseModal() {
            document.getElementById('add-expense-modal').classList.remove('hidden');
        }

        function hideAddExpenseModal() {
            document.getElementById('add-expense-modal').classList.add('hidden');
        }

        // Form interactions
        function regenerateCode() {
            const chars = 'ABCDEFGHJKLMNPQRSTUVWXYZ23456789';
            let result = 'BILL-';
            for (let i = 0; i < 6; i++) {
                result += chars.charAt(Math.floor(Math.random() * chars.length));
            }
            document.getElementById('invitation-code').value = result;
        }

        function copyCode() {
            const code = document.querySelector('#view-bill-modal code').textContent;
            navigator.clipboard.writeText(code);
            alert('Invitation code copied to clipboard!');
        }

        // Toggle custom split section
        document.getElementById('split-type').addEventListener('change', function() {
            const customSplitSection = document.getElementById('custom-split-section');
            if (this.value === 'custom') {
                customSplitSection.classList.remove('hidden');
            } else {
                customSplitSection.classList.add('hidden');
            }
        });

        // Sample functions for demo purposes
        function createBill() {
            alert('Bill created successfully!');
            hideAddBillModal();
        }

        function addExpense() {
            alert('Expense added successfully!');
            hideAddExpenseModal();
        }

        function confirmArchiveBill() {
            if (confirm('Are you sure you want to archive this bill?')) {
                alert('Bill archived successfully!');
            }
        }

        function confirmDeleteBill() {
            if (confirm('Are you sure you want to delete this bill? This cannot be undone.')) {
                alert('Bill deleted successfully!');
            }
        }

        function restoreBill() {
            if (confirm('Restore this bill to active bills?')) {
                alert('Bill restored successfully!');
            }
        }

        function confirmLogout() {
            if (confirm('Are you sure you want to logout?')) {
        // Create a form and submit it via POST
        var form = document.createElement('form');
        form.method = 'POST';
        form.action = '/logout';

        // Add CSRF token
        var csrfToken = document.createElement('input');
        csrfToken.type = 'hidden';
        csrfToken.name = '_token';
        csrfToken.value = '{{ csrf_token() }}'; // You need to pass the CSRF token to the view

        form.appendChild(csrfToken);
        document.body.appendChild(form);
        form.submit();
            }
        }

        // Initialize default section
        document.addEventListener('DOMContentLoaded', function() {
            showSection('bills');
        });
    </script>
</body>
</html>