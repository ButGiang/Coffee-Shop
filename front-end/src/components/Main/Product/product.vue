<template>
    <section>
        <div class="pt-8 pb-16 bg-blueGray-100">
            <div class="container px-4 mx-auto">
                <!-- path link -->
                <ul class="flex flex-wrap items-center mb-10">
                    <li class="mr-6">
                        <a class="flex items-center text-sm font-medium text-gray-400 hover:text-gray-500" href="#">
                            <span>Home</span>
                            <svg class="ml-6" width="4" height="7" viewbox="0 0 4 7" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M0.150291 0.898704C-0.0500975 0.692525 -0.0500975 0.359292 0.150291 0.154634C0.35068 -0.0507836 0.674443 -0.0523053 0.874831 0.154634L3.7386 3.12787C3.93899 3.33329 3.93899 3.66576 3.7386 3.8727L0.874832 6.84594C0.675191 7.05135 0.35068 7.05135 0.150292 6.84594C-0.0500972 6.63976 -0.0500972 6.30652 0.150292 6.10187L2.49888 3.49914L0.150291 0.898704Z"
                                    fill="currentColor"></path>
                            </svg>
                        </a>
                    </li>
                    <li class="mr-6">
                        <a class="flex items-center text-sm font-medium text-gray-400 hover:text-gray-500" href="#">
                            <span>Products</span>
                        </a>
                    </li>
                </ul>

                <!-- title -->
                <div class="pb-6 text-center border-b border-black border-opacity-5">
                    <div class="relative">
                        <h2
                            class="mb-5 md:mb-0 text-6xl text-green-500 leading-normal font-heading font-medium text-center">
                            Product list
                        </h2>
                    </div>
                </div>

                <!-- navbar -->
                <div class="mb-10 flex justify-between py-3 border-b border-black border-opacity-10">
                    <div class="flex flex-wrap flex-1">
                        <!-- new product btn -->
                        <div class="flex items-center pr-3 border-r-2 border-black border-opacity-5">
                            <button @click="showNewProductModal"
                                class="bg-orange-500 text-white font-bold py-2 px-4 rounded-xl hover:bg-orange-300">
                                New product
                            </button>
                        </div>

                        <!-- filter bar -->
                        <div v-for="(item, index) in filterItems" :key="index"
                            class="w-2/3 sm:w-1/3 lg:w-48 py-2 sm:px-3 cursor-pointer relative">
                            <div @click="toggleFilterList(index)"
                                class="flex items-center justify-around py-2 font-heading font-medium border border-gray-200 hover:border-orange-500 rounded-xl">
                                <span>{{ item }}</span>
                                <svg class="relative top-px ml-6" width="8" height="5" viewBox="0 0 8 5" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M6.97291 0.193232C7.20854 -0.0644107 7.58938 -0.0644107 7.82328 0.193232C8.05804 0.450875 8.05978 0.867141 7.82328 1.12478L4.42529 4.80677C4.19053 5.06441 3.81056 5.06441 3.57406 4.80677L0.176073 1.12478C-0.0586909 0.868102 -0.0586909 0.450875 0.176073 0.193232C0.411706 -0.0644107 0.792544 -0.0644107 1.02644 0.193232L4.00098 3.21284L6.97291 0.193232Z"
                                        fill="currentColor"></path>
                                </svg>
                            </div>

                            <!-- filter by category -->
                            <div v-if="index === 0 && activeFilterIndex === 0">
                                <ul class="absolute object-left-bottom w-5/6 bg-gray-200 mt-1 ml-1 rounded z-10">
                                    <li class="flex justify-between h-10 p-2 border border-gray-300 rounded hover:bg-gray-100"
                                        v-for="(category, index) in categories" :key="index"
                                        @click="productFilterByCategory(category.id)">
                                        {{ category.name }}
                                    </li>
                                </ul>
                            </div>

                            <!-- sort by price -->
                            <div v-if="index === 1 && activeFilterIndex === 1">
                                <ul class="absolute object-left-bottom w-5/6 bg-gray-200 mt-1 ml-1 rounded z-10">
                                    <li class="flex justify-between h-10 p-2 border border-gray-300 rounded hover:bg-gray-100"
                                        v-for="(sort, sortIndex) in price" :key="sortIndex"
                                        @click="productSortByPrice(sortIndex)">
                                        {{ sort.name }}
                                        <span v-html="sort.icon"></span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <!-- search container -->
                    <div class="flex items-center">
                        <!-- reset search -->
                        <div @click="resetSearch()"
                            class="flex items-center border border-gray-500 bg-blue-500 mr-2 p-1 rounded-xl hover:bg-blue-400 cursor-pointer">
                            <svg class="h-8 w-8 text-white group-hover:text-indigo-600 self-center" fill="none"
                                viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0l3.181 3.183a8.25 8.25 0 0013.803-3.7M4.031 9.865a8.25 8.25 0 0113.803-3.7l3.181 3.182m0-4.991v4.99" />
                            </svg>
                        </div>

                        <!-- search bar -->
                        <div class="relative mr-3">
                            <input type="text" placeholder="Search" v-model="searchInput" @input="fetchSuggestions"
                                class="border border-gray-300 rounded-md px-4 py-2 pl-10 focus:outline-none focus:ring focus:border-blue-300 transition duration-150 ease-in-out">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3">
                                <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="24" height="24"
                                    viewBox="0 0 50 50">
                                    <path
                                        d="M 21 3 C 11.621094 3 4 10.621094 4 20 C 4 29.378906 11.621094 37 21 37 C 24.710938 37 28.140625 35.804688 30.9375 33.78125 L 44.09375 46.90625 L 46.90625 44.09375 L 33.90625 31.0625 C 36.460938 28.085938 38 24.222656 38 20 C 38 10.621094 30.378906 3 21 3 Z M 21 5 C 29.296875 5 36 11.703125 36 20 C 36 28.296875 29.296875 35 21 35 C 12.703125 35 6 28.296875 6 20 C 6 11.703125 12.703125 5 21 5 Z">
                                    </path>
                                </svg>
                            </div>

                            <!-- suggestion list -->
                            <div v-if="showSuggestions"
                                class="absolute left-0 mt-2 w-full bg-white border border-gray-300 rounded-md shadow-md">
                                <div v-for="(suggestion, index) in suggestionList" :key="index"
                                    @click="selectSuggestion(suggestion)" class="p-2 cursor-pointer hover:bg-gray-100">
                                    {{ suggestion.name }}
                                </div>
                            </div>
                        </div>

                        <!-- count products -->
                        <span class="flex items-center text-sm text-gray-400 font-medium">
                            {{ this.productCount }} products found
                        </span>
                    </div>
                </div>

                <!-- product list -->
                <div class="flex flex-wrap -mx-3 mb-20">
                    <div v-for="product in products" :key="product.id"
                        class="w-full sm:w-1/2 lg:w-1/3 xl:w-1/4 px-3 mb-20">
                        <div @click="getDetailProduct(product.id)"
                            class="xl:flex xl:items-center p-10 xl:py-24 mb-4 bg-white border border-gray-300 rounded-3xl cursor-pointer">
                            <div class="block mx-auto max-w-max">
                                <img class="h-40 object-cover" :src="baseUrl + product.image" :alt="product.name">
                            </div>
                        </div>

                        <p class="mb-2 text-xl leading-8 font-heading font-medium cursor-pointer hover:underline"
                            @click="getDetailProduct(product.id)">
                            {{ product.name }}
                        </p>
                        <p class="text-xl text-blue-500 font-heading font-medium tracking-tighter">
                            <span class="text-base pr-2">$</span>
                            <span>{{ product.price }}</span>
                        </p>
                    </div>
                </div>

                <!-- more product btn -->
                <div v-if="moreBtn" class="sm:mx-auto sm:w-96 cursor-pointer">
                    <div
                        class="block py-5 px-10 w-full text-xl leading-6 text-white font-medium tracking-tighter font-heading text-center bg-blue-500 hover:bg-blue-600 focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50 rounded-xl">
                        More products
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- new product modal -->
    <section v-show="newProductModalVisible" @click.self="hideNewProductModal()"
        class="w-full h-full fixed left-0 top-0 bg-black bg-opacity-40 rounded">
        <div class="container bg-teal-500 w-3/5 mt-8 mx-auto p-8 rounded-xl">
            <div class="flex flex-wrap -mx-4">
                <div class="w-full lg:w-1/4 px-4 mb-8 lg:mb-0">
                    <div class="mt-8">
                        <h3 class="text-2xl font-bold tracking-wide text-white mb-1">Add new product</h3>
                        <p class="text-xs text-gray-200">Enter the necessary information to create a new product</p>
                    </div>
                </div>

                <div class="w-full lg:w-3/4 px-4">
                    <span class="float-right m-2 mr-3 mt-0 text-white text-xl cursor-pointer"
                        @click="hideNewProductModal">&times;</span>

                    <div class="px-8 md:px-16 pt-16 pb-8 bg-gray-500 rounded-xl">
                        <div class="max-w-xl mx-auto">
                            <form @submit.prevent="create">
                                <div class="flex flex-wrap -mx-4 -mb-10">
                                    <div class="w-full md:w-1/2 px-4 mb-10">
                                        <div
                                            class="relative w-full h-14 py-4 px-3 border border-gray-400 hover:border-white focus-within:border-green-500 rounded-lg">
                                            <span
                                                class="absolute bottom-full left-0 ml-3 -mb-1 transform translate-y-0.5 text-xs font-semibold text-gray-300 px-1 bg-gray-500">
                                                Product Name
                                            </span>
                                            <input
                                                class="block w-full outline-none bg-transparent text-gray-50 placeholder-gray-50 font-semibold"
                                                v-model="productName" type="text">
                                        </div>
                                    </div>

                                    <div class="w-full md:w-1/2 px-4 mb-10">
                                        <div
                                            class="relative w-full h-14 py-4 px-3 border border-gray-400 hover:border-white focus-within:border-green-500 rounded-lg">
                                            <span
                                                class="absolute bottom-full left-0 ml-3 -mb-1 transform translate-y-0.5 text-xs font-semibold text-gray-300 px-1 bg-gray-500">
                                                Price
                                            </span>
                                            <div class="flex">
                                                <input
                                                    class="block w-full mr-1 outline-none bg-transparent text-gray-50 placeholder-gray-50 font-semibold"
                                                    v-model="productPrice" type="number" pattern="[0-9]*">
                                                <span class="text-white font-bold">$</span>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="w-full px-4 mb-10">
                                        <div
                                            class="relative w-full py-4 px-3 border border-gray-400 hover:border-white focus-within:border-green-500 rounded-lg">
                                            <span
                                                class="absolute bottom-full left-0 ml-3 -mb-1 transform translate-y-0.5 text-xs font-semibold text-gray-300 px-1 bg-gray-500">
                                                Describe
                                            </span>
                                            <textarea
                                                class="block w-full h-64 outline-none bg-transparent text-gray-50 placeholder-gray-50 font-semibold resize-none"
                                                v-model="productDescribe" cols="30" rows="10"
                                                placeholder="Enter a description for the product">
                                            </textarea>
                                        </div>
                                    </div>

                                    <div class="w-full px-4 mb-10">
                                        <div class="flex flex-wrap sm:flex-nowrap">
                                            <div class="flex-shrink-0 w-20 h-20 mb-4 mr-4">
                                                <img class="w-full h-full rounded-full" v-if="imagePreview"
                                                    :src="imagePreview">
                                            </div>

                                            <div
                                                class="w-full py-8 px-4 text-center border-dashed border border-gray-400 hover:border-white rounded-lg">
                                                <div class="relative group h-14 w-14 mx-auto mb-4">
                                                    <div
                                                        class="flex items-center justify-center h-14 w-14 bg-blue-500 group-hover:bg-blue-600 rounded-full">
                                                        <svg width="20" height="20" viewbox="0 0 20 20" fill="none"
                                                            xmlns="http://www.w3.org/2000/svg">
                                                            <path
                                                                d="M6.71 5.71002L9 3.41002V13C9 13.2652 9.10536 13.5196 9.29289 13.7071C9.48043 13.8947 9.73478 14 10 14C10.2652 14 10.5196 13.8947 10.7071 13.7071C10.8946 13.5196 11 13.2652 11 13V3.41002L13.29 5.71002C13.383 5.80375 13.4936 5.87814 13.6154 5.92891C13.7373 5.97968 13.868 6.00582 14 6.00582C14.132 6.00582 14.2627 5.97968 14.3846 5.92891C14.5064 5.87814 14.617 5.80375 14.71 5.71002C14.8037 5.61706 14.8781 5.50645 14.9289 5.3846C14.9797 5.26274 15.0058 5.13203 15.0058 5.00002C15.0058 4.86801 14.9797 4.7373 14.9289 4.61544C14.8781 4.49358 14.8037 4.38298 14.71 4.29002L10.71 0.290018C10.6149 0.198978 10.5028 0.127613 10.38 0.0800184C10.1365 -0.0199996 9.86346 -0.0199996 9.62 0.0800184C9.49725 0.127613 9.3851 0.198978 9.29 0.290018L5.29 4.29002C5.19676 4.38326 5.1228 4.49395 5.07234 4.61577C5.02188 4.73759 4.99591 4.86816 4.99591 5.00002C4.99591 5.13188 5.02188 5.26245 5.07234 5.38427C5.1228 5.50609 5.19676 5.61678 5.29 5.71002C5.38324 5.80326 5.49393 5.87722 5.61575 5.92768C5.73757 5.97814 5.86814 6.00411 6 6.00411C6.13186 6.00411 6.26243 5.97814 6.38425 5.92768C6.50607 5.87722 6.61676 5.80326 6.71 5.71002ZM19 10C18.7348 10 18.4804 10.1054 18.2929 10.2929C18.1054 10.4804 18 10.7348 18 11V17C18 17.2652 17.8946 17.5196 17.7071 17.7071C17.5196 17.8947 17.2652 18 17 18H3C2.73478 18 2.48043 17.8947 2.29289 17.7071C2.10536 17.5196 2 17.2652 2 17V11C2 10.7348 1.89464 10.4804 1.70711 10.2929C1.51957 10.1054 1.26522 10 1 10C0.734784 10 0.48043 10.1054 0.292893 10.2929C0.105357 10.4804 0 10.7348 0 11V17C0 17.7957 0.316071 18.5587 0.87868 19.1213C1.44129 19.6839 2.20435 20 3 20H17C17.7956 20 18.5587 19.6839 19.1213 19.1213C19.6839 18.5587 20 17.7957 20 17V11C20 10.7348 19.8946 10.4804 19.7071 10.2929C19.5196 10.1054 19.2652 10 19 10Z"
                                                                fill="#E8EDFF"></path>
                                                        </svg>
                                                    </div>
                                                    <input class="absolute top-0 left-0 h-14 w-14 opacity-0"
                                                        @change="handleFileInput" type="file">
                                                </div>
                                                <p class="font-semibold leading-normal mb-1">
                                                    <span class="text-blue-300">Click to upload a file </span>
                                                    <span class="text-gray-200">or drag and drop</span>
                                                </p>
                                                <span class="text-xs text-gray-300 font-semibold">
                                                    PNG, JPG, GIF or up to 2MB
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="mt-8 text-right">
                                    <button v-on:click="createProduct"
                                        class="inline-block py-2 px-4 mb-2 text-xs text-center font-semibold leading-6 text-blue-50 bg-blue-500 hover:bg-blue-600 rounded-lg transition duration-200">
                                        Save
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- view product detail -->
    <div v-show="detailProductModalVisible" @click.self="hideDetailProductModal()"
        class="w-full h-full flex fixed left-0 top-0 bg-black bg-opacity-40 rounded">
        <div class="container bg-indigo-200 w-3/5 h-4/5 m-auto p-8 rounded-xl">
            <div v-if="productDetail.length > 0" class="flex h-full bg-white items-center rounded-xl">
                <img :src="baseUrl + productDetail[0].image" alt="Product Image"
                    class="w-1/2 h-fit mx-4 p-3 border border-gray-300 rounded-3xl">
                <div class="w-1/2 h-auto mr-2">
                    <!-- view detail -->
                    <div v-if="!isEditing">
                        <h2 class="text-2xl font-bold">{{ productDetail[0].name }}</h2>
                        <p class="mt-3 text-justify">{{ productDetail[0].description }}</p>
                        <p class="mt-3">Price: <b>{{ productDetail[0].price }}$</b></p>
                        <p class="mt-3">Category: <b>{{ productDetail[0].category }}</b></p>
                        <p class="mt-3">Last update: <b>{{ formatDateTime(productDetail[0].updated_at) }}</b></p>

                        <div class="mt-48 flex justify-end space-x-3">
                            <button @click="hideDetailProductModal()"
                                class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-700">
                                Cancel
                            </button>
                            <button @click="startEditing()"
                                class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-700">
                                Edit
                            </button>
                        </div>
                    </div>

                    <!-- edit product -->
                    <div v-else>
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2">Name</label>
                            <input v-model="productDetail[0].name"
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                type="text">
                        </div>
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2">Description</label>
                            <textarea v-model="productDetail[0].description" rows="10"
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                            </textarea>
                        </div>
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2">Price ( $ )</label>
                            <input v-model="productDetail[0].price"
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                type="number">
                        </div>
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2">Category</label>
                            <select v-model="productDetail[0].category"
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                <option v-for="category in categories" :key="category.id" :value="category.id">
                                    {{ category.name }}
                                </option>
                            </select>
                        </div>

                        <div class="mt-16 flex justify-end space-x-3">
                            <button @click="endEditing()"
                                class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-700">
                                Back
                            </button>
                            <button @click="editProduct()"
                                class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-700">
                                Save
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from '@/axios-config'
import { commonFunc } from '@/service/commonFunc'

