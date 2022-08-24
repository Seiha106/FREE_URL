<?php
require_once("system/load_page.php"); // 로드페이지
error_reporting(E_ERROR | E_WARNING);

// encrypt("test");
// decrypt("s2%2FokJr5J%2BGsfFB%2BlLZqIw%3D%3D");
// register_user("test_id", "test_email", "test_passwrd", "type", "permission");
// vertify_email("test_id", "mpng94Ceoe9oQIwoSOWjQSZlswm7jB");
// find_user("id", "test_id");
// login_user("id", "pw");x`
// update_user_data("id", "id1", "email", "windows6587@naver.com");
// reset_password_user("id", "id1");
// check_passwordkey("id1", "FkittBMsVGdUABXxATWWyb0OPiOgtY");
// insert_short_url("https://google.com", "keywoord", "id1");
// find_short_url("keyword", "keywoord")['agent'];
// delete_short_url("keyword", "keywoord");

session_start();

?>
<!DOCTYPE html>
<html lang="ko">
<head>
	<meta charset="utf-8">
	<title>메인페이지</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
	<link href="system/style.css" rel="stylesheet">
</head>

<body>
	<section class="h-100">
		<div class="container h-100">
			<div class="row justify-content-sm-center h-100">
				<div class="col-xxl-4 col-xl-5 col-lg-5 col-md-7 col-sm-9">
					<div class="text-center my-5">
						<h1>메인페이지</h1>
					</div>
					<div class="card shadow-lg">
						<div class="card-body p-5">
							<h1 class="fs-4 card-title fw-bold mb-4">메인페이지</h1>

							<form method="POST" class="needs-validation" novalidate="" action="system/short_url.php" autocomplete="off">

								<div class="mb-3">
									<label class="mb-2 text-muted" for="url">URL</label>
									<input id="url" type="url" class="form-control" name="url" value="" required autofocus>
								</div>

                                <div class="mb-3">
									<label class="mb-2 text-muted" for="keyword">keyword</label>
									<input id="keyword" type="keyword" class="form-control" name="keyword" value="" required autofocus>
								</div>

								<div class="d-flex align-items-center">
									<button type="submit" class="btn btn-primary ms-auto">
										단축
									</button>
								</div>

                                <br><br>
                                <div class="card">
                                    <div class="card-body">
                                       <?php
                                            $session_user_id = $_SESSION['user_data_id'];

                                            if(empty($session_user_id)){
                                                echo "<a href=\"system/login\">로그인</a>";
                                            }else{
                                                echo "<a href=\"system/login/post/logout.php\">로그아웃 ($session_user_id)</a>";
                                            }
                                       ?>
                                    </div>
                                </div>

							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

</body>
</html>
