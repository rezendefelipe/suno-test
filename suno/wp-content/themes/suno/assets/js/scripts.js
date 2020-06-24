$(document).ready(function () {
    $('.category-filter').click(function (ev) {
        var color = $(this).data('color');
        $('.category-filter').each(function () {
            var eachColor = $(this).data('color');
            $(this).css("background-color", '#fff');
            $(this).css("color", eachColor);
        })
        $(this).css("background-color", color);
        $(this).css("color", "#fff");
        data = {
            'cat': $(this).attr('id'),
        }
        $.post({
            url: "http://localhost/suno/ajax_parceiros/",
            data: data,
            success: function (data) {
                if (color === "#000") {
                    if ($('#load_more_id').is(":hidden")){
                        $(".loadmore").data("page", 2);
                        $(".loadmore").show();
                    }
                } else {
                    $(".loadmore").hide();
                }
                $(".carregar_mais").html(data).fadeIn('slow');
            }
        });
    })
})