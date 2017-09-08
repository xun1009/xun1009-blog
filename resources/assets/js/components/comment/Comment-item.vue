<template>
    <div>
        <div class="media">
            <a class="pull-left" href="#">
                <img class="media-object" data-src="holder.js/64x64" alt="64x64" src="http://ov4lo21mx.bkt.clouddn.com/avatars/xun1009a_1503475811zjabA.png" style="width: 64px; height: 64px;">
            </a>
            <div class="media-body">
                <a class="media-heading"><span>{{this.comment.name}}</span></a>
                <span>{{this.comment.created_at}}</span>
                <p>{{this.comment.content}}</p>
            </div>
        </div>
        <comment-form :comment="comment" :comments="comments"></comment-form>
        <div v-if="comments[comment.id]" >
            <div style="margin-left: 50px">
                <comment-list :listComments="comments[comment.id]" :comments="comments"></comment-list>
            </div>
        </div>
    </div>
</template>

<script>
    export default{
        props:{
            comment: {
                type: [Object,Array],
            },
            comments: {
                type: [Object,Array]
            }
        },

        data(){
            return {
                //imageUrl : '/images/avatar.pmg',
//                comment : [],
            }
        },
        mounted() {
            this.cssInit();
//            console.log(this.comment);
            //this.getComments();
        },
        computed:{
            replyForm() {
                return 'comment-replyForm-' + this.comment.id  //+ this.model
            },
            replyFormId() {
                return '#' + this.replyForm
            },
            replayButton() {
                return 'comment-replayButton-' + this.comment.id  //+ this.model
        },
            replayButtonId() {
                return '#' + this.replayButton
            },
        },
        methods:{
            displayReply(){
                $(this.replyFormId).css({display:'block'}),
                        $(this.replayButtonId).css({display:'none'}),
                        this.cssInit()
            },
            closeReply(){
                $(this.replyFormId).css({display:'none'}),
                        $(this.replayButtonId).css({display:'block'}),
                        this.cssInit()
            },
            cssInit(){
                $(this.replayButtonId).css({'margin-top': '10px'}),
                        $(this.replyFormId).css({'margin-top': '10px'})
            },
            submitComment(){
                console.log('submit comment')
            },
//            getComments() {
//                this.$http.get('/api/comment/25').then(response => {
//                    console.log(response.data)
//                    this.comments = response.data
//                    console.log(this.comments[1].content)
//                })
//            }
        }
    }
</script>