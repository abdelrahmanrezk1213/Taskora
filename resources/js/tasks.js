document.addEventListener("DOMContentLoaded", () => {
    const filtersForm = document.getElementById("task-filters-form");

    if (!filtersForm) {
        return;
    }

    const searchInput = document.getElementById("search");
    const resultsContainer = document.getElementById("tasks-results");
    const resetButton = document.getElementById("reset-filters");

    const categorySelect = document.getElementById("category");
    const statusSelect = document.getElementById("status");
    const prioritySelect = document.getElementById("priority");
    const dueDateSelect = document.getElementById("due_date_filter");
    const sortSelect = document.getElementById("sort");

    const SEARCH_DELAY = 300;

    let searchTimeout;

    initSearch();
    initFilters();
    initSubmit();
    initReset();
    initPagination();

    function initSearch() {
        searchInput.addEventListener("input", () => {
            clearTimeout(searchTimeout);

            searchTimeout = setTimeout(() => {
                submitFilters();
            }, SEARCH_DELAY);
        });
    }

    function initFilters() {
        const filters = [
            categorySelect,
            statusSelect,
            prioritySelect,
            dueDateSelect,
            sortSelect,
        ];

        filters.forEach((filter) => {
            filter.addEventListener("change", () => {
                submitFilters();
            });
        });
    }

    function initSubmit() {
        filtersForm.addEventListener("submit", (e) => {
            e.preventDefault();
            submitFilters();
        });
    }

    function initReset() {
        resetButton.addEventListener("click", (e) => {
            e.preventDefault();

            searchInput.value = "";
            categorySelect.value = "";
            statusSelect.value = "";
            prioritySelect.value = "";
            sortSelect.value = "";
            dueDateSelect.value = "";

            loadTasks(resetButton.href);
        });
    }

    function initPagination() {
        resultsContainer.addEventListener("click", (e) => {
            const link = e.target.closest("a");

            if (!link || !link.href.includes("page=")) {
                return;
            }

            e.preventDefault();

            loadTasks(link.href);
        });
    }

    function submitFilters() {
        const formData = new FormData(filtersForm);

        const url = new URL(filtersForm.action);

        url.search = "";

        for (const [key, value] of formData.entries()) {
            if (value !== "") {
                url.searchParams.set(key, value);
            }
        }

        loadTasks(url.toString());
    }

    function loadTasks(url) {
        document.getElementById("loading-spinner").classList.remove("hidden");

        fetch(url, {
            headers: {
                "X-Requested-With": "XMLHttpRequest",
                Accept: "text/html",
            },
        })
            .then((response) => {
                if (!response.ok) {
                    throw new Error("Request Failed");
                }

                return response.text();
            })
            .then((html) => {
                resultsContainer.innerHTML = html;

                document
                    .getElementById("loading-spinner")
                    .classList.add("hidden");

                window.history.replaceState({}, "", url);
            })
            .catch((error) => {
                document
                    .getElementById("loading-spinner")
                    .classList.add("hidden");

                console.error(error);
            });
    }
});
