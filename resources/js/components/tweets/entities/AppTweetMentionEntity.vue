<template>
    <a :href="`/user/${body}`">{{ body }}</a>
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