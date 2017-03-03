<template>


<div class="tabs tabs-default">
    <ul class="nav nav-tabs" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" data-toggle="tab" href="#home" role="tab" @click="setToActive('topseller')">Top Selling Product</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#profile" role="tab" @click="setToActive('productlist')">Product List</a>
        </li>
    </ul>
    <!-- Tab panes -->
    <div class="tab-content">
        <div class="tab-pane tabs-primary" :class="{ 'active': isTopSeller}"   id="topseller" role="tabpanel">
            <top-seller></top-seller>
        </div>
        <div class="tab-pane abs-primary" :class="{ 'active': isProductList}"   id="productlist" role="tabpanel">
            <product-ordered-lists></product-ordered-lists>
        </div>
    </div>
</div>
</template>

<script>
import topSeller from './TopSeller.vue'
import productOrderedLists from './ProductOrderedLists.vue'
export default {
    data() {
        return {
            isTopSeller: true,
            isProductList: false
        }
    },
    components: {
        topSeller,
        productOrderedLists
    },
    methods: {
        setToActive(id) {
            if(id == 'topseller'){
                this.isTopSeller = true
                this.isProductList = false
            }else if(id == 'productlist') {
                this.isTopSeller = false
                this.isProductList = true
            }
        },

    },
    
}

</script>

<style>
.tab-pane {
    margin-top: -20px;
    padding-top: 0px;;
    padding-left: 5px;
    padding-right: 5px;
    padding-bottom: 5px;
    border-style: solid;
    border-color: lightslategrey;
    border-radius: 10px;
}
</style>