<template>
    <div>
        <comment-list :listComments="comments['root']"  :comments="comments"></comment-list>

        <div class="actions">
            <div :id="replyForm">
                <div class="form-group">
                    <textarea v-model="content" name="replayText" autofocus="autofocus" class="form-control" data-vv-scope="__global__" aria-required="true" aria-invalid="false"></textarea>
                    <span id="comment-warn" class="text-danger" style="display: none">评论不少于3个字符</span>
                </div>
                <button @click="submitComment" class="btn btn-success btn-sm">回复评论</button>
            </div>
        </div>
    </div>
</template>

<script>
    export default{
        props: ['article_id'],
        data() {
            return {
                comments: [],
                content: '',
                comment: '',
                user:{
                    name:Zhihu.name,
                    avatar:Zhihu.avatar,
                    id:Zhihu.id
                }
            }
        },
        computed:{
            replyForm() {
                return 'comment-replyForm' //+ this.model
            },
            replyFormId() {
                return '#' + this.replyForm
            },
            replayButton() {
                return 'comment-replayButton'
            },
            replayButtonId() {
                return '#' + this.replayButton
            },
        },
        mounted(){
            this.getComments();
        },
        methods:{
            getComments() {
                this.$http.get('/api/comment/' + this.article_id).then(response => {
                    this.comments = response.data
                    console.log(response.data)

                })
            },
            submitComment(){
                if(this.content.length < 3){
                    $('#comment-warn').css({display:'block'})
                }else{
                    $('#comment-warn').css({display:'none'})
                    console.log(this.content)
                    this.storeComment();
                }
            },
            storeComment(){
                this.$http.post('/api/comment',{'article_id':this.article_id,'user_id':this.user.id,'content':this.content}).then(response => {
                    this.comment = response.data
                    if(this.comments['root'] == null){
                        this.comments['root'] = []
                    }
                    this.comments['root'].push(this.comment)
                    this.content = ''
                })
            }
        }
    }
</script>
