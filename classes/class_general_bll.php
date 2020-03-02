<?php
/**
 * Site General Class
 *
 * This is the general class that will frequently used on website.
 *
 * DateCreated 5th August, 2014
 *
 * DateLastModified 5th August, 2014
 *
 * @copyright Copyright (C) 2013-2014 Techprocompsoft and Services
 *
 * @version 10.0
 */
class General extends Database{

   /**
     * function displayBox
     *
     * This function is used display error or message in box.
     *
     * Database Tables used in this function are : no table
     *
     * @access public
     *
     * @parameters 2 string, string(optional)
     *
     * @return string $stringMessage
     */

   function getUserType()
   {
         if(LOCAL_MODE)
         {
             if (strpos($_SERVER['REQUEST_URI'],"restaurants") !== false) {
                $varUserType = "Owner";
             } else {
                $varUserType = "User";
             }
         }   else   {
             if (strpos($_SERVER['HTTP_HOST'],"pro.eatigo.com") !== false) {
                $varUserType = "Owner";
             } else {
                $varUserType = "User";
             }
         }
         return $varUserType;
   }
   public function displayBox($stringMessage='', $type = 'message',$session = false){

      if($type == "error")
      {
      $stringMessage = "<div class=\"error_box\">
                  {$stringMessage}
               </div>";
      }else{
      $stringMessage = "<div class=\"success_box\">
                  {$stringMessage}
               </div>";
      }
      if($session){
      $_SESSION['message'] = $stringMessage;
      return $_SESSION['message'];
      }else{
      return $stringMessage;
      }
   }

    /**
     * function accessDenied
     *
     * This function check the whether admin is logged in or not, if not redirect him to login page
     *
     * Database Tables used in this function are : no table
     *
     * @access public
     *
     * @parameters none
     *
     * @return boolean
     */
    function accessDenied(){
        $genobj = new General;

        $cookname = $genobj->getCookie('eatigo_auth_admin');
        $cookid = $genobj->getCookie('eatigo_auth_admin_id');
        if(!empty($cookid) && !empty($cookname)){
            $genobj->setSession('eatigo_auth_admin',$cookname);
            $genobj->setSession('eatigo_auth_admin_id',$cookid);
        }
        $ses = $genobj->getSession('eatigo_auth_admin');
        $sesid = $genobj->getSession('eatigo_auth_admin_id');
        if(strlen($ses)==0 || strlen($sesid)==0){
            $genobj->standardRedirect(ADMIN_ROOT_URL."login.php");
        }
        return true;
    }

   /**
     * function getValue
     *
     * This function is used to get the form input field (single).
     *
     * Database Tables used in this function are : no table
     *
     * @access public
     *
     * @parameters 2 mixed, string(optional)
     *
     * @return string $str
     */

   public function getValue($str, $method = ''){

      if($method == 'get')
      $str = $_GET[$str];

      if($method == 'post')
      $str = $_POST[$str];

      if($method == 'request')
      $str = $_REQUEST[$str];

      if(!is_array($str)){
         $str = mysql_real_escape_string(trim($str));
      }
      return $str;
   }


   /**
     * function escapeValue
     *
     * This function uses mysql_real_escape_string for each value. Uses getValue function for trim and form methods
     *
     * Database Tables used in this function are : no table
     *
     * @access public
     *
     * @parameters 2 string, string(optional)
     *
     * @return string
     */
   public function escapeValue($str, $method = ''){

      $str = $this->getValue($str, $method);

      if(!is_array($str))
      $str = mysql_real_escape_string($str);

      return $str;
   }

   /**
     * function changeUserStatus
     *
     * This function uses id of user and change thier statu to active
     *
     * Database Tables used in this function are : users
     *
     * @access public
     *
     * @parameters 21
     *
     * @return string
     */
   public function changeUserStatus($varVerificationCode){
        $varRandomCodeAndID = base64_decode($varVerificationCode);
        $arrIDAndCode = explode("!@#$%^&*", $varRandomCodeAndID);
        $varUserID = $arrIDAndCode[0];
        $argArrData = array("UserStatus"=>"Active");
        $this->update(TABLE_USERS, $argArrData, " AND pkUserID='".$varUserID."'");
        $this->standardRedirect(RESTAURANT_ROOT_URL."login.php");
   }


   /**
     * function calculateDirectoryAvgRating
     *
     * This function calculate avg rating on basis of number that you give to it
     *
     * Database Tables used in this function are : no table
     *
     * @access public
     *
     * @parameters array containing 1)Rating    2)Rating Out of    3)Number onbasis of which , for example 5
     *
     * @return string
     */

   public function calculateDirectoryAvgRating($arrRatingValues){
       if(is_array($arrRatingValues)){
            $x =  $arrRatingValues[1]/$arrRatingValues[2];
            $y1 = $arrRatingValues[0]/$x;
            return $y1;
        }
   }

   /**
     * function countFortimeSlotAdmin
     *
     * This function gives count of total time slot
     *
     * Database Tables used in this function are : default_exceptions_discount
     *
     * @access public
     *
     * @parameters 2 string, array optional)
     *
     * @return string
     */

   function countFortimeSlotAdmin($varExceptionTimeslots,$argClm=array(),$varExceptionID=""){
       if(count($argClm) > 0)
       {
           $arrClm = $argClm;
       }    else    {
           $arrClm = array("pkDefaultExceptionsID");
       }
       if($varExceptionID != ""){
            $argWhrCon = " AND ExceptionTimeslots = $varExceptionTimeslots AND pkDefaultExceptionsID != $varExceptionID";
       } else {
            $argWhrCon = " AND ExceptionTimeslots = $varExceptionTimeslots";
       }

        $data = $this->select(TABLE_EXCEPTION_DISCOUNT, $arrClm, $argWhrCon);
        return count($data);
   }

   /**
     * function setSession
     *
     * This function use set the given value in session.
     *
     * Database Tables used in this function are : no table
     *
     * @access public
     *
     * @parameters 2 string, string
     *
     * @return boolean
     */
   public function setSession($setkey, $setvalue){
        if($setvalue!='')
        $_SESSION[$setkey] = $setvalue;
        return $escapestr;

   }

   /**
     * function setSession
     *
     * This function is used to unset the given key in session.
     *
     * Database Tables used in this function are : no table
     *
     * @access public
     *
     * @parameters 1 string
     *
     * @return boolean
     */
   public function unsetSession($setkey){
        unset($_SESSION[$setkey]);
        return true;
   }

   /**
     * function getSession
     *
     * This function is used to get the session value for given key.
     *
     * Database Tables used in this function are : no table
     *
     * @access public
     *
     * @parameters 1 string
     *
     * @return string
     */
   public function getSession($setkey){

        return $_SESSION[$setkey];

   }


    /**
     * function isUserLogin
     *
     * This function is used to check if user,owner is login or not
     *
     * Database Tables used in this function are : no table
     *
     * @access public
     *
     * @parameters 1 string
     *
     * @return string
     */

   function isUserLogin($argUserType)
    {
       if(isset($argUserType) && $argUserType == 'Owner'){
           $varUserTypr= "Owner";
       } else{
           $varUserTypr= "User";
       }
        if (isset($_SESSION['eatigo_user_id']) && $_SESSION[eatigo_user_type]==$varUserTypr) {
            return true;
        }
        else
        {
            if($argUserType == 'Owner'){
            header('location:'.RESTAURANT_ROOT_URL);
            }else{
            header('location:'.SITE_ROOT_URL);
            }
            exit;
        }
    }
   /**
     * function setCookie
     *
     * This function is used to set the given value in cookie.
     *
     * Database Tables used in this function are : no table
     *
     * @access public
     *
     * @parameters 1 Array
     *
     * @return none
     */
   public function setCookie($cookieArg = array())
   {
         if(LOCAL_MODE){
         $default = array("name" => '',
                          "value" => '',
                          "time" => strtotime( '+1 year' ),
                          "path" => "/",
                          "domain" => "",
                          "secure" => 0,
                          "httponly" => true
                          );
         }else{
         $default = array("name" => '',
                          "value" => '',
                          "time" => strtotime( '+1 year' ),
                          "path" => "/",
                          "domain" => "eatigo.com",
                          "secure" => 0,
                          "httponly" => true
                          );
         }
         $arrayCookies = array_merge($default, $cookieArg); //print_r($arrayCookies);
         extract($arrayCookies);
         return setcookie($name, $value, $time, $path, $domain, $secure, $httponly);
   }



    /**
     * function getCookie
     *
     * This function is used to get the given value in cookie.
     *
     * Database Tables used in this function are : no table
     *
     * @access public
     *
     * @parameters 2 string, string
     *
     * @return string
     */
   public function getCookie($key){

         return $_COOKIE[$key];

   }


   /**
     * function restaurantListingNameAndID
     *
     * This function will create name and id of restaurant
     *
     * Database Tables used in this function are : restaurant
     *
     * @access public
     *
     * @parameters 1
     *
     * @return Array
    *
    * Do not remove as it needs to be call in restaurant header and create problem for other pages of restaurant , here working fine
     */
     function restaurantListingNameAndID($varUserIDEatigo){
        $varClmn = array("pkRestaurantID","RestaurantName");
        $varWhere = " And fkUserID = $varUserIDEatigo";
        $varOrderby = "pkRestaurantID desc";
        $arrResData = $this->select(TABLE_RESTAURANT, $varClmn,$varWhere,$varOrderby);
        return $arrResData;
     }


