# MINI API REST FOR DEEZER

This mini API REST

GET USER WITH ID (GET)
http://yagatest.com/user/1

GET SONG WITH ID (GET)
http://yagatest.com/song/1

GET ALL FAVORITE SONGS (GET)
http://yagatest.com/favorite/USER_ID

ADD SONG TO FAVORITE (POST)
http://yagatest.com/favorite/USER_ID => track_id = TRACK_ID

ADD SONG TO FAVORITE (DELETE)
http://yagatest.com/favorite/USER_ID/TRACK_ID

CHANGE OUTPUT WITH PARAM output
http://yagatest.com/user/USER_ID?output=XML