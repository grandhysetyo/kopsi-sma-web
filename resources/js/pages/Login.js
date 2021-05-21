import React, { Component } from 'react'

export default class Login extends Component {
    constructor(props){
        super(props)
        this.props.sectionActive(0)
    }
    render() {
        return (
            <>
                <section className="login">
                    <img src="/assets/images/sky-login.png" className="sky" alt="" />
                    <div className="container">
                        <div className="row">
                            <div className="col-lg-5 mx-auto">
                                <form className="form-login">
                                    <div className="form-group">
                                        <label htmlFor="email">Surel (Email)</label>
                                        <input type="email" className="form-control" name="email" placeholder="Enter email" />
                                        
                                    </div>
                                    <div className="form-group">
                                        <label htmlFor="exampleInputPassword1">Kata Sandi (Password)</label>
                                        <input type="password" className="form-control" id="exampleInputPassword1" placeholder="Kata Sandi" />
                                    </div>                                    
                                    <button type="submit" className="btn-me btn-masuk">Masuk</button>
                                    <span className="text-muted">Belum memiliki akun?</span>
                                    <a href="/daftar" className="btn-me btn-daftar">Daftar</a>
                                </form>
                                
                            </div>
                        </div>
                    </div>
                </section>
            </>
        )
    }
}
