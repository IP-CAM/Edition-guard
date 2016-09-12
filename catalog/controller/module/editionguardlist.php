<?php
/*
 * @support
 * http://www.opensourcetechnologies.com/contactus.html
 * sales@opensourcetechnologies.com
 * */
class ControllerModuleEditionGuardList extends Controller {
	public function index() {
		$url="http://www.editionguard.com/api/ebook_list";
		$secret = $this->config->get('editionguard_secret'); // Place your unique distributor shared secret,you can get this from the editionguard.com account
        $nonce = rand(1000000, 999999999); // Random nonce value
        $email = $this->config->get('editionguard_email'); //the editionguard.com account email address
        $hash = hash_hmac("sha1", $nonce.$email, base64_decode($secret)); // Generates your dynamic digital signature
        $fields=array(
                'email' => urlencode($email),
                'nonce' => urlencode($nonce),
                'hash' => urlencode($hash)
        );
        $fields_string='';
        foreach($fields as $key=>$value)
        {
                $fields_string .= $key.'='.$value.'&';
        }
        rtrim($fields_string, '&');
        $ch=curl_init();
        curl_setopt($ch,CURLOPT_URL,$url);
        curl_setopt($ch,CURLOPT_POST,count($fields));
        curl_setopt($ch,CURLOPT_POSTFIELDS,$fields_string);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
        $html=curl_exec($ch);
        curl_close($ch);
        $products=json_decode($html);
        foreach($products as $product)
        {
			$qry = $this->db->query("SELECT product_id from `" . DB_PREFIX . "product`  WHERE resource='".$product->resource."'");
			if($qry->num_rows == 0)
			{
				$this->db->query("insert into `" . DB_PREFIX . "product`  set resource='".$product->resource."',status='1'");
				$product_id = $this->db->getLastId();
				$this->db->query("insert into `" . DB_PREFIX . "product_description`  set name='".$this->db->escape($product->title)."',language_id='1',product_id='$product_id'");
                  		$this->db->query("insert into `" . DB_PREFIX . "product_to_store` set  store_id='0',product_id='$product_id'");
			}
			else
			{
				$product_id = $qry->row['product_id'];
				$this->db->query("update `" . DB_PREFIX . "product_description`  set name='".$this->db->escape($product->title)."' where product_id='$product_id'");
			}
			
		}
        
	}
}
