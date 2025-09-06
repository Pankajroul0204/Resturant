<template>
    <swiper :slides-per-view="3" :space-between="30" :free-mode="true" :pagination="{ clickable: true }"
        :autoplay="{ delay: 3000 }" :loop="true" :modules="modules" class="mySwiper">
        <swiper-slide v-for="item in data" :key="item">
            <div  class="testimonial-item">
                <div class="stars">
                    <i class="bi bi-star-fill" v-for="n in 5" :key="n"></i>
                </div>
                <p>
                    {{item.name}}
                </p>
                <div class="profile mt-auto">
                    <img :src="item.image_url" class="testimonial-img" alt="" />
                    <h4>{{item.designation}}</h4>
                    <h3>{{item.message}}</h3>
                </div>
            </div>
        </swiper-slide>

        <swiper-slide>Slide 2</swiper-slide>
        <swiper-slide>Slide 3</swiper-slide>
        <swiper-slide>Slide 4</swiper-slide>
        <swiper-slide>Slide 5</swiper-slide>
    </swiper>
</template>

<script setup>
import { Swiper, SwiperSlide } from 'swiper/vue'

import '/public/css/swiper.css'
import 'swiper/css/free-mode'
import 'swiper/css/pagination'

import { Autoplay, FreeMode, Pagination } from 'swiper/modules'

const modules = [Autoplay, FreeMode, Pagination]

const props = defineProps({
    data: Object
})
</script>
