<?php
include 'config/app.php';

if (isset($_POST['tambah'])) {
    if (tambah($_POST) > 0) {
        $alert = "
        <div class='alert alert-success alert-dismissible fade show' role='alert'>
            <strong>Berhasil!</strong> Task baru berhasil ditambahkan.
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
        </div>";
    } else {
        $alert = "
        <div class='alert alert-danger alert-dismissible fade show' role='alert'>
            <strong>gagal</strong> Task baru gagal ditambahkan.
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
        </div>";
    }
}

// $edit = [];
// if (isset($_GET['id'])) {
//     $id = (int) $_GET['id'];
//     $edit = tampil("SELECT * FROM todos WHERE id = $id")[0];
// }

if (isset($_POST['ubah'])) {
    if (edit($_POST) > 0) {
        $alert = "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
            <strong>Gagal!</strong> Task gagal diubah.
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
        </div>";
    } else {
        $alert = "<div class='alert alert-success alert-dismissible fade show' role='alert'>
            <strong>Berhasil!</strong> Task berhasil diubah.
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
        </div>";
    }
}

if (isset($_POST['hapus'])) {
    if (isset($_POST['id'])) {
        $id = (int)$_POST['id'];
        if (delete($id) > 0) {
            $alert = "<div class='alert alert-success alert-dismissible fade show' role='alert'>
            <strong>Berhasil!</strong> Task berhasil dihapus.
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
        </div>";
        } else {
            $alert = "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
            <strong>Gagal!</strong> Task gagal dihapus.
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
        </div>";
        }
    }
}

?>

<!doctype html>
<html lang="en">

<head>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <!-- Bootstrap CSS v5.2.1 -->
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
        rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
        crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">


    <link rel="stylesheet" href="style.css">
</head>

<body>
    <header>
        <!-- place navbar here -->
    </header>
    <main>
        <div class="container">
            <!-- buat alert -->
            <div class="mt-5">
                <?php if (isset($alert)) echo $alert; ?>
            </div>
            <!-- add task -->
            <div class="card shadow mt-5 p-3">
                <h3>Add New Task</h3>
                <hr>
                <form action="" method="post">
                    <div class="mb-3">
                        <label for="" class="form-label">Title</label>
                        <input type="text" class="form-control" name="title" required />
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Description</label>
                        <textarea class="form-control" name="description" rows="2" required></textarea>
                        <small>Enter your task today! Have a good day 😊</small>
                    </div>
                    <div class="d-grid mb-3">
                        <button type="submit" name="tambah" class="btn btn-success">Add</button>
                    </div>
                </form>
            </div>

            <!-- view dan complete -->
            <div class="card shadow mt-5 p-3">
                <div class="task">
                    <div class="view-nav">
                        <a href="" class="view-btn">View Task</a>
                    </div>
                    <div class="complete-nav">
                        <a href="" class="complete-btn">Complete Task</a>
                    </div>
                </div>
                <!-- search -->
                <div class="d-flex justify-content-end mt-5">
                    <form class="d-flex col-md-3">
                        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                        <button class="btn btn-outline-primary" type="submit">Search</button>
                    </form>
                </div>

                <!-- table -->
                <div class="table-responsive mt-3">
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr class="text-center">
                                <th scope="col">No</th>
                                <th scope="col" class="w-50">Title</th>
                                <th scope="col" class="w-50">Description</th>
                                <th scope="col" class="w-25">Action</th>
                                <th scope="col" class="w-25">Done</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="">
                                <?php $no = 1 ?>
                                <?php foreach ($todo as $data): ?>
                                    <td><?= $no++; ?></td>
                                    <td><?= htmlspecialchars($data['title']); ?></td>
                                    <td><?= htmlspecialchars($data['description']); ?></td>
                                    <td class="action-icons d-flex gap-3">
                                        <!-- EDITTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTT -->
                                        <div class="edit">
                                            <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#edit<?= $data['id'] ?>">
                                                <i class="fa-solid fa-pen-to-square text-white"></i>
                                            </button>
                                            <div class="modal fade" id="edit<?= $data['id'] ?>" tabindex="-1">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title text-dark" id="editLabel">Edit Task</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form action="" method="post">
                                                                <input type="hidden" name="id" value="<?= $data['id'] ?>">
                                                                <div class="mb-3">
                                                                    <label for="" class="form-label text-dark">Title</label>
                                                                    <input type="text" class="form-control" name="editTitle" value="<?= $data['title'] ?>" />
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="" class="form-label text-dark ">Description</label>
                                                                    <textarea class="form-control" name="editDescription" rows="2"><?= $data['description'] ?></textarea>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                                    <button type="submit" class="btn btn-primary" name="ubah">Save changes</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- HAPUSSSSSSSSSSSSSS -->
                                        <div class="delete">
                                            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#hapus<?= $data['id'] ?>">
                                                <i class="fa-solid fa-trash text-white"></i>
                                            </button>
                                            <div class="modal fade" id="hapus<?= $data['id'] ?>" tabindex="-1" aria-labelledby="hapusLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content">
                                                        <form action="" method="post">
                                                            <input type="hidden" name="id" value="<?= $data['id'] ?>">
                                                            <div class="modal-body">
                                                                <h1 class="text-center text-dark"><i class="fa-regular fa-face-tired"></i></h1>
                                                                <h3 class="text-center text-dark">Apakan anda yakin ingin menghapus?</h3>
                                                            </div>
                                                            <div class="modal-footer d-flex justify-content-center">
                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                                <button type="submit" class="btn btn-danger" name="hapus">Delete</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="action-tick text-center align-middle">
                                        <a href="" class="bg-success rounded p-2"><i class="fa-solid fa-check text-white w-50"></i></a>
                                    </td>
                            </tr>
                        <?php endforeach ?>
                        </tbody>
                    </table>
                </div>
                <div class="d-flex justify-content-end">
                    <nav aria-label="Page navigation example">
                        <ul class="pagination">
                            <li class="page-item"><a class="page-link" href="#">1</a></li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">Next</a></li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>

    </main>
    <footer>
        <!-- place footer here -->
    </footer>
    <!-- Bootstrap JavaScript Libraries -->
    <script
        src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
        crossorigin="anonymous"></script>

    <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
        integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
        crossorigin="anonymous"></script>
</body>

</html>