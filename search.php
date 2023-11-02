<?php
   ob_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Book Records</title>
    <a href="Library2.php" class="btn btn-primary"><< Go Back Home</a>
    <center><h1><b>List of Books</b></h1></center>
    <center>Today is <?php print date("F d, Y"); ?></center><br>
</head>
<body>
<div class="container">
    <div class="input-group mb-3">
        <div class="input-group-text p-0">
            <form action="search.php" method="GET">
                <select name="category" class="form-select form-select-bg shadow-none bg-light border-0" action="search.php" value="">
                    <option hidden><?php if(isset($_GET['category']) && !empty($_GET['category'])){
                        echo $_GET['category'];
                    }else{
                        $_GET['category'] = "All";
                        echo $_GET['category'];
                    } ?></option>
                    <option value="All">All</option>
                    <option value="Action">Action</option>
                    <option value="Classics">Classics</option>
                    <option value="Comic">Comic</option>
                    <option value="Fantasy">Fantasy</option>
                    <option value="Fiction">Fiction</option>
                    <option value="Horror">Horror</option>
                    <option value="Literary">Literary</option>
                    <option value="Novel">Novel</option>
                    <option value="Mystery">Mystery</option>
                </select>
        </div>
            <input type="text" name="search" value="<?php if(isset($_GET['search'])){echo $_GET['search']; } ?>" class="form-control" placeholder="Search book record">
                <button type="submit" class="btn input-group-text shadow-none px-4 btn-outline-primary my-2 my-sm-0">Search
                    <i class="bi bi-search"></i>
                </button>
            </form>
    </div>
    <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="card mt-4">
                    <div class="card-body">
                    <div class="table-responsive text-nowrap">
                        <table class="table table-bordered table-striped">
                            <thead align="center">
                                <tr>
                                    <th>Book Number</th>
                                    <th>Books cover</th>
                                    <th>Title</th>
                                    <th>Author</th>
                                    <th>Category</th>
                                    <th>Edition</th> 
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    include 'connect.php';
                                
                                    if(!empty($_GET['search'])){
                                        $search = $_GET['search'];
                                        if($_GET['category'] != "All"){
                                            $category = $_GET['category'];
                                            
                                            $result_per_page=5;
                                            $query = "SELECT * from books WHERE title LIKE '%$search%' AND category LIKE '%$category%'";
                                            $result = mysqli_query($con, $query);
                                            $number_of_result = mysqli_num_rows($result);
                                            $number_of_page = ceil($number_of_result / $result_per_page);
    
                                            if (!isset($_GET['page']))
                                            $page=1;
                                            else
                                            $page = $_GET['page'];
    
                                            $page_first_result = ($page-1)*$result_per_page;
    
                                            $query1="SELECT * from books WHERE title LIKE '%$search%' AND category LIKE '%$category%' order by bookno LIMIT $page_first_result, $result_per_page";
                                            $result1=mysqli_query($con,$query1);

                                        if(mysqli_num_rows($result1) > 0){
                                            foreach($result1 as $row){
                                            echo "<tr align=center>";
                                            echo "<td>"; echo $row ['bookno']; echo "</td>";
                                            echo "<td>"; echo '<img src="book-cover/'.$row["image"].'" alt="Image" style="width: 100px; height: 100px;">';
                                            echo "<td>"; echo $row ['title']; echo "</td>";
                                            echo "<td>"; echo $row ['author']; echo "</td>";
                                            echo "<td>"; echo $row ['category']; echo "</td>";
                                            echo "<td>"; echo $row ['edition']; echo "</td>";
                                            echo "</tr>";
                                        }
                                        echo "</table> $number_of_result total records<p>Page/s >>";
                                        for ($page=1; $page<=$number_of_page;$page++)
                                        echo "<a href = search.php?search=$search&category=$category&page=$page class='btn btn-primary'>$page</a>";
                                        }else{
                                            ?>
                                            <tr>
                                                <td colspan="6" align="center">No Record Found</td>
                                            </tr>
                                            <?php
                                        }
                                        }else{
                                            $query="SELECT * from books  WHERE title LIKE '%$search%'";
                                            $result_per_page=5;
                                            $result = mysqli_query($con, $query);
                                            $number_of_result = mysqli_num_rows($result);
                                            $number_of_page = ceil($number_of_result / $result_per_page);
    
                                            if (!isset($_GET['page']))
                                            $page=1;
                                            else
                                            $page = $_GET['page'];
    
                                            $page_first_result = ($page-1)*$result_per_page;
    
                                            $query1="SELECT * from books  WHERE title LIKE '%$search%' order by bookno LIMIT $page_first_result, $result_per_page";
                                            $result1=mysqli_query($con,$query1);

                                        if(mysqli_num_rows($result1) > 0){
                                            foreach($result1 as $row){
                                            echo "<tr align=center>";
                                            echo "<td>"; echo $row ['bookno']; echo "</td>";
                                            echo "<td>"; echo '<img src="book-cover/'.$row["image"].'" alt="Image" style="width: 100px; height: 100px;">';
                                            echo "<td>"; echo $row ['title']; echo "</td>";
                                            echo "<td>"; echo $row ['author']; echo "</td>";
                                            echo "<td>"; echo $row ['category']; echo "</td>";
                                            echo "<td>"; echo $row ['edition']; echo "</td>";
                                            echo "</tr>";
                                        }
                                        echo "</table> $number_of_result total records<p>Page/s >>";
                                        for ($page=1; $page<=$number_of_page;$page++)
                                        echo "<a href = search.php?search=$search&page=$page class='btn btn-primary'>$page</a>";
                                        }else{
                                            ?>
                                            <tr>
                                                <td colspan="6" align="center">No Record Found</td>
                                            </tr>
                                            <?php
                                        }
                                    }
                                }else{
                                    if($_GET['category'] != "All"){
                                        $category = $_GET['category'];

                                        $query = "SELECT * from books WHERE category LIKE '%$category%'"; 
                                        $result_per_page=5;
                                        $result = mysqli_query($con, $query);
                                        $number_of_result = mysqli_num_rows($result);
                                        $number_of_page = ceil($number_of_result / $result_per_page);

                                        if (!isset($_GET['page']))
                                        $page=1;
                                        else
                                        $page = $_GET['page'];

                                        $page_first_result = ($page-1)*$result_per_page;

                                        $query1="SELECT * from books WHERE category LIKE '%$category%' order by bookno LIMIT $page_first_result, $result_per_page";
                                        $result1=mysqli_query($con,$query1);

                                    if(mysqli_num_rows($result1) > 0){
                                        foreach($result1 as $row){
                                        echo "<tr align=center>";
                                        echo "<td>"; echo $row ['bookno']; echo "</td>";
                                        echo "<td>"; echo '<img src="book-cover/'.$row["image"].'" alt="Image" style="width: 100px; height: 100px;">';
                                        echo "<td>"; echo $row ['title']; echo "</td>";
                                        echo "<td>"; echo $row ['author']; echo "</td>";
                                        echo "<td>"; echo $row ['category']; echo "</td>";
                                        echo "<td>"; echo $row ['edition']; echo "</td>";
                                        echo "</tr>";
                                    }
                                    echo "</table> $number_of_result total records<p>Page/s >>";
                                    for ($page=1; $page<=$number_of_page;$page++)
                                    echo "<a href = search.php?category=$category&page=$page class='btn btn-primary'>$page</a>";
                                    }else{
                                        ?>
                                        <tr>
                                            <td colspan="6" align="center">No Record Found</td>
                                        </tr>
                                        <?php
                                    }    
                                    }else{
                                        if($_GET['category'] == "All"){
                                            $query = "SELECT * FROM books";

                                            $result_per_page=5;
                                            $result = mysqli_query($con, $query);
                                            $number_of_result = mysqli_num_rows($result);
                                            $number_of_page = ceil($number_of_result / $result_per_page);
    
                                            if (!isset($_GET['page']))
                                            $page=1;
                                            else
                                            $page = $_GET['page'];
    
                                            $page_first_result = ($page-1)*$result_per_page;
    
                                            $query1="SELECT * FROM books ORDER BY bookno LIMIT $page_first_result, $result_per_page";
                                            $result1=mysqli_query($con,$query1);

                                        if(mysqli_num_rows($result1) > 0){
                                            foreach($result1 as $row){
                                            echo "<tr align=center>";
                                            echo "<td>"; echo $row ['bookno']; echo "</td>";
                                            echo "<td>"; echo '<img src="book-cover/'.$row["image"].'" alt="Image" style="width: 100px; height: 100px;">';
                                            echo "<td>"; echo $row ['title']; echo "</td>";
                                            echo "<td>"; echo $row ['author']; echo "</td>";
                                            echo "<td>"; echo $row ['category']; echo "</td>";
                                            echo "<td>"; echo $row ['edition']; echo "</td>";
                                            echo "</tr>";
                                        }
                                        echo "</table> $number_of_result total records<p>Page/s >>";
                                        for ($page=1; $page<=$number_of_page;$page++)
                                        echo "<a href = search.php?page=$page class='btn btn-primary'>$page</a>";
                                        }else{
                                            ?>
                                            <tr>
                                                <td colspan="6" align="center">No Record Found</td>
                                            </tr>
                                        <?php
                                        }
                                    }
                                }
                            }
                            ?>
                        </tbody>
                        </table>
                    </div>
                    </div>
                </div>
        </div>
        <div class="container mt-2">
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModal">Add Books</button>
        <div class="modal" id="myModal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Book Form</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                <form action="search.php" method="POST">
                    <div class="modal-body">
                        <div class="form-group ">
                                <label class="form-label required">Title</label>
                                <input type="text" name="title" class="form-control" placeholder="Enter Title" required>
                            </div>
                            <div class="form-group">
                                <label class="form-label required">Author</label>
                                <input type="text" name="author" class="form-control" placeholder="Enter Author"required>
                            </div>
                            <div class="form-group">
                            <label class="form-label required">Category</label>
                                <select type="text" name="category" class="form-control form-select" required>
                                <option value="category">Select category</option>
                                <option value="Action">Action</option>
                                <option value="Classics">Classics</option>
                                <option value="Comic">Comic</option>
                                <option value="Fantasy">Fantasy</option>
                                <option value="Fiction">Fiction</option>
                                <option value="Horror">Horror</option>
                                <option value="Literary">Literary</option>
                                <option value="Novel">Novel</option>
                                <option value="Mystery">Mystery</option>    
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="form-label required">Edition</label>
                                <input type="integer" name="edition" class="form-control" placeholder="Enter Edition" required>
                            </div>
                            <div class="form-group">
                                <label class="form-label required">Image</label>
                                <input type="file" name="image" id="imagefile" accept="image/*" class="form-control" placeholder="Insert Image" required>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" name="submitbtn" class="btn btn-primary">Submit</button>
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js" integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-kjU+l4N0Yf4ZOJErLsIcvOU2qSb74wXpOhqTvwVx3OElZRweTnQ6d31fXEoRD1Jy" crossorigin="anonymous"></script>
</body>
 </html>
 <?php
if (isset($_POST['submitbtn'])){
$a = $_POST['title'];
$b = $_POST['author'];
$c = $_POST['category'];
$d = $_POST['edition'];
$e = $_POST['image']; 
include ("connect.php"); 
$sql = "INSERT INTO books (title, author, category, edition, image) VALUES ('$a', '$b', '$c', '$d', '$e')";

if (mysqli_query($con, $sql)){    
    echo '<script> alert("Book Successfully Added!")</script>';
    header("LOCATION: search.php");
}else{
echo "Error: " . $sql . "<br>" . mysqli_error($con);
}
mysqli_close($con);
}

?>

 