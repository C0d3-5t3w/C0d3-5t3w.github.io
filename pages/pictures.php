<?php
header("Cache-Control: no-cache, must-revalidate");
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");

$images = [
    [
        'src' => '../assets/images/z1.png',
        'alt' => 'Ziggy!',
        'description' => 'Ziggy looking amazing as always.',
        'size' => 'small'
    ],
    [
        'src' => '../assets/images/z3.jpg',
        'alt' => 'Ziggy!',
        'description' => 'Ziggy in a relaxed mood.',
        'size' => 'medium'
    ],
    [
        'src' => '../assets/images/z2.png',
        'alt' => 'Ziggy!',
        'description' => 'Another wonderful Ziggy moment.',
        'size' => 'small'
    ],
    [
        'src' => '../assets/images/p1.jpeg',
        'alt' => 'Patience!',
        'description' => 'Patience being patient as usual.',
        'size' => 'small'
    ],
    [
        'src' => '../assets/images/v1.jpg',
        'alt' => 'View!',
        'description' => 'A beautiful scenic view.',
        'size' => 'medium'
    ],
    [
        'src' => '../assets/images/p2.jpeg',
        'alt' => 'Patience!',
        'description' => 'Another adorable picture of Patience.',
        'size' => 'small'
    ],
    [
        'src' => '../assets/images/l1.jpg',
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
    <link rel="stylesheet" href="../assets/css/main.css">
    <title>My Pictures</title>
    <style>
        body {
            background-color: var(--background-color);
            color: var(--primary-color);
            position: relative;
            overflow: auto;
        }
        .spotlight {
            position: relative;
            margin: 20px auto;
            max-width: 600px;
            overflow: hidden;
            border-radius: 15px;
            box-shadow: 0 0 25px rgba(255, 255, 255, 0.3);
            transition: all 0.5s ease;
            border: 1px solid var(--primary-color);
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
            background: var(--dark-bg);
            color: var(--primary-color);
            padding: 15px;
            transform: translateY(100%);
            transition: transform 0.3s ease;
        }
        .spotlight:hover .spotlight-info {
            transform: translateY(0);
        }
        .spotlight:hover {
            box-shadow: 0 0 35px var(--accent-purple);
            transform: scale(1.02);
        }
        .spotlight-title {
            color: var(--accent-teal);
            margin-bottom: 10px;
            font-weight: bold;
        }
        .gallery {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 10px;
        }
        .picture-container {
            position: relative;
            border-radius: 15px;
            overflow: hidden;
            transition: transform 0.6s;
            border: 1px solid var(--primary-color);
            background: var(--dark-bg);
        }
        .picture-container img {
            width: 100%;
            display: block;
        }
        .picture-container.small {
            width: 100px;
        }
        .picture-container.medium {
            width: 200px;
        }
        .picture-container.large {
            width: 300px;
        }
        .picture-container:after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            box-shadow: 0 0 15px var(--accent-purple);
            pointer-events: none;
        }
        .picture-container.spin {
            animation: spin 1s linear;
        }
        @keyframes spin {
            from {
                transform: rotate(0deg);
            }
            to {
                transform: rotate(360deg);
            }
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
            </div>
        </div>
        
        <div class="gallery">
            <?php foreach ($images as $image) {
                if ($image['src'] !== $spotlight['src']) { ?>
                    <div class="picture-container <?php echo $image['size']; ?>">
                        <img src="<?php echo $image['src']; ?>" alt="<?php echo $image['alt']; ?>">
                    </div>
                <?php } 
            } ?>
        </div>
        <h2>
            <a href="../index.html" style="color: white;">Home</a>
        </h2>
    </div>
    <script>
        document.querySelectorAll('.picture-container').forEach(container => {
            container.addEventListener('click', () => {
                container.classList.add('spin');
                setTimeout(() => {
                    container.classList.remove('spin');
                }, 1000);
            });
        });
    </script>
    <script src="assets/js/alt.js"></script>
</body>
</html>