   /* function checkUser
    *
    * This function check user email registre or not
    *
    * Database Tables used in this function are : users
    *
    * @access public
    *
    * @parameters string
    *
    * @return bool
    */
   public function checkUserIfExits($email){
      $varWhere = " AND UserEmail =\"".$email."\"";
      $varColumn = array('UserEmail');
      if($this->select(TABLE_USERS,$varColumn,$varWhere))
      {
          return true;
      }
      else
      {
         return false;
      }

   }

   /**
     * function sendMail
     *
     * This function is used to get the given value in cookie.
     *
     * Database Tables used in this function are : no table
     *
     * @access public
     *
     * @parameters 1 Array
     *
     * @return string
     */
   /*public function sendMail($mailArg = array()){

         $default = array("to" => '',
                          "to_name" => 'test',
                          "subject" => '[Subject] - '.SITE_NAME,
                          "message" => '[Message]',
                          "from" => SITE_EMAIL_ID,
                          "from_name" => SITE_NAME,
                          "content_type" => 'text/html',
                          "charset" => 'utf-8'
                          );
         $arrayCookies = array_merge($default, $mailArg);
         extract($arrayCookies);

         // To send HTML mail, the Content-type header must be set
         $headers  = 'MIME-Version: 1.0' . "\r\n";
         $headers .= 'Content-type: '.$content_type.'; charset='.$charset.'' . "\r\n";

         // Additional headers

         $headers .= 'From: '.$from_name.' <'.$from.'>' . "\r\n";

         @mail($to, $subject, $message, $headers);
         return true;
   }*/



    public function sendMail($mailArg = array())
	{
        $default = array("to" => '',
                          "to_name" => 'test',
                          "subject" => '[Subject] - '.SITE_NAME,
                          "message" => '[Message]',
                          "from" => SITE_EMAIL_ID,
                          "from_name" => SITE_NAME,
                          "content_type" => 'text/html',
                          "charset" => 'utf-8'
                        );
         $arrMailData = array_merge($default, $mailArg);
         extract($arrMailData);

		$mail = new PHPMailer();

        //$varMailServer = 'email-smtp.us-east-1.amazonaws.com';//EATIGO_MAIL_SERVER;//INFO_ADMIN_MAIL;
        //$varSmtpUsername = 'AKIAJKNKV72VPEXJQXSQ';
        //$varSmtpPassword = 'AhEMb0AQm5fc6C7fuLtnsYw5/smHTK1v8zKZ9NhJpsD';

        $varMailServer = 'smtp.gmail.com';
        $varSmtpUsername = 'dev@eatigo.com';
        $varSmtpPassword = 'dev@eatigo2013';

        $varSmtpMetod = "tls";
        $varSmtpPort = 587;//25,465 OR 587
        $varSmtpAuthentication = true;
        $varMailFrom = $varSmtpUsername;
        //if($from != '')          $varMailFrom = $from;
        //$varMailFrom = 'noreply@eatigo.com';//'noreply@gmail.com';

        $mail->IsSMTP(); // telling the class to use SMTP
        $mail->Host       = $varMailServer; // SMTP server
        $mail->SMTPSecure =$varSmtpMetod;
        $mail->Port     = $varSmtpPort;
        $mail->SMTPAuth = $varSmtpAuthentication;
        $mail->Username = $varSmtpUsername;
        $mail->Password = $varSmtpPassword;
		$mail->Subject    = stripslashes(html_entity_decode($subject, ENT_QUOTES));
		$mail->AddAddress($to, $to);
		$mail->From = stripslashes(html_entity_decode($varMailFrom, ENT_QUOTES));
		$mail->Sender = stripslashes(html_entity_decode($varMailFrom, ENT_QUOTES));
        //$mail->SetFrom('noreply@eatigo.com', 'Notifier'); //from (verified email address)
		if($from_name != '')
		{
			$mail->FromName   = stripslashes(html_entity_decode($from_name, ENT_QUOTES));
		}

		if($message !='')
		{
            $mail->AltBody    = stripslashes($message); // optional, comment out and test
		}
		if($message != '')
		{
			$mail->MsgHTML(stripslashes($message));
		}   else    {
			 $mail->MsgHTML(stripslashes($message));
		}
        return $mail->Send();
		$xx = $mail->Send();
        if($xx)            echo 'fff';
        else            echo 'qqq';die($to);
	}


   /**
     * function createSelectBox
     *
     * This function generate select box on website.
     *
     * Database Tables used in this function are : no table
     *
     * @access public
     *
     * @parameters 1 Array
     *
     * @return none
     */
   public function createSelectBox($arrArg){
       $default = array("name" => "selectbox",
                        "id" => "selectbox",
                        "class" => "selectbox",
                        "onChange"=>"",
                        "selected" => "",
                        "options" => "",
                        "multipleSelect" => "no");
        $arraySelect = array_merge($default, $arrArg);
        extract($arraySelect);

        if($arrArg['disabled'] && $arrArg['disabled']=='disabled'){
            $varDisabed="disabled";
        } else {
            $varDisabed="";
        }

       if(is_array($options)){
         if($onChange == "" || empty($onChange)){
             $onChangeValue = "";
         } else{
             $onChangeValue = $onChange;
         }

         if($multipleSelect == 'yes'){
             $multipleSelectActive = "size=4 multiple";
         } else {
             $multipleSelectActive = "";
         }
         $html = "<select $varDisabed $multipleSelectActive name='{$name}' class='{$class}' id='{$id}' onChange='{$onChangeValue}'>";
         foreach($options as $key=>$option){
            if($selected == $key)
               $html .= "<option value='{$key}' selected='selected' >{$option}</option>";
            else
               $html .= "<option value='{$key}'>{$option}</option>";
         }
         $html .= "</select>";
       }else{
         $html = "<select name='{$name}' class='{$class}' id='{$id}'></select>";
       }
       return $html;
   }



    /**
     * function createSelectMultipleBox
     *
     * This function generate select box on website.
     *
     * Database Tables used in this function are : no table
     *
     * @access public
     *
     * @parameters 1 Array
     *
     * @return none
     */
   public function createSelectMultipleBox($arrArg){

       $html .= '<select data-placeholder="'.$arrArg[placeholder].'" class="chosen-select selectbox" name="'.$arrArg[name].'" id="'.$arrArg[id].'"  multiple size="4">';
       if (is_array($arrArg[allOption]))
        {
                    foreach ($arrArg[allOption] as $keyallOption => $valueallOption)
                    {
                        $varSelected = '';
                        if (is_array($arrArg[allSelectedOption]))
                        {
                            foreach ($arrArg[allSelectedOption] as $value)
                            {

                                if ($value[$arrArg[allSelectedOptionKey]] == $keyallOption)

                                    $varSelected = "selected";
                            }
                        }
        $html .= '<option value="'.$keyallOption.'" '.$varSelected.' >'.$valueallOption.'</option>';
                    }
        }
        $html .= '</select>';

       return $html;
   }


  /**
     * function drawSelectDropDownOptions
     *
     * This is used to generate the options for the select box for the html.
     *
     * Database Table used in this function are : none.
     *
     * @param array $optionsArray options array.
     *
     * @param string $selected field selected value
     *
     * @access public
     *
     * @return string $selectBox
     */
    public function drawSelectDropDownOptions($optionsArray, $selected = '')
	{
		$selectBox = '';
		foreach($optionsArray as $key => $value)
		{
			$selectBox .= '<option value="'.trim($key).'"';
            if(is_array($selected))
            {
                if(in_array($key,$selected)) $selectBox .= '  selected="selected"';
            }
			else if($selected == $key)
			{
				$selectBox .= '  selected="selected"';
			}
			$selectBox .= '>'.trim($value).'</option>';
		}
		return $selectBox;
	}


      /**
     * function getCuisine
     *
     * This function gives all Cuisine from database
     *
     * Database Tables used in this function are : TABLE_CUISINE
     *
     * @access public
     *
     * @parameters none
     *
     * @return Array
     */
     function getCuisine($argCuisineId = ''){
        $varClmn = array("tc.pkCuisineInfoID","tc.CuisineInfoDisplayName",'tl.CuisineInfoDisplayName AS CuisineInfoDisplayName_th');
        if(isset($argCuisineId) && $argCuisineId !=''){
            $argWhrCon = " AND CuisineStatus = 'Active' AND pkCuisineInfoID = '".$argCuisineId."'";
        } else {
            $argWhrCon = " AND CuisineStatus = 'Active'";
        }

        //$arrResData = $this->select(TABLE_CUISINE, $varClmn, $argWhrCon);
		//Nung
		//Kampanath@eatigo.com
		$tableName=TABLE_CUISINE.' tc INNER JOIN '.TABLE_CUISINE_LANG.' tl ON tc.pkCuisineInfoID=tl.fkCuisineInfoID';
		$arrResData = $this->select($tableName, $varClmn, $argWhrCon,'',1);
        return $arrResData;
     }

     function getLocation($argCuisineId){
         $varClmn = array("la.pkAreaID","la.AreaName",'ll.AreaName AS AreaName_th');
        if(isset($argCuisineId) && $argCuisineId !=''){
            $argWhrCon = " AND pkAreaID = '".$argCuisineId."'";
        }
        //$arrResData = $this->select(AREAS, $varClmn, $argWhrCon);
		//Nung
		//Kampanath@eatigo.com
		$tableName=AREAS.' la INNER JOIN '.AREAS_LANG.' ll ON la.pkAreaID=ll.fkAreaID';
		$arrResData = $this->select($tableName, $varClmn, $argWhrCon,'',1);
        return $arrResData;
     }

