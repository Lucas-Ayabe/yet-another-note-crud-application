function createNoteForm() {
    return `
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
    `;
}

function app({ wrapper, addButton }) {
    addButton.addEventListener(
        "click",
        () => (wrapper.innerHTML += createNoteForm())
    );
}

app({
    wrapper: document.querySelector("#fields"),
    addButton: document.querySelector("#add-note"),
});
