import React, { Component } from 'react'

// Style
import '../../sass/bidang.scss';

export default class Bidang extends Component {
    constructor(props){
        super(props)
        this.props.sectionActive(1)
    }
    render() {
        return (            
            <>
            <div className="bidang-detail">                
                <div className="container-fluid">
                    <div className="row">
                        <div className="col-lg-4" data-aos="fade-right">
                            <h2 className="title-section">BIDANG LOMBA</h2>
                        </div>
                    </div>
                    <div className="row">
                        <div className="col-lg-12 p-0" data-aos="fade-left">
                            <div className="card-bidang mst-b">   
                                <img src="/assets/images/mst-bidang.png" alt="" className="d-none d-lg-block d-xl-block"/> 
                                <div className="text">                                    
                                    <h5>Matematika, Sains, dan Teknologi</h5>
                                    <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl</p>
                                    <img src="/assets/images/mst-hero.png" alt="" className="d-block d-lg-none d-xl-none"/> 
                                </div>                                                                    
                            </div>                            
                        </div>
                    </div>
                    <div className="row">
                        <div className="col-lg-12 p-0 " data-aos="fade-right">
                            <div className="card-bidang ftr-b">   
                                <img src="/assets/images/ftr-bidang.png" alt="" className="d-none d-lg-block d-xl-block"/> 
                                <div className="text">
                                    <h5>Matematika, Sains, dan Teknologi</h5>
                                    <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl</p>
                                    <img src="/assets/images/ftr-hero.png" alt="" className="d-block d-lg-none d-xl-none"/> 
                                </div>                                                                    
                            </div>                            
                        </div>
                    </div>
                    <div className="row">
                        <div className="col-lg-12 p-0" data-aos="fade-left">
                            <div className="card-bidang ish-b">   
                                <img src="/assets/images/ish-bidang.png" alt="" className="d-none d-lg-block d-xl-block"/> 
                                <div className="text">
                                    <h5>Matematika, Sains, dan Teknologi</h5>
                                    <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl</p>
                                    <img src="/assets/images/ish-hero.png" alt="" className="d-block d-lg-none d-xl-none"/> 
                                </div>                                                                    
                            </div>                            
                        </div>
                    </div>
                    <div className="row" data-aos="zoom-in-up">
                        <div className="col-lg-4 mx-auto mb-5">
                            <h2 className="title-section mt-5">PENGHARGAAN</h2>
                        </div>
                    </div>
                    <div className="row" data-aos="zoom-in-up">
                        <div className="col-md-6 col-lg-3 mb-5">
                            <div className="medali gold">
                                <img src="/assets/images/prize-gold.png" alt=""/>
                                <h4>Medali Emas</h4>
                            </div>
                        </div>
                        <div className="col-md-6 col-lg-3 mb-5">
                            <div className="medali silver">
                                <img src="/assets/images/prize-silver.png" alt=""/>
                                <h4>Medali Perak</h4>
                            </div>
                        </div>
                        <div className="col-md-6 col-lg-3 mb-5">
                            <div className="medali bronze">
                                <img src="/assets/images/prize-bronze.png" alt=""/>
                                <h4>Medali Perunggu</h4>
                            </div>
                        </div>
                        <div className="col-md-6 col-lg-3 mb-5">
                            <div className="medali etc">
                                <img src="/assets/images/prize-etc.png" alt=""/>
                                <h4>Penghargaan Khusus</h4>
                            </div>
                        </div>
                    </div>                    
                </div>                                               
            </div>
            <div className="footer2">
                <div className="container">
                    <div className="row">
                        <div className="col-lg-6 mx-auto mb-2 d-flex">
                            <img src="/assets/images/logo-puspresnas.png" alt="" className="footer2-p-img"/>
                            <img src="/assets/images/logo2.png" alt="" className="footer2-k-img"/>                            
                        </div>                        
                    </div>
                    <div className="row">
                        <div className="col-lg-4 mx-auto">
                            <div className="sosmed">
                                <a href="/" className="fb"><i className="fab fa-facebook-f"></i></a>
                                <a href="/" className="fb"><i className="fab fa-instagram"></i></a>
                                <a href="/" className="fb"><i className="fab fa-youtube"></i></a>
                                <a href="/" className="fb"><i className="fab fa-twitter"></i></a>
                                <a href="/" className="fb"><i className="fas fa-phone-alt"></i></a>
                            </div>
                            
                        </div>
                    </div>   
                    <div className="row">
                        <div className="col-lg-9 mx-auto text-white text-center">
                            <b>&copy; Pusat Prestasi Nasional</b>
                            <p>Sekretariat Jenderal Kementerian Pendidikan dan Kebudayaan <br /> Komplek Kementerian Pendidikan dan Kebudayaan, Gedung C, Lantai 19 Jl. Jend Sudirman, Senayan, Jakarta, 10270</p>
                        </div>
                    </div>                 
                </div>
            </div>
            </>
        )
    }
}