export default {
    name: 'productPage',
    data() {
        return {
            baseUrl: this.$baseUrl,

            products: [],
            originalProductList: [],
            categories: [],
            price: [
                {
                    name: 'Ascending',
                    icon: `<svg fill="#000000" height="24px" width="24px" version="1.1" 
                            xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" 
                            viewBox="0 0 301.219 301.219" xml:space="preserve">
                        <g>
                            <path d="M149.365,262.736H10c-5.523,0-10,4.477-10,10v10c0,5.523,4.477,10,10,10h139.365c5.522,0,10-4.477,10-10v-10
                                C159.365,267.213,154.888,262.736,149.365,262.736z"/>
                            <path d="M10,229.736h120.586c5.522,0,10-4.477,10-10v-10c0-5.523-4.478-10-10-10H10c-5.523,0-10,4.477-10,10v10
                                C0,225.259,4.477,229.736,10,229.736z"/>
                            <path d="M10,166.736h101.805c5.522,0,10-4.477,10-10v-10c0-5.523-4.478-10-10-10H10c-5.523,0-10,4.477-10,10v10
                                C0,162.259,4.477,166.736,10,166.736z"/>
                            <path d="M10,96.736h83.025c5.522,0,10-4.477,10-10v-10c0-5.523-4.478-10-10-10H10c-5.523,0-10,4.477-10,10v10
                                C0,92.259,4.477,96.736,10,96.736z"/>
                            <path d="M10,33.736h64.244c5.522,0,10-4.477,10-10v-10c0-5.523-4.478-10-10-10H10c-5.523,0-10,4.477-10,10v10
                                C0,29.259,4.477,33.736,10,33.736z"/>
                            <path d="M298.29,216.877l-7.07-7.071c-1.875-1.875-4.419-2.929-7.071-2.929c-2.652,0-5.195,1.054-7.071,2.929l-34.394,34.393
                                V18.736c0-5.523-4.477-10-10-10h-10c-5.522,0-10,4.477-10,10v225.462l-34.394-34.393c-1.876-1.876-4.419-2.929-7.071-2.929
                                c-2.652,0-5.196,1.054-7.071,2.929l-7.07,7.071c-3.905,3.905-3.905,10.237,0,14.142l63.535,63.536
                                c1.876,1.875,4.419,2.929,7.071,2.929c2.652,0,5.195-1.054,7.071-2.929l63.535-63.536
                                C302.195,227.113,302.195,220.782,298.29,216.877z"/>
                        </g>
                    </svg>`
                },
                {
                    name: 'Descending',
                    icon: `<svg fill="#000000" height="24px" width="24px" version="1.1" 
                            xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" 
                            viewBox="0 0 301.219 301.219" xml: space = "preserve" >
                        <g>
                            <path d="M159.365,23.736v-10c0-5.523-4.477-10-10-10H10c-5.523,0-10,4.477-10,10v10c0,5.523,4.477,10,10,10h139.365
                                C154.888,33.736,159.365,29.259,159.365,23.736z"/>
                            <path d="M130.586,66.736H10c-5.523,0-10,4.477-10,10v10c0,5.523,4.477,10,10,10h120.586c5.523,0,10-4.477,10-10v-10
                                C140.586,71.213,136.109,66.736,130.586,66.736z"/>
                            <path d="M111.805,129.736H10c-5.523,0-10,4.477-10,10v10c0,5.523,4.477,10,10,10h101.805c5.523,0,10-4.477,10-10v-10
                                C121.805,134.213,117.328,129.736,111.805,129.736z"/>
                            <path d="M93.025,199.736H10c-5.523,0-10,4.477-10,10v10c0,5.523,4.477,10,10,10h83.025c5.522,0,10-4.477,10-10v-10
                                C103.025,204.213,98.548,199.736,93.025,199.736z"/>
                            <path d="M74.244,262.736H10c-5.523,0-10,4.477-10,10v10c0,5.523,4.477,10,10,10h64.244c5.522,0,10-4.477,10-10v-10
                                C84.244,267.213,79.767,262.736,74.244,262.736z"/>
                            <path d="M298.29,216.877l-7.071-7.071c-1.875-1.875-4.419-2.929-7.071-2.929c-2.652,0-5.196,1.054-7.072,2.929l-34.393,34.393
                                V18.736c0-5.523-4.477-10-10-10h-10c-5.523,0-10,4.477-10,10v225.462l-34.393-34.393c-1.876-1.875-4.419-2.929-7.071-2.929
                                c-2.652,0-5.196,1.054-7.071,2.929l-7.072,7.071c-3.904,3.905-3.904,10.237,0,14.142l63.536,63.536
                                c1.953,1.953,4.512,2.929,7.071,2.929c2.559,0,5.119-0.976,7.071-2.929l63.536-63.536
                                C302.195,227.113,302.195,220.781,298.29,216.877z"/>
                        </g>
                    </svg> `
                }
            ],
            productDetail: [],

            productName: '',
            productPrice: '',
            productDescribe: '',
            productImage: null,

            newProductModalVisible: false,
            imagePreview: null,

            activeFilterIndex: null,
            filterItems: [
                'Category',
                'Price'
            ],

            productCount: 0,
            moreBtn: false,

            searchInput: '',
            suggestionList: [],
            showSuggestions: false,

            detailProductModalVisible: false,
            isEditing: false,
        };
    },

    created() {
        this.getProducts();
        this.getCategoryList();
    },

    mounted() {
        document.addEventListener('click', this.handleClickOutside);
    },

    beforeUnmount() {
        document.removeEventListener('click', this.handleClickOutside);
    },

    methods: {
        // date and time format to UTC +7
        formatDateTime(dateTime) {
            return commonFunc.formatDateTime(dateTime);
        },

        // display new product creation modal
        showNewProductModal() {
            this.newProductModalVisible = true;
        },

        // hide new product creation modal
        hideNewProductModal() {
            this.newProductModalVisible = false;
        },

        // handle off-target licking
        handleClickOutside(event) {
            if (!(this.$refs.suggestions && this.$refs.suggestions.contains(event.target))) {
                this.showSuggestions = false;
            }
        },

        // show/hide filter list
        toggleFilterList(index) {
            if (this.activeFilterIndex === index)
                this.activeFilterIndex = null;
            else
                this.activeFilterIndex = index;
        },

        // Process image file import for product
        handleFileInput(event) {
            this.productImage = event.target.files[0];
            if (!this.productImage) return;

            const reader = new FileReader();
            reader.onload = (e) => {
                this.imagePreview = e.target.result;
            };
            reader.readAsDataURL(this.productImage);
        },

        // create new product
        createProduct() {
            if (this.productName.length == 0 || this.productPrice.length < 1) {
                commonFunc.showAlert('Error', 'Please check your product name and price');
                return;
            }

            commonFunc.showProgressBar();
            const productData = new FormData();
            productData.append('productName', this.productName);
            productData.append('productPrice', this.productPrice);
            productData.append('productDescribe', this.productDescribe);
            productData.append('productImage', this.productImage);
            axios.post('/product', productData, {
                headers: {
                    'Content-Type': 'multipart/form-data'
                }
            })
                .then((res) => {
                    commonFunc.hideProgressBar();
                    this.hideNewProductModal();
                    commonFunc.showAlert('Message', res.data, commonFunc.reloadPage);
                });
        },

        // get product list
        getProducts() {
            this.moreBtn = false;
            commonFunc.showProgressBar();

            return new Promise((resolve) => {
                axios.get('/product')
                    .then((response) => {
                        this.products = response.data;
                        this.productCount = this.products.length;
                        this.moreBtn = true;
                        this.originalProductList = this.products;
                        commonFunc.hideProgressBar();
                        resolve();
                    });
            });
        },

        // reset search result
        resetSearch() {
            this.products = this.originalProductList;
            this.productCount = this.products.length;
            this.searchInput = '';
        },

        // get category list
        getCategoryList() {
            return new Promise((resolve) => {
                axios.get('/category')
                    .then((response) => {
                        this.categories = response.data;
                        resolve();
                    });
            });
        },

        // filter products by category
        productFilterByCategory(category_id) {
            commonFunc.showProgressBar();
            this.moreBtn = false;

            return new Promise((resolve) => {
                axios.get(`product/filterByCategory/${category_id}`)
                    .then((response) => {
                        this.products = response.data;
                        this.productCount = this.products.length;
                        this.moreBtn = true;
                        this.activeFilterIndex = null;
                        commonFunc.hideProgressBar();
                        resolve();
                    });
            });
        },

        // sort products by price
        getProductsByPrice() {
            this.moreBtn = false;
            commonFunc.showProgressBar();
            return new Promise((resolve) => {
                axios.get('/product/priceSort')
                    .then((response) => {
                        this.products = response.data;
                        this.productCount = this.products.length;
                        this.moreBtn = true;
                        commonFunc.hideProgressBar();
                        resolve();
                    });
            });
        },

        // change the arrangement
        productSortByPrice(sortIndex) {
            if (sortIndex === 0)
                this.getProductsByPrice();
            else {
                this.getProductsByPrice().then(() => {
                    this.products = this.products.reverse();
                });
            }
            this.activeFilterIndex = null;
        },

        // Show suggestions when searching
        fetchSuggestions() {
            if (this.searchInput === '') {
                this.suggestionList = [];
                this.showSuggestions = false;
                return;
            }

            this.suggestionList = this.originalProductList.filter(product =>
                product.name.toLowerCase().includes(this.searchInput.toLowerCase())
            );
            this.showSuggestions = true;
        },

        // handle item selection after search
        selectSuggestion(suggestion) {
            this.products = [];
            this.products.push(suggestion);
            this.productCount = this.products.length;
        },

        // get detail product information by Id
        getDetailProduct(product_id) {
            commonFunc.showProgressBar();

            return new Promise((resolve) => {
                axios.get(`product/detail/${product_id}`)
                    .then((response) => {
                        this.productDetail = response.data;
                        this.detailProductModalVisible = true;
                        commonFunc.hideProgressBar();
                        resolve(this.productDetail);
                    });
            });
        },

        // hide detail product information
        hideDetailProductModal() {
            this.detailProductModalVisible = false;
            this.isEditing = false;
        },

        // status allows product editing
        startEditing() {
            this.isEditing = true;
        },

        // status allows disallowing product editing
        endEditing() {
            this.isEditing = false;
        },

        // edit product information
        editProduct() {
            const updatedProduct = this.productDetail[0];
            commonFunc.showProgressBar();

            return new Promise((resolve) => {
                axios.put('/product', updatedProduct)
                    .then((res) => {
                        commonFunc.hideProgressBar();

                        this.productDetail[0] = res.data;
                        this.hideDetailProductModal();
                        commonFunc.showAlert('Message', res.data, commonFunc.reloadPage);
                        resolve();
                    });
            });
        },

    }
}
</script>