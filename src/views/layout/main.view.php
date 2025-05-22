<?php use App\Support\SessionService; ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="/Projects/Workopia/public/css/style.css" />
  <title>Workopia</title>
</head>

<body class="bg-gray-100">

<header class="bg-blue-900 text-white p-4">
  <div class="container mx-auto flex justify-between items-center">
    <h1 class="text-3xl font-semibold">
      <a href="/Projects/Workopia/public/index.php">Workopia</a>
    </h1>
    <nav class="space-x-4">
        <?php $user = SessionService::getSessionKey("user"); ?>
        <?php if ($user): ?>
            <div class="flex justify-between items-center gap-4">
                <div class="text-white-500">
                    Welcome <?php echo $user["name"]; ?>
                </div>
                <form method="POST" action="/Projects/Workopia/public/index.php?path=auth/logout">
                    <input type="hidden" name="_csrf" value="<?php echo e(csrf_token()); ?>"/>
                    <button type="submit" class="text-white inline hover:underline">Logout</button>
                </form>
            </div>
        <?php else: ?>
            <a href="/Projects/Workopia/public/index.php?path=auth/login" class="text-white hover:underline">Login</a>
            <a href="/Projects/Workopia/public/index.php?path=auth/register" class="text-white hover:underline">Register</a>
        <?php endif; ?>
    </nav>
  </div>
</header>


<?php echo $contents ?>

</body>
   
</html>