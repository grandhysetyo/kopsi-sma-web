import React from 'react'
import { Swiper, SwiperSlide } from "swiper/react";
import SwiperCore, { Pagination } from 'swiper/core';
import axios from 'axios'
import request_api from '../api/request_api'
  
// use Swiper modules
SwiperCore.use([Pagination]);

// import style timeline
import '../../css/SectionTimeline.css'


import { Component } from 'react'

export class SectionTimeline extends Component {
    constructor(props) {
        super(props)
    
        this.state = {
             timeline: [],             
        }
    }
    getDataTimeline = ()=>{
        axios.get(request_api.fetchTimeline)
        .then((res)=> {
            this.setState({
                timeline: res.data
            })                                                       
        })
        .catch(function (error) {
            // handle error
            console.log(error);
        })
    }
    componentDidMount() {
        this.getDataTimeline()
    }
    render() {
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
                                            { this.state.timeline.map((data,idx) =>                                                                            
                                                <SwiperSlide key={data.id}>
                                                    <div className={idx%2==0 ? 'tl-up' : 'tl-down'}>
                                                        <div className="content">
                                                            <h4 className="titleTimeline">{data.title}</h4>                                                            
                                                            {data.tanggal.map((res)=>
                                                                <span key={res.id} className="txt-date d-block">{res.title} | {res.tanggal}</span>
                                                            )}
                                                            
                                                        </div>
                                                    </div>
                                                </SwiperSlide>                                                                           
                                            )}                                                                         
                                                                            
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
}

export default SectionTimeline
