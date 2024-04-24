<?php require basePath('views/partials/head.php');?>
<?php require basePath('views/partials/navbar.php');?>
<?php require basePath('views/partials/showcase-search.php');?>
<?php require basePath('views/partials/bottom-banner.php');?>

<!-- 实习列表 -->
<section>
    <div class="container mx-auto p-4 mt-4">
        <div class="text-center text-3xl mb-4 font-bold border border-gray-300 p-3">最新实习</div>
        <!-- 实习列表具体内容，根据需要自行调整 -->

        <!-- 实习列表 -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
            <!-- 实习职位1: 软件开发实习生 -->
            <div class="rounded-lg shadow-md bg-white">
                <div class="p-4">
                    <h2 class="text-xl font-semibold">软件开发实习生</h2>
                    <p class="text-gray-700 text-lg mt-2">
                        我们正在寻找软件开发实习生，参与开发高质量的软件解决方案。
                    </p>
                    <ul class="my-4 bg-gray-100 p-4 rounded">
                        <li class="mb-2"><strong>薪资:</strong> 面议</li>
                        <li class="mb-2"><strong>位置:</strong> 校内</li>
                        <li class="mb-2"><strong>标签:</strong> <span>开发</span>, <span>编程</span></li>
                    </ul>
                    <a href="details.html"
                       class="block w-full text-center px-5 py-2.5 shadow-sm rounded border text-base font-medium text-indigo-700 bg-indigo-100 hover:bg-indigo-200"
                    >
                        详情
                    </a>
                </div>
            </div>

            <!-- 实习职位2: 数据分析实习生 -->
            <div class="rounded-lg shadow-md bg-white">
                <div class="p-4">
                    <h2 class="text-xl font-semibold">数据分析实习生</h2>
                    <p class="text-gray-700 text-lg mt-2">
                        加入我们的团队，作为数据分析实习生，分析和解读数据以获取洞察。
                    </p>
                    <ul class="my-4 bg-gray-100 p-4 rounded">
                        <li class="mb-2"><strong>薪资:</strong> 面议</li>
                        <li class="mb-2"><strong>位置:</strong> 校内</li>
                        <li class="mb-2"><strong>标签:</strong> <span>数据分析</span>, <span>统计</span></li>
                    </ul>
                    <a href="details.html"
                       class="block w-full text-center px-5 py-2.5 shadow-sm rounded border text-base font-medium text-indigo-700 bg-indigo-100 hover:bg-indigo-200"
                    >
                        详情
                    </a>
                </div>
            </div>

            <!-- 实习职位3: 人工智能研究助理 -->
            <div class="rounded-lg shadow-md bg-white">
                <div class="p-4">
                    <h2 class="text-xl font-semibold">人工智能研究助理</h2>
                    <p class="text-gray-700 text-lg mt-2">
                        寻找对人工智能充满热情的研究助理，参与前沿AI技术的研究与开发。
                    </p>
                    <ul class="my-4 bg-gray-100 p-4 rounded">
                        <li class="mb-2"><strong>薪资:</strong> 面议</li>
                        <li class="mb-2"><strong>位置:</strong> 校内</li>
                        <li class="mb-2"><strong>标签:</strong> <span>人工智能</span>, <span>研究</span></li>
                    </ul>
                    <a href="details.html"
                       class="block w-full text-center px-5 py-2.5 shadow-sm rounded border text-base font-medium text-indigo-700 bg-indigo-100 hover:bg-indigo-200"
                    >
                        详情
                    </a>
                </div>
            </div>
        </div>
        <a href="listings.html" class="block text-xl text-center">
            <i class="fa fa-arrow-alt-circle-right"></i>
            查看所有实习
        </a>

<?php require basePath('views/partials/footer.php');?>
