function showLastName() {
    var selectBox = document.getElementById("example-select");
    var selectedValue = selectBox.options[selectBox.selectedIndex].getAttribute('data-lastname');
    document.getElementById("last-name").value = selectedValue;
}

