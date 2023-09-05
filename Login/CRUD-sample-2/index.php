<?php
include_once('./config/Config.php');
include_once('./lib/Database.php');
include_once('./inc/header.php');

?>
<?php 
    $db = new Database();
    $query = "SELECT * FROM tasks";
    $read = $db->Select($query);
?>
<div class="container">
<h3 class="well text-center">How To Create User Manager in PHP MySQL</h3>

<table class="table">
    <thead class="thead">
        <tr>
            <th>No</th>
            <th>Firstname</th>
            <th>Lastname</th>
            <th>Telephone</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php $i = 1; ?>
        <?php if($read) { ?>
            <?php while($row = $read->fetch_assoc()) { ?>
        <tr>
            <td><?php echo $i++; ?></td>
            <td><?php echo $row['firstname']; ?></td>
            <td><?php echo $row['lastname'];?></td>
            <td><?php echo $row['phone']; ?></td>
            <td><a href="update.php?id=<?php echo $row['id']; ?>" class="glyphicon glyphicon-edit btn btn-primary"> Edit</a></td>
            <td><a href="delete.php?id=<?php echo $row['id']; ?>"  class="glyphicon glyphicon-remove btn btn-danger"> Delete</a></td>
            
    </tr>   
            <?php } ?>
            <?php }else{ echo "DATA NOT FOUND"; } ?>
    </tbody>
    <span><a href="create.php" class="btn btn-success">Add Users</a></span>
</table>
</div>
