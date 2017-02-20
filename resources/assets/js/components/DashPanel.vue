<template>
    <div class="dash-panel col-md-12 col-lg-6 col-xl-3">
        <a class="dashbox dashbox-line-progress" href="#">
            <i :class="{icon ,color}"></i>
            <span class="desc">
                {{ name }}
            </span>
            <span :class="{title,color}">
                {{ value }}
            </span>
            <slot>
            <div class="progress">
                <div class="progress-bar" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
            </slot>
        </a>
    </div>
</template>

<script>

    export default {

        props: {
            name: {
                type: String,
                default() { 
                    return 'Panel'; 
                }
            },
            value: {
                type: String,
                default() { 
                    return '0'; 
                }
            },
            icon: {
                type: String,
                default() { 
                    return 'fa-tags'; 
                }
            },
            color: {
                type: String,
                default() { 
                    return 'text-primary'; 
                }
            }
            

        },

        mounted: function () {
            // Do Something when Mounted
            // do some methods
        },
        methods: {
            // accept function
        },
        components : {
            // import a component
        },
        computed: {
            // accept function
        }
    }
</script>

<style>
.dash-panel {
    
}
</style>
