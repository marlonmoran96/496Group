<!DOCTYPE html>

<head>
	<?php 
	include 'functions.php';
	dbConnect();

	if(isset($_SESSION['userId'])) {
	$userId = $_SESSION['userId'];
	}else {
	  $user = null;
	  header('Location: ' . "./");
	}
	?>
	<meta charset="utf-8">

	<title>User Home</title>
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
	<link rel="stylesheet" href="./cssFiles/bootstrap/bootstrap.min.css.map" >
	<link rel="stylesheet" href="./cssFiles/bootstrap/bootstrap.min.css">
	<link href="./cssFiles/styleSheet.css" rel="stylesheet">

	<script src="https://code.jquery.com/jquery-3.4.0.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="./jsFiles/bootstrap/bootstrap.bundle.min.js.map"></script>
	<script src="./jsFiles/bootstrap/bootstrap.bundle.js.map"></script>
	<script src="./jsFiles/bootstrap/bootstrap.js"></script>

</head>

    
<body >
       <nav class="navbar navbar-expand navbar-dark bg-secondary fixed-top">

        <a class="navbar-brand mr-2"  id="title">NoteBox</a>
        <form class="form-inline">
                <ul class="navbar-nav mr-auto">
                        <li class="nav-item active">
                          <a class="nav-link" href="./home.php" style="background-color:goldenrod;">Home <span class="sr-only">(current)</span></a>
                        </li>
                        <li class="nav-item active">
                                <a class="nav-link" href="myNotes.php">MyNotes <span class="sr-only">(current)</span></a>
                              </li>
                              <li class="nav-item active">
                                    <a class="nav-link" href="#">Favorites<span class="sr-only">(current)</span></a>
                                  </li>
                        </ul>
        </form>

        <!--  -->
        <!-- search form -->
        <script>
          function search_validate(){
            var search_input = document.forms["search_form"]["search_keyword"].value;
              if(search_input == ""){
                alert("Please Enter a Keyword for search");
                return false;
                // window.location.replace("home.php");
              }
          }
        </script>
        <form class="d-none d-md-inline-block  ml-auto" name = "search_form" onsubmit = "return search_validate()" action="search.php" method="POST">
          <div class="input-group" >
            <input type="text" class="form-control" name="search_keyword" id="search_keyword" placeholder="Search for Notes">
            <div class="input-group-append" >
                <button type="submit" name="searchBtn" id="searchBtn" class="btn btn-primary" >
                  <i class="fa fa-search"></i>
                </button>
            </div>
          </div>
        </form>

        <script>

        </script>

        <style>

        </style>

    
        <ul class="navbar-nav ml-auto ml-md-0">
          <li class="nav-item dropdown no-arrow mx-1">
            <a class="nav-link dropdown-toggle" role="button" data-toggle="dropdown" >
                    <i class="fas fa-envelope-square"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-right">
              <a class="dropdown-item" href="#">stuff</a>
              <a class="dropdown-item" href="#">more stuff</a>
            </div>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle"  role="button" data-toggle="dropdown" >
             <i class="far fa-user"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-right" >
              <a class="dropdown-item" href="#" id="getReq">School/Course Requests</a>
              <a class="dropdown-item" href="profile.php" >Profile</a>
              <a class="dropdown-item" href="ticket.php">Feedback</a>
              <a class="dropdown-item" href="FAQ.php">FAQ</a>

              <div class="dropdown-divider"></div>

              <!-- <form method="POST" action="home.php"> -->
              <a class="dropdown-item" href="logout.php" name="logoutBtn" id="logoutBtn">Logout</a>
              <!-- </form> -->

            </div>
          </li>
        </ul>
    
      </nav>
      
      <header>
            <div class="head">
              <h1>
                Welcome
                <?php
                  get_userName();
                ?>
              </h1>
            </div>
      </header>
          

          <div class="row" >
            <div class="card w-50 bg-secondary mb-3 rounded-0" style="width: 18rem;" >
                 <div class="card-header" id="courseListTxt">
                   Schools
                 </div>
                 <ul class="list-group list-group-flush"  >
                   <?php showUserSchools($userId); ?>
                   <li class="list-group-item" href="#" id="add_course_btn">Add a Course</li>

                 </ul>
               </div>
        
               <div class="card w-50 bg-secondary mb-3 rounded-0" style="width: 18rem;" >
                     <div  class="card-header" id="courseListTxt">
                       Favorite Notes
                     </div>
                     <ul class="list-group list-group-flush"  >
						<?php showUserNotes($userId); ?>

                     </ul>
                   </div>
       
         </div>
 
      
        </div>
        <div class="footerDiv">
          <ul id="footer">
            <li><a href="./ticket.php">Send Feedback</a></li>
                <li><a href="./ticket.php">Help</a></li>
                <li><a href="./FAQ.php">FAQ</a></li>
                </li>
         </ul>
        </div>
 
