<?php include_once("../includes/header.php") ?>
<?php
require_once '../config/db.php';

// Fetch contacts from the database
try {
    $stmt = $conn->prepare("SELECT * FROM contacts");
    $stmt->execute();
    $contacts = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
    exit;
}
?>
<h1 class="text-center mt-5">Welcome to Simple Contact Management System</h1>
<p class="text-center">This is a simple contact management system built with PHP and MySQL.</p>

<div class="container mt-5">
    <div class="table-container">
        <div class="create-btn-container">
            <a href="create.php"><button class="btn btn-success">Create New</button></a>
        </div>
        <div class="search-filter-container">
            <div class="input-group w-50 mt-4 mb-4">
                <input type="text" class="form-control" placeholder="Search..." aria-label="Search">
                <button class="btn btn-outline-primary" type="button">Search</button>
            </div>
            <select class="form-select w-25 mb-4" aria-label="Filter">
                <option selected>Filter by...</option>
                <option value="first">First Name</option>
                <option value="last">Last Name</option>
                <option value="handle">Handle</option>
            </select>
        </div>
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Contact</th>
                    <th scope="col">Address</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($contacts as $contact): ?>
                    <tr>
                        <th scope="row"><?= htmlspecialchars($contact["id"]) ?></th>
                        <td><?= htmlspecialchars($contact["name"]) ?></td>
                        <td><?= htmlspecialchars($contact["email"]) ?></td>
                        <td><?= htmlspecialchars($contact["address"]) ?></td>
                        <td><?= htmlspecialchars($contact["contact"]) ?></td>
                        <td>
                            <a href="edit.php?id=<?php echo $contact['id']; ?>" class="btn btn-outline-primary btn-sm action-btn">Edit</a>
                            <a href="delete.php?id=<?php echo $contact['id']; ?>" class="btn btn-outline-danger btn-sm action-btn">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<?php include_once("../includes/footer.php") ?>