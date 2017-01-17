<?php echo $_SESSION['access_token'];?>
<ul>
	<li><a href="listCategoryForm.php">카테고리 조회</a></li>
	<li><a href="writePostWithImageForm.php">포스트 쓰기</a></li>
</ul>



curl "https://openapi.naver.com/blog/writePost.json" -H "Authorization: Bearer AAAANSvIHTO9pdiB6HAWRqgtIvgEYNc6y8jZBpI4E8T+1+nG5J5/RCkjiugVEJWkraFDto78CJsNUJUnsMZyp1OMSZk=" -d "blogId=erm00&title=%EB%84%A4%EC%9D%B4%EB%B2%84%20%EB%B8%94%EB%A1%9C%EA%B7%B8%20api%20%ED%85%8C%EC%8A%A4%ED%8A%B8&contents=%EB%84%A4%EC%9D%B4%EB%B2%84%20%EB%B8%94%EB%A1%9C%EA%B7%B8%20api%EB%A1%9C%20%EA%B8%80%EC%9D%84%20%EB%B8%94%EB%A1%9C%EA%B7%B8%EC%97%90%20%EC%98%AC%EB%A0%A4%EB%B4%85%EB%8B%88%EB%8B%A4." -v

curl "https://openapi.naver.com/blog/listCategory.json?blogId=erm00" -H "Authorization: Bearer AAAANSvIHTO9pdiB6HAWRqgtIvgEYNc6y8jZBpI4E8T+1+nG5J5/RCkjiugVEJWkraFDto78CJsNUJUnsMZyp1OMSZk=" -v