<script setup>
import { ref, watch } from 'vue';

const props = defineProps({
    modelValue: {
        type: Array,
        default: () => [],
    },
});
const emit = defineEmits(['update:modelValue']);

const imageUrls = ref([]);

// Watch for changes in modelValue to update previews
watch(
    () => props.modelValue,
    (files) => {
        if (Array.isArray(files) && files.length) {
            imageUrls.value = [];
            files.forEach(file => {
                if (file instanceof File) {
                    const reader = new FileReader();
                    reader.onload = (e) => {
                        imageUrls.value.push(e.target.result);
                    };
                    reader.readAsDataURL(file);
                }
            });
        } else {
            imageUrls.value = [];
        }
    },
    { immediate: true }
);

const onFileChange = (event) => {
    const files = Array.from(event.target.files);
    emit('update:modelValue', files);
};

const removeFile = (idx) => {
    const newFiles = props.modelValue.slice();
    newFiles.splice(idx, 1);
    emit('update:modelValue', newFiles);
};

const triggerFileInput = (event) => {
    event.preventDefault();
    const fileInput = document.querySelector('input[type="file"]');
    if (fileInput) {
        fileInput.click();
    }
};
</script>

<template>
    <div>
        <input type="file" @change="onFileChange" multiple hidden />
        <button class="bg-white text-indigo-600" @click="triggerFileInput">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="m20.25 7.5-.625 10.632a2.25 2.25 0 0 1-2.247 2.118H6.622a2.25 2.25 0 0 1-2.247-2.118L3.75 7.5M10 11.25h4M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125Z" />
            </svg>
            Upload
        </button>
        <button>

        </button>
        <div style="display: flex; gap: 10px; flex-wrap: wrap; margin-top: 10px;">
            <div v-for="(url, idx) in imageUrls" :key="idx" style="position: relative;">
                <img :src="url" alt="Image Preview" style="max-width: 100px; max-height: 200px; display: block;" />
                <button type="button" @click="removeFile(idx)"
                    style="position: absolute; top: 2px; right: 2px; color: black; border: none; border-radius: 50%; width: 22px; height: 22px; cursor: pointer;">
                    &times;
                </button>
            </div>
        </div>
    </div>
</template>
