<div class="flex justify-center items-center mt-20">
  <div class="bg-white p-8 rounded-lg shadow-md w-full md:w-500 mx-6">
    <h2 class="text-4xl text-center font-bold mb-4">Login</h2>
    <?php require __DIR__ . "/../components/errorBox.view.php" ?>
    <form method="POST" action="/Workopia2/index.php?path=auth/login">
      <input type="hidden" name="_csrf" value="<?php echo e(csrf_token()); ?>"/>
      <div class="mb-4">
        <input type="text" name="email" placeholder="Email Address" class="w-full px-4 py-2 border rounded focus:outline-none" value="<?php echo $_POST["email"] ?? "" ?>"  />
      </div>
      <div class="mb-4">
        <input type="password" name="password" placeholder="Password" class="w-full px-4 py-2 border rounded focus:outline-none"/>
      </div>
      <button type="submit" class="w-full bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded focus:outline-none">
        Login
      </button>

      <p class="mt-4 text-gray-500">
        Don't have an account?
        <a class="text-blue-900" href="/Workopia2/index.php?path=auth/register">Register</a>
      </p>
    </form>
  </div>
</div>