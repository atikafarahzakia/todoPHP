<?php
include 'config/app.php';

if (isset($_POST['tambah'])) {
    if (tambah($_POST) > 0) {
        $alert = "
        <div class='alert alert-success alert-dismissible fade show' role='alert'>
            <strong>Berhasil!</strong> Data berhasil ditambahkan.
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
        </div>";
    } else {
        $alert = "
        <div class='alert alert-danger alert-dismissible fade show' role='alert'>
            <strong>gagal</strong> Data gagal ditambahkan.
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
        </div>";
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
                        <input
                            type="text"
                            class="form-control"
                            name="title" />
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Description</label>
                        <textarea class="form-control" name="description" rows="2"></textarea>
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
                                    <td class="action-icons">
                                        <a href="" class="edit"><i class="fa-solid fa-pen-to-square fa-xl"></i></a>
                                        <a href="" class="delete"><i class="fa-solid fa-trash fa-xl"></i></a>
                                    </td>
                                    <td class="action-tick">
                                        <a href="" class="tick"><i class="fa-solid fa-check fa-xl"></i></a>
                                    </td>
                            </tr>
                        <?php endforeach ?>
                        </tbody>
                    </table>
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