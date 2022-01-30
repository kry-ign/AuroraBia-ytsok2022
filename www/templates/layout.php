<html lang="pl">

<head>
    <title>Zadanie rekrutacyjne</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css">
    <link href="/public/style.css" rel="stylesheet">
</head>

<body class="body">
<div class="wrapper">
    <div class="header">
        <h1><i class=""></i>AURORA BIAŁYSTOK</h1>
    </div>

    <div class="container">
        <div class="menu">
            <ul>
                <li><a href="/">Home</a></li>
                <li><a href="/?action=create">New Article</a></li>
                <li><a href="/">Register</a></li>
            </ul>
        </div>

        <div class="page">
            <?php require_once("templates/pages/$page.php"); ?>
        </div>
    </div>

    <div class="footer">
        <p>Wykorzystano kurs PHP 7.4 Udemy</p>
    </div>
</div>
</body>

</html>