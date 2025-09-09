<script setup>
import { ref } from "vue";
import { Head, Link, usePage, router } from "@inertiajs/vue3";
import NavLink from "@/Components/NavLink.vue";
import ApplicationMark from '@/Components/ApplicationMark.vue';
import Dropdown from '@/Components/Dropdown.vue';

defineProps({
    title: String,
    pageName: String
});

const open = ref(false);
const customerDropdown = ref(false);
const toggleCustomerDropdown = () => {
    customerDropdown.value = !customerDropdown.value;
}
const sidebarOpen = ref(false);
const toggleSidebar = () => {
    sidebarOpen.value = !sidebarOpen.value;
};
const toggleDropdown = () => {
    open.value = !open.value;
};
</script>

<template>

    <Head :title="title" />
    <div class="flex h-screen bg-gray-100" @click="sidebarOpen = false">
        <!-- Sidebar -->
        <aside @click.stop :class="[
            'fixed inset-y-0 left-0 transform w-64 bg-white shadow-lg transition-transform z-40 flex flex-col',
            sidebarOpen ? 'translate-x-0' : '-translate-x-full',
            'md:translate-x-0'
        ]">
            <div class="shrink-0 flex items-center">
                <Link :href="route('dashboard')">
                <ApplicationMark class="block h-9 w-auto" />
                </Link>
                <div class="p-4 text-xl font-bold border-b">My App</div>
            </div>

            <!-- Navigation -->
            <nav class="p-4 flex flex-col space-y-2 flex-1">
                <NavLink :href="route('dashboard')" :active="route().current('dashboard')"
                    class="block w-full rounded-lg px-3 py-2 text-gray-700 hover:bg-gray-200">
                    Dashboard
                </NavLink>
                <!-- <NavLink :href="route('admin.heroPage')" :active="route().current('admin.heroPage')"
                    class="block w-full rounded-lg px-3 py-2 text-gray-700 hover:bg-gray-200">
                    Hero
                </NavLink> -->
                <Dropdown align="right" width="full">
                    <template #trigger>
                        <button
                            class="flex items-center justify-between w-full px-3 py-2 rounded-lg text-gray-700 hover:bg-gray-200 focus:outline-none">
                            <span>Testimonials</span>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>
                    </template>
                    <template #content>
                        <div class="w-full">
                            <Link :href="route('admin.testimonials')"  class="block w-full px-4 py-2 text-gray-700 hover:bg-gray-100">
                            Add Testimonials
                            </Link>
                            <Link :href="route('admin.testimonials_list')" class="block w-full px-4 py-2 text-gray-700 hover:bg-gray-100">
                            Testimonial List
                            </Link>
                        </div>
                    </template>
                </Dropdown>
                <Dropdown align="right" width="full">
                    <template #trigger>
                        <button
                            class="flex items-center justify-between w-full px-3 py-2 rounded-lg text-gray-700 hover:bg-gray-200 focus:outline-none">
                            <span>Hero</span>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>
                    </template>
                    <template #content>
                        <div class="w-full">
                            <Link :href="route('admin.heroPage')"  class="block w-full px-4 py-2 text-gray-700 hover:bg-gray-100">
                            Add Hero
                            </Link>
                            <Link :href="route('admin.HeroList')" class="block w-full px-4 py-2 text-gray-700 hover:bg-gray-100">
                            Hero List
                            </Link>
                        </div>
                    </template>
                </Dropdown>
                <Dropdown align="right" width="full">
                    <template #trigger>
                        <button
                            class="flex items-center justify-between w-full px-3 py-2 rounded-lg text-gray-700 hover:bg-gray-200 focus:outline-none">
                            <span>Menu</span>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>
                    </template>
                    <template #content>
                        <div class="w-full">
                            <Link :href="route('menu.create')"  class="block w-full px-4 py-2 text-gray-700 hover:bg-gray-100">
                            Add Menu
                            </Link>
                            <Link :href="route('admin.menulist')" class="block w-full px-4 py-2 text-gray-700 hover:bg-gray-100">
                            Menu List
                            </Link>
                        </div>
                    </template>
                </Dropdown>
                <NavLink :href="route('admin.intouch_list')" :active="route().current('admin.intouch_list')"
                    class="block w-full rounded-lg px-3 py-2 text-gray-700 hover:bg-gray-200">
                    Customer In Touch
                </NavLink>
                <NavLink :href="route('frontend.booking_request_list')" :active="route().current('frontend.booking_request_list')"
                    class="block w-full rounded-lg px-3 py-2 text-gray-700 hover:bg-gray-200">
                    Booking Requests
                </NavLink>

            </nav>

            <!-- Settings Dropdown -->
            <div class="p-4 border-t bg-white">
                <div class="relative">
                    <button @click="toggleDropdown"
                        class="block w-full text-left rounded-lg px-3 py-2 text-gray-700 hover:bg-gray-200 flex items-center justify-between">
                        <img class="size-8 rounded-full object-cover" :src="$page.props.auth.user.profile_photo_url"
                            :alt="$page.props.auth.user.name" />
                        <span class="ml-2 flex-1">{{ $page.props.auth.user.name }}</span>
                        <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div v-if="open" class="absolute left-0 bottom-full mb-2 w-40 bg-white rounded-lg shadow-lg z-50">
                        <Link :href="route('profile.show')" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">
                        Profile</Link>
                        <Link href="/logout" class="block px-4 py-2 text-red-600 hover:bg-gray-100">
                        Logout
                        </Link>
                    </div>
                </div>
            </div>
        </aside>

        <!-- Main content wrapper (pushed right on desktop) -->
        <div class="flex-1 flex flex-col transition-all md:ml-64">

            <!-- Top bar -->
            <header class="flex items-center bg-white shadow px-4 h-14">
                <!-- Toggle button (mobile only) -->
                <button @click.stop="toggleSidebar" class="md:hidden p-2 text-gray-600 hover:bg-gray-200 rounded-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
                <h1 class="ml-4 text-lg font-semibold truncate">{{ pageName == null ? 'Dashboard' : pageName }}</h1>
            </header>

            <!-- Page content -->
            <main class="flex-1 p-6 overflow-y-auto">
                <slot />
            </main>
        </div>
    </div>
</template>
