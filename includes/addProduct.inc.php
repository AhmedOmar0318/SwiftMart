<div class="hero min-h-screen bg-base-200">
    <div class="card w-full max-w-sm ">
        <div class="card-body bg-base-100 shadow-2xl rounded-box grid w-max">
            <div class="pb-5">
                <h2 class="card-title font-bold flex-col ">Add product</h2>
            </div>
            <?php if (isset($_SESSION['error'])) { ?>
                <div role="alert" class="alert alert-error">
                    <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current shrink-0 h-6 w-6" fill="none"
                         viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <span>Error! <?= $_SESSION['error'] ?></span>
                </div>
                <?php unset($_SESSION['error']);
            }
            ?>
            <form method="post" action="action/addProductAction.php" enctype="multipart/form-data">
                <div class="grid grid-rows-1 gap-2 grid-flow-col">
                    <div class="form-control">
                        <label class="label">Product Name</label>
                        <input type="text" name="productName" placeholder="product name" class="input input-bordered"
                               required>
                    </div>
                    <div class="form-control">
                        <label class="label">Price</label>
                        <input type="number" name="productPrice" placeholder="price" class="input input-bordered"
                               required>
                    </div>
                </div>
                <div class="form-control">
                    <label class="label">Description</label>
                    <textarea class="textarea" placeholder="description" name="productDescription"></textarea>
                </div>
                <div class="form-control">
                    <label class="label">Picture</label>
                    <input type="file" name="productPicture" class="file-input file-input-bordered w-full max-w-xs"/>
                </div>
                <div class="pt-2 flex flex-col items-center">
                    <button class="btn btn-primary w-80" type="submit" id="submitBtn">Add</button>
                </div>
            </form>
        </div>
    </div>
</div>
