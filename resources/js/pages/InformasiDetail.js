import React, { Component } from 'react'
import { withRouter } from "react-router";
import request_api from '../api/request_api'

import "../../sass/informasi-detail.scss"
const ParseHtml = (props) => {
    return(
        parse(props.html)
    )
}
export class InformasiDetail extends Component {
    constructor(props) {
        super(props)
        this.props.sectionActive(1) 
        this.props.navbgWhite(true)  
        this.state = {
            info: [],
            b: []
        }      
           
    }    
    getDetailInformasi = (slug) => {
        axios.get(request_api.fetchDetailInformasi+slug)
        .then((res)=> {                           
            this.setState({info: res.data})  
            // console.log(res.data)
            if(res.data.file.length > 0){
                this.setState({b: res.data.file})  
                // console.log(this.state.file)
            }              
               
        })
        .catch(function (error) {
            // handle error
            console.log(error);
        })
    }
    componentDidMount(){
        const slug = this.props.match.params.slug;
        this.getDetailInformasi(slug);
    }
    render() {      
        
        return (            
            <>
                <section className="info-detail">
                    <div className="container px-5">
                        <div className="row">
                            <div className="col-lg-8" data-aos="fade-up" data-aos-delay="500">
                                <h3 className="title-section text-left">{this.state.info.judul}</h3>
                            </div>
                        </div>
                        <div className="row">
                            <div className="col-lg-12 mb-3" data-aos="fade-up" data-aos-delay="600">                    
                                <div dangerouslySetInnerHTML={{__html: this.state.info.content}}></div>
                            </div>
                        </div>
                        <div className="row">
                            <div className="col-lg-4" data-aos="fade-up" data-aos-delay="700">
                                <h5 className="title-section text-left mb-3">Lampiran</h5>
                                <ul className="lampiran">
                                    {this.state.b.map((data)=>{
                                        return <li>{data.judul} <a href={data.file} className="btnUnduh">Unduh</a></li>
                                     })}                                                                                                             
                                </ul>                                
                            </div>
                        </div>
                    </div>
                </section>
            </>
        )
    }
}

export default withRouter(InformasiDetail)
