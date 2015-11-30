<?php require_once(dirname(str_replace("\\", "/", __FILE__)) . '/facebook/facebook.php');

/**
 * Social Network Service Library for Codeigniter
 *
 * 소셜 네트워크 서비스 API 연동 라이브러리
 */
class Sns {
	private $ci;

	public function __construct()
	{
		// 프레임워크 인스턴스 얻음
		$this->ci =& get_instance();
	}

	/**
     * Twitter Wrapper 클래스 인스턴스 생성
	 * @return		object				Twitter Wrapper 인스턴스
     */
	public function twitter()
	{
		// 트위터 라이브러리 로드
		$this->ci->load->library('tweet');

		$twitter = new TwitterWrapper($this->ci);
		return $twitter;
	}

	/**
     * Facebook Wrapper 클래스 인스턴스 생성
	 * @return		object				Facebook Wrapper 인스턴스
     */
	public function facebook()
	{
		$facebook = new FacebookWrapper($this->ci);
		return $facebook;
	}
}

/**
 * Twitter API Wrapper Class
 */
class TwitterWrapper {
	// 트위터 라이브러리 인스턴스
	private $tweet;

	// OAuth 인증 후 리다이렉션 할 콜백 url 주소
	private $callback = null;

	/**
     * 클래스 생성자
	 * @param		object	$ci		프레임워크 인스턴스
     */
	public function __construct(&$ci)
	{
		$this->tweet = $ci->tweet;

		// 디버그 모드 활성화
		$this->tweet->enable_debug(true);
	}

	/**
     * 트위터 로그인 인증
     */
	public function login()
	{
		if (!is_null($this->callback)) {
			if ($this->tweet->logged_in() === false) {
				$this->tweet->set_callback($this->callback);
				$this->tweet->login();
			}
		} else {
			throw new SnsException('You should set callback URL to move after authorization.');
		}
	}

	/**
     * 트위터 로그아웃
     */
	public function logout()
	{
		$this->tweet->logout();
	}

	/**
     * 로그인 여부 반환
	 * @return		boolean								로그인 여부
     */
	public function isLoggedIn()
	{
		return $this->tweet->logged_in();
	}

	/**
     * 현재 로그인한 사용자의 정보를 반환
	 * @return		object				사용자 정보 객체
     */
	public function getAccountInfo()
	{
		return $this->tweet->call('get', 'account/verify_credentials');
	}

	/**
     * 트윗 전송
	 * @param		string	$statusMessage		상태 메세지
     */
	public function tweet($statusMessage)
	{
		$this->tweet->call('post', 'statuses/update', array('status' => $statusMessage));
	}

	/**
     * OAuth 인증 후 리다이렉션 할 콜백 url 지정
	 * @param		string	$callback				콜백 url
     */
	public function setCallback($callback)
	{
		$this->callback = $callback;
	}

	/**
     * 문자열 자르기
	 * 트위터는 한글, 영문, 숫자, 특수문자 바이트 수 상관없이 글자수로 140자 까지 저장
	 *
	 * @param		string	$string				자를 문자열
	 * @param		int		$limit						문자열을 자를 제한 길이
	 * @param		string	$tail							잘린 문자열 뒤에 연결할 문자
	 * @return		string									잘린 문자열
     */
	public function cutString($string, $limit = 140, $tail = '')
	{
		$cut = mb_substr($string, 0, $limit);
		return $cut  . $tail;
	}
}

/**
 * Facebook API Wrapper Class
 *
 */
class FacebookWrapper {
	// 페이스북 라이브러리 인스턴스
	private $fb;

	// OAuth 인증 후 리다이렉션 할 콜백 url 주소
	private $callback = null;

	// Graph API를 통하여 데이터 요청시 반환값이 없다면 권한을 반드시 체크
	private $permissions = 'user_photos,publish_stream'; // ,로 구분

	public function __construct(&$ci)
	{
		// url 헬퍼 로드
		$ci->load->helper('url');

		// 페이스북 환경설정 파일 로드
		$ci->config->load('facebook');

		// 페이스북 인스턴스 생성
		$this->fb = new Facebook(
			array(
				'appId' => $ci->config->item('facebook_app_id'),
				'secret' => $ci->config->item('facebook_app_secret_code')
			)
		);
	}

