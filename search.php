<?php
$pageTitle = "Find Alumni - Search";
$additionalCSS = '<style>
.search-container {
    min-height: 80vh;
    padding: 2rem 0;
}
</style>';
include 'includes/header.php'; 
?>
<div class="search-container">
    <div class="container">
        <div class="row"> 
            <div class="col-md-12">
                <div class="card mt-4">
                    <div class="card-header">
                        <h4>Search The Name or Sector of the Alumni here</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-7">

                                <form action="" method="GET">
                                    <div class="input-group mb-3">
                                        <input type="text" name="search" required value="<?php if(isset($_GET['search'])){echo $_GET['search']; } ?>" class="form-control" placeholder="Search...." autocomplete="off">
                                        <button type="submit" class="btn btn-primary">Search</button>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-12">
                <div class="card mt-4">
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Registration No.</th>
                                    <th>Picture</th>
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>Email</th>
                                    <th>Phone Number</th>
                                    <th>Passing Year</th>
                                    <th>Work As</th>
                                    <th>Position</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                // require '_connection.php';
                                    $con = mysqli_connect("localhost","root","","alumni123");

                                    if(isset($_GET['search']))
                                    {
                                        $filtervalues = $_GET['search'];
                                        $query = "SELECT * FROM Alumni WHERE CONCAT(aname,a2name,acompany,atitle) LIKE '%$filtervalues%' ";
                                        $query_run = mysqli_query($con, $query);

                                        if(mysqli_num_rows($query_run) > 0)
                                        {
                                            foreach($query_run as $items)
                                            {
                                                ?>
                                                <tr>
                                                    <td><?= $items['aid']; ?></td>
                                                    <td>
                                                        <img src="<?php echo $items['a_image']; ?>" alt="" height="100px" width="100px">
                                                    </td>
                                                    <td><?= $items['aname']; ?></td>
                                                    <td><?= $items['a2name']; ?></td>
                                                    <td><?= $items['aemail']; ?></td>
                                                    <td><?= $items['acontact']; ?></td>
                                                    <td><?= $items['asession']; ?></td>
                                                    <td><?= $items['acompany']; ?></td>
                                                    <td><?= $items['atitle']; ?></td>
                                                </tr>
                                                <?php
                                            }
                                        }
                                        else
                                        {
                                            ?>
                                                <tr>
                                                    <td colspan="9">No Record Found</td>
                                                </tr>
                                            <?php
                                        }
                                    }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<?php include 'includes/footer.php'; ?>