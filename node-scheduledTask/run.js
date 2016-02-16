var fs = require('fs');
var spawn = require('child_process').spawn;

var ONE_MINUTE = 60 * 1000;
var TEN_MINUTES = 10 * 60 * 1000;

var process, task, schedule, timer, interval;

var watch = function() {
  var current, d;
  
  current = new Date();
  if (schedule[0].date > current) {
    if (interval == TEN_MINUTES) {
      d = schedule[0].date.getTime() - current.getTime();
      if (d < TEN_MINUTES) {
        clearInterval(timer);
        interval = ONE_MINUTE;
        timer = setInterval(watch, interval);
      }
    }    
    
    return;
  }
  
  if (schedule[0].command == 'start') {
    if (process != null) process.kill();
    process = spawn(task);
    console.log('Task started: ' + current);
  } else if (schedule[0].command == 'stop' && process != null) {
    process.kill();
    process = null;
    console.log('Task stoped: ' + current);
  }
  
  clearInterval(timer);
  schedule.splice(0, 1);
  if (schedule.length == 0) return;
  
  d = schedule[0].date.getTime() - current.getTime();
  interval = TEN_MINUTES;
  if (d < TEN_MINUTES) {
    interval = ONE_MINUTE;
  }
  
  timer = setInterval(watch, interval);
};

(function() {
  var config, current, d, i;
  
  config = JSON.parse(fs.readFileSync('config.txt', 'utf8'));
  task = config.task;
  schedule = [];
  current = new Date();
  for (i in config.schedule) {
    d = new Date(config.schedule[i].date);
    if (d > current) {
      schedule.push({
        date: d,
        command: config.schedule[i].command
      });
    }
  }
  
  if (schedule.length == 0) return;
  
  d = schedule[0].date.getTime() - current.getTime();
  interval = TEN_MINUTES;
  if (d < TEN_MINUTES) {
    interval = ONE_MINUTE;
  }
   
  timer = setInterval(watch, interval);
}) ();
