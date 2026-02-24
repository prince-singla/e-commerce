<?php
require "config/db.php";
include "auth.php";

/* Pagination */
$limit = 5;

$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
if ($page < 1) $page = 1;

$start = ($page - 1) * $limit;

/* Total records */
$totalResult = mysqli_query($conn, "SELECT COUNT(*) AS total FROM users WHERE role = 1");
$totalRow = mysqli_fetch_assoc($totalResult);
$totalRecords = $totalRow['total'];
$totalPages = ceil($totalRecords / $limit);

if ($totalPages > 0 && $page > $totalPages) $page = $totalPages;

/* Fetch paginated users */
$stmt = $conn->prepare("SELECT * FROM users WHERE role = 1 ORDER BY id DESC LIMIT ?, ?");
$stmt->bind_param("ii", $start, $limit);
$stmt->execute();
$result = $stmt->get_result();
?>

<?php include "layouts/header.php"; ?>
<title>User Data</title>
<link rel="stylesheet" href="style.css">
</head>
<body>

<div class="page-container">

    <!-- Header Bar (Same as Products Page) -->
    <div class="table-header-bar">
        <h3>Registered Users</h3>

        <div class="table-header-actions">
            <a href="add.php" class="btn btn-add">+ Add User</a>
            <a href="upload_csv.php" class="btn btn-view">⬆ Upload CSV</a>
        </div>
    </div>

    <!-- Table (Same wrapper like products) -->
    <div class="card table-wrap">
        <table>
            <thead>
            <tr>
                <th>ID</th>
                <th>Image</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Gender</th>
                <th>Hobbies</th>
                <th>Action</th>
            </tr>
            </thead>

            <tbody>
            <?php
            $delay = 0;
            while($row = $result->fetch_assoc()) {
                ?>
                <tr class="fade-row" style="animation-delay: <?= $delay ?>ms;">
                    <td><?= (int)$row['id'] ?></td>

                    <td>
                        <?php if(!empty($row['image'])) { ?>
                            <img src="uploads/<?= htmlspecialchars($row['image']) ?>"
                                 class="user-img"
                                 onclick="openImg(this.src)">
                        <?php } else { ?>
                            No Image
                        <?php } ?>
                    </td>

                    <td><?= htmlspecialchars($row['name']) ?></td>
                    <td><?= htmlspecialchars($row['email']) ?></td>
                    <td><?= htmlspecialchars($row['phone']) ?></td>
                    <td><?= htmlspecialchars($row['gender']) ?></td>
                    <td><?= htmlspecialchars($row['hobbies']) ?></td>

                    <td>
                        <a href="edit.php?id=<?= (int)$row['id'] ?>" class="btn btn-edit">Edit</a>
                        <a href="delete.php?id=<?= (int)$row['id']; ?>&page=<?= $page ?>"
                           class="btn btn-delete"
                           onclick="return confirm('Are you sure you want to delete?');">
                            Delete
                        </a>
                    </td>
                </tr>
                <?php
                $delay += 70;
            }
            ?>
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="pagination-wrap">

        <?php if($page > 1) { ?>
            <a class="nav-btn" href="index.php?page=<?= $page-1 ?>">← Prev</a>
        <?php } else { ?>
            <span class="nav-btn disabled">← Prev</span>
        <?php } ?>

        <div class="page-numbers">
            <?php for($i=1; $i<=$totalPages; $i++) { ?>
                <a href="index.php?page=<?= $i ?>"
                   class="page-btn <?= ($i == $page) ? 'active' : '' ?>">
                    <?= $i ?>
                </a>
            <?php } ?>
        </div>

        <?php if($page < $totalPages) { ?>
            <a class="nav-btn" href="index.php?page=<?= $page+1 ?>">Next →</a>
        <?php } else { ?>
            <span class="nav-btn disabled">Next →</span>
        <?php } ?>

    </div>

</div>

<!-- Image Modal (Same as products page) -->
<div id="imgModal" class="img-modal" onclick="closeImg()">
    <img id="modalImg" class="modal-img">
</div>

<script>
    function openImg(src) {
        document.getElementById("imgModal").style.display = "flex";
        document.getElementById("modalImg").src = src;
    }

    function closeImg() {
        document.getElementById("imgModal").style.display = "none";
    }

    window.addEventListener("pageshow", function (event) {
        if (event.persisted) {
            window.location.reload();
        }
    });
</script>

<?php include "layouts/footer.php"; ?>
