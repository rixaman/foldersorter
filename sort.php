<html>
<head>
	<title>dz1</title>
	<link rel="stylesheet" type="text/css" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">	
</head>
<body>
<?
	function mergesort($data) {

		if(count($data)>1) {

			$data_middle = round(count($data)/2, 0, PHP_ROUND_HALF_DOWN);

			$data_part1 = mergesort(array_slice($data, 0, $data_middle));
			$data_part2 = mergesort(array_slice($data, $data_middle, count($data)));

			$counter1 = $counter2 = 0;

			for ($i=0; $i<count($data); $i++) {

				if($counter1 == count($data_part1)) {
					$data[$i] = $data_part2[$counter2];
					++$counter2;
				} elseif (($counter2 == count($data_part2)) or ($data_part1[$counter1] < $data_part2[$counter2])) {
					$data[$i] = $data_part1[$counter1];
					++$counter1;
				} else {
					$data[$i] = $data_part2[$counter2];
					++$counter2;
				}
			}
		}
		return $data;
	}

?>
	<div class="container">
		<div class="row">
			<div class="col-12-lg">
				<div class="input-group">
					<form method="post">
						<input type="text" class="form-control" placeholder="9 5 8 4 7 1 2 3" name="array">
						<span class="input-group-btn">
							<button class="btn btn-default" type="submit">Sort!</button>
						</span>
					</form>
				</div>
				<?
				    if ($_POST['array']) {
				        $data = explode(" ", $_POST['array']);
				    }				
				?>
				<pre>
					<?
						$data = mergesort($data);
						print_r($data);
					?>
				</pre>

			</div>
		</div>
	</div>
</body>
</html>