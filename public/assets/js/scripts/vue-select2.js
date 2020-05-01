Vue.directive('select2', {
    inserted(el) {
        $(el).on('select2:select', () => {
            const event = new Event('change', { bubbles: true, cancelable: true });
            el.dispatchEvent(event);
        });

        $(el).on('select2:unselect', () => {
            const event = new Event('change', {bubbles: true, cancelable: true})
            el.dispatchEvent(event)
        })
    },
    bind: function (el, ee, ll) {
        $(document).ready(() => {
            setTimeout(() => {
                let val = ll.data.directives.find(el => el.name === 'model').value;
                $(el).val( val ).trigger('change');
            }, 500);
        });
    },
});