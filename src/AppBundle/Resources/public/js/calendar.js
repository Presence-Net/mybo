/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


$(function () {
    $('.calendar-nav select').on('click', function (e) {
        $form = $(this).closest('form');
        url = $form.attr('action') +
                '/' + $form.find('select[name=year]').val() +
                '/' + $form.find('select[name=month]').val()
        document.location.href = url;
    })
});