import React from 'react'
import { Link } from 'react-router-dom'

const SectionBidang = () => {
    return (
        <section className="bidang">
            <div className="container h-100">
                <div className="row h-100">
                    <div className="col-lg-12 align-self-center">
                        <div className="row">
                            <div className="col-lg-4 mx-auto" id="bidang-text" data-aos="zoom-in-up" data-aos-delay="300">
                                <h3 className="title-section">BIDANG LOMBA</h3>
                            </div>
                        </div>                        
                        <div className="row" >
                            <div className="col-sm-4 col-md-4 col-lg-4" id="bidang-mst" data-aos="zoom-in-up" data-aos-delay="400">
                                <img src="/assets/images/mst.png" alt="" />
                                <Link to="/bidang" className="btn-bidang mst">Matematika, Sains, dan Teknologi</Link>
                            </div>
                            <div className="col-sm-4 col-md-4 col-lg-4" id="bidang-ftr" data-aos="zoom-in-up" data-aos-delay="500">
                                <img src="/assets/images/ftr.png" alt="" />
                                <Link to="/bidang" className="btn-bidang ftr">Fisika Terapan dan Rekayasa</Link>
                            </div>
                            <div className="col-sm-4 col-md-4 col-lg-4" id="bidang-ish" data-aos="zoom-in-up" data-aos-delay="600">
                                <img src="/assets/images/ish.png" alt="" />
                                <Link to="/bidang" className="btn-bidang ish">Ilmu Sosial dan Humaniora</Link>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
        </section>
    )
}

export default SectionBidang
