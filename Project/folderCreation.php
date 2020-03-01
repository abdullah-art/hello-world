<?php
    session_start();
    require('connection.php');
      $msg1="";
      $error1="";
      $msg="";
      $fd="";
      $arr=array();
      $sql="";
      $bool="false";
      $uid=$_REQUEST["uid"];
        if(isset($_REQUEST["action"]) && !empty($_REQUEST["action"] && !empty($_REQUEST["child"])))
        {
            $parent=$_REQUEST["folder"];
            $childName=$_REQUEST["child"];

            if($parent=="")
            {
                $sql1="SELECT * FROM folders where folderName='$childName' and parentFolderId is NULL";
                $result1=mysqli_query($conn,$sql1);
                if($result1==true)
                {
                    $recs=mysqli_num_rows($result1);
                    if(!$recs>0)
                    {
                        $sql="INSERT INTO folders (folderName,id) VALUES ('$childName','$uid')";
                    }
                }  
            }
            else
            {
                $sql1="SELECT * FROM folders where folderName='$childName' and parentFolderId='$parent'";
                $result1=mysqli_query($conn,$sql1);
                if($result1==true)
                {
                    $recs=mysqli_num_rows($result1);
                    if(!$recs>0)
                    {
                        $sql="INSERT INTO folders (folderName,parentFolderId,id) VALUES ('$childName','$parent','$uid')";
                    }
                }  
               
            }
            if($sql!="" && mysqli_query($conn,$sql)==true)
            {
                $msg1="FOLDER CREATED SUCCESSFULLY!";
                $query="SELECT * FROM folders ORDER BY folderId DESC LIMIT 1";
                $result=mysqli_query($conn,$query);
                $records=mysqli_num_rows($result);
               
                while($row=mysqli_fetch_assoc($result))
                {
                    $fd=$row["folderId"];
                }
                $bool="true";
                array_push($arr,array("id"=>$fd,"flag"=>$bool));
                $output["data"]=$arr;

            }
            else{
                array_push($arr,array("id"=>"","flag"=>$bool));
                $error1="Problem Occured!";
                $output["data"]=$arr;
            }
          
            echo json_encode($output);

    }
?>

