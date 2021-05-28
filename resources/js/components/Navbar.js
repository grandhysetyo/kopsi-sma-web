import React from 'react'
import { Link } from "react-router-dom";
const Navbar = (props) => {
    const dark = props.isDark    
    const bgWhite = props.bgWhite    
    const Logo = (dark)=>{
        if(dark){
            return <img src="/assets/images/logo2.png" className="logo" alt="logo light" />
        }else{
            return <img src="/assets/images/logo.png" className="logo" alt="logo dark" />
        }
    }
    return (
        <>
            <nav className={!dark && bgWhite ? 'navbar navbar-expand-lg navbar-light bg-white' : dark ?  'navbar navbar-expand-lg navbar-dark' : 'navbar navbar-expand-lg navbar-light' }>
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
                        
                        <li className="nav-item dropdown">
                            <a className="nav-link dropdown-toggle" data-toggle="dropdown" href="/" role="button" aria-haspopup="true" aria-expanded="false">Kompetisi</a>
                            <div className="dropdown-menu">                                
                                <Link className="dropdown-item" to="/bidang" >Bidang </Link>                             				  	  
                            </div>
                        </li>

                        <li className="nav-item">
                            <Link className="nav-link" to="/informasi">Informasi</Link>
                        </li>  
                        <li className="nav-item">
                            <a className="nav-link" href="/#lin">Linimasa</a>
                        </li>
                        <li className="nav-item ">
                            <a className="nav-link masuk" href="/login">Masuk</a>
                        </li>          
                    </ul>
                </div>
                </div>        
            </nav>
        </>
    )
}

export default Navbar
