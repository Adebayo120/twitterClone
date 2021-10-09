<template>
    <a :href="`/hashtag/${body}`">{{ body }}</a>
</template>
<script>
export default {
    props : {
        body : {
            required : true,
            type : String
        }
    }
}
</script>