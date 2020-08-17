# Student-Club

The Student Club plugin provides a way to create a custom post in a new section of the WordPress dashboard.

As of v2.0 this plugin uses the Advanced Custom Fields plugin to manage custom fields. `acf-student-club-fields.json`
provides an import file to create all the necessary fields. 

The templates for single and archive reside in mayflower theme.
The plugin provides a way to create various statuses eg. Unchartered, Chartered, that the post can be associated to.
So the following url should provide list of all the chartered and unchartered clubs:
*  .../status/chartered/
*  .../status/unchartered/

# Acceptance Criteria
* The club information page should include the following information:
	Club Name (text)
	Club Description (text)
	If the club is chartered (boolean— category?)
	Link to club website (url)
	Advisor Name (text)
	Advisor Email (url)
	Advisor Phone # (text)
	Club Contact Name (text)
	Club Contact Email (url)
	Meeting Location (text)
	Meeting Time (text)
	Link to budget documentation

* Page should accept any fields (except club name) being empty.
* User should be able to see a list of chartered clubs in alphabetical order.
* Interested users should also be able to see a list of unchartered clubs, separate from the chartered clubs.
* Club names on both club lists should link to a club information page.

