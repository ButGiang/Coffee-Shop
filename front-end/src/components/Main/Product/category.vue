<template>
    <section class="py-8 current-highlight">
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
                        <span>Manage</span>
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
                        <span>Categories</span>
                    </a>
                </li>
            </ul>

            <!-- title -->
            <div class="pb-6 text-center border-b border-black border-opacity-5">
                <div class="relative">
                    <h2 class="mb-5 md:mb-0 text-5xl text-blue-400 leading-normal font-heading font-medium text-center">
                        Category list
                    </h2>
                </div>
            </div>

            <!-- new category btn -->
            <div class="flex items-center my-2">
                <button @click="showCategoryModal"
                    class="bg-orange-500 text-white font-bold py-2 px-4 rounded-xl hover:bg-orange-300">
                    New category
                </button>
            </div>

            <!-- category list -->
            <div class="w-3/4 p-4 mb-6 bg-gray-50 shadow rounded mx-auto">
                <table class="table-auto w-full">
                    <thead>
                        <tr class="text-xs text-gray-500 text-left border-b border-black border-opacity-5">
                            <th class="pb-3 pl-6 font-bold">ID</th>
                            <th class="pb-3 font-bold">Name</th>
                            <th class="pb-3 font-bold">Created day</th>
                            <th class="pb-3 font-bold">Status</th>
                            <th class="pb-3 font-bold">Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr v-for="(category, index) in categoryList" :key="index" class="text-xs bg-gray-50">
                            <td class="py-5 px-6 font-medium">#{{ index + 1 }}</td>

                            <td class="font-medium">{{ category.name }}</td>

                            <td class="font-medium">{{ formatDateTime(category.created_at) }}</td>

                            <td>
                                <span class="inline-block py-1 px-4 text-white rounded-full"
                                    :class="{ 'bg-green-500': category.status == 1, 'bg-red-500': category.status == 0 }">
                                    {{ category.status == 1 ? 'Active' : 'Inactive' }}
                                </span>
                            </td>

                            <td>
                                <div class="inline-block mr-2 cursor-pointer" @click="getDetailCategory(category.id)">
                                    <svg width="18" height="18" viewbox="0 0 18 18" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M16.4999 9C16.2789 9 16.0669 9.0878 15.9106 9.24408C15.7544 9.40036 15.6666 9.61232 15.6666 9.83333V14.8333C15.6666 15.0543 15.5788 15.2663 15.4225 15.4226C15.2662 15.5789 15.0542 15.6667 14.8332 15.6667H3.16656C2.94555 15.6667 2.73359 15.5789 2.57731 15.4226C2.42103 15.2663 2.33323 15.0543 2.33323 14.8333V3.16667C2.33323 2.94565 2.42103 2.73369 2.57731 2.57741C2.73359 2.42113 2.94555 2.33333 3.16656 2.33333H8.16657C8.38758 2.33333 8.59954 2.24554 8.75582 2.08926C8.9121 1.93298 8.9999 1.72101 8.9999 1.5C8.9999 1.27899 8.9121 1.06702 8.75582 0.910744C8.59954 0.754464 8.38758 0.666667 8.16657 0.666667H3.16656C2.50352 0.666667 1.86764 0.930059 1.3988 1.3989C0.929957 1.86774 0.666565 2.50363 0.666565 3.16667V14.8333C0.666565 15.4964 0.929957 16.1323 1.3988 16.6011C1.86764 17.0699 2.50352 17.3333 3.16656 17.3333H14.8332C15.4963 17.3333 16.1322 17.0699 16.601 16.6011C17.0698 16.1323 17.3332 15.4964 17.3332 14.8333V9.83333C17.3332 9.61232 17.2454 9.40036 17.0892 9.24408C16.9329 9.0878 16.7209 9 16.4999 9ZM3.9999 9.63333V13.1667C3.9999 13.3877 4.0877 13.5996 4.24398 13.7559C4.40026 13.9122 4.61222 14 4.83323 14H8.36657C8.47624 14.0006 8.58496 13.9796 8.68649 13.9381C8.78802 13.8967 8.88037 13.8356 8.95823 13.7583L14.7249 7.98333L17.0916 5.66667C17.1697 5.5892 17.2317 5.49703 17.274 5.39548C17.3163 5.29393 17.3381 5.18501 17.3381 5.075C17.3381 4.96499 17.3163 4.85607 17.274 4.75452C17.2317 4.65297 17.1697 4.5608 17.0916 4.48333L13.5582 0.908333C13.4808 0.830226 13.3886 0.768231 13.287 0.725924C13.1855 0.683617 13.0766 0.661835 12.9666 0.661835C12.8566 0.661835 12.7476 0.683617 12.6461 0.725924C12.5445 0.768231 12.4524 0.830226 12.3749 0.908333L10.0249 3.26667L4.24156 9.04167C4.16433 9.11953 4.10323 9.21188 4.06176 9.31341C4.02029 9.41494 3.99926 9.52366 3.9999 9.63333ZM12.9666 2.675L15.3249 5.03333L14.1416 6.21667L11.7832 3.85833L12.9666 2.675ZM5.66656 9.975L10.6082 5.03333L12.9666 7.39167L8.0249 12.3333H5.66656V9.975Z"
                                            fill="#382CDD"></path>
                                    </svg>
                                </div>
                                <div class="inline-block ml-2 cursor-pointer" @click="deleteCategory(category.id)">
                                    <svg width="20" height="20" viewbox="0 0 20 20" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M8.33333 15C8.55435 15 8.76631 14.9122 8.92259 14.7559C9.07887 14.5996 9.16667 14.3877 9.16667 14.1667V9.16666C9.16667 8.94564 9.07887 8.73368 8.92259 8.5774C8.76631 8.42112 8.55435 8.33332 8.33333 8.33332C8.11232 8.33332 7.90036 8.42112 7.74408 8.5774C7.5878 8.73368 7.5 8.94564 7.5 9.16666V14.1667C7.5 14.3877 7.5878 14.5996 7.74408 14.7559C7.90036 14.9122 8.11232 15 8.33333 15ZM16.6667 4.99999H13.3333V4.16666C13.3333 3.50362 13.0699 2.86773 12.6011 2.39889C12.1323 1.93005 11.4964 1.66666 10.8333 1.66666H9.16667C8.50363 1.66666 7.86774 1.93005 7.3989 2.39889C6.93006 2.86773 6.66667 3.50362 6.66667 4.16666V4.99999H3.33333C3.11232 4.99999 2.90036 5.08779 2.74408 5.24407C2.5878 5.40035 2.5 5.61231 2.5 5.83332C2.5 6.05434 2.5878 6.2663 2.74408 6.42258C2.90036 6.57886 3.11232 6.66666 3.33333 6.66666H4.16667V15.8333C4.16667 16.4964 4.43006 17.1322 4.8989 17.6011C5.36774 18.0699 6.00363 18.3333 6.66667 18.3333H13.3333C13.9964 18.3333 14.6323 18.0699 15.1011 17.6011C15.5699 17.1322 15.8333 16.4964 15.8333 15.8333V6.66666H16.6667C16.8877 6.66666 17.0996 6.57886 17.2559 6.42258C17.4122 6.2663 17.5 6.05434 17.5 5.83332C17.5 5.61231 17.4122 5.40035 17.2559 5.24407C17.0996 5.08779 16.8877 4.99999 16.6667 4.99999ZM8.33333 4.16666C8.33333 3.94564 8.42113 3.73368 8.57741 3.5774C8.73369 3.42112 8.94565 3.33332 9.16667 3.33332H10.8333C11.0543 3.33332 11.2663 3.42112 11.4226 3.5774C11.5789 3.73368 11.6667 3.94564 11.6667 4.16666V4.99999H8.33333V4.16666ZM14.1667 15.8333C14.1667 16.0543 14.0789 16.2663 13.9226 16.4226C13.7663 16.5789 13.5543 16.6667 13.3333 16.6667H6.66667C6.44565 16.6667 6.23369 16.5789 6.07741 16.4226C5.92113 16.2663 5.83333 16.0543 5.83333 15.8333V6.66666H14.1667V15.8333ZM11.6667 15C11.8877 15 12.0996 14.9122 12.2559 14.7559C12.4122 14.5996 12.5 14.3877 12.5 14.1667V9.16666C12.5 8.94564 12.4122 8.73368 12.2559 8.5774C12.0996 8.42112 11.8877 8.33332 11.6667 8.33332C11.4457 8.33332 11.2337 8.42112 11.0774 8.5774C10.9211 8.73368 10.8333 8.94564 10.8333 9.16666V14.1667C10.8333 14.3877 10.9211 14.5996 11.0774 14.7559C11.2337 14.9122 11.4457 15 11.6667 15Z"
                                            fill="#E85444"></path>
                                    </svg>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </section>

    <!-- new category modal -->
    <section class="w-full h-full fixed left-0 top-0 flex items-center bg-black bg-opacity-40 rounded"
        v-show="categoryModalVisible" @click.self="hideCategoryModal">
        <div class="container w-1/3 px-4 mx-auto">
            <div class="p-6 pb-0 h-full overflow-hidden bg-white rounded-t-md">
                <div class="pb-6 border-b border-coolGray-100">
                    <div class="flex flex-wrap items-center justify-between -m-2">
                        <div class="w-full p-2">
                            <h2 class="text-coolGray-900 text-lg font-semibold">{{ modalTitle }}</h2>
                        </div>
                    </div>
                </div>

                <div class="py-6 border-b border-coolGray-100">
                    <div class="w-full flex flex-wrap -m-3 mb-2">
                        <div class="w-full md:flex-1 p-3">
                            <p class="mb-1.5 font-medium text-base text-coolGray-800">Name</p>
                            <input type="text" v-model="categoryName"
                                class="w-full px-4 py-2.5 text-base text-coolGray-900 font-normal outline-none focus:border-green-500 border border-coolGray-200 rounded-lg shadow-input">
                        </div>

                        <div class="w-full md:w-40 p-3">
                            <p class="mb-1.5 font-medium text-base text-coolGray-800">Status</p>
                            <select v-model="categoryStatus"
                                class="w-full px-4 py-2.5 text-base text-coolGray-900 font-normal outline-none focus:border-green-500 border border-coolGray-200 rounded-lg shadow-input">
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <div class="p-4 bg-gray-300 rounded-b-md">
                <div class="w-full flex flex-wrap justify-end -m-1.5">
                    <div class="w-full md:w-auto p-1.5">
                        <button v-on:click="hideCategoryModal"
                            class="flex flex-wrap justify-center w-full px-4 py-2 font-medium text-sm text-coolGray-500 hover:text-coolGray-600 border border-coolGray-200 hover:border-coolGray-300 bg-white rounded-md shadow-button">
                            <p>Cancel</p>
                        </button>
                    </div>

                    <div class="w-full md:w-auto p-1.5">
                        <button v-on:click="isNewCategory ? createCategory() : updateCategory()"
                            class="flex flex-wrap justify-center w-full px-4 py-2 bg-green-500 hover:bg-green-600 font-medium text-sm text-white border border-green-500 rounded-md shadow-button">
                            <p>{{ isNewCategory ? 'Save' : 'Update' }}</p>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
