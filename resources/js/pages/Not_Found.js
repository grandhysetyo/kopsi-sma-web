import React, { Component } from 'react'

export class NotFound extends Component {
    constructor(props) {
        super(props)
        this.props.sectionActive(1)        
    }     
    render() {
        return (
            <section style={{paddingTop: '150px', backgroundColor: 'white'}}>
                <div className="container">
                    <div className="row">
                        <div className="col-lg-8" data-aos="fade-up" data-aos-delay="500">
                            <h1 className="title-section text-left">404 Not Found</h1>
                        </div>
                    </div>
                </div>
            </section>
        )
    }
}

export default NotFound
