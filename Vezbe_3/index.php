<?php
	define("MAX_INDEX", 10);
	define("PICS_PER_PAGE", 3);
	// Calculate the amount of pages
	$pages_count = ceil((MAX_INDEX + 1) / PICS_PER_PAGE);
	// Default page set to 1
	$page = 1;
	// Check if "page" exists, if it does, we get it from query string
	if (isset($_GET["page"])) {
		$page = (int) $_GET["page"];
		// if it doesn't, we set it back to default
		if (!($page >= 1 && $page <= $pages_count)) {
			$page = 1;
		}
	}
	// First image index
	$img_from = ($page-1) * PICS_PER_PAGE;
	$img_to = min($img_from + PICS_PER_PAGE, MAX_INDEX+1);

	if (isset($_GET["filter"])) {
		$filter = $_GET["filter"];
		$filter_arr = explode('-', $filter);
		if (count($filter_arr) == 2) {
			$from = (int) $filter_arr[0];
			$to = (int) $filter_arr[1];
			if ($from < $to && $from >= 0 && $from < MAX_INDEX && $to > 0 && $to <= MAX_INDEX) {
				$img_from = $from;
				$img_to = $to + 1;
			}
		}
	}
?>

<html>
	<head>
		<title>Galerija</title>
		<link rel="stylesheet" type="text/css" href="css/style.css" />
	</head>
	<body>
		<header>
			<h1>Galerija</h1>
		</header>
		<form action="" method="get">
			U polje ispod možete uneti tekst formata x-y. Primer: ukoliko unesete 5-9, na stranici će se prikazati slike rednih brojeva iz opsega [5,9]. <br/>
			<input type="text" name="filter"/>
			<input type="text" name="filter2"/>
			<input type="submit" value="Primeni filter"/>
		</form>
		<?php
			// Image output
			for ($i = $img_from; $i < $img_to; $i++) {
				echo "<img src='images/$i.jpg'/>";
			}
		?>
		<div class="link-group">
			<?php
				// Page links output
				for ($i = 1; $i <= $pages_count; $i++) {
					echo "<a href='?page=$i'>$i</a> ";
				}
			?>
		</div>
	</body>
</html>