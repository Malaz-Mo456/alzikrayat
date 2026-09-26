<?php
$pageTitle = $pageTitle ?? 'Alzikrayat';
$pageCss = $pageCss ?? null;
$pageJs = $pageJs ?? null;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= htmlspecialchars($pageTitle) ?> — Alzikrayat</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="/alzikrayat/public/css/style.css">
    

    <?php if ($pageCss): ?>
        <link rel="stylesheet" href="/alzikrayat/public/css/<?= htmlspecialchars($pageCss) ?>">
    <?php endif; ?>
    <?php if ($pageJs): ?>
    <script src="/alzikrayat/public/js/<?= htmlspecialchars($pageJs) ?>" defer></script>
<?php endif; ?>
</head>

<body>

<nav class="nav-bar">
    <div class="nav-inner">
        
        <a class="brand" href="/alzikrayat/public/">
            <div class="brand-mark"></div>
            <span class="brand-text">Alzi<span>krayat</span></span>
        </a>
        
        <ul class="nav-menu">
            <li><a class="link" href="/alzikrayat/public/">Home</a></li>
            <li><a class="link" href="/alzikrayat/public/photos">Photos</a></li>
            <li><a class="link" href="/alzikrayat/public/about">About</a></li>
            
            <?php if (isset($_SESSION['user_id'])): ?>
                <li><a class="link" href="/alzikrayat/public/photo/create">Upload</a></li>

                <li>
                    <span class="nav-user">
                        Hi <?= htmlspecialchars($_SESSION['first_name']) ?>
                    </span>
                </li>

                <li>
                    <a class="btn-logout" href="/alzikrayat/public/logout">
                        Logout
                    </a>
                </li>
            <?php else: ?>
                <li>
                    <a class="link" href="/alzikrayat/public/login">
                        Please Login
                    </a>
                </li>

                <li>
                    <a class="btn-register" href="/alzikrayat/public/register">
                        Register
                    </a>
                </li>
            <?php endif; ?>
        </ul>
        
    </div>
</nav>

<main>