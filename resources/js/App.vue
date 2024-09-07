<script setup>
const props = defineProps({
    isAuth: {
        type: Boolean,
        default: false
    },
    user: {
        type: [Object, Array],
        required: false
    }
})
</script>
<template>
    <h1>Hello, {{ user.name }}</h1>
</template>