     function getNeighbourhood($argCuisineId){
        $varClmn = array("pkNeighborhoodID","Neighborhood");
        if(isset($argCuisineId) && $argCuisineId !=''){
            $argWhrCon = " AND pkNeighborhoodID = '".$argCuisineId."'";
        }
        $arrResData = $this->select(NEIGHORHOOD, $varClmn, $argWhrCon);
        return $arrResData;
     }

     function getAtmosphere($argCuisineId){
        $varClmn = array("pkAtmosphereID","AtmosphereName");
        if(isset($argCuisineId) && $argCuisineId !=''){
            $argWhrCon = " AND pkAtmosphereID = '".$argCuisineId."'";
        }
        $arrResData = $this->select(TABLE_ATMOSPHERE, $varClmn, $argWhrCon);
        return $arrResData;
     }




     /**
     * function getCategory
     *
     * This function gives all Category from database
     *
     * Database Tables used in this function are : TABLE_CATEGORY
     *
     * @access public
     *
     * @parameters none or country id
     *
     * @return Array
     */
     function getCategory($argCountryID = ''){
        $varClmn = array("pkCategoryID","CategoryName");
        if(isset($argCountryID) && $argCountryID !=''){
            $argWhrCon = " AND fkCountryID = $argCountryID AND CategoryStatus = 'Active'";
        } else {
            $argWhrCon = " AND CategoryStatus = 'Active'";
        }
        $data = $this->select(TABLE_CATEGORY, $varClmn, $argWhrCon);
        return $data;
     }

     /**
     * function getDirectory
     *
     * This function gives all Directory from database
     *
     * Database Tables used in this function are : eatigo_directory
     *
     * @access public
     *
     * @parameters none or country id
     *
     * @return Array
     */
     function getDirectory($argCountryID = ''){
        $varClmn = array("pkDirectoryID","DirectoryName");
        if(isset($argCountryID) && $argCountryID !=''){
            $argWhrCon = " AND fkCountryID = $argCountryID AND DirectoryStatus = 'Active'";
        } else {
            $argWhrCon = " AND DirectoryStatus = 'Active'";
        }
        $data = $this->select(TABLE_PROFILE_DIRECTORY, $varClmn, $argWhrCon);
        return $data;
     }

     /**
     * function getPartner
     *
     * This function is to get partners.
     *
     * Database Tables used in this function are : profile_partner
     *
     * @access public
     *
     * @parameters none
     *
     * @return Array
     */
     function getPartner($argPartnerId = ""){
       if(isset($argPartnerId) && $argPartnerId !=''){
            $varWhere = " AND PartnerStatus = 'Active' AND pkPartnerDealID = '".$argPartnerId."'";
        } else {
            $varWhere = " AND PartnerStatus = 'Active'";
        }

       $arrPartData = $this->select(TABLE_PARTNER_DEALS,array("pkPartnerDealID","PartnerName"),$varWhere);
        return $arrPartData;
     }

     /**
     * function getCountries
     *
     * This function gives all countries from database
     *
     * Database Tables used in this function are : countries
     *
     * @access public
     *
     * @parameters none
     *
     * @return Array
     */
     function getCountries($argCon='')
     {
         if(isset($argCon) && $argCon=='all'){
           $argWhrCon = " ";
         } else {
           $argWhrCon = " AND CountryStatus = 'Active'";
         }
         $varClmn = array("pkCountryID","CountryCode","CountryName","CountryCallingCode");
         $data = $this->select(TABLE_COUNTRY, $varClmn, $argWhrCon);

        return $data;
     }

     /**
     * function get_country_by_countrycode
     *
     * This function get the country by country code.
     *
     * Database Tables used in this function are : country
     *
     * @access public
     *
     * @parameters 1 string
     *
     * @return array
     */
     function get_country_by_countrycode($countrycode){
          $arrState = array('CountryName');
          $varWhere = " AND CountryCode='".$countrycode."'";
          $country = $this->select(TABLE_COUNTRY,$arrState,$varWhere);
          return $country;
     }

     /**
     * function getStates
     *
     * This function gives all states for the the specified country from database
     *
     * Database Tables used in this function are : states
     *
     * @access public
     *
     * @parameters none or country id
     *
     * @return Array
     */
     function getStates($varCountryID='')
     {
        $varClmn = array("pkStateID","StateName");
        if($varCountryID!='')
            $argWhrCon = " AND StateStatus = 'Active' and fkCountryID = '$varCountryID'";
        else {
            $argWhrCon = " AND StateStatus = 'Active'";
        }
        $data = $this->select(STATES, $varClmn, $argWhrCon);
        return $data;
     }
     /**
     * function getCities
     *
     * This function gives all cities for the the specified state from database
     *
     * Database Tables used in this function are : cities
     *
     * @access public
     *
     * @parameters none or stateID
     *
     * @return Array
     */
     function getCities($varStateID='')
     {
        $varClmn = array("pkCityID","CityName");
        if($varStateID!='')
            $argWhrCon = " AND CityStatus = 'Active' and fkStateID='$varStateID'";
        else {
            $argWhrCon = " AND CityStatus = 'Active'";
        }

        $data = $this->select(CITIES, $varClmn, $argWhrCon);
        return $data;
     }

     /**
     * function getLanguages
     *
     * This function gives all Languages from database
     *
     * Database Tables used in this function are : languages
     *
     * @access public
     *
     * @parameters none or State id
     *
     * @return Array
     */
     function getLanguages()
     {
        $varClmn = array("pkLanguageID","LanguageName","LanguageCode");
        $argWhrCon = " AND LanguageStatus = 'Active'";// and fkStateID='$varStateID'
        $data = $this->select(TABLE_LANG, $varClmn, $argWhrCon);
        return $data;
     }


     /**
     * function getCurrencies
     *
     * This function gives all curriencies from database
     *
     * Database Tables used in this function are : curriencies
     *
     * @access public
     *
     * @parameters none
     *
     * @return Array
     */
     function getCurrencies(){
        $varClmn = array("pkCurrencyID","CurrencyTitle","CurrencyCode");
        $argWhrCon = " AND CurrencyStatus IN('active','Active')";
        $arrdata = $this->select(TABLE_CURRENCY, $varClmn, $argWhrCon);
        return $arrdata;
     }


      /**
     * function getCurrenciesOnBasisOfCountry
     *
     * This function gives curriencies on country basis from database
     *
     * Database Tables used in this function are : curriencies,country
     *
     * @access public
     *
     * @parameters none
     *
     * @return
     */
     function getCurrenciesOnBasisOfCountry($argCountryID){
        $varClmn = array("pkCurrencyID","CurrencyTitle","CurrencyCode");
        $argWhrCon = " AND pkCountryID = $argCountryID AND CurrencyStatus IN('active','Active')";
        $varTable = TABLE_COUNTRY." c left join ".TABLE_CURRENCY." on c.fkCurrencyID = pkCurrencyID";
        $arrdata = $this->select($varTable, $varClmn, $argWhrCon);
        return $arrdata;
     }

      /**
     * function getCountryCallingCode
     *
     * This function gives getCountryCallingCode on country basis from database
     *
     * Database Tables used in this function are : country
     *
     * @access public
     *
     * @parameters none
     *
     * @return
     */
     function getCountryCallingCode($argCountryID){
        $varClmn = array("CountryCallingCode");
        $argWhrCon = " AND pkCountryID = $argCountryID";
        $varTable = TABLE_COUNTRY;
        $arrdata = $this->select($varTable, $varClmn, $argWhrCon);
        return $arrdata;
     }


     /**
     * function getCites
     *
     * This function gives all States from database
     *
     * Database Tables used in this function are : cities
     *
     * @access public
     *
     * @parameters none or State id
     *
     * @return Array
     */
     function getCites($pkStateID = ''){
        $varClmn = array("pkCityID","CityName");
        if(isset($pkStateID) && $pkStateID !=''){
            $argWhrCon = " AND fkStateID = $pkStateID AND CityStatus = 'Active'";
        } else {
            $argWhrCon = " AND CityStatus = 'Active'";
        }
        $data = $this->select(CITIES, $varClmn, $argWhrCon);
        return $data;
     }

     /**
     * function getAreas
     *
     * This function gives all Areas from database
     *
     * Database Tables used in this function are : areas
     *
     * @access public
     *
     * @parameters none or city id
     *
     * @return Array
     */
     function getAreas($argCityID = ''){
        $varClmn = array("pkAreaID","AreaName");
        if(isset($argCityID) && $argCityID !=''){
            $argWhrCon = " AND fkCityID = $argCityID AND AreaStatus = 'Active'";
        } else {
            $argWhrCon = " AND AreaStatus = 'Active'";
        }
        $data = $this->select(AREAS, $varClmn, $argWhrCon);
        return $data;
     }


      /**
     * function getNeighborhoods
     *
     * This function gives all Neighborhood from database
     *
     * Database Tables used in this function are : Neighborhood
     *
     * @access public
     *
     * @parameters none or Area id
     *
     * @return Array
     */
     function getNeighborhoods($argAreaID = ''){
        $varClmn = array("pkNeighborhoodID","Neighborhood");
        if(isset($argAreaID) && $argAreaID !=''){
            $argWhrCon = " AND fkAreaID = $argAreaID AND NeighborhoodStatus = 'Active'";
        } else {
            $argWhrCon = " AND NeighborhoodStatus = 'Active'";
        }
        $data = $this->select(NEIGHORHOOD, $varClmn, $argWhrCon);
        return $data;
     }

