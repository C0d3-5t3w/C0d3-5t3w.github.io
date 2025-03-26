<?php
header("Cache-Control: no-cache, must-revalidate");
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");

$images = [
    [
        'src' => 'assets/images/z1.png',
        'alt' => 'Ziggy!',
        'description' => 'Ziggy looking amazing as always.',
        'size' => 'small'
    ],
    [
        'src' => 'assets/images/z3.jpg',
        'alt' => 'Ziggy!',
        'description' => 'Ziggy in a relaxed mood.',
        'size' => 'medium'
    ],
    [
        'src' => 'assets/images/z2.png',
        'alt' => 'Ziggy!',
        'description' => 'Another wonderful Ziggy moment.',
        'size' => 'small'
    ],
    [
        'src' => 'assets/images/p1.jpeg',
        'alt' => 'Patience!',
        'description' => 'Patience being patient as usual.',
        'size' => 'small'
    ],
    [
        'src' => 'assets/images/v1.jpg',
        'alt' => 'View!',
        'description' => 'A beautiful scenic view.',
        'size' => 'medium'
    ],
    [
        'src' => 'assets/images/p2.jpeg',
        'alt' => 'Patience!',
        'description' => 'Another adorable picture of Patience.',
        'size' => 'small'
    ],
    [
        'src' => 'assets/images/l1.jpg',
        'alt' => 'Logo!',
        'description' => 'The awesome logo.',
        'size' => 'large'
    ]
];

$spotlight = $images[array_rand($images)];
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/main.css">
    <title>My Pictures</title>
    <style>
        .spotlight {
            position: relative;
            margin: 20px auto;
            max-width: 600px;
            overflow: hidden;
            border-radius: 15px;
            box-shadow: 0 0 25px rgba(255, 255, 255, 0.3);
            transition: all 0.5s ease;
        }
        .spotlight img {
            width: 100%;
            display: block;
        }
        .spotlight-info {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            background: rgba(0, 0, 0, 0.7);
            color: white;
            padding: 15px;
            transform: translateY(100%);
            transition: transform 0.3s ease;
        }
        .spotlight:hover .spotlight-info {
            transform: translateY(0);
        }
        .spotlight:hover {
            box-shadow: 0 0 35px rgba(251, 42, 255, 0.6);
            transform: scale(1.02);
        }
        .spotlight-title {
            color: #fb2aff;
            margin-bottom: 10px;
            font-weight: bold;
        }
        .refresh-button {
            background: rgba(251, 42, 255, 0.4);
            border: 1px solid white;
            color: white;
            padding: 8px 15px;
            border-radius: 5px;
            cursor: pointer;
            display: block;
            margin: 10px auto;
            transition: all 0.3s;
        }
        .refresh-button:hover {
            background: rgba(251, 42, 255, 0.7);
        }
    </style>
</head>
<body>
    <div class="content">
        <h1>My Pictures</h1>
        
        <div class="spotlight">
            <img src="<?php echo $spotlight['src']; ?>" alt="<?php echo $spotlight['alt']; ?>">
            <div class="spotlight-info">
                <div class="spotlight-title">✨ Spotlight Image ✨</div>
                <p><?php echo $spotlight['description']; ?></p>
                <form method="get">
                    <button type="submit" class="refresh-button">New Random Spotlight</button>
                </form>
            </div>
        </div>
        
        <div class="gallery">
            <div class="picture-container small">
                <img src="assets/images/z1.png" alt="Ziggy!">
                <!-- <canvas class="glow"></canvas> -->
            </div>
            <div class="picture-container medium">
                <img src="assets/images/z3.jpg" alt="Ziggy!">
                <!-- <canvas class="glow"></canvas> -->
            </div>
            <div class="picture-container small">
                <img src="assets/images/z2.png" alt="Ziggy!">
                <!-- <canvas class="glow"></canvas> -->
            </div>
            <div class="picture-container small">
                <img src="assets/images/p1.jpeg" alt="Patience!">
                <!-- <canvas class="glow"></canvas> -->
            </div>
            <div class="picture-container medium">
                <img src="assets/images/v1.jpg" alt="View!">
                <!-- <canvas class="glow"></canvas> -->
            </div>              
            <div class="picture-container small">
                <img src="assets/images/p2.jpeg" alt="Patience!">
                <!-- <canvas class="glow"></canvas> -->
            </div>
            <div class="picture-container large">
                <img src="assets/images/l1.jpg" alt="Logo!">
                <!-- <canvas class="glow"></canvas> -->
            </div>            
        </div>
        <h2>
            <a href="index.html" style="color: white;">Home</a>
        </h2>
    </div>
    <script src="assets/js/main.js"></script>
</body>
</html>