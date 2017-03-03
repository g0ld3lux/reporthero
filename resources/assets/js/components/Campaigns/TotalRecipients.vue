<template>
<div class="col-md-12 col-lg-6 col-xl-3">
    <a class="dashbox" href="#">
        <i :class="[icon, color]"></i>
        <span class="title">
            {{ total }}
        </span>
        <span class="desc" style="font-size: 12px; text-align: right;">
            {{ name }}
        </span>
        <slot>
            
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
                    return 'No. of Recipients'; 
                }
            },
            icon: {
                type: String,
                default() { 
                    return 'fa fa-users'; 
                }
            },
            color: {
                type: String,
                default() { 
                    return 'text-success'; 
                }
            },
            total: {
                type: Number,
                default() {
                    return 0
                }
            }
            

        },
        
        
       
        // watch: {
        // campaignName: 'getData'
        // }
       
}
</script>