   /**
     * function getTimeZones
     *
     * This function gives all Time Zones from database
     *
     * Database Tables used in this function are : timezones
     *
     * @access public
     *
     * @parameters 1, string
     *
     * @return Array
     */
     function getTimeZones($countryId = ''){
        $varClmn = array("pkTimeZoneID","TimeZoneTitle");
        if(isset($countryId) && $countryId !=''){
            $varClmnCountry = array("CountryCode");
            $argWhrConCountry = " AND pkCountryID = $countryId AND CountryStatus = 'Active'";
            $dataCountry = $this->select(TABLE_COUNTRY, $varClmnCountry, $argWhrConCountry);

            $argWhrCon = " AND fkCountryCode = '".  $dataCountry[0]['CountryCode']."' AND TimeZoneStatus = 'Active'";
        } else {
            $argWhrCon = " AND TimeZoneStatus = 'Active'";
        }
        $data = $this->select(TABLE_TIMEZONE, $varClmn, $argWhrCon);
        return $data;
     }


     /**
     * function getTimeZonesHtml
     *
     * This function get timezones in selection box
     *
     * Database Tables used in this function are : timezones
     *
     * @access public
     *
     * @parameters none
     *
     * @return none
     */
    function getTimeZonesHtml(){

        $data = $this->getTimeZones();
        if(is_array($data)){
            foreach($data as $row){
                $rows[$row['pkTimeZoneID']] =  $row['TimeZoneTitle'];
            }
            $arrArg = array("name" => "timezone",
                            "options" => $rows);
            $html = $this->createSelectBox($arrArg);
            return $html;
        }
    }
    /**
     * function insertRecord
     *
     * This is used to insert records in any Table.
     *
     * Database Table used in this function are : $argVarTable.
     *
     * @param string $argVarTable contains table name.
     *
     * @param array $argArrColumns contains columns to insert.
     *
     * @access public
     *
     * @return bool
     */
	function insertRecord($argVarTable, $argArrColumns)
	{
		return $this->insert($argVarTable, $argArrColumns);
	}
    /**
     * function updateRecord
     *
     * This is used to update records in any Table.
     *
     * Database Table used in this function are : $argVarTable.
     *
     * @param string $argVarTable contains table name.
     *
     * @param array $argArrColumns contains data to update.
     *
     * @param string $argVarWhere provides where condition.
     *
     * @access public
     *
     * @return bool
     */
	function updateRecord($argVarTable,$argArrColumns,$argVarWhere)
	{
		$this->update($argVarTable,$argArrColumns,$argVarWhere);
		return true;
	}

         /**
     * function deleteRecord
     *
     * This is used to delete records in any Table.
     *
     * Database Table used in this function are : $argVarTable.
     *
     * @param string $argVarTable contains table name.
     *
     * @param array $argArrColumns contains data to update.
     *
     * @param string $argVarWhere provides where condition.
     *
     * @access public
     *
     * @return bool */

        function deleteRecord($argVarTable,$argVarWhere)
	{
		$this->delete($argVarTable,$argVarWhere);
		return true;
	}

    /**
     * function getRecord
     *
     * This is used to get informtion from any Table.
     *
     * Database Table used in this function are : $argTable.
     *
     * @param string $argTable contains table name.
     *
     * @param array $argArrColums contains columns to fetch.
     *
     * @param string $argVarWhr provides where condition.
     *
     * @param string $argVarOrderBy contains sorting fields and order.
     *
     * @param string $argVarLimit contains limit.
     *
     * @access public
     *
     * @return mixed.
     */
	function getRecord($argTable, $argArrColums, $argVarWhr = '', $argVarOrderBy = '', $argVarLimit = '')
	{
		$arrResult = $this->select($argTable,$argArrColums,$argVarWhr,$argVarOrderBy,$argVarLimit);
		if($arrResult)
		{
			return $arrResult;
		}   else    {
			return false;
		}
	}
    /**
     * function getRecordNumRows
     *
     * This is used to get number of rows of table.
     *
     * Database Table used in this function are : $argTableName.
     *
     * @param string $argTableName contains table name.
     *
     * @param string $argWhr provides where condition.
     *
     * @access public
     *
     * @return int $varNumRows
     */
   function getRecordNumRows($argTableName,$argClmn, $argWhr)
   {
    $varNumRows = $this->getNumRows($argTableName,$argClmn, $argWhr);
    return $varNumRows;
   }

    /**
     * function generateRandomKey
     *
     * This is used to generate random key.
     *
     * Database Table used in this function are : none.
     *
     * @param int $argLength contains random key length.
     *
     * @param string $argCharacterSet contains character set.
     *
     * @access public
     *
     * @return string $varValue
     */
   function generateRandomKey($argLength = '',$argCharacterSet = '')
   {
      // CHARACTER SET.
      if($argCharacterSet == '')
      {
       $varCharacterSet = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
      }
      else
      {
       $varCharacterSet = $argCharacterSet;
      }
      // CHECK FOR LENGTH OF KEY.
      if($argLength == '')
      {
       // DEFAULT KEY LENGTH.
       $varLength = 8;
      }
      else
      {
       // USER DEFIND KEY LENGTH.
       $varLength = $argLength;
      }
      $varMax = strlen($varCharacterSet)-1;
      $varValue = '';
      for ($i=0;$i<$varLength;$i++)
      {
       $varValue .= $varCharacterSet{mt_rand(0,$varMax)};
      }
      // RANDOM KEY.
      return $varValue;
   }

   /**
     * function displayDate
     *
     * This function returns date in the specified format.
     *
     * Database Table used in this function are : none.
     *
     * @access public
     *
     * @return string
     */
   function displayDate($varDate='',$argFormat='')
   {
       if($varDate == '')
       {
           if(isset($_SESSION['sessUser']['TimeZone']) && $_SESSION['sessUser']['TimeZone'] != '')
           {
               return $currentDate = date('Y-m-d  H:i:s');
               $argFromTimeZone = $_SESSION['sessUser']['TimeZone'];
               $fromTimeZone = date_default_timezone_get();
               $argVarDate = $this->convertToFromGmtValue($varDate, $fromTimeZone, $argFromTimeZone);
               return $argVarDate;
           }   else     {
               if($argFormat!=''){
                    return $currentDate = date($argFormat);
               }    else   {
                   return $currentDate = date('Y-m-d');
               }
           }
       }   else     {
            if($argFormat!='')
            {
                return $currentDate = date($argFormat,strtotime($varDate));
            }   else   {
                return $currentDate = date('d-m-Y',strtotime($varDate));
            }
       }
   }

   function getDate($varDate='',$argFormat='Y-m-d H:i:s')
   {
       if($argFormat != ''  && $varDate == '') {
           $varDate = date($argFormat);
       }
       if($varDate == '')   $varDate = date('Y-m-d H:i:s');

       if(!isset($_SESSION['sessUser']['TimeZone']))
       {
           $varCountryCode = $this->getCookie('country_switch');
           if($varCountryCode == '') $varCountryCode = 'THA';
           $varCountryWhr = " and fkCountryCode='$varCountryCode'";
           $arrTz = $this->select('timezones',array('TimeZoneTitle'),$varCountryWhr);
           $_SESSION['sessUser']['TimeZone'] = $arrTz[0]['TimeZoneTitle'];
       }
       if(isset($_SESSION['sessUser']['TimeZone']) && $_SESSION['sessUser']['TimeZone'] != '')
       {
           $argFromTimeZone = $_SESSION['sessUser']['TimeZone'];
           $fromTimeZone = date_default_timezone_get();
           //echo $varDate."====".$fromTimeZone."====".$argFromTimeZone;//die;
           $argVarDate = $this->convertToFromGmtValue($varDate, $fromTimeZone, $argFromTimeZone);
           return ($argVarDate) ? $argVarDate : $varDate;
       }   else     {
           return $currentDate = date($argFormat,strtotime($varDate));
       }
   }

   function getDateAdded($argDate, $argDay='', $argIntervalType='')
	{
		if($argIntervalType =='')
		{

		$argIntervalType = 'DAY';
		}
		if($argDay !='')
		{
		$argValue = $argDay." ".$argIntervalType;
		}
		else
		{
		$argValue =$argIntervalType;
		}
		$varSql = "SELECT DATE_ADD('$argDate', INTERVAL $argValue) as sqlday";
		//echo $varSql;
		//die;
		$varResutl = mysql_query($varSql);
		$arrResult = mysql_fetch_assoc($varResutl);
		$varSqlDay = $arrResult['sqlday'];
		@mysql_free_result($varResutl);
		return $varSqlDay;
	}

    function convertToFromGmtValue ($argVarDate, $argFromTimeZone, $argToTimeZone='GMT')
	{
        //$argToTimeZone = 'Asia/Karachi';$argFromTimeZone= 'Asia/Calcutta';
	    $result= mysql_query("SELECT CONVERT_TZ('$argVarDate','$argFromTimeZone','$argToTimeZone') as argDate");
	    $row =mysql_fetch_assoc($result);
		@mysql_free_result($result);
		$argVarDate = $row['argDate'];
		return $argVarDate;
	}

    /*function setTimeZone($argCountryName)
    {
        //$varWhr = " and pkCountryID = '$argCountryID'";//$argCountryID = '198'
        $varWhr = " and lower(c.CountryName) = '".strtolower($argCountryName)."'";
        $varTableJoin = ' countries c inner join timezones tz on c.CountryCode  = tz.fkCountryCode';
        $arrTimeZone = $this->select($varTableJoin, array('TimeZoneTitle'), $varWhr);
        $_SESSION['sessUser']['TimeZone'] = $arrTimeZone[0]['TimeZoneTitle'];
    }*/



