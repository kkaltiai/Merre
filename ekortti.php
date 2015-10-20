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
				<?php
					//muokkaa tätä vielä
					function test_input($data) {
						$data = trim($data);
						$data = stripslashes($data);
						$data = htmlspecialchars($data);
						return $data;
					}

					//haetaan katsottava kortti tietokannasta
					try{
						//muodostetaan yhteys tietokantaan
						include 'connectDB.php';

						//varmista että die() on käytetty oikein ja muokkaa virheilmoitusta sopivaksi
						// varmista että token on olemassa ja voimassaoleva
						if (isset($_GET["token"])) {
							$token = test_input($_GET["token"]);
	
							$sqlURLvarmistus = "SELECT token FROM toimitettukortti WHERE token = ?";

							$a = $pdo->prepare($sqlURLvarmistus);
							$a->execute(array($token));
							$count = $a->rowCount();
	
							//annettu token ei ole käytössä
							if($count != 1){
								echo 'Antamasi osoite on virheellinen tai poistunut käytöstä. Varmista että olet kirjoittanut osoitteen oikein.<br>';
								echo 'Pääset katsomaan e-kortteja sivulta: <br><br>';
								echo '<a href="index.php">www.merre.net</a>';
								die();
							}	
						}
						//tokenia ei oltu annettu ollenkaan
						else {
							echo 'Antamasi osoite on virheellinen <br>';
							echo 'Pääset katsomaan e-kortteja sivulta: <br><br>';
							echo '<a href="index.php">www.merre.net</a>';
							die();
						}
						
						//linkki etusivulle/otsikko
						echo '<h3 class="kategorialinkki" clear="right">';
						echo '<a class="kategorialinkki" target="_self" href="index.php">Etusivu</a>
							/ Sinulle on lähetetty Merre e-kortti</h3>';
						echo '<hr class="kategorialinkkihr">';

						//Haetaan tietokannasta lähetetty ekortti
						$stmt = $pdo->prepare("SELECT vastaanottaja, lähettäjä, viesti, osoite, nimi FROM toimitettukortti, kortti WHERE kortti.kortti_id=toimitettukortti.kortti_id and toimitettukortti.token=:token");
						$stmt->bindValue(':token', $token, PDO::PARAM_STR);
						$stmt->execute();
						$results=$stmt->fetchAll(PDO::FETCH_ASSOC);
						
						//	$viesti tulee kahden borderin väliin
						foreach($results as $row){
							echo '<p class="tervehdys">Hei, '.$row['vastaanottaja'].'! '.$row['lähettäjä'].' on lähettänyt sinulle e-kortin:</p>';
							echo '<div class="ekorttiesikatseluviesti">';
							echo '<div class="ekortticontainer">';
							echo '<img src="images/'.$row['osoite'].'" alt="'.$row['nimi'].'">';
							echo '</div>';
							echo '<p class="kortinviesti">'.$row['viesti'].'</p>';
							echo '</div>';
						}

						//lomakeesikatseluviesti lomakecontainer img </div kortinviesti </div
						
						
						//closes connection to the database
						$pdo = null;

						//if you don't catch exception thrown from the PDO constructor zend engine terminates the scripts and shows back trace
						//back trace will likely reveal the full database connection details, including the username and password.
					}catch(PDOException $e){
						print "An Error occured! " . $e->getMessage() . "<br>";
						echo '<div class="tietokantavirheilmoitus">Oho, nyt meni jotain pieleen. Ole hyvä ja yritä vähän ajan kuluttua uudelleen.</div>';
						die();
					}

				?>
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
