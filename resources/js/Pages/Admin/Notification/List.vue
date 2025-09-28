<script setup>
// import AppLayout from '@/Layouts/AppLayout.vue';
import AppLayout from '@/Layouts/SidebarLayout.vue';
import { Link } from '@inertiajs/vue3';
import Paginator from '@/Components/PaginationComponent.vue';
const props = defineProps({
    notifications: Object
})
console.log(props.notifications);
const deleteResturant = (id) => {
    if (confirm("Are you sure you want to delete this record?")) {
        axios.delete(route('admin.heroDelete', { resturant_id: id }))
            .then(response => {
                if (response.data.status == 1) {
                    alert(response.data.msg);
                    window.location.reload();
                } else {
                    alert(response.data.msg);
                }
            })
            .catch(error => {
                console.error("There was an error deleting the record:", error);
            });
    }
}
</script>
<template>

    <AppLayout title="Notifications" pageName="Notifications">

        <template #header>
            <div class="float-right ">
                <!-- Breadcrumb -->
                <nav class="flex px-5  text-gray-700 border border-gray-200 rounded-lg bg-gray-50 dark:bg-gray-800 dark:border-gray-700"
                    aria-label="Breadcrumb">
                    <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
                        <li class="inline-flex items-center">
                            <Link :href="route('dashboard')"
                                class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600 dark:text-gray-400 dark:hover:text-white">
                            <svg class="w-3 h-3 me-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="m19.707 9.293-2-2-7-7a1 1 0 0 0-1.414 0l-7 7-2 2a1 1 0 0 0 1.414 1.414L2 10.414V18a2 2 0 0 0 2 2h3a1 1 0 0 0 1-1v-4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v4a1 1 0 0 0 1 1h3a2 2 0 0 0 2-2v-7.586l.293.293a1 1 0 0 0 1.414-1.414Z" />
                            </svg>
                            Home
                            </Link>
                        </li>
                        <li>
                            <div class="flex items-center">
                                <svg class="rtl:rotate-180 block w-3 h-3 mx-1 text-gray-400 " aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="m1 9 4-4-4-4" />
                                </svg>
                                <Link :href="route('admin.menuPage')"
                                    class="ms-1 text-sm font-medium text-gray-700 hover:text-blue-600 md:ms-2 dark:text-gray-400 dark:hover:text-white">
                                Add Menu</Link>
                            </div>
                        </li>
                        <li>
                            <div class="flex items-center">
                                <svg class="rtl:rotate-180 block w-3 h-3 mx-1 text-gray-400 " aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="m1 9 4-4-4-4" />
                                </svg>
                                <span
                                    class="ms-1 text-sm font-medium text-gray-700 md:ms-2 dark:text-gray-400 dark:text-white">Menu
                                    List</span>
                            </div>
                        </li>
                    </ol>
                </nav>
                <!-- Breadcrumb End-->
            </div>
        </template>

        <div class="py-12">

            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="px-6 py-4">

                        <!-- content start -->
                        <div class="relative overflow-x-auto">
                            <div class="relative overflow-x-auto">

                                <div class="today">
                                    <div>
                                        <div class="today p-6 bg-white border border-gray-200 rounded-lg mb-6">
                                            <div class="mb-8">
                                                <h3 class=" text-lg text-gray-500  font-semibold mb-2">Today</h3>
                                                <hr class="border-gray-300 mb-4">
                                                <ul v-if="notifications.today.length">
                                                    <li class="mb-2 p-3 bg-blue-100 rounded flex justify-between items-end" v-for="n in notifications.today" :key="n.id">
                                                        <span class="font-medium">{{n.data}}</span>
                                                        <span class="text-xs text-gray-500">{{n.created_at}}</span>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="today p-6 bg-white border border-gray-200 rounded-lg mb-6">
                                            <div class="mb-8">
                                                <h3 class=" text-lg text-gray-500  font-semibold mb-2">Yesterday</h3>
                                                <hr class="border-gray-300 mb-4">
                                                <ul>
                                                    <li
                                                        class="mb-2 p-3 bg-blue-100 rounded flex justify-between items-end">
                                                        <span class="font-medium">Message</span>
                                                        <span class="text-xs text-gray-500">10:30 AM</span>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="today p-6 bg-white border border-gray-200 rounded-lg mb-6">
                                            <div class="mb-8">
                                                <h3 class=" text-lg text-gray-500  font-semibold mb-2">Older</h3>
                                                <hr class="border-gray-300 mb-4">
                                                <ul>
                                                    <li
                                                        class="mb-2 p-3 bg-blue-100 rounded flex justify-between items-end">
                                                        <span class="font-medium">Message</span>
                                                        <span class="text-xs text-gray-500">10:30 AM</span>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>

                                    </div>
                                </div>


                            </div>

                        </div>
                        <!-- content end -->

                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
