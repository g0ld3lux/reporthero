<template>
    <div class="login-wrapper">
        <div class="login-box">
            <div class="brand-main">
                <a href="/"><img src="/reporthero-logo-01.png" alt="Report Hero Logo"></a>
            </div>
            <router-view></router-view>
            <div class="page-copyright">
                <p>All Right Reserve <a href="/" target="_blank">Report Hero</a></p>
                <p>Copyright © 2017</p>
            </div>
        </div>
    </div>
</template>

<script>

    export default {
        methods: {
            setLayoutClasses(){
                let body = $('body');
                body.removeClass();
                body.addClass('login-page')
            },
        },
        mounted() {
            this.setLayoutClasses()
        },
        destroyed(){
            $('body').removeClass('login-page')
        }
    }
</script>

<style>
.brand-main img {
    height: 50px;
    margin-top: -10px;

}
</style>