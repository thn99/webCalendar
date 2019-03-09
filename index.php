<?php

require('server.php');
$userId = $_SESSION['id'];

if(empty($_SESSION['username'])){
    header('location: login.php');
}

else{
    $event = "SELECT id, title, description, color, initialday, endday FROM events WHERE user_id = $userId";
    $my_events = mysqli_query($db, $event);
}

?>

<!DOCTYPE html>
<html>
<head>
<meta charset='utf-8' />
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
<link href='styles/fullcalendar.min.css' rel='stylesheet' />
<link href='styles/bootstrap.min.css' rel='stylesheet' />
<link href='styles/fullcalendar.print.min.css' rel='stylesheet' media='print' />
<script src='script/moment.min.js'></script>
<script src='script/jquery.min.js'></script>
<script src='script/fullcalendar.min.js'></script>
<script src='script/bootstrap.min.js'></script>
</head>
<script>


  $(document).ready(function() {

    //open edit modal by clicking on the Edit event button
    $('.edit').on('click', function(){
      $('#edit').modal('show')
    })
    //open remove modal by clicking on the Remove event button
    $('.remove').on('click', function(){
      $('#remove').modal('show')
    })

    //calendar header with infos and buttons
    $('#calendar').fullCalendar({
      header: {
        left: 'prev,next today',
        center: 'title',
        right: 'month,agendaWeek,agendaDay,listWeek'
      },

      defaultDate: Date(), //set today date
      navLinks: true, // can click day/week names to navigate views
      editable: true, //makes the calendar editable
      eventLimit: true, // allow "more" link when too many events
      selectable: true, //allow clicking on the days
      selectHelper: true,

      //clicking on event will open a modal showing all the information about this date
      eventClick: function(event){
        $('#info #title').text(event.title)
        $('#info #description').text(event.description)
        $('#info #start').text(event.start.format('dddd, MMMM DD of YYYY, HH:mm:ss'))
        $('#info #end').text(event.end.format('dddd, MMMM DD of YYYY, HH:mm:ss'))
        $('#info').modal('show')

      },

      //clicking on a day will open a modal asking for information to save a date
      //tip: date is automatically get from the wanted day
      select: function(start, end){
        $('#saveDate #startday').val(moment(start).format('YYYY/MM/DD HH:mm:ss'))
        $('#saveDate #endday').val(moment(end).format('YYYY/MM/DD HH:mm:ss'))
        $('#saveDate').modal('show')
      },

      //gets all saved dates in the database, gets from an array and shows it into the respective date
      events: [

        <?php
        while($row_events = mysqli_fetch_array($my_events)){
          ?>
          {
            id: '<?php echo $row_events['id'];?>',
            title: '<?php echo $row_events['title'];?>',
            description: '<?php echo $row_events['description'];?>',
            start: '<?php echo $row_events['initialday'];?>',
            end: '<?php echo $row_events['endday'];?>',
            color: '<?php echo $row_events['color'];?>',
          },
          <?php
        }
        ?>
        
      ]
    });
  });

</script>
<style>


/*set calendar size and position*/
#calendar {
    max-width: 600px;
    max-height: 300px;
    margin: 50px auto;
    float: left;
}

/*navbar position*/
nav{
  top: 0px;
  left: 0px;
  margin: 0px;
  width: 100%;
}

/*button characteristics*/
nav li{
  display: inline-block;
  position: relative;
}
 
/*button animation*/
nav a:hover::before {
  width: 100%;
}

/*username position*/
#username {
  padding-right: 50px;
}

/*margin between buttons*/
.home, .edit{
  margin-right: 50px;
}

/*button animation*/
nav a::before {
  content: "";
  display: block;
  height: 3px;
  background-color: white;
  position: absolute;
  bottom: 0;
  width: 0%;
  transition: all ease-in-out 250ms;
}

