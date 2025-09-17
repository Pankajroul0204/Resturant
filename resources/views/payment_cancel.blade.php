<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Canceled</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100 flex items-center justify-center h-screen">
    <div class="bg-white p-8 rounded-2xl shadow-lg text-center max-w-md">
        <div class="flex justify-center mb-4">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-red-500" fill="none" viewBox="0 0 24 24"
                stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </div>
        <h1 class="text-2xl font-bold text-gray-800 mb-2">Payment Canceled</h1>
        <p class="text-gray-600 mb-4">
            Your payment was not completed. You can check email for payment or return to the homepage.
        </p>
        <div class="flex justify-center gap-4">
            <a href="{{ url('/') }}"
                class="inline-block bg-gray-500 text-white px-6 py-2 rounded-lg shadow hover:bg-gray-600 transition">
                Home
            </a>
        </div>
    </div>
</body>

</html>
