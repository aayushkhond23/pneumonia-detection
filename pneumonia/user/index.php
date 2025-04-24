<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AI Pneumonia Analyzer - User Authentication</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css">
    <style>
        body {
            background: linear-gradient(135deg, #6B73FF 0%, #000DFF 100%);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            font-family: Arial, sans-serif;
        }
        .container {
            background: white;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
            transition: transform 0.3s ease;
        }
        .container:hover {
            transform: scale(1.02);
        }
        input {
            border: 2px solid #ccc;
            padding: 10px;
            border-radius: 8px;
            width: 100%;
            transition: border-color 0.3s;
        }
        input:focus {
            border-color: #6B73FF;
            outline: none;
        }
        button {
            background-color: #6B73FF;
            color: white;
            padding: 10px;
            border-radius: 8px;
            border: none;
            cursor: pointer;
            width: 100%;
            transition: background-color 0.3s;
        }
        button:hover {
            background-color: #000DFF;
        }
        .tabs {
            display: flex;
            margin-bottom: 20px;
            border-radius: 8px;
            overflow: hidden;
        }
        .tabs button {
            flex: 1;
            padding: 10px;
            font-weight: bold;
            transition: background-color 0.3s, color 0.3s;
        }
    </style>
</head>
<body>

    <div class="container">
        <center><h1 style="font-size: 35px;font-family: Cursive;color: black;">AI Pneumonia Analyzer</h1></center>
        <div class="tabs">
            <button id="loginTab" class="bg-blue-500 text-white">Login</button>
            <button id="registerTab" class="bg-gray-200 text-gray-700">Register</button>
        </div>

        <!-- Login Form -->
        <div id="loginForm">
            <form action="login.php" method="POST">
                <div class="mb-4">
                    <input type="email" name="email" placeholder="Email" required>
                </div>
                <div class="mb-4">
                    <input type="password" name="password" placeholder="Password" required>
                </div>
                <button type="submit">Login</button>
            </form>
        </div>

        <!-- Register Form -->
        <div id="registerForm" class="hidden">
            <form action="register.php" method="POST">
                <div class="mb-4">
                    <input type="text" name="name" placeholder="Name" required>
                </div>
                <div class="mb-4">
                    <input type="email" name="email" placeholder="Email" required>
                </div>
                <div class="mb-4">
                    <input type="password" name="password" placeholder="Password" required>
                </div>
                <button type="submit">Register</button>
            </form>
        </div>
    </div>

    <!-- Toggle Forms Script -->
    <script>
        const loginTab = document.getElementById('loginTab');
        const registerTab = document.getElementById('registerTab');
        const loginForm = document.getElementById('loginForm');
        const registerForm = document.getElementById('registerForm');

        loginTab.addEventListener('click', () => {
            loginForm.classList.remove('hidden');
            registerForm.classList.add('hidden');
            loginTab.classList.add('bg-blue-500', 'text-white');
            registerTab.classList.remove('bg-blue-500', 'text-white');
            registerTab.classList.add('bg-gray-200', 'text-gray-700');
        });

        registerTab.addEventListener('click', () => {
            loginForm.classList.add('hidden');
            registerForm.classList.remove('hidden');
            registerTab.classList.add('bg-blue-500', 'text-white');
            loginTab.classList.remove('bg-blue-500', 'text-white');
            loginTab.classList.add('bg-gray-200', 'text-gray-700');
        });
    </script>
</body>
</html>
