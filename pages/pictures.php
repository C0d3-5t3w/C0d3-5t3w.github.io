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
    <link rel="stylesheet" href="../assets/css/alt.css">
    <title>My Pictures</title>
</head>
<body>
    <div class="content page-content">
        <h1 class="animated-heading">My Pictures</h1>
        
        <div class="gallery-container">
            <div class="spotlight-container spotlight-effect">
                <img src="<?php echo $spotlight['src']; ?>" alt="<?php echo $spotlight['alt']; ?>">
                <div class="image-info">
                    <div class="spotlight-title">✨ Spotlight Image ✨</div>
                    <p><?php echo $spotlight['description']; ?></p>
                </div>
            </div>
            
            <div class="masonry-gallery">
                <?php foreach ($images as $image) {
                    if ($image['src'] !== $spotlight['src']) { ?>
                        <div class="gallery-item spotlight-effect">
                            <img src="<?php echo $image['src']; ?>" alt="<?php echo $image['alt']; ?>">
                            <div class="caption"><?php echo $image['description']; ?></div>
                        </div>
                    <?php } 
                } ?>
            </div>
        </div>
        <script src="../assets/js/altdropdown.js"></script>
    </div>
    <script>
        document.querySelectorAll('.gallery-item').forEach(container => {
            container.addEventListener('click', () => {
                container.classList.add('spin');
                setTimeout(() => {
                    container.classList.remove('spin');
                }, 1000);
            });
        });
    </script>
    <script src="../assets/js/alt.js"></script>
</body>
</html>