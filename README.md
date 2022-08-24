# FREE_URL
긴URL을 짧게 줄여주는 시스템입니다

# 설치 방법
`system/set_config.php` 파일을 열어, DB정보와 이메일정보를 입력하고 `set_config.php`를 실행합니다
실행시 DB사용가능 여부를 확인하고 DB테이블을 생성합니다
DB테이블 생성후 config.php에 DB정보와 이메일정보를 저장합니다

# 실행환경
- IIS 10.X (Apache 사용시 `web.config` 데이터를 `.htaccess`로 변환해야합니다)
- PHP 7.4.28 (`mysqli()`를 필수적으로 사용할 수 있어야합니다)
- MySQL
- 그외 다른 환경에서 테스트를 해본적이 없어, 작동하지 않을 수 있습니다
