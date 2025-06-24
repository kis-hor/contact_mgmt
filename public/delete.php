<?php

require_once '../config/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'] ?? '';
    if ($id) {
        try {
            $stmt = $conn->prepare("DELETE FROM contacts WHERE id = :id");
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            header('Location: index.php');
            exit;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    } else {
        echo "All fields are required.";
    }
} elseif (isset($_GET['id'])) {
    $id = $_GET['id'];
    try {
        $stmt = $conn->prepare("SELECT * FROM contacts WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $contact = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$contact) {
            echo "Contact not found.";
            exit;
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
        exit;
    }
} else {
    echo "Invalid request.";
    exit;
}
?>
<?php include_once("../includes/header.php") ?>

<div class="container mt-5">
    <h2>Delete Contact</h2>
    <form method="POST" action="delete.php">
        <input type="hidden" name="id" value="<?= htmlspecialchars($contact['id']) ?>">
        <p>Are you sure you want to delete the contact <strong><?= htmlspecialchars($contact['name']) ?></strong>?</p>
        <button type="submit" class="btn btn-danger">Delete</button>
        <a href="index.php" class="btn btn-secondary">Cancel</a>
    </form>
</div>

<?php include_once("../includes/footer.php") ?>