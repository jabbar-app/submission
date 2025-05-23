<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login | Future Leaders ID</title>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
  <style>
    body {
      font-family: 'Poppins', sans-serif;
      background: linear-gradient(to right bottom, #142238, #101c2f);
    }

    .google-button {
      background-color: #142238;
      transition: background-color 0.3s ease-in-out;
    }

    .google-button:hover {
      background-color: #101c2f;
    }

    .card-shadow-lg {
      box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
    }
  </style>
</head>

<body class="flex items-center justify-center min-h-screen">
  <div class="bg-white p-10 rounded-xl card-shadow-lg w-full max-w-sm text-center">
    <h2 class="text-2xl font-bold mb-4 text-gray-800">Welcome, Leaders!</h2>
    <p class="text-gray-600 mb-8">Please use same Google Account with your Future Leaders ID to submit your Leadership
      Project.</p>

    {{-- Pesan error atau sukses (opsional) --}}
    @if (session('error'))
      <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-6" role="alert">
        <span class="block sm:inline">{{ session('error') }}</span>
      </div>
    @endif

    <a href="{{ route('auth.google') }}"
      class="google-button inline-flex items-center justify-center text-white font-semibold py-3 px-6 rounded-lg transition duration-300 ease-in-out w-full transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">
      <svg class="w-5 h-5 mr-2" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M44.5 20H24V28.5H35.5C34.7 32.5 31.5 35.5 28.5 36.5V42H35.5C40.5 37 44 31 44.5 20Z" fill="#4285F4" />
        <path
          d="M24 44C30.5 44 36 41.5 40 37.5L35 32.5C32.5 34.5 28.5 36.5 24 36.5C18.5 36.5 13.5 33 11.5 28H4.5V34.5C6.5 39.5 12 44 24 44Z"
          fill="#34A853" />
        <path d="M11.5 28C10.5 25.5 10.5 22.5 11.5 20V13.5H4.5C4.5 16.5 4.5 21.5 4.5 28H11.5Z" fill="#FBBC05" />
        <path
          d="M24 11.5C27 11.5 29.5 12.5 31.5 14.5L37 9C33 5 28.5 3 24 3C12 3 6.5 7.5 4.5 13.5L11.5 20C13.5 15 18.5 11.5 24 11.5Z"
          fill="#EA4335" />
      </svg>
      Login with Google
    </a>

    <img src="{{ asset('assets/images/fli-logo.svg') }}" alt="Logo Aplikasi" class="mx-auto h-10 mt-8">
  </div>
</body>

</html>
