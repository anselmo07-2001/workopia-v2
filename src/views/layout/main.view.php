<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="/css/style.css" />
  <title>Workopia</title>
</head>

<body class="bg-gray-100">

<header class="bg-blue-900 text-white p-4">
  <div class="container mx-auto flex justify-between items-center">
    <h1 class="text-3xl font-semibold">
      <a href="/">Workopia</a>
    </h1>
    <nav class="space-x-4">
        <a href="/auth/login" class="text-white hover:underline">Login</a>
        <a href="/auth/register" class="text-white hover:underline">Register</a>
    </nav>
  </div>
</header>

<section class="showcase relative bg-cover bg-center bg-no-repeat h-72 flex items-center">
  <div class="overlay"></div>
  <div class="container mx-auto text-center z-10">
    <h2 class="text-4xl text-white font-bold mb-4">Find Your Dream Job</h2>
    <form method="GET" action="/listings/search" class="mb-4 block mx-5 md:mx-auto">
      <input type="text" name="keywords" placeholder="Keywords" class="w-full md:w-auto mb-2 px-4 py-2 focus:outline-none" />
      <input type="text" name="location" placeholder="Location" class="w-full md:w-auto mb-2 px-4 py-2 focus:outline-none" />
      <button class="w-full md:w-auto bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 focus:outline-none">
        <i class="fa fa-search"></i> Search
      </button>
    </form>
  </div>
</section>


<section class="bg-blue-900 text-white py-6 text-center">
  <div class="container mx-auto">
    <h2 class="text-3xl font-semibold">Unlock Your Career Potential</h2>
    <p class="text-lg mt-2">
      Discover the perfect job opportunity for you.
    </p>
  </div>
</section>




<section class="container mx-auto my-6">
  <div class="bg-blue-800 text-white rounded p-4 flex items-center justify-between">
    <div>
      <h2 class="text-xl font-semibold">Looking to hire?</h2>
      <p class="text-gray-200 text-lg mt-2">
        Post your job listing now and find the perfect candidate.
      </p>
    </div>
    <a href="/listings/create" class="bg-yellow-500 hover:bg-yellow-600 text-black px-4 py-2 rounded hover:shadow-md transition duration-300">
      <i class="fa fa-edit"></i> Post a Job
    </a>
  </div>
</section>
</body>

</html>