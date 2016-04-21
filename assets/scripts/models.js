    var app = {}; // create namespace for our app

    app.Todo = Backbone.Model.extend({
      defaults: {
        title: '',
        completed: false
      }
    });
    
var app.inputs_for_user = Backbone.Model.extend({
    url: function(){
        return app.host + '/inputs_for_user/' + 131;
    }
});

var app.timeseriesA0 = Backbone.Model.extend({
    url: function(){
        return app.host + '/input/A0';
    }
});

var app.timeseriesA1 = Backbone.Model.extend({
    url: function(){
        return app.host + '/input/A1';
    }
});

var app.timeseriesA2 = Backbone.Model.extend({
    url: function(){
        return app.host + '/input/A2';
    }
});