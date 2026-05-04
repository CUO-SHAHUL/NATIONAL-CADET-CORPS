<?php
include 'db.php';

$message = "";
if(isset($_GET['delete'])){
    $id = $_GET['delete'];
    $conn->query("DELETE FROM cadets WHERE id=$id");
    $message = "Cadet deleted successfully!";
}
$editData = null;
if(isset($_GET['edit'])){
    $id = $_GET['edit'];
    $result = $conn->query("SELECT * FROM cadets WHERE id=$id");
    $editData = $result->fetch_assoc();
}
if(isset($_POST['update'])){
    $id = $_POST['id'];
    $name = $_POST['name'];
    $blood = $_POST['blood'];
    $rank = $_POST['rank'];
    $camps = $_POST['camps'];

    $sql = "UPDATE cadets SET 
            name='$name',
            blood_group='$blood',
            rank='$rank',
            camps='$camps'
            WHERE id=$id";

    $conn->query($sql);
    $message = "Cadet updated successfully!";
}
if(isset($_POST['submit'])){
    $name = $_POST['name'];
    $blood = $_POST['blood'];
    $rank = $_POST['rank'];
    $camps = $_POST['camps'];

    $sql = "INSERT INTO cadets (name, blood_group, rank, camps)
            VALUES ('$name', '$blood', '$rank', '$camps')";

    $conn->query($sql);
    $message = "Cadet added successfully!";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>NCC Cadet Management</title>
</head>
<body>

<h2><?php echo $editData ? "Edit Cadet" : "Add Cadet"; ?></h2>
<p style="color:green;"><?php echo $message; ?></p>

<form method="post">
    <input type="hidden" name="id" value="<?php echo $editData['id'] ?? ''; ?>">

    Name: 
    <input type="text" name="name" required
        value="<?php echo $editData['name'] ?? ''; ?>"><br><br>

    Blood Group: 
    <input type="text" name="blood"
        value="<?php echo $editData['blood_group'] ?? ''; ?>"><br><br>

    Rank: 
    <input type="text" name="rank"
        value="<?php echo $editData['rank'] ?? ''; ?>"><br><br>

    Camps Attended: 
    <textarea name="camps"><?php echo $editData['camps'] ?? ''; ?></textarea><br><br>

    <?php if($editData){ ?>
        <input type="submit" name="update" value="Update Cadet">
    <?php } else { ?>
        <input type="submit" name="submit" value="Add Cadet">
    <?php } ?>
</form>

<hr>

<h2>Cadet List</h2>

<table border="2" width="80%" align="center" cellpadding="10"
style="font-size:25px;font-weight:bold;text-align:center;border-collapse:collapse;">

<tr>
    <th>ID</th>
    <th>Name</th>
    <th>Blood Group</th>
    <th>Rank</th>
    <th>Camps</th>
    <th>Action</th>
</tr>

<?php
$result = $conn->query("SELECT * FROM cadets");

if($result->num_rows > 0){
    while($row = $result->fetch_assoc()){
        echo "<tr>
                <td>".$row['id']."</td>
                <td>".$row['name']."</td>
                <td>".$row['blood_group']."</td>
                <td>".$row['rank']."</td>
                <td>".$row['camps']."</td>
                <td>
                    <a href='?edit=".$row['id']."'>Edit</a> |
                    <a href='?delete=".$row['id']."' 
                       onclick='return confirm(\"Delete this record?\")'>
                       Delete
                    </a>
                </td>
              </tr>";
    }
} else {
    echo "<tr><td colspan='6'>No records found</td></tr>";
}
?>

</table>

</body>
</html>