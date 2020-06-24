jQuery(function($){ // use jQuery code inside this to avoid "$ is not defined" error
	$('.loadmore').click(function(ev){

		var page = $(".loadmore").data("page");

		var new_page = parseInt(page) + 1;

		var data = {
			'action': 'loadmore',
			'page' : page
		};

		$(".loadmore").data("page", new_page);

		$.post({
			url: "http://localhost/suno/ajax_parceiros/",
			data : data,
			success : function( data ){
				if (!data.trim()) {
					$(".loadmore").hide();
					return;
				}
				$(".carregar_mais").append(data).fadeIn('slow');
			}
		});
	});
});