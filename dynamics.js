/*
 * Dynamics.js
 * This file holds all of the javascript functions
 * used by the Dynamics web app.
*/


// Process New Query
function handleQuery(query) {
  results++;
  $("#intro-text").hide();
  var placeholder = document.getElementById("template-loading").innerHTML;
  placeholder = placeholder.replace("{{N}}", results);
  $("#results").prepend(placeholder);
  $("#results").prepend($("<h4></h4>").text(query));
  componentHandler.upgradeAllRegistered();

  var type = queryType(query);
  if(type == "dynamics.help") {
      var answer = document.getElementById("template-help").innerHTML;

      $("#result-" + results).html(answer);
      componentHandler.upgradeAllRegistered();

      smoothHeight($("#result-" + results));
  } else if(type == "icanhazdadjoke.joke") {
    $.getJSON("https://icanhazdadjoke.com/", function(data) {
      var joke = data.joke;

      var answer = document.getElementById("template-joke").innerHTML;
      answer = answer.replace("{{JOKE}}", joke);

      $("#result-" + results).html(answer);
      componentHandler.upgradeAllRegistered();

      smoothHeight($("#result-" + results));
    });
  } else if(type == "wordnic.define") {
    var keywords = query.toLowerCase().replace(/[^0-9a-z ]/g, '').split(" ");
    var word = keywords[keywords.length - 1];

    $.getJSON("http://api.wordnik.com:80/v4/word.json/" + word + "/definitions?limit=5&includeRelated=true&sourceDictionaries=all&useCanonical=false&includeTags=false&api_key=a2a73e7b926c924fad7001ca3111acd55af2ffabf50eb4ae5", function(data) {

      var definitions = "";
      if(data.length == 0) {
          definitions = "<p>No results found.</p>";
      } else {
        for(var i = 0; i < data.length; i++) {
          var definition = data[i];
          definitions += "<p style=\"margin-bottom: 0;\">" + (i+1) + ". <i>" + definition.partOfSpeech + "</i>. " + definition.text + "</p>";
        }
      }

      var answer = document.getElementById("template-definition").innerHTML;
      answer = answer.replace("{{WORD}}", word);
      answer = answer.replace("{{DEFINITIONS}}", definitions);
      answer = answer.replace("{{URL}}", "https://wordnik.com/words/" + word);

      $("#result-" + results).html(answer);
      componentHandler.upgradeAllRegistered();

      smoothHeight($("#result-" + results));
    });
  } else if(type == "wolframalpha.query") {
    $.getJSON("https://cors-anywhere.herokuapp.com/" + "https://api.wolframalpha.com/v2/query?input=" + window.encodeURIComponent(query) + "&format=image&output=JSON&appid=K8QX5P-E3KLQ378HQ", function(data) {
      var pods = data.queryresult.pods;
      var html = "";
      if(pods.length == undefined || pods.length == null) {
        html = "<p>No results found.</p>";
      } else {
        for(var i = 0; (i < pods.length && i < 4); i++) {
          var pod = pods[i];
          html += '<p class="wa-pod"';
          if(i == 0) {
            html += ' style="margin-top: 0;"'
          }
          html += '>' + pod.title + '</p>';
          var subpods = pod.subpods;
          for(var j = 0; j < subpods.length; j++) {
            var image = subpods[j].img;
            html += '<img src="' + image.src + '" alt="' + image.alt + '" title="' + image.title + '" width="' + image.width + '" height="' + image.height + '" style="max-width: 100%; display: block; margin-bottom: 5px;">';
          }
        }
      }

      var answer = document.getElementById("template-wolfram").innerHTML;
      answer = answer.replace("{{OUTPUT}}", html);
      answer = answer.replace("{{URL}}", "https://www.wolframalpha.com/input/?i=" + window.encodeURIComponent(query));

      $("#result-" + results).html(answer);
      componentHandler.upgradeAllRegistered();

      smoothHeight($("#result-" + results));
    });
  } else if (type == "moment.current") {
    var timezone = moment.tz.guess();
    var timezone_string = timezone + " (UTC" + ((moment().tz(timezone).utcOffset()/60) > 0 ? '+' : '-') + (moment().tz(timezone).utcOffset()/60) + ")";

    var answer = document.getElementById("template-time").innerHTML;
    answer = answer.replace("{{TIME_ZONE}}", timezone_string);

    setInterval(function(){
      var time = moment.tz(timezone).format('hh:mm:ss A');
      $("#result-" + results + " .current-time").text(time);
    }, 500);

    $("#result-" + results).html(answer);
    var time = moment.tz(timezone).format('hh:mm:ss A');
    $("#result-" + results + " .current-time").text(time);
    componentHandler.upgradeAllRegistered();

    smoothHeight($("#result-" + results));
  } else if (type == "dynamics.meme") {
      var answer = document.getElementById("template-meme").innerHTML;
      $("#result-" + results).html(answer);
      componentHandler.upgradeAllRegistered();
      $("#result-" + results).attr("style", "");
  } else if (type == "fullcalendar.personal") {
    if($.cookie('logged-in') || prompt("Please enter your password to view the calendar.") == "password") {
      $.cookie('logged-in', true);
      $.getJSON('https://holidayapi.com/v1/holidays?key=8360f161-1b34-4c2e-ae6e-85add453de1f&country=US&year=2016', function(data) {
        var holidays = [];
        for(var day in data.holidays) {
          for(var i = 0; i < data.holidays[day].length; i++) {
            var holiday = data.holidays[day][i];
            holidays.push({
              title: holiday.name,
              start: holiday.date,
              allDay: true,
              color: (holiday.public ? '#0D47A1' : '#1B5E20')
            })
          }
        }

        var answer = document.getElementById("template-calendar").innerHTML;

        $("#result-" + results).html(answer);
        componentHandler.upgradeAllRegistered();

        $("#result-" + results + " .calendar").fullCalendar({
          defaultDate: moment('2016-01-01'),
          validRange: {
            start: '2016-01-01',
            end: '2016-12-31'
          },
          events: holidays
        });

        smoothHeight($("#result-" + results));
      });
    } else {
      $("#result-" + results).html('<div class="mdl-card__supporting-text"><p>Please enter the correct password to view the calendar</p></div><div class="mdl-card__actions mdl-card--border rel-logo"><a class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect" onclick="handleQuery(\'Show me my calendar.\')">Try Again</a></div>');
      componentHandler.upgradeAllRegistered();
      smoothHeight($("#result-" + results));
    }
  }
}

function smoothHeight(element) {
  var naturalHeight = element.css('height', 'auto').height();
  element.css('height', '245px');
  element.animate({height: naturalHeight + 'px'}, 300);
}

// Determine Query Type
function queryType(query) {
  query = query.toLowerCase().replace(/[^0-9a-z ]/g, '');  // Remove non-alphanumeric characters and make lowercase

  // Check each keyword against a predefined list
  var keywords = query.split(" ");
  for(var i = 0; i < keywords.length; i++) {
    var keyword = keywords[i];
    switch(keyword) {
      case "help":
      case "dynamics":
        return "dynamics.help";
      case "joke":
        return "icanhazdadjoke.joke";
      case "meme":
        return "dynamics.meme";
      //case "define":
      //case "definition":
      //case "meaning":
        //return "wordnic.define";
      case "time":
        return "moment.current";
      case "calendar":
      case "schedule":
        return "fullcalendar.personal";
    }
  }
  return "wolframalpha.query";
}
