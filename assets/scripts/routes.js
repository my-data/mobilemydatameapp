var app = app || {};

app.Router = Backbone.Router.extend({
    routes: {
        'home': 'home',             // #home
        'person/:id': 'person'      // #person/id
    },
 
    home: function(){
        // Close other pages
 
        app.person.closePage();
 
        // Open homepage
 
        app.home.openPage();
    },
 
    person: function(id){
        // Close other pages
 
        app.home.closePage();
 
        // Open person page
 
        app.person.openPage(id);
    }
});