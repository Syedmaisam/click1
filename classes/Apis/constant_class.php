<?php
require_once SOURCE_ROOT.'constant_api/src/Ctct/autoload.php';
use Ctct\ConstantContact;
use Ctct\Components\Contacts\Contact;
use Ctct\Components\Contacts\ContactList;
use Ctct\Components\Contacts\EmailAddress;
use Ctct\Exceptions\CtctException;
class constant_Lists extends ContactList
	{
		public $cc;
		public function __construct($api_key,$aceess_token)
		{
			$this->cc = new ConstantContact($api_key);
			
		}
		
		public function getList($aceess_token)
		{
			$lists = $this->cc->getLists($aceess_token);
			return $lists;
		}
		public function addConstantSubscriber($apikey,$accesstoken,$subscriber,$camp_id)
		{
			$access_token=$accesstoken;
			$email=$subscriber['email'];
			$fname=$subscriber['name'];
		
			$contact = new Contact();
            $contact->addEmail($email);
            $contact->addList($camp_id);
            $contact->first_name = $fname;
            $contact->last_name = "";
                     
           return $this->cc->addContact($access_token, $contact, true);
		}

	}
