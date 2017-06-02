$(function(){

    $(document).foundation();

    window.prettyPrint && prettyPrint();
    $("input[type='datetime']").fdatepicker({
        format: 'dd-mm-yyyy hh:ii',
        disableDblClickSelection: true,
        leftArrow: '<<',
        rightArrow: '>>',
        closeIcon: 'X',
        closeButton: true,
        language: 'vi'
    });

});

