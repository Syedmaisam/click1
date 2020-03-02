<?php
require_once SOURCE_ROOT.'mailerlite/PHP/base/ML_Rest.php';
class ML_Lists extends ML_Rest
	{
		function ML_Lists( $api_key )
		{	
			$this->name = 'lists';

			parent::__construct($api_key);
		}
		

	}
