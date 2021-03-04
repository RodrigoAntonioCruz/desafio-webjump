(function() {

    function createTableRowCategory(data) {
        var tableRow;

        for (var i = 0, len = data.length; i < len; i++) {
               tableRow  = ` <tr class="data-row">
                              <td class="data-grid-td">
                                <span class="data-grid-cell-content">` + data[i].nome + `</span>
                              </td>
                          
                              <td class="data-grid-td">
                                <span class="data-grid-cell-content">` + data[i].codigo + `</span>
                              </td>
                          
                              <td class="data-grid-td">
                                <div class="actions">
                                  <div class="action edit"><span>Edit</span></div>
                                  <div class="action delete"><span>Delete</span></div>
                                </div>
                              </td>
                            </tr>`;

            $('table.data-grid tbody').append(tableRow);
        }
    }

    $.ajax({
        type: 'GET',
        contentType: 'application/json',
        url: '/categories/list',
        dataType: 'json'
    })
    .done(function(data) {
        createTableRowCategory(data);
    });

    $('table tbody').on('click', '.action.edit>span', function(evt) {
        var $tr = $(this).closest('tr'),
            code = $.trim($tr.find('td:nth-child(2)').text());

        location.href = '/categories/edit/' + code;
    });

    $('table tbody').on('click', '.action.delete>span', function(evt) {
        var $tr = $(this).closest('tr'),
            name = $.trim($tr.find('td:nth-child(1)').text()),
            code = $.trim($tr.find('td:nth-child(2)').text());

        alertify
            .confirm(
                'Delete', 
                'Do you want to delete category "'+name+'" ?', 
                function(){
                    $.ajax({
                        type: 'GET',
                        contentType: 'application/json',
                        url: '/categories/delete/' + code,
                        dataType: 'json'
                    })
                    .done(function(data) {
                        $tr.remove();
                    });
                }, 
                function(){ }
            )
            .setting({
                'labels': {ok:'Yes', cancel:'No'},
                'defaultFocus': 'cancel'
            });
    });

})();