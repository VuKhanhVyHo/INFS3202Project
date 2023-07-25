<div>
    <h3>Your Wish List</h3>
    -------------------------------------------------------------
    <br>
    <ul>
        <?php foreach ($results as $item) : ?>
            <li>
            <?= $item->courseCode ?> - <?= $item -> Price ?>
            <form action="<?= base_url().'/remove' ?>" style="display: inline-block;">
                <input type="hidden" name="courseCode" value="<?= $item->courseCode ?>">
                <button type="submit">Remove from wishlist</button>
            </form>
            </li>
        <?php endforeach ?>
    </ul>
</div>