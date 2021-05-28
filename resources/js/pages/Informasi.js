import React, { Component } from 'react'
import axios from 'axios'
import { Link } from "react-router-dom";
import ReactPaginate from 'react-paginate'
import slugify from 'react-slugify';

import request_api from '../api/request_api'

import "../../sass/informasi.scss"

const DisplayInformasi = (props) => {
    return(
        props.data.slice(props.pagesVisited, props.pagesVisited + props.infoPerPage).map((res,idx) => {
            return(
                <div key={res.id} className="col-lg-12"  data-aos="fade-up" data-aos-delay={6+idx+'00'}>
                    <Link to={`/informasi-detail/${slugify(res.judul)}`} className="informasi">                                                      
                        <h5 className={idx%2== 0 ? "first-t" : "second-t" }>{res.judul}</h5>
                        <span className={idx%2== 0 ? "first" : "second"}>{res.tanggal}</span>                                                                       
                        {res.content}
                    </Link>
                </div>
            )
        })
    )
    
}

export class Informasi extends Component {
    constructor(props) {
        super(props)
        this.props.sectionActive(1)
        this.props.navbgWhite(true)
        this.state = {
             informasi: [], 
             infoPerPage: 10,
             pageNumber: 0,
             pageVisited: 0,
             pageCount: 0
        }
    }        
    changePage = ({selected}) => {
        this.setState({
            pageNumber: selected,
            pageVisited: selected * this.state.infoPerPage
        })        
    }
    getAllDataInformasi = () =>{
        axios.get(request_api.fetchAllInformasi)
        .then((res)=> {
            // data informasi < info per page
            if(res.data.length < this.state.infoPerPage){
                this.setState({                          
                    infoPerPage: res.data.length,                          
                })                                
            }
                                
            this.setState({
                informasi: res.data,
                pageCount: Math.ceil(res.data.length / this.state.infoPerPage)
            })
            
        })
        .catch(function (error) {
            // handle error
            console.log(error);
        })
    }
    componentDidMount() {
        this.getAllDataInformasi()
    }
    render() {
        return (
            <>
                <section className="info-all">
                    <div className="container">
                        <div className="row">
                            <div className="col-lg-8 mx-auto" data-aos="fade-up" data-aos-delay="500">
                                <h3 className="title-section">INFORMASI TERBARU</h3>
                            </div>
                        </div>
                        <div className="row">
                            <DisplayInformasi data={this.state.informasi} pagesVisited={this.state.pageVisited} infoPerPage={this.state.infoPerPage}/>                                                                                                                                               
                        </div>
                        <div className="row">
                            <div className="col-6 mx-auto">
                                <nav className="pagination-outer" aria-label="Page navigation">
                                    <ReactPaginate
                                        nextLabel={"»"}
                                        previousLabel={"«"}
                                        pageCount={this.state.pageCount}
                                        onPageChange={this.changePage}
                                        containerClassName={"pagination"}
                                        previousLinkClassName={"page-link"}
                                        nextLinkClassName={"page-link"}
                                        disabledClassName={"active"}
                                        activeClassName={"active"}
                                        pageClassName={"page-item"}
                                        pageLinkClassName={"page-link"}
                                    />
                                </nav>
                            </div>
                        </div>
                    </div>  
                </section>  
            </>
        )
    }
}

export default Informasi
