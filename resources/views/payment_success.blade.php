<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Confirmation</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 flex items-center justify-center h-screen">
    <div class="bg-white p-8 rounded-2xl shadow-lg text-center max-w-md">
        <div class="flex justify-center mb-4">
            <svg xmlns="http://www.w3.org/2000/svg"
                 class="h-16 w-16 text-green-500"
                 fill="none"
                 viewBox="0 0 24 24"
                 stroke="currentColor"
                 stroke-width="2">
                <path stroke-linecap="round"
                      stroke-linejoin="round"
                      d="M9 12l2 2l4-4m6 2a9 9 0 11-18 0a9 9 0 0118 0z" />
            </svg>
        </div>
        <h1 class="text-2xl font-bold text-gray-800 mb-2">Payment Successful!</h1>

        <!-- 👇 Dynamic message goes here -->
        <p class="text-gray-600 mb-4">
            {{ $data }}
        </p>

        <a href="{{ url('/') }}"
           class="inline-block bg-green-500 text-white px-6 py-2 rounded-lg shadow hover:bg-green-600 transition">
            Go to Home
        </a>
    </div>
</body>
</html>
