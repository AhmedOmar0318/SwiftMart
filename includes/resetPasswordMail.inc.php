<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Form</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
<div class="container mx-auto py-8">
    <div class="max-w-md mx-auto bg-white rounded-lg overflow-hidden shadow-md">
        <div class="py-4 px-6">
            <h2 class="text-2xl font-bold mb-2">Reset Password</h2>
            <form action="action/sendPasswordResetMailAction.php" method="POST">

                <div class="mb-4">
                    <label for="email" class="block text-gray-700 font-bold mb-2">Email Address</label>
                    <input type="email" id="email" name="email" class="w-full px-3 py-2 border rounded-md focus:outline-none focus:border-blue-500" placeholder="Your Email" required>
                </div>

                <div class="mt-6">
                    <button type="submit" class="w-full px-4 py-2 bg-blue-500 text-white font-semibold rounded-md hover:bg-blue-600 focus:outline-none focus:bg-blue-600">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
</body>
</html>
