$(document).ready(function(){
	
});

function insertToFavorites(v) {
    document.location.href = "movies.php?movieID=" + v;
}
function removeFromFavorites(r) {
    document.location.href = "favorites.php?movieID=" + r;
}
function insertToWatch(b) {
    document.location.href = "movies.php?wMovieID=" + b;
}
function removeFromWatch(c) {
    document.location.href = "watchlist.php?movieID=" + c;
}