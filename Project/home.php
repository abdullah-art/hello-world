<?php

session_start();
if($_SESSION["userId"]==false)
{
    header('location:login.php');
}
else{
    $uname=$_SESSION["userId"];
    $uid=$_SESSION["uid"];
}

require('connection.php');
?>


<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="favicon.ico" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <script src="jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="temp.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap" rel="stylesheet">
    <title>HOME PAGE</title>

    <script>
     
      let folder="";

        let bool=true;
    
        function loadDoc() {
          fetch('http://localhost/Project/api.php?action=getFolders&folderId=null&uid='+ <?php echo $uid;?>)
          .then(
            function(response) {
              if (response.status !== 200) {
                console.log('Looks like there was a problem. Status Code: ' +
                  response.status);
                return;
              }
              else{
                
              }
            response.json().then(function(obj) {
                let div=document.createElement("div");
                    for (let i = 0; i < obj.data.length; i++) {
                        let ele = document.createElement("button");
                        ele.className="btns";
                        ele.setAttribute("folderId", obj.data[i].id);
                        ele.innerText = obj.data[i].name;
                        div.appendChild(ele);
                    }
                    $(".flex-container").append(div);
                    });
            }
          )
          .catch(function(err) {
            console.log('Fetch Error :-S', err);
          });
        }
      
        loadDoc();
     
    </script>


</head>

<body>



<script>
      $(document).ready(function() {
      $("#createbtn").on("click",function(){
        
        
        let child=$("#childId").val();
        if(child=="")
        {
          let inputMsg="Please fill the input field!";
         
          
          $("#ip").text(inputMsg);
          setTimeout(() => {
            $("#ip").html("");
                  }, 2000);
        }
        else{
            $(".close").click();
        }
        let ele = document.createElement("button");
        
        fetch('http://localhost/Project/folderCreation.php?action=true&child='+child+'&folder='+folder+'&uid='+ <?php echo $uid;?>)
          .then(
            function(response) {
              if (response.status !== 200) {
                console.log('Looks like there was a problem. Status Code: ' +response.status);
                  let error="SOME ERROR OCCURED!";
                   $("#pid1").text(error);
                return;
              }
              else{
                    
                    if(!child=="")
                    {
                        ele.className="btns";
                        ele.innerText = child;
                       
                    }
                    response.json().then(function(obj) {
                        let fd=obj.data[0].id;
                        let flag=obj.data[0].flag;
                        
                        if(flag=="true")
                        {
                          $(".flex-container div").append(ele);
                          ele.setAttribute("folderId", fd);
                          let msg="FOLDER CREATED SUCCESSFULLY!";
                           $("#p1").text(msg);
                              setTimeout(() => {
                                $("#p1").html("");
                      }, 2000);
                        }  
                        else if(flag=="false")
                        {
                          let msg="FOLDER ALREADY EXISTS";
                          $("#p2").text(msg);
                              setTimeout(() => {
                                $("#p2").html("");
                      }, 2000);
                        }
                    })
              }

              }
          )
          .catch(function(err) {
            console.log('Fetch Error :-S', err);
          });
    
      })
});
</script>

<script>
    $(document).ready(function(){
        $(".flex-container").on("click",".btns",function(){
           if(bool)
           {
            $(this).closest(".flex-container").find(".current").css("border","0px");
            $(this).css("border","4px groove #1C6EA4").addClass("current");
            bool=false;
           }
           else{
            $(this).css("border","0px")
            bool=true;
           }
        })
    })

    $(".modal").modal('toggle');
    </script>


    <div class="container-flex c1">
        <div id="div">
            <h2>Welcome <?php echo " $uname" ?></h2>
        </div>


        <div class="container">
            <h2>Modal Example</h2>
            <button type="button" class="btn btn-primary b1" data-toggle="modal" data-target="#myModal">
              CREATE FOLDER
            </button>

            <div class="modal md" id="myModal">
                <div class="modal-dialog">
                    <div class="modal-content">


                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>

                        <div class="modal-body">
                            <span style="color: #00b0ff; ">FOLDER NAME</span>
                            <div>
                                <input type="text" name="child"  id="childId">
                                <p style="color:red;" id="ip"></p>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button  class="btn btn-primary" name="createbtn" id="createbtn">CREATE</button>
                          
                          </div>

                    </div>
                </div>
            </div>

        </div>
        
        <div id="div-1">
        <p id="p1" style="color:green;"></p>
        </div>
        <div id="div-2">
        <p id="p2" style="color:red;"></p>
        </div>
    </div>

   



   <div class="flex-container">
    </div>

    
    <script>
      $(document).ready(function() {
      $(".flex-container").on("dblclick",".btns",function(){
        let id=$(this).attr("folderId");
        folder=id;
        fetch('http://localhost/Project/api.php?action=getFolders&folderId='+id+'&uid='+<?php echo $uid;?>)
          .then(
            function(response) {
              if (response.status !== 200) {
                console.log('Looks like there was a problem. Status Code: ' +
                  response.status);
                  
                return;
              }
            response.json().then(function(obj) {
              let div=document.createElement("div");
        
                    for (let i = 0; i < obj.data.length; i++) {
                        let ele = document.createElement("button");
                        ele.className="btns";
                        ele.setAttribute("folderId", obj.data[i].id);
                        ele.innerText = obj.data[i].name;
                        div.appendChild(ele);
                    }
                      $(".flex-container").append(div);
                       $(".flex-container").children().not(':last').remove();
                       $(".flex-container div button").addClass("btns");
                    });
            }
          )
          .catch(function(err) {
            console.log('Fetch Error :-S', err);
          });

      })

});
    </script>


<script>
$(document).ready(function() {
  $(".modal").on("hidden.bs.modal", function() {
    $("#childId").val("");
  });
});
</script>

</body>

</html>