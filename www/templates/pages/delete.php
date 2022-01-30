<div class="show">
    <?php $note = $params['note'] ?? null; ?>
    <?php if ($note) : ?>
        <ul>
            <li>Id: <?php echo (int) $note['id'] ?></li>
            <li>Tytuł: <?php echo htmlentities($note['title']) ?></li>
            <li>
                <pre><?php echo htmlentities($note['description']) ?></pre>
            </li>
            <li>Zapisano: <?php echo htmlentities($note['status']) ?></li>
        </ul>
    <form method="post" action="/?action=delete">
        <input name="id" type="hidden" value="<?php echo $note['id']?>"/>
        <input type="submit" value="Delete">
    </form>
    <?php else : ?>
        <div>Not found article</div>
    <?php endif; ?>
    <a href="/">
        <button>Return article list</button>
    </a>
</div>