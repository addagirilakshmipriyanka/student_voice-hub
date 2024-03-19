<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            display: flex;
            /* overflow: hidden; Prevent body from scrolling */
        }

        #left-column {
            width: 500px;
            background-color: #f0f0f0;
            position: fixed;
            top: 0;
            bottom: 0;
            overflow: hidden; /* Hide scrollbar in the left column */
        }

        #right-column {
          text-align:center;
            flex: 1;
            overflow-y: auto; /* Allow scrolling in the right column */
            padding: 20px;
            display: flex;
            flex-direction: column; /* Elements in the right column as a column */
        }

        /* Add some content for demonstration purposes */
        #right-column p {
            margin-bottom: 20px;
            width: 100%; /* Make each paragraph take the full width */
            box-sizing: border-box; /* Include padding and border in the width */
        }
    </style>
</head>
<body>
    <div id="left-column">
        <!-- Left column content goes here -->
        <p>Left Column Content</p>
    </div>

    <div id="right-column">
        <!-- Right column content goes here -->
        <!-- Add enough content to make the right column scroll -->
        <?php
        for ($i = 1; $i <= 20; $i++) {
            echo "<p>Right Column Content $i</p>";
        }
        ?>
    </div>
</body>
</html>