    /**
     * function standardRedirect
     *
     * This function redirects to the given location.
     *
     * Database Table used in this function are : none.
     *
     * @param string $rdrctFile contains the redirect location.
     *
     * @param bool $varBool contains the true or false conditional check.
     *
     * @access public
     *
     * @return void
     */
    function standardRedirect($rdrctFile)
   {
          if($rdrctFile!= '')
          {
              $varFinalPath = $rdrctFile;
              header("Location:$varFinalPath");
              exit;
          }   else    {
              return false;
          }
   }
    /**
     * function setSuccessMsg
     *
     * This function sets success message.
     *
     * Database Table used in this function are : none.
     *
     * @param string $sessMsg contains message to set.
     *
     * @access public
     *
     * @return void
     */
      function setSuccessMsg($sessMsg)
      {
         if($sessMsg=="")
         {
             $_SESSION[sessMsg] = '';
         }
         else
         {
            $_SESSION[sessMsg]='<div class="successMsg sessSucMsg">'.$sessMsg.'<span id="successMsgSpan">&nbsp;</span></div>';
         }
      }

      /**
     * function setErrorMsg
     *
     * This function sets Error message.
     *
     * Database Table used in this function are : none.
     *
     * @param string $sessMsg contains message to set.
     *
     * @access public
     *
     * @return void
     */
    function setErrorMsg($sessMsg)
      {
         if($sessMsg=="")
         {
            $_SESSION[sessMsg] = '';
         }
         else
         {
            $_SESSION[sessMsg]='<div class="errorMsg sessErrMsg">'.$sessMsg.'<span id="errorMsgSpan">&nbsp;</span></div>';
         }
      }

      /**
     * function displaySessMsg
     *
     * This function display the session message.
     *
     * Database Table used in this function are : none.
     *
     * @access public
     *
     * @return string
     */
    function displaySessMsg()
    {
            return $_SESSION['sessMsg'];
    }


        /**
        * function showImage
        *
        * This function checks all the validations of image and then return the image url.
        *
        * Database Table used in this function are : none.
        *
        * @param array.
        *
        * @access public
        *
        * @return sting
        */
         function showImage($argArrData)
         {
                if ($argArrData['imageName']!=''){
                    $varFileName = SOURCE_ROOT.$argArrData['imageDirectory'].$argArrData['imageName'];
                    if (is_file($varFileName) && file_exists($varFileName)){
                       $varImagePath = SITE_ROOT_URL.$argArrData['imageDirectory'].$argArrData['imageName'];
                    }
                    else{
                        $varImagePath = SITE_ROOT_URL.$argArrData['defaultImageDirectory'].$argArrData['defaultImageName'];
                    }

                }else{
                    $varImagePath = SITE_ROOT_URL.$argArrData['defaultImageDirectory'].$argArrData['defaultImageName'];
                }
                return $varImagePath;
         }

        /**
        * function changeStatus
        *
        * This function will change the status of given table.
        *
        * Database Table used in this function are : passed by user in parameter.
        *
        * @param array.
        *
        * @access public
        *
        * @return bool
        */
      function changeStatus($argArrData)
      {
                 $varTableName = $argArrData['tableName'];
                 $arrCols = $argArrData['cols'];
                 $varWhere = $argArrData['condition'];
                 $this->update($varTableName, $arrCols, $varWhere);
      }

        /**
        * function decodeQueryStringData
        *
        * This function will protect from sql injection.
        *
        * Database Table used in this function are : none.
        *
        * @param array.
        *
        * @access public
        *
        * @return array
        */

        public function decodeQueryStringData($argSting)
        {
            if(is_array($argSting))
            {
                foreach ($argSting as $key=>$value)
                {
                    $_GET[$key] = mysql_real_escape_string(trim($value));
                }
                return $_GET;
            }
        }
        /*
        public function decodeQueryStringData($argSting)
        {
                if(is_array($argSting))
                {
                    $arrKeys = array_keys($argSting);
                    echo $varQueryString = base64_decode(implode('&', $arrKeys));
                    $arrQueryString = explode('&', $varQueryString);
                    if($arrQueryString)
                    {
                        $arrFinal = array();
                        for($i=0; $i<count($arrQueryString); $i++)
                        {
                                if($arrQueryString[$i] != '')
                                {
                                        $arrTemp = explode('=', $arrQueryString[$i]);
                                        $_GET[$arrTemp[0]] = $arrTemp[1];
                                        $_REQUEST[$arrTemp[0]] = $arrTemp[1];
                                }
                        }
                        ///var_dump($_GET);
                        return $_GET;
                    }
                }
        }*/

        /**
        * function removeBackslash
        *
        * This function will remove backslash before a single quote.
        *
        * Database Table used in this function are : none.
        *
        * @param string.
        *
        * @access public
        *
        * @return string
        */

        public function removeBackslash($argSting)
        {
            if($argSting!='')
            {
                return str_replace("\'", "'", $argSting);
            }
        }

        /**
        * function calculateAge
        *
        * This function will calculate age on the basis of given date.
        *
        * Database Table used in this function are : none.
        *
        * @param string.
        *
        * @access date
        *
        * @return string
        */

        public function calculateAge($argDob)
        {
            $objToday = new DateTime();
            $objDiffrence = $objToday->diff(new DateTime($argDob));
            $varAge = "";
            if ($objDiffrence->y){
                $varAge = $objDiffrence->y.' years ';
                if($objDiffrence->m!=0){
                    $varAge.=$objDiffrence->m.' months';
                }
            }
            else if($objDiffrence->m){
               $varAge =  $objDiffrence->m . ' months ';
               if($objDiffrence->d){
                   $varAge.= $objDiffrence->d . ' days';
               }
            }
            else{
               $varAge =  $objDiffrence->d . ' days old';
            }
            return $varAge;
        }

        /**
        * function ratingWidthPercentage
        *
        * This function will calculate given rating and return withpercentage.
        *
        * Database Table used in this function are : none.
        *
        * @param string.
        *
        * @access date
        *
        * @return string
        */

       public function ratingPriceWidthPercentage($argRating)
       {
           $varWidthPercentage = 0;
           if($argRating >0 && $argRating <= 10){
               $varWidthPercentage = 10;
           }
           else if($argRating >10 && $argRating <= 20){
               $varWidthPercentage = 20;
           }
           else if($argRating >20 && $argRating <= 30){
               $varWidthPercentage = 30;
           }
           else if($argRating >30 && $argRating <= 40){
               $varWidthPercentage = 40;
           }
           else if($argRating >40 && $argRating <= 50){
               $varWidthPercentage = 50;
           }
           else if($argRating >50 && $argRating <= 60){
               $varWidthPercentage = 60;
           }
           else if($argRating >60 && $argRating <= 70){
               $varWidthPercentage = 70;
           }
           else if($argRating >70 && $argRating <= 80){
               $varWidthPercentage = 80;
           }
           else if($argRating >80 && $argRating <= 90){
               $varWidthPercentage = 90;
           }
           else if($argRating >90 && $argRating <= 100){
               $varWidthPercentage = 100;
           }
           return $varWidthPercentage;
       }
        /**
        * function checkOldPassword
        *
        * This function will match the user old password.
        *
        * Database Table used in this function are : users.
        *
        * @param int.
        *
        * @access date
        *
        * @return bool
        */

       public function checkOldPassword($varUserId,$oldPassword)
       {
           $oldPassword = $oldPassword;
           $varWhere = " AND pkUserID='{$varUserId}' AND BINARY UserPassword = '{$oldPassword}'";
           //if($this->select(TABLE_USERS,array('username'),$varWhere))
           if($this->select(TABLE_USERS,array('pkUserID'),$varWhere))
           {
               return true;
           }
           else
           {
               return false;
           }
       }
/**
     * function encryptQueryString
     *
     * This is used to encrypt the string.
     *
     * Database Table used in this function are : none.
     *
     * @param string $argStr contains the string to encrypt.
     *
     * @access public
     *
     * @return string
     */
	function encryptData($argStr)
	{
		//$varstr = 'qrystr'.$argStr;
		return base64_encode($argStr);
	}



        /**
     * function dateFormat
     *
     * This is used to give format to date.
     *
     * Database Table used in this function are : none.
     *
     * @param string $argStr contains the date
     *
     * @access public
     *
     * @return string
     */
	function dateFormat($argStr)
	{
		return $argStr;
	}

    /**
     * function decryptQueryString
     *
     * This is used to set decrypt the string.
     *
     * Database Table used in this function are : none.
     *
     * @param string $argStr contains string to decrypt.
     *
     * @access public
     *
     * @return string
     */
     function decryptData($argStr)
     {
            return base64_decode($argStr);
     }

     /**
     * function getLangTemplateFilePath
     *
     * This is used to get language template file
     *
     * Database Table used in this function are : none.
     *
     * @access public
     *
     * @return string
     */
     function getLangTemplateFilePath($argPath,$argLanguage='')
     {
         if($argLanguage != '')
         {
            if($argLanguage == "th")
            {
                $varPath="common/template/th/$argPath";
            } else{
                $varPath="common/template/en/$argPath";
            }
         }
		 else
		 {
            if(isset($_COOKIE["lang_switch"]) && ($this->getCookie("lang_switch")=='en' || $this->getCookie("lang_switch")==""))
			{
                $varPath="common/template/en/$argPath";
            } else{
                $varPath="common/template/th/$argPath";
            }
         }
         return $varPath;
     }

