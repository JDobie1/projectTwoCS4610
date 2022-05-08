# projectTwoCS4610

Our project was initially going to be a platform that was designed for movie lovers
to go online and rate/review their favorite movies. However, we have taken a more social media approach.
Now our project is a database of movies of which you can have your favorites movies in a list, the movies
you plan on watching on a list as well as add friends on. You can now plan out movie trips online and invite
your friends to a theator to catch the screening of a movie together.

SETUP
------------------------------------------------------------------------------------------------------------------------------------------------------
1. In order to setup the project properly you will need to in load up phpMyAdmin and create a database called 'project_two_cs4610'.
2. Upon creating the database you will need to navigate to the SQL tab and insert the Create/Alter tables from file " Proj2_SQL_CREATE_TABLE-FINAL1 "
3. Once the tables are created it is now time to populate them!
4. Navigate to you local host folder (i.e. ../htdocs/projectTwoCS4610/load.php)
//you do not need to have login cridentials to navigate to this as it isn't public facing and is ment for administrative use. from there you can load
//the 'Movies','Users','Actors',and 'Theaters' tables from the .csv files that reside in ../htdocs/projectTwoCS4510/data
5. You're now now ready to create your user by going to http://localhost/projectTwoCS4610/pages/login.php //you will be re-routed to that page if you try to go anywhere else. See the section for load.php for more details.
6. From there you can either sign as another user if you know their name (Prince Hampton is one for reference) or click "here" on the: Not registered? Sign up here.
 //If you signed in as Prince Hampton you can skip step 7
8. Once on the registration page you can fill out all the fields then click the "register" button, which you will automatically be signed into your user and be able to
   navigate freely on the site. You are offically setup!
   
Movies
------------------------------------------------------------------------------------------------------------------------------------------------------
On the 'Movies' page you should see all the movies listed in the center of the page. From there you should be able to apply sorts to the data by clicking
on their respective columns. There will also be filter buttons for you to sort by genre, as well as the 'Favorites'/'Watchlist' buttons to add the
repective movie to each buttons repective page (i.e. click the favorite button and that movie will be added to your users favorite list, same for watchlist)

WatchList
------------------------------------------------------------------------------------------------------------------------------------------------------
This is where all your watchlisted movies will go, from here you can remove movies you no longer want to watch

Favorites
------------------------------------------------------------------------------------------------------------------------------------------------------
This is where all your favorite movies will go, from here you can remove movies you no longer like.

Users
------------------------------------------------------------------------------------------------------------------------------------------------------
Initially upon going to this page you should only see a search bar. If you click 'Search' with no information in the search bar you will get a list of
all the users on the platform. Otherwise you can search by last name of a specific user you are interested in friend requesting. Speaking of which you
can click the "Friend Request" button on a specific user to send them one. // this can be validated by logging in as said user and going to the users tab,
where you will see your pending friend request. When you send a friend request to a user they will be moved into the "My Pending Friend Requests" field that
should be visible now. Upon the user accepting your friend request you can now have the option to remove them as friend.

If you want to see the Friend request information such as who you have sent requests to, who you are friends with, and your general profile information you can navigate to the top right of the screen click your (or whoever you're signed in as) name and select profile.

Theaters
------------------------------------------------------------------------------------------------------------------------------------------------------
The 'Theaters' page is where you can go to meet with other users at theaters near you. Upon arrival theaters will be displayed based off of the logged in users state. Once you select the theater you want to go to you can select 'View More'. Once on there you will see other users that are planning on going to this theater to see a movie and you can add your name to the list of users by click 'Meet here'

Load.php
------------------------------------------------------------------------------------------------------------------------------------------------------
If you ever edit the data in the .csv files in the ../htdocs/projectTwoCS4510/data folder all you have to do is DROP all your tables from the data base, recreate them using the 'Proj2_SQL_CREATE_TABLE-FINAL1' file, and then reload the data by clicking the buttons on load.php. The reason this is done is because auto increment is done so if you click those buttons on load.php more then once you will get duplicates.