</body>




 <!--request pop-up -->
 <div id="reqModal" class="reqmodal" >
    <!-- reqModal content -->
    <div  class="reqmodal-content">
      <span class="close">&times;</span>

      <a style="font-size:28px;">School/Course Request</a><br><br>

      <div class="req-form-group">

           <form action="home.php" method="POST">
             <div class="reqrow">
              <div class="req-col-25">
                <label for="requestType">Request Type*</label>
              </div>
              <div class="req-col-75">
                <select id="requestTypeSlection" name="requestTypeSlection" onchange="reqFormDisplay()">
                  <option value="SCHOOL" id="requestSchool" >New School Request</option>
                  <option value="COURSE" selected>New Course Request</option>
                </select>
              </div>
            </div>
            <div class="reqrow">
              <div class="req-col-25">
                <label for="req_school">School Name*</label>
              </div>
              <div class="req-col-75">
                <input type="text" id="sName" name="sName" placeholder="Enter School Name" required="required">
              </div>
            </div>
            <div class="reqrow" id="reqAcro_hidden_section">
              <div class="req-col-25">
                <label for="req_acronym">Acronym*</label>
              </div>
              <div class="req-col-75">
                <input type="text" id="acronym" name="acronym" placeholder="Enter School Acronym" required="required">
              </div>
            </div>
            <div class="reqrow" id="reqC_hidden_section">
              <div class="req-col-25">
                <label for="req_course">Course Name</label>
              </div>
              <div class="req-col-75">
                <input type="text" id="cName" name="cName" placeholder="Enter Course Name">
              </div>
            </div>
            <div class="reqrow" id="reqS_hidden_section">
              <div class="req-col-25">
                <label for="section">Section</label>
              </div>
              <div class="req-col-75">
                <input type="text" id="section" name="section" placeholder="Enter Course Section">
              </div>
            </div>
            <!-- <div class="reqrow">
              <div class="req-col-25">
                <label for="subject">Subject</label>
              </div>
              <div class="req-col-75">
                <textarea id="subject" name="subject" placeholder="Write something.." style="height:200px"></textarea>
              </div>
            </div> -->
            <br>
            <div class="reqrow">
              <input type="submit" name="submitReq" value="Submit Request" id= "reqSubmit" style="background-color:goldenrod">
            </div>
            </form> 

            <?php
              if(isset($_POST['submitReq'])){
                echo '<script>
                  var modal = document.getElementById("reqModal");
                  modal.style.display = "none";
                </script>';
                sch_crs_request_submit();
                $alertMessage = $_SESSION['alertMessage'];
                echo "<script>alert('$alertMessage')</script>";

              }
            ?>

      </div>
    </div>
    
</div>


 <!--add course pop-up -->
 <div id="AddCourseModal" class="reqmodal" >
    <!-- reqModal content -->
    <div  class="reqmodal-content">
      <span class="close close1">&times;</span>

      <a style="font-size:28px;">Add a Course</a><br><br>

      <div class="req-form-group">

           <form action="functions.php" method="POST">
             <div class="reqrow">
              <div class="req-col-25">
                <label for="addC_Sch">School</label>
              </div>
              <div class="req-col-75">
              <form action="">
                <select id="addC_Sch_selection" name="addC_Sch_selection"></select>
                <form>
              </div>
            </div>
            <div class="reqrow">
              <div class="req-col-25">
                <label for="addC_Course">Course</label>
              </div>
              <div class="req-col-75">
                <select id="addC_Course_selection" name="addC_Course_selection"></select>
                <!-- test show course -->
                <!-- <div id="txtHint">Courses info will be listed here...</div> -->
              </div>
            </div>
            <br>
            <div class="reqrow">
              <input type="submit" name="submit_add_course" value="Add" id="submit_add_course" style="background-color:goldenrod">
            </div>
            </form> 

            <?php
              if(isset($_POST['submit_add_course'])){
                echo '<script>
                  var AddCourseModal = document.getElementById("AddCourseModal");
                  AddCourseModal.style.display = "none";
                </script>';
              }
            ?>

      </div>
    </div>
    
</div>

