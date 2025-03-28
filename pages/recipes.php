<?php
header("Cache-Control: no-cache, must-revalidate");
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");
$thai_recipes = [
    [
        "name" => "Pad Thai",
        "description" => "Stir-fried rice noodles with shrimp, tofu, peanuts, scrambled egg, and bean sprouts.",
        "instructions" => "1. Soak rice noodles in warm water for 15 minutes. 2. Heat oil in a wok and cook shrimp until pink. 3. Add tofu, garlic, and egg, and scramble. 4. Add noodles, fish sauce, tamarind paste, and sugar. 5. Stir-fry until noodles are tender. 6. Add bean sprouts and peanuts. 7. Serve with lime wedges.",
        "origin" => "Pad Thai is a popular street food in Thailand, known for its balance of sweet, sour, and savory flavors."
    ],
    [
        "name" => "Green Curry",
        "description" => "A flavorful curry made with green curry paste, coconut milk, chicken, and vegetables.",
        "instructions" => "1. Heat oil in a pan and add green curry paste. 2. Add coconut milk and bring to a simmer. 3. Add chicken and cook until done. 4. Add vegetables and cook until tender. 5. Serve with rice.",
        "origin" => "Green Curry is a traditional Thai dish known for its vibrant green color and spicy taste."
    ],
    [
        "name" => "Tom Yum Goong",
        "description" => "A spicy and sour soup with shrimp, lemongrass, kaffir lime leaves, and mushrooms.",
        "instructions" => "1. Boil water and add lemongrass, kaffir lime leaves, and galangal. 2. Add mushrooms and shrimp. 3. Season with fish sauce, lime juice, and chili paste. 4. Serve hot.",
        "origin" => "Tom Yum Goong is a classic Thai soup, renowned for its bold and tangy flavors."
    ],
    [
        "name" => "Som Tum",
        "description" => "A spicy green papaya salad with tomatoes, green beans, peanuts, and dried shrimp.",
        "instructions" => "1. Shred green papaya and mix with tomatoes, green beans, and peanuts. 2. Add dried shrimp, garlic, and chili. 3. Season with fish sauce, lime juice, and palm sugar. 4. Toss and serve.",
        "origin" => "Som Tum is a staple in Thai cuisine, particularly popular in the northeastern region of Thailand."
    ],
    [
        "name" => "Massaman Curry",
        "description" => "A rich and creamy curry with beef, potatoes, and peanuts.",
        "instructions" => "1. Heat oil and add Massaman curry paste. 2. Add coconut milk and bring to a simmer. 3. Add beef and cook until tender. 4. Add potatoes and peanuts. 5. Serve with rice.",
        "origin" => "Massaman Curry is a fusion of Thai and Indian flavors, often associated with southern Thailand."
    ],
    [
        "name" => "Tom Kha Gai",
        "description" => "A coconut milk soup with chicken, galangal, lemongrass, and mushrooms.",
        "instructions" => "1. Boil coconut milk with galangal, lemongrass, and kaffir lime leaves. 2. Add chicken and mushrooms. 3. Season with fish sauce and lime juice. 4. Serve hot.",
        "origin" => "Tom Kha Gai is a popular Thai soup, known for its creamy texture and fragrant spices."
    ],
    [
        "name" => "Pad Kra Pao",
        "description" => "Stir-fried minced pork or chicken with Thai basil, garlic, and chili.",
        "instructions" => "1. Heat oil in a pan and add garlic and chili. 2. Add minced pork or chicken and cook until done. 3. Add Thai basil and soy sauce. 4. Serve with rice.",
        "origin" => "Pad Kra Pao is a beloved street food in Thailand, offering a spicy and aromatic experience."
    ],
    [
        "name" => "Mango Sticky Rice",
        "description" => "A dessert made with sweet sticky rice, fresh mango slices, and coconut milk.",
        "instructions" => "1. Cook sticky rice and mix with coconut milk and sugar. 2. Serve with fresh mango slices. 3. Drizzle with additional coconut milk.",
        "origin" => "Mango Sticky Rice is a traditional Thai dessert, enjoyed especially during mango season."
    ],
    [
        "name" => "Panang Curry",
        "description" => "A creamy curry with beef or chicken, Panang curry paste, and coconut milk.",
        "instructions" => "1. Heat oil and add Panang curry paste. 2. Add coconut milk and bring to a simmer. 3. Add beef or chicken and cook until done. 4. Serve with rice.",
        "origin" => "Panang Curry is known for its rich and creamy texture, often enjoyed with a side of rice."
    ],
    [
        "name" => "Larb",
        "description" => "A spicy minced meat salad with ground pork or chicken, lime juice, fish sauce, and herbs.",
        "instructions" => "1. Cook ground pork or chicken. 2. Mix with lime juice, fish sauce, and herbs. 3. Serve with lettuce leaves.",
        "origin" => "Larb is a traditional dish from northeastern Thailand, often served as part of a larger meal."
    ],
    [
        "name" => "Khao Pad",
        "description" => "Thai fried rice with vegetables, chicken, shrimp, and egg.",
        "instructions" => "1. Heat oil in a pan and cook chicken and shrimp. 2. Add vegetables and egg, and scramble. 3. Add rice and stir-fry with soy sauce and fish sauce. 4. Serve hot.",
        "origin" => "Khao Pad is a versatile and popular dish in Thailand, enjoyed by locals and visitors alike."
    ],
    [
        "name" => "Satay",
        "description" => "Grilled skewers of marinated meat served with peanut sauce.",
        "instructions" => "1. Marinate meat in a mixture of coconut milk, curry powder, and spices. 2. Skewer and grill until cooked. 3. Serve with peanut sauce.",
        "origin" => "Satay is a favorite street food in Thailand, often served with a side of tangy peanut sauce."
    ],
    [
        "name" => "Pad See Ew",
        "description" => "Stir-fried flat noodles with soy sauce, Chinese broccoli, and chicken or pork.",
        "instructions" => "1. Heat oil in a pan and cook chicken or pork. 2. Add flat noodles and soy sauce. 3. Add Chinese broccoli and stir-fry until tender. 4. Serve hot.",
        "origin" => "Pad See Ew is a popular noodle dish in Thailand, known for its savory and slightly sweet flavor."
    ],
    [
        "name" => "Nam Tok",
        "description" => "A spicy grilled beef salad with lime juice, fish sauce, and herbs.",
        "instructions" => "1. Grill beef and slice thinly. 2. Mix with lime juice, fish sauce, and herbs. 3. Serve with lettuce leaves.",
        "origin" => "Nam Tok is a traditional dish from northeastern Thailand, often enjoyed with sticky rice."
    ],
    [
        "name" => "Khao Soi",
        "description" => "A northern Thai curry noodle soup with chicken, coconut milk, and crispy noodles.",
        "instructions" => "1. Cook chicken in a mixture of coconut milk and curry paste. 2. Add cooked noodles and top with crispy noodles. 3. Serve with lime wedges and pickled mustard greens.",
        "origin" => "Khao Soi is a signature dish of northern Thailand, known for its rich and creamy curry broth."
    ],
    [
        "name" => "Yam Talay",
        "description" => "A spicy seafood salad with shrimp, squid, and mussels.",
        "instructions" => "1. Boil seafood until cooked. 2. Mix with lime juice, fish sauce, and chili paste. 3. Serve with fresh vegetables.",
        "origin" => "Yam Talay is a popular Thai salad, offering a refreshing and spicy taste of the sea."
    ],
    [
        "name" => "Gaeng Daeng",
        "description" => "Red curry with chicken, bamboo shoots, and Thai basil.",
        "instructions" => "1. Heat oil and add red curry paste. 2. Add coconut milk and bring to a simmer. 3. Add chicken and bamboo shoots. 4. Add Thai basil and serve with rice.",
        "origin" => "Gaeng Daeng is a classic Thai curry, known for its vibrant red color and aromatic flavor."
    ],
    [
        "name" => "Tod Mun Pla",
        "description" => "Thai fish cakes served with a cucumber dipping sauce.",
        "instructions" => "1. Mix fish paste with red curry paste and green beans. 2. Form into patties and fry until golden brown. 3. Serve with cucumber dipping sauce.",
        "origin" => "Tod Mun Pla is a popular appetizer in Thailand, enjoyed for its flavorful and crispy texture."
    ],
    [
        "name" => "Kai Jeow",
        "description" => "A Thai-style omelette with ground pork, fish sauce, and herbs.",
        "instructions" => "1. Beat eggs and mix with ground pork, fish sauce, and herbs. 2. Fry in hot oil until golden brown. 3. Serve with rice.",
        "origin" => "Kai Jeow is a simple yet delicious Thai dish, often enjoyed as a quick meal."
    ],
    [
        "name" => "Pla Rad Prik",
        "description" => "Fried fish topped with a sweet and spicy chili sauce.",
        "instructions" => "1. Fry fish until crispy. 2. Cook chili sauce with garlic, chili, and sugar. 3. Pour sauce over fish and serve.",
        "origin" => "Pla Rad Prik is a flavorful Thai dish, combining crispy fish with a sweet and spicy sauce."
    ]
];
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../assets/css/main.css">
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
                color: black;
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
        <h2>
            <a href="../index.html" style="color: white;">Home</a>
        </h2>
        <script>
            const thaiRecipes = <?php echo json_encode($thai_recipes); ?>;

            function populateRecipes(recipesArray, elementId) {
                const ul = document.getElementById(elementId);
                recipesArray.forEach(recipe => {
                    const li = document.createElement('li');
                    li.innerHTML = `<strong>${recipe.name}</strong>: ${recipe.description}
                                    <br><br><strong>Instructions:</strong> ${recipe.instructions}
                                    <br><br><strong>Origin:</strong> ${recipe.origin}`;
                    ul.appendChild(li);
                });
            }

            populateRecipes(thaiRecipes, 'thai-recipes');
        </script>
    </body>
</html>