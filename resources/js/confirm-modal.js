document.addEventListener("click", (event) => {
    const button = event.target.closest("[data-confirm]");

    if (!button) {
        return;
    }

    const form = button.closest("form");

    if (!form) {
        return;
    }

    event.preventDefault();

    window.dispatchEvent(
        new CustomEvent("confirm-action", {
            detail: {
                form,
                title: button.dataset.confirmTitle,
                message: button.dataset.confirmMessage,
                confirmText: button.dataset.confirmText,
            },
        }),
    );
});
