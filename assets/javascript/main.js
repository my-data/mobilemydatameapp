//(function(){
// set up the timeout variable
var t;
// setup the sizing function,
// with an argument that tells the chart to animate or not
function size(animate){
    // If we are resizing, we don't want the charts drawing on every resize event.
    // This clears the timeout so that we only run the sizing function
    // when we are done resizing the window
    clearTimeout(t);
    // This will reset the timeout right after clearing it.
    t = setTimeout(function(){
        $("canvas").each(function(i,el){
            // Set the canvas element's height and width to it's parent's height and width.
            // The parent element is the div.canvas-container
            $(el).attr({
                "width":$(el).parent().width(),
                "height":$(el).parent().outerHeight()
            });
        });
        // kickoff the redraw function, which builds all of the charts.
        redraw(animate);

        // loop through the widgets and find the tallest one, and set all of them to that height.
        var m = 0;
        // we have to remove any inline height setting first so that we get the automatic height.
        $(".widget").height("");
        $(".widget").each(function(i,el){ m = Math.max(m,$(el).height()); });
        $(".widget").height(m);

    }, 100); // the timeout should run after 100 milliseconds
}
$(window).on('resize', size);
function redraw(animation){
    var options = {};
    if (!animation){
        options.animation = false;
    } else {
        options.animation = true;
    }
    // ....
        // the rest of our chart drawing will happen here
    // ....
}

size(); // this kicks off the first drawing; note that the fi

  
        var randomScalingFactor = function(){ return Math.round(Math.random()*100)};
        var lineChartData = {
            labels : ["January","February","March","April","May","June","July"],
            datasets : [
                {
                    label: "My First dataset",
                    fillColor : "rgba(220,220,220,0.2)",
                    strokeColor : "rgba(220,220,220,1)",
                    pointColor : "rgba(220,220,220,1)",
                    pointStrokeColor : "#fff",
                    pointHighlightFill : "#fff",
                    pointHighlightStroke : "rgba(220,220,220,1)",
                    data : [randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor()]
                },
                {
                    label: "My Second dataset",
                    fillColor : "rgba(151,187,205,0.2)",
                    strokeColor : "rgba(151,187,205,1)",
                    pointColor : "rgba(151,187,205,1)",
                    pointStrokeColor : "#fff",
                    pointHighlightFill : "#fff",
                    pointHighlightStroke : "rgba(151,187,205,1)",
                    data : [randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor()]
                }
            ]
        }

    // window.onload = function(){
    //   //  var ctx = document.getElementById("canvas").getContext("2d");
    //     window.myLine = new Chart(ctx).Line(lineChartData, {
    //         responsive: true})

    //     var ctx2 = document.getElementById("canvas_2").getContext("2d");
    //     window.myLine2 = new Chart(ctx2).Line(lineChartData, {
    //         responsive: true});     

    //     var ctx3 = document.getElementById("canvas_3").getContext("2d");
    //     window.myLine3 = new Chart(ctx3).Line(lineChartData, {
    //         responsive: true}); 
    //     };



//chart 2
var data = [
    {
        value: 20,
        color:"#637b85"
    },
    {
        value : 30,
        color : "#2c9c69"
    },
    {
        value : 40,
        color : "#dbba34"
    },
    {
        value : 10,
        color : "#c62f29"
    }

];
// var canvas = document.getElementById("hours");
// var ctx = canvas.getContext("2d");
// new Chart(ctx).Doughnut(data);

//chart 3
var data = {
    labels : ["Helpful","Friendly","Kind","Rude","Slow","Frustrating"],
    datasets : [
        {
            fillColor : "rgba(220,220,220,0.5)",
            strokeColor : "#637b85",
            pointColor : "#dbba34",
            pointStrokeColor : "#637b85",
            data : [65,59,90,81,30,56]
        }
    ]
}

// var canvas = document.getElementById("departments");
// var ctx = canvas.getContext("2d");
// new Chart(ctx).Radar(data, options);

//interactive buttons
 function button_click(){
    //console.log("button clicked");
    $(".round-button-circle").on("click", function() {
        //color = $("round-button-circle").style.backgroundColor;
        // console.log(color);
        // if (color === "red") {
        //     $(this).css("background-color","green");
        // }
        // if (color === "green") {
        //     $(this).css("background-color","red");
        // }
        $(this).css("background-color", "red");
        currentvalue = $(this).text();
        if(currentvalue == "Off"){
            document.getElementById(".round-button").value="On";
            $(this).css("background-color","green");
        } else {
            //document.getElementById(".round-button").value="Off";
        }
    });
}

//the table interactivity
function clear_all(){
    console.log("clear all click");
    //$(document).ready(function() {
    $("#raw-data-table").find("td").remove();
//});
}

// $('#raw-table-data').visualize();


// var rectDemo = d3.select("#rect-demo").
//     append("svg:svg").
//     attr("width",400).
//     attr("height",300);

//     rectDemo.append("svg:rect").
//         attr("x",100).
//         attr("y",100).
//         attr("height",100).
//         attr("width",200);

// function showChart(str){
//     var xmlhttp;
//     if (str="")
//     {
//         document.getElementById("txtHint").innerHTML="";
//         return;
//     }
//     if (window.XMLHttpRequest)
//         {// code for IE7+, firefox, Chrome, Opera, Safari
//             xmlhttp=new XMLHttpRequest();
//         }
//     else {
//         { // code for UE6, IE5
//             xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
//         }
//         xmlhttp.onreadystatechange=function(){
//             if (xmlhttp.readyState==4 @@ xmlhttp.status==200){
//                 document.getElementById("txtHint").innerHTML=xmlhttp.responseText;
//             }
//         }
//         xmlhttp.open("GET","raw-data/getdata.php?q="+str,true);
//         xmlhttp.send();
//     }   

//}