     /**
     * function sendMessage
     *
     * This is used to send message to given email on phone number.
     *
     * Database Table used in this function are : none.
     *
     * @param array
     *
     * @access public
     *
     * @return none
     */
     function sendMessage($argArrData)
     {
//         echo "<pre>";
//         print_r($argArrData);
//         echo "</pre>";
//         exit;

         $varSiteLogo = SITE_ROOT_URL."common/img/logo_eatigo.png";

         $varContactType = $argArrData['contactType'];

          ob_start();

        $varPath = $this->getLangTemplateFilePath("send_message_common.html");
        require_once(SOURCE_ROOT . $varPath);
        $varOutputMail = ob_get_contents();
        ob_end_clean();
        $varKeyword = array('{SITE_LOGO}','{MESSAGE}','{SITE_NAME}');
        $varKeywordValues = array($varSiteLogo," Message from Eatigo : ".$argArrData['ContactContent'],SITE_NAME);
        $varMessage = str_replace($varKeyword, $varKeywordValues, $varOutputMail);

          $mailArg = array("to" => $argArrData['mailfrom'],
                    "subject" => EMAIL_SUBJECT_ADMIN_MESSAGE.SITE_NAME,
                    "message" => $varMessage
                    );

         switch ($varContactType){
             case "email":
                    $this->sendMail($mailArg);
                    return true;
                 break;
             case "sms":
                 require_once(SITE_CLASS_GENERAL_DIR."class_sms_bll.php");
                 $objSms = new Sms();
                 if($argArrData['phone']!=''){
                    return $objSms->sendSms($argArrData['phone'], $argArrData['ContactContent']);
                 }
                 break;
             case "both":
                 require_once(SITE_CLASS_GENERAL_DIR."class_sms_bll.php");
                 $objSms = new Sms();
                 $this->sendMail($mailArg);
                 if($argArrData['phone']!=''){
                    return $objSms->sendSms($argArrData['phone'], $argArrData['ContactContent']);
                  }
                 break;
         }
     }

     /**
     * function resizeThumbnailImage
     *
     * This is used to create fix size image after crop selection.
     *
     * Database Table used in this function are : none.
     *
     * @param destination_name, source_image, $width, $height, $start_width, $start_height, $scale
     *
     * @access public
     *
     * @return string
     */

     function resizeThumbnailImage($thumb_image_name, $image, $width, $height, $start_width, $start_height, $scale){
	list($imagewidth, $imageheight, $imageType) = getimagesize($image);
	$imageType = image_type_to_mime_type($imageType);

	$newImageWidth = ceil($width * $scale);
	$newImageHeight = ceil($height * $scale);
	$newImage = imagecreatetruecolor($newImageWidth,$newImageHeight);
	switch($imageType) {
		case "image/gif":
			$source=imagecreatefromgif($image);
			break;
	    case "image/pjpeg":
		case "image/jpeg":
		case "image/jpg":
			$source=imagecreatefromjpeg($image);
			break;
	    case "image/png":
		case "image/x-png":
			$source=imagecreatefrompng($image);
			break;
            }
            imagecopyresampled($newImage,$source,0,0,$start_width,$start_height,$newImageWidth,$newImageHeight,$width,$height);
            switch($imageType) {
                    case "image/gif":
                            imagegif($newImage,$thumb_image_name);
                            break;
            case "image/pjpeg":
                    case "image/jpeg":
                    case "image/jpg":
                            imagejpeg($newImage,$thumb_image_name,90);
                            break;
                    case "image/png":
                    case "image/x-png":
                            imagepng($newImage,$thumb_image_name);
                            break;
        }
        chmod($thumb_image_name, 0777);
        return basename($thumb_image_name);
    }

    /**
     * function getLimitedString
     *
     * This is used to limit the string
     *
     * Database Table used in this function are : none.
     *
     * @param string , int
     *
     * @access public
     *
     * @return string
     */
    public function getLimitedString($str, $limit)
    {
        return strlen($str) > $limit ? substr($str, 0, $limit - 2) . " .." : $str;
    }

    /**
     * function getLimitedString
     *
     * This is used to return the limit of records
     *
     * Database Table used in this function are : none.
     *
     * @param $argArrData
     *
     * @access public
     *
     * @return int
     */
    public function getRocordLimit($argArrData='')
    {
        $varPageName = trim(str_replace('.php','',basename($_SERVER['PHP_SELF'])));
        $arrRecordPerPage = array();
        $varRecord = $_GET['record'];
        $sessArrRecordPerPage = $this->getSession('record_per_page');

        if($sessArrRecordPerPage){
            $arrRecordPerPage = $sessArrRecordPerPage;
        }else{
            $arrRecordPerPage = array();
        }
        // execute if any one select record limit
        if(isset($varRecord) && $varRecord!='')
        {
            // execute if session already set
            if(!isset($arrRecordPerPage[$varPageName])){
               $arrRecordPerPage = array_merge($arrRecordPerPage, array($varPageName=>$varRecord));
            }
            else{
                $arrRecordPerPage[$varPageName] = $varRecord;
            }
            $this->setSession('record_per_page',$arrRecordPerPage);
        }
        else
        {
            // execute if default limit is already set
            if(isset($arrRecordPerPage['default']) && $arrRecordPerPage['default']!='')
            {
                if(!isset($arrRecordPerPage[$varPageName])){
                    $arrRecordPerPage = array_merge($arrRecordPerPage, array($varPageName=>$arrRecordPerPage['default']));
                }
                $this->setSession('record_per_page',$arrRecordPerPage);
            }
            // execute if default limit is not set
            else{
                $arrResult = $this->select(TABLE_PREFRENCES, array('AdminRecordLimit'));
                if(!isset($arrRecordPerPage[$varPageName])){
                    $varLimit = ($arrResult[0]['AdminRecordLimit']!='') ? $arrResult[0]['AdminRecordLimit'] : ADMIN_RECORD_LIMIT;
                    $arrRecordPerPage = array_merge($arrRecordPerPage, array($varPageName=>$varLimit));
                }
                $this->setSession('record_per_page',$arrRecordPerPage);
            }
        }
        return $arrRecordPerPage[$varPageName];
    }

    /**
     * function get_callingcode
     *
     * This function calling code of all countries
     *
     * Database Tables used in this function are : country_calling_code
     *
     * @access public
     *
     * @parameters none
     *
     * @return array
     */
    function get_callingcode(){
        $varTable = TABLE_COUNTRY." as ccc";
        $varColumn = array('ccc.CountryCallingCode','ccc.ShortCountryCode','ccc.CountryName','ccc.CountryCode');
        //$varWhere = 'AND c.CountryStatus=\'Active\'';
        $varWhere = ' ';
        return $this->getRecord($varTable,$varColumn,$varWhere);
    }


    /**
     * function createUrl
     *
     * This function that will create the seo friendly url on the website.
     *
     * Database Tables used in this function are : none
     *
     * @access public
     *
     * @parameters 1, String
     *
     * @return String
     */
    function createUrl($argUrl){
        global $objGeneral,$country_name,$countryid;
        $langPrefer = ($objGeneral->getCookie( 'lang_switch' ) ? $objGeneral->getCookie( 'lang_switch' ) :  $country_name);
        $country_switch = ($objGeneral->getCookie('country_switch') ? $objGeneral->getCookie('country_switch') : $countryid);

        $var_cookie_url = ($country_switch!='' && $langPrefer!='')?strtolower(substr($country_switch,0,2)).'/'.$langPrefer:'';
        $var_url_strings = trim(strrchr($argUrl,"/"),"/");
        $varcrudeurl  = substr($argUrl,0,strrpos($argUrl,'/'));
        if(strpos($varcrudeurl,'users')!==false)
        {
            $varcrudeurl  = substr($varcrudeurl,0,strrpos($varcrudeurl,'/'));
            $var_cookie_url =$var_cookie_url!=''?$var_cookie_url.'/users':'users';
        }
        if(strpos($varcrudeurl,'restaurant')!==false)
        {
            $varcrudeurl  = substr($varcrudeurl,0,strrpos($varcrudeurl,'/'));
            $var_cookie_url =$var_cookie_url!=''?$var_cookie_url.'/restaurant':'restaurant';
        }
        $arrurl = explode('?',$var_url_strings);
        $pagename = (strrpos($arrurl[0],'.') ? (substr($arrurl[0],0,strrpos($arrurl[0],'.'))) : $arrurl[0]);
        if($varcrudeurl=='' && $var_cookie_url=='')
            $seourl = $this->cleanUrl($pagename);
        else if($varcrudeurl!='' && $var_cookie_url=='')
            $seourl = $varcrudeurl.'/'.$this->cleanUrl($pagename);
        else if($varcrudeurl=='' && $var_cookie_url!='')
            $seourl = $var_cookie_url.'/'.$this->cleanUrl($pagename);
        else
            $seourl = $varcrudeurl.'/'.$var_cookie_url.'/'.$this->cleanUrl($pagename);
        if($arrurl[1]){
            $arrurlarg = explode('&',  html_entity_decode($arrurl[1]));
            if(is_array($arrurlarg)){
                foreach($arrurlarg as $varurlarg){
                    $arrurlargeach = explode('=',$varurlarg);
                    if($arrurlargeach[0] == 'resID'){
                        $seourl .= '-'.$arrurlargeach[1].'/';
                    }else{
                        //$seourl .= $this->cleanUrl($arrurlargeach[1]).'/';
                        $seourl .= trim($arrurlargeach[1]).'/';
                    }
                }

            }
            //print_r($arrurlarg);
        }

        return $seourl;
    }



