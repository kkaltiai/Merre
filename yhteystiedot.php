<?php
header("Content-Type: text/html; charset=utf-8");
?>
<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
		<link rel="stylesheet" href="style.css" style="text/css">
		<link rel="shortcut icon" type="image/x-icon" href="pageimages/favicon.ico">	<!--ikonin väri #2FA45E-->
		<title>Merre, ilmaisia e-kortteja</title>
		<meta name="keywords" content="e-kortteja,e-kortti,ekortti,ilmaisia,ilmainen,syntymäpäivä,ystävänpäivä,joulu,isänpäivä,äitienpäivä,halloween">
		<meta name="description" content="Ilmaisia Merre e-kortteja moneen eri tilaisuuteen. Muista ystävääsi lähettämällä hänelle ilmainen e-kortti.">		
	</head>
	<body>
		<!-- google analytics seurantakoodi-->
		<?php include_once("analyticstracking.php") ?>	
		<!-- javascript facebook jakamista varten -->
		<div id="fb-root"></div>
		<script>(function(d, s, id) {
			var js, fjs = d.getElementsByTagName(s)[0];
			if (d.getElementById(id)) return;
			js = d.createElement(s); js.id = id;
			js.src = "//connect.facebook.net/fi_FI/sdk.js#xfbml=1&version=v2.0";
			fjs.parentNode.insertBefore(js, fjs);
			}(document, 'script', 'facebook-jssdk'));
		</script>
		<!-- javascript twitter jakamista varten -->
		<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';
			if(!d.getElementById(id)){js=d.createElement(s);
			js.id=id;js.src=p+'://platform.twitter.com/widgets.js';
			fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');
		</script>
		<!-- javascript google+ jakamista varten -->
		<script src="https://apis.google.com/js/platform.js" async defer>
			{lang: 'fi'}
		</script>	
	
		<div id="wrapper">
			<div class="ylämainos">
				<!--<img src="ylämainos.jpg" width="810">-->
			</div>
			<header>
				<div class="text_line"></div>
				<nav>
					<div class="na">
						<ul>
							<li><a href="index.php">Etusivu</a></li>
							<li><a href="yhteystiedot.php">Yhteystiedot</a></li>
							<li><a href="#">E-kortit<img src="pageimages/arrow.png" alt="arrow"></a>
								<ul>	
									<li><a class="kategorialinkki" target="_self" href="kategoria.php?kategoria=halloween">Halloween</a></li>
									<li><a class="kategorialinkki" target="_self" href="kategoria.php?kategoria=isänpäivä">Isänpäivä</a></li>
									<li><a class="kategorialinkki" target="_self" href="kategoria.php?kategoria=itsenäisyyspäivä">Itsenäisyyspäivä</a></li>
									<li><a class="kategorialinkki" target="_self" href="kategoria.php?kategoria=joulu">Joulu</a></li>
									<li><a class="kategorialinkki" target="_self" href="kategoria.php?kategoria=kiitoskortit">Kiitoskortit</a></li>
									<li><a class="kategorialinkki" target="_self" href="kategoria.php?kategoria=kutsukortit">Kutsukortit</a></li>
									<li><a class="kategorialinkki" target="_self" href="kategoria.php?kategoria=nimipäivä">Nimipäivä</a></li>
									<li><a class="kategorialinkki" target="_self" href="kategoria.php?kategoria=onnittelut">Onnittelut</a></li>
									<li><a class="kategorialinkki" target="_self" href="kategoria.php?kategoria=pääsiäinen">Pääsiäinen</a></li>
									<li><a class="kategorialinkki" target="_self" href="kategoria.php?kategoria=syntymäpäivä">Syntymäpäivä</a></li>
									<li><a class="kategorialinkki" target="_self" href="kategoria.php?kategoria=vappu">Vappu</a></li>
									<li><a class="kategorialinkki" target="_self" href="kategoria.php?kategoria=ystävänpäivä">Ystävänpäivä</a></li>
									<li><a class="kategorialinkki" target="_self" href="kategoria.php?kategoria=äitienpäivä">Äitienpäivä</a></li>
								</ul>
							</li>
						</ul>
					</div>	
					<p class="otsikko"><a class="etusivulinkki" target="_self" href="index.php">Merre</a><p>
				</nav>
			</header>
			<section>			
				<!--linkki etusivulle/otsikko-->
				<h3 class="kategorialinkki" clear="right">
				<a class="kategorialinkki" target="_self" href="index.php">Etusivu</a> / Yhteystiedot</h3>
				<hr class="kategorialinkkihr">	
				
				<p>Voit lähettää meille sähköpostia osoitteeseen:<br>
				Sähköposti: merre(at)merre.net</p>
			</section>
			<aside>
				<!--<img src="mainos.jpg" alt="Mainos" width="143" height="538">-->
			</aside>			
			<footer>
				<div class="share">
					<!-- Twitter -->
					<span><a href="https://twitter.com/share" class="twitter-share-button" data-url="http://www.merre.net" data-text="Muista ystävääsi ilmaisella e-kortilla!" data-count="none">Tweet</a></span>
					<!-- Facebook -->
					<span><div class="fb-share-button" data-href="http://www.merre.net" data-layout="button"></div></span>
					<!-- Google+ -->
					<span><div class="g-plus" data-action="share" data-annotation="none" data-href="http://www.merre.net"></div></span>
				</div>
				<p>Jaa merre.net tuttujesi kanssa</p>	
			</footer>
		</div>		
	</body>
</html>
