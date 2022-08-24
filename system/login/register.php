<!DOCTYPE html>
<html lang="ko">
<head>
	<meta charset="utf-8">
	<title>회원가입</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
	<link href="../style.css" rel="stylesheet">
</head>

<body>
	<section class="h-100">
		<div class="container h-100">
			<div class="row justify-content-sm-center h-100">
				<div class="col-xxl-4 col-xl-5 col-lg-5 col-md-7 col-sm-9">
					<div class="text-center my-5">
						<h1>회원가입</h1>
					</div>
					<div class="card shadow-lg">
						<div class="card-body p-5">
							<h1 class="fs-4 card-title fw-bold mb-4">회원가입</h1>
							<form method="POST" class="needs-validation" action="post/register_process.php" novalidate="" autocomplete="off">
								<div class="mb-3">
									<label class="mb-2 text-muted" for="id">아이디 (* 변경불가)</label>
									<input id="id" type="text" class="form-control" name="id" value="" required autofocus>
									<div class="invalid-feedback">
										ID
									</div>
								</div>

								<div class="mb-3">
									<label class="mb-2 text-muted" for="email">이메일주소</label>
									<input id="email" type="email" class="form-control" name="email" value="" required>
									<div class="invalid-feedback">
										형식에 맞게 이메일을 입력해주세요
									</div>
								</div>

								<div class="mb-3">
									<label class="mb-2 text-muted" for="password">비밀번호</label>
									<input id="password" type="password" class="form-control" name="password" required>
								    <div class="invalid-feedback">
										비밀번호가 빈칸입니다
							    	</div>
								</div>

								<p class="form-text text-muted mb-3">
									회원가입시 개인정보 수집 및 이용에 동의합니다.
								</p>

								<div class="align-items-center d-flex">
									<button type="submit" class="btn btn-primary ms-auto">
										회원가입	
									</button>
								</div>
							</form>
						</div>
						<div class="card-footer py-3 border-0">
							<div class="text-center">
								계정이 있으신가요? <a href="index.php" class="text-dark">로그인</a>
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
