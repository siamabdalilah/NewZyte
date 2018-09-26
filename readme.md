### Module 3
Name: Siam Abd Al-Ilah.
ID: 456968

The link to the project can be found [here](http://ec2-52-15-37-3.us-east-2.compute.amazonaws.com/~siamabdalilah/newssite/index.php)

#### Creative Portion
- Added Timestamp to stories and comments. Stories are listed in reverse chronological order and comments are in chronological order
- Added a 'dashboard' page where all the stories added by the user are listed
- Users can hide stories they want publicly visible by clicking the toggle-hidden button under the story title in their dashboard. Current hidden status of stories also listed

#### Note about CSRF
I did not notice the CSRF requirement at the beginning. When I did, I was almost done, and it would be very hard to rearrange things to add the CSRF tokens. I added them where I could (like inserting and updating stories and comments) and also have some other safety measures to check if the correct user is logged in. Although I guess that might not be very helpful if the attack happens when the user is logged in.


#### Login
Two users registered and posts copied from piazza
- user: anonymous, pass: anonimity
- user: harrisonlu, pass: luharrison
