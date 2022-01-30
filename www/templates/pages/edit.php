<div>
    <h3> Edit Article </h3>
    <div>
        <?php $note = $params['note']; ?>
        <form class="note-form" action="/?action=edit" method="post"><input name="id" type="hidden"
                                                                            value="<?php echo $note['id'] ?>">
            <ul>
                <li>
                    <label>Title <span class="required">*</span></label>
                    <input type="text" name="title" class="field-long" value="<?php echo $note['title'] ?>"/>
                </li>
                <li>
                    <label>Description</label>
                    <textarea name="description" id="field5"
                              class="field-long field-textarea"><?php echo $note['description'] ?></textarea>
                </li>
                <li>
                    <input type="submit" value="Edit"/>
                </li>
            </ul>
        </form>
    </div>
</div>