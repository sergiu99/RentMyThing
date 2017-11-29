<?php
class Favorites extends Controller{
	
	function index(){
        $id = $_SESSION['userID'];
        $aFavorite = $this->model('Favorite');
        $favorites = $aFavorite->getFavorites();
        $aCategory = $this->model('Category');
		$categories = $aCategory->get();
		$this->view('Favorites/index',['items'=>$favorites, 'categories'=>$categories, 'category'=>"", 'keyword'=>"", 'type'=>"Listings"]);
    }
}
?>