<script>
    //Ajax Db get course by school select
    
	$(document).ready(function(){
		
		var selectedSchool;
		var selectedCourse;
		
		loadSchools();
		
		$('#addC_Sch_selection').on('change', function() {
				loadCourses(this.value);
		});
		
		function loadSchools(){
			var schools = new Array();
			$.ajax({
				type:"POST",
				url:"functions.php",
				data:{listSchools: 1},
				success:function(data){
					schools = JSON.parse(data);
					for(var i = 0; i < schools.length; i++){
						$('#addC_Sch_selection').append(schools[i]);
					
						
					}
					$("#addC_Sch_selection").val($("#addC_Sch_selection option:first").val());
					selectedSchool = $('#addC_Sch_selection').val();
					loadCourses($('#addC_Sch_selection').val());
				}
				
			});		
		}
		
		function loadCourses(school){
			var courses = new Array();
			var newHtml = "";
			
			console.log(school);
			
			$.ajax({
				type:"POST",
				url:"functions.php",
				data:{listCourses: school},
				success:function(data){
					try{
						courses = JSON.parse(data);
						console.log(courses);
						for(var i = 0; i < courses.length; i++){
							newHtml += courses[i];
						}
						$("#addC_Course_selection").html(newHtml);
						$("#addC_Course_selection").val($("#addC_Course_selection option:first").val());
						selectedCourse = $("#addC_Course_selection").val();
					}catch(err){
						console.log(err.message);
						$("#addC_Course_selection").html("<option value='noCourse' id='added_School'>No Courses Available</option>");
					}
				}
			});
			
		}
	});

    // Get the modal
    var modal = document.getElementById('reqModal');
    var AddCourseModal = document.getElementById('AddCourseModal');
    // Get the button that opens the modal
    var reqbtn = document.getElementById("getReq");
    var add_course_btn = document.getElementById("add_course_btn");
    // Get the <span> element that closes the modal
    var span = document.getElementsByClassName("close")[0];
    var span1 = document.getElementsByClassName("close1")[0];
    var reqSubmit = document.getElementById('reqSubmit');
    // When the user clicks the button, open the modal 
    reqbtn.onclick = function() {
      modal.style.display = "block";
    }
    //clicks on <span> (x), close the modal
    span.onclick = function() {
      modal.style.display = "none";
    }
    //clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
      if (event.target == modal) {
        modal.style.display = "none";
      }
    }

    add_course_btn.onclick = function() {
      AddCourseModal.style.display = "block";
    }
    //clicks on <span> (x), close the modal
    span1.onclick = function() {
      AddCourseModal.style.display = "none";
    }
    //clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
      if (event.target == AddCourseModal) {
        AddCourseModal.style.display = "none";
      }
    }

    //display course name and section if it's course request
    var reqS_hidden_section = document.getElementById('reqS_hidden_section');
    var reqC_hidden_section = document.getElementById('reqC_hidden_section');

    function reqFormDisplay() {
      var requestTypeSlection = document.getElementById("requestTypeSlection").value;
        if (requestTypeSlection == "COURSE"){
          reqS_hidden_section.style.display = "block";
          reqC_hidden_section.style.display = "block";
        } else{
          reqS_hidden_section.style.display = "none";
          reqC_hidden_section.style.display = "none";
        }
    }

    function Crs_dependon_Sch(){
      var addC_Sch_Slection = document.getElementById("added_School").value;
      document.getElementById("addC_Course_selection").value;
      // location.reload();
    }
    </script>

    <style>
        
    /* The Modal (background) */
        .reqmodal {
          display: none; /* Hidden by default */
          position: fixed; /* Stay in place */
          z-index: 1; /* Sit on top */
          padding-top: 100px; /* Location of the box */
          left: 0;
          top: 0;
          width: 100%; /* Full width */
          height: 100%; /* Full height */
          overflow: auto; /* Enable scroll if needed */
          background-color: rgb(0, 0, 0); /* Fallback color */
          background-color: rgba(0,0,0,0.6); /* Black w/ opacity */
        }

        /* Modal Content */
        .reqmodal-content {
          background-color:white;
          margin: auto;
          padding: 20px;
          border: 1px solid #888;
          width: 50%;
          height:fill;
        }

        /* The Close Button */
        .close {
          color:grey;
          float: right;
          font-size: 28px;
          font-weight: bold;
        }

        .close:hover,
        .close:focus {
          color: goldenrod;
          text-decoration: none;
          cursor: pointer;
        }

        /* req from */
        * {
          box-sizing: border-box;
        }

        input[type=text], select, textarea {
          width: 100%;
          padding: 12px;
          border: 1px solid #ccc;
          border-radius: 4px;
          resize: vertical;
        }

        label {
          padding: 12px 12px 12px 0;
          display: inline-block;
        }

        input[type=submit] {
          background-color: #4CAF50;
          color: white;
          padding: 12px 20px;
          border: none;
          border-radius: 4px;
          cursor: pointer;
          float: right;
        }

        input[type=submit]:hover {
          background-color: #45a049;
        }

        .container {
          border-radius: 5px;
          background-color: #f2f2f2;
          padding: 20px;
        }

        .req-col-25 {
          float: left;
          width: 25%;
          margin-top: 6px;
          padding-left:5px;
        }

        .req-col-75 {
          float: left;
          width: 75%;
          margin-top: 6px;
        }

        /* Clear floats after the columns */
        .reqrow:after {
          content: "";
          display: table;
          clear: both;
        }

        /* Responsive layout - when the screen is less than 600px wide, make the two columns stack on top of each other instead of next to each other */
        @media screen and (max-width: 600px) {
          .col-25, .col-75, input[type=submit] {
            width: 100%;
            margin-top: 0;
          }
        }
        </style>
        


</html>