<?php get_header();
$meruCode = 'ในหลวง';
 ?>
<!--<section id="navbar">
	<div class="container">
		<div class="col-lg-12">
			<a href="http://www.thaipbs.or.th" target="_blank">เข้าหน้าหลัก Thai PBS</a>
		</div>
	</div>
</section>-->
<?php
$live = get_field( "status", 468 );
if($live == 1) {
?>
<section id="live-player">
     <div class="container">     
  <div id="player">
  <iframe src="http://www.thaipbs.or.th/live/embedded" frameborder="0"></iframe>
  </div>

</div>
</section>
<?php } ?>
<section id="banner" class="no-drop" style="padding-bottom:0px;display:<?php echo $live == 1 ? 'none' : 'block'?>;">
	
</section>
<section id="schedule" <?php echo $live == 1 ? 'style="margin-top: -10px;"' : NULL ?>>
	<div class="container">
		<div class="col-lg-12 timetable">
			<div class="section-title"><img src="<?php echo get_template_directory_uri();?>/images/time-table_header.png" class="img-responsive" /></div>
			<div class="section-content row">
			<?php
			$schedule_query = new WP_Query(array(
											'numberposts'	=> -1,
											'post_type'		=> 'schedule',
											'order'	=>	'ASC'
											)
										);
										
			?>
			<?php if( $schedule_query->have_posts() ): $i=1;?>
				<?php while( $schedule_query->have_posts() ) : $schedule_query->the_post(); ?>
					<div class="schedule-row col-lg-2 col-md-12 col-xs-12 col-sm-12 <?php echo $i==1 ? 'col-lg-offset-1' : NULL ?> block">
							<div class="title col-lg-12 col-md-3 col-xs-12 col-sm-12"><?php the_title(); ?></div>
							<div class="thumbnail col-lg-12 col-md-3 col-xs-6 col-sm-6"><?php the_post_thumbnail(); ?></div>
							<div class="content col-lg-12 col-md-6 col-xs-6 col-sm-6"><?php the_content(); ?></div>
					</div>
				<?php $i++; endwhile; ?>
				
			<?php endif; ?>
			</div>
		</div>
	</div>

</section>

<section id="slide_image1">
	<div class="container">
		<div class="col-lg-12">
			<div class="section-title"><img src="<?php echo get_template_directory_uri();?>/images/slide_image1_title_07.png" class="img-responsive" /></div>
			<div class="section-content owl-carousel owl-theme">
			<?php 
			$gallery1 = get_field('images',17);
										
			foreach($gallery1 as $key=>$row){
			?>
			 <div class="item">
				<a href="<?php echo $row['url']?>" class="gallery" data-fancybox="gallery" data-caption=" " data-id="<?php echo $row['ID']?>"><img src="<?php echo $row['sizes']['medium']?>" /></a>
			 </div>
			<?php } ?>
			</div>
		</div>
	
	</div>
	<div class="loadmore" style="margin-top:20px">
		<a href="<?php bloginfo('url')?>/quote" target="_blank">ดูทั้งหมด</a>
	</div>

</section>
<!--
<section id="slide_image1">
	<div class="container">
		<div class="col-lg-12">
			<div class="section-title"><img src="<?php //echo get_template_directory_uri();?>/images/slide_image2_title_11.png" class="img-responsive" /></div>
			<div class="section-content owl-carousel owl-theme">
			<?php 
			//$gallery2 = get_field('images',35);
										
			//foreach($gallery2 as $key=>$row){
			?>
			 <div class="item">
				<a href="<?php //echo $row['url']?>" class="gallery1" data-fancybox="gallery1" data-id="<?php //echo $row['ID']?>"><img src="<?php //echo $row['sizes']['medium']?>" /></a>
			 </div>
			<?php //} ?>
			</div>
		</div>
	</div>
