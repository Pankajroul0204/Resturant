<script setup>
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
// import AppLayout from '@/Layouts/AppLayout.vue';
import AppLayout from '@/Layouts/SidebarLayout.vue';
import FileUpload from '@/Components/FileUpload.vue';
import { useForm } from '@inertiajs/vue3'
import { ref,onMounted } from 'vue';

const props = defineProps({
    data: Object,
});

const current_year = ref(new Date().getFullYear())

const form = useForm({
    heading: props.data?.heading ?? '',
    description: props.data?.description ?? '',
    year_of_establishment: props.data?.year_of_establishment ?? current_year.value,
    cook_quotes: props.data?.cook_quotes ?? '',
    image1: [],
    image2: [],
    chef_id: props.data?.chef_id ?? '',
});
const imgUrl1 = ref("");
const imgUrl2 = ref("");

const pgName = ref("");
const pgTitle = ref("");

onMounted(() => {
 imgUrl1.value = ref(props.data?.image1 );
 imgUrl2.value = ref(props.data?.image2);
 if(props.data !=null){
    pgName.value = "Edit About.";
    pgTitle.value = "Edit About";
 }else{
    pgName.value = "Add About.";
    pgTitle.value = "Add About";
 }
});

const submit = () => {
  if (props.data) {
    form.put(route('admin.about.update', props.data.id), {
      onSuccess: () => {
        location.reload()
      },
    });
  } else {
    form.post(route('admin.about.store'), {
      onSuccess: () => {
        form.reset();
      },
    });
  }
};
</script>
<style>
.existing{
    width: 100px;
    height: 100px;
    object-fit: cover;
    border-radius: 8px;
    margin-top: 10px;
}
</style>

<template>
    <AppLayout :title="pgTitle" :pageName="pgName">
        <template #header>

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
                                    <InputLabel for="heading" value="Heading" req=true />
                                    <TextInput id="heading" type="text" class="block w-full"
                                        v-model="form.heading" />
                                    <InputError v-show="form.errors.heading" class="mt-2"
                                        :message="form.errors.heading" />
                                </div>

                                <div>
                                    <InputLabel for="description" value="Enter Description" req=true />
                                    <textarea v-model="form.description" class="w-full rounded-md"></textarea>
                                    <InputError class="mt-2" :message="form.errors.description" />
                                </div>

                                <div>
                                    <InputLabel for="year_of_establishment" value="Year Of Establishment" req=true />
                                     <TextInput id="year_of_establishment" type="number" min="1900" :max="current_year" class="block w-full"
                                        v-model="form.year_of_establishment" />
                                    <InputError class="mt-2" :message="form.errors.year_of_establishment" />
                                </div>

                                <div>
                                    <InputLabel for="cook_quotes" value="Cook Quotes" req="true"/>
                                    <textarea v-model="form.cook_quotes" class="w-full rounded-md"></textarea>
                                    <InputError class="mt-2" :message="form.errors.cook_quotes" />
                                </div>

                                <div>
                                    <InputLabel for="button_link" value="First Image" req=true />
                                    <FileUpload v-model="form.image1" :imgUrl="[imgUrl1]" />
                                    <template v-if="form.image1.length ==0">
                                        <img v-if="imgUrl1.value!=null" class="existing" :src="`http://127.0.0.1:8000/${imgUrl1.value}`" alt="not found">
                                    </template>
                                    <InputError class="mt-2" :message="form.errors.image1" />
                                </div>

                                <div>
                                    <InputLabel for="button_link" value="Second Image" req=true />
                                    <FileUpload v-model="form.image2" :imgUrl="[imgUrl2]" />
                                    <template v-if="form.image2.length ==0">
                                        <img v-if="imgUrl2.value!=null" class="existing" :src="`http://127.0.0.1:8000/${imgUrl2.value}`" alt="not found">
                                    </template>
                                    <InputError class="mt-2" :message="form.errors.image2" />
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
