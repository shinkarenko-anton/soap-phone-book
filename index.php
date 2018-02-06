<?php session_start();
include 'client.php';

//inserting data
if (isset($_POST['ADD_STUDENT'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    if ($client->insertData($_POST)) {
        $msg = array('1', "Student added successfully.");
    } else {
        $msg = array('0', "Sorry, student adding failed.");
    }
    $_SESSION['msg'] = $msg;
}

//geting edit items
if (isset($_REQUEST['edit'])) {
    $id = $_GET['id'];
    $data = $client->getById($id);
}

//updateing data
if (isset($_POST['UPDATE_STUDENT'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    if ($client->update($id, $name, $email, $phone, $address)) {
        $msg = array('1', "Student updated successfully.");
    } else {
        $msg = array('0', "Sorry, student updating failed.");
    }
    $_SESSION['msg'] = $msg;
    header("Location: /");
    exit;
}

//deleting data
if (isset($_REQUEST['delete'])) {
    $id = $_GET['id'];
    if ($client->delete($id)) {
        $msg = array('1', "Student deleted successfully.");
    } else {
        $msg = array('0', "Sorry, student deleting failed.");
    }
    $_SESSION['msg'] = $msg;

    header("Location: /");
    exit;
}


// to show updating form
$isEdit = isset($_REQUEST['edit']) ? true : false;

?>

<!DOCTYPE html>
<html>
<head>
    <title>CRUD with Sqlite</title>
    <style type="text/css">
        .red {
            color: red;
        }

        .green {
            color: green;
        }
    </style>
</head>
<body>
<div style="margin: 0 auto; width: 800px;">
    <div>
        <form style="display:<?php echo $isEdit ? 'none' : 'block'; ?>" action="" method="post">
            <input type="text" name='name' placeholder="Enter name"><br>
            <input type="string" name='email' placeholder="Enter email" required=""><br>
            <input type="text" name='phone' placeholder="Enter phone" required=""><br>
            <input type="test" name='address' placeholder="Enter address" required=""><br>
            <input type="submit" name="ADD_STUDENT" value="Add">
        </form>

        <form style="display:<?php echo $isEdit ? 'block' : 'none'; ?>" action="" method="post">
            <input type="hidden" name="id" value="<?php echo isset($data) ? $data['id'] : ''; ?>">
            <input type="text" name='name' value="<?php echo isset($data) ? $data['name'] : ''; ?>"
                   placeholder="Enter name"><br>
            <input type="email" name='email' value="<?php echo isset($data) ? $data['email'] : ''; ?>"
                   placeholder="Enter email" required=""><br>
            <input type="text" name='phone' value="<?php echo isset($data) ? $data['phone'] : ''; ?>"
                   placeholder="Enter phone"><br>
            <input type="text" name='address' value="<?php echo isset($data) ? $data['address'] : ''; ?>"
                   placeholder="Enter address"><br>
            <input type="submit" name="UPDATE_STUDENT" value="Save">
        </form>

        <?php if (isset($_SESSION['msg']) && !empty($_SESSION['msg'])) { ?>
            <p class="<?php echo $_SESSION['msg'][0] == 0 ? 'red' : 'green'; ?>"><?php echo $_SESSION['msg'][1]; ?></p>
        <?php } ?>
    </div>
    <table cellpadding="5" border="1" width="100%">
        <tr>
            <td>ID</td>
            <td>Name</td>
            <td>Email</td>
            <td>Phone</td>
            <td>Address</td>
            <td>Action</td>
        </tr>
        <?php
        $result = $client->getAll();
        foreach ($result as $row) { ?>

            <tr>
                <td><?php echo $row['id']; ?></td>
                <td><?php echo $row['name']; ?></td>
                <td><?php echo $row['email']; ?></td>
                <td><?php echo $row['phone']; ?></td>
                <td><?php echo $row['address']; ?></td>
                <td>
                    <a href="?edit=true&id=<?php echo $row['id']; ?>">Edit</a> |
                    <a href="?delete=true&id=<?php echo $row['id']; ?>" onclick="return confirm('Are you sure?');">Delete</a>
                </td>
            </tr>
        <?php } ?>

    </table>
</div>
<?php $_SESSION['msg'] = array(); ?>
</body>
</html>