</section>
-->
<section id="info">
	<div class="container">
		<div class="col-lg-12">
			<div class="section-title"><img src="<?php echo get_template_directory_uri();?>/images/info_title_15.png" class="img-responsive" /></div>
			<div class="section-content owl-carousel owl-theme">
			<?php 
			$gallery3 = get_field('images',79);
										
			foreach($gallery3 as $key=>$row){
			?>
			 <div class="item">
				<a href="<?php echo $row['url']?>" class="gallery2" data-fancybox="gallery2" data-id="<?php echo $row['ID']?>"><img src="<?php echo $row['sizes']['large']?>" class="img-responsive" /></a>
			 </div>
			<?php } ?>
			</div>
		</div>
	</div>
</section>

<section id="meru">
	<div class="container">
		<div class="col-lg-12">
			<div class="section-title"><img src="<?php echo get_template_directory_uri();?>/images/news_title_bg_03.png" class="img-responsive" /></div>
			<div class="section-content" id="meru-content">
			<?php
			$news = getNews($meruCode);
			foreach($news as $key=>$row){
				
			?>
				<article class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
					<a href="<?php echo $row['url']?>" target="_blank">
						<div class="media-content">
							<img src="<?php echo $row['image']['url']?>" class="img-responsive" />
						</div>
						<div class="media-title">
							<div class="title"><?php echo $row['title']?></div>
							<div class="date"><?php echo DateThai($row['published_time'])?></div>
						</div>
					</a>
				</article>
			<?php } ?>
			</div>
		</div>
	</div>
	<div class="loadmore">
		<a href="#" id="meru-more">ดูทั้งหมด</a>
	</div>
</section>
<!--
<section id="news">
	<div class="container">
		<div class="col-lg-12">
			<div class="section-title"><img src="<?php //echo get_template_directory_uri();?>/images/news_title_15.png" class="img-responsive" /></div>
			<div class="section-content" id="news-content">
			<?php
			//$news = getNews($newsCode);
			//foreach($news as $key=>$row){
			?>
				<article class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
					<a href="<?php //echo $row['url']?>" target="_blank">
						<div class="media-content">
							<img src="<?php //echo $row['image']['url']?>" class="img-responsive" />
						</div>
						<div class="media-title">
							<div class="title"><?php //echo $row['title']?></div>
							<div class="date"><?php //echo DateThai($row['published_time'])?></div>
						</div>
					</a>
				</article>
			<?php //} ?>
			</div>
		</div>
	</div>
	<div class="loadmore">
		<a href="#" id="news-more">ดูทั้งหมด</a>
	</div>
</section>

<section id="event">
	<div class="container">
		<div class="col-lg-12">
			<div class="section-title"><img src="<?php //echo get_template_directory_uri();?>/images/event-title_03.png" class="img-responsive" /></div>
			<div class="section-content" id="event-content">
			
			<?php
			/*$event_query = new WP_Query(array(
											'numberposts'	=> -1,
											'post_type'		=> 'news',
											'order'	=>	'DESC'
											)
										);*/
			?>
			<?php //if( $event_query->have_posts() ): ?>
				<?php //while( $event_query->have_posts() ) : $event_query->the_post(); ?>
				<article class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
					<a href="<?php //echo get_field('url')?>" target="_blank">
						<div class="media-content">
							<?php //the_post_thumbnail('medium',array('class' => 'img-responsive')); ?>
						</div>
						<div class="media-title">
							<div class="title"><?php //the_title() ?></div>
							<div class="date"><?php //echo DateThai(get_field('publish_date'))?></div>
						</div>
					</a>
				</article>
				<?php //endwhile; ?>
				
			<?php //endif; ?>
			
		
			</div>
		</div>
	</div>
	<div class="loadmore">
		<a href="#" id="event-more">ดูทั้งหมด</a>
	</div>
