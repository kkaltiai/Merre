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
						// varmista että kortti_id on olemassa
						if (isset($_GET["kortti_id"])) {
							$kortti_id = test_input($_GET["kortti_id"]);
	
							$sqlKortti_IDVarmistus = "SELECT kortti_id FROM kortti WHERE kortti_id = ?";

							$a = $pdo->prepare($sqlKortti_IDVarmistus);
							$a->execute(array($kortti_id));
							$count = $a->rowCount();
	
							//annettu kortti_id, joka ei ole olemassa
							if($count != 1){
								echo 'Antamasi osoite on virheellinen. Varmista että olet kirjoittanut osoitteen oikein.<br>';
								echo 'Pääset katsomaan e-kortteja sivulta: <br><br>';
								echo '<a href="index.php">www.merre.net</a>';
								die();
							}	
						}
						//kortti_id:tä ei oltu annettu ollenkaan
						else {
							echo 'Antamasi osoite on virheellinen. Varmista että olet kirjoittanut osoitteen oikein.<br>';
							echo 'Pääset katsomaan e-kortteja sivulta: <br><br>';
							echo '<a href="index.php">www.merre.net</a>';
							die();
						}

						$pdo = null;

						//if you don't catch exception thrown from the PDO constructor zend engine terminates the scripts and shows back trace
						//back trace will likely reveal the full database connection details, including the username and password.
					}catch(PDOException $e){
						//print "An Error occured! " . $e->getMessage() . "<br>";
						echo '<div class="tietokantavirheilmoitus">Oho, nyt meni jotain pieleen. Ole hyvä ja yritä vähän ajan kuluttua uudelleen.</div>';
						die();
					}

					// asetetaan muuttujille tyhjät arvot
					$lähettäjäErr = $vastaanottajaErr = $emailErr = $lahemailErr = "";
					$lähettäjä = $vastaanottaja = $email = $lahemail = $viesti = $esikatseluviesti = "";
					$ehdot = 0;
					$lähetysotsikko = "Lähetä e-kortti";

					//jos sähköposti osoitteet tallennetaan väliaikaisesti pitää ne hashata http://www.w3schools.com/php/func_mail_ezmlm_hash.asp
					//EI VIELÄ VALMIS!!!!!   RATKAISE 79 CHARACTER PER LINE ONGELMA?? OIKEESTI LUE LÄPI!!
					if ($_SERVER["REQUEST_METHOD"] == "POST") {
						if (empty($_POST["vastaanottaja"])) {
							$vastaanottajaErr = "Vastaanottaja on pakollinen";
						} else {
							$vastaanottaja = test_input($_POST["vastaanottaja"]);
							// check if vastaanottaja only contains letters and whitespace
							// ehkä ei tarvitse tarkistaa entä jos haluaa käyttää ulkomaalaisia
							// charactereitä?
							if (!preg_match("/^[a-zA-ZäöÄÖ ,.-]*$/",$vastaanottaja)) {
								$vastaanottajaErr = "Vain kirjaimet ja tyhjätila sallitaan"; 
								$ehdot=0;
							} else {
								$ehdot++;
							}
						}

						if (empty($_POST["lähettäjä"])) {
							$lähettäjäErr = "Lähettäjä on pakollinen";
						} else {
							$lähettäjä = test_input($_POST["lähettäjä"]);
							// check if lähettäjä only contains letters and whitespace
							// ehkä ei tarvitse tarkistaa entä jos haluaa käyttää ulkomaalaisia
							// charactereitä?
							if (!preg_match("/^[a-zA-ZäöÄÖ ,.-]*$/",$lähettäjä)) {
								$lähettäjäErr = "Vain kirjaimet ja tyhjätila sallitaan"; 
								$ehdot=0;
							} else {
								$ehdot++;
							}
						}
   
						if (empty($_POST["email"])) {
							$emailErr = "Sähköposti on pakollinen";
						} else {
							$email = test_input($_POST["email"]);
							$explode = explode(',',$email); // Explodes the emails by the comma
							$valid = true;		
							// Loop through each email and validate it
							foreach($explode as $emails) {
								if(!filter_var($emails, FILTER_VALIDATE_EMAIL)) {
									$valid = false;
								}
							}
							if ($valid) {
								$ehdot++;
							}
							else{
								$emailErr = "Viallinen sähköposti formaatti"; 
								$ehdot=0;
							}
						}
   
						if (empty($_POST["lahemail"])) {
							$lahemailErr = "Sähköposti on pakollinen";
						} else {
							$lahemail = test_input($_POST["lahemail"]);
							// check if e-mail address is well-formed
							if (!filter_var($lahemail, FILTER_VALIDATE_EMAIL)) {
								$lahemailErr = "Viallinen sähköposti formaatti"; 
								$ehdot=0;
							} else {
								$ehdot++;
							}
						}
						//rajoita viestin pituutta JOU!
						if (empty($_POST["viesti"])) {
							$viesti = "";
						} else {
							$viesti = test_input($_POST["viesti"]);
						}
						if(isset($_POST['esikatsele'])) {
							$esikatseluviesti = $viesti;
							$lähetysotsikko = 'Esikatselu.<br><br>Hei, '.$vastaanottaja.'! '.$lähettäjä.' on lähettänyt sinulle e-kortin:';
						}
						elseif($ehdot==4){
	
							try{
								//muodostetaan yhteys tietokantaan
								include 'connectDB.php';
	
								//luodaan hash url token
								//http://php.net/manual/en/function.openssl-random-pseudo-bytes.php
								$bytes = openssl_random_pseudo_bytes(16);
								$token = bin2hex($bytes);
								$korttiosoite = 'http://www.merre.net/ekortti.php?token='.$token;
								$sähköpostiviesti = "Sinulle on lähetetty Merre e-kortti! Voit katsoa e-kortin osoitteessa: \n
								$korttiosoite \n 
								Kortti on katsottavissa kahden kuukauden ajan. \n 
								- - - - - - - - - - - - - - - - - - - - - - -  \n
								http://www.merre.net - ilmaisia e-kortteja! \r 
								Muista ystävääsi lähettämällä oma e-kortti!" ;

								//tietokantaan lisätään kortinkatselutiedot			  
								$query = $pdo->prepare(
								"INSERT INTO toimitettukortti (token, viesti, vastaanottaja, lähettäjä, kortti_id) VALUES (?, ?, ?, ?, ?)"
								);
								$query->execute(
								array(
									$token,
									$viesti,
									$vastaanottaja,
									$lähettäjä,
									$kortti_id));
								

		
								$subject = $lähettäjä." on lähettänyt sinulle E-kortin";
								//mail($to,$subject,$txt,$headers);
								//mail($email,$subject,$viesti,$headers);
								$headers = 'From: '.$lahemail. "\r\n" .
								'X-Mailer: PHP/' . phpversion();
								$headers .= 'MIME-Version: 1.0' . "\r\n";
								$headers .= 'Content-type:text/plain;charset=utf-8' . "\r\n";
								//lähetetään sähköpostiviesti ekortin vastaanottajalle
								mail($email, '=?utf-8?B?'.base64_encode($subject).'?=', $sähköpostiviesti, $headers);
								$esikatseluviesti = $viesti;
			
								$lähetysotsikko = 'E-kortti on lähetetty!<br><br>Hei, '.$vastaanottaja.'! '.$lähettäjä.' on lähettänyt sinulle e-kortin:';
			
								//closes connection to the database
								$pdo = null;
	
								//if you don't catch exception thrown from the PDO constructor zend engine terminates the scripts and shows back trace
								//back trace will likely reveal the full database connection details, including the username and password.
							}catch(PDOException $e){
								//print "An Error occured! " . $e->getMessage() . "<br>";
								echo '<div class="tietokantavirheilmoitus">Oho, nyt meni jotain pieleen. Ole hyvä ja yritä vähän ajan kuluttua uudelleen.</div>';
								die();
							}
	
						} else {
							$ehdot = 0;
						}
					}


					//haetaan lähetettävä kortti tietokannasta
					try{
						//muodostetaan yhteys tietokantaan
						include 'connectDB.php';

						echo '<h3 class="kategorialinkki" clear="right">';
						echo '<a class="kategorialinkki" target="_self" href="index.php">Etusivu</a>
							/ Lähetä e-kortti</h3>';
						echo '<hr class="kategorialinkkihr">';
						echo '<p>Lähettääksesi e-kortin sinun tulee täyttää tähdellä merkityt pakolliset kohdat.
								Jos haluat lähettää e-kortin usealle henkilölle, erottele vastaanottajien sähköpostit 
								toisistaan pilkulla ilman välilyöntejä seuraavasti:<br>
								nimi1@esimerkki.com,nimi2@esimerkki.com,nimi3@esimerkki.com</p>';
						echo '<p class="tervehdys">'.$lähetysotsikko.'</p>';
						

						$stmt = $pdo->prepare("SELECT osoite, nimi FROM kortti WHERE kortti_id=:kortti_id");
						$stmt->bindValue(':kortti_id', $kortti_id, PDO::PARAM_STR);
						$stmt->execute();
						$results=$stmt->fetchAll(PDO::FETCH_ASSOC);
						
						foreach($results as $row){
							/*lomakesectioncontainer div ottaa sisälleen kortin lisäksi formin*/
							echo '<div class="lomakesectioncontainer">';
							echo '<div class="lomakeesikatseluviesti">';
							echo '<div class="lomakecontainer">';
							
							echo '<img src="images/'.$row['osoite'].'" alt="'.$row['nimi'].'"">';
							
							echo '</div>';
							echo '<div class="kortinviesti">'.$esikatseluviesti.'</div>';
							
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

				<!--<p><span class="error">* pakollinen kenttä.</span></p>-->
				
				<form method="post" action="<?php echo htmlspecialchars($_SERVER["REQUEST_URI"]);?>"> 
					<label for="vastaanottaja"> Vastaanottaja: </label><br>
					<input type="text" name="vastaanottaja" maxlength="30" value="<?php echo $vastaanottaja;?>">
					<span class="error">* <?php echo $vastaanottajaErr;?></span>
					<br><br>
					<label for="lähettäjä">Lähettäjä: </label><br>
					<input type="text" name="lähettäjä" maxlength="30" value="<?php echo $lähettäjä;?>">
					<span class="error">* <?php echo $lähettäjäErr;?></span>
					<br><br>
					<label for="email">Vastaanottajan Sähköposti: </label><br>
					<input type="text" name="email" maxlength="300" value="<?php echo $email;?>">
					<span class="error">* <?php echo $emailErr;?></span>
					<br><br>
					<label for="lahemail">Lähettäjän Sähköposti: </label><br>	
					<input type="text" name="lahemail" maxlength="50" value="<?php echo $lahemail;?>">
					<span class="error">* <?php echo $lahemailErr;?></span>
					<br><br>
					<label for="viesti">Viesti: </label><br>
					<textarea name="viesti" rows="5" cols="40" maxlength="200"><?php echo $viesti;?></textarea>
					<br><br>
					<input type="submit" name="submit" value="Lähetä"> 
					<input type="submit" name="esikatsele" value="Esikatsele"> 
				</form>
				</div>
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
