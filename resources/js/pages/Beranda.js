import React from 'react'
import $ from 'jquery';


// Import Swiper React components
import { Swiper, SwiperSlide } from "swiper/react";


// import Swiper core and required modules
import SwiperCore, { Mousewheel, Pagination } from 'swiper/core';

// Components
import SectionIntro from "../components/SectionIntro";
import SectionBidang from "../components/SectionBidang";
import SectionPedomanInfo from "../components/SectionPedomanInfo";
import SectionTeaser from "../components/SectionTeaser";
import SectionTimeline from "../components/SectionTimeline";
import SectionFooter from "../components/SectionFooter";

// install Swiper modules
SwiperCore.use([Mousewheel,Pagination]);


const Beranda = (props) => {
     
    return (
        <>    
        <Swiper 
            direction={'vertical'} 
            slidesPerView={1}                 
            mousewheel={true} 
            pagination={{"clickable": true}}            
            onSlideChange={(e) => {
                props.sectionActive(e.realIndex)                 
                if(e.realIndex===1){
                    $('#bidang-text').addClass('aos-init').addClass('aos-animate')
                    $('#bidang-mst').addClass('aos-init').addClass('aos-animate')
                    $('#bidang-ish').addClass('aos-init').addClass('aos-animate')
                    $('#bidang-ftr').addClass('aos-init').addClass('aos-animate')
                }else if(e.realIndex===2){
                    $('#pedoman-text').addClass('aos-init').addClass('aos-animate')
                    $('#pedoman-hero').addClass('aos-init').addClass('aos-animate')
                    $('#pedoman-unduh').addClass('aos-init').addClass('aos-animate')
                    $('#informasi-text').addClass('aos-init').addClass('aos-animate')
                    $('#informasi-0').addClass('aos-init').addClass('aos-animate')
                    $('#informasi-1').addClass('aos-init').addClass('aos-animate')
                    $('#informasi-2').addClass('aos-init').addClass('aos-animate')
                    $('#informasi-link').addClass('aos-init').addClass('aos-animate')
                }else if(e.realIndex===3){                    
                    $('#hero-text').addClass('aos-init').addClass('aos-animate')
                    $('#hero-1').addClass('aos-init').addClass('aos-animate')
                    $('#hero-2').addClass('aos-init').addClass('aos-animate')
                    $('#hero-3').addClass('aos-init').addClass('aos-animate')
                    $('#teaser-vid').addClass('aos-init').addClass('aos-animate')
                }else if(e.realIndex===4){
                    $('#timeline').addClass('aos-init').addClass('aos-animate')
                }else if(e.realIndex===5){
                    $('#footer-bg').addClass('aos-init').addClass('aos-animate')
                    $('#footer').addClass('aos-init').addClass('aos-animate')
                }                                
            }}                         
            className="mySwiper">
                <SwiperSlide>
                    <SectionIntro />                        
                </SwiperSlide>
                <SwiperSlide>
                    <SectionBidang />
                </SwiperSlide>
                <SwiperSlide>
                    <SectionPedomanInfo />
                </SwiperSlide>
                <SwiperSlide>
                    <SectionTeaser />
                </SwiperSlide>
                <SwiperSlide>
                    <SectionTimeline />    
                </SwiperSlide>  
                <SwiperSlide>
                    <SectionFooter />    
                </SwiperSlide>       
        </Swiper>
        </>
    )
}

export default Beranda