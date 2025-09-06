<script setup>
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
// import AppLayout from '@/Layouts/AppLayout.vue';
import AppLayout from '@/Layouts/SidebarLayout.vue';
import FileUpload from '@/Components/FileUpload.vue';
import { useForm } from '@inertiajs/vue3'

const props = defineProps({
    data: Object,
});

const form = useForm({
    resturant_name: props.data?.resturant_name ?? '',
    heading: props.data?.heading ?? '',
    description: props.data?.description ?? '',
    open_interval: props.data?.open_interval ?? '',
    open_time_duration_from: props.data?.open_time_duration_from ?? '',
    open_time_duration_to: props.data?.open_time_duration_to ?? '',
    booking_status: props.data?.booking_status ?? '',
    fb: props.data?.fb ?? '',
    insta: props.data?.insta ?? '',
    x: props.data?.x ?? '',
    you_tube: props.data?.you_tube ?? '',
    image: null,
});

const submit = () => {
    if (props.data) {
        form.put(route('admin.heroPageUpdate', props.data.id),
            {
                onSuccess: () => {
                    form.reset();
                }
            }
        );
    }
    form.post(route('admin.heroPage'),
        {
            onSuccess: () => {
                form.reset();
            }
        }
    );
}
</script>

<template>
    <AppLayout title="Hero" pageName="Hero Element Creation.">
        <template #header>
            <span
                class="px-5  text-white w-5 border border-gray-200 rounded-lg bg-gray-50 dark:bg-gray-800 dark:border-gray-700 hover:underline">
                Hero Element Creation.
            </span>

            <div class="float-right">
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
                                <Link :href="route('admin.HeroList')"
                                    class="ms-1 text-sm font-medium text-gray-700 hover:text-blue-600 md:ms-2 dark:text-gray-400 dark:hover:text-white">
                                Hero List</Link>
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
                                    class="ms-1 text-sm font-medium text-gray-700 md:ms-2 dark:text-gray-400 dark:text-white">Hero
                                    Creation</span>
                            </div>
                        </li>
                    </ol>
                </nav>
            </div>
            <!-- Breadcrumb End-->
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="px-6 py-4">
                        <!-- content start -->
                        <form @submit.prevent="submit">
                            <div class=" grid grid-cols-2 gap-2 mt-2">
                                <div>
                                    <InputLabel for="resturant_name" value="Enter Resturant Name" />
                                    <TextInput id="resturant_name" type="text" class="block w-full"
                                        v-model="form.resturant_name" />
                                    <InputError v-show="form.errors.resturant_name" class="mt-2"
                                        :message="form.errors.resturant_name" />
                                </div>

                                <div>
                                    <InputLabel for="heading" value="Enter Hero Heading" class="px-2" />
                                    <TextInput id="heading" type="text" class="block w-full" v-model="form.heading" />
                                    <InputError class="mt-2" :message="form.errors.heading" />
                                </div>

                                <div>
                                    <InputLabel for="description" value="Enter Hero Description" />
                                    <textarea v-model="form.description" class="w-full rounded-md"></textarea>
                                    <InputError class="mt-2" :message="form.errors.description" />
                                </div>

                                <div>
                                    <InputLabel for="open_interval" v-model="form.open_interval"
                                        value="Enter Resturant Open Interval" />
                                    <select class="block w-full rounded-md " id="open_interval"
                                        v-model="form.open_interval">
                                        <option selected>Select Open Interval</option>
                                        <option value="Open Daily">Open Daily</option>
                                        <option value="Open Weekly">Open Weekly</option>
                                    </select>
                                    <InputError class="mt-2" :message="form.errors.open_interval" />
                                </div>
                                <div>
                                    <InputLabel for="open_time_duration_from"
                                        value="Enter Resturant Open Time Duration From" />
                                    <div class="relative">
                                        <div
                                            class="absolute inset-y-0 end-0 top-0 flex items-center pe-3.5 pointer-events-none">
                                            <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                                xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                                viewBox="0 0 24 24">
                                                <path fill-rule="evenodd"
                                                    d="M2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10S2 17.523 2 12Zm11-4a1 1 0 1 0-2 0v4a1 1 0 0 0 .293.707l3 3a1 1 0 0 0 1.414-1.414L13 11.586V8Z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                        </div>
                                        <input type="time" id="time"
                                            class="text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:focus:border-blue-500" value="00:00" v-model="form.open_time_duration_from"
                                            required />
                                    </div>
                                    <InputError class="mt-2" :message="form.errors.open_time_duration_from" />
                                </div>
                                <div>
                                    <InputLabel for="open_time_duration_to"
                                        value="Enter Resturant Open Time Duration To" />

                                    <div class="relative">
                                        <div
                                            class="absolute inset-y-0 end-0 top-0 flex items-center pe-3.5 pointer-events-none">
                                            <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                                xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                                viewBox="0 0 24 24">
                                                <path fill-rule="evenodd"
                                                    d="M2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10S2 17.523 2 12Zm11-4a1 1 0 1 0-2 0v4a1 1 0 0 0 .293.707l3 3a1 1 0 0 0 1.414-1.414L13 11.586V8Z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                        </div>
                                        <input type="time" id="time"
                                            class="text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:focus:border-blue-500"
                                           v-model="form.open_time_duration_to"
                                            required />
                                    </div>
                                    <InputError class="mt-2" :message="form.errors.open_time_duration_to" />
                                </div>
                                <div>
                                    <InputLabel for="booking_status" value="Enter Reservation Status" />
                                    <select class="block w-full rounded-md " id="open_interval"
                                        v-model="form.booking_status">
                                        <option selected>Reservation Status</option>
                                        <option value="1">Reservation open</option>
                                        <option value="0">Reservation close</option>
                                    </select>
                                    <InputError class="mt-2" :message="form.errors.booking_status" />
                                </div>
                                <div>
                                    <InputLabel for="fb" value="Enter Resturant Facebook Account Link" />
                                    <TextInput id="fb" type="text" class="block w-full" v-model="form.fb" />
                                    <InputError class="mt-2" :message="form.errors.fb" />
                                </div>
                                <div>
                                    <InputLabel for="insta" value="Enter Resturant Instagram Account Link" />
                                    <TextInput id="insta" type="text" class="block w-full" v-model="form.insta" />
                                    <InputError class="mt-2" :message="form.errors.insta" />
                                </div>
                                <div>
                                    <InputLabel for="x" value="Enter Resturant Twitter Account Link" />
                                    <TextInput id="x" type="text" class="block w-full" v-model="form.x" />
                                    <InputError class="mt-2" :message="form.errors.x" />
                                </div>
                                <div>
                                    <InputLabel for="you_tube" value="Enter Resturant Youtube Account Link" />
                                    <TextInput id="you_tube" type="text" class="block w-full" v-model="form.you_tube" />
                                    <InputError class="mt-2" :message="form.errors.you_tube" />
                                </div>
                                <div>
                                    <InputLabel for="button_link" value="Upload Slider Images" />
                                    <FileUpload v-model="form.image" />
                                    <InputError class="mt-2" :message="form.errors.image" />
                                </div>
                                <div class="col-span-2">
                                    <SecondaryButton type="submit">Submit</SecondaryButton>
                                </div>
                            </div>
                        </form>
                        <!-- content end -->
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
