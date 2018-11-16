<?php 
/* Template Name: qoute */
get_header();?>
<style type="text/css">
#banner{padding-bottom:20px;background:#000306;min-height:inherit;}
#qoute .gallery .item{padding-bottom:50px;}
.loadmore{margin-top:30px;}
</style>
<section id="navbar">
	<div class="container">
		<div class="col-lg-12">
			<a href="<?php bloginfo('url')?>">กลับหน้าหลัก แสงจากพ่อสู่ความยั่งยืน</a>
		</div>
	</div>
</section>
<section id="bannerq">
	<div class="container">
		<img src="<?php echo get_template_directory_uri();?>/images/qoute-cover.png" class="img-responsive" />
	</div>
</section>

<section id="qoute">
	<div class="container">
		<div class="gallery">
		<?php if(empty($_GET['i'])){ ?>
		<?php 
				$qoute = get_field('images',17);		
				foreach($qoute as $key=>$row){
				?>
				 <div class="col-lg-3 col-md-3 col-sm-4 col-xs-6 item">
					<a href="<?php echo $row['url']?>" data-fancybox="gallery" data-caption=" " data-id="<?php echo $row['ID']?>" ><img src="<?php echo $row['sizes']['medium']?>" class="img-responsive" style="border: 2px solid #66624e;" /></a>
				 </div>
				<?php } ?>
		<?php }else{ 
			$image_large = wp_get_attachment_image_src($_GET['i'],'large');
			$image_url = wp_get_attachment_image_url($_GET['i'],'full');
		?>
			<div class="col-lg-4"></div>
			<div class="col-lg-4" style="text-align:center">
				<a href="<?php echo $image_url?>" data-fancybox="gallery" data-caption=" " data-id="<?php echo $_GET['i']?>"><img src="<?php echo $image_large[0]?>" class="img-responsive" style="border: 10px solid #66624e;"/></a>
			</div>
			<div class="col-lg-4"></div>
		<?php } ?>
		</div>
	</div>
	<?php if(!empty($_GET['i'])){ ?>
	<div class="loadmore">
		<a href="<?php bloginfo('url')?>/quote" id="meru-more">ดูทั้งหมด</a>
	</div>
	<?php } ?>
</section>
<script type="text/javascript">
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
	$("[data-fancybox]").fancybox({
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
	
})
</script>
<?php get_footer();?>