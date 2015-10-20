<?php
header("Content-Type: text/html; charset=utf-8");
?>
<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
		<link rel="stylesheet" href="style.css" style="text/css">
		<link rel="shortcut icon" type="image/x-icon" href="pageimages/favicon.ico">
		<title>Merre, ilmaisia e-kortteja</title>
		<meta name="keywords" content="merre,e-kortteja,e-kortti,ekortti,ekortteja,ilmaisia,ilmainen,syntymäpäivä,ystävänpäivä,joulu,isänpäivä,äitienpäivä,halloween">
		<meta name="description" content="Ilmaisia Merre e-kortteja moneen eri tilaisuuteen. Muista ystävääsi lähettämällä hänelle ilmainen e-kortti.">		
	</head>
	<body onload="vaihdaKuva()">
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
		<!--aside kuvien vaihtuminen-->
		<script src="code.js"></script>
	
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
				<?php
					//muokkaa tätä vielä
					function test_input($data) {
						$data = trim($data);
						$data = stripslashes($data);
						$data = htmlspecialchars($data);
						return $data;
					}

					try{
						//muodostetaan yhteys tietokantaan
						include 'connectDB.php';

						//varmista että die() on käytetty oikein ja muokkaa virheilmoitusta sopivaksi
						// varmistaa että kategoria on olemassa
						if (isset($_GET["kategoria"])) {
							$kategoria = test_input($_GET["kategoria"]);
							$sqlKategoriaVarmistus = "SELECT DISTINCT kategoria FROM kortti WHERE kategoria = ?";

							$a = $pdo->prepare($sqlKategoriaVarmistus);
							$a->execute(array($kategoria));
							$count = $a->rowCount();
	
							//annettu kategoria, joka ei ole olemassa
							if($count != 1){
								echo 'Antamasi osoite on virheellinen. Varmista että olet kirjoittanut osoitteen oikein.<br>';
								echo 'Pääset katsomaan e-kortteja sivulta: <br><br>';
								echo '<a href="index.php">www.merre.net</a>';
								die();
							}	
						}
						//kategoriaa ei oltu annettu ollenkaan
						else {
							echo 'Antamasi osoite on virheellinen. Varmista että olet kirjoittanut osoitteen oikein.<br>';
							echo 'Pääset katsomaan e-kortteja sivulta: <br><br>';
							echo '<a href="index.php">www.merre.net</a>';
							die();
						}
						
						echo '<h3 class="text_line kategorialinkki">';
						echo '<a class="kategorialinkki" target="_self" href="index.php">Etusivu</a> / '.mb_convert_case($kategoria,MB_CASE_TITLE, "UTF-8").'</h3>';
						echo '<hr class="kategorialinkkihr">';
						
						$stmt = $pdo->prepare("SELECT kortti_id, osoite, nimi FROM kortti WHERE kategoria=:kategoria");
						$stmt->bindValue(':kategoria', $kategoria, PDO::PARAM_STR);
						$stmt->execute();
						$results=$stmt->fetchAll(PDO::FETCH_ASSOC);

						foreach($results as $row){
							echo '<div class="imgcontainer">';
							echo '<a href="lomake.php?kortti_id='.$row['kortti_id'].'" target="_self">';
							echo '<img src="images/'.$row['osoite'].'" alt="'.$row['nimi'].'"></a>';
							echo '</div>';
						}

						//closes connection to the database
						$pdo = null;

						//if you don't catch exception thrown from the PDO constructor zend engine terminates the scripts and shows back trace
						//back trace will likely reveal the full database connection details, including the username and password.
					}catch(PDOException $e){
						//print "An Error occured! " . $e->getMessage() . "<br>";
						echo '<div class="tietokantavirheilmoitus">Oho, nyt meni jotain pieleen. Ole hyvä ja yritä vähän ajan kuluttua uudelleen.</div>';
						die();
					}
				?>
			</section>
			<a id="asideLink" href="kategoria.php?kategoria=kutsukortit">
				<p id="asideOtsikko">Kutsukortit</p>
				<aside>
					<div class="asideimgcontainer">
						<img id="asideImg1" src="images/kutsu2.png" alt="ekortti">
					</div>
					<div class="asideimgcontainer">
						<img id="asideImg2" src="images/kutsu4.png" alt="ekortti">
					</div>	
				</aside>
			</a>		
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
