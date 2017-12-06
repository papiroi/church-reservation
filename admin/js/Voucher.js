/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
    $("#voucher-date").datepicker({ maxDate: 90, changeYear: true, changeMonth: true });
    
    //add row
    $('#voucher-add-account').click(function(){
        var accountId = $('#account-add').val();
        var accountName = $('#account-add').children('option:selected').text();
        
        var tr = $('<tr/>').appendTo($('#voucher-account-table'));
        
        $('<td/>', {colspan: '2'})
                .append($('<input/>',{type: 'hidden'}).val(accountId))
                .append(accountName)
                .appendTo(tr);
        
        $('<td/>')
                .append($('<input/>',{}))
                .appendTo(tr);
        
        $('<td/>')
               .append($('<input/>',{}))
               .appendTo(tr);
    });