</section>
-->
<section id="program">
<div class="container">
		<div class="col-lg-12">
			<div class="section-title"><img src="<?php echo get_template_directory_uri();?>/images/9program_title_03.png" class="img-responsive" /></div>
			<div class="section-content" id="program5">
			<?php
			$gd9 = getCollection('9GuidingLight');
			foreach($gd9 as $key=>$row){
			?>
				<article class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
					<a href="<?php echo $row['canonical_url']?>" target="_blank">
						<div class="media-content">
							<img src="<?php echo $row['display_image']['sizes']['medium']['url']?>" class="img-responsive" />
						</div>
						<div class="media-title">
							<?php echo $row['title']?>
						</div>
					</a>
				</article>
			<?php } ?>
			</div>
		</div>
	</div>
		<div class="loadmore">
			<a href="#" id="program5-more">ดูทั้งหมด</a>
		</div>
		
	<div class="container">
	
		<div class="col-lg-6 mbottom-10">
			<div class="program-bg">
			<div class="section-title"><img src="<?php echo get_template_directory_uri();?>/images/program-n1.png" class="img-responsive" /></div>
			<div class="section-content" id="pn1">
				<?php
			$pn1 = getProgram('TheStory');
			foreach($pn1 as $key=>$row){
			?>
				<article class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
					<a href="<?php echo $row['canonical_url']?>" target="_blank">
						<div class="media-content">
							<img src="<?php echo $row['display_image']['sizes']['medium']['url']?>" class="img-responsive" />
						</div>
						<div class="media-title">
							<?php echo $row['title']?>
						</div>
					</a>
				</article>
			<?php } ?>
			</div>
			
			<div class="loadmore">
				<a href="#" id="pn1-more">ดูทั้งหมด</a>
			</div>
			</div>
		</div>
		
		<div class="col-lg-6 mbottom-10">
			<div class="program-bg">
			<div class="section-title"><img src="<?php echo get_template_directory_uri();?>/images/program-n2.png" class="img-responsive" /></div>
			<div class="section-content" id="pn2">
			<?php
			$pn2 = getProgram('DramaGuidingLight');
			foreach($pn2 as $key=>$row){
			?>
				<article class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
					<a href="<?php echo $row['canonical_url']?>" target="_blank">
						<div class="media-content">
							<img src="<?php echo $row['display_image']['sizes']['medium']['url']?>" class="img-responsive" />
						</div>
						<div class="media-title">
							<?php echo $row['title']?>
						</div>
					</a>
				</article>
			<?php } ?>
			
			</div>
			<div class="loadmore">
				<a href="#" id="pn2-more">ดูทั้งหมด</a>
			</div>
			</div>
		</div>
		
		
		<div class="col-lg-6">
			<div class="program-bg">
			<div class="section-title"><img src="<?php echo get_template_directory_uri();?>/images/pg_title1_03.png" class="img-responsive" /></div>
			<div class="section-content" id="program1">
				<?php
			$heartWork = getProgram('Heartwork');
			
			foreach($heartWork as $key=>$row){
			?>
				<article class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
					<a href="<?php echo $row['canonical_url']?>" target="_blank">
						<div class="media-content">
							<img src="<?php echo $row['display_image']['sizes']['medium']['url']?>" class="img-responsive" />
						</div>
						<div class="media-title">
							<?php echo $row['title']?>
						</div>
					</a>
				</article>
			<?php } ?>
			</div>
			<div class="loadmore">
				<a href="#" id="program1-more">ดูทั้งหมด</a>
			</div>
			</div>
		</div>
		
		<div class="col-lg-6">
			<div class="program-bg">
			<div class="section-title"><img src="<?php echo get_template_directory_uri();?>/images/pg_title2_03.png" class="img-responsive" /></div>
			<div class="section-content" id="program2">
			<?php
			$kingofheart = getProgram('KingOfHeart');
			foreach($kingofheart as $key=>$row){
			?>
				<article class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
					<a href="<?php echo $row['canonical_url']?>" target="_blank">
						<div class="media-content">
							<img src="<?php echo $row['display_image']['sizes']['medium']['url']?>" class="img-responsive" />
						</div>
						<div class="media-title">
							<?php echo $row['title']?>
						</div>
					</a>
				</article>
			<?php } ?>
			
			</div>
			<div class="loadmore">
				<a href="#" id="program2-more">ดูทั้งหมด</a>
			</div>
			</div>
		</div>
		
		<div class="col-lg-12">
			<div class="section-title"><img src="<?php echo get_template_directory_uri();?>/images/gd_title_03.png" class="img-responsive" /></div>
			<div class="section-content" id="program3">
			<?php
			$guildingLight = getCollection('GuidingLightProgram');
			foreach($guildingLight as $key=>$row){
			?>
				<article class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
					<a href="<?php echo $row['canonical_url']?>" target="_blank">
						<div class="media-content">
							<img src="<?php echo $row['display_image']['sizes']['medium']['url']?>" class="img-responsive" />
						</div>
						<div class="media-title">
							<?php echo $row['title']?>
						</div>
					</a>
				</article>
			<?php } ?>
			</div>
		</div>
		
		</div>
		
		<div class="loadmore">
			<a href="#" id="program3-more">ดูทั้งหมด</a>
		</div>
		
		<div class="container">
		<div class="col-lg-12">
			<div class="section-title"><img src="<?php echo get_template_directory_uri();?>/images/pg_title5_03.png" class="img-responsive" /></div>
			<div class="section-content" id="program4">
			<?php
			$guildingLightNews = getProgram('GuidingLightNews');
			foreach($guildingLightNews as $key=>$row){
			?>
				<article class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
					<a href="<?php echo $row['canonical_url']?>" target="_blank">
						<div class="media-content">
							<img src="<?php echo $row['display_image']['sizes']['medium']['url']?>" class="img-responsive" />
						</div>
						<div class="media-title">
							<?php echo $row['title']?>
						</div>
					</a>
				</article>
			<?php } ?>
			</div>
		</div>
	</div>
		<div class="loadmore">
			<a href="#" id="program4-more">ดูทั้งหมด</a>
		</div>
	
	
