<?php
add_theme_support( 'post-thumbnails' );
function remove_admin_login_header() {
    remove_action('wp_head', '_admin_bar_bump_cb');
}
add_action('get_header', 'remove_admin_login_header');
remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'wp_print_styles', 'print_emoji_styles' ); 

add_action( 'admin_menu', 'my_admin_menu' );

function my_admin_menu() {
	add_menu_page( 'สถิติ', 'สถิติ', 'manage_options', 'myplugin/stats_page.php', 'stats_page', 'dashicons-analytics', 6  );
}

function stats_page(){
	$image = get_field('images',17);
	//echo '<pre>';
		//print_r($image);
	?>
	<div class="wrap">
		<h2>สถิติ</h2>
		<table class="wp-list-table widefat fixed striped posts">
			<thead>
				<tr>
					<td width="5%">#</td>
					<td width="20%">Image</td>
					<td width="30%">URL</td>
					<td width="5%">Fb</td>
					<td width="5%">Tw</td>
				</tr>
			</thead>
			<tbody>
				<?php
				foreach($image as $key=>$row){ 
				if($key >= 60 && $key < 80){?>
				<tr>
					<td><?php echo $key+1?></td>
					<td><img src="<?php echo $row['sizes']['thumbnail']?>" width="60" class="img-responsive"/></td>
					<td><a href="<?php bloginfo('url')?>/quote?i=<?php echo $row['ID']?>" target="_blank"><?php bloginfo('url')?>/quote?i=<?php echo $row['ID']?></a></td>
					<td><?php echo getShareStats('fb',get_bloginfo('url').'/quote?i='.$row['ID'])?></td>
					<td><?php echo getShareStats('tw',get_bloginfo('url').'/quote?i='.$row['ID'])?></td>
				</tr>
				<?php 
				}
				} ?>
			</tbody>
		</table>
	</div>
	<?php
}

function do_curl($url){
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_URL,$url);
	$result=curl_exec($ch);
	curl_close($ch);
	return json_decode($result, true);
}

function getShareStats($channel,$url){
	if($channel == 'fb'){
		$access_token = '1444762879177941|Wc0tNcW_RVe2gJPtYibZa_CTlAQ';
		$url	= 'https://graph.facebook.com/v2.9/?id='.urlencode($url).'&fields=engagement&access_token='.$access_token;
		$obj	= do_curl($url);
		return $obj['engagement']['share_count'];
	}
	elseif($channel == 'tw'){
		$url = 'http://opensharecount.com/count.json?url='.$url;
		$obj	= do_curl($url);
		return $obj['count'];
	}
	else{
		
	}
}

function getNews($q ,$page = 1,$size = 50,$other = false){
	
	$newsObj = do_curl('http://phinder.thaipbs.or.th/api/search/thaipbs/news?q='.$q.'&published_range=last_year&page='.$page.'&size='.$size);

	foreach ($newsObj['data'] as $key => $part) {
       $sort[$key] = strtotime($part['published_time']);
	}
	array_multisort($sort, SORT_DESC, $newsObj['data']);
	return $newsObj['data'];
}

function getProgram($pgKey,$page = 1){
	$url = 'http://program.thaipbs.or.th/api/episodes?program='.$pgKey.'&page='.$page.'&limit=50';
	$pgObj	= do_curl($url);
	return $pgObj['data'];
}

function getCollection($pgKey){
	$url = 'http://program.thaipbs.or.th/api/collections/'.$pgKey;
	$pgObj	= do_curl($url);
	return $pgObj['data'];
}


function fbPhoto($id,$limit = 100){
	$access_token 	= '1444762879177941|Wc0tNcW_RVe2gJPtYibZa_CTlAQ';
	$albumID		= $id;
	
	$getAlbumUrl	= 'https://graph.facebook.com/'.$albumID.'/photos?fields=images,link,name&limit='.$limit.'&access_token='.$access_token;
	$AlbumObj		= do_curl($getAlbumUrl);

	$photoObj = array();
	
	foreach($AlbumObj['data'] as $key=>$row){
		$photoObj[$key]['source'] = $row['images'][0]['source'];
		$photoObj[$key]['thumb'] = $row['images'][2]['source'];
		$photoObj[$key]['title'] = $row['name'];
		$photoObj[$key]['link'] = $row['link'];
	}

	return array_reverse($photoObj);
}

