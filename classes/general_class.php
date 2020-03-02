<?php
class Common {
	public $page;
	public $purchase;
	public function __construct($page,$purchase){
		$this->page=$page;
		$this->purchase=$purchase;
	}
	public function changeHeader(){
		if($this->page == '/froober/index.php'){
			$data = "<div class='header_bottom_innerpage'><div class='headerin_bottom_innerpage'>HOME</div></div>";
		}
		else if($this->page == '/froober/market_place.php'){
			$data = "<div class='header_bottom_innerpage'><div class='headerin_bottom_innerpage'>HOME > <span>MARKETPLACE</span></div></div>";
		}
		else if($this->page == '/froober/selled_tweets.php'){
			$data = "<div class='header_bottom_innerpage'><div class='headerin_bottom_innerpage'>HOME > <span>TWEETS TO SEND OUT</span></div></div>";
		}
		else if($this->page == '/froober/aboutus.php'){
			$data = "<div class='header_bottom_innerpage'><div class='headerin_bottom_innerpage'>HOME > <span>ABOUT US</span></div></div>";
		}
		else if($this->page == '/froober/blog.php'){
			$data = "<div class='header_bottom_innerpage'><div class='headerin_bottom_innerpage'>HOME > <span>BLOG</span></div></div>";
		}
		else if($this->page == '/froober/contact.php'){
			$data = "<div class='header_bottom_innerpage'><div class='headerin_bottom_innerpage'>HOME > <span>CONTACT US</span></div></div>";
		}
		else if((parse_url($this->page, PHP_URL_QUERY)) && ($this->purchase)!=''){
			$data = "<div class='header_bottom_innerpage'><div class='headerin_bottom_innerpage'>HOME > MARKETPLACE > <span>PURCHASE</span></div></div>";
		}
		return $data;
	}
	public function checkLogin()
	{
		if(isset($_SESSION['user_id']) && $_SESSION['user_id']!=''){

		} else
		{
			$objGenral->standardRedirect(SITE_ROOT_URL.'celebrities/');
		}
	}
}