</section>


<section id="clip">
	<div class="container">
		<div class="col-lg-12">
			<div class="section-title"><img src="<?php echo get_template_directory_uri();?>/images/clip_title_23.png" class="img-responsive" /></div>
			<div class="section-content" id="clip-content">
			<?php
			$collection = getCollection('CL-GuidingLight');
			foreach($collection as $key=>$row){
				if($key <= 4){
			?>
				<article class="video <?php echo $key <= 1 ? 'col-lg-6 main-media' : 'col-lg-4'?>">
					<a href="<?php echo $row['canonical_url']?>" target="_blank">
						<div class="media-content">
							<div class="play-btn"></div>
							<img src="<?php echo $row['display_image']['sizes']['large']['url']?>" class="img-responsive" />
						</div>
						<div class="media-title">
							<?php echo $row['title']?>
						</div>
					</a>
				</article>
			<?php 
				}
			}
			?>
			</div>
		</div>
	</div>
	<div class="loadmore">
		<a href="#" id="clip-more">ดูทั้งหมด</a>
	</div>
</section>

<section id="flower" style="padding-bottom:50px">
	<div class="container">
		<div class="col-lg-12">
			<div class="section-title"><img src="<?php echo get_template_directory_uri();?>/images/flower_title_03.png" class="img-responsive" /></div>
			<div class="section-content">
			<?php
			$video_query = new WP_Query(array(
											'numberposts'	=> -1,
											'post_type'		=> 'video',
											'order'	=>	'DESC'
											)
										);
			?>
			<?php if( $video_query->have_posts() ): $i=1;?>
				<?php while( $video_query->have_posts() ) : $video_query->the_post(); ?>
					
					<article class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
						<a href="<?php echo get_field('url')?>" target="_blank">
							<div class="media-content">
								
								<?php the_post_thumbnail('medium',array(
									'class' => 'img-responsive'

									))?>
							</div>
							<div class="media-title">
								<div class="date"><?php the_title() ?></div>
							</div>
						</a>
					</article>
					
				<?php $i++; endwhile; ?>
				
			<?php endif; ?>
			
			
			</div>
		</div>
	</div>
</section>