	/**
     * 페이스북 로그인 페이지로 이동
     */
	public function login()
	{
		if (!$this->isLoggedIn()) {
			header('Location: ' . $this->getLoginUrl());
		}
	}

	/**
     * 페이스북 로그아웃 페이지로 이동
     */
	public function logout($param=Array())
	{
		header('Location: ' . $this->getLogoutUrl($param));
	}

	/**
     * 로그인 url 반환
	 * 로그인 후 콜백 url이 현재 페이지로 지정되어 있는 것을 강제로 사용자가 지정한 url로 치환
	 * @return		string									url
     */
	public function getLoginUrl()
	{
		if (!is_null($this->callback)) {
			$explode = explode('?', $this->fb->getLoginUrl(array('scope' => $this->permissions)));
			$items = explode('&', $explode[1]);

			$querystring = array();

			foreach ($items as $item) {
				list($key, $val) = explode('=', $item);

				if (!strcmp($key, 'redirect_uri')) $querystring[] = $key . '=' . urlencode($this->callback);
				else $querystring[] = $key . '=' . $val;
			}

			$uri = $explode[0] . '?' . implode('&', $querystring);

			return $uri;
		} else {
			throw new SnsException('You should set callback URL to move after authorization.');
		}
	}

	/**
     * 로그아웃 url 반환
	 * @return		string									url
     */
	public function getLogoutUrl($param=Array())
	{
		return $this->fb->getLogoutUrl($param);
	}

	/**
     * 로그인 여부 반환
	 * @return		boolean								로그인 여부
     */
	public function isLoggedIn()
	{
		return !is_null($this->getAccountInfo());
	}

	/**
     * 사용자 정보 반환
	 * @return		array									사용자 정보
     */
	public function getAccountInfo()
	{
		if ($this->fb->getUser()) {
			try {
				return $this->fb->api('/me');
			} catch (FacebookApiException $e) {
				return null;
			}
		}
	}

	/**
     * 포스트 메세지 등록
	 * @param		string	$statusMessage		메세지 내용
     */
	public function post($statusMessage)
	{
		$this->fb->api('/me/feed', 'post', array('message' => $statusMessage));
	}

	/**
     * 권한 목록
	 * @return		array									사용자가 허용중인 권한 목록
     */
	public function getPermissions()
	{
		return $this->fb->api('/me/permissions');
	}

	/**
     * 사진첩 목록
	 * @return		array									사진첩 목록
     */
	public function getAlbums()
	{
		return $this->fb->api('/me/albums');
	}

	/**
     * 사진첩 생성
	 * @param		string	$name					사진첩 이름
	 * @param		string	$message				사진첩 메세지(타이틀)
	 * @param		string	$description			사진첩 설명
	 *
	 * @return		int										사진첩 id
     */
	public function createAlbum($name, $message, $description)
	{
		$detail = array('message' => $name, 'name' => $message);
		$album = $this->fb->api(
			'/me/albums',
			'post',
			array(
				'name' => $name,
				'message' => $message,
				'description' => $description
			)
		);

		return $album['id'];
	}

	/**
     * 사진 업로드
	 * @param		string	$message				사진 내용
	 * @param		string	$file							업로드할 사진 파일의 절대경로
	 * @param		int		$albumId				사진첩 id(값이 없을 경우 기본 사진첩에 등록)
     */
	public function uploadPhoto($message, $file, $albumId = 'me')
	{
		$this->fb->setFileUploadSupport(true);
		$this->fb->api(
			'/' . $albumId . '/photos',
			'post',
			array(
				'message' => $message,
				'image' => '@' . realpath(str_replace("\\", "/", $file))
			)
		);
	}

	/**
     * 인증 후 리다이렉션 할 콜백 url 지정
	 * @param		string	$callback				콜백 url
     */
	public function setCallback($callback)
	{
		$this->callback = $callback;
	}
}

/**
 * Social Network Service Exception Class
 */
class SnsException extends Exception {
	public function __construct($msg)
	{
		parent::__construct($msg);
	}

	public function __toString()
	{
		return "Exception(" . __CLASS__ . ") : " . $this->getMessage() . " thrown in " . $this->getFile() . " on line " . $this->getLine();
	}
}