    function cleanUrl($str, $replace=array(), $delimiter='-') {
	if( !empty($replace) ) {
		$str = str_replace((array)$replace, ' ', $str);
	}

	$clean = iconv('UTF-8', 'ASCII//TRANSLIT', $str);
	$clean = preg_replace("/[^a-zA-Z0-9\/_|+ -]/", '', $clean);
	$clean = strtolower(trim($clean, '-'));
	$clean = preg_replace("/[\/_|+ -]+/", $delimiter, $clean);

	return $clean;
    }

     /**
     * function displayTime
     *
     * This function that will formate time.
     *
     * Database Tables used in this function are : none
     *
     * @access public
     *
     * @parameters 1, float
     *
     * @return float
     */
    function displayTime($argTime)
    {
        return $argTime;
    }

    /**
     * function getBreadcum
     *
     * This function that will formate the breadcum string.
     *
     * Database Tables used in this function are : none
     *
     * @access public
     *
     * @parameters 1, array
     *
     * @return string
     */

    function getBreadcrum($arrBreadCumData='')
    {
        $varBaseURl = (strpos($_SERVER['HTTP_HOST'],"pro.eatigo.com") !== false)  ? RESTAURANT_ROOT_URL : SITE_ROOT_URL;

        $varBreadCumStr = '<ul class="bread_crum"><li class="home"><a href="'.$varBaseURl.'"></a></li>';
        if(is_array($arrBreadCumData)){
            end($arrBreadCumData);         // move the internal pointer to the end of the array
            $varLastkey = key($arrBreadCumData);
            foreach($arrBreadCumData as $key=>$val)
            {
                //$varIsfound = strpos($val,'.php');
                if($varLastkey == $key)
                {
                    $varBreadCumStr .='<li class="active">'.$key.'</li>';
                }
                else{
                    $varBreadCumStr .='<li><a href="'.$val.'">'.$key.'</a></li>';
                }
            }
        }
        $varBreadCumStr .='</ul>';
        return  $varBreadCumStr;
    }

    function showSelectedCountry(){
        global $country_name,$countryid;
        $selectedlanguagecode = ($this->getCookie( 'lang_switch' ) ? $this->getCookie( 'lang_switch' ) :  $country_name);
        $country_switch = ($this->getCookie('country_switch') ? $this->getCookie('country_switch') : $countryid);
		$html  = '<a href="#language-selector-box" id="getcountryselectionbox">';
                if($selectedlanguagecode){
                    $html .= '<small>'.$selectedlanguagecode.'</small>';

                    if(file_exists(SITE_IMG_DIR.'flags/'.substr($country_switch,0,-1).'.png'))
                    $html .= '<span><img src="'.SITE_IMG_URL.'flags/'.substr($country_switch,0,-1).'.png" alt=""></span>';
                }else{
                    $html .= '<small>Other</small><span></span>';
                }
        $html .='</a>';
        return $html;
    }

	//Tony - 24-01-2014
    function showCountrySelectionBox($varCountrieswithLang)
	{
        $html = '<ul>';
      	if(is_array($varCountrieswithLang))
		{ //print_r($varCountrieswithLang[0]['CountryName']);
			$counter = 1;
           	foreach($varCountrieswithLang as $varKey => $varVal)
            {
				$varLangSwitchCode = $varVal[CountryCode].','.$varVal[LanguageCode].','.$varVal[pkCountryID];
				$varflagurl = SITE_IMG_URL.'flags/'. substr($varVal[CountryCode],0,-1).'.png';
				$varflagdir = SITE_IMG_DIR.'flags/'. substr($varVal[CountryCode],0,-1).'.png';

				if($varOldCountry != $varVal['CountryName'] && $varVal['CountryName'] == $varCountrieswithLang[$varKey+1]['CountryName'])
				{
					$html .= '<li><h5>';
					if(file_exists($varflagdir))
					$html .= '<img alt="'.$varVal['CountryName'].'" src="'.$varflagurl.'" width="16" height="11"> ';

					$html .=  $varVal['CountryName'].'</h5><div class="languages">';
					$html .= "<a href=\"#\" onclick=\"langswitch('$varLangSwitchCode', '$varVal[LanguageCode]')\">".$varVal['LanguageName']." </a>";

				}
				elseif($varOldCountry != $varVal['CountryName'] && $varVal['CountryName'] != $varCountrieswithLang[$varKey+1]['CountryName'])
				{/*
						$html .= "<li><h5>";
						if(file_exists($varflagdir))
						$html .= "<img alt=\"".$varVal['CountryName']."\" src=\"".$varflagurl."\" width=\"16\" height=\"11\">";
						$html .= $varVal['CountryName']."</h5><div class=\"languages\"><a href=\"#\" onclick=\"langswitch('".$varLangSwitchCode."')\"> ".$varVal['LanguageName'].$varLangSwitchCode." </a></div></li>";

						if(count($varCountrieswithLang)!= $counter && $counter%4==0)
						{
							$html .= "</ul><ul>";
						}
						$counter++;*/
				}elseif($varOldCountry == $varVal['CountryName'] && $varVal['CountryName'] != $varCountrieswithLang[$varKey+1]['CountryName']){

						$html .= "&nbsp;|&nbsp;";

						$html .= "<a href=\"#\" onclick=\"langswitch('".$varLangSwitchCode."', '$varVal[LanguageCode]')\">".$varVal['LanguageName']."</a>
												  </div>
											</li>";

						if(count($varCountrieswithLang)!= $counter && $counter%4==0)
						{
							$html .= "</ul><ul>";
						}
						$counter++;
					}elseif($varOldCountry == $varVal['CountryName'] && $varVal['CountryName'] == $varCountrieswithLang[$varKey+1]['CountryName']){
						$html .= "&nbsp;|&nbsp;";

						$html .= "<a href=\"#\" onclick=\"langswitch('".$varLangSwitchCode."', '$varVal[LanguageCode]')\"> ".$varVal['LanguageName']."</a>";

					}
					$varOldCountry = $varVal['CountryName'];

			}

			$html .= "</ul>";

            return $html;
		}
    }


    /**
     * function get_remote_ip
     *
     * This function get the remote ip
     *
     * Database Tables used in this function are : none
     *
     * @access public
     *
     * @parameters 0 none
     *
     * @return float
     */

     function get_remote_ip()
     {
        if ( isset($_SERVER["REMOTE_ADDR"]) )    {
            $ip_address = $_SERVER["REMOTE_ADDR"];
        } else if ( isset($_SERVER["HTTP_X_FORWARDED_FOR"]) )    {
            $ip_address = $_SERVER["HTTP_X_FORWARDED_FOR"];
        } else if ( isset($_SERVER["HTTP_CLIENT_IP"]) )    {
            $ip_address = $_SERVER["HTTP_CLIENT_IP"];
        }
        return $ip_address;
     }

     function calculateEbuddy($ebuddydays){
         global $langobj;
         if($ebuddydays != ''){
         $varEbuddyPeriodRemaining = (EBUDDY_PLAN_DAYS - $ebuddydays);
         $varEbuddyMonthLeft = round( $varEbuddyPeriodRemaining/ 30);
            $varEbuddyString = ($varEbuddyMonthLeft ?  $varEbuddyMonthLeft." ".$langobj->show('months',false) : ($varEbuddyPeriodRemaining==0 ? $langobj->show('today only',false) :$varEbuddyPeriodRemaining." ".$langobj->show('days',false)));
         }else{
            $varEbuddyString = "";
         }
         return $varEbuddyString;
     }



    /**
     * function setMessageForTicket
     *
     * This function set message for ticket
     *
     * Database Tables used in this function are : none
     *
     * @access public
     *
     * @parameters 0 none
     *
     * @return float
     */

     function setMessageForTicket($argfrmTickeType,$argfrmTicketCat,$argfrmTicketData)
     {
        $varMessage = "</br></br>Ticket Type = ".$argfrmTickeType."</br></br>Ticket Category = ".$argfrmTicketCat."</br></br> Message = ".$argfrmTicketData;
        return $varMessage;
     }


     /**
     * function readImageFromSource
     *
     * This function readImageFromSource
     *
     * Database Tables used in this function are : none
     *
     * @access public
     *
     * @parameters 0 none
     *
     * @return float
     */

     function readImageFromSource($argGalleryData)
     {
        $varImageGalleryName = $argGalleryData[imageName];
        $varExtImageGalleryName = pathinfo($varImageGalleryName);
        $varExtImageGalleryNameOnlyName = $varExtImageGalleryName[filename]."_".$argGalleryData[size];
        $varExtImageGalleryNameOnlyExt = $varExtImageGalleryName[extension];
        return $varGalleryNameResize = $varExtImageGalleryNameOnlyName.".".$varExtImageGalleryNameOnlyExt;
     }


     /**
     * function uploadUserPicture
     *
     * This function changes the picture of logged-in user.
     *
     * Database Tables used in this function are : users
     *
     * @access public
     *
     * @parameters array
     *
     * @return int
     */
    public function uploadUserPicture($postData,$objUpload){
        global $objGeneral;
        $uploaddir = SOURCE_ROOT.'common/img/uploaded_image/user_images/';

        $randomName = 'userImage_'.$objGeneral->getSession("eatigo_user_id")."_".$postData['userImage']['name'];
        $imgdetailes[name] = $randomName;
        $imgdetailes[type] = $postData['userImage']['type'];
        $imgdetailes[tmp_name] = $postData['userImage']['tmp_name'];
        $imgdetailes[error] = $postData['userImage']['error'];
        $imgdetailes[size] = $postData['userImage']['size'];
        $varImageUpload = $objUpload->uploadImage($imgdetailes, $uploaddir);
        if($varImageUpload){
            $arrColumns = array('UserImage'=>$varImageUpload);
            $this->update(TABLE_USERS, $arrColumns, " AND pkUserID='".$objGeneral->getSession("eatigo_user_id")."'");
        }
        return true;
    }
    /**
     * function getDifferenceOfDate
     *
     * This function will return difference between date.
     *
     * Database Tables used in this function are : none
     *
     * @access public
     *
     * @parameters array
     *
     * @return int
     */
    function getDifferenceOfDate($argDate)
    {
         $now = time();
         $varBookedDate = strtotime($argDate);
         $varDatediff = $now - $varBookedDate;
         $varDayDfference = floor($varDatediff/(60*60*24));
         return $varDayDfference;
    }

