<template>
    <ckeditor
        v-model="data"
        :editor="ClassicEditor"
        :config="config"
        tag-name="textarea"
    />
</template>

<script setup>
import { ref, computed } from 'vue';
import { ClassicEditor,Essentials, Paragraph, Bold, Italic, Indent, IndentBlock,
        BlockQuote, Underline, Code, FontFamily, FontBackgroundColor, FontSize, FontColor
        , Heading, Link,List, Alignment, SpecialCharacters, SpecialCharactersEssentials, TodoList, Table, TableToolbar,
        WordCount,SelectAll } from 'ckeditor5';
import { Ckeditor } from '@ckeditor/ckeditor5-vue';

import 'ckeditor5/ckeditor5.css';
const data = ref( '<p>Hello world!</p>' );

const config = computed( () => {
    return {
        licenseKey: 'GPL',
        plugins: [ Essentials, Paragraph, Bold, Italic, Indent, IndentBlock,
            BlockQuote, Underline, Code, FontFamily, FontBackgroundColor, FontSize, FontColor
            , Heading, Link,List, Alignment, SpecialCharacters, SpecialCharactersEssentials, TodoList, Table, TableToolbar,
            WordCount,SelectAll ],
        toolbar: [ 'undo', 'redo', '|', 'bold', 'italic', 'underline', 'code', '|', 'link', 'blockQuote', '|',
            'heading', '|', 'fontfamily', 'fontsize', 'fontColor', 'fontBackgroundColor', '|',
            'outdent', 'indent', '|', 'specialCharacters', 'todoList', 'numberedList', 'bulletedList', '|',
            'insertTable', 'selectAll' ],
        menubar : {
            isVisible: true
        }
    };
} );
</script>
