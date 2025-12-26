<template>
    <Editor v-model="data" />
    <button @click="emptyEditor">Empty the editor</button>

    <h2>Editor data</h2>
    <code>{{ data }}</code>
</template>

<script setup>
import { ref } from 'vue';
import Editor from '@/Components/Editor.vue';

const data = ref( '<p>Hello world!</p>' );

function emptyEditor() {
    data.value = '';
}
</script>
