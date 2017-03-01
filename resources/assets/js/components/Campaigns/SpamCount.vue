<template>
<div class="col-md-12 col-lg-6 col-xl-6">
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
                    return 'Mark as Spam'; 
                }
            },
            icon: {
                type: String,
                default() { 
                    return 'fa fa-exclamation-triangle'; 
                }
            },
            color: {
                type: String,
                default() { 
                    return 'text-danger'; 
                }
            },
            campaignName: {
                type: String
            }
            

        },
        data() {
            return {
                metricID: 'yq4vyv',
                fetchData: [],
                count: 0,
            }
        },
        mounted() {
            this.getData()
        },
        methods: {
            getData() {
            axios.get('/api/v1/metric/' + this.metricID + '/export', {

            params: {
                
                measurement: 'count',
                where: JSON.stringify([["$message", "=" , this.$route.params.id]])
            }
            }).then(({data}) => this.fetchData = data.results[0].data);
            },
        },
        computed: {
            total() {
            for(let data of this.fetchData)
            {
                this.count += parseInt(data.values[0]);
            }
            return this.count;
            }
        },

}
</script>