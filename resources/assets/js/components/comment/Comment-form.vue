<template>
    <div class="actions">
        <div :id="replyForm" style="display: none;">
            <div class="form-group">
                <textarea v-model="content" name="replayText" autofocus="autofocus" class="form-control" data-vv-scope="__global__" aria-required="true" aria-invalid="false"></textarea>
                <span :id="commentWarn" class="text-danger" style="display: none">评论不少于3个字符</span>
            </div>
            <button @click="submitComment" class="btn btn-success btn-sm">回复评论</button>
            <a @click="closeReply" class="btn btn-sm btn-link">取消</a>
        </div>
            <a :id="replayButton" @click="displayReply" style="display: block">回复</a>
    </div>

</template>

<script>
    export default{
        props:{
            comment:{
                type:[Array,Object]
            },
            comments:{
                type:[Array,Object]
            }

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
            commentWarn() {
                return 'comment-warn-' + this.comment.id  //+ this.model
            },
            commentWarnId() {
                return '#' + this.replayButton
            },
        },
        data(){
            return {
                user:{
                    name:Zhihu.name,
                    avatar:Zhihu.avatar,
                    id:Zhihu.id,
                },
                content:'',
                addComment: '',
            }
        },
        methods :{
            displayReply(){
                $(this.replyFormId).css({display:'block'}),
                        $(this.replayButtonId).css({display:'none'})
            },
            closeReply(){
                $(this.replyFormId).css({display:'none'}),
                        $(this.replayButtonId).css({display:'block'})
            },
            submitComment(){
                if(this.content.length < 3){
                    $(this.commentWarnId).css({display:'block'})
                    console.log(this.content)
                }else{
                    $(this.commentWarnId).css({display:'none'})
                    console.log(this.content)
                    this.storeComment();
                }
            },
            storeComment(){
                this.$http.post('/api/comment',{'article_id':this.comment.article_id,'user_id':this.user.id,'content':this.content,'parent_id':this.comment.id}).then(response => {
                    this.addComment = response.data
                    console.log(this.addComment)
                    //如果这个parent_id 以前没有,就会导致出问题
                    if(this.comments[this.comment.id] == null){
                        this.comments[this.comment.id] = []
                    }

                    this.comments[this.comment.id].push(this.addComment)
                    //this.comments['root'].push(this.addComment)
                    //console.log(this.comments)
                    //传送值回父组件
                    this.$emit('comments',this.comments)
                    this.content = ''
                    this.closeReply()
                })
            }
        }
    }
</script>