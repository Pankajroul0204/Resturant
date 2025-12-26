<template>
    <ckeditor v-if="editor" v-model="data" :editor="editor" :config="config" tag-name="textarea" :disabled="disabled" />
</template>

<script setup>
import { ref, computed } from 'vue';
import { Ckeditor, useCKEditorCloud } from '@ckeditor/ckeditor5-vue';
import { usePage } from '@inertiajs/vue3';

const cloud = useCKEditorCloud({
    version: '47.2.0',
    premium: true
});

const data = ref('<p>Hello world!</p>');
const disabled = computed(() => !cloud.data.value);
const licenseKey =usePage().props.ckeditor_cloud_license_key;
const editor = computed(() => {
    if (!cloud.data.value) {
        return null;
    }

    return cloud.data.value.CKEditor.ClassicEditor;
});

const config = computed(() => {
    if (!cloud.data.value) {
        return null;
    }

    const { Essentials, Paragraph, Bold, Italic, Indent, IndentBlock,
        BlockQuote, Underline, Code, FontFamily, FontBackgroundColor, FontSize, FontColor
        , Heading, Link,List, Alignment, SpecialCharacters, SpecialCharactersEssentials, TodoList, Table, TableToolbar,
        WordCount,SelectAll  } = cloud.data.value.CKEditor;
    const { FormatPainter, CaseChange } = cloud.data.value.CKEditorPremiumFeatures;

    return {
        licenseKey: licenseKey,
        plugins: [
            Essentials, Alignment,
            Paragraph,
            Bold,
            Italic,
            Code, FontFamily, FontBackgroundColor, FontSize, FontColor,
            FormatPainter, Indent, IndentBlock, BlockQuote, Underline, Heading, CaseChange, Link, SpecialCharacters
            , SpecialCharactersEssentials, TodoList, Table, TableToolbar, WordCount, SelectAll,List

        ],
        toolbar: {
            items: [
                'undo', 'redo',
                '|',
                'heading',
                '|',
                'fontfamily', 'casechange', 'fontsize', 'fontColor', 'fontBackgroundColor',
                '|',
                'bold', 'italic', 'underline', 'code',
                '|',
                'link', 'blockQuote',
                '|',
                'alignment',
                '|',
                'bulletedList', 'numberedList', 'todoList', 'outdent', 'indent', '|',
                'formatPainter', 'specialCharacters', 'insertTable', 'selectAll'
            ],
            shouldNotGroupWhenFull: true
        }, wordCount: {
            onUpdate: stats => {
                console.log(`Characters: ${stats.characters}\nWords: ${stats.words}`);
            }
        }

    };
});
</script>