function DateThai($strDate){
		$strYear = date("Y",strtotime($strDate))+543;
		$strMonth= date("n",strtotime($strDate));
		$strDay= date("j",strtotime($strDate));
		$strHour= date("H",strtotime($strDate));
		$strMinute= date("i",strtotime($strDate));
		$strSeconds= date("s",strtotime($strDate));
		$strMonthCut = Array("","ม.ค.","ก.พ.","มี.ค.","เม.ย.","พ.ค.","มิ.ย.","ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค.");
		$strMonthThai=$strMonthCut[$strMonth];
		return "$strDay $strMonthThai $strYear";
}	

function opengraph() {
    global $post;
 
    if(is_page('quote')) {
		
		if(!empty($_GET['i'])){
			$image = wp_get_attachment_image_src($_GET['i'],'medium');
			$image_meta = get_post($_GET['i']);
			?>
	 
		 <meta property="og:title" content="๘๙ คำของพ่อ">
		 <meta property="og:url" content="http://special.thaipbs.or.th/guidinglight/quote/?i=<?php echo $_GET['i']?>">
		 <meta property="og:type" content="website">
		 <meta property="og:site_name" content="Thai PBS">
		 <meta property="og:image" content="<?php echo $image[0]?>">
		 <meta property="og:image:width" content="<?php echo $image[1]?>" />
		 <meta property="og:image:height" content="<?php echo $image[2]?>" />
		 <meta property="fb:app_id" content="1761820420740661">
		 <meta property="og:description" content='ไทยพีบีเอสขอชวนทุกท่านร่วมกันสืบสานคำสอนของพ่อให้ยั่งยืนสืบต่อไป กับ "๘๙ คำของพ่อ" หนึ่งในโครงการ "แสงจากพ่อ สู่ความยั่งยืน" ติดตามคำสอนของพ่อได้ที่นี่ คลิก'>
		 
		 <meta name="twitter:card" content="summary">
		<meta name="twitter:site" content="@ThaiPBS">
		<meta name="twitter:creator" content="@ThaiPBS">
		<meta name="twitter:url" content="http://special.thaipbs.or.th/guidinglight/quote/?i=<?php echo $_GET['i']?>">
		<meta name="twitter:title" content="๘๙ คำของพ่อ">
		<meta name="twitter:image" content="<?php echo $image[0]?>">
			<?php
		}
		else{
			?>
			<meta property="og:title" content="๘๙ คำของพ่อ">
			 <meta property="og:url" content="http://special.thaipbs.or.th/guidinglight/quote/">
			 <meta property="og:type" content="website">
			 <meta property="og:site_name" content="Thai PBS">
			 <meta property="og:image" content="<?php echo get_template_directory_uri();?>/images/cover-quote.png">
			 <meta property="fb:app_id" content="1761820420740661">
			 <meta property="og:description" content='ไทยพีบีเอสขอชวนทุกท่านร่วมกันสืบสานคำสอนของพ่อให้ยั่งยืนสืบต่อไป กับ "๘๙ คำของพ่อ" หนึ่งในโครงการ "แสงจากพ่อ สู่ความยั่งยืน" ติดตามคำสอนของพ่อได้ที่นี่ คลิก'>
			 
			 <meta name="twitter:card" content="summary">
			<meta name="twitter:site" content="@ThaiPBS">
			<meta name="twitter:creator" content="@ThaiPBS">
			<meta name="twitter:url" content="http://special.thaipbs.or.th/guidinglight/quote/">
			<meta name="twitter:title" content="๘๙ คำของพ่อ">
			<meta name="twitter:image" content="<?php echo get_template_directory_uri();?>/images/cover-quote.png">
			
			<?php
		}
 
    } else {
       ?>
	   	<meta property="og:title" content="แสงจากพ่อ สู่ความยั่งยืน : www.thaipbs.or.th/GuidingLight">
		<meta property="og:url" content="http://www.thaipbs.or.th/GuidingLight">
		<meta property="og:type" content="website">
		<meta property="og:site_name" content="Thai PBS">
		<meta property="og:image" content="<?php echo get_template_directory_uri();?>/images/GLFB.jpg">
		<meta property="fb:app_id" content="1761820420740661">
		<meta property="og:description" content='สถานีโทรทัศน์ไทยพีบีเอส ขอน้อมนำพระอัจฉริยภาพของ "พระบาทสมเด็จพระปรมินทรมหาภูมิพลอดุลยเดช" ถ่ายทอดสู่ประชาชนชาวไทยผ่านรายการและกิจกรรมต่างๆในโครงการ "แสงจากพ่อ สู่ความยั่งยืน" เริ่ม 1 สิงหาคมนี้'>
		<?php
    }
}
add_action('wp_head', 'opengraph', 5);
?>