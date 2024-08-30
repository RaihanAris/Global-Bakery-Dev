<style>
    ul.custom-pagination {
        display: flex;
        justify-content: center;
        list-style: none;
        padding-left: 0;
        margin-top: 20px;
        border-radius: 0.25rem;
        width: fit-content;
    }

    ul.custom-pagination li {
        /* margin: 0 0.25rem; */
    }

    ul.custom-pagination li a {
        display: block;
        padding: 0.25rem 0.5rem;
        color: #007bff;
        background-color: #fff;
        text-decoration: none;
        border: 1px solid #dee2e6;
    }

    ul.custom-pagination li a:hover {
        background-color: #e9ecef;
        color: #0056b3;
    }

    ul.custom-pagination li.active a {
        background-color: #007bff;
        border-color: #007bff;
        color: #fff;
    }
</style>

<ul class="custom-pagination">
    <li><a href="<?= $pager->getFirst() ?>">First</a></li>
    <li><a href="<?= $pager->getPreviousPage() ?>">&laquo;</a></li>

    <?php foreach ($pager->links() as $link): ?>
        <li class="<?= $link['active'] ? 'active' : '' ?>">
            <a href="<?= $link['uri'] ?>">
                <?= $link['title'] ?>
            </a>
        </li>
    <?php endforeach ?>

    <li><a href="<?= $pager->getNextPage() ?>">&raquo;</a></li>
    <li><a href="<?= $pager->getLast() ?>">Last</a></li>
</ul>