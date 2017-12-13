<?php
class Favorites extends Controller{
    
    //Get a user's favorites
	function index(){
        $id = $_SESSION['userID'];
        $aFavorite = $this->model('Favorite');
        $favorites = $aFavorite->getFavorites();

        //Get the available categories
        $aCategory = $this->model('Category');
        $categories = $aCategory->get();

        //Set empty search parameters category, keyword
		$this->view('Favorites/index',['items'=>$favorites, 'categories'=>$categories, 'category'=>"", 'keyword'=>"", 'type'=>"Listings"]);
    }

    //Create and insert a new favorite record
    function setFavorite(){
        $itemId = $_GET['item'];
        $userId = $_SESSION['userID'];
        $newFavorite = $this->model('Favorite');
        $newFavorite->item_id = $itemId;
        $newFavorite->user_id = $userId;
        $newFavorite->insert();
    }
    
    //Remove a favorite from the database
    //$id The id of the favorite to be removed
    function removeFavorite($id){
        $userId = $_SESSION['userID'];
        $theFavorite = $this->model('Favorite');
        $theFavorite = $theFavorite->where('user_id','=',$userId)->where('item_id','=',$id)->get()[0];
        $theFavorite->delete();
        header("location:/Favorites/index");
    }
}
?>