<?php
require('connection.php');

if(isset($_REQUEST["action"]) && !empty($_REQUEST["action"]))
{
    $action=$_REQUEST["action"];
    $id=$_REQUEST["folderId"];
    $uid=$_REQUEST["uid"];
    if($action=="getFolders")
    {
        if($id=="null")
        {
            $query="SELECT * FROM folders where id='$uid' and parentFolderId IS NULL";
        }
        else{
            $query="SELECT * FROM folders where id='$uid' and parentFolderId='$id'";
        }
       
        $result=mysqli_query($conn,$query);
        $records=mysqli_num_rows($result);
        $nullFolders=array();
            while($row=mysqli_fetch_assoc($result))
            {
                array_push($nullFolders,array("id"=>$row["folderId"],"name"=>$row["folderName"]));
            }
            $output["data"]=$nullFolders;    

        echo json_encode($output);
    }
}

?>