import React, { Component } from 'react'
import axios from 'axios'
import { Link } from "react-router-dom";
import slugify from 'react-slugify';
import request_api from '../api/request_api'

export class SectionPedomanInfo extends Component {
    constructor(props) {
        super(props)
    
        this.state = {
             informasi: [],             
        }
    }
    getDataInformasi = () =>{
        axios.get(request_api.fetchInformasi)
        .then((res)=> {
            if(res.data.length>3){
                this.setState({
                    informasi: res.data.slice(0,3)
                }) 
            }else{
                this.setState({
                    informasi: res.data
                })
            }       
                
        })
        .catch(function (error) {
            // handle error
            console.log(error);
        })
    }
    componentDidMount() {
        this.getDataInformasi()
    }
    render() {
        return (
            <>        
            <section id="ped" className="h-100">
                <div className="row h-100">
                    <div className="pedoman col-sm-12 col-md-12 col-lg-6 align-content-center">
                        <div className="container h-100">
                            <div className="row h-100">
                                <div className="col-lg-12 align-self-center">
                                    <div className="row">
                                        <div className="col-lg-8 mx-auto" id="pedoman-text" data-aos="fade-up" data-aos-delay="300">
                                            <h3 className="title-section">BUKU PEDOMAN</h3>
                                        </div>
                                    </div>                        
                                    <div className="row">
                                        <div className="col-lg-12">
                                            <img src="/assets/images/cover-pedoman.png" alt="" className="hero" id="pedoman-hero" data-aos="fade-up" data-aos-delay="300"/>
                                            <a href="https://pusatprestasinasional.kemdikbud.go.id/wp-content/uploads/2021/05/Pedoman-KoPSI-Tahun-2021.pdf" target="_blank" className="btn-pedoman" id="pedoman-unduh" data-aos="zoom-in-up" data-aos-delay="400">Unduh Pedoman Kopsi SMA Tahun 2021</a>
                                        </div>
                                        
                                    </div>
                                </div>                   
                            </div>                
                        </div>
                    </div>
                    <div className="info col-sm-12 col-md-12 col-lg-6  align-content-center">
                        <div className="container h-100 ">
                            <div className="row h-100">                    
                                <div className="col-lg-12 align-self-center">
                                    <div className="row">
                                        <div className="col-lg-8 mx-auto" id="informasi-text" data-aos="fade-up" data-aos-delay="500">
                                            <h3 className="title-section2">INFORMASI TERBARU</h3>
                                        </div>
                                    </div>                        
                                    <div className="row">
                                        { this.state.informasi.map((data,idx) => 
                                            <div key={data.id} className={idx===0 ? "col-lg-12 d-block" : idx===1 ? "col-lg-12 d-none d-md-block d-lg-block d-xl-block" : "col-lg-12 d-none d-md-block d-lg-block d-xl-block"} id={'informasi-'+idx} data-aos="fade-up" data-aos-delay={6+idx+'00'}>
                                                <Link to={`/informasi-detail/${slugify(data.judul)}`} className="informasi">                                                      
                                                    <h5 className={idx === 0 ? "first-t" : idx===1 ? "second-t" : "third-t"}>{data.judul}</h5>
                                                    <span className={idx === 0 ? "first" : idx===1 ? "second" : "third"}>{data.tanggal}</span>                                                                       
                                                    <p>{data.content}</p>
                                                </Link>
                                            </div>
                                        )}                                                                                                                       
                                        <div className="col-lg-12">
                                            <Link to="/informasi" className="link-white float-right mr-4" id="informasi-link" data-aos="fade-up" data-aos-delay="800">Selengkapnya</Link>
                                        </div>
                                    </div>
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

export default SectionPedomanInfo
