<?php
include_once(__DIR__ . '/config.php');
include_once(__DIR__ . '/isdnu_sdk.class.php');
class Sdnusdk extends CI_Controller {
    public function authorize() {
        $client = new OAuthClient(ISDNU_CONSUMER_KEY, ISDNU_CONSUMER_SECRET);
        $request_token = $client->getRequestToken(ISDNU_CALLBACK_URL);
        if (!empty($request_token['oauth_token'])) {
            $authroize_url = $client->getAuthorizeURL($request_token['oauth_token'], ISDNU_CALLBACK_URL, true);
            //$_SESSION['request_token'] = $request_token;
            $this->session->set_userdata('request_token', $request_token);
            header('Location: '.$authroize_url);
        } else {
            // authorize error
			if (!empty($request_token['error_code'])) {
		        echo "Error Code: ".$request_token['error_code'];
		        echo "Error Type: ".$request_token['error_type'];
		        echo "Error Description: ".$request_token['error_description'];
		    }
		    else {
		        echo $request_token;
		    }
        }
    }
    public function callback() {
        ?>
<script type="text/javascript">
    if (location.href.indexOf('#') >= 0) {
        location.href = location.href.replace('#', '?');
    }
</script>
        <?php
        //$request_token = $_SESSION['request_token'];
        $request_token = $this->session->userdata('request_token');
        $client = new OAuthClient(ISDNU_CONSUMER_KEY, ISDNU_CONSUMER_SECRET, $request_token['oauth_token'], $request_token['oauth_token_secret']);
        //$access_token = $client->getAccessToken($_REQUEST['oauth_verifier'], $_REQUEST['oauth_token']);
        $access_token = $client->getAccessToken($this->input->get('oauth_verifier'), $this->input->get('oauth_token'));

        if (!empty($access_token['oauth_token'])) {
            //$_SESSION['access_token'] = $access_token;
            $this->session->set_userdata('access_token', $access_token);
            //echo "<script>location.href='index.php';</script>";
        } else {
            // callback error
            if (!empty($access_token['error_code'])) {
			    echo "Error Code: ".$request_token['error_code'];
			    echo "Error Type: ".$request_token['error_type'];
			    echo "Error Description: ".$request_token['error_description'];
			} else {
				echo 'access token error code null';
			}
        }
    }
    public function getinfo() {
        //$request_token = $_SESSION['access_token'];
        $request_token = $this->session->userdata('access_token');
        $client = new RestClient(ISDNU_CONSUMER_KEY, ISDNU_CONSUMER_SECRET, $request_token['oauth_token'], $request_token['oauth_token_secret']);
        $userinfo = $client->user_get();
        $people = $client->people_get();
        $info = $userinfo + $people;
        $data['user_id'] = $info['userID'];
        $data['user_type'] = $info['userType'];
        $data['bind_cellphone'] = $info['bindCellphone'];
        $data['bind_email'] = $info['bindEmail'];
        $data['identity_number'] = $info['identityNumber'];
        $data['name'] = $info['name'];
        $data['id_card_number_hash'] = $info['idCardNumberHash'];
        $data['sex'] = $info['sex'];
        $data['nation'] = $info['nation'];
        $data['organization_id'] = $info['organizationID'];
        $data['organization_name'] = $info['organizationName'];
        return $data;
    }
}
