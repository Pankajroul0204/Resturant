<script setup>
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Link } from '@inertiajs/vue3';
// import AppLayout from '@/Layouts/AppLayout.vue';
import AppLayout from '@/Layouts/SidebarLayout.vue';

import FileUpload from '@/Components/FileUpload.vue';
import { useForm } from '@inertiajs/vue3'

const props = defineProps({
    data: Object,
});

const testimonialform = useForm({
    name: props.data?.name ?? '',
    designation: props.data?.designation ?? '',
    message: props.data?.message ?? '',
    image: null,
});

const submit = () => {
    if (props.data) {
        testimonialform.put(route('admin.heroPageUpdate', props.data.id),
            {
                onSuccess: () => {
                    testimonialform.reset();
                }
            }
        );
    }
    testimonialform.post(route('admin.testimonials'),
        {
            onSuccess: () => {
                testimonialform.reset();
            }
        }
    );
}
</script>

<template>
    <AppLayout title="Testimonial Creat">
        <template #header>
            <span
                class="px-5  text-white w-5 border border-gray-200 rounded-lg bg-gray-50 dark:bg-gray-800 dark:border-gray-700 hover:underline">
                Testimonial Creat.
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
                                <Link :href="route('admin.testimonials_list')"
                                    class="ms-1 text-sm font-medium text-gray-700 hover:text-blue-600 md:ms-2 dark:text-gray-400 dark:hover:text-white">
                                Testimonial List</Link>
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
                                    class="ms-1 text-sm font-medium text-gray-700 md:ms-2 dark:text-gray-400 dark:text-white">Testimonial
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
                                    <InputLabel for="name" value="Enter Name" />
                                    <TextInput id="name" type="text" class="block w-full"
                                        v-model="testimonialform.name" />
                                    <InputError v-show="testimonialform.errors.name" class="mt-2"
                                        :message="testimonialform.errors.name" />
                                </div>

                                <div>
                                    <InputLabel for="designation" value="Enter Designation" class="px-2" />
                                    <TextInput id="designation" type="text" class="block w-full"
                                        v-model="testimonialform.designation" />
                                    <InputError class="mt-2" :message="testimonialform.errors.designation" />
                                </div>

                                <div>
                                    <InputLabel for="message" value="Enter Message" />
                                    <textarea v-model="testimonialform.message" class="w-full rounded-md"></textarea>
                                    <InputError class="mt-2" :message="testimonialform.errors.message" />
                                </div>
                                <div>
                                    <InputLabel for="button_link" value="Upload Slider Images" />
                                    <FileUpload v-model="testimonialform.image" />
                                    <InputError class="mt-2" :message="testimonialform.errors.image" />
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
