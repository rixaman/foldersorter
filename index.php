<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>dz1</title>
	<link rel="stylesheet" type="text/css" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">	
	<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
	<script src="tree.jquery.js"></script>
	<link rel="stylesheet" href="jqtree.css">
</head>
<script type="text/javascript" src="scripts.js"></script>
<?
	// Старые не используемые функции. Всё рабочее в файле ajax.php и script.js
    function dbTestRecord() {
		// Create connection
	    $servername = 'localhost'; 
	    $username = 'root'; 
	    $password = ''; 
	    $dbname = 'dz1'; 
		$conn = new mysqli($servername, $username, $password, $dbname);
		// Check connection
		if ($conn->connect_error) {
		    die("Connection failed: " . $conn->connect_error);
		}

		$sql = "INSERT INTO MyGuests (firstname, lastname, email)
		VALUES ('John', 'Doe', 'john@example.com')";

		if ($conn->query($sql) === TRUE) {
		    echo "New record created successfully";
		} else {
		    echo "Error: " . $sql . "<br>" . $conn->error;
		}

		$conn->close();
    }

    function dbRecord() {
		// Create connection
	    $servername = 'localhost'; 
	    $username = 'root'; 
	    $password = ''; 
	    $dbname = 'dz1'; 
		$conn = new mysqli($servername, $username, $password, $dbname);
		// Check connection
		if ($conn->connect_error) {
		    die("Connection failed: " . $conn->connect_error);
		}

		$catalog = 'q';
		$sql = "INSERT INTO catalogs (name)
		VALUES ('".$catalog."')";

		if ($conn->query($sql) === TRUE) {
		    echo "New record created successfully";
		} else {
		    echo "Error: " . $sql . "<br>" . $conn->error;
		}

		$conn->close();
    }

	    $arRi = array();
	    global  $skolko_failov;
	    global  $skolko_papok;
	    $skolko_failov = 1;
	    $skolko_papok = 1;


		//dbConnect();
		
		//count_files('D:/Programm/OpenServer5/OpenServer/domains/work/aspro/dz1/catalog/');
		//echo '<pre>'; print_r($arRi); echo '</pre>';
?>
<body>
	<div class="container">
		<br>
		<div class="row">
			<div class="col-lg-4">
				<?//Инпуты?>
				<label for="dbHost">host</label>
				<input type="text" class="form-control" id="dbHost" placeholder="dbHost" value="localhost">
				<label for="dbLogin">login</label>
				<input type="text" class="form-control" id="dbLogin" placeholder="dbLogin" value="root">
				<label for="dbPass">pass</label>
				<input type="text" class="form-control" id="dbPass" placeholder="dbPass" value="">
				<label for="dbBase">base</label>
				<input type="text" class="form-control" id="dbBase" placeholder="dbBase" value="dz1">
				<label for="catalog">catalog</label>
				<input type="text" class="form-control" id="catalog" placeholder='D:/Programm/OpenServer5/OpenServer/domains/work/aspro/dz1/catalog/' value="D:/Programm/OpenServer5/OpenServer/domains/work/aspro/dz1/catalog/">
			</div>
			<?//Кнопки?>
			<div class="col-lg-2" style="display:none">
				<a href="#" id="dbConnect">dbConnect</a>
				<a href="#" id="dbReading">dbReading</a>
				<a href="#" id="countFiles">countFiles</a>
				<a href="#" id="dbReadToJson">dbReadToJson</a>
				<!-- <a href="#" id="dbBasing">dbBase</a> -->
			</div>
			<div class="col-lg-2">
				<a href="#" id="scanDir">scanDir</a>
			</div>
		</div>
		<hr>
		<?//Лог?>
		<div class="row">
			<div class="col-lg-12">
				<p id="log">
				</p>
			</div>
		</div>
		<hr>
		<?//Дерево json?>
		<div class="row">
			<div class="col-lg-12">
				<div id="tree"></div>
			</div>
		</div>
		<hr>
		<?//Дерево json?>
		<div class="row" style="display:none">
			<div class="col-lg-12">
				<div id="tree1"></div>
			</div>
		</div>
		<hr>
		<?//ХЗ?>
		<div class="row" style="display:none">
			<div class="col-lg-12">
				<ul>
					<li>вайл только по каталогу</li>
					<li>рекурсия по папкам - ?</li>
					<li>перенос через бд проще</li>
				</ul>
			</div>
		</div>
	</div>
</body>
</html>