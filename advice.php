<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="assets/css/main.css">
        <title>Advice</title>
        <style>
            body {
                font-family: Arial, sans-serif;
                background-color: #f4f4f4;
                margin: 0;
                padding: 20px;
            }
            h1 {
                color: #333;
            }
            ul {
                list-style: none;
                padding: 0;
            }
            li {
                background: #fff;
                margin: 10px 0;
                padding: 15px;
                border-radius: 5px;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            }
        </style>
    </head>
    <body>
        <h1>Coding Advice</h1>
        <ul>
            <?php
            $coding_advice = [
                "Write clean and readable code.",
                "Comment your code to explain complex logic.",
                "Use version control systems like Git.",
                "Keep learning new programming languages and frameworks.",
                "Debug your code using tools and breakpoints."
            ];
            foreach ($coding_advice as $advice) {
                echo "<li>$advice</li>";
            }
            ?>
        </ul>

        <h1>Cooking Advice</h1>
        <ul>
            <?php
            $cooking_advice = [
                "Always taste your food as you cook.",
                "Use fresh ingredients for better flavor.",
                "Keep your knives sharp for safety and efficiency.",
                "Clean as you go to keep your workspace tidy.",
                "Experiment with spices and herbs to enhance flavors."
            ];
            foreach ($cooking_advice as $advice) {
                echo "<li>$advice</li>";
            }
            ?>
        </ul>

        <h1>Dubstep Music Advice</h1>
        <ul>
            <?php
            $dubstep_advice = [
                "Experiment with different software and plugins.",
                "Layer your sounds to create a rich texture.",
                "Use automation to add dynamics to your tracks.",
                "Listen to a wide range of dubstep artists for inspiration.",
                "Practice sound design to create unique sounds."
            ];
            foreach ($dubstep_advice as $advice) {
                echo "<li>$advice</li>";
            }
            ?>
        </ul>
    </body>
</html>