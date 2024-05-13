<div class="hero min-h-screen bg-base-200">
    <div class="hero-content flex-col lg:flex-row-reverse">
        <div class="text-center lg:text-left">
            <h1 class="text-5xl font-bold">Login now!</h1>
            <p class="py-6">Login and start shoping!</p>
        </div>
        <div class="card shrink-0 w-full max-w-sm shadow-2xl bg-base-100">
            <form class="card-body" action="action/loginAction.php" method="post">
                <div class="form-control">
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
                    <label class="label">
                        <span class="label-text">Email</span>
                    </label>
                    <input type="email" placeholder="email" name="email" class="input input-bordered" required />
                </div>
                <div class="form-control">
                    <label class="label">
                        <span class="label-text">Password</span>
                    </label>
                    <input type="password" placeholder="******" name="password" class="input input-bordered" required />
                    <label class="label">
                        <a href="index.php?page=resetPasswordMail" class="label-text-alt link link-hover">Forgot password?</a>
                    </label>
                    <label class="label">
                        <a href="index.php?page=register" class="label-text-alt link link-hover">No Account? Register here!</a>
                    </label>
                </div>
                <div class="form-control mt-6">
                    <button class="btn btn-primary">Login</button>
                </div>
            </form>
        </div>
    </div>
</div>