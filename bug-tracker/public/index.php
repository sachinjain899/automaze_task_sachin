<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bug Tracker</title>
    <link href="https://cdn.tailwindcss.com" rel="stylesheet">
    <script src="https://unpkg.com/htmx.org@1.9.2"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center h-screen">
    <div id="main-content" class="bg-white p-6 rounded shadow">
        <h1 class="text-2xl font-bold mb-4">Hello World</h1>
        <button class="bg-blue-500 text-white px-4 py-2 rounded" id="report-bug">Report a Bug</button>
    </div>

    <div id="bug-form" class="hidden">
        <form hx-post="report.php" hx-target="#main-content" class="bg-white p-6 rounded shadow">
            <h2 class="text-xl font-bold mb-4">Report a Bug</h2>
            <label class="block mb-2">Title</label>
            <input type="text" name="title" class="block w-full mb-4 p-2 border rounded">
            <label class="block mb-2">Comment</label>
            <textarea name="comment" class="block w-full mb-4 p-2 border rounded"></textarea>
            <label class="block mb-2">Urgency</label>
            <select name="urgency" class="block w-full mb-4 p-2 border rounded">
                <option>Low</option>
                <option>Medium</option>
                <option>High</option>
            </select>
            <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded">Submit</button>
        </form>
    </div>

    <script>
        document.getElementById('report-bug').addEventListener('click', function() {
            document.getElementById('main-content').innerHTML = document.getElementById('bug-form').innerHTML;
        });
    </script>
</body>
</html>