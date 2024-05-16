<?php loadPartial('head'); ?>
<?php loadPartial('navbar'); ?>
<?php loadPartial('top-banner'); ?>

    <section class="flex justify-center items-center mt-20">
        <div class="bg-white p-8 rounded-lg shadow-md w-full md:w-600 mx-6">
            <h2 class="text-4xl text-center font-bold mb-4">Create Job Listing</h2>
            <form method="POST" action="/public/listings">
                <h2 class="text-2xl font-bold mb-6 text-center text-gray-500">
                    职位信息
                </h2>
                <?php if (isset($errors)): ?>
                    <?php foreach ($errors as $error): ?>
                        <div class="message bg-red-100 my-3"><?= $error ?></div>
                    <?php endforeach; ?>
                <?php endif; ?>
                <div class="mb-4">
                    <input type="text" name="title" placeholder="职位标题" class="w-full px-4 py-2 border rounded focus:outline-none" value="<?= isset($listing['title']) ? $listing['title'] : '' ?>"/>
                </div>
                <div class="mb-4">
                    <textarea name="description" placeholder="职位描述" class="w-full px-4 py-2 border rounded focus:outline-none" value="<?= isset($listing['description']) ? $listing['description'] : '' ?>"></textarea>
                </div>
                <div class="mb-4">
                    <input type="text" name="salary" placeholder="年薪" class="w-full px-4 py-2 border rounded focus:outline-none" value="<?= isset($listing['salary']) ? $listing['salary'] : '' ?>"/>
                </div>
                <div class="mb-4">
                    <input type="text" name="requirements" placeholder="需求" class="w-full px-4 py-2 border rounded focus:outline-none" value="<?= isset($listing['requirements']) ? $listing['requirements'] : '' ?>"/>
                </div>
                <div class="mb-4">
                    <input type="text" name="benefits" placeholder="福利" class="w-full px-4 py-2 border rounded focus:outline-none" value="<?= isset($listing['benefits']) ? $listing['benefits'] : '' ?>"/>
                </div>

                <div class="mb-4">
                    <input type="text" name="tag" placeholder="标签" class="w-full px-4 py-2 border rounded focus:outline-none" value="<?= isset($listing['tags']) ? $listing['tags'] : '' ?>"/>
                </div>

                <h2 class="text-2xl font-bold mb-6 text-center text-gray-500">
                    Company Information & Location
                </h2>
                <div class="mb-4">
                    <input type="text" name="company" placeholder="公司名" class="w-full px-4 py-2 border rounded focus:outline-none" value="<?= isset($listing['company']) ? $listing['company'] : '' ?>"/>
                </div>
                <div class="mb-4">
                    <input type="text" name="address" placeholder="地址" class="w-full px-4 py-2 border rounded focus:outline-none" value="<?= isset($listing['address']) ? $listing['address'] : '' ?>"/>
                </div>
                <div class="mb-4">
                    <input type="text" name="city" placeholder="城市" class="w-full px-4 py-2 border rounded focus:outline-none" value="<?= isset($listing['city']) ? $listing['city'] : '' ?>"/>
                </div>
                <div class="mb-4">
                    <input type="text" name="province" placeholder="省份" class="w-full px-4 py-2 border rounded focus:outline-none" value="<?= isset($listing['province']) ? $listing['province'] : '' ?>"/>
                </div>
                <div class="mb-4">
                    <input type="text" name="phone" placeholder="电话" class="w-full px-4 py-2 border rounded focus:outline-none" value="<?= isset($listing['phone']) ? $listing['phone'] : '' ?>"/>
                </div>
                <div class="mb-4">
                    <input type="email" name="email" placeholder="Email" class="w-full px-4 py-2 border rounded focus:outline-none" value="<?= isset($listing['email']) ? $listing['email'] : '' ?>"/>
                </div>
                <button class="w-full bg-green-500 hover:bg-green-600 text-white px-4 py-2 my-3 rounded focus:outline-none">
                    Save
                </button>
                <a href="/" class="block text-center w-full bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded focus:outline-none">
                    Cancel
                </a>
            </form>
        </div>
    </section>

<?php loadPartial('bottom-banner'); ?>
<?php loadPartial('footer'); ?>