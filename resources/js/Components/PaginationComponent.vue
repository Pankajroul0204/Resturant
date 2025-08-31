<template >
    <li v-for="(link, i) in links" :key="i">
        <Link v-if="link.url" :href="link.url" :class="[
            'flex items-center justify-center px-3 h-8 leading-tight border',
            link.active
                ? 'text-blue-600 bg-blue-50 border-blue-300'
                : 'text-gray-500 bg-white border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white'
        ]" v-html="link.label" />
        <span v-else
            :class="'flex items-center justify-center px-3 h-8 leading-tight text-gray-400 bg-white border border-gray-300 cursor-not-allowed'"
            v-html="link.label" />
    </li>
</template>

<script setup>

const props=defineProps({
    links:Object
})
</script>
