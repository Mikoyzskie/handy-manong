<?php 
session_start();
if(empty($_SESSION['id'])){
    header("location: login.php?error=loginrequired");
}else{
    
}
?>

    <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; Handy <strong>Manong</strong> 2023</div>
                            <div>
                                <a href="#">Privacy Policy</a>
                                &middot;
                                <a href="#">Terms &amp; Conditions</a>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="js/datatables-simple-demo.js"></script>
        <script>
            function deRequire(elClass) {
            el = document.getElementsByClassName(elClass);

            var atLeastOneChecked = false; //at least one cb is checked
            for (i = 0; i < el.length; i++) {
                if (el[i].checked === true) {
                    atLeastOneChecked = true;
                    console.log('true');
                }
            }

            if (atLeastOneChecked === true) {
                    for (i = 0; i < el.length; i++) {
                        el[i].required = false;
                    }
                } else {
                    for (i = 0; i < el.length; i++) {
                    el[i].required = true;
                    }
                }
            }
        </script>
    </body>
</html>
