<?php
require_once("../../load_page.php");

$key = urldecode($_GET['key']);
$date = date("YmdH");

if(decrypt($key) !== $date){
	echo '<script>';
	echo 'alert("잘못된 접근입니다");';
	echo 'history.back();';
	echo '</script>';
}
?>
<!DOCTYPE html>
<html lang="ko">
<head>
	<meta charset="utf-8">
	<title>비밀번호 변경 인증</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
	<link href="../../style.css" rel="stylesheet">
</head>

<body>
	<section class="h-100">
		<div class="container h-100">
			<div class="row justify-content-sm-center h-100">
				<div class="col-xxl-4 col-xl-5 col-lg-5 col-md-7 col-sm-9">
					<div class="text-center my-5">
						<h1>비밀번호 변경 인증</h1>
					</div>
					<div class="card shadow-lg">
						<div class="card-body p-5">
							<h1 class="fs-4 card-title fw-bold mb-4">비밀번호 변경 인증</h1>
							<form method="POST" class="needs-validation" action="needkey_process.php" novalidate="" autocomplete="off">
								<div class="mb-3">
									<label class="mb-2 text-muted" for="pw_key">인증키</label>
									<input id="pw_key" type="pw_key" class="form-control" name="pw_key" value="" required autofocus>
								</div>

								<div class="mb-3">
									<label class="mb-2 text-muted" for="password">비밀번호</label>
									<input id="password" type="text" class="form-control" name="password" value="" required autofocus>
								</div>

								<div class="d-flex align-items-center">
									<button type="submit" class="btn btn-primary ms-auto">
										비밀번호 변경	
									</button>
								</div>
							</form>
						</div>
						<div class="card-footer py-3 border-0">
							<div class="text-center">
								계정이 있으신가요? <a href="../index.php" class="text-dark">로그인</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

	<script src="js/login.js"></script>
</body>
</html>
