<script setup>
defineProps({
    value: String,
    req:{
        type: Boolean,
        default: false
    }
});
</script>

<template>
    <label class="block font-medium text-sm text-gray-700">
        <span v-if="value">{{ value }}</span>
        <span v-else><slot /></span>
        <span v-if="req" class="text-red-500">*</span>
    </label>
</template>