</style>
<body>
<!--navigation bar-->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark mynav">
  <a class="navbar-brand" href="#"></a>
  <button class="navbar-toggler mr-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item" id="username">
        <a class="nav-link">Hello, <?php if(isset($_SESSION['username'])): ?>
        <?php echo $_SESSION['username']; ?>
        <?php endif ?></a>
      </li>
      <li class="nav-item home">
        <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item edit" href="#">
        <a class="nav-link" href="#">Edit event <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item remove" href="#">
        <a class="nav-link" href="#">Remove event <span class="sr-only">(current)</span></a>
      </li>
    </ul>
    <ul class="nav navbar-nav navbar-right">
      <li class="nav-item">
        <a class="nav-link" href="index.php?logout=''" id="logout">Logout</a>
      </li>
    </ul>
  </div>
</nav>

<!--calendar itself-->
<div id='calendar'></div>

<!--save date modal window-->
<div class="modal fade" id="saveDate" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Register event</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
      </div>
      <div class="modal-body">
        <form method="POST" action="submitEvent.php">
        <div>
          <input type="text" class="form-control" name="title" placeholder="Title" autofocus /><br />
        </div>
        <div>
          <input type="text" class="form-control" name="description" placeholder="Description"><br />
        </div>
          <select name="color" class="form-control" id="color">
            <option value="">Level</option>			
              <option style="color:#FFD700;" value="#FFD700">Important</option>
              <option style="color:#228B22;" value="#228B22">Not important</option>
              <option style="color:#8B0000;" value="#8B0000">Extremely important</option>
            </select>
        <div>
        <br />
          <input type="text" class="form-control" name="startday" id="startday" placeholder="Start day: YYYY/MM/DD HH:MM:SS">
          <br />
        </div>
        <div>
          <input type="text" class="form-control" name="endday" id="endday" placeholder="End day: YYYY/MM/DD HH:MM:SS">
          <br />
        </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-success" name='submit' value="submit">Save date</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </form>
      </div>
    </div>
  </div>
</div>

<!--show information of an event in a modal window-->
<div class="modal fade" id="info" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Event</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <dl class="dl-horizontal">
          <dt>Name: </dt><dd id="title"></dd>
          <dt>Description: </dt><dd id="description"></dd>
          <dt>Start day: </dt><dd id="start"></dd>
          <dt>End day: </dt><dd id="end"></dd>
        </dl>
      </div>
      <div class="modal-footer">
      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<!--edit event modal window-->
<div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit event</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
      </div>
      <div class="modal-body">
        <form method="POST" action="editEvent.php">
        <div>
          <input type="text" class="form-control" name="oldTitle" placeholder="Old Title" autofocus><br />
        </div>
        <div>
          <input type="text" class="form-control" name="newTitle" placeholder="New title"><br />
        </div>
        <div>
          <input type="text" class="form-control" name="newDescription" placeholder="New description"><br />
        </div>
          <select name="newColor" class="form-control" id="color">
            <option value="">Level</option>			
              <option style="color:#FFD700;" value="#FFD700">Important</option>
              <option style="color:#228B22;" value="#228B22">Not important</option>
              <option style="color:#8B0000;" value="#8B0000">Extremely important</option>
            </select>
        <div>
        <br />
          <input type="text" class="form-control" name="newSDay" id="startday" placeholder="Start day: YYYY/MM/DD HH:MM:SS">
          <br />
        </div>
        <div>
          <input type="text" class="form-control" name="newEDay" id="endday" placeholder="End day: YYYY/MM/DD HH:MM:SS">
          <br />
        </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-warning" name='edit' value="submit">Edit date</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </form>
      </div>
    </div>
  </div>
</div>
<!--remove event modal window-->
<div class="modal fade" id="remove" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Remove event</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
      </div>
      <div class="modal-body">
        <form method="POST" action="removeEvent.php">
        <div>
          <h5>Please inform the event you want to remove:</h5>
          <input type="text" class="form-control" name="title" placeholder="Title" autofocus><br />
        </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-danger" name='delete' value="submit">Remove date</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </form>
      </div>
    </div>
  </div>
</div>

</body>
</html>