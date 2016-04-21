var app = app || {};

app.initialize = function(){
    // Define the host path
 
    app.host = 'http://www.my-data.org.uk/cloud/get_uri/get';

    // Create router
 
    app.router = new app.Router();
 
    // Start history
 
    Backbone.history.start({
        pushState: true
    });
 
    // Set route
 
    if (app.location){
        app.router.navigate(app.location, { trigger: true });
    }else{
        app.router.navigate('home', { trigger: true });
    }
 
 
    // // Fetch the location
 
    // app.location = window.location.pathname.substring(1);
 
    // // Create homepage
 
    // app.home = new app.HomePageView();
 
    // // Create person page
 
    // app.person = new app.PersonPageView();
 
    // // Create router
 
    // app.router = new app.Router();
 
    // // Start history
 
    // Backbone.history.start({
    //     pushState: true
    // });
 
    // // Set route
 
    // if (app.location){
    //     app.router.navigate(app.location, { trigger: true });
    // }else{
    //     app.router.navigate('home', { trigger: true });
    // }
 
    // // Home click
 
    // $('.js-home').on('click', function(event){
    //     app.router.navigate('home', { trigger: true });
    // });
};