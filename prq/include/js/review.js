function deleteReview( reviewNo ) {
	if ( confirm("매장후기를 삭제하시겠습니까?") ){
		var parameters = {};
		parameters['review_no'] = reviewNo;
			
		$.ajax({
			url : '/review/delete_ok.php',
			type : 'POST',
			async : false,
			data : parameters,
			beforeSend: function(jqXHR) {
				//
			},
			success : function(data, textStatus, jqXHR) {
				var obj = JSON.parse(data);
			
				if ( obj.res.state == "success" ) {
					window.location.replace("/?s="+storeNo+"&t=rd");
				}
				else {
					alert( "오류가 발생하였습니다." );
				}
			},
			error : function(jqXHR, textStatus, errorThrown) {
			},
			complete : function() {
		
			}
		});
	}
}

function recommendReview( reviewNo ) {
	var parameters = {};
	parameters['review_no'] = reviewNo;
		
	$.ajax({
		url : '/review/recommend_ok.php',
		type : 'POST',
		async : false,
		data : parameters,
		beforeSend: function(jqXHR) {
			//
		},
		success : function(data, textStatus, jqXHR) {
			var obj = JSON.parse(data);
			
			if ( obj.res.state == "success" ) {
				$('#review_' + obj.res.review_no).find( $(' .recommend_count') ).text( obj.res.recommend_num );
				if ( obj.res.state_detail == 'recommend' ) {
					showToast( 'Note', '추천했습니다.' );
				}
				else {
					showToast( 'Note', '취소했습니다.' );
				}
			}
			else {
				alert( "오류가 발생하였습니다." );
			}
		},
		error : function(jqXHR, textStatus, errorThrown) {
		},
		complete : function() {
	
		}
	});
}

function deleteComment( commentNo ) {
	if ( confirm("댓글을 삭제하시겠습니까?") ){
		var parameters = {};
		parameters['comment_no'] = commentNo;
			
		$.ajax({
			url : '/review/comment/delete_ok.php',
			type : 'POST',
			async : false,
			data : parameters,
			beforeSend: function(jqXHR) {
				//
			},
			success : function(data, textStatus, jqXHR) {
				var obj = JSON.parse(data);
				
				if ( obj.res.state == "success" ) {
					window.location.replace("/?s="+storeNo+"&t=cd");
				}
				else {
					alert( "오류가 발생하였습니다." );
				}
			},
			error : function(jqXHR, textStatus, errorThrown) {
			},
			complete : function() {
		
			}
		});
	}
}