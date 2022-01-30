<div class="list">
    <section>
        <div class="message">
            <?php
            if (!empty($params['error'])) {
                switch ($params['error']) {
                    case 'missingArtilceId':
                        echo 'Id article not found';
                        break;
                    case 'artilceNotFound':
                        echo 'Artilce not found';
                        break;
                }
            }
            ?>
        </div>
        <div class="message">
            <?php
            if (!empty($params['before'])) {
                switch ($params['before']) {
                    case 'created':
                        echo 'Article created';
                        break;
                    case  'deleted':
                        echo 'Article delete';
                        break;
                    case 'edited':
                        echo 'Article edited';
                        break;
                }
            }
            ?>
        </div>

        <div class="tbl-header">
            <table cellpadding="0" cellspacing="0" border="0">
                <thead>
                <tr>
                    <th>Id</th>
                    <th>Title</th>
                    <th>Data</th>
                    <th>Options</th>
                </tr>
                </thead>
            </table>
        </div>
        <div class="tbl-content">
            <table cellpadding="0" cellspacing="0" border="0">
                <tbody>
                <?php foreach ($params['notes'] ?? [] as $note) : ?>
                    <tr>
                        <td><?php echo (int)$note['id'] ?></td>
                        <td><?php echo htmlentities($note['title']) ?></td>
                        <td><?php echo htmlentities($note['status']) ?></td>
                        <td>
                            <a href="/?action=show&id=<?php echo (int)$note['id'] ?>">
                                <button>Details</button>
                                <a href="/?action=delete&id=<?php echo (int)$note['id'] ?>">
                                    <button>Delete</button>
                                </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </section>
</div>