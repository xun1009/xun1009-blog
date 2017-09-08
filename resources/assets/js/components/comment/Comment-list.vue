<template>
    <div >
        <div v-for="comment in listComments">
            <comment-item :comment="comment" :comments="comments"></comment-item>
        </div>
    </div>
</template>

<script>
    export default{
        props:{
            listComments: {
                type: [Object,Array],
            },
            comments: {
                type: [Object,Array]
            }
        }
    }
</script>