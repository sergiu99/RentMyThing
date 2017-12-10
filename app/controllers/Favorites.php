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

    function setFavorite(){
        $itemId = $_GET['item'];
        $userId = $_SESSION['userID'];
        $newFavorite = $this->model('Favorite');
        $newFavorite->item_id = $itemId;
        $newFavorite->user_id = $userId;
        $newFavorite->insert();
        echo "adding favorite";
    }

    function removeFavorite(){
        $itemId = $_GET['item'];
        $userId = $_SESSION['userID'];
        $theFavorite = $this->model('Favorite');
        $theFavorite = $theFavorite->where('user_id','=',$userId)->where('item_id','=',$itemId)->get()[0];
        $theFavorite->delete();
        echo "removing favorite";
    }

    function removeFavoriteWithId($id){
        $userId = $_SESSION['userID'];
        $theFavorite = $this->model('Favorite');
        $theFavorite = $theFavorite->where('user_id','=',$userId)->where('item_id','=',$id)->get()[0];
        $theFavorite->delete();
        header("location:/Favorites/index");
    }
}
?>