import React from 'react'

const SectionFooter = () => {
    return (
        <section className="footer">      
            <img src="/assets/images/loop-footer.png" className="loop" alt="" id="footer-bg" data-aos="zoom-in-up" data-aos-delay="350"/>      
            <div className="container h-100">
                <div className="row h-100">
                    <div className="col-lg-12 align-self-center" id="footer" data-aos="zoom-in-up" data-aos-delay="450">                                
                        <div className="col-lg-6 mx-auto text-center">
                            <img src="/assets/images/logo-puspresnas2.png" alt="" className="logo" />
                        </div> 
                        <div className="col-lg-6 mx-auto text-center"> 
                            <p className="alamat">Komplek Kementrian Pendidikan dan Kebudayaan, <br />Gedung C, Lantai 19 Jl. Jendral Sudirman, Senayan, Jakarta - 10270</p>
                            <hr></hr>
                        </div>
                        <div className="col-lg-6 mx-auto text-center">
                            <a href="/" className="fb-tw">
                                <i className="fab fa-facebook-square"></i> <i className="fab fa-twitter"></i> Puspresnas
                            </a>
                            <a href="/" className="yt">
                                <i className="fab fa-youtube"></i> Pusat Prestasi Nasional
                            </a>
                            <a href="/" className="yt">
                                <i className="fab fa-instagram"></i> @Puspresnas
                            </a>
                        </div>                                                             
                    </div>                                       
                </div>
            </div>
            
        </section>
    )
}

export default SectionFooter
