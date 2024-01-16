function resetFilters() {
    var form = document.getElementById("filterForm");
    var elements = form.elements;

    for (var i = 0; i < elements.length; i++) {
        if (elements[i].type !== "hidden" && elements[i].type !== "button") {
            elements[i].value = null;
            elements[i].checked = false;
        }
    }
}
