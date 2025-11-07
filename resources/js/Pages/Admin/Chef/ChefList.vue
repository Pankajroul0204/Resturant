<script setup>
// import AppLayout from '@/Layouts/AppLayout.vue';
import AppLayout from '@/Layouts/SidebarLayout.vue';
import { Link } from '@inertiajs/vue3';
import Paginator from '@/Components/PaginationComponent.vue';
const props = defineProps({
    data: Object
})
const deleteChef = (id) => {
    if (confirm("Are you sure you want to delete this record?")) {
        axios.delete(route('admin.chef.destroy', { chef: id }))
            .then(response => {
                console.log(response);
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
const fullmessage = (event, message) => {
    const tooltip = document.createElement('div');
    tooltip.className = 'tooltip';
    tooltip.innerText = message;
    tooltip.style.position = 'absolute';
    tooltip.style.left = `${event.pageX + 10}px`;
    tooltip.style.top = `${event.pageY + 10}px`;
    tooltip.style.backgroundColor = '#333';
    tooltip.style.color = '#fff';
    tooltip.style.padding = '5px 10px';
    tooltip.style.borderRadius = '4px';
    document.body.appendChild(tooltip);

    event.target.addEventListener('mouseleave', () => {
        document.body.removeChild(tooltip);
    }, { once: true });
}
</script>
<template>

    <AppLayout title="Chef List" pageName="Chef List.">

        <template #header>
            <span
                class="px-5  text-white w-5 border border-gray-200 rounded-lg bg-gray-50 dark:bg-gray-800 dark:border-gray-700 hover:underline">
                Chef List.
            </span>
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
                                <Link :href="route('admin.heroPage')"
                                    class="ms-1 text-sm font-medium text-gray-700 hover:text-blue-600 md:ms-2 dark:text-gray-400 dark:hover:text-white">
                                Add Hero</Link>
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
                                    class="ms-1 text-sm font-medium text-gray-700 md:ms-2 dark:text-gray-400 dark:text-white">Chef
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


                                <div class="relative overflow-x-auto shadow-md sm:rounded-lg">

                                    <!--table start-->
                                    <label for="table-search" class="sr-only">Search</label>
                                    <div class="relative">
                                        <div
                                            class="absolute inset-y-0 left-0 rtl:inset-r-0 rtl:right-0 flex items-center ps-3 pointer-events-none">
                                            <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                                fill="currentColor" viewBox="0 0 20 20"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd"
                                                    d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                                    clip-rule="evenodd"></path>
                                            </svg>
                                        </div>
                                        <input type="search" id="table-search"
                                            class="block p-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg w-80 bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                            placeholder="Search for items">
                                    </div>

                                    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                                        <table
                                            class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                            <thead
                                                class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                                <tr>
                                                    <!-- <th scope="col" class="p-4">
                                                        <div class="flex items-center">
                                                            <input id="checkbox-all-search" type="checkbox"
                                                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded-sm focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                                            <label for="checkbox-all-search"
                                                                class="sr-only">checkbox</label>
                                                        </div>
                                                    </th> -->
                                                    <th scope="col" class="px-6 py-3">
                                                        <div class="flex items-center">
                                                            Chef Name
                                                            <a href="#"><svg class="w-3 h-3 ms-1.5" aria-hidden="true"
                                                                    xmlns="http://www.w3.org/2000/svg"
                                                                    fill="currentColor" viewBox="0 0 24 24">
                                                                    <path
                                                                        d="M8.574 11.024h6.852a2.075 2.075 0 0 0 1.847-1.086 1.9 1.9 0 0 0-.11-1.986L13.736 2.9a2.122 2.122 0 0 0-3.472 0L6.837 7.952a1.9 1.9 0 0 0-.11 1.986 2.074 2.074 0 0 0 1.847 1.086Zm6.852 1.952H8.574a2.072 2.072 0 0 0-1.847 1.087 1.9 1.9 0 0 0 .11 1.985l3.426 5.05a2.123 2.123 0 0 0 3.472 0l3.427-5.05a1.9 1.9 0 0 0 .11-1.985 2.074 2.074 0 0 0-1.846-1.087Z" />
                                                                </svg></a>
                                                        </div>
                                                    </th>
                                                    <th scope="col" class="px-6 py-3">
                                                        Image
                                                    </th>
                                                    <th scope="col" class="px-6 py-3">
                                                        Designation
                                                    </th>
                                                    <th scope="col" class="px-6 py-3">
                                                        Chef Description
                                                    </th>
                                                    <th scope="col" class="px-6 py-3">
                                                        Chef Achivements
                                                    </th>
                                                    <th scope="col" class="px-6 py-3">
                                                        Signature
                                                    </th>
                                                    <th scope="col" class="px-6 py-3">
                                                        Action
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr v-if="props.data.data.length == 0"
                                                    class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200 hover:bg-gray-50 dark:hover:bg-gray-600 ">
                                                    <td colspan="13" class="text-center py-4 text-white">...No Record
                                                        Found...
                                                    </td>
                                                </tr>
                                                <template v-else>
                                                    <tr v-for="record in data.data" :key="record"
                                                        class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200 ">
                                                        <th scope="row"
                                                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                            {{ record.name }}
                                                        </th>
                                                        <td class="px-6 py-4">
                                                            <img :src="record.image" alt="" height="300" width="300">
                                                        </td>
                                                        <td class="px-6 py-4">
                                                            {{ record.designation }}
                                                        </td>
                                                        <td class="px-6 py-4"   @mouseover=" fullmessage($event, record.description)">
                                                            {{ record.description.length > 50 ?
                                                                record.description.substring(0, 50) + ' ...' :
                                                                record.description }}
                                                        </td>
                                                        <td class="px-6 py-4">
                                                            {{ record.achivements }}
                                                        </td>
                                                          <td class="px-6 py-4">
                                                            <template v-if="record.signature!=null">
                                                                <img :src="record.signature" alt="" height="300" width="300">
                                                            </template>
                                                            <template v-else>
                                                                NA
                                                            </template>
                                                        </td>
                                                        <td class="px-6 py-4">
                                                            <Link
                                                                :href="route('admin.chef.edit', record.id )"
                                                                class="font-medium text-blue-600 dark:text-blue-500 hover:underline">
                                                            <svg class="w-[21px] h-[21px] text-gray-800 dark:text-blue-500 hover:text-blue-900"
                                                                aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                                                width="24" height="24" fill="currentColor"
                                                                viewBox="0 0 24 24">
                                                                <path fill-rule="evenodd"
                                                                    d="M14 4.182A4.136 4.136 0 0 1 16.9 3c1.087 0 2.13.425 2.899 1.182A4.01 4.01 0 0 1 21 7.037c0 1.068-.43 2.092-1.194 2.849L18.5 11.214l-5.8-5.71 1.287-1.31.012-.012Zm-2.717 2.763L6.186 12.13l2.175 2.141 5.063-5.218-2.141-2.108Zm-6.25 6.886-1.98 5.849a.992.992 0 0 0 .245 1.026 1.03 1.03 0 0 0 1.043.242L10.282 19l-5.25-5.168Zm6.954 4.01 5.096-5.186-2.218-2.183-5.063 5.218 2.185 2.15Z"
                                                                    clip-rule="evenodd" />
                                                            </svg>
                                                            </Link><br>
                                                            <Link @click="deleteChef(record.id)" href="#"
                                                                class="font-medium text-blue-600 dark:text-red-500 hover:underline">
                                                            <svg class="w-[21px] h-[21px] text-gray-800 dark:text-red-500 hover:text-red-900"
                                                                aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                                                width="24" height="24" fill="currentColor"
                                                                viewBox="0 0 24 24">
                                                                <path fill-rule="evenodd"
                                                                    d="M8.586 2.586A2 2 0 0 1 10 2h4a2 2 0 0 1 2 2v2h3a1 1 0 1 1 0 2v12a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V8a1 1 0 0 1 0-2h3V4a2 2 0 0 1 .586-1.414ZM10 6h4V4h-4v2Zm1 4a1 1 0 1 0-2 0v8a1 1 0 1 0 2 0v-8Zm4 0a1 1 0 1 0-2 0v8a1 1 0 1 0 2 0v-8Z"
                                                                    clip-rule="evenodd" />
                                                            </svg>

                                                            </Link>
                                                        </td>
                                                    </tr>
                                                </template>

                                            </tbody>
                                        </table>
                                        <nav class="flex items-center flex-column flex-wrap md:flex-row justify-between pt-4"
                                            aria-label="Table navigation">
                                            <span
                                                class="text-sm font-normal text-gray-500 dark:text-gray-400 mb-4 md:mb-0 block w-full md:inline md:w-auto">Showing
                                                <span class="font-semibold text-gray-900 dark:text-black">{{
                                                    props.data.from
                                                }}-{{ props.data.to }}</span> of
                                                <span class="font-semibold text-gray-900 dark:text-black">{{
                                                    props.data.total
                                                    }}</span></span>
                                            <ul class="inline-flex -space-x-px rtl:space-x-reverse text-sm h-8">
                                               <Paginator :links="props.data.links"></Paginator>
                                            </ul>
                                        </nav>
                                    </div>


                                    <!--table end-->



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
