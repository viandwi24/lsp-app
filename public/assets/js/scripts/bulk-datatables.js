let bulkSelectedItem = []

$(document).ready(() => {
    $('#bulk_check_selectall').on('change', () => {
        let el = $('#bulk_check_selectall')
        let state = el.prop('checked')
        $('input[name=bulk_check]').prop('checked', state)
    })

    setInterval(() => {
        bulkSelectedItem = []
        let els = $('input[name=bulk_check]')
        els.each((index) => {
            let el = $('input[name=bulk_check]:eq('+index+')')
            if (el.prop('checked')) bulkSelectedItem.push(el.val())
        })
        $('.bulk_check_count').html(bulkSelectedItem.length)
        if (bulkSelectedItem.length == 0) {
            $('.disable-on-bulk-check-null').prop('disabled', true)
        } else { $('.disable-on-bulk-check-null').prop('disabled', false) }

        // change select all state
        let els_checked = $('input[name=bulk_check]:checked')
        if (els.length != els_checked.length) {
            $('#bulk_check_selectall').prop('checked', false)
        } else if (els.length == els_checked.length) { $('#bulk_check_selectall').prop('checked', true) }
    }, 200)
})
