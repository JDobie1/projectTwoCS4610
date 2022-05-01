function insertToFavorites(v) {
    document.location.href = "movies.php?movieID=" + v;
}
function removeFromFavorites(r) {
    document.location.href = "favorites.php?movieID=" + r;
}

