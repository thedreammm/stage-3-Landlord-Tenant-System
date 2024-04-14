<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enhanced Messaging System</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"></link>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap');
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>
<body class="bg-gray-200">
    <div class="container mx-auto p-6">
        <!-- Messaging Area -->
        <div class="flex flex-col lg:flex-row gap-6">
            <!-- Tenant List -->
            <div class="lg:w-1/4 bg-white rounded-lg shadow-lg p-4">
                <h2 class="text-xl font-semibold mb-3 text-gray-800">Tenants</h2>
                <div class="overflow-auto" style="max-height: 400px;">
                    <ul class="space-y-2">
                        <li>
                            <label class="flex items-center p-2 rounded-lg hover:bg-gray-50 cursor-pointer">
                                <input type="checkbox" class="form-checkbox h-5 w-5 text-blue-600 rounded"><span class="ml-2 text-sm text-gray-700">Alex Johnson</span>
                            </label>
                        </li>
                        <li>
                            <label class="flex items-center p-2 rounded-lg hover:bg-gray-50 cursor-pointer">
                                <input type="checkbox" class="form-checkbox h-5 w-5 text-blue-600 rounded"><span class="ml-2 text-sm text-gray-700">Samantha Brown</span>
                            </label>
                        </li>
                        <li>
                            <label class="flex items-center p-2 rounded-lg hover:bg-gray-50 cursor-pointer">
                                <input type="checkbox" class="form-checkbox h-5 w-5 text-blue-600 rounded"><span class="ml-2 text-sm text-gray-700">Michael Davis</span>
                            </label>
                        </li>
                        <!-- Add more tenants as needed -->
                    </ul>
                </div>
            </div>

            <!-- Messaging Form -->
            <div class="lg:w-3/4 bg-white rounded-lg shadow-lg p-6">
                <h2 class="text-xl font-semibold mb-4 text-gray-800">Send a Message</h2>
                <form>
                    <div class="mb-4">
                        <label for="subject" class="block text-sm font-medium text-gray-700">Subject</label>
                        <input type="text" id="subject" class="mt-1 block w-full px-4 py-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                    </div>
                    <div class="mb-4">
                        <label for="message" class="block text-sm font-medium text-gray-700">Message</label>
                        <textarea id="message" rows="6" class="mt-1 block w-full px-4 py-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm"></textarea>
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Attach Documents</label>
                        <div class="mt-1 flex items-center space-x-4">
                            <span class="inline-block rounded-md shadow-sm">
                                <button type="button" class="py-2 px-4 border border-gray-300 rounded-md text-sm leading-4 font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none">
                                    <i class="fas fa-paperclip mr-2"></i> Attach files
                                </button>
                            </span>
                            <div id="file-upload-filename" class="text-sm text-gray-500"></div>
                        </div>
                    </div>
                    <div class="flex justify-end">
                        <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            Send Message
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        // JavaScript for handling attachments and form submission can be included here.
        const attachButton = document.querySelector('button[type="button"]');
        const fileUploadFilename = document.getElementById('file-upload-filename');

        attachButton.addEventListener('click', () => {
            const fileInput = document.createElement('input');
            fileInput.type = 'file';
            fileInput.style.display = 'none';
            fileInput.addEventListener('change', () => {
                fileUploadFilename.textContent = Array.from(fileInput.files).map(file => file.name).join(', ');
            });
            attachButton.parentElement.appendChild(fileInput);
            fileInput.click();
        });
    </script>
</body>
</html>