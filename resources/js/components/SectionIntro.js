import React from 'react'
import { Link } from 'react-router-dom'



const SectionIntro = () => {
    return (
        <section className="intro">
            <div className="container h-100">
                <div className="row h-100">
                    <div className="col-lg-6 align-self-center" id="intro-text" data-aos="zoom-in-up">
                        <h1>SELAMAT DATANG DI <br/> DUNIA PENELITIAN REMAJA</h1>
                        <Link to="/login" className="btn-masuk"> Masuk </Link>
                        <Link to="/login" className="btn-daftar"> Daftar</Link>
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
