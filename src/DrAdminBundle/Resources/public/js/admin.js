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

    $('.publish').click(function () {
        // récupération de l'id de l'article
        article_id = $(this).attr('id').substr(8);
        $.ajax({
            url: "publish",
            method: "POST",
            data: {id: article_id},
            success: function (res) {
                var span = $('#status_'+article_id);
                if (span.html() == 'publié'){
                    span.html('non publié');
                } else if (span.html() == 'non publié'){
                    span.html('publié');
                }
                console.log(span.html(), res);
            }
        })
    })

});

//url: "http://localhost:8000/admin/article/2/publish",