<?php
class MY_Controller extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('MY_Model','common_obj');
        $this->load->helper('stripe_helper');
        /*$result = $this->common_obj->getAllRows('tbl_notification_messages');

        foreach( $result as $row)
        {
            define($row->accessKey,$row->message);
        }*/
    }

    public function login_username()
    {
        $session_data = $this->session->userdata('admin_session');
        return $session_data->firstName." ".$session_data->lastName;
    }

    public function login_adminId()
    {
        $session_data = $this->session->userdata('admin_session');
        return $session_data->id;   
    }

    public function upload_image($file_name,$image_path)
    {
        $this->load->library('upload');
        $image_name = time().$file_name.'.png';//$_FILES[$file_name]['name'];
        $front_config = array(
            'allowed_types' => '*',
            'upload_path' => './uploads/'.$image_path,
            // 'max_size' => '20000',
            'overwrite' => TRUE,
            'file_name' => $image_name,
            // 'max_size' => '1000000',
            // 'max_width'  => '1024000',
            // 'max_height'  => '768000'

        );
        $this->upload->initialize($front_config);
        $this->upload->do_upload($file_name);
        $imageData = $this->upload->data();

        // $errors = $this->upload->display_errors();
        // print_r($errors);
        $source_path = './uploads/'.$image_path.'/'.$image_name;
        $target_path = './uploads/'.$image_path.'/thumb/';

        $config_manip = array(
            'image_library' => 'gd2',
            'source_image' => $source_path,
            'new_image' => $target_path,
            // 'maintain_ratio' => TRUE,
            // 'create_thumb' => TRUE,
            // 'thumb_marker' => '_thumb',
            // 'width' => 250,
            // 'height' => 250
        );
        $this->load->library('image_lib', $config_manip);
        $this->image_lib->initialize($config_manip);
        if (!$this->image_lib->resize()) {
             $this->image_lib->display_errors();
        }
        // clear //
        $this->image_lib->clear();
       // echo "<pre>";print_r($imageData);die;
        return $image_name;
    }
    public function file_upload($file_name,$file_path,$type)
    {
        $this->load->library('upload');
        $image_name = time().$file_name.'.'.$type;
        $front_config = array(
            'allowed_types' => '*',
            'upload_path' => './uploads/'.$file_path,
            'overwrite' => TRUE,
            'file_name' => $image_name,
        );
        $this->upload->initialize($front_config);
        $this->upload->do_upload($file_name);
        return $image_name;
    }

    public function upload_image_thumb($file_name, $type,$image_path)
    {
        $this->load->library('upload');
        if($type == 'image/jpeg')
        {
            $image_name = time().$file_name.'.jpg';//$_FILES[$file_name]['name'];
        }
        else
        {
            $image_name = time().$file_name.'.png';//$_FILES[$file_name]['name'];
        }

        // echo $image_name;die();
        $front_config = array(
            'allowed_types' => 'jpg|png|jpeg',
            'upload_path' => './uploads/'.$image_path,
            // 'max_size' => '20000',
            'overwrite' => TRUE,
            'file_name' => $image_name,
           /* 'max_size' => '1000000',
            'max_width'  => '1024000',
            'max_height'  => '768000'*/

        );
        $this->upload->initialize($front_config);
        $this->upload->do_upload($file_name);
         $errors = $this->upload->display_errors();
                    // print_r($errors);die();
        $imageData = $this->upload->data();
        $source_path = './uploads/'.$image_path.'/'.$image_name;
        $target_path = './uploads/'.$image_path.'/thumb/';

        $config_manip = array(
            'image_library' => 'gd2',
            'source_image' => $source_path,
            'new_image' => $target_path,
            'maintain_ratio' => TRUE,
            'create_thumb' => TRUE,
            'thumb_marker' => '',
            'width' => 50,
            'height' => 50
        );
        $this->load->library('image_lib', $config_manip);
        $this->image_lib->initialize($config_manip);
        if (!$this->image_lib->resize()) {
            echo $this->image_lib->display_errors();
        }
        // clear //
        $this->image_lib->clear();
       // echo "<pre>";print_r($imageData);die;
        return $image_name;
    }

    function upload_image_base64($image_data,$path)
    {
        $image_name = rand(1111,9999).time().'.png';
        $img = str_replace('data:image/png;base64,', '', $image_data);
        $img = str_replace(' ', '+', $img);
        $data = base64_decode($img);
        file_put_contents("./uploads/$path/$image_name", $data);

        if (!file_exists('./uploads/'.$path . '/thumb')) 
        {
            mkdir('./uploads/'.$path . '/thumb', 0777, true);
        }
        $source_path = FCPATH.'uploads/'.$path.'/' . $image_name;
        $target_path = FCPATH.'uploads/'.$path . '/thumb/';
        $config_manip = array(
            'image_library' => 'gd2',
            'source_image' => $source_path,
            'new_image' => $target_path,
            // 'maintain_ratio' => TRUE,
            // 'create_thumb' => TRUE,
            // 'thumb_marker' => '_thumb',
            'width' => 250,
            'height' => 250
        );
        $this->load->library('image_lib', $config_manip);
        $this->image_lib->initialize($config_manip);
        if (!$this->image_lib->resize()) {
            echo $this->image_lib->display_errors();
        }
        // clear //
        $this->image_lib->clear();

        return $image_name;
    }

    function encryptIt( $q ) {
        $cryptKey  = ADMIN_SALT;
        $qEncoded      = base64_encode( mcrypt_encrypt( MCRYPT_RIJNDAEL_256, md5( $cryptKey ), $q, MCRYPT_MODE_CBC, md5( md5( $cryptKey ) ) ) );
        return( $qEncoded );
    }

    function decryptIt( $q ) {
        $cryptKey  = ADMIN_SALT;
        $qDecoded      = rtrim( mcrypt_decrypt( MCRYPT_RIJNDAEL_256, md5( $cryptKey ), base64_decode( $q ), MCRYPT_MODE_CBC, md5( md5( $cryptKey ) ) ), "\0");
        return( $qDecoded );
    }

    function checkAccessToken($accessToken,$userId)
    {
        if ($userId!= 0) {
         $count = $this->common_obj->countRows('tbl_users', ['id' => $userId ]);
         if ($count == 0) {
            printResponse(array("message"=>"User not found","status"=>0));
             # code...
         }

        }
        // echo $accessToken;die();
        $count = $this->common_obj->countRows('tbl_users', ['id'=> $userId,'access_token' => $accessToken]);
        // echo $count;die;
        $checkDeletedUser = $this->common_obj->countRows('tbl_users', ['id'=> $userId,'access_token' => $accessToken,'is_deleted'=>'1']);
        $checkActiveUser = $this->common_obj->countRows('tbl_users', ['id'=> $userId,'access_token' => $accessToken,'status'=>'1']);
        if($count == 0)
        {
            printResponse(array("message"=>"Invalid Access Token","status"=>2));
        }
        else if($checkDeletedUser > 0)
        {
            printResponse(array("message"=>"Your account is deleted","status"=>2));
        }
        else if($checkActiveUser > 0)
        {
            printResponse(array("message"=>"Your account is inactive","status"=>2));
        }
    }

    function send_notification_single_device($userId,$message)
    {
        $userDetails = $this->common_obj->getSingleRow('tbl_users', ['userId'=>$userId], 'deviceToken', $orderby = NULL);
        $deviceToken = $userDetails->deviceToken;
        $fcmUrl = 'https://fcm.googleapis.com/fcm/send';
        $title = $message['title'];
        $body = $message['body'];
        $notification = [
            'title' =>$title,
            'body' => $body
        ];
        $extraNotificationData = ["message" => $message];

        $fcmNotification = [
            //'registration_ids' => $tokenList, //multple token array
            'to'        => $deviceToken, //single token
            'notification' => $notification,
            'data' => $extraNotificationData
        ];

        $headers = [
            'Authorization: key=' . API_accessKey,
            'Content-Type: application/json'
        ];


        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,$fcmUrl);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fcmNotification));
        $result = curl_exec($ch);
        curl_close($ch);
        echo $result;
    }

    function get_notification_value($accessKey)
    {
        $where = array(
            'accessKey'=>$accessKey
        );
        $data = $this->common_obj->getSingleRow('tbl_notification_messages', $where,'message', $orderby = NULL);

        return $data->message;
    }



      function send_notification_ios($tokens, $message)
{

    //echo "string";die();
    
    $url = 'https://fcm.googleapis.com/fcm/send';
    $fields = array (
    'registration_ids' => $tokens,
    // 'notification' => $message,
    'data' => $message,
    'notification' => $message
    );

    // echo "<pre>"; print_r($fields); die();

    $headers = array(
    'Authorization: key=' . API_accessKey,
    'Content-Type: application/json'
    );

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
    $result = curl_exec($ch);

    if ($result === FALSE) 
    {
    //die('Curl failed: ' . curl_error($ch));
    }
    // echo "<pre>"; print_r($fields);
    curl_close($ch);
    // return $result; 
    //echo "<pre>";
    //print_r($result); 
}



function send_notification_android($tokens, $message)
{
    // print_r($tokens);die;
    
    // $GOOGLE_API_KEY = "AAAAPY3WWaU:APA91bG0_4AgLRV4Qk0_9rzC0f0AR-2Efrp5leYfD9AVIO5fOAxE4IgzatE8y7tRuI14xQ6hOkUtCpvKBM2HRkhWCq0fvQpgaDlHqBBo5wJNYYIIN7-kNY-dXd3htymDQJBhbK9NQ9eC";

    $url = 'https://fcm.googleapis.com/fcm/send';
    $fields = array (
    'registration_ids' => $tokens,
    // 'notification' => $message,
    'data' => $message,
    'notification' => $message
    );

     // echo "<pre>"; print_r(json_encode($fields)); die();

    $headers = array(
    'Authorization: key=' . API_accessKey,
    'Content-Type: application/json'
    );

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
    $result = curl_exec($ch);

    if ($result === FALSE) 
    {
    //die('Curl failed: ' . curl_error($ch));
    }
    // echo "<pre>"; print_r($fields);
    curl_close($ch);
//   echo "<pre>";
    // print_r($result); 
    
}









}