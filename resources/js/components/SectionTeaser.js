import React from 'react'

const SectionTeaser = () => {
    return (
        <section className="teaser">
            <img src="/assets/images/sky-teaser.png" className="sky" alt=""  />
            <img src="/assets/images/hero-text.png" className="text" alt="" id="hero-text" data-aos="fade-right" data-aos-delay="300"/>
            <img src="/assets/images/hero-mst.png" className="hero1" alt="" id="hero-1" data-aos="fade-right" data-aos-delay="300"/>
            <img src="/assets/images/hero-ftr.png" className="hero2" alt="" id="hero-2" data-aos="fade-left" data-aos-delay="300"/>            
            <img src="/assets/images/hero-ish.png" className="hero3" alt="" id="hero-3" data-aos="fade-left" data-aos-delay="300"/>
            
            <div className="container h-100">
                <div className="row h-100">
                    <div className="col-lg-12 align-self-center" id="teaser-vid" data-aos="zoom-in-up" data-aos-delay="350">        
                        <div className="col-lg-4 mx-auto"> 
                            <h3 className="title-section3">TEASER KoPSi 2021</h3>   
                        </div>
                        <div className="col-lg-8 mx-auto">
                            <iframe src="https://www.youtube.com/embed/nfVsYJCJW5A" title="YouTube video player" frameBorder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowFullScreen></iframe>
                        </div>                                                             
                    </div>                                       
                </div>
            </div>
            
        </section>
    )
}

export default SectionTeaser
