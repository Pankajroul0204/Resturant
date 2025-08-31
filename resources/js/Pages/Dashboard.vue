<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import Welcome from '@/Components/Welcome.vue';
import FileUpload from '@/Components/FileUpload.vue';
// import TextInput from '@/Components/TextInput.vue';
// import InputLabel from '@/Components/InputLabel.vue';
// import SecondaryButton from '@/Components/SecondaryButton.vue';
// import { useForm } from '@inertiajs/vue3';

// const form = useForm({
//     name: '',
//     email: '',
//     password: ''
// });

// const submit = () => {
//     alert('Form submitted');
//     form.post(route('admin.create'))
//     console.log(form);
// };
</script>

<template>
    <AppLayout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Dashboard
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <Welcome />
                    <!-- <form @submit.prevent="submit"> -->
                        <!-- <InputLabel>Enter Name</InputLabel>
                        <TextInput :type="text" v-model="form.name"></TextInput>
                        <InputError :message="form.errors.name">{{ form.errors.name }}</InputError>
                        <InputLabel>Enter Email</InputLabel>
                        <TextInput :type="text" v-model="form.email"></TextInput>
                        <InputError :message="form.errors.email">{{ form.errors.email }}</InputError>
                        <InputLabel>Enter Password</InputLabel>
                        <TextInput :type="text" v-model="form.password"></TextInput>
                        <InputError :message="form.errors.password">{{ form.errors.password }}</InputError><br> -->

                        <!-- <SecondaryButton :type="submit">Submit</SecondaryButton> -->
                    <!-- </form> -->
                     <!-- <FileUpload/> -->

                </div>
            </div>
        </div>
    </AppLayout>
</template>
