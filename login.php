<?php
include "komponen/header.php";
if (isset($_SESSION['username'])) {
    echo "<script>window.location.replace('index.php');</script>";
}
$conn = include "connection.php";
?>
<main>
    <section class="container-fluid py-3">
        <div class="row">
            <div class="col-lg-4 mx-auto">
                <form action="komponen/data/doLogin.php" method="post">
                    <div class="card">
                        <div class="card-body">
                            <h2 class="card-title  text-center">Login</h2>
                            <?php include "admin/komponen/alert.php"; ?>
                            <div class="row mb-2">
                                <label for="" class="col-lg-4">Username/No Telp/Hp</label>
                                <div class="col-lg-8">
                                    <input type="text" class="form-control" name="username" required>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <label for="" class="col-lg-4">Password</label>
                                <div class="col-lg-8">
                                    <input type="password" class="form-control" name="password" id="password" required>
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="showPassword">
                                        <label for="" class="form-check-label">Show Password</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-lg-2 mx-auto">
                                    <button type="submit" class="btn btn-primary">Login</button>
                                </div>
                            </div>

                        </div>
                    </div>
                </form>
            </div>
        </div>

    </section>
</main>
<script src="assets/js/jquery-3.7.1.min.js.js"></script>
<script>
    $("#showPassword").click(() => {
        if($("#showPassword").is(":checked")){
            $('#password').attr("type","text");
        }else{
            $('#password').attr("type","password");

        }
    })
</script>
<?php
include "komponen/footer.php";
?>