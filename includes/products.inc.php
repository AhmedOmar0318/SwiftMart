<?php
$getProducts = $conn->prepare("SELECT * FROM product");
$getProducts->execute();

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = array();
}
?>

<div class="bg-base-200">
    <?php if (isset($_SESSION['userId']) && $_SESSION['userId'] == 'Admin') { ?>}
        <button class="btn btn-accent float-right" onclick="window.location.href='index.php?page=addProduct'">Add
            product
        </button>
    <?php } ?>

    <div class="flex justify-center bg-base-200 m-2">
        <div class="grid gap-4 grid-cols-1 sm:grid-cols-2 md:grid-cols-3 w-max">
            <?php while ($product = $getProducts->fetch(PDO::FETCH_ASSOC)) {
                $picture = base64_encode($product['picture'])
                ?>
                <div class="card bg-base-100 shadow-xl">
                    <div class="card w-96 bg-base-100 shadow-xl">

                        <figure class="px-10 pt-10">
                            <img src="data:image/png;base64,<?= $product['picture'] ?>" alt="img" width="200px"
                                 height="200px">
                        </figure>
                        <div class="card-body items-center text-center">
                            <h2 class="card-title"><?= $product['name'] ?></h2>
                            <p><?= $product['description'] ?></p>
                            <div class="card-actions">
                                <button class="btn btn-primary">Add to cart!</button>
                            </div>
                        </div>

                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</div>