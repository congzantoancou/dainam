<?php
include_once('Data.php');

$object = new Data;
//$array = $object->getAllData();
//var_dump($array);

$counted_page = 0;
$MAX_PAGE_BOOK1 = 608;
$MAX_PAGE_BOOK2 = 596;

if (isset($_GET['b']))
	$b = $_GET['b'];
else $b = 0;

if (isset($_GET['keyword'])) {
	$key = $_GET['keyword'];
	if (!is_numeric($key)) {
		$row = $object->getRow($key);
		$page = $row['page'];
		$b = $row['b'];
	} else {
		$page = $key;
	}
} else if (isset($_GET['page'])) {
	$page = $_GET['page'];
} else $page = 0;

if ($b == 0) {
	if ($page <= $MAX_PAGE_BOOK1) {
		$b = 1;
	} else {
		$b = 2;
	}
}

if ($page == 0) {
	$header = 'Bắt đầu bằng cách nhập từ khóa hoặc số trang cần tìm kiếm';
	$title = 'Trang bìa';
} else if ($page > $MAX_PAGE_BOOK1 && $b == 1 || $page > $MAX_PAGE_BOOK2 && $b == 2) {
	$header = 'Không tìm thấy trang';
	$title = 'Không tìm thấy trang';
} else if ($page > 0 && $b != 0) {
	$counted_page = $page;
	if ($page > $MAX_PAGE_BOOK1) {
		$page = $page - $MAX_PAGE_BOOK1;
	}

	$header = 'Đang hiển thị trang <span class="page">' . $page . '</span>' . ' | Quyển ' . $b;
	$title = 'Trang ' . $page . ' | Quyển ' . $b;
}

function isOverPage($page, $b)
{
	global $MAX_PAGE_BOOK1, $MAX_PAGE_BOOK2;
	return ($page > $MAX_PAGE_BOOK1 && $b == 1 || $page > $MAX_PAGE_BOOK2 && $b == 2) ? true : false;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title><?php echo $title; ?> - Đại Nam Quấc âm Tự vị Lookup Tool</title>
	<link rel="stylesheet" href="bootstrap-3.3.7-dist/bootstrap-3.3.7-dist/css/bootstrap.min.css">
	<link rel="stylesheet" href="styles.css">
	<link href="https://fonts.googleapis.com/css?family=Bungee+Shade&display=swap" rel="stylesheet">
	<script src="jquery-3.4.1.min.js"></script>
	<script src="scripts.js"></script>
</head>

<body>
	<nav class="navbar navbar-inverse">
		<div class="container-fluid">
			<div class="navbar-header">
				<a class="navbar-brand" href="index.php">WebSiteName</a>
			</div>
			<ul class="nav navbar-nav">
				<li class="active">
					<a href="#">Home</a>
				</li>
				<li>
					<a href="words">Search by words</a>
				</li>
				<li>
					<a href="about">About</a>
				</li>
			</ul>
			<form class="navbar-form navbar-left" method="get" action="index">
				<div class="form-group">
					<input type="radio" id="book1" name="b" value="1">
					<label for="book1">b1</label>
					<input type="radio" id="book2" name="b" value="2">
					<label for="book2">b2</label>
				</div>
				<div class="form-group">
					<input name="keyword" type="text" class="form-control" placeholder="Input keyword or no of page">
				</div>
				<button type="submit" class="btn btn-default">Search</button>
			</form>
			<ul class="nav navbar-nav navbar-right">
				<li>
					<a href="#">
						<span class="glyphicon glyphicon-plus-sign"></span> Add char</a>
				</li>
				<li>
					<a href="#">
						<span class="glyphicon glyphicon-user"></span> Sign Up</a>
				</li>
				<li>
					<a href="#">
						<span class="glyphicon glyphicon-log-in"></span> Login</a>
				</li>
			</ul>
		</div>
	</nav>
	<?php if ($page == 0) { ?>
		<div class="container">
			<h2>
				<?php echo $header; ?>
			</h2>
			<img class="center" src="http://vietnamtudien.org/dnqatv/pic/DictionaireI.gif" alt="Đại Nam Quấc âm Tự vị">
		</div>
	<?php } else if (isOverPage($page, $b)) { ?>
		<div class="container">
			<h2>
				<?php echo $header; ?>
			</h2>
			<img class="center" src="https://learn.getgrav.org/user/pages/11.troubleshooting/01.page-not-found/error-404.png" alt="Not found">
		</div>
	<?php } else if ($page > 0) { ?>
		<div class="main">
			<div class="page-info">
				<div class="container">
					<div class="row">
						<div class="col-md-6">
							<div class="center">
								<h2>
									<?php echo $header; ?>
								</h2>
							</div>
						</div>
						<div class="col-md-6">
							<div class="change-page center">
								<div class="row">
									<div class="col-md-6">
										<a class="btn btn-primary" href="index
										?page=<?php echo $counted_page - 1 ?>
										&b=<?php echo ($page > $MAX_PAGE_BOOK1 && $b == 1) ? 1 : 2; ?>">
											<div class="icon">⇦</div>
										</a>
									</div>
									<div class="col-md-6">
										<a class="btn btn-primary" href="index
										?page=<?php echo $counted_page + 1 ?>
										&b=<?php echo ($page > $MAX_PAGE_BOOK1 && $b == 1) ? 1 : 2; ?>">
											<div class="icon">⇨</div>
										</a>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<?php $joined_page = 'bd' . $b . '/b' . $b . 's' . $page . '.png'; ?>
			<div class="img full-image">
				<img class="img-responsive center" src="http://vietnamtudien.org/dnqatv/pic/<?php echo $joined_page ?>" alt="Đại Nam Quấc âm Tự vị trang <?php echo $page ?>" />
			</div>

			<div class="panel left-side vertical-text">TRÁI</div>
			<div class="panel right-side vertical-text">PHẢI</div>

			<div class="img side-crop left-part center hidden">
				<img src="http://vietnamtudien.org/dnqatv/pic/<?php echo $joined_page ?>" alt="Đại Nam Quấc âm Tự vị trang <?php echo $page ?>">
			</div>
			<div class="img side-crop right-part right-crop center hidden">
				<img src="http://vietnamtudien.org/dnqatv/pic/<?php echo $joined_page ?>" alt="Đại Nam Quấc âm Tự vị nửa trang <?php echo $page ?>">
			</div>


		</div>
	<?php } ?>
	<?php if ($page == 0 || isOverPage($page, $b)) { ?>
		<footer>
			<span>
				&copy Fiong 2020 | Trang nguồn: <a href="http://vietnamtudien.org/dnqatv/">vietnamtudien.org/dnqatv</a>
			</span>
		</footer>
	<?php } ?>
</body>

</html>