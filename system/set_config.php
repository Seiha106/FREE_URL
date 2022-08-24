<?php
$setup = "true"; //true of false
$use_db = "true"; // true or false
$db_name = "##DB_NAME##"; // DB 이름
$db_id = "##DB_ID##"; // MySQL 아이디
$db_password = "##DB_PASSWORD##"; // MySQL 비밀번호
$db_address = "##DB_ADDRESS##"; // MySQL 서버 IP주소
$encrypt_key = "##ENCRYPT_KEY##"; // 암호화 키
$mail_smtp = "##MAIL_SMTP##"; // 메일 서버 주소 (SMTP)
$mail_username = "##MAIL_USERNAME##"; // 메일서버 ID
$mail_password = "##MAIL_PASSWORD##"; // 메일서버 비밀번호
$mail_from = "##FROM_MAIL##"; // 발송 메일 주소

if($setup == "true"){
    // SetUp 시작
    if(empty($encrypt_key)){
        // $encrypt_key가 비어있을 경우
        echo "암호화 키가 비어있습니다, 안전한 시스템 구성을 위해 암호화키를 입력해주세요";
        exit;
    }else{
        // $encrypt_key가 안비어 있을경우
        require("module.php"); // 모듈 로드
        $test_enc_data = "1234567890"; // 암호화키를 테스할 데이터
        $test_enc = encrypt($test_enc_data, $encrypt_key); // 암호화키 테스트 암호화
        $test_dec = decrypt($test_enc, $encrypt_key); // 암호화키 테스트 복호화

        if($test_dec !== $test_enc_data){
            // 암호화키를 사용할 수 없을때
            echo "암호화키 설정을 실패했습니다 다른 암호화키를 사용해주세요";
            exit;
        }

    }
    if($use_db == "true"){
        // DB를 사용할 경우
        $connect_check_db = mysqli_connect($db_address, $db_id, $db_password, $db_name);
        if($connect_check_db){
            // DB 사용 가능할 경우
            $query_table_generator = "CREATE TABLE `short_url` (
                `id` int NOT NULL,
                `date` text NOT NULL,
                `url` text NOT NULL,
                `keyword` text NOT NULL,
                `user` text NOT NULL,
                `ip` text NOT NULL,
                `agent` text NOT NULL,
                `clicks` text NOT NULL
              ) ENGINE=InnoDB DEFAULT CHARSET=utf8;"; // DB 테이블 생성 (short_url)

            $query_index = "ALTER TABLE `short_url`
            ADD PRIMARY KEY (`id`);"; // DB 인덱스 설정 (short_url)

            $query_auto_increment = "ALTER TABLE `short_url` CHANGE `id` `id` INT NOT NULL AUTO_INCREMENT;;"; // DB 자동증가 설정

            $query_user_table_generator = "CREATE TABLE `user` (
                `id` VARCHAR(255)  NOT NULL,
                `email` text NOT NULL,
                `register_date` text NOT NULL,
                `password` text NOT NULL,
                `type` text NOT NULL,
                `permission` text NOT NULL, 
                `vertify_email` text NOT NULL, 
              ) ENGINE=InnoDB DEFAULT CHARSET=utf8;"; // DB 테이블 생성 (user)

            $query_user_index = "ALTER TABLE `user` ADD PRIMARY KEY(`id`); "; // DB 테이블 생성 (user)

            mysqli_query($connect_check_db, $query_table_generator); // DB 테이블 생성 쿼리($query_table_generator) 처리
            mysqli_query($connect_check_db, $query_index); // DB 인덱스 설정 쿼리($query_index) 처리
            mysqli_query($connect_check_db, $query_auto_increment); // DB 자동증가 쿼리 쿼리($query_auto_increment) 처리
            mysqli_query($connect_check_db, $query_user_table_generator); // DB 테이블 생성 쿼리($query_user_table_generator) 처리
            mysqli_query($connect_check_db, $query_user_index); // DB 인덱스 설정 쿼리($query_user_index) 처리

            echo "시스템 작동에 필요한 DB를 생성했습니다";
            
            // 모든 작업을 적상적으로 완료했을경우 config 생성
            $generate_config = fopen("config.php", "a") or die("컨픽을 생성할 수 없습니다");
            fwrite($generate_config, "\n");
            fwrite($generate_config, '$install_finished = "true";');
            fwrite($generate_config, "\n");
            fwrite($generate_config, '$use_db = "true";');
            fwrite($generate_config, "\n");
            fwrite($generate_config, '$db_name = "'.$db_name.'";');
            fwrite($generate_config, "\n");
            fwrite($generate_config, '$db_id = "'.$db_id.'";');
            fwrite($generate_config, "\n");
            fwrite($generate_config, '$db_password = "'.$db_password.'";');
            fwrite($generate_config, "\n");
            fwrite($generate_config, '$db_address = "'.$db_address.'";');
            fwrite($generate_config, "\n");
            fwrite($generate_config, '$encrypt_key = "'.$encrypt_key.'";');
            fwrite($generate_config, "\n");
            fwrite($generate_config, '$mail_smtp = "'.$mail_smtp.'";');
            fwrite($generate_config, "\n");
            fwrite($generate_config, '$mail_username = "'.$mail_username.'";');
            fwrite($generate_config, "\n");
            fwrite($generate_config, '$mail_password = "'.$mail_password.'";');
            fwrite($generate_config, "\n");
            fwrite($generate_config, '$mail_from = "'.$mail_from.'";');
            fclose($generate_config);

        }else{
            // DB 사용이 불가능할 경우
            echo "DB에 연결할 수 없습니다 (DB이름, DB아이디, DB비밀번호, DB주소를 체크하세요)";
            exit;
        }
        }else{
            if($use_db == "false"){
            // DB를 안사용할경우
            $generate_config = fopen("config.php", "a") or die("컨픽을 생성할 수 없습니다");
            fwrite($generate_config, "\n");
            fwrite($generate_config, '$install_finished = "true";');
            fwrite($generate_config, "\n");
            fwrite($generate_config, '$use_db = "false";');
            fwrite($generate_config, "\n");
            fwrite($generate_config, '$encrypt_key = "'.$encrypt_key.'";');
            fclose($generate_config);
            }
        }
}else{
    // SetUp 안함
    echo "설치 프로그램 시작을 안하셨습니다";
}