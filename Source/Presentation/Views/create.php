<?php $this->layout('template') ?>

<?php $this->start('body') ?>
<main class="container py:5">
    <form method="POST" class="card flow">
        <header class="line justify:between align:center">
            <h1 class="title">Register notes</h1>
            <button type="button" id="add-note" class="button">+</button>
        </header>

        <div class="flow" id="fields">
            <section class="[ card -outline ] flow">
                <div class="field">
                    <label for="title">Title</label>
                    <input type="text" name="title[]" id="title" class="input" />
                </div>

                <div class="field">
                    <label for="body">Body</label>
                    <textarea name="body[]" id="body" class="input"></textarea>
                </div>
            </section>
        </div>

        <button class="button">Create</button>
    </form>
</main>
<?php $this->stop() ?>