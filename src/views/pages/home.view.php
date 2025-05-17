<section class="showcase relative bg-cover bg-center bg-no-repeat h-72 flex items-center">
  <div class="overlay"></div>
  <div class="container mx-auto text-center z-10">
    <h2 class="text-4xl text-white font-bold mb-4">Find Your Dream Job</h2>
    <form method="GET" action="/Projects/Workopia/public/index.php" class="mb-4 block mx-5 md:mx-auto">
      <input type="hidden" name="path" value="search" />
      <input type="text" name="keywords" placeholder="Keywords" class="w-full md:w-auto mb-2 px-4 py-2 focus:outline-none" />
      <input type="text" name="location" placeholder="Location" class="w-full md:w-auto mb-2 px-4 py-2 focus:outline-none" />
      <button class="w-full md:w-auto bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 focus:outline-none">
        <i class="fa fa-search"></i> Search
      </button>
    </form>
  </div>
</section>


<?php require __DIR__ . "/../components/topBanner.view.php"; ?>
<div class="container mx-auto p-4 mt-4">
    <?php require __DIR__ . "/../components/messageBox.view.php"; ?>
    <?php require __DIR__ . "/../components/alertMessage.view.php"; ?>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
        <?php foreach($jobs AS $job):?>
            <div class="rounded-lg shadow-md bg-white">
                <div class="p-4">
                    <h2 class="text-xl font-semibold"><?= $job->title ?></h2>
                    <p class="text-gray-700 text-lg mt-2">
                    <?= $job->description ?>
                    </p>
                    <ul class="my-4 bg-gray-100 p-4 rounded">
                    <li class="mb-2"><strong>Salary:</strong> <?= $job->salary ?></li>
                    <li class="mb-2">
                        <strong>Location:</strong> <?= $job->city ?>, <?= $job->state ?>
                        <!-- <span class="text-xs bg-blue-500 text-white rounded-full px-2 py-1 ml-2">Local</span> -->
                    </li>
                    <?php if (!empty($job->tags)) : ?>
                        <li class="mb-2">
                        <strong>Tags:</strong> <?= $job->tags ?>
                        </li>
                    <?php endif; ?>
                    </ul>
                    <a href="/Projects/Workopia/public/index.php?path=jobs/<?= $job->id?>" class="block w-full text-center px-5 py-2.5 shadow-sm rounded border text-base font-medium text-indigo-700 bg-indigo-100 hover:bg-indigo-200">
                        Details
                    </a>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<?php require __DIR__ . "/../components/bottomBanner.view.php"; ?>