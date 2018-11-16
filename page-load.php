<?php 
function getMoreNews(){
	$data = getNews($_POST['q'] , $_POST['page']);
	$html = '<div>';
	foreach($data as $key=>$row){
					$html .= '<article class="col-lg-3 col-md-4 col-sm-6 col-xs-12">';
					$html .= '<a href="'.$row['url'].'" target="_blank">';
					$html .= '	<div class="media-content">';
					$html .= '		<img src="'.$row['image']['url'].'" class="img-responsive" />';
					$html .= '	</div>';
					$html .= '	<div class="media-title">';
					$html .= '		<div class="title">'.$row['title'].'</div>';
					$html .= '		<div class="date">'.DateThai($row['published_time']).'</div>';
					$html .= '	</div>';
					$html .= '</a>';
					$html .= '</article>';
	}
	$html .= '</div>';
	echo $html;
}

function testNews(){
	$newsObj = do_curl('http://phinder.thaipbs.or.th/api/search/thaipbs/news?q=%E0%B8%9E%E0%B8%A3%E0%B8%B0%E0%B8%A3%E0%B8%B2%E0%B8%8A%E0%B8%9E%E0%B8%B4%E0%B8%98%E0%B8%B5%E0%B8%96%E0%B8%A7%E0%B8%B2%E0%B8%A2%E0%B8%9E%E0%B8%A3%E0%B8%B0%E0%B9%80%E0%B8%9E%E0%B8%A5%E0%B8%B4%E0%B8%87%E0%B8%9E%E0%B8%A3%E0%B8%B0%E0%B8%9A%E0%B8%A3%E0%B8%A1%E0%B8%A8%E0%B8%9E&published_range=last_24_hours&page=1&size=10');
	print_r($newsObj);
}

function forceDownload(){
	header("Content-Type: application/octet-stream");
	header("Content-Transfer-Encoding: Binary");
	
	$image = wp_get_attachment_image_src($_GET['id'],'full');
    $image_meta = get_post($_GET['id']);
		
	$fileExt = pathinfo(basename($image[0]),PATHINFO_EXTENSION);
	if($_GET['nf'] == 1){
		$filename = basename($image[0]);
	}
	else{
		$filename = $image_meta->post_title.'.'.$fileExt;
	}
	header('Content-disposition: attachment; filename="'.$filename.'"'); 
	echo readfile($image[0]);
}

function getShare(){
		$id = $_GET['id'];
		$access_token = '1444762879177941|Wc0tNcW_RVe2gJPtYibZa_CTlAQ';
		$url	= 'https://graph.facebook.com/v2.9/?id='.urlencode($id).'&fields=engagement&access_token='.$access_token;
		$obj	= do_curl($url);
		echo "fb : ".$obj['engagement']['share_count']."<br>";
}

if($_GET['fn']){
	$_GET['fn']();
}
?>