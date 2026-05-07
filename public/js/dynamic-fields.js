(function() {
    var select = document.querySelector('select[name="type_val"]');
    if (!select) return;

    var allNamed = document.querySelectorAll('[name]');
    var fields = Array.from(allNamed).filter(function(el) {
        return el !== select;
    });

    function extractNumber(name) {
        var parts = name.split('_');
        var lastPart = parts[parts.length - 1];
        var num = parseInt(lastPart, 10);
        return isNaN(num) ? null : num;
    }

    function update() {
        var selectedValue = parseInt(select.value, 10);
        fields.forEach(function(field) {
            var fieldName = field.getAttribute('name') || '';
            var fieldNumber = extractNumber(fieldName);
            var shouldShow = (fieldNumber !== null && fieldNumber === selectedValue);
            if (shouldShow) {
                field.style.display = '';
                field.disabled = false;
            } else {
                field.style.display = 'none';
                field.disabled = true;
            }
        });
    }

    select.addEventListener('change', update);
    update();
})();
