<?php



include_once('config.php');

if (isset($_POST["action"])) {
    $query = "select s.file_name,c.color_name, s.stock_id ,s.stock_price, p.p_name, pt.pt_name ,u.unit_name , s.stock_qty , ca.cat_name
    from stock s , product p, product_type pt , unit u, color c , category ca
    where s.p_id = p.p_id
    and pt.pt_id = p.pt_id
    and u.unit_id = s.unit_id
    and s.color_id = c.color_id
    and p.cat_id = ca.cat_id ";

    if (isset($_POST["category"])) {
        $cat_filter = implode("','", $_POST["category"]);
        $query .= "
		 and ca.cat_name IN('" . $cat_filter . "')
		";
    }

    if (isset($_POST["product_type"])) {
        $pt_filter = implode("','", $_POST["product_type"]);
        $query .= "
		 and pt.pt_name IN('" . $pt_filter . "')
		";
    }

    if (isset($_POST["color"])) {
        $color_filter = implode("','", $_POST["color"]);
        $query .= "
		 and c.color_name IN('" . $color_filter . "')
		";
    }
    $statement = $db->prepare($query);
    $statement->execute();
    $result = $statement->fetchAll();
    $total_row = $statement->rowCount();
    $output = '';
    if ($total_row > 0) {
        foreach ($result as $row) {
            $output .= '<div class="col-md-4 mt-5">
            <div class="men-item-carousel">
                <div class="item">
                    <div class="thumb">
                        <div class="hover-content">
                            <form action="" method="post">
                                <ul>
                                    <li><a href="single_product.php?id=' . $row['stock_id'] . ' "><i class="fa fa-eye"></i></a></li>
                                    <li><a href="review_product.php?id=' . $row['stock_id'] . '"><i class="fa fa-star"></i></a></li>
                                    <input type="hidden" name="stock_id" value="' . $row['stock_id'] . '">
                                    <input type="hidden" name="stock_price" value="' . $row['stock_price'] . '">
                                    <input type="hidden" name="unit_name" value="' . $row['unit_name'] . '">
                                    <input type="hidden" name="stock_qty" value="' . $row['stock_qty'] . '">
                                    <input type="hidden" name="file_name" value="' . $row['file_name'] . '">
                                    <input type="hidden" name="color_name" value="' . $row['color_name'] . '">
                                    <input type="hidden" name="p_name" value="' . $row['p_name'] . '">
                                    <li><button id="test-button" type="submit" name="submit"><i class="fa fa-shopping-cart"></i></button></li>
                                </ul>
                            </form>
                        </div>
                        <img src="img/' . $row["file_name"] . '" alt="">
                    </div>
                    <div class="down-content">
                        <h4>' . $row["p_name"] . '</h4>
                        <span>' . 'Rs' . $row['stock_price'] . '</span>
                        <ul class="stars">
                            <li><i class="fa fa-star"></i></li>
                            <li><i class="fa fa-star"></i></li>
                            <li><i class="fa fa-star"></i></li>
                            <li><i class="fa fa-star"></i></li>
                            <li><i class="fa fa-star"></i></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>';
        }
    } else {
        $output = '<h3>No Products Found</h3>';
    }
    echo $output;
}
