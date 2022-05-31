# Post Service API

This API retrieves postal information provided a mexican Zip Code:

The first step was to set up development environment:

- Create a new Laravel Project (via composer).
- Share the project on a public repository (on GitHub).
- Set up the deployment (on Heroku).

In order to decrease the response time I´ll try to read the source data from the txt file and treat it as read-only
static data.

Is the Zip Code is found, all there is to do is to present it in the corresponding format.

Storing the data in a file turned out to be very inefficient, so I stored the data in a DB and use a JSON Resource class
to serialize the controller response.