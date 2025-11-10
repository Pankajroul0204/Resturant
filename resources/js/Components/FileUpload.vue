<script setup>
import { ref, watch } from 'vue';

const props = defineProps({
  modelValue: {
    type: Array,
    default: () => [],
  },
});

const emit = defineEmits(['update:modelValue']);

// Reactive state
const imageUrls = ref([]);      // Preview URLs
const backendMsg = ref('');     // Error message (invalid file types)
const fileInputRef = ref(null); // Ref for hidden file input

// ✅ Allowed image MIME types
const validImageTypes = ['image/jpeg', 'image/jpg', 'image/png', 'image/heif','image/webp'];

// 🧠 Watch for changes in modelValue → regenerate previews
watch(
  () => props.modelValue,
  (files) => {
    imageUrls.value = [];
    backendMsg.value = '';

    if (Array.isArray(files) && files.length) {
      files.forEach(file => {
        if (file instanceof File && validImageTypes.includes(file.type)) {
          const reader = new FileReader();
          reader.onload = (e) => {
            imageUrls.value.push(e.target.result);
          };
          reader.readAsDataURL(file);
        }
      });
    }
  },
  { immediate: true }
);

const onFileChange = (event) => {
  const files = Array.from(event.target.files);
  backendMsg.value = '';

  const invalidFiles = files.filter(file => !validImageTypes.includes(file.type));
  if (invalidFiles.length > 0) {
    backendMsg.value = 'Some files were skipped. Please upload only JPEG, PNG, or HEIF images.';
  }

  // Filter valid image
  const validFiles = files.filter(file => validImageTypes.includes(file.type));

  emit('update:modelValue', validFiles);

  event.target.value = '';
};

const removeFile = (idx) => {
  const newFiles = props.modelValue.slice();
  newFiles.splice(idx, 1);
  emit('update:modelValue', newFiles);
};

const triggerFileInput = () => {
  backendMsg.value = '';
  fileInputRef.value?.click();
};
</script>

<template>
  <div>
    <input
      ref="fileInputRef"
      type="file"
      @change="onFileChange"
      multiple
      accept="image/jpeg,image/jpg,image/png,image/heif,image/webp"
      hidden
    />

    <button
      type="button"
      class="bg-white text-indigo-600 border border-gray-300 px-3 py-1 rounded-md flex items-center gap-2"
      @click="triggerFileInput"
    >
      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
        stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
        <path stroke-linecap="round" stroke-linejoin="round"
          d="m20.25 7.5-.625 10.632a2.25 2.25 0 0 1-2.247 2.118H6.622a2.25 2.25 0 0 1-2.247-2.118L3.75 7.5M10 11.25h4M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125Z" />
      </svg>
      Upload
    </button>

    <p v-if="backendMsg" class="text-red-500 mt-2 text-sm">{{ backendMsg }}</p>

    <div
      v-if="imageUrls.length"
      class="flex flex-wrap gap-3 mt-3"
    >
      <div
        v-for="(url, idx) in imageUrls"
        :key="idx"
        class="relative border rounded-lg overflow-hidden"
        style="width: 100px; height: 100px;"
      >
        <img
          :src="url"
          alt="Image Preview"
          class="object-cover w-full h-full"
        />
        <button
          type="button"
          @click="removeFile(idx)"
          class="absolute top-1 right-1 bg-white/80 text-black rounded-full w-5 h-5 flex items-center justify-center hover:bg-red-500 hover:text-white"
        >
          &times;
        </button>
      </div>
    </div>
  </div>
</template>
