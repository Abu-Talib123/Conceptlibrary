
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Cart extends CI_Controller {
  public function __construct()
  {
      parent::__construct();
      if(!$this->session->userdata('CL_STUDENT_ID') || $this->session->userdata('CL_STUDENT_ID')=='')
      {
      redirect(base_url().'login');
      }
      //$this->load->library('razorpay');
      $this->load->model('cart_model');
      $this->load->model('video_model');
      $this->load->model('payment_model');
      $this->load->model("student_model", 'student_model');
  }
 
 function index()
 {
  $data['page_title'] = 'Concept Library';
  $data['sub_title']  = 'Product Review';
  $data['load_js']    = 'cart';
  $data['cartdata']   = $this->cart_model->fetch_cart($this->session->userdata('CL_STUDENT_ID'));
  $data['load_view']  = 'cart_review';
  $this->load->view('template', $data);
 }

 function add()
 {
    $subcategory_id   = @$this->input->post('subcategory_id');
    $domain_type      = @$this->input->post('product_type');
    $fetch_paiddomain = $this->video_model->fetch_paidvideobysubcat($_POST['subcategory_id']);
   // print_r( $fetch_paiddomain ); exit;
    if($fetch_paiddomain['status']==1)
     {
        $data['subcategory_id']    =  $fetch_paiddomain['subcategory_id']; 
        $data['student_id']        =  $this->session->userdata('CL_STUDENT_ID');
        $data['subcategory_name']  =  $fetch_paiddomain['subcategory_name'];
        if($domain_type == 'mock'){
            $data['subcategory_price'] =  $fetch_paiddomain['m_price'];
            if($fetch_paiddomain['m_offer_price'] > 0) {
                $data['subcategory_price'] =  $fetch_paiddomain['m_offer_price']; 
            }  
        }else{
            $data['subcategory_price'] =  $fetch_paiddomain['price'];
            if($fetch_paiddomain['offer_price'] > 0) {
                $data['subcategory_price'] =  $fetch_paiddomain['offer_price']; 
            }
        }
        
        
        $data['domain_type']       =  $domain_type;
        $data['status']            =  1;
        $studentcart               = $this->cart_model->insert_cart($data);
     }
  
    $this->index();
 }
 function add_total()
 {
    $subcategory_id   = @$this->input->post('material_id');
    $domain_type      = @$this->input->post('product_type');
    $domaincount      = count($subcategory_id);
    $student_id       =  $this->session->userdata('CL_STUDENT_ID');
    for($i=0;$i<$domaincount;$i++)
    {
       $fetch_paiddomain = $this->video_model->fetch_paidvideobysubcat($_POST['material_id'][$i]);
       $paymentChecking = $this->video_model->check_payment($_POST['material_id'][$i], $student_id, $domain_type);
      $cartChecking = $this->video_model->check_cart($_POST['material_id'][$i], $student_id, $domain_type);
       if($fetch_paiddomain['status']==1 && $paymentChecking ==0 && $cartChecking == 0)
       {
          $data['subcategory_id']    =  $fetch_paiddomain['subcategory_id']; 
          $data['student_id']        =  $this->session->userdata('CL_STUDENT_ID');
          $data['subcategory_name']  =  $fetch_paiddomain['subcategory_name'];
          $data['subcategory_price'] =  $fetch_paiddomain['price'];
            if($domain_type == 'mock'){
            $data['subcategory_price'] =  $fetch_paiddomain['m_price'];
                if($fetch_paiddomain['m_offer_price'] > 0) {
                    $data['subcategory_price'] =  $fetch_paiddomain['m_offer_price']; 
                }  
            }else{
                $data['subcategory_price'] =  $fetch_paiddomain['price'];
                if($fetch_paiddomain['offer_price'] > 0) {
                    $data['subcategory_price'] =  $fetch_paiddomain['offer_price']; 
                }
            }
          $data['domain_type']       =  $domain_type;
          $data['status']            =  1;
          $studentcart               = $this->cart_model->insert_cart($data);
       }
     
    }
   
   // $this->index();
 }

 function load()
 {
  echo $this->view();
 }

 function remove()
 {
  $row_id       = $_POST["row_id"];
  $updatestatus = $this->cart_model->update_cart($row_id);
 
 }

 function clear()
 {
   $this->db->empty_table('cart'); 
 }
 
 function view()
 {
  $this->index();
 }

 function proceed_payment()
  {
    $codedata=array();
    $get_lastdetails =  $this->payment_model->fetch_lastdetails();
     if($get_lastdetails->num_rows()>0)
    {
      foreach($get_lastdetails->result_array() as $row)
      {
        $codedata['payment_id'] = $row['payment_id'];
        $alpha =  substr($codedata['payment_id'],0,2);
        $number = (int) substr($codedata['payment_id'],2,strlen($codedata['payment_id'])-1)+1;
         }
       $paymentid = $alpha.STR_PAD((string)$number,2,"0",STR_PAD_LEFT);

    }
    else
    {
      $paymentid= 'PA'.date('ymd').'01';
    }
    
    $material_id     =  @$this->input->post('material_id');
    $materialcount   = count( $material_id);
        for($i=0;$i<$materialcount;$i++)
        {
          $postdata['student_id']      = $this->session->userdata('CL_STUDENT_ID');
          $postdata['payment_id']      = $paymentid;
          $postdata['material_id']     =  $_POST['material_id'][$i];
          $postdata['material_type']   =  $_POST['material_type'][$i];
          $postdata['price']           =  $_POST['material_price'][$i];
          $postdata['paymentstatus']   =  1;
          $postdata['payment_date']    = date('Y-m-d H:i:s');
          $check_payment = $this->payment_model->check_payment($postdata['student_id'], $postdata['material_id'], $postdata['material_type']);
          if(!$check_payment){
            $paymentdetail               = $this->payment_model->insert_payment($postdata);
            //$updatecartdetail         = $this->cart_model->delete_cart($postdata['material_id'],$postdata['student_id']);
            if($paymentdetail)
            {
               //$this->cart->destroy();
               $result['resultCode']   = 1;
               $result['payment_id']   = $paymentid;
              //$result['material_id']= $postdata['material_id'];
            }else{
                $result['resultCode'] = 0;
            }
         }else{
             $result['resultCode']   = 1;
               $result['payment_id']   = $check_payment['payment_id'];
         }
        }
    echo json_encode($result);
  }

  function checkout()
  {

        $data['page_title']         = 'ConceptLibrary|  Payment Gateway';  
        $data['sub_title']     = 'ConceptLibrary|  Payment Gateway';
        $payment_id            =  $this->uri->segment(3);
        $data['itemInfo']      =  $this->payment_model->fetch_paymentdetails($payment_id);
        $data['return_url']    = site_url().'cart/callback';
        $data['surl']          = site_url().'cart/success';;
        $data['furl']          = site_url().'cart/failed';;
        $data['currency_code'] = 'INR';
        $data['load_view']     = 'after_payment';
        $this->load->view('template', $data);

  }


  // initialized cURL Request
    private function get_curl_handle($payment_id, $amount)  {
        $url = 'https://api.razorpay.com/v1/payments/'.$payment_id.'/capture';
        $key_id = RAZOR_KEY_ID;
        $key_secret = RAZOR_KEY_SECRET;
        $fields_string = "amount=$amount";
        //cURL Request
        $ch = curl_init();
        //set the url, number of POST vars, POST data
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_USERPWD, $key_id.':'.$key_secret);
        curl_setopt($ch, CURLOPT_TIMEOUT, 60);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
        curl_setopt($ch, CURLOPT_CAINFO, dirname(__FILE__).'/ca-bundle.crt');
        return $ch;
    }   
        
    // callback method
    public function callback() {

        if (!empty($this->input->post('razorpay_payment_id')) && !empty($this->input->post('merchant_order_id'))) {
            $razorpay_payment_id = $this->input->post('razorpay_payment_id');
            $merchant_order_id = $this->input->post('merchant_order_id');
            $currency_code = 'INR';
            $amount = $this->input->post('merchant_total');
            $success = false;
            $error = '';
            try {                
                $ch = $this->get_curl_handle($razorpay_payment_id, $amount);
                //execute post
                $result = curl_exec($ch);
                $http_status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
                if ($result === false) {
                    $success = false;
                    $error = 'Curl error: '.curl_error($ch);
                } else {
                    $response_array = json_decode($result, true);
                   // print_r( $response_array); exit;
                    $this->updatepaymentdetails($response_array,$merchant_order_id);
                   // echo "<pre>";print_r($response_array);exit;
                        //Check success response
                        if ($http_status === 200 and isset($response_array['error']) === false) {
                            $success = true;
                        } else {
                            $success = false;
                            if (!empty($response_array['error']['code'])) {
                                $error = $response_array['error']['code'].':'.$response_array['error']['description'];
                            } else {
                                $error = 'RAZORPAY_ERROR:Invalid Response <br/>'.$result;
                            }
                        }
                }
                //close connection
                curl_close($ch);
            } catch (Exception $e) {
                $success = false;
                $error = 'OPENCART_ERROR:Request to Razorpay Failed';
            }
            if ($success === true) {
                if(!empty($this->session->userdata('ci_subscription_keys'))) {
                    $this->session->unset_userdata('ci_subscription_keys');
                 }
                if (!$razorpay_payment_id ) {
                    redirect($this->input->post('merchant_surl_id'));
                } else {
                    redirect($this->input->post('merchant_surl_id'));
                }

            } else {
                redirect($this->input->post('merchant_furl_id'));
            }
        } else {
            echo 'An error occured. Contact site administrator, please!';
        }
    } 
    function updatepaymentdetails($result,$paymentid)
    {

        $data       = $result;
        $razorpayid = $data['id'];
        $paymentid  = $paymentid;
        $paymentstatus = 2;
        $studentid  = $this->session->userdata('CL_STUDENT_ID');
        $updatepaymentdetails  = $this->payment_model->update_paymentdata($razorpayid,$paymentid,$paymentstatus);
        if($updatepaymentdetails){
          $payment_status['payment_status']  = 1;
          $res                 = $this->student_model->update_paymentstatus($student_id,$payment_status);
          $updatecartdetail    = $this->cart_model->delete_cart($studentid);
          if($res)
          {
            $this->success();
          }
        }

    }
    public function success() {
        $data['page_title'] = 'ConceptLibrary'; 
        $data['sub_title'] = 'Payment Success';
        $data['load_view'] = 'razorpay/success';  
        $this->load->view('template', $data);
    }  
    public function failed() {

        $data['page_title'] = 'ConceptLibrary'; 
        $data['sub_title'] = 'Payment Success';
        $data['load_view'] = 'razorpay/failed';  
        $this->load->view('template', $data);
    } 

}

