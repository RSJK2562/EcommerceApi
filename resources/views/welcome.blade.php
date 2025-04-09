<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel E-Commerce API</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="antialiased bg-gray-100 dark:bg-gray-900">
    <div class="min-h-screen flex flex-col items-center pt-6 sm:pt-0">
        <div class="w-full sm:max-w-3xl mt-6 p-6 bg-white dark:bg-gray-800 shadow-md overflow-hidden sm:rounded-lg">
            <div class="flex justify-center">
                <h1 class="text-3xl font-bold text-gray-900 dark:text-white mb-6">E-Commerce API Documentation</h1>
            </div>

            <!-- API Endpoints Section -->
            <div class="mb-8">
                <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-200 mb-4">API Endpoints</h2>
                <div class="bg-gray-50 dark:bg-gray-700 rounded-lg p-4 mb-4">
                    <ul class="space-y-2 text-gray-600 dark:text-gray-300">
                        <li class="flex items-start">
                            <span
                                class="inline-flex items-center justify-center px-2 py-1 mr-2 text-xs font-bold leading-none text-indigo-100 bg-indigo-700 rounded">GET</span>
                            <code class="text-sm font-mono">/api/products</code>
                            <span class="ml-2">- List all products</span>
                        </li>
                        <li class="flex items-start">
                            <span
                                class="inline-flex items-center justify-center px-2 py-1 mr-2 text-xs font-bold leading-none text-indigo-100 bg-green-700 rounded">POST</span>
                            <code class="text-sm font-mono">/api/products</code>
                            <span class="ml-2">- Create a new product</span>
                        </li>
                        <li class="flex items-start">
                            <span
                                class="inline-flex items-center justify-center px-2 py-1 mr-2 text-xs font-bold leading-none text-indigo-100 bg-indigo-700 rounded">GET</span>
                            <code class="text-sm font-mono">/api/products/{id}</code>
                            <span class="ml-2">- Get a specific product</span>
                        </li>
                        <li class="flex items-start">
                            <span
                                class="inline-flex items-center justify-center px-2 py-1 mr-2 text-xs font-bold leading-none text-indigo-100 bg-green-700 rounded">POST</span>
                            <code class="text-sm font-mono">/api/products/{id}</code>
                            <span class="ml-2">- Update a product (use POST for file uploads)</span>
                        </li>
                        <li class="flex items-start">
                            <span
                                class="inline-flex items-center justify-center px-2 py-1 mr-2 text-xs font-bold leading-none text-indigo-100 bg-red-700 rounded">DELETE</span>
                            <code class="text-sm font-mono">/api/products/{id}</code>
                            <span class="ml-2">- Delete a product</span>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Database Fields Section -->
            <div class="mb-8">
                <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-200 mb-4">Database Fields (Product Model)
                </h2>
                <div class="bg-gray-50 dark:bg-gray-700 rounded-lg p-4 mb-4">
                    <ul class="space-y-2 text-gray-600 dark:text-gray-300">
                        <li><code class="text-sm font-mono">id</code> - Primary key</li>
                        <li><code class="text-sm font-mono">name</code> - Product name</li>
                        <li><code class="text-sm font-mono">description</code> - Product description</li>
                        <li><code class="text-sm font-mono">price</code> - Product price</li>
                        <li><code class="text-sm font-mono">stock</code> - Quantity available</li>
                        <li><code class="text-sm font-mono">image_path</code> - Path to stored image file</li>
                        <li><code class="text-sm font-mono">active</code> - Status of product (true/false)</li>
                        <li><code class="text-sm font-mono">created_at</code> - Timestamp when record was created</li>
                        <li><code class="text-sm font-mono">updated_at</code> - Timestamp when record was last updated
                        </li>
                    </ul>
                </div>
            </div>

            <!-- API Request Parameters Section -->
            <div class="mb-8">
                <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-200 mb-4">API Request Parameters</h2>

                <!-- Create/Store Product Parameters -->
                <h3 class="text-lg font-medium text-gray-700 dark:text-gray-300 mb-2">Create/Store Product</h3>
                <div class="bg-gray-50 dark:bg-gray-700 rounded-lg p-4 mb-4">
                    <ul class="space-y-2 text-gray-600 dark:text-gray-300">
                        <li><code class="text-sm font-mono">name</code> - Required, string, max 255 chars</li>
                        <li><code class="text-sm font-mono">description</code> - Required, string</li>
                        <li><code class="text-sm font-mono">price</code> - Required, numeric, min 0</li>
                        <li><code class="text-sm font-mono">stock</code> - Required, integer, min 0</li>
                        <li><code class="text-sm font-mono">image</code> - Optional, file upload (image)</li>
                        <li><code class="text-sm font-mono">active</code> - Optional, boolean</li>
                    </ul>
                </div>

                <!-- Update Product Parameters -->
                <h3 class="text-lg font-medium text-gray-700 dark:text-gray-300 mb-2">Update Product</h3>
                <div class="bg-gray-50 dark:bg-gray-700 rounded-lg p-4 mb-4">
                    <ul class="space-y-2 text-gray-600 dark:text-gray-300">
                        <li><code class="text-sm font-mono">name</code> - Optional, string, max 255 chars</li>
                        <li><code class="text-sm font-mono">description</code> - Optional, string</li>
                        <li><code class="text-sm font-mono">price</code> - Optional, numeric, min 0</li>
                        <li><code class="text-sm font-mono">stock</code> - Optional, integer, min 0</li>
                        <li><code class="text-sm font-mono">image</code> - Optional, file upload (image)</li>
                        <li><code class="text-sm font-mono">active</code> - Optional, boolean</li>
                    </ul>
                </div>
            </div>

            <!-- File Uploads Section -->
            <div class="mb-8">
                <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-200 mb-4">File Uploads</h2>
                <div class="bg-gray-50 dark:bg-gray-700 rounded-lg p-4">
                    <p class="text-gray-600 dark:text-gray-300 mb-2">When creating or updating products, you can upload
                        image files using form-data:</p>
                    <div class="bg-white dark:bg-gray-600 rounded-md p-3 font-mono text-sm">
                        <div class="mb-2">
                            <span class="text-purple-600 dark:text-purple-400">Key:</span> <code>image</code>
                        </div>
                        <div>
                            <span class="text-purple-600 dark:text-purple-400">Value:</span> <span>Select your image
                                file (jpeg, png, jpg, gif supported)</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- API Response Keys Section -->
            <div class="mb-8">
                <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-200 mb-4">API Response Keys</h2>

                <!-- Success Response -->
                <h3 class="text-lg font-medium text-gray-700 dark:text-gray-300 mb-2">Success Response</h3>
                <div class="bg-gray-50 dark:bg-gray-700 rounded-lg p-4 mb-4">
                    <ul class="space-y-2 text-gray-600 dark:text-gray-300">
                        <li class="mb-2"><code class="text-sm font-mono">data</code> - Contains product information
                        </li>
                        <ul class="space-y-1 pl-6 mb-2">
                            <li><code class="text-sm font-mono">id</code> - Product ID</li>
                            <li><code class="text-sm font-mono">name</code> - Product name</li>
                            <li><code class="text-sm font-mono">description</code> - Product description</li>
                            <li><code class="text-sm font-mono">price</code> - Product price</li>
                            <li><code class="text-sm font-mono">stock</code> - Available quantity</li>
                            <li><code class="text-sm font-mono">image_path</code> - Server path to image</li>
                            <li><code class="text-sm font-mono">image_url</code> - Full URL to access image</li>
                            <li><code class="text-sm font-mono">active</code> - Product status</li>
                            <li><code class="text-sm font-mono">created_at</code> - Creation timestamp</li>
                            <li><code class="text-sm font-mono">updated_at</code> - Last update timestamp</li>
                        </ul>
                        <li><code class="text-sm font-mono">message</code> - Success message</li>
                        <li><code class="text-sm font-mono">success</code> - Boolean flag (true)</li>
                    </ul>
                </div>

                <!-- Error Response -->
                <h3 class="text-lg font-medium text-gray-700 dark:text-gray-300 mb-2">Error Response</h3>
                <div class="bg-gray-50 dark:bg-gray-700 rounded-lg p-4 mb-4">
                    <ul class="space-y-2 text-gray-600 dark:text-gray-300">
                        <li><code class="text-sm font-mono">errors</code> - Validation errors (if any)</li>
                        <li><code class="text-sm font-mono">message</code> - Error message</li>
                        <li><code class="text-sm font-mono">success</code> - Boolean flag (false)</li>
                    </ul>
                </div>
            </div>

            <!-- Response Format Section -->
            <div class="mb-8">
                <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-200 mb-4">Response Format</h2>
                <div class="bg-gray-50 dark:bg-gray-700 rounded-lg p-4">
                    <p class="text-gray-600 dark:text-gray-300 mb-2">All API responses follow this standard format:</p>
                    <div class="bg-white dark:bg-gray-600 rounded-md p-3">
                        <pre class="text-xs"><code>{
  "data": {},      // Contains the response data
  "message": "",   // Success or error message
  "success": true  // Boolean indicating success or failure
}</code></pre>
                    </div>
                </div>
            </div>
        </div>

        <footer class="w-full text-center p-4 text-gray-500 dark:text-gray-400 text-sm">
            <p>Laravel E-Commerce API &copy; 2025</p>
        </footer>
    </div>

</html>
