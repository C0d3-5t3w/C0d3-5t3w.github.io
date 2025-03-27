<?php
header("Cache-Control: no-cache, must-revalidate");
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");
$coding_advice = [
    "Write clean and readable code.",
    "Comment your code to explain complex logic.",
    "Use version control systems like Git.",
    "Keep learning new programming languages and frameworks.",
    "Debug your code using tools and breakpoints.",
    "Write unit tests to ensure code reliability.",
    "Follow coding standards and best practices.",
    "Use meaningful variable and function names.",
    "Refactor code regularly to improve its structure.",
    "Participate in code reviews to learn and share knowledge."
];
$cooking_advice = [
    "Always taste your food as you cook.",
    "Use fresh ingredients for better flavor.",
    "Keep your knives sharp for safety and efficiency.",
    "Clean as you go to keep your workspace tidy.",
    "Experiment with spices and herbs to enhance flavors.",
    "Read the entire recipe before starting.",
    "Preheat your oven for consistent results.",
    "Use a meat thermometer to ensure proper cooking.",
    "Let meat rest before slicing to retain juices.",
    "Organize your ingredients before cooking."
];
$dubstep_advice = [
    "Experiment with different software and plugins.",
    "Layer your sounds to create a rich texture.",
    "Use automation to add dynamics to your tracks.",
    "Listen to a wide range of dubstep artists for inspiration.",
    "Practice sound design to create unique sounds.",
    "Focus on creating powerful basslines.",
    "Use sidechain compression for that pumping effect.",
    "Experiment with different tempos and rhythms.",
    "Add variations to keep your tracks interesting.",
    "Collaborate with other artists to learn new techniques."
];
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="assets/css/main.css">
        <title>Advice</title>
        <style>
            body {
                background-color: black;
                color: white;
                font-family: Arial, sans-serif;
                margin: 0;
                padding: 20px;
            }
            h1 {
                color: #fb2aff;
            }
            ul {
                list-style: none;
                padding: 0;
            }
            li {
                background: #fff;
                color: black;
                margin: 10px 0;
                padding: 15px;
                border-radius: 5px;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            }
        </style>
    </head>
    <body>
        <h1>Coding Advice</h1>
        <ul id="coding-advice"></ul>

        <h1>Cooking Advice</h1>
        <ul id="cooking-advice"></ul>

        <h1>Dubstep Music Advice</h1>
        <ul id="dubstep-advice"></ul>

        <script>
            const codingAdvice = <?php echo json_encode($coding_advice); ?>;
            const cookingAdvice = <?php echo json_encode($cooking_advice); ?>;
            const dubstepAdvice = <?php echo json_encode($dubstep_advice); ?>;

            function populateAdvice(adviceArray, elementId) {
                const ul = document.getElementById(elementId);
                adviceArray.forEach(advice => {
                    const li = document.createElement('li');
                    li.textContent = advice;
                    ul.appendChild(li);
                });
            }

            populateAdvice(codingAdvice, 'coding-advice');
            populateAdvice(cookingAdvice, 'cooking-advice');
            populateAdvice(dubstepAdvice, 'dubstep-advice');
        </script>
    </body>
</html>