<section id="gallery">
	<div class="container">
		<div class="col-lg-12">
			<div class="section-title"><img src="<?php echo get_template_directory_uri();?>/images/gallery_title_15.png" class="img-responsive" /></div>
			<div class="section-content">
			<ul class="pgwSlideshow">
			<?php
			$gallery = get_field('images',45);
			foreach($gallery as $key=>$row){ 
			?>
				<li><img src="<?php echo $row['sizes']['large']?>" /></li>
			<?php } ?>
			</ul>
			</div>
		</div>
	</div>
</section>

<section id="program_schedule" style="margin-bottom:50px;display:none">
	<div class="container">
		<div class="col-lg-12">
			<div class="section-title"><img src="<?php echo get_template_directory_uri();?>/images/program_schedule_title_15.png" class="img-responsive" /></div>
			<div class="section-content">
			<?php 
			$pgSchedule = get_field('images',61);
			?>
			
			<img src="<?php echo $pgSchedule[0]['sizes']['large']?>" class="img-responsive" />
			</div>
		</div>
	</div>
</section>

<a href="http://www.thaipbs.or.th" target="_blank" class="btn btn-primary btn-lg" style="border-color:#ddd;background:#4c4c4c;font-family:Sukhumvit_setsemi_bold;bottom: 10px; right: 3%; position:fixed;">
      <span class="txt">เข้าหน้าหลัก Thai PBS</span>
</a>
<!--
<div id="slidebox">
<a href="javascript:void(0);" id="close" class="btn btn-danger btn-xs"><i class="fa fa-times"></i></a>
<div class="fb-page hidden-sm hidden-xs" data-href="https://www.facebook.com/GuidingLightThaiPBS/" data-tabs="timeline" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true" data-height="400"><blockquote cite="https://www.facebook.com/GuidingLightThaiPBS/" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/GuidingLightThaiPBS/">แสงจากพ่อ สู่ความยั่งยืน</a></blockquote></div>
<div class="fb-page hidden-lg hidden-md" data-href="https://www.facebook.com/GuidingLightThaiPBS/" data-tabs="timeline" data-small-header="true" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="false" data-height="70"><blockquote cite="https://www.facebook.com/GuidingLightThaiPBS/" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/GuidingLightThaiPBS/">แสงจากพ่อ สู่ความยั่งยืน</a></blockquote></div>
</div>
-->
<script>
function loadMore(containerID,buttonID,unitSlice,unitShow){
	$(containerID).slice(0, unitSlice).show();
    $(buttonID).on('click', function (e) {
        e.preventDefault();
        $(containerID+":hidden").slice(0,unitShow).slideDown();
        if ($(containerID+":hidden").length == 0) {
            $(buttonID).addClass('btn disabled');
        }
		else{
			 $('html,body').animate({
				scrollTop: $(this).offset().top
			}, 500);
		}
       
    });
}

window.fbAsyncInit = function() {
    FB.init({
        appId            : '1720451074916135',
        status           : true,
        cookie           : true,
        version          : 'v2.10'                
    });

};

(function(d, s, id){
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) {return;}
    js = d.createElement(s); js.id = id;
    js.src = "//connect.facebook.net/en_US/sdk.js";
    fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));

