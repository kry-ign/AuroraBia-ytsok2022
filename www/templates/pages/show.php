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
  <a href="/?action=edit&id=<?php echo $note['id']?>">
      <button>Edit</button>
  </a>
  <?php else : ?>
    <div>Not found article</div>
  <?php endif; ?>
  <a href="/">
    <button>Return article list</button>
  </a>
</div>