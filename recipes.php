<?php
header("Cache-Control: no-cache, must-revalidate");
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");
$thai_recipes = [
    "Pad Thai: Stir-fried rice noodles with shrimp, tofu, peanuts, scrambled egg, and bean sprouts.",
    "Green Curry: A flavorful curry made with green curry paste, coconut milk, chicken, and vegetables.",
    "Tom Yum Goong: A spicy and sour soup with shrimp, lemongrass, kaffir lime leaves, and mushrooms.",
    "Som Tum: A spicy green papaya salad with tomatoes, green beans, peanuts, and dried shrimp.",
    "Massaman Curry: A rich and creamy curry with beef, potatoes, and peanuts.",
    "Tom Kha Gai: A coconut milk soup with chicken, galangal, lemongrass, and mushrooms.",
    "Pad Kra Pao: Stir-fried minced pork or chicken with Thai basil, garlic, and chili.",
    "Mango Sticky Rice: A dessert made with sweet sticky rice, fresh mango slices, and coconut milk.",
    "Panang Curry: A creamy curry with beef or chicken, Panang curry paste, and coconut milk.",
    "Larb: A spicy minced meat salad with ground pork or chicken, lime juice, fish sauce, and herbs.",
    "Khao Pad: Thai fried rice with vegetables, chicken, shrimp, and egg.",
    "Satay: Grilled skewers of marinated meat served with peanut sauce.",
    "Pad See Ew: Stir-fried flat noodles with soy sauce, Chinese broccoli, and chicken or pork.",
    "Nam Tok: A spicy grilled beef salad with lime juice, fish sauce, and herbs.",
    "Khao Soi: A northern Thai curry noodle soup with chicken, coconut milk, and crispy noodles.",
    "Yam Talay: A spicy seafood salad with shrimp, squid, and mussels.",
    "Gaeng Daeng: Red curry with chicken, bamboo shoots, and Thai basil.",
    "Tod Mun Pla: Thai fish cakes served with a cucumber dipping sauce.",
    "Kai Jeow: A Thai-style omelette with ground pork, fish sauce, and herbs.",
    "Pla Rad Prik: Fried fish topped with a sweet and spicy chili sauce."
];
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="assets/css/main.css">
        <title>Recipes</title>
        <style>
            body {
                background-color: black;
                color: white;
                font-family: Arial, sans-serif;
                margin: 0;
                padding: 20px;
            }
            h1 {
                color: white;
            }
            ul {
                list-style: none;
                padding: 0;
            }
            li {
                background: lightgray;
                color: white;
                margin: 10px 0;
                padding: 15px;
                border-radius: 5px;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            }
        </style>
    </head>
    <body>
        <h1>Thai Recipes</h1>
        <ul id="thai-recipes"></ul>

        <script>
            const thaiRecipes = <?php echo json_encode($thai_recipes); ?>;

            function populateRecipes(recipesArray, elementId) {
                const ul = document.getElementById(elementId);
                recipesArray.forEach(recipe => {
                    const li = document.createElement('li');
                    li.textContent = recipe;
                    ul.appendChild(li);
                });
            }

            populateRecipes(thaiRecipes, 'thai-recipes');
        </script>
    </body>
</html>