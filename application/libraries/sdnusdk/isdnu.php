<?php
session_start();
include_once('config.php');
include_once('../isdnusdk/isdnu_sdk.class.php');


$f = file_get_contents('http://i.sdnu.edu.cn/oauth/access_token?oauth_consumer_key=6474b65407789f7935b0cca7f95678ef&oauth_nonce=00000100001000000000000000000000&oauth_signature=sintune-sdnu-flea&oauth_signature_method=HMAC-SHA1&oauth_timestamp=1427780414&oauth_token=4c0b9febf4704c26a4b17ce4a684a389&oauth_verifier=0a8e04143ca1589b2b86752a4b4ade2281e2e818&oauth_version=1.0');

print_r($f);

/*
print_r($_SESSION);
echo '<hr>';
$rc = new RestClient(ISDNU_CONSUMER_KEY, ISDNU_CONSUMER_SECRET, 
  $_SESSION['request_token']['oauth_token'], $_SESSION['request_token']['oauth_token_secret']);
print_r($rc->user_get());
*/

$client = new OAuthClient(ISDNU_CONSUMER_KEY, ISDNU_CONSUMER_SECRET);
$request_token = $client->getRequestToken(ISDNU_CALLBACK_URL);

if (!empty($request_token['oauth_token'])) {
    //存储Request Token状态供其他页面使用
    $_SESSION['request_token'] = $request_token;
}


$authroize_url = $client->getAuthorizeURL($request_token['oauth_token'], ISDNU_CALLBACK_URL, true);


?>
<script type="text/javascript">
    //回调页面可以通过JS获取令牌验证码再跳转
    if (location.href.indexOf('#') >= 0) {
        location.href = location.href.replace('#', '?'); 
    }
</script>
<?php 

print_r([$_REQUEST['oauth_verifier'], $_REQUEST['oauth_token']]);
echo '<hr>';

$request_token = $_SESSION['request_token'];//获取之前存储的请求令牌
$client = new OAuthClient(ISDNU_CONSUMER_KEY, ISDNU_CONSUMER_SECRET, $request_token['oauth_token'], $request_token['oauth_token_secret']);
$access_token = $client->getAccessToken($_REQUEST['oauth_verifier'], $_REQUEST['oauth_token']);

print_r($access_token);
die;

if (!empty($access_token['oauth_token'])) {
    //存储Access Token状态供其他页面使用
    $_SESSION['access_token'] = $access_token;
}

print_r($_SESSION);
die;

$request_token = $_SESSION['access_token'];//获取之前存储的访问令牌
$client = new RestClient(ISDNU_CONSUMER_KEY, ISDNU_CONSUMER_SECRET, $request_token['oauth_token'], $request_token['oauth_token_secret']);
$userinfo = $client->user_get();

if ($userinfo['errorCode']) {
    echo "获取失败，错误代码 ".$userinfo['errorCode']."<br/>";
}
else {
    foreach ($userinfo as $k => $v) {
        echo $k."=".$v."<br/>";
    }
}

