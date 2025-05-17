<?php require __DIR__ . "/../components/topBanner.view.php"; ?>

<section class="flex justify-center items-center mt-20">
  <div class="bg-white p-8 rounded-lg shadow-md w-full md:w-600 mx-6">
    <h2 class="text-4xl text-center font-bold mb-4">Edit Job Listing</h2>
    <form method="POST" action="/Projects/Workopia/public/index.php?path=edit/<?php echo $job->id; ?>">
      <input type="hidden" name="_method" value="PUT">
      <h2 class="text-2xl font-bold mb-6 text-center text-gray-500">
        Job Info
      </h2>
      <?php //loadPartial('errors', [
        //'errors' => $errors ?? []
      //]) ?>
      <div class="mb-4">
        <input type="text" name="title" placeholder="Job Title" class="w-full px-4 py-2 border rounded focus:outline-none" value="<?php echo $_POST["title"] ?? $job->title; ?>" />
      </div>
      <div class="mb-4">
        <textarea name="description" placeholder="Job Description" class="w-full px-4 py-2 border rounded focus:outline-none"><?php echo $_POST["description"] ?? $job->description; ?></textarea>
      </div>
      <div class="mb-4">
        <input type="text" name="salary" placeholder="Annual Salary" class="w-full px-4 py-2 border rounded focus:outline-none" value="<?php echo $_POST["salary"] ?? $job->salary; ?>" />
      </div>
      <div class="mb-4">
        <input type="text" name="requirements" placeholder="Requirements" class="w-full px-4 py-2 border rounded focus:outline-none" value="<?php echo $_POST["requirements"] ?? $job->requirements; ?>" />
      </div>
      <div class="mb-4">
        <input type="text" name="benefits" placeholder="Benefits" class="w-full px-4 py-2 border rounded focus:outline-none" value="<?php echo $_POST["benefits"] ?? $job->benefits; ?>" />
      </div>
      <div class="mb-4">
        <input type="text" name="tags" placeholder="Tags" class="w-full px-4 py-2 border rounded focus:outline-none" value="<?php echo $_POST["tags"] ?? $job->tags; ?>" />
      </div>
      <h2 class="text-2xl font-bold mb-6 text-center text-gray-500">
        Company Info & Location
      </h2>
      <div class="mb-4">
        <input type="text" name="company" placeholder="Company Name" class="w-full px-4 py-2 border rounded focus:outline-none" value="<?php echo $_POST["company"] ?? $job->company; ?>" />
      </div>
      <div class="mb-4">
        <input type="text" name="address" placeholder="Address" class="w-full px-4 py-2 border rounded focus:outline-none" value="<?php echo $_POST["address"] ?? $job->address; ?>" />
      </div>
      <div class="mb-4">
        <input type="text" name="city" placeholder="City" class="w-full px-4 py-2 border rounded focus:outline-none" value="<?php echo $_POST["city"] ?? $job->city; ?>" />
      </div>
      <div class="mb-4">
        <input type="text" name="state" placeholder="State" class="w-full px-4 py-2 border rounded focus:outline-none" value="<?php echo $_POST["state"] ?? $job->state; ?>" />
      </div>
      <div class="mb-4">
        <input type="text" name="phone" placeholder="Phone" class="w-full px-4 py-2 border rounded focus:outline-none" value="<?php echo $_POST["phone"] ?? $job->phone; ?>" />
      </div>
      <div class="mb-4">
        <input type="email" name="email" placeholder="Email Address For Applications" class="w-full px-4 py-2 border rounded focus:outline-none" value="<?php echo $_POST["email"] ?? $job->email; ?>" />
      </div>
      <button class="w-full bg-green-500 hover:bg-green-600 text-white px-4 py-2 my-3 rounded focus:outline-none">
        Save
      </button>
      <a href="/Projects/Workopia/public/index.php?path=jobs/<?php echo $job->id; ?>" class="block text-center w-full bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded focus:outline-none">
        Cancel
      </a>
    </form>
  </div>
</section>


<?php require __DIR__ . "/../components/bottomBanner.view.php"; ?>