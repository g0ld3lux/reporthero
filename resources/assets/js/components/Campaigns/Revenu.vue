<template>
<div class="col-md-12 col-lg-6 col-xl-3">
    <a class="dashbox" href="#">
        <i :class="[icon, color]"></i>
        <span class="title">
            {{ total }}
        </span>
        <span class="desc">
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
                    return 'Revenue'; 
                }
            },
            icon: {
                type: String,
                default() { 
                    return 'fa fa-money'; 
                }
            },
            color: {
                type: String,
                default() { 
                    return 'text-warning'; 
                }
            }
            

        },
        data() {
            return {
                metricID: 'vFvk9B',
                fetchData: [],
                count: 0,
            }
        },
        mounted() {
           this.getData();
        },
        methods: {
            getData() {
            axios.get('/api/v1/metric/' + this.metricID + '/export', {
            params: {
                measurement: 'value',
                where: JSON.stringify([["$attributed_message","=", this.$route.params.id]])
            }
            }).then(({data}) => this.fetchData = data.results[0].data);
            },
        },
        computed: {
            total() {
            for(let data of this.fetchData)
            {
                this.count += parseFloat(data.values[0]);
            }
            return (Math.round(this.count * 10) / 10).toFixed(2);
            }
        }
}
</script>