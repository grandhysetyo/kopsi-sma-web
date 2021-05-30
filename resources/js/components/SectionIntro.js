import React from 'react'

const SectionIntro = () => {
    
    return (
        
        <section className="intro">            
            <div className="container h-100">
                <div className="row h-100">
                    <div className="col-lg-6 align-self-center" id="intro-text" data-aos="zoom-in-up">
                        <h1>SELAMAT DATANG DI <br/> DUNIA PENELITIAN REMAJA</h1>
                        <a href="/login" className="btn-masuk"> Masuk </a>                        
                        <div className="dropdown" style={{display: 'inline-block'}}>
                            <button className="btn btn-daftar dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Daftar
                            </button>
                            <div className="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <a className="dropdown-item" href="/leader-register">Ketua</a>
                                <a className="dropdown-item" href="/member-register">Anggota</a>                                
                            </div>
                        </div>
                    </div>
                    <div className="col-lg-6 align-self-center" id="intro-hero"  data-aos="zoom-in-up"> 
                        <img src="/assets/images/hero-intro.png" className="hero" alt="" /> 
                    </div>
                </div>
            </div>
        </section>
        
    )
}

export default SectionIntro
