<?php
session_start();

if(!empty($_SESSION['user_data_id'])){
	echo "로그인상태입니다";
	exit;
}
?>
<!DOCTYPE html>
<html lang="ko">
<head>
	<meta charset="utf-8">
	<title>로그인</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
	<link href="../style.css" rel="stylesheet">
</head>

<body>
	<section class="h-100">
		<div class="container h-100">
			<div class="row justify-content-sm-center h-100">
				<div class="col-xxl-4 col-xl-5 col-lg-5 col-md-7 col-sm-9">
					<div class="text-center my-5">
						<h1>로그인</h1>
					</div>
					<div class="card shadow-lg">
						<div class="card-body p-5">
							<h1 class="fs-4 card-title fw-bold mb-4">로그인</h1>

							<form method="POST" class="needs-validation" novalidate="" action="post/login_process.php" autocomplete="off">
								<div class="mb-3">
									<label class="mb-2 text-muted" for="email">이메일주소</label>
									<input id="email" type="email" class="form-control" name="email" value="" required autofocus>
									<div class="invalid-feedback">
										형식에 맞게 이메일을 입력해주세요
									</div>
								</div>

								<div class="mb-3">
									<div class="mb-2 w-100">
										<label class="text-muted" for="password">비밀번호</label>
										<a href="forgot.php" class="float-end">
											비밀번호 재설정
										</a>
									</div>
									<input id="password" type="password" class="form-control" name="password" required>
								    <div class="invalid-feedback">
								    	비밀번호가 빈칸입니다
							    	</div>
								</div>

								<div class="d-flex align-items-center">
									<button type="submit" class="btn btn-primary ms-auto">
										로그인
									</button>
								</div>
							</form>
						</div>
						<div class="card-footer py-3 border-0">
							<div class="text-center">
								계정이 없으신가요? <a href="register.php" class="text-dark">회원가입</a>
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
