<template>
    <div class="template-container">
        <header class="site-header">
            <a href="#" class="brand-main">
                <img src="/reporthero-logo-01.png" id="logo-desk" alt="Laraspace Logo" class="hidden-sm-down">
            </a>

            <ul class="action-list">
                <li>
                    <router-link to="/campaigns">Reports</router-link>
                </li>
            </ul>
        </header>
        <transition name="fade" mode="out-in">
            <router-view></router-view>
        </transition>
    </div>
</template>

<style>
.brand-main img {
    height: 50px;
    margin-top: -10px;

}
</style>