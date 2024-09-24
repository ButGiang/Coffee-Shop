<template>
    <!-- Loading popup -->
    <div id="progressBar" class="w-full h-full fixed left-0 top-0 bg-black bg-opacity-40 rounded hidden">
        <div
            class="absolute left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2 w-64 h-20 bg-white border-1 border-gray-300 rounded text-center">
            <dd class="w-full h-full flex items-center p-5 font-semibold box-border">
                <div class="relative w-6 h-6 float-left mr-5">
                    <div style="border-top-color: #ccc;"
                        class="w-full h-full border-4 border-solid border-orange-500 rounded-full animate-spin">
                    </div>
                </div>
                Loading...
            </dd>
        </div>
    </div>

    <!-- alert popup -->
    <div id="alertPopup" class="fixed inset-0 bg-black bg-opacity-40 z-50 hidden">
        <div class="flex items-center justify-center h-full w-full box-border">
            <ul
                class="w-1/5 h-1/4 border border-solid border-gray-300 bg-white shadow-md flex flex-col justify-between text-sm">
                <li class="bg-orange-600 text-white text-lg font-bold">
                    <div id="alertPopup_title" class="p-3 text-center"></div>
                </li>
                <li class="p-3">
                    <div id="alertPopup_msg"></div>
                </li>
                <li class="px-10 py-5 flex justify-center">
                    <button id="alertPopup_btn"
                        class="h-12 w-1/2 bg-orange-500 border border-solid border-orange-400 rounded text-white hover:bg-orange-400">OK</button>
                </li>
            </ul>
        </div>
    </div>

    <!-- main layout -->
    <div class="flex justify-center h-screen">
        <div class="bg-neutral-100 p-4 flex-shrink-0 w-1/2 h-screen">
            <img src="@/assets/Images/coffee_shop_logo.jpg" alt="Logo" class="w-full h-full mx-auto rounded-3xl">
        </div>

        <div class="flex-grow flex items-center bg-zinc-100 p-8">
            <router-view></router-view>
        </div>
    </div>
</template>

<script>
export default {
    name: 'authLayout'
}
</script>