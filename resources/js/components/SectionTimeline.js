import React from 'react'
import { Swiper, SwiperSlide } from "swiper/react";
import SwiperCore, { Pagination } from 'swiper/core';
  
// use Swiper modules
SwiperCore.use([Pagination]);

// import style timeline
import '../../css/SectionTimeline.css'


const SectionTimeline = () => {
    return (
        <>
        <section className="timeline">            
            <div className="container h-100">
                <div className="row h-100">
                    <div className="col-lg-12 align-self-center" id="timeline" data-aos="zoom-in-up" data-aos-delay="350">
                        <div className="row">
                            <div className="col-lg-4 mx-auto"> 
                                <h3 className="title-section3">TIMELINE KoPSi 2021</h3>   
                            </div>
                        </div>        
                        <div className="row">
                            <div className="col-lg-12 ">                                                         
                                <Swiper 
                                    slidesPerView={'1'}
                                    centeredSlides={false} 
                                    grabCursor={true} 
                                    pagination={{"clickable": true}} 
                                    breakpoints={{
                                        "640": {
                                          "slidesPerView": 1,                                          
                                        },
                                        "768": {
                                          "slidesPerView": 2,                                      
                                        },
                                        "1024": {
                                          "slidesPerView": 4,                                          
                                        }}}
                                    className="tl">
                                    
                                    <SwiperSlide>
                                        <div className="tl-up">
                                            <div className="content">
                                                <h4>Time</h4>
                                                <p>lorem ipsum dolor siit amet dulur e dewe loem si
                                                
                                                </p>
                                            </div>
                                        </div>
                                    </SwiperSlide>
                                    <SwiperSlide>
                                        <div className="tl-down">
                                            <div className="content">
                                                <h4>Time</h4>
                                                <p>lorem ipsum dolor siit amet dulur e dewe loem si</p>
                                            </div>
                                        </div>
                                    </SwiperSlide>
                                    <SwiperSlide>
                                        <div className="tl-up">
                                            <div className="content">
                                                <h4>Time</h4>
                                                <p>lorem ipsum dolor siit amet dulur e dewe loem si
                                                lorem ipsum dolor siit amet dulur e dewe loem si
                                                lorem ipsum dolor siit amet dulur e dewe loem si                                                
                                                </p>
                                            </div>
                                        </div>
                                    </SwiperSlide>
                                    <SwiperSlide>
                                        <div className="tl-down">
                                            <div className="content">
                                                <h4>Time</h4>
                                                <p>lorem ipsum dolor siit amet dulur e dewe loem si</p>
                                            </div>
                                        </div>
                                    </SwiperSlide>
                                    <SwiperSlide>
                                        <div className="tl-up">
                                            <div className="content">
                                                <h4>Time</h4>
                                                <p>lorem ipsum dolor siit amet dulur e dewe loem si
                                                lorem ipsum dolor siit amet dulur e dewe loem si
                                                lorem ipsum dolor siit amet dulur e dewe loem si                                                
                                                </p>
                                            </div>
                                        </div>
                                    </SwiperSlide>
                                    <SwiperSlide>
                                        <div className="tl-down">
                                            <div className="content">
                                                <h4>Time</h4>
                                                <p>lorem ipsum dolor siit amet dulur e dewe loem si</p>
                                            </div>
                                        </div>
                                    </SwiperSlide>
                                                                      
                                </Swiper>
                                
                            </div>
                        </div>  
                                                                    
                    </div>                                       
                </div>
            </div>            
        </section>
        
        </>
    )
}

export default SectionTimeline
