<script setup lang="ts">
import "@tabler/core/src/js/src/dropdown.js"
import {useMenu} from "@/scripts/menu";
import AppLogo from "@/views/components/app-logo.vue";
import UserInfo from "@/views/components/user-info.vue";

const headerMenu = useMenu().headerMenu
const userMenu = useMenu().userMenu

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
                            :class="{'active': menu.active === undefined ? (menu.route ? route().current(menu.route) : false) : menu.active,'dropdown': menu.child}"
                            v-for="menu in headerMenu">
                            <Link class="nav-link dropdown-toggle"
                                  :data-bs-toggle="menu.child?'dropdown':undefined" :data-bs-auto-close="menu.child?'outside':undefined" :aria-expanded="menu.child?'false':undefined"
                                  :href="menu.action ? undefined : (menu.route ? route(menu.route) : menu.link)" >
                                <span class="nav-link-icon d-md-none d-lg-inline-block" v-if="menu.icon">
                                    <component :is="menu.icon"></component>
                                </span>
                                <span class="nav-link-title">
                                  {{menu.name}}
                                </span>
                            </Link>
                            <div v-if="menu.child instanceof Array && menu.child.length" class="dropdown-menu">
                                <a class="dropdown-item" href="./docs/">
                                    Documentation
                                </a>
                                <Link v-for="child in menu.child"  class="dropdown-item"
                                      @click.prevent="child.action ? child.action() :  undefined;"
                                      :href="child.action ? undefined : (child.route ? route(child.route) : child.link)" >
                                    <span class="nav-link-icon d-md-none d-lg-inline-block" v-if="child.icon">
                                        <component :is="child.icon"></component>
                                    </span>
                                    <span class="nav-link-title">
                                  {{child.name}}
                                </span>
                                </Link>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </header>
</template>
