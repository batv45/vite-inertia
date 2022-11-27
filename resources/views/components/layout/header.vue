<script setup lang="ts">
import "@tabler/core/src/js/src/dropdown.js"
import {useMenu} from "@/scripts/menu";
import AppLogo from "@/views/components/app-logo.vue";
import UserInfo from "@/views/components/user-info.vue";

const headerMenu = useMenu(route).headerMenu
const userMenu = useMenu(route).userMenu

defineProps({
    containerType:{
        type: String,
        default: () => 'xl'
    }
})

</script>

<template>
    <!-- Navbar -->
    <header class="navbar navbar-expand-md navbar-light d-print-none">
        <div :class="'container-'+containerType">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-menu" aria-controls="navbar-menu" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <h1 class="navbar-brand navbar-brand-autodark d-none-navbar-horizontal pe-0 pe-md-3">
                <AppLogo size="small"></AppLogo>
            </h1>
            <div class="navbar-nav flex-row order-md-last">
                <div class="nav-item dropdown">
                    <a href="#" class="nav-link d-flex lh-1 text-reset p-0" data-bs-toggle="dropdown" aria-label="Open user menu">
                        <div class="d-none d-xl-block ps-2">
                            <UserInfo :avatar-size="34" :user="$page.props.user"></UserInfo>
                        </div>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                        <div v-for="menuser in userMenu">
                            <div class="dropdown-divider" v-if="menuser.divider"></div>
                            <component :is="menuser.action ? 'span' : 'Link'" :href="menuser.action ? undefined : (menuser.route ? route(menuser.route) : menuser.link)"
                                       :class="{'cursor-pointer': menuser.action,'active': menuser.route ? route().current(menuser.route) : false}"
                                       @click.prevent="menuser.action ? menuser.action() :  true;"
                                       class="dropdown-item dropdown-active">
                                <component :is="menuser.icon" class="dropdown-item-icon"/> {{ menuser.name }}
                            </component>
                        </div>
                    </div>
                </div>
            </div>
            <div class="collapse navbar-collapse" id="navbar-menu">
                <div class="d-flex flex-column flex-md-row flex-fill align-items-stretch align-items-md-center">
                    <ul class="navbar-nav">
                        <li class="nav-item"
                            :class="{'active': menu.route ? route().current(menu.route) : false}"
                            v-for="menu in headerMenu">
                            <Link class="nav-link" :href="menu.action ? undefined : (menu.route ? route(menu.route) : menu.link)" >
                                <span class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/home -->
                                  <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><polyline points="5 12 3 12 12 3 21 12 19 12" /><path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7" /><path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6" /></svg>
                                </span>
                                <span class="nav-link-title">
                                  {{menu.name}}
                                </span>
                            </Link>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </header>
</template>
