<?php

use Framework\Session;

?>
<header class="text-white p-4" style="background-color: #ffffff;">
    <div class="container mx-auto flex justify-between items-center">
        <h1 class="text-3xl font-semibold">
            <a href="/">广科大校内实习网站</a>

        </h1>
        <nav class="space-x-4">


            <?php if (Session::has('user')): ?>
                <div class="flex justify-between items-center gap-4">
                    <div class="text-gray-500">
                        欢迎, <?= Session::get('user')['name'] ?>
                    </div>
                    <form method="post" action="/public/auth/logout">
                        <button type="submit" class="text-white inline hover:underline" style="color: #8d1c3f;font-weight: bold">登出</button>
                    </form>
                    <a href="/public/listings/publish" class="bg-yellow-500 hover:bg-yellow-600 text-black px-4 py-2 rounded hover:shadow-md transition duration-300">
                        <i class="fa fa-edit"></i> 发布实习
                    </a>
                </div>
            <?php else: ?>
                <a href="/public/auth/login" class=" hover:underline" style="color: #8d1c3f;font-weight: bold">登录</a>
                <a href="/public/auth/register" class=" hover:underline" style="color: #8d1c3f;font-weight: bold">注册</a>
            <?php endif; ?>

        </nav>
    </div>
</header>