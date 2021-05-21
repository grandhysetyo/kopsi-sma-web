import React from 'react'
import { Link } from "react-router-dom";
const Navbar = (props) => {
    const dark = props.isDark    
    const Logo = (dark)=>{
        if(dark){
            return <img src="/assets/images/logo2.png" className="logo" alt="logo light" />
        }else{
            return <img src="/assets/images/logo.png" className="logo" alt="logo dark" />
        }
    }
    return (
        <>
            <nav className={dark ? 'navbar navbar-expand-lg navbar-dark' : 'navbar navbar-expand-lg navbar-light' }>
                <div className="container">
                <a className="navbar-brand" href="/">
                    {Logo(dark)}                    
                </a>
                <div className={dark ? 'navbar-brand-txt text-white d-none d-lg-block d-xl-block' : 'navbar-brand-txt txt-blue d-none d-lg-block d-xl-block' }>
                    Inovasi Potensi Lokal <br/> untuk Pemulihan Indonesia
                </div>
                <button className="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                    <span className="navbar-toggler-icon" />
                </button>
                <div className="collapse navbar-collapse" id="navbarNavDropdown">
                    <ul className="navbar-nav ml-auto">
                        <li className="nav-item active">
                            <a className="nav-link" href="/">Tentang</a>
                        </li>
                        <li className="nav-item">
                            <a className="nav-link" href="/">Kompetisi</a>
                        </li>
                        <li className="nav-item">
                            <a className="nav-link" href="/">Informasi Terbaru</a>
                        </li>  
                        <li className="nav-item">
                            <a className="nav-link" href="/">Linimasa</a>
                        </li>
                        <li className="nav-item ">
                            <Link className="nav-link masuk" to="/login">Masuk</Link>
                        </li>          
                    </ul>
                </div>
                </div>        
            </nav>
        </>
    )
}

export default Navbar
