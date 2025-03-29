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

$hispanic_recipes = [
    [
        "name" => "Tacos al Pastor",
        "description" => "Marinated pork tacos with pineapple, onions, and cilantro.",
        "instructions" => "1. Marinate sliced pork with achiote paste, pineapple juice, and spices. 2. Stack marinated pork on a vertical spit. 3. Cook and slice thin pieces off the spit. 4. Serve on corn tortillas with diced pineapple, onions, and cilantro. 5. Add lime juice and salsa.",
        "origin" => "Tacos al Pastor originated in central Mexico, inspired by Lebanese immigrants who brought shawarma techniques in the early 20th century."
    ],
    [
        "name" => "Paella",
        "description" => "Saffron-infused rice dish with seafood, chicken, and vegetables.",
        "instructions" => "1. Sauté chicken and vegetables in olive oil. 2. Add rice and saffron. 3. Pour in broth and simmer. 4. Add seafood in the last few minutes of cooking. 5. Let rest before serving.",
        "origin" => "Paella originated in Valencia, Spain, and is considered one of Spain's most iconic dishes."
    ],
    [
        "name" => "Empanadas",
        "description" => "Stuffed pastries with various fillings like meat, cheese, or vegetables.",
        "instructions" => "1. Prepare dough with flour, water, and salt. 2. Roll out dough and cut into circles. 3. Add filling to center. 4. Fold over and seal edges. 5. Bake or fry until golden brown.",
        "origin" => "Empanadas are popular throughout Latin America and Spain, with each region having its own variation."
    ],
    [
        "name" => "Tamales",
        "description" => "Masa dough filled with meat, cheese, or beans, wrapped in corn husks and steamed.",
        "instructions" => "1. Prepare masa dough with corn flour, lard, and broth. 2. Soak corn husks in water. 3. Spread masa on husks, add filling, and fold. 4. Steam for 1-2 hours until firm.",
        "origin" => "Tamales date back to ancient Mesoamerican civilizations including the Aztec and Maya peoples."
    ],
    [
        "name" => "Mole Poblano",
        "description" => "Rich sauce made with chocolate, chili peppers, and numerous spices, typically served with chicken.",
        "instructions" => "1. Toast and grind multiple varieties of dried chilies. 2. Mix with spices, chocolate, bread, and broth. 3. Simmer until thick and complex. 4. Serve over chicken with rice.",
        "origin" => "Mole Poblano originates from Puebla, Mexico, and is considered Mexico's national dish."
    ],
    [
        "name" => "Ceviche",
        "description" => "Raw fish marinated in citrus juices and spiced with chili peppers.",
        "instructions" => "1. Dice fresh fish into small cubes. 2. Marinate in lime or lemon juice for several hours. 3. Mix with diced onions, chili peppers, cilantro, and salt. 4. Serve chilled.",
        "origin" => "Ceviche is popular in coastal regions of Latin America, especially Peru and Ecuador."
    ],
    [
        "name" => "Enchiladas",
        "description" => "Corn tortillas rolled around filling and covered with chili sauce.",
        "instructions" => "1. Dip corn tortillas in chili sauce. 2. Fill with meat, cheese, or beans. 3. Roll and arrange in a baking dish. 4. Top with more sauce and cheese. 5. Bake until heated through.",
        "origin" => "Enchiladas have their roots in Mayan cuisine and evolved in Mexico over many centuries."
    ],
    [
        "name" => "Arroz con Pollo",
        "description" => "One-pot rice dish with chicken, vegetables, and spices.",
        "instructions" => "1. Brown chicken pieces in oil. 2. Add sofrito (garlic, onions, peppers). 3. Add rice, broth, saffron, and spices. 4. Simmer until rice is tender and liquid is absorbed.",
        "origin" => "Arroz con Pollo is a staple in many Hispanic countries, with variations found throughout Latin America and Spain."
    ],
    [
        "name" => "Chiles Rellenos",
        "description" => "Poblano peppers stuffed with cheese or meat, battered and fried.",
        "instructions" => "1. Roast and peel poblano peppers. 2. Stuff with cheese or meat filling. 3. Dip in egg batter. 4. Fry until golden. 5. Serve with tomato sauce.",
        "origin" => "Chiles Rellenos originated in Puebla, Mexico, and combine indigenous ingredients with European cooking techniques."
    ],
    [
        "name" => "Flan",
        "description" => "Caramel custard dessert with a layer of soft caramel on top.",
        "instructions" => "1. Prepare caramel by melting sugar until golden. 2. Pour into mold. 3. Mix eggs, milk, sugar, and vanilla. 4. Pour over caramel. 5. Bake in water bath until set.",
        "origin" => "Flan was brought to Latin America by Spanish colonizers but has roots in ancient Roman cuisine."
    ],
    [
        "name" => "Pupusas",
        "description" => "Thick corn tortillas stuffed with cheese, beans, or meat.",
        "instructions" => "1. Mix masa flour with water to form dough. 2. Form a ball and make an indentation. 3. Fill with cheese, beans, or pork. 4. Close and flatten. 5. Cook on griddle until golden brown.",
        "origin" => "Pupusas are the national dish of El Salvador with a history dating back to pre-Columbian times."
    ],
    [
        "name" => "Tres Leches Cake",
        "description" => "Sponge cake soaked in three kinds of milk: evaporated milk, condensed milk, and heavy cream.",
        "instructions" => "1. Bake a sponge cake. 2. Mix three milks. 3. Pour over cake and let soak. 4. Top with whipped cream and cinnamon.",
        "origin" => "Tres Leches cake is popular throughout Latin America, with origins likely from Nicaragua or Mexico in the 19th century."
    ],
    [
        "name" => "Ropa Vieja",
        "description" => "Shredded beef stewed with vegetables and tomatoes.",
        "instructions" => "1. Simmer beef until tender. 2. Shred the beef. 3. Sauté with onions, peppers, and tomatoes. 4. Season with cumin and bay leaves. 5. Serve with rice and beans.",
        "origin" => "Ropa Vieja is Cuba's national dish, with its name literally meaning 'old clothes' due to its shredded appearance."
    ],
    [
        "name" => "Churros",
        "description" => "Fried dough pastry dusted with cinnamon sugar, often served with chocolate dipping sauce.",
        "instructions" => "1. Prepare choux pastry dough. 2. Pipe through star-shaped nozzle. 3. Fry until golden brown. 4. Roll in cinnamon sugar. 5. Serve with chocolate sauce.",
        "origin" => "Churros originated in Spain but became wildly popular throughout Latin America and Spanish-speaking countries."
    ],
    [
        "name" => "Tostadas",
        "description" => "Crispy flat corn tortillas topped with beans, meat, lettuce, cheese, and salsa.",
        "instructions" => "1. Fry corn tortillas until crisp. 2. Spread with refried beans. 3. Top with meat, lettuce, cheese, and salsa. 4. Add sour cream or guacamole if desired.",
        "origin" => "Tostadas evolved in Mexico as a way to use stale tortillas, transforming them into crispy bases for toppings."
    ],
    [
        "name" => "Pozole",
        "description" => "Hominy corn soup with meat, typically garnished with shredded lettuce, radishes, and lime.",
        "instructions" => "1. Simmer pork or chicken with hominy and spices. 2. Add red or green chile sauce. 3. Garnish with lettuce, radishes, onion, and lime. 4. Serve with tortillas.",
        "origin" => "Pozole has been a traditional soup in Mexico since pre-Hispanic times, often served at celebrations."
    ],
    [
        "name" => "Picadillo",
        "description" => "Ground beef dish with olives, raisins, and potatoes in a tomato-based sauce.",
        "instructions" => "1. Brown ground beef. 2. Add onions, garlic, and tomato sauce. 3. Mix in olives, raisins, and potatoes. 4. Season with cumin and bay leaves. 5. Serve with rice.",
        "origin" => "Picadillo is popular throughout Latin America, especially in Cuba, Puerto Rico, and Mexico, reflecting Spanish culinary influence."
    ],
    [
        "name" => "Pastel de Choclo",
        "description" => "Corn pie with meat filling, olives, raisins, and hard-boiled eggs.",
        "instructions" => "1. Prepare ground beef filling with onions, olives, and raisins. 2. Blend corn kernels to make a paste. 3. Layer meat filling in a dish. 4. Cover with corn mixture. 5. Bake until golden.",
        "origin" => "Pastel de Choclo is a popular Chilean and Argentinian dish that combines European and indigenous culinary traditions."
    ],
    [
        "name" => "Chimichurri Steak",
        "description" => "Grilled steak topped with chimichurri sauce made from parsley, garlic, vinegar, and oil.",
        "instructions" => "1. Grill steak to desired doneness. 2. Blend parsley, garlic, oregano, vinegar, and oil for chimichurri. 3. Let sauce sit for flavors to blend. 4. Serve sauce over grilled steak.",
        "origin" => "Chimichurri sauce originates from Argentina and Uruguay, where it's a staple accompaniment to grilled meats."
    ],
    [
        "name" => "Sopa de Tortilla",
        "description" => "Tortilla soup with tomato broth, fried tortilla strips, avocado, cheese, and sour cream.",
        "instructions" => "1. Prepare tomato-based broth with chili peppers and garlic. 2. Cut tortillas into strips and fry until crisp. 3. Pour broth into bowls. 4. Top with tortilla strips, avocado, cheese, and sour cream.",
        "origin" => "Sopa de Tortilla is a traditional Mexican soup believed to originate from the Mexico City area."
    ]
];
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../assets/css/main.css">
        <link rel="stylesheet" href="../assets/css/alt.css">
        <title>Recipes</title>
    </head>
    <body>
        <div class="content page-content">
            <h1 class="animated-heading">Thai Recipes</h1>
            <div class="recipe-container">
                <?php foreach($thai_recipes as $recipe): ?>
                    <div class="recipe-item">
                        <div class="recipe-header">
                            <h3 class="recipe-title"><?php echo $recipe['name']; ?></h3>
                            <div class="recipe-description"><?php echo $recipe['description']; ?></div>
                        </div>
                        <div class="recipe-content">
                            <strong>Instructions:</strong>
                            <div class="recipe-instructions"><?php echo $recipe['instructions']; ?></div>
                            <div class="recipe-origin"><?php echo $recipe['origin']; ?></div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            
            <div class="section-divider">
                <span>🤌🏼</span>
            </div>
            
            <h1 class="animated-heading">Hispanic Recipes</h1>
            <div class="recipe-container">
                <?php foreach($hispanic_recipes as $recipe): ?>
                    <div class="recipe-item">
                        <div class="recipe-header">
                            <h3 class="recipe-title"><?php echo $recipe['name']; ?></h3>
                            <div class="recipe-description"><?php echo $recipe['description']; ?></div>
                        </div>
                        <div class="recipe-content">
                            <strong>Instructions:</strong>
                            <div class="recipe-instructions"><?php echo $recipe['instructions']; ?></div>
                            <div class="recipe-origin"><?php echo $recipe['origin']; ?></div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            <script src="../assets/js/altdropdown.js"></script>
        </div>
        <script src="../assets/js/alt.js"></script>
    </body>
</html>