import axios from '@/axios-config'
import { commonFunc } from '@/service/commonFunc'

export default {
    name: 'categoryPage',
    data() {
        return {
            categoryList: [],
            categoryModalVisible: false,
            categoryId: '',
            categoryName: '',
            categoryStatus: 1,
            isNewCategory: true,
            modalTitle: '',
            categoryDetail: []
        }
    },

    created() {
        this.getCategories();
    },

    methods: {
        // display new category creation modal
        showCategoryModal() {
            this.categoryModalVisible = true;
            this.modalTitle = 'New Category';
            this.isNewCategory = true;
        },

        // hide new category creation modal
        hideCategoryModal() {
            this.categoryName = '';
            this.categoryStatus = 1;
            this.categoryModalVisible = false;
        },

        // get category list from DB
        getCategories() {
            commonFunc.showProgressBar();
            axios.get('/category')
                .then((response) => {
                    this.categoryList = response.data;
                    commonFunc.hideProgressBar();
                });
        },

        // create new category
        createCategory() {
            if (this.categoryName.length == 0) {
                commonFunc.showAlert('Error', 'Please check your category name');
                return;
            }

            commonFunc.showProgressBar();
            const categoryData = new FormData();
            categoryData.append('categoryName', this.categoryName);
            categoryData.append('categoryStatus', this.categoryStatus);

            axios.post('/category', categoryData, {
                headers: {
                    'Content-Type': 'multipart/form-data'
                }
            })
                .then((res) => {
                    commonFunc.hideProgressBar();
                    this.hideCategoryModal();
                    commonFunc.showAlert('Message', res.data, commonFunc.reloadPage);
                });
        },

        // edit category information
        updateCategory() {
            if (this.categoryName.length == 0) {
                commonFunc.showAlert('Error', 'Please check your category name');
                return;
            }

            commonFunc.showProgressBar();
            const newCategoryData = {
                categoryId: this.categoryId,
                categoryName: this.categoryName,
                categoryStatus: this.categoryStatus,
            };

            axios.put('/category', newCategoryData)
                .then((res) => {
                    commonFunc.hideProgressBar();
                    this.hideCategoryModal();
                    commonFunc.showAlert('Message', res.data, commonFunc.reloadPage);
                })
        },

        // delete category by id
        deleteCategory(category_id) {
            const func = () => {
                commonFunc.showProgressBar();

                axios.delete(`/category/${category_id}`)
                    .then((res) => {
                        commonFunc.hideProgressBar();
                        commonFunc.showAlert('Message', res.data, commonFunc.reloadPage);
                    });
            }

            commonFunc.showConfirm('Message', 'Confirm deletion of category?', func);
        },

        // date and time format to UTC +7
        formatDateTime(dateTime) {
            return commonFunc.formatDateTime(dateTime);
        },

        // get information of a specific category
        getDetailCategory(category_id) {
            commonFunc.showProgressBar();

            axios.get(`/category/${category_id}`)
                .then((response) => {
                    this.categoryDetail = response.data;
                    if (this.categoryDetail) {
                        this.categoryModalVisible = true;
                        this.modalTitle = 'Edit Category';
                        this.categoryId = this.categoryDetail.id;
                        this.categoryName = this.categoryDetail.name;
                        this.categoryStatus = this.categoryDetail.status;
                        this.isNewCategory = false;
                        commonFunc.hideProgressBar();
                    }
                });
        },
    }
}
</script>