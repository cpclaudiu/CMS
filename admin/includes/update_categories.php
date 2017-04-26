                        <!-- Edit category form -->
                        <form action="" method="POST">

                            <div class="form-group">
                                <label for="cat-title">Edit Category</label>
                                <?php  
// update categories
                                if(isset($_GET['edit'])){

                                    $cat_id = $_GET['edit'];

                                    $sql = "SELECT * FROM categories WHERE cat_id=$cat_id ";
                                    $query = mysqli_query($conn, $sql);

                                    while($row = mysqli_fetch_assoc($query)){
                                        $cat_title = $row['cat_title'];
                                        $cat_id = $row['cat_id']; 

                                ?>
                                <input value="<?php if(isset($cat_title)){ echo $cat_title; }?>" type="text" class="form-control" name="cat_title">


                                <?php
                                    }
                                }
                                ?>

                                <?php  
                                // UPDATE QUERY

                                if(isset($_POST['update_category'])){

                                    $post_cat_title = $_POST['cat_title'];

                                    $sql = "UPDATE categories SET cat_title='{$post_cat_title}' WHERE cat_id={$cat_id} ";

                                    $query =mysqli_query($conn, $sql);

                                    if(!$query){
                                        die("QUERY FILED" . mysqli_error($conn));
                                    }
                                    
                                    header("Location: categories.php");
                                }

                                ?>





                            </div>
                            <div class="form-group">
                                <input class="btn btn-primary" type="submit" name="update_category" value="Update Category">
                            </div>
                        </form>