$(function(){
	/*$('#slidebox').slideBox({
        position: 'bottom right', // can be [bottom|middle|top] and [left|center|right]
        appearsFrom: 'right', // can be [left|top|right|bottom]
        slideDuration: 500, // animation duration in ms
        closeLink: '#close' // a string that is the jQuery selector of the closing element
    })*/
	$(".gallery").fancybox({
		buttons : [
		'close'
		],
		clickSlide : false,
		clickOutside : false,
		caption : function( instance ) {
            var advert = '<div class="fancybox-social"><a href="<?php bloginfo('url')?>/load?fn=forceDownload&id='+$(this).data('id')+'" class="download" title="ดาวน์โหลด"><button class="fancybox-button">ดาวน์โหลด</button></a> <label>แชร์</label>'+
						'<ul>'+
							'<li><button class="fancybox-button fancy-button-fb social" data-id="'+$(this).data('id')+'"><i class="fa fa-facebook"></i></button></li>'+
							'<li><button class="fancybox-button fancy-button-tw social" data-id="'+$(this).data('id')+'"><i class="fa fa-twitter"></i></button></li>'+
							'<li><button  class="fancybox-button fancy-button-line social"><div style="z-index:99999" class="line-it-button" data-lang="en" data-type="share-d" data-url="http://special.thaipbs.or.th/guidinglight/quote/?i='+$(this).data('id')+'" style="display: none;"></div></button></li>'+
						'</ul>'+
					'</div>';

            return advert + ( $(this).data('caption') || '' );
        },
		
		mobile : {
			clickContent : function( current, event ) {
				return false;
			}
		},

		afterLoad  : function(){
			LineIt.loadButton();
			
			$( '.fancy-button-fb' ).click(function(e){
				e.preventDefault();
					FB.ui(
						{
							method: 'share',
							href: '<?php bloginfo('url')?>/quote?i='+$(this).data('id'),
							redirect_uri : '<?php bloginfo('url')?>/quote',
							hashtag : '#ThaiPBS',
							display : 'popup'
						},
						function (response) {

						}
					);
			})
			
			$('.fancy-button-tw').click(function (e) {
				e.preventDefault();
				var loc = '<?php bloginfo('url')?>/quote?i='+$(this).data('id');
				var title  = "๘๙ คำของพ่อ %23แสงจากพ่อสู่ความยั่งยืน %23ThaiPBS";

				window.open('http://twitter.com/share?url=' + loc + '&text=' + title + '&', 'twitterwindow', 'height=450, width=550, left='+$(window).width()/2 +', toolbar=0, location=0, menubar=0, directories=0, scrollbars=0');
			});
			
		}

	})
	
	$(".gallery1,.gallery2").fancybox({
		buttons : [
		'close'
		],
		clickSlide : false,
		clickOutside : false,
		/*	caption : function( instance ) {
            var advert = '<div class="fancybox-social"><a href="<?php bloginfo('url')?>/load?fn=forceDownload&nf=1&id='+$(this).data('id')+'" class="download" title="ดาวน์โหลด"><button class="fancybox-button">ดาวน์โหลด</button></a></div>';
            return advert + ( $(this).data('caption') || '' );
        },*/
	})
	
	$('.owl-carousel').slick({
		slidesToShow: 4,
		slidesToScroll: 4,
        infinite: false,
		dots:false,
		adaptiveHeight: true,
		variableWidth:false,
		focusOnSelect: true,
		prevArrow:"<img class='a-left control-c prev slick-prev' src='<?php echo get_template_directory_uri();?>/images/prev-arrow.png'>",
        nextArrow:"<img class='a-right control-c next slick-next' src='<?php echo get_template_directory_uri();?>/images/next-arrow.png'>",
		responsive: [
			{
			  breakpoint: 1024,
			  settings: {
				slidesToShow: 3,
				slidesToScroll: 3
			  }
			},
			{
			  breakpoint: 600,
			  settings: {
				slidesToShow: 2,
				slidesToScroll: 2
			  }
			},
			{
			  breakpoint: 480,
			  settings: {
				slidesToShow: 1,
				slidesToScroll: 1
			  }
			}
		]
	});
	$('.pgwSlideshow').pgwSlideshow();
	
	loadMore("#meru-content>article","#meru-more",8,8);
	loadMore("#news-content>article","#news-more",8,8);
	loadMore("#event-content>article","#event-more",8,8);
	loadMore("#pn1>article","#pn1-more",4,4);
	loadMore("#pn2>article","#pn2-more",4,4);
	loadMore("#program1>article","#program1-more",4,4);
	loadMore("#program2>article","#program2-more",4,4);
	loadMore("#program3>article","#program3-more",12,8);
	loadMore("#program4>article","#program4-more",8,8);
	loadMore("#program5>article","#program5-more",8,8);
	loadMore("#clip-content>article","#clip-more",5,3);
	
	
	
});
</script>
<?php get_footer(); ?>