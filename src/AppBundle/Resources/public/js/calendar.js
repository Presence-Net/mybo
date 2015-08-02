/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


$(function(){
    $('.calendar-nav select').on('click', function(e){
        $form = $(this).closest('form');
        url = Routing.generate('budget_calendar', {
            year: $form.find('select[name=year]').val(),
            month: $form.find('select[name=month]').val()
        });
        document.location.href = url;
    })
});