    /**
     * function getResProfileScore
     *
     * This function will return restaurant profile score
     *
     * Database Tables used in this function are : none
     *
     * @access public
     *
     * @parameters array
     *
     * @return int
     */
    function getResProfileScore($argResID,$varSideLeft = false)
    {
        $varScore = 20;
        $varWhere = " and fkRestaurantID = ".$argResID;
        $varWhereExtra = $varWhere." and RestaurantMinPartySize !=0 and RestaurantMaxPartySize != 0 and RestaurantBookingTurnOver !=0 and RestaurantAdvanceBookingHour!=0";
        $arrCountBookingField= $this->getNumRows(TABLE_RES_SETTING,"fkRestaurantID",$varWhereExtra);
        $arrCountNotiField= $this->getNumRows(TABLE_RES_CONTACT,"fkRestaurantID",$varWhere);
        $arrCountExp = $this->getNumRows(TABLE_RES_EXCEPTION,"fkRestaurantID",$varWhere);
        $arrCountYield = $this->getNumRows(REST_YIELD_CAL,"fkRestaurantID",$varWhere);

        if($arrCountBookingField > 0){
            $varScore = $varScore+20;
            $arrResult['varIsBook'] = "Complete";

        }
        if($arrCountNotiField > 0){
            $varScore = $varScore+20;
            $arrResult['varIsNotification'] = "Complete";
        }
        if($arrCountExp > 0){
            $varScore = $varScore+20;
            $arrResult['varIsHrExceptions'] = "Complete";

        }
        if($arrCountYield > 0){
            $varScore = $varScore+20;
            $arrResult['varIsYield'] = "Complete";
        }
        $arrResult['varScore'] =$varScore;
        if($varSideLeft)
            return $arrResult;
        else
            return $varScore;
    }

    /* This function checkUserSMSNotification
     *
     * Database Tables used in this function are : none
     *
     * @access public
     *
     * @parameters array
     *
     * @return string
     */
    function checkUserSMSNotification($argUserID){
        $varWhere = " AND pkUserID = $argUserID";
        $arrColumn = array("pkUserID","UserPhone","UserSMSNotification");
        $arrData= $this->select(TABLE_USERS,$arrColumn,$varWhere);

        if($arrData[0]['UserSMSNotification'] == "YES" && $arrData[0]['UserPhone']!=""){
            return TRUE;
        } else{
            return FALSE;
        }
    }

    /* This function sendEmailTicket
     *
     * Database Tables used in this function are : none
     *
     * @access public
     *
     * @parameters array
     *
     * @return string
     */
    function sendEmailTicket($argArrData){
        $varSiteLogo = SITE_ROOT_URL."common/img/logo_eatigo.png";
        $varDate = date('Y-m-d H:i:s');

        if($argArrData[frnFromWhere] == 'front'){
            $varPath2 = $this->getLangTemplateFilePath("send_ticket.html");
            $varSub = TICKET_EMAIL_SUBJECT;
        } else {
            $varPath2 = "common/template/en/send_ticket.html";
             $varSub = "eatigo troubleticket received ";
        }

        ob_start();
        require_once(SOURCE_ROOT . $varPath2);
        $varOutputMailOwner = ob_get_contents();
        ob_end_clean();

        $varKeywordOwner = array('{SITE_LOGO}','{FULL_NAME}','{UNIQUE_NO}','{DATE_OF_TICKET_POST}','{MESSAGE_OF_TROUBLE_TICKET}','{SITE_NAME}');
        $varMessageMerge = $this->setMessageForTicket($argArrData['frmTickeType'],$argArrData['frmTicketCat'],$argArrData['frmTicketData']);

        if($argArrData[frnFromWhere] == 'front'){
            $varKeywordValuesOwner = array($varSiteLogo,"Admin ",$argArrData[uniqueNo],$varDate,$varMessageMerge,SITE_NAME);
        } else{
            $varKeywordValuesOwner = array($varSiteLogo,$argArrData[frmUserFullName],$argArrData[uniqueNo],$varDate,$varMessageMerge,SITE_NAME);
        }

        $varMessageOwner = str_replace($varKeywordOwner, $varKeywordValuesOwner, $varOutputMailOwner);

        if($argArrData[frnFromWhere] == 'front'){
            $mailArg = array("to" => $argArrData[UserEmailAdmin],
                "subject" => $varSub,
                "message" => $varMessageOwner
            );
        } else{
            $mailArg = array("to" => $argArrData[UserEmailAdmin],
                "subject" => $varSub,
                "message" => $varMessageOwner
            );
        }

        $this->sendMail($mailArg);

    }


     /**
    * function sendWelcomeEmail
    *
    * This functionsendWelcomeEmail
    *
    * Database Tables used in this function are : none
    *
    * @access public
    *
    * @parameters string
    *
    * @return bool
    */
   public function sendWelcomeEmail($argArrData,$argFileName){
        $varSiteLogo = SITE_ROOT_URL."common/img/logo_eatigo.png";
        ob_start();
        $varPath = $this->getLangTemplateFilePath($argFileName,$argArrData['language']);
        require_once(SOURCE_ROOT . $varPath);
        $varOutputMail = ob_get_contents();
        ob_end_clean();
        $varKeyword = array('{SITE_LOGO}','{FULL_NAME}','{URL_APP_STORE}','{URL_PLAYSTORE}','{SITE_NAME}');
        $varKeywordValues = array($varSiteLogo,$argArrData['UserFirstName']." ".$argArrData['UserLastName'],URL_APP_STORE,URL_PLAYSTORE,SITE_NAME);
        $varMessageOwner = str_replace($varKeyword, $varKeywordValues, $varOutputMail);
        $arrMailUser = array("to" => $argArrData['UserEmail'],
        "subject" => WELCOME_SUBJECT,
        "message" => $varMessageOwner
        );
        $this->sendMail($arrMailUser);
   }

     /* This function updateUserCounters
     *
     * Database Tables used in this function are : user_counters
     *
     * @access public
     *
     * @parameters array
     *
     * @return string
     */
    function updateUserCounters($argData)
    {
        $varTable= TABLE_USER_COUNTER;
        $varWhere = 'AND fkUserID=\''.$argData['UserID'].'\'';
        $arrCountCols = array('pkUserCountID','UserLoginCounts','UserFbShareCounts','UserLastLoginDate as LastLogin');
        $arrCount = $this->select($varTable,$arrCountCols,$varWhere);
        if(is_array($arrCount) && count($arrCount)>0){
            if($argData['LoginCounts']=='yes')
            {
                if($arrCount[0]['LastLogin']!=date('Y-m-d'))
                {
                    $varLogincount = $arrCount[0]['UserLoginCounts']+1;
                    //$varFbShareCount = $arrCount[0]['UserFbShareCounts'];
                    $arrCols = array('fkUserID'=>$argData['UserID'],'UserLoginCounts'=>$varLogincount,'LastDateModified'=>'now()','UserLastLoginDate'=>date('Y-m-d'));
                    $this->update($varTable,$arrCols,$varWhere);
                }
            }else if($argData['FbShareCounts']=='yes'){
                    //$varLogincount = $arrCount[0]['UserLoginCounts'];
                    $varFbShareCount = $arrCount[0]['UserFbShareCounts']!=''?$arrCount[0]['UserFbShareCounts']+1:1;
                    $arrCols = array('fkUserID'=>$argData['UserID'],'UserFbShareCounts'=>$varFbShareCount,'LastDateModified'=>'now()');
                    $varAffectedRows = $this->update($varTable,$arrCols,$varWhere);
                    if($varAffectedRows)
                        return true;
                    else
                        return false;
            }
        }else{
            $arrCols = array('fkUserID'=>$this->getSession("eatigo_user_id"),'UserLoginCounts'=>1,'UserFbShareCounts'=>0,'LastDateModified'=>'now()','UserLastLoginDate'=>date('Y-m-d'));
            $this->insert($varTable,$arrCols);
        }
    }


    /* This function getUserBadges
     *
     * Database Tables used in this function are : none
     *
     * @access public
     *
     * @parameters integer
     *
     * @return array
     */

    function getUserBadges($userID)
    {
        if($userID == '') return false;
        elseif(file_exists(SOURCE_ROOT.'common/user_badges/user_badges_'.$userID.'.json'))
        {
            $contents = file_get_contents(SITE_ROOT_URL.'common/user_badges/user_badges_'.$userID.'.json');
            $contents = json_decode($contents);

            $arrUserBadges = array();
            if(is_array($contents->content))
            {
                foreach($contents->content as $key=>$content)
                {
                    $arrUserBadges[$key]['BadgeImage'] = SITE_IMG_URL.'badges/'.$content->BadgePossibleDesign;
                    $arrUserBadges[$key]['BadgeName'] = $content->BadgeName;
                }
            }
            $arrUserBadges = array("total" => $contents->total,  "badges" => $arrUserBadges);
            return $arrUserBadges;
        }   else    {
            return false;
        }
    }
}?>