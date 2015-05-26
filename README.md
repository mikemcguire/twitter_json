#Twitter JSON

Wordpress Plugin that serves to provide a GET interface for the twitter API to be used with Javascript apps
This provides endpoints for only GET/READ requests. 

##Installation


1. Upload 'advanced-custom-fields' to the '/wp-content/plugins/' directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Click on the new menu item inside of tools "Twitter JSON"
4. Add you're application credentials
5. Read documentation to generate URLs


##Getting Started

- [Create a twitter app on the twitter developer site](https://dev.twitter.com/apps/)
- Enable read access for your twitter app
- Grab your access tokens from the twitter developer site
- [Choose a twitter REST API to call](https://dev.twitter.com/rest/public)
- Choose collection e.g.(status, media)
- Choose endpoint e.g.(user_timeline, retweets)
- Choose the fields you want to send with the request (example: `?screen_name=iamcodewizard`)

## Current Support
This plugin is a work in progress and only supports small amount of the Twitter API. More support to come

###Supported Collections
- Statuses

###Supported Endpoints
- user_timeline
- show

## Creating URL to access data
```var url = "/twitter_json/" + collection +"/"+ endpoint +"/"+parameters"```

Example:( "/twitter_json/statuses/user_timeline/?screen_name=iamcodewizard" )

## Special Thanks
This plugin uses [Twitter API PHP])(https://github.com/J7mbo/twitter-api-php/) to do all the interfacing with Twitter and merely provides a wrapper that can be used inside of a JAVASCRIPT application.
