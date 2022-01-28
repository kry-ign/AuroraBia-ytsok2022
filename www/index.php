<?php

declare(strict_types=1);

namespace App;

require_once("src/Utils/debug.php");

if (!empty($_GET['action'])) {
    $action = $_GET['action'];
} else {
    $action = null;
}

?>

<html>
<head>

</head>
<body>
<div class="header">
    <h1>News/Article</h1>
</div>
<div class="container">
    <div class="menu">
        <ul>
            <li><a href="/?action=">News List</a></li>
            <li><a href="/?action=create">New Article</a></li>
        </ul>
    </div>
    <div>
        <?php if ($action === 'create'): ?>
            Utrzwuz nowa notatke
        <?php else: ?>
            lista notatek
        <?php endif; ?>
    </div>
</div>
<div class="footer">

</div>
</body>
</html>
