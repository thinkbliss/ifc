jQuery(document).ready(function($) {
	var brightcoveAPIkey = WPvars.IFC_FILMS_BC_READ_TOKEN;

	var apiLocation = 'http://api.brightcove.com/services/library';

	function enableDisableSearchButton(){

		var bcTitle = $('#bc-title').val();

		if ( bcTitle.length <= 0 ) {
			$('#bc-search').attr('disabled', true);
		} else{
			$('#bc-search').attr('disabled', false);
		}

	}

	$('#bc-title').on('input', function() {

		enableDisableSearchButton();

	});

	$('#bc-title').keypress(function (e) {

			if (e.keyCode == '13') {
				e.preventDefault();
				enableDisableSearchButton();
				if ( $('#bc-title').val().length > 0 ) {
					searchVideos(e);
				}
			}

	  });

	$('#bc-search').click(function(e){
		e.preventDefault();
		searchVideos(e);
	});

	$('#bc-reset').click(function(e){
		e.preventDefault();
		$('#bc-results').hide().html('');
		$('#bc-reset, #bc-error').hide();
		$('html, body').animate({
			scrollTop: $('#bc-title').offset().top - 50
		}, 250, function(){
			$('#bc-title').removeClass('bg-flash-green').addClass('bg-flash-green').val('').focus();
			$('#bc-search').attr('disabled', true);
		});
	});

	function bindVideoButtons(){

		$('#bc-results .trailer-button button').click(function(e){
			e.preventDefault();

			acf.fields.tab.toggle( $('a.acf-tab-button[data-key="field_553809e1b73f7"]') );

			var bcID = $(this).attr('data-bcid');

			var ACFtrailerDiv = $('.acf-field[data-name="bc_trailer_id"]');

			var ACFtab = $('.acf-field[data-name="bc_trailer_id"]');

			var ACFmediaInput = $('.acf-input-wrap input', ACFtrailerDiv);

			$('html, body').animate({
				scrollTop: ACFmediaInput.offset().top - 50
			}, 250, function(){
				ACFmediaInput.removeClass('bg-flash-green').val(bcID).focus().addClass('bg-flash-green');
			});

		});

		$('#bc-results .gallery-button button').click(function(e){
			e.preventDefault();

			var bcID = $(this).attr('data-bcid');

			var ACFgalleryDiv = $('.acf-field[data-name="video_gallery"]');

			var acfField = $( '.acf-field[data-name="video_gallery"] .acf-fr .acf-repeater-add-row' ).click();

			var ACFmediaInput = $( '.acf-field[data-name="video_gallery"] .acf-row' ).not('.acf-clone').last().find( '.acf-input-wrap input' );

			$('html, body').animate({
				scrollTop: ACFmediaInput.offset().top - 50
			}, 250, function(){
				ACFmediaInput.removeClass('bg-flash-green').val(bcID).focus().addClass('bg-flash-green');
			});

		});

	}

	var searchVideos = function(e){

		e.preventDefault();

		var searchVal = $("#bc-title").val();

		var resp = $('#bc-results');

		resp.html('');

		if(searchVal != ""){

			var BCrequest = apiLocation + "?command=search_videos&all=" + searchVal + "&token=" + brightcoveAPIkey + "&callback=?";

			$.getJSON(BCrequest, false, function(jsonData) {

				if( jsonData && !jsonData['error']){

					$('#bc-error').hide();
					$('#bc-reset').fadeIn();
					$('#bc-title').removeClass('bg-flash-green');

					var l = jsonData['items'].length;
					var content = '';

					if(l>=1){
					for( i = 0 ; i < l ; i++ ) {
						var bcVideo = jsonData['items'][i];
						var videoDateObj = new Date( parseInt(bcVideo.creationDate) );
						var videoDate = (videoDateObj.getMonth()+1) + '/' + (videoDateObj.getDate()) + '/' + videoDateObj.getFullYear();
						content += '<div class="bc-video">';
						content += '<div class="thumb detail"><img src="' + bcVideo.thumbnailURL + '" class="bc-image" rel="' + bcVideo.id + '"/></div>';
						content += '<div class="title detail"><span class="label">Title: </span>' + bcVideo.name + '</div>';
						content += '<div class="date detail"><span class="label">Date: </span>' + videoDate + '</div>';
						content += '<div class="divider"></div>';
						content += '<div class="trailer-button detail">';
							content += '<button class="button" data-bcID="' + bcVideo.id + '">Set as Trailer</button>';
						content += '</div>';
						content += '<div class="gallery-button detail">';
							content += '<button class="button" data-bcID="' + bcVideo.id + '">Add to Gallery</button>';
						content += '</div>';
						content += '<div class="id detail"><span class="label">Brightcove ID: </span>' + bcVideo.id + '</div>';
						content += '</div>';
					}
					resp.append(content).slideDown();

					bindVideoButtons();

					} else {
						$('#bc-results').hide().html('');
						$('#bc-error').slideDown().text('Your search returned no results. Please try again.');
					}

				} else {

					$('#bc-results').hide().html('');

					if(jsonData['error']){
						$('#bc-error').slideDown().text(jsonData['error']);
					}
					else{
						$('#bc-error').slideDown().text('Your search returned no results. Please try again.');
					}

				}

			});

		} else {

			$('#bc-results').hide().html('');
			$('#bc-error').slideDown().text('A video title is required